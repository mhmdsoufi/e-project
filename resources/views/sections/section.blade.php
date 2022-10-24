@extends('layouts.master')

@section('title')
    Sections
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

//Modal
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Settings</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Sections</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    @if (session()->has('Success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Success') }}</strong>
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session()->has('Error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Error') }}</strong>
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(session()->has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('edit') }}</strong>
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div id="success_message"></div>
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                @can('Add Section')
                                    <a class="modal-effect btn btn-outline-primary "
                                        data-effect="effect-scale"
                                        data-toggle="modal"
                                        href="#exampleModal2">Add Section</a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <div  class="example table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">section name</th>
                                                <th class="border-bottom-0">Description</th>
                                                <th class="border-bottom-0">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0 ?>
                                            @foreach ($sections as $sec)
                                            <?php $i++ ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{$sec->section_name}}</td>
                                                <td>{{ $sec->description }}</td>
                                                <td>
                                                    @can('Edit Section')
                                                        <a class="modal-effect btn btn-sm btn-info"
                                                            data-effect="effect-scale"
                                                            data-id="{{ $sec->id }}"
                                                            data-section_name="{{ $sec->section_name }}"
                                                            data-description="{{ $sec->description }}"
                                                            data-toggle="modal" href="#exampleModal2"
                                                            title="edit">
                                                            <i class="las la-pen"></i>
                                                        </a>
                                                    @endcan
                                                    @can('Delete Section')
                                                        <a class="modal-effect btn btn-sm btn-danger"
                                                            data-effect="effect-scale"
                                                            data-id="{{ $sec->id }}"
                                                            data-section_name="{{ $sec->section_name }}"
                                                            data-toggle="modal"
                                                            href="#modaldemo9"
                                                            title="delete">
                                                            <i class="las la-trash"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Basic modal
                        <div class="modal" id="modaldemo8">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Add Section</h6>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="" method="post">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for=""> Section Name </label>
                                                <input type="text"
                                                    class="form-control"
                                                    id="section_name"
                                                    name="section_name"
                                                    required=true >
                                            </div>

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
                        End Basic modal -->
                    </div>
				<!-- row closed -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form  autocomplete="off">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input class="id" type="hidden" name="id" id="id" value="">
                                                <label for="recipient-name" class="col-form-label">Section Name</label>
                                                <input class="sectionname form-control" name="section_name" id="section_name" type="text" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Descriptipn</label>
                                                <textarea class="description form-control" id="description" name="description"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="reload add_section btn btn-primary"> Submit </button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- delete -->
                    <div class="modal" id="modaldemo9">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Section</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                    type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="sections/destroy" method="post">
                                    {{method_field('post')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p style="font-size:25px;color:crimson"  >!!??are you sure of the deleting process</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="section_name" id="section_name" type="text" readonly="true">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                        <button type="submit" class="btn btn-danger"> YES </button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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

//Modal
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
    })
</script>
<script>
    $(document).ready(function(){

        $(document).on('click', '.add_section', function (e) {
            e.preventDefault();

            var data = {
                'id':$('.id').val(),
                'section_name':$('.sectionname').val(),
                'description':$('.description').val(),
            }

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/sections/update",
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response.status==200){
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#exampleModal2').modal('hide');
                        $('#exampleModal2').find('input').val("");
                    }
                    console.log(response);
                }
            });
            $('.example').load(location.href+" .example");
        });
    });
</script>


@endsection
