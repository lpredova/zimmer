@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>Comments</h1></div>
</div>

<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Favorites/table.user') }}}</th>
                    <th>{{{ Lang::get('Admin/Favorites/table.apartment') }}}</th>
                    <th>{{{ Lang::get('Admin/Favorites/table.comment') }}}</th>
                    <th>{{{ Lang::get('Admin/Favorites/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/favorites/data') }}");
        </script>
	@overwrite
@stop