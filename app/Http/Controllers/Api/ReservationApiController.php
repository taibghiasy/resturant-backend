<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Resources\ReservationResource;
use Carbon\Carbon; // Add this at the top

class ReservationApiController extends Controller
{
    public function index()
    {
        return ReservationResource::collection(
            Reservation::with('table')->get()
        );
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation->load('table'));
    }

    

public function store(Request $request)
{
    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'tel_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'table_id' => 'required|exists:tabels,id',
        'res_date' => 'required|date_format:Y-m-d',
        'res_start_time' => 'required|date_format:H:i',
        'res_end_time' => 'required|date_format:H:i|after:res_start_time',
        'guest_number' => 'required|integer|min:1',
    ]);

    // Force the date to Y-m-d string to prevent timezone shift
    $data['res_date'] = Carbon::createFromFormat('Y-m-d', $data['res_date'])->toDateString();

    // Check overlapping reservations (your existing code)
    $exists = Reservation::where('table_id', $data['table_id'])
        ->where('res_date', $data['res_date'])
        ->where('status', 'reserved')
        ->where(function($q) use ($data) {
            $q->whereBetween('res_start_time', [$data['res_start_time'], $data['res_end_time']])
              ->orWhereBetween('res_end_time', [$data['res_start_time'], $data['res_end_time']])
              ->orWhere(function($q2) use ($data) {
                  $q2->where('res_start_time', '<=', $data['res_start_time'])
                     ->where('res_end_time', '>=', $data['res_end_time']);
              });
        })->exists();

    if ($exists) {
        return response()->json([
            'message' => 'This table is already reserved for the selected time.'
        ], 400);
    }

    $reservation = Reservation::create($data + ['status' => 'reserved']);

    return response()->json([
        'message' => 'Reservation successful!',
        'reservation' => $reservation
    ]);
}


    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'tel_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'table_id' => 'required|exists:tabels,id',
            'res_date' => 'required|date',
            'res_start_time' => 'required|date_format:H:i',
            'res_end_time' => 'required|date_format:H:i|after:res_start_time',
            'guest_number' => 'required|integer|min:1',
        ]);

        // Check overlapping reservations for update
        $exists = Reservation::where('table_id', $data['table_id'])
            ->where('res_date', $data['res_date'])
            ->where('status', 'reserved')
            ->where('id', '!=', $reservation->id)
            ->where(function($q) use ($data) {
                $q->whereBetween('res_start_time', [$data['res_start_time'], $data['res_end_time']])
                  ->orWhereBetween('res_end_time', [$data['res_start_time'], $data['res_end_time']])
                  ->orWhere(function($q2) use ($data) {
                      $q2->where('res_start_time', '<=', $data['res_start_time'])
                         ->where('res_end_time', '>=', $data['res_end_time']);
                  });
            })->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This table is already reserved for the selected time.'
            ], 400);
        }

        $reservation->update($data);

        return new ReservationResource($reservation->load('table'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
