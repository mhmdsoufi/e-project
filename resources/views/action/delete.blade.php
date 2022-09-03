<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@yield('title')</h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="@yield('url')" method="post">
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
