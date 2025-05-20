<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Vehincle;
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
        $data["vehincles"]  = Vehincle::where("status", "tersedia")->get();
        $data["drivers"]    = Driver::where("status", "standby")->get();
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
            // 'name'              => 'required',
            // 'phone_number'      => 'required',
            // 'emergency_name'    => 'required',
            // 'emergency_phone'   => 'required',
            // 'license_number'    => 'required',
            // 'license_expiry_date'=> 'required',
        ]);

        if($validator->fails()){
            // Session::put('error','The following fields are required!');
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::beginTransaction();
        try {
            $vehicleBooking = VehicleBooking::create([
                "driver_id"         => $request->driver_id,
                "vehincle_id"       => $request->vehincle_id,
                "start_time"        => $request->start_time,
                "destination"       => $request->destination,
                "status"            => $request->status,
                "notes"             => $request->note,
                "approval_level_1"  => $request->approval_level_1 ,
                "approval_level_2"  => $request->approval_level_2,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            // Session::put('error', $e->getMessage());
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::commit();
        // Session::put('success', "Data vehincles success to created!");
        return redirect()->to('drivers')->with('success', 'Data driver success to created');
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

        $data = Driver::where($where)->get();

        return datatables()->of($data)->toJson();
    }
}
