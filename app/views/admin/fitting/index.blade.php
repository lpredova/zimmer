@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>Fittings</h1></div>
    <div class="col-lg-2">
        <div class="btn btn-success"><a  class="btn-white" href="fitting/new">Add new</a></div>
    </div>
</div>
<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Fittings/table.name') }}}</th>
                    <th>{{{ Lang::get('Admin/Fittings/table.icon') }}}</th>
                    <th>{{{ Lang::get('Admin/Fittings/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/fitting/data') }}");
        </script>
	@overwrite
@stop