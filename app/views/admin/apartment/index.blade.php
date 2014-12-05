@extends('admin.index')
@section('adminContent')
<div class="row">
    <div class="col-lg-10"><h1>Users</h1></div>
    <div class="col-lg-2">
        <div class="btn btn-success"><a  class="btn-white" href="apartments/new"></a>Add new</div>
    </div>
</div>
<a href="apartment_types">Apartment categories</a>
<a href="apartments/new">New apartment</a>

<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Admin/Apartments/table.id') }}}</th>
                    <th>{{{ Lang::get('Admin/Apartments/table.name') }}}</th>
                    <th>{{{ Lang::get('Admin/Apartments/table.phone') }}}</th>
                    <th>{{{ Lang::get('Admin/Apartments/table.owner') }}}</th>
                    <th>{{{ Lang::get('Admin/Apartments/table.email') }}}</th>
                    <th>{{{ Lang::get('Admin/Apartments/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('admin.includes.footer')
    @section('runnableScript')
        <script>
        console.log('calling inti datatabless')
            var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/apartments/data') }}");
        </script>
	@overwrite
@stop