<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\sections;
use Illuminate\Http\Request;

class CustomersReportControllere extends Controller
{
    public function index(){
        $sections = sections::all();
        return view('reports.customers_report',compact('sections'));
    }

    public function search(Request $request){

        // not selected invoice date
        if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {

            $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            $sections = sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }


        // Selected invoice date
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])
                                ->where('section_id','=',$request->Section)
                                ->where('product','=',$request->product)
                                ->get();
            $sections = sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }
    }
}
