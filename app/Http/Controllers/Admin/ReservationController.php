<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reservations = Reservation::with('table')
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('tel_number', 'like', "%{$search}%");
            })
            ->orderBy('res_date', 'desc')
            ->get();

        return view('admin.reservation.index', compact('reservations', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::all();
        return view("admin.reservation.create", compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(ReservationStoreRequest $request)
{
    $data = $request->validated();

    // Ensure only the date part is stored, ignoring time & timezone
    $data['res_date'] = Carbon::createFromFormat('Y-m-d', $data['res_date'])->toDateString();

    Reservation::create($data);

    return to_route('admin.reservation.index');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationStoreRequest $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $data = $request->validated();

        $data['res_date'] = date('Y-m-d', strtotime($data['res_date']));

        $reservation->update($data);

        return to_route('admin.reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return to_route('admin.reservation.index'); 
    }
}
