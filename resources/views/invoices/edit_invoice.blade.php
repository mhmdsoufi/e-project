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
    {{isset($invoices) ? 'Edit Invoice' : 'Add Invoice'}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">{{isset($invoices) ? '/Edit Invoice' : '/Add Invoice'}}</span>
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
                    <form action="{{isset($invoices) ? 'invoices/update' : '/invoices'  }}"
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
                                    value="{{old('invoice_id' ,isset($invoices) ? $invoices->id : '' )}}">
                                <input type="text"
                                    class="form-control"
                                    id="inputName"
                                    name="invoice_number"
                                    title="Please enter the invoice number"
                                    required="true"
                                    value="{{old('invoice_number' ,isset($invoices) ? $invoices->invoice_number : '' )}}">
                            </div>

                            <div class="col">
                                <label>Invoice Date</label>
                                <input class="form-control fc-datepicker"
                                    name="invoice_Date"
                                    placeholder="YYYY-MM-DD"
                                    type="text"
                                    value="{{old('invoice_Date' ,isset($invoices) ? $invoices->invoice_date :  date('Y-m-d')  )}}"
                                    required="true">
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker"
                                    name="due_date"
                                    placeholder="YYYY-MM-DD"
                                    type="text"
                                    value="{{old('due_date' ,isset($invoices) ? $invoices->due_date : date('Y-m-d')  )}}"
                                    required="true">
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Section</label>
                                <select name="Section"
                                    class="form-control SlectBox"
                                    onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="{{old('Section' ,isset($invoices) ? $invoices->section->id : '' )}}"
                                        selected abled>{{old('Section' ,isset($invoices) ? $invoices->section->section_name : '' )}}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">Product</label>
                                    <select id="product"
                                    name="product"
                                    class="form-control">
                                    <option value="{{old('product' ,isset($invoices) ? $invoices->product : '' )}}"> {{old('product' ,isset($invoices) ? $invoices->product : '' )}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Collection Amount</label>
                                <input type="text"
                                    class="form-control"
                                    id="inputName"
                                    name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{old('amount_collection' ,isset($invoices) ? $invoices->amount_collection : '' )}}">
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
                                    value="{{old('amount_commission' ,isset($invoices) ? $invoices->amount_commission : '' )}}"
                                    required="true">
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">Discount</label>
                                    <input type="text"
                                    class="form-control form-control-lg"
                                    id="Discount"
                                    name="discount"
                                    title="Please enter the discount amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{old('discount' ,isset($invoices) ? $invoices->discount : '' )}}"
                                    require="true">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">VAT Rate</label>
                                <select name="rate_VAT"
                                    id="Rate_VAT"
                                    class="form-control"
                                    onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="{{old('rate_vat' ,isset($invoices) ? $invoices->rate_vat : '' )}}" selected abled>{{old('rate_vat' ,isset($invoices) ? $invoices->rate_vat : '' )}}</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
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
                                    value="{{ old('value_VAT' ,isset($invoices) ? $invoices->value_vat : '' )}}"
                                    readonly="true">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total Vat</label>
                                <input type="text"
                                    class="form-control"
                                    id="Total"
                                    name="total"
                                    value="{{ old('total' ,isset($invoices) ? $invoices->total : '' )}}"
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
                                    value="{{ old('note' ,isset($invoices) ? $invoices->note : '' )}}"
                                    rows="3">{{ old('note' ,isset($invoices) ? $invoices->note : '' ) }}</textarea>

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
                            <button type="submit" class="btn btn-primary">{{isset($invoices) ? 'Update' : 'Create'}}</button>
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

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('Please enter the commission amount');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
            }
        }
    </script>


@endsection
