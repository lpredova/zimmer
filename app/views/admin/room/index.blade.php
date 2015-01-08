@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>Rooms</h1></div>
    <div class="col-lg-2">
        <div class="btn btn-success "><a class="btn-white" href="/admin/rooms/new">Add new</a></div>
    </div>
</div>

<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Rooms/table.name') }}}</th>
                    <th>{{{ Lang::get('Admin/Rooms/table.capacity') }}}</th>
                    <th>{{{ Lang::get('Admin/Rooms/table.stars') }}}</th>
                    <th>{{{ Lang::get('Admin/Rooms/table.price') }}}</th>
                    <th>{{{ Lang::get('Admin/Rooms/table.owner') }}}</th>
                    <th>{{{ Lang::get('Admin/Rooms/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/rooms/data') }}");
        </script>
	@overwrite
@stop
