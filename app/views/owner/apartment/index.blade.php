@extends('owner.index')
@section('ownerContent')
<div class="row">
    <div class="col-lg-10"><h1>My Apartments</h1></div>
    <div class="col-lg-2">
        <div class="btn btn-success "><a class="btn-white" href="/owner/apartments/new">Add new</a></div>
    </div>
</div>

<hr>
<table class="datatables table">
            <thead>
                <tr>
                    <th>{{{ Lang::get('Owner/Apartments/table.name') }}}</th>
                    <th>{{{ Lang::get('Owner/Apartments/table.address') }}}</th>
                    <th>{{{ Lang::get('Owner/Apartments/table.owner') }}}</th>
                    <th>{{{ Lang::get('Owner/Apartments/table.price') }}}</th>
                    <th>{{{ Lang::get('Owner/Apartments/table.edit') }}}</th>
                </tr>
            </thead>
        </table>

@stop

@extends('owner.include.footer')
    @section('runnableScript')
        <script>
        console.log('calling inti datatabless')
            var oTable = initDatatables($('.datatables'), "{{ URL::to('owner/apartments/data') }}");
        </script>
	@overwrite
@stop
