<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Vehincle;
use DataTables;
use Validator;
use DB;

class VehincleController extends Controller
{
    public function index(Request $request){
        $data["title"] = "List Kendaraan";
        $data["card_title"] = "List Kendaraan";
        
        $view = "pages.vehincle.index";
        
        return view($view, $data);
    }

    public function create(Request $request){
        $data["title"]      = "Tambah Kendaraan";
        $data["card_title"] = "Tambah Kendaraan";
        
        $view = "pages.vehincle.create";
        
        return view($view, $data);
    }

    public function edit(Request $request, $id){
        $vehincle = Vehincle::find($id);
        if(!$vehincle){
            Session::put('error','Opps, Data not found!');
            return redirect()->to('vehincles');
        }

        $data["title"]      = "Edit Kendaraan";
        $data["card_title"] = "Edit Kendaraan";
        $data["data"]       = $vehincle;

        $view = "pages.vehincle.edit";

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
            $vehincle = Vehincle::create([
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
        // Session::put('success', "Data vehincles success to created!");
        return redirect()->to('vehincles')->with('success', 'Data vehincles success to created');
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
            $vehincle = Vehincle::find($id);
            $vehincle->plate_number = $request->plate_number;
            $vehincle->type      = $request->type;
            $vehincle->brand     = $request->brand;
            $vehincle->model     = $request->model;
            $vehincle->ownership = $request->ownership;
            $vehincle->fuel_type = $request->fuel_type;
            $vehincle->save();
        } catch (Exception $e) {
            DB::rollback();
            // Session::put('error', $e->getMessage());
            return redirect()->back()->with('error', 'Ada yang salah!');
        }

        DB::commit();
        // Session::put('success', "Data vehincle success to updated!");
        return redirect()->to('vehincles')->with('success', 'Data vehincles success to updated');
    }
    
    public function datatable(Request $request){
        $where = [];

        $data = Vehincle::where($where)->get();

        return datatables()->of($data)->toJson();
    }
}
