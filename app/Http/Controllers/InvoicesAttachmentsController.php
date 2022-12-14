<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesAttachmentsController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:Add Attachment', ['only' => ['store']]);
    $this->middleware('permission:Delete Attachment', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',

            ], [
                'file_name.mimes' => 'Attchments Format Should Be :  pdf, jpeg , png , jpg',
            ]);

            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();

            $attachments =  new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $request->invoice_number;
            $attachments->invoice_id = $request->invoice_id;
            $attachments->Created_by = Auth::user()->name;
            $attachments->save();

            // move pic
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);

            session()->flash('Add', 'Attachment added Successfully');
            return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
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
