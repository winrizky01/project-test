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

class ApprovalController extends Controller
{
    public function index(Request $request){
        $data["title"]      = "List Persetujuan";
        $data["card_title"] = "List Persetujuan";

        $view = "pages.approval.index";
        
        return view($view, $data);
    }

    public function approval(Request $request, $id){
        $booking = VehicleBooking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function datatable(Request $request){
        $user = auth()->user();

        $data = VehicleBooking::with(['vehicle', 'driver'])
                            ->where('status', 'pending')
                            ->when($user->role === 'approver', function ($query) use ($user) {
                                $query->where('approval_level_1', $user->id);
                            })
                            ->when($user->role === 'superadmin', function ($query) {})
                            ->get();

        return datatables()->of($data)->toJson();
    }
}
