<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\invoices;
use App\Models\sections;
use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:Invoices List', ['only' => ['index']]);
    $this->middleware('permission:Add Invoice', ['only' => ['store']]);
    $this->middleware('permission:Edit Invoice', ['only' => ['edit','update']]);
    $this->middleware('permission:Delete Invoice|archive Invoice', ['only' => ['destroy']]);
    $this->middleware('permission:Change Payment Status', ['only' => [ 'show','update_payment']]);
    $this->middleware('permission:Paid Invoices', ['only' => ['paid_invoices']]);
    $this->middleware('permission:UnPaid Invoices', ['only' => [ 'unpaid_invoices']]);
    $this->middleware('permission:PartiallyPaid Invoices', ['only' => [ 'partiallypaid_invoices']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices=invoices::where('invoice_number',"LIKE",'%'.$request->search.'%')
        ->orwhere('invoice_date',"LIKE",'%'.$request->search.'%')
        ->orwhere('due_date',"LIKE",'%'.$request->search.'%')
        ->orwhere('product',"LIKE",'%'.$request->search.'%')
        ->orwhere('section_id',"LIKE",'%'.$request->search.'%')
        ->orwhere('amount_collection',"LIKE",'%'.$request->search.'%')
        ->orwhere('amount_commission',"LIKE",'%'.$request->search.'%')
        ->orwhere('discount',"LIKE",'%'.$request->search.'%')
        ->orwhere('value_vat',"LIKE",'%'.$request->search.'%')
        ->orwhere('rate_vat',"LIKE",'%'.$request->search.'%')
        ->orwhere('total',"LIKE",'%'.$request->search.'%')
        ->orwhere('status',"LIKE",'%'.$request->search.'%')
        ->orwhere('value_status',"LIKE",'%'.$request->search.'%')
        ->orwhere('note',"LIKE",'%'.$request->search.'%')
        ->orwhere('payment_date',"LIKE",'%'.$request->search.'%')
        ->orwhere('user',"LIKE",'%'.$request->search.'%')
        ->get();
        return view('invoices.invoices',compact('invoices'));
    }
    public function search(Request $request){
        return invoices::where('status',"LIKE",'%'.$request->search.'%')->get();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_Date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_VAT,
            'rate_vat' => $request->rate_VAT,
            'total' => $request->total,
            'status' => 'Unpaid ',
            'value_status' => 2 ,
            'note' => $request->note,
            'user' =>(Auth::user()->name),
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' =>'Unpaid',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);


        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

//        $user = User::first();
//        Notification::send($user , new AddInvoice($invoice_id));
//      $user->notify(new AddInvoice($invoice_id));



        $user=User::find(1);
        $invoice_id = invoices::latest()->first();
        Notification::send($user , new AddInvoice($invoice_id));
       // $user->notify(new AddInvoice($invoice_id));


        session()->flash('Add', 'Invoice added Successfully');
        return redirect('/invoices-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoices::where('id',$id)->first();
        return view('invoices.update_payment' , compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id= $request->id;
        $invoices = invoices::where('id',$id)->first();
        $sections = sections::all();
        return view('invoices.edit_invoice',compact('invoices','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        $invoices = invoices::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_Date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_VAT,
            'rate_vat' => $request->rate_VAT,
            'total' => $request->total,
            'note' => $request->note,
        ]);

        session()->flash('edit','Invoice edited successfully');
        return redirect('/invoices-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices=invoices::where('id',$id)->first();
        $details=invoices_attachments::where('invoice_id',$id)->first();
        if(!$request->id_page==2){
            if (!empty($details->invoice_number)){
                Storage::disk('public_upload')->deleteDirectory($details->invoice_number);
            }
            $invoices->forceDelete();
            session()->flash('delete');
            return redirect('/invoices-list');
        }
        else{
            $invoices->Delete();
            session()->flash('archive');
            return redirect('/archived-invoices');
        }
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }

    public function update_payment($id , Request $request){
        $invoices = invoices::findOrFail($id);
        if( $request->Status == 'Paid' )
        {
            $invoices->update([
                'value_status' => 1 ,
                'status' => $request->Status ,
                'payment_date'=>$request->payment_date,
            ]);

            invoices_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => $request->Status,
                'value_status' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        }
        else{
            $invoices->update([
                'value_status' => 3 ,
                'status' => $request->Status ,
                'payment_date'=>$request->payment_date
            ]);

            invoices_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => $request->Status,
                'value_status' => 3,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('payment-update');
        return redirect('/invoices-list');
    }

    public function paid_invoices(){
        $invoices = invoices::where('value_status', 1 )->get();
        return view('invoices.invoices',compact('invoices'));
    }
    public function unpaid_invoices(){
        $invoices = invoices::where('value_status', 2 )->get();
        return view('invoices.invoices',compact('invoices'));
    }
    public function partiallypaid_invoices(){
        $invoices = invoices::where('value_status', 3 )->get();
        return view('invoices.invoices',compact('invoices'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

}
