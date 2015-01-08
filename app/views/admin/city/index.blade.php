@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>City</h1></div>
    <div class="col-lg-2">
        <div class="btn btn-success"><a  class="btn-white" href="city/new">Add new</a></div>
    </div>
</div>
<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Cities/table.name') }}}</th>
                    <th>{{{ Lang::get('Admin/Cities/table.country') }}}</th>
                    <th>{{{ Lang::get('Admin/Cities/table.lat') }}}</th>
                    <th>{{{ Lang::get('Admin/Cities/table.lng') }}}</th>
                    <th>{{{ Lang::get('Admin/Cities/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/city/data') }}");
        </script>
	@overwrite
@stop