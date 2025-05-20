<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Vehicle;
use DataTables;
use Validator;
use DB;

class VehicleController extends Controller
{
    public function index(Request $request){
        $data["title"] = "List Kendaraan";
        $data["card_title"] = "List Kendaraan";
        
        $view = "pages.vehicle.index";
        
        return view($view, $data);
    }

    public function create(Request $request){
        $data["title"]      = "Tambah Kendaraan";
        $data["card_title"] = "Tambah Kendaraan";
        
        $view = "pages.vehicle.create";
        
        return view($view, $data);
    }

    public function edit(Request $request, $id){
        $vehicle = Vehicle::find($id);
        if(!$vehicle){
            Session::put('error','Opps, Data not found!');
            return redirect()->to('vehicles');
        }

        $data["title"]      = "Edit Kendaraan";
        $data["card_title"] = "Edit Kendaraan";
        $data["data"]       = $vehicle;

        $view = "pages.vehicle.edit";

        return view($view, $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'plate_number' => 'required',
            'type'      => 'required',
            'brand'     => 'required',
            'model'     => 'required',
            'ownership' => 'required',
            'fuel_type' => 'required',
        ]);

        if($validator->fails()){
            // Session::put('error','The following fields are required!');
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::beginTransaction();
        try {
            $vehicle = Vehicle::create([
                "plate_number"  => $request->plate_number,
                "type"          => $request->type,
                "brand"         => $request->brand,
                "model"         => $request->model,
                "ownership"     => $request->ownership ,
                "fuel_type"     => $request->fuel_type,
                "status"        => "tersedia",
            ]);
        } catch (Exception $e) {
            DB::rollback();
            // Session::put('error', $e->getMessage());
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::commit();
        // Session::put('success', "Data vehicles success to created!");
        return redirect()->to('vehicles')->with('success', 'Data vehicles success to created');
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'plate_number' => 'required',
            'type'      => 'required',
            'brand'     => 'required',
            'model'     => 'required',
            'ownership' => 'required',
            'fuel_type' => 'required',
        ]);

        if($validator->fails()){
            // Session::put('error','The following fields are required!');
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::beginTransaction();
        try {
            $vehicle = Vehicle::find($id);
            $vehicle->plate_number = $request->plate_number;
            $vehicle->type      = $request->type;
            $vehicle->brand     = $request->brand;
            $vehicle->model     = $request->model;
            $vehicle->ownership = $request->ownership;
            $vehicle->fuel_type = $request->fuel_type;
            $vehicle->save();
        } catch (Exception $e) {
            DB::rollback();
            // Session::put('error', $e->getMessage());
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::commit();
        // Session::put('success', "Data vehicle success to updated!");
        return redirect()->to('vehicles')->with('success', 'Data vehicles success to updated');
    }
    
    public function datatable(Request $request){
        $where = [];

        $data = Vehicle::where($where)->get();

        return datatables()->of($data)->toJson();
    }
}
