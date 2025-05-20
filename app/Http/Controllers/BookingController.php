<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\VehicleBooking;
use DataTables;
use Validator;
use DB;

class BookingController extends Controller
{
    public function index(Request $request){
        $data["title"] = "List Pesanan";
        $data["card_title"] = "List Pesanan";
        
        $view = "pages.booking.index";
        
        return view($view, $data);
    }

    public function create(Request $request){
        $data["title"]      = "Tambah Pesanan";
        $data["card_title"] = "Tambah Pesanan";
        $data["vehicles"]   = Vehicle::where("status", "tersedia")->get();
        $data["drivers"]    = Driver::where("status", "standby")->get();
        $data["approvals_lv_1"] = User::where("role", "approver")->get();
        $data["approvals_lv_2"] = User::where("role", "approval")->get();
        
        $view = "pages.booking.create";
        
        return view($view, $data);
    }

    public function edit(Request $request, $id){
        $booking = VehicleBooking::with(['vehicle', 'driver', 'approval_lv_1'])->find($id);
        if(!$booking){
            Session::put('error','Opps, Data not found!');
            return redirect()->to('vehincles');
        }

        $data["title"]      = "Lihat List Pesanan";
        $data["card_title"] = "Lihat List Pesanan";
        $data["data"]       = $booking;

        $view = "pages.booking.edit";

        return view($view, $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'booking_date'   => 'required',
            'vehicle_id'    => 'required',
            'driver_id'      => 'required',
            'approval_lv_1'  => 'required',
            // 'approval_lv_2'  => 'required',
        ]);

        if($validator->fails()){
            // Session::put('error','The following fields are required!');
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::beginTransaction();
        try {
            $vehicleBooking = VehicleBooking::create([
                "user_id"           => $request->driver_id,
                "driver_id"         => $request->driver_id,
                "vehicle_id"        => $request->vehicle_id,
                "start_time"        => $request->booking_date,
                "location"          => $request->location,
                "destination"       => $request->destination,
                "status"            => 'pending',
                "notes"             => $request->note,
                "approval_level_1"  => $request->approval_lv_1 ,
                // "approval_level_2"  => $request->approval_level_2,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            // Session::put('error', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();
        // Session::put('success', "Data vehincles success to created!");
        return redirect()->to('bookings')->with('success', 'Data driver success to created');
    }

    public function update(Request $request, $id){}

    public function datatable(Request $request){
        $where = [];

        $data = VehicleBooking::with(['vehicle', 'driver'])->where($where)->get();

        return datatables()->of($data)->toJson();
    }
}
