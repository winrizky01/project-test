<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleBooking;
use App\Models\Vehicle;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $data["title"] = "Dashboard";
        
        $view = "pages.dashboard";
        
        return view($view, $data);
    }

    public function chartdata(){
        $start = Carbon::now()->startOfMonth()->startOfDay();
        $end   = Carbon::now()->endOfMonth()->endOfDay();

        $data = VehicleBooking::select(
                DB::raw('DATE(start_time) as date'),
                'vehicle_id',
                DB::raw('count(*) as total')
            )
            ->whereBetween('start_time', [$start, $end])
            ->groupBy('date', 'vehicle_id')
            ->orderBy('date')
            ->get()
            ->groupBy('vehicle_id');

        $formatted = [];
        foreach ($data as $vehicleId => $records) {
            $vehicle = Vehicle::find($vehicleId);
            $label = $vehicle ? $vehicle->plate_number . ' - ' . $vehicle->brand : 'Unknown';

            $dataset = [
                'label' => $label,
                'data' => [],
            ];

            foreach ($records as $record) {
                $dataset['data'][] = [
                    'x' => $record->date,
                    'y' => $record->total,
                ];
            }

            $formatted[] = $dataset;
        }

        return response()->json($formatted);
    }
}
