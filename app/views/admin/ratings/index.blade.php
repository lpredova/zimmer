@extends('admin.index')
@section('adminContent')
    <div class="row">
        <div class="col-lg-12"><h1>Ratings</h1></div>
    </div>

    <hr>
    <table class="datatables table">
        <thead>
        <tr>
            <th>{{{ Lang::get('Admin/Ratings/table.user') }}}</th>
            <th>{{{ Lang::get('Admin/Ratings/table.apartment') }}}</th>
            <th>{{{ Lang::get('Admin/Ratings/table.rating') }}}</th>
            <th>{{{ Lang::get('Admin/Ratings/table.edit') }}}</th>
        </tr>
        </thead>
    </table>

@stop

@extends('admin.includes.footer')
@section('runnableScript')
    <script>
        var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/ratings/data') }}");
    </script>
@overwrite
@stop