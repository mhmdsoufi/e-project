@extends('layouts.master')
@section('title')
    Invoice Details
@endsection
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Invoice Details</h4>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('Add'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('Add') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12">
						<div class="card" id="basic-alert">
							<div class="card-body">
								<div>
                                    <h1>Invoice Number:{{ $invoices->invoice_number }}</h1>
                                </div>
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-1">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">Details</a></li>
														<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab"> Payment statuses </a></li>
														<li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab"> attachments </a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab1">
                                                        <table class="table table-striped" style="text-align:center">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Invoice Number</th>
                                                                    <td>{{ $invoices->invoice_number }}</td>
                                                                    <th scope="row">Invoice Date</th>
                                                                    <td>{{ $invoices->invoice_date }}</td>
                                                                    <th scope="row">Due Date</th>
                                                                    <td>{{ $invoices->due_date }}</td>
                                                                    <th scope="row">Section</th>
                                                                    <td>{{ $invoices->section->section_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Product</th>
                                                                    <td>{{ $invoices->product }}</td>
                                                                    <th scope="row">Collection Amount</th>
                                                                    <td>{{ $invoices->amount_collection }}</td>
                                                                    <th scope="row">Commission Amount</th>
                                                                    <td>{{ $invoices->amount_commission }}</td>
                                                                    <th scope="row">Discount</th>
                                                                    <td>{{ $invoices->discount }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Rate VAt</th>
                                                                    <td>{{ $invoices->rate_vat }}</td>
                                                                    <th scope="row">Value VAT</th>
                                                                    <td>{{ $invoices->value_vat }}</td>
                                                                    <th scope="row">Total with VAT</th>
                                                                    <td>{{ $invoices->total }}</td>
                                                                    <th scope="row">Current Status</th>
                                                                    @if($invoices->value_status==1)
                                                                    <td>
                                                                        <span class="badge badge-pill badge-success">
                                                                        {{ $invoices->status }}
                                                                        </span>
                                                                    </td>
                                                                    @elseif($invoices->value_status==2)
                                                                    <td>
                                                                        <span class="badge badge-pill badge-danger">
                                                                            {{ $invoices->status }}
                                                                        </span>
                                                                    </td>
                                                                    @else
                                                                    <td>
                                                                        <span class="badge badge-pill badge-warning">
                                                                        {{ $invoices->status }}
                                                                        </span>
                                                                    </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">note</th>
                                                                    <td>{{ $invoices->note }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
													<div class="tab-pane" id="tab2">
                                                        <div class="table-responsive at-15">
                                                            <table class="table center-aligned-table mb-0 table-hover" style="text-align:center">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>invoice Number</th>
                                                                        <th>Product</th>
                                                                        <th>Section</th>
                                                                        <th>Payment Status</th>
                                                                        <th>Payment Date</th>
                                                                        <th>Note</th>
                                                                        <th>Added Date</th>
                                                                        <th>User</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 0; ?>
                                                                    @foreach ($details as $det)
                                                                        <?php $i++; ?>
                                                                        <tr>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $det->invoice_number }}</td>
                                                                            <td>{{ $det->product }}</td>
                                                                            <td>{{ $invoices->Section->section_name }}</td>
                                                                            @if ($det->value_status == 1)
                                                                                <td><span
                                                                                        class="badge badge-pill badge-success">{{ $det->status }}</span>
                                                                                </td>
                                                                            @elseif($det->value_status ==2)
                                                                                <td><span
                                                                                        class="badge badge-pill badge-danger">{{ $det->status }}</span>
                                                                                </td>
                                                                            @else
                                                                                <td><span
                                                                                        class="badge badge-pill badge-warning">{{ $det->status }}</span>
                                                                                </td>
                                                                            @endif
                                                                            <td>{{ $det->Payment_Date }}</td>
                                                                            <td>{{ $det->note }}</td>
                                                                            <td>{{ $det->created_at }}</td>
                                                                            <td>{{ $det->user }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
													<div class="tab-pane" id="tab3">
                                                        <div class="card-body">
                                                            <p class="text-danger">* Attachments Format: pdf, jpeg ,.jpg , png </p>
                                                            <h5 class="card-title">Add Attachments</h5>
                                                            <form method="post"
                                                                action="{{ url('/InvoiceAttachments') }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="custom-file">
                                                                    <input type="file"
                                                                        class="custom-file-input"
                                                                        id="customFile"
                                                                        name="file_name"
                                                                        required="true">
                                                                    <input type="hidden"
                                                                        id="customFile"
                                                                        name="invoice_number"
                                                                        value="{{ $invoices->invoice_number }}">
                                                                    <input type="hidden"
                                                                        id="invoice_id"
                                                                        name="invoice_id"
                                                                        value="{{ $invoices->id }}">
                                                                    <label class="custom-file-label"
                                                                        for="customFile">Select Attachment</label>
                                                                </div><br><br>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm "
                                                                    name="uploadedFile">Submit</button>
                                                            </form>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0 table table-hover"
                                                                style="text-align:center">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">File Name</th>
                                                                        <th scope="col">Created by</th>
                                                                        <th scope="col">Created at</th>
                                                                        <th scope="col">action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 0; ?>
                                                                    @foreach ($attachments as $attach)
                                                                        <?php $i++; ?>
                                                                        <tr>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $attach->file_name }}</td>
                                                                            <td>{{ $attach->Created_by }}</td>
                                                                            <td>{{ $attach->created_at }}</td>
                                                                            <td colspan="2">

                                                                                <a class="btn btn-outline-success btn-sm"
                                                                                    href="{{ url('view_file') }}/{{ $invoices->invoice_number }}/{{ $attach->file_name }}"
                                                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                                    Show</a>

                                                                                <a class="btn btn-outline-info btn-sm"
                                                                                    href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attach->file_name }}"
                                                                                    role="button"><i
                                                                                        class="fas fa-download"></i>&nbsp;
                                                                                    Download</a>

                                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                                        data-toggle="modal"
                                                                                        data-file_name="{{ $attach->file_name }}"
                                                                                        data-invoice_number="{{ $attach->invoice_number }}"
                                                                                        data-id_file="{{ $attach->id }}"
                                                                                        data-target="#delete_file">Delete</button>

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /div -->
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->

                  <!-- delete -->
                    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Attachment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('delete_file') }}" method="post">

                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <p class="text-center">
                                    <h6 style="color:red">!!??are you sure of the deleting process</h6>
                                    </p>

                                    <input type="hidden" name="id_file" id="id_file" value="">
                                    <input type="text" name="file_name" id="file_name" value="" readonly="true">
                                    <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                    <button type="submit" class="btn btn-danger">YES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)
        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>
@endsection
