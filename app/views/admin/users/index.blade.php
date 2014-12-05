@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>Users</h1></div>
    <div class="col-lg-2">
        <div class="btn btn-success ">
            <a class="btn-white" href="/admin/users/new">Add new</a>
        </div>
    </div>
</div>

<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Users/table.id') }}}</th>
                    <th>{{{ Lang::get('Admin/Users/table.name') }}}</th>
                    <th>{{{ Lang::get('Admin/Users/table.surname') }}}</th>
                    <th>{{{ Lang::get('Admin/Users/table.username') }}}</th>
                    <th>{{{ Lang::get('Admin/Users/table.email') }}}</th>
                    <th>{{{ Lang::get('Admin/Users/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
        console.log('calling inti datatabless')
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/users/data') }}");
        </script>
	@overwrite
@stop
