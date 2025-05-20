<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\vehicle;
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
        $vehincle = Driver::find($id);
        if(!$vehincle){
            Session::put('error','Opps, Data not found!');
            return redirect()->to('vehincles');
        }

        $data["title"]      = "Edit Supir";
        $data["card_title"] = "Edit Supir";
        $data["data"]       = $vehincle;

        $view = "pages.driver.edit";

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
        return redirect()->to('drivers')->with('success', 'Data driver success to created');
    }

    public function approval(Request $request, $id){
        var_dump($request->all(), $id);die();
        // $validator = Validator::make($request->all(),[
        //     'name'              => 'required',
        //     'phone_number'      => 'required',
        //     'emergency_name'    => 'required',
        //     'emergency_phone'   => 'required',
        //     'license_number'    => 'required',
        //     'license_expiry_date'=> 'required',
        // ]);

        // if($validator->fails()){
        //     // Session::put('error','The following fields are required!');
        //     return redirect()->back()->with('error', 'Ada yang salah!');
        // }

        // DB::beginTransaction();
        // try {
        //     $vehincle = Vehincle::find($id);
        //     $vehincle->name                 = $request->name;
        //     $vehincle->phone_number         = $request->phone_number;
        //     $vehincle->emergency_name       = $request->emergency_name;
        //     $vehincle->emergency_phone      = $request->emergency_phone;
        //     $vehincle->license_number       = $request->license_number;
        //     $vehincle->license_expiry_date  = $request->license_expiry_date;
        //     $vehincle->save();
        // } catch (Exception $e) {
        //     DB::rollback();
        //     // Session::put('error', $e->getMessage());
        //     return redirect()->back()->with('error', 'Ada yang salah!');
        // }

        // DB::commit();
        // // Session::put('success', "Data vehincle success to updated!");
        // return redirect()->to('drivers')->with('success', 'Data vehincles success to updated');
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'phone_number'      => 'required',
            'emergency_name'    => 'required',
            'emergency_phone'   => 'required',
            'license_number'    => 'required',
            'license_expiry_date'=> 'required',
        ]);

        if($validator->fails()){
            // Session::put('error','The following fields are required!');
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::beginTransaction();
        try {
            $vehincle = Vehincle::find($id);
            $vehincle->name                 = $request->name;
            $vehincle->phone_number         = $request->phone_number;
            $vehincle->emergency_name       = $request->emergency_name;
            $vehincle->emergency_phone      = $request->emergency_phone;
            $vehincle->license_number       = $request->license_number;
            $vehincle->license_expiry_date  = $request->license_expiry_date;
            $vehincle->save();
        } catch (Exception $e) {
            DB::rollback();
            // Session::put('error', $e->getMessage());
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::commit();
        // Session::put('success', "Data vehincle success to updated!");
        return redirect()->to('drivers')->with('success', 'Data vehincles success to updated');
    }

    public function datatable(Request $request){
        $where = [];

        $data = VehicleBooking::with(['vehicle', 'driver'])->where($where)->get();

        return datatables()->of($data)->toJson();
    }
}
