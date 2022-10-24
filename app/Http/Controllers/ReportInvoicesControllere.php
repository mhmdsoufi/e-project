<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class ReportInvoicesControllere extends Controller
{
    public function index(){
        return view('reports.invoices_report');
    }

    public function search(Request $request){

        $rdio = $request->rdio;

    // search by invoice status
        if ($rdio == 1) {

            // not selected invoice date
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                $invoices = invoices::select('*')->where('status','=',$request->type)->get();
                $type = $request->type;
                //dd($request->type);
                return view('reports.invoices_report',compact('type'))->withDetails($invoices);
            }

            // Selected invoice date
            else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;
                $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])
                        ->where('status','=',$request->type)->get();
                return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);

            }
        }

    //Search by invoices number
        else {
            $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
        }
    }
}
