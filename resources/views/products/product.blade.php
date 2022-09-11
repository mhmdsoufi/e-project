@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    Products
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Settings</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Products</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    @if (session()->has('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Add') }}</strong>
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session()->has('Edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Edit') }}</strong>
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
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <a class="modal-effect btn btn-outline-primary "
                                data-effect="effect-scale"
                                data-toggle="modal"
                                href="#modaldemo8">Add Product</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">product name</th>
                                                <th class="border-bottom-0">section name</th>
                                                <th class="border-bottom-0">Description</th>
                                                <th class="border-bottom-0">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0 ?>
                                            @foreach ($products as $prod)
                                            <?php $i++ ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{$prod->product_name}}</td>
                                                <td>{{$prod->section->section_name}}</td>
                                                <td>{{ $prod->description }}</td>
                                                <td>
                                                    <button class="btn btn-outline-success btn-sm"
                                                            data-product_name="{{ $prod->product_name }}"
                                                            data-prod_id="{{ $prod->id }}"
                                                            data-section_name="{{ $prod->section->section_name }}"
                                                            data-description="{{ $prod->description }}"
                                                            data-toggle="modal"
                                                            data-target="#edit_product">Edit</button>

                                                    <button class="btn btn-outline-danger btn-sm "
                                                            data-prod_id="{{ $prod->id }}"
                                                            data-product_name="{{ $prod->product_name }}"
                                                            data-toggle="modal"
                                                            data-target="#modaldemo9">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Basic modal -->
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Add Product</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{route('products.store')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for=""> Product Name </label>
                                            <input type="text"
                                                class="form-control"
                                                id="product_name"
                                                name="product_name"
                                                required=true >
                                        </div>
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Section</label>
                                        <select name="section_id" id="section_id" class="form-control" required:"true" >
                                            <option value="" selected disabled> Select Section </option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                            @endforeach
                                        </select>


                                        <div class="form-group">
                                            <label for=""> Descriptipn </label>
                                            <textarea class="form-control"
                                                    id="description"
                                                    name="description"
                                                    rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- End Basic modal -->
                <!-- edit -->
                <div class="modal fade"
                    id="edit_product"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action='products/update' method="post">
                                {{ method_field('post') }}
                                {{ csrf_field() }}
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="title">Product Name</label>

                                        <input type="hidden" class="form-control" name="prod_id" id="prod_id" value="">

                                        <input type="text" class="form-control" name="product_name" id="product_name">
                                    </div>

                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Section</label>
                                    <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
                                        @foreach ($sections as $section)
                                            <option>{{ $section->section_name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <label for="des">Description</label>
                                        <textarea name="description" cols="20" rows="5" id='description'
                                            class="form-control"></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- delete -->
                <div class="modal fade"
                    id="modaldemo9"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Product</h5>
                                <button type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="products/destroy" method="post">
                                {{ method_field('post') }}
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <p style="font-size:25px;color:crimson"  >!!??are you sure of the deleting process</p><br>
                                    <input type="hidden" name="prod_id" id="prod_id" value="">
                                    <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                    <button type="submit" class="btn btn-danger">YES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
				<!-- row closed -->
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
<script>
    $('#edit_product').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var product_name = button.data('product_name')
        var section_name = button.data('section_name')
        var prod_id = button.data('prod_id')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #product_name').val(product_name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #prod_id').val(prod_id);
    })


    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var prod_id = button.data('prod_id')
        var product_name = button.data('product_name')
        var modal = $(this)

        modal.find('.modal-body #prod_id').val(prod_id);
        modal.find('.modal-body #product_name').val(product_name);
    })

</script>
@endsection
