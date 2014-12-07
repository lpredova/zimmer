@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>Roles</h1></div>
    <div class="col-lg-2">
        <a class="btn-white btn btn-success" href="roles/new">Add new role</a>
    </div>
</div>
<a href="apartment_types">Apartment categories</a>
<a href="apartments/new">New apartment</a>

<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Roles/table.id') }}}</th>
                    <th>{{{ Lang::get('Admin/Roles/table.name') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
        console.log('calling inti datatabless')
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/roles/data') }}");
        </script>
	@overwrite
@stop