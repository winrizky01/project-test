<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\VehicleBooking;
use App\Exports\VehicleBookingExport;
use Maatwebsite\Excel\Facades\Excel;

use DataTables;
use Validator;
use DB;

class ReportController extends Controller
{
    public function index(Request $request){
        $data["title"] = "List Pesanan";
        $data["card_title"] = "List Pesanan";
        
        $view = "pages.report.index";
        
        return view($view, $data);
    }

    public function datatable(Request $request){
        $where = [];
        //default
        $start_date = date("Y-m-01 00:00:00");
        $end_date   = date("Y-m-d 23:59:59");
        //default

        if($request->date != ""){
            $dateRange = explode(' - ', $request->date); // pakai ' - ' (format default dari daterangepicker)

            if (count($dateRange) === 2) {
                $start_date = date("Y-m-d 00:00:00", strtotime($dateRange[0]));
                $end_date   = date("Y-m-d 23:59:59", strtotime($dateRange[1]));
            }
        }

        $data = VehicleBooking::with(['vehicle', 'driver'])->whereBetween('start_time', [$start_date, $end_date])->get();
        
        return datatables()->of($data)->toJson();
    }

    public function exportExcel(Request $request)
    {
        $start_date = now()->startOfMonth()->format('Y-m-d 00:00:00');
        $end_date   = now()->endOfMonth()->format('Y-m-d 23:59:59');

        if ($request->date != "") {
            $dateRange = explode(' - ', $request->date);
            if (count($dateRange) == 2) {
                $start_date = date("Y-m-d 00:00:00", strtotime($dateRange[0]));
                $end_date   = date("Y-m-d 23:59:59", strtotime($dateRange[1]));
            }
        }

        return Excel::download(new VehicleBookingExport($start_date, $end_date), 'vehicle_bookings.xlsx');
    }
}
