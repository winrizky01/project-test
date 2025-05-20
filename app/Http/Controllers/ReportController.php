<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request){
        $data["title"] = "List Pesanan";
        $data["card_title"] = "List Pesanan";
        
        $view = "pages.report.index";
        
        return view($view, $data);
    }
}
