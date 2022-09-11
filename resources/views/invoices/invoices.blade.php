@extends('layouts.master')

@section('title')
Invoices List
@stop

@section('css')
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoices List</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                @if (session()->has('delete'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: "Invoice Deleted Successfully",
                            type: "success"
                        })
                    }
                </script>
                @endif

                @if (session()->has('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Add') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
				<!-- row -->
				<div class="row">
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="card-header pb-0">
                                        <a class="modal-effect btn btn-outline-primary "

                                        href="invoices/create">Add invoice</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">Invoices Number</th>
                                                    <th class="border-bottom-0">Invoices Date</th>
                                                    <th class="border-bottom-0">Due Date</th>
                                                    <th class="border-bottom-0">Product</th>
                                                    <th class="border-bottom-0">Section</th>
                                                    <th class="border-bottom-0">Discount</th>
                                                    <th class="border-bottom-0">Rate Vat</th>
                                                    <th class="border-bottom-0">Value Vat</th>
                                                    <th class="border-bottom-0">Total</th>
                                                    <th class="border-bottom-0">Status</th>
                                                    <th class="border-bottom-0">Note</th>
                                                    <th class="border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=0
                                                @endphp
                                                @foreach ($invoices as $inv)
                                                @php
                                                    $i++
                                                @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $inv->invoice_number }}</td>
                                                    <td>{{ $inv->invoice_date }}</td>
                                                    <td>{{ $inv->due_date}}</td>
                                                    <td>{{ $inv->product}}</td>
                                                    <td>
                                                        <a href="{{url('InvoicesDetails')}}/{{ $inv->id }}">
                                                            {{ $inv->section->section_name}}
                                                        </a>
                                                    </td>
                                                    <td>{{ $inv->discount}}</td>
                                                    <td>{{ $inv->rate_vat}}</td>
                                                    <td>{{ $inv->value_vat}}</td>
                                                    <td>{{ $inv->total}}</td>
                                                    <td>
                                                        @if ($inv->value_status == 1)
                                                        <span class="text-success">{{ $inv->status }}</span>
                                                        @elseif($inv->value_status == 2)
                                                        <span class="text-danger">{{ $inv->status }}</span>
                                                        @else
                                                        <span class="text-warning">{{ $inv->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $inv->note}}</td>
                                                    <td>
                                                        <div class="drobdown">
                                                            <button aria-expanded="false"
                                                                aria-haspopup="true"
                                                                class="btn ripple btn-primary btn-sm"
                                                                data-toggle="dropdown"
                                                                id="dropdownMenuButton"
                                                                type="button">Action
                                                                <i class="fas fa-caret-down ml-1">
                                                                </i></button>
                                                            <div  class="dropdown-menu tx-13">
                                                                <a class="dropdown-item"
                                                                    href="{{url('edit_invoice')}}/{{$inv->id}}">
                                                                    Edit Invoice</a>
                                                                    <a class="dropdown-item"
                                                                        href="#"
                                                                        data-invoice_id="{{ $inv->id }}"
                                                                        data-toggle="modal"
                                                                        data-target="#delete_invoice"><i
                                                                        class="text-danger fas fa-trash-alt">
                                                                        </i>&nbsp;&nbsp;Delete Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/div-->

                        <!--div-->
                    </div>
                        <!-- Deleteee -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{ route('invoices.destroy' , 'test') }}" method="post">
                    {{ method_field('post') }}
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                !!??are you sure of the deleting process
                <input type="hidden"
                    name="invoice_id"
                    id="invoice_id"
                    value="">
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">NO</button>
                <button type="submit"
                    class="btn btn-danger">YES</button>
            </div>
            </form>
        </div>
    </div>
</div>
				<!-- row closed -->
                </div>

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>


<script>
$('#delete_invoice').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var invoice_id = button.data('invoice_id')
    var modal = $(this)
    modal.find('.modal-body #invoice_id').val(invoice_id);
})
</script>

@endsection
