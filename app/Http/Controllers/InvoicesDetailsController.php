<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoices=invoices::where('id',$id)->first();
        $details=invoices_details::where('id_invoice',$id)->get();
        $attachments=invoices_attachments::where('invoice_id',$id)->get();
        return view('invoices.detail_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoices_attachments::findOrFail($request->id_file);
        Storage::disk('public_upload')-> delete($request->invoice_number.'/'.$request->file_name);
        $invoices->delete();
        session()->flash('delete', 'Attachment Deleted successfully');
        return back();
    }

    public function open($invoice_number,$file_name)
    {
        $files = Storage::disk('public_upload')
        ->getDriver()
        ->getAdapter()
        ->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }

    public function download($invoice_number,$file_name)
    {
        $content = Storage::disk('public_upload')
        ->getDriver()
        ->getAdapter()
        ->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($content);
    }
}
