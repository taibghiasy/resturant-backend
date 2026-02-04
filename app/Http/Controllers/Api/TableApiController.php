<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Resources\TableResource;
use App\Models\Reservation;

class TableApiController extends Controller
{
    public function index(Request $request)
    {
        $resDate = $request->query('res_date') ?? date('Y-m-d');
        $startTime = $request->query('res_start_time');
        $endTime = $request->query('res_end_time');

        // Normalize times to HH:MM:SS if they are HH:MM
        $normalizeTime = function ($t) {
            if (!$t) return null;
            // If format is HH:MM (length 5), append :00
            return (strlen($t) === 5) ? $t . ':00' : $t;
        };

        $startTimeNormalized = $normalizeTime($startTime);
        $endTimeNormalized = $normalizeTime($endTime);

        // Only filter if both start and end times are provided
        if ($startTimeNormalized && $endTimeNormalized) {
            // Get IDs of tables that are reserved and overlap with the selected period
            $reservedTableIds = Reservation::whereDate('res_date', $resDate)
                ->where(function($q) {
                    // Treat any reservation that is NOT Cancelled (including NULL) as blocking
                    $q->where('status', '!=', 'Cancelled')
                      ->orWhereNull('status');
                })
                ->where(function($q) use ($startTimeNormalized, $endTimeNormalized) {
                    $q->whereBetween('res_start_time', [$startTimeNormalized, $endTimeNormalized])
                      ->orWhereBetween('res_end_time', [$startTimeNormalized, $endTimeNormalized])
                      ->orWhere(function($q2) use ($startTimeNormalized, $endTimeNormalized) {
                          $q2->where('res_start_time', '<=', $startTimeNormalized)
                             ->where('res_end_time', '>=', $endTimeNormalized);
                      });
                })
                ->pluck('table_id');

            // Get only tables that are NOT reserved during this period
            $tables = Table::whereNotIn('id', $reservedTableIds)->get();
        } else {
            // If no start/end time, return all tables
            $tables = Table::all();
        }

        return response()->json(['data' => $tables]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'guest_number' => 'required|integer',
            'status' => 'required|string',
            'location' => 'required|string',
        ]);

        $table = Table::create($data);
        return new TableResource($table);
    }

    public function update(Request $request, Table $table)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'guest_number' => 'required|integer',
            'status' => 'required|string',
            'location' => 'required|string',
        ]);

        $table->update($data);
        return new TableResource($table);
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
