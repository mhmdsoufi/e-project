@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    Update Payment Status
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/Update Payment Status</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')



    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update-payment',[$invoices->id]) }}"
                        method="post"
                        enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Invoice Number</label>
                                <input type="hidden"
                                    name="invoice_id"
                                    value="{{$invoices->id}}">
                                <input type="text"
                                    class="form-control"
                                    id="inputName"
                                    name="invoice_number"
                                    title="Please enter the invoice number"
                                    required="true"
                                    value="{{$invoices->invoice_number}}"
                                    readonly="true">
                            </div>

                            <div class="col">
                                <label>Invoice Date</label>
                                <input class="form-control fc-datepicker"
                                    name="invoice_Date"
                                    placeholder="YYYY-MM-DD"
                                    type="text"
                                    value="{{$invoices->invoice_date }}"
                                    required="true"
                                    readonly="true">
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker"
                                    name="due_date"
                                    placeholder="YYYY-MM-DD"
                                    type="text"
                                    value="{{ $invoices->due_date}}"
                                    required="true"
                                    readonly="true">
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Section</label>
                                <select name="Section"
                                    class="form-control SlectBox"
                                    onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')"
                                    readonly="true">
                                    <option value="{{$invoices->section->id }}"> {{ $invoices->section->section_name }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Product</label>
                                <select id="product"
                                    name="product"
                                    class="form-control"
                                    readonly="true">
                                    <option value="{{$invoices->product}}"> {{$invoices->product}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Collection Amount</label>
                                <input type="text"
                                    class="form-control"
                                    id="inputName"
                                    name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{$invoices->amount_collection}}"
                                    readonly="true">
                                </div>
                            </div>


                            {{-- 3 --}}

                            <div class="row">

                                <div class="col">
                                    <label for="inputName" class="control-label">Commission Amount</label>
                                    <input type="text"
                                    class="form-control form-control-lg"
                                    id="Amount_Commission"
                                    name="amount_commission"
                                    title="Please enter the commission amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{$invoices->amount_commission}}"
                                    required="true"
                                    readonly="true">
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">Discount</label>
                                    <input type="text"
                                    class="form-control form-control-lg"
                                    id="Discount"
                                    name="discount"
                                    title="Please enter the discount amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{$invoices->discount}}"
                                    require="true"
                                    readonly="true">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">VAT Rate</label>
                                <select name="rate_VAT"
                                    id="Rate_VAT"
                                    class="form-control"
                                    onchange="myFunction()"
                                    readonly="true">
                                    <!--placeholder-->
                                    <option value="{{$invoices->rate_vat}}" selected abled>{{$invoices->rate_vat}}</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Value Vat</label>
                                <input type="text"
                                    class="form-control"
                                    id="Value_VAT"
                                    name="value_VAT"
                                    value="{{$invoices->value_vat}}"
                                    readonly="true">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total Vat</label>
                                <input type="text"
                                    class="form-control"
                                    id="Total"
                                    name="total"
                                    value="{{$invoices->total}}"
                                    readonly="true">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Description</label>
                                <textarea class="form-control"
                                    id="exampleTextarea"
                                    name="note"
                                    value="{{$invoices->note}}"
                                    rows="3"
                                    readonly="true">{{$invoices->note}}
                                </textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Payment Status</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option selected="true" disabled="disabled">-- Select Payment Status --</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Partially paid">Partially paid</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Payment Date</label>
                                <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required="true">
                            </div>


                        </div><br>

                        @if (isset($invoices))
                        @else
                        <p class="text-danger">* Attachment Format: pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">Attachments</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file"
                                name="pic"
                                class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>

                        @endif
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Update Payment Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

@endsection
