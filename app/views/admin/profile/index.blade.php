@extends('admin.index')
@section('adminContent')


<div class="content">
    <div class="col-lg-12">
        <h1>Profile owerview</h1>
        <hr>

        <a href="admin/profile/edit">Edit</a>
                <h4><img class="img-circle" src="{{$admin->avatar}}"></h4>
               <h4>Name    :{{($admin->name)}}</h4>
               <h4>Surname    :{{($admin->surname)}}</h4>
               <h4>Username    :{{($admin->username)}}</h4>
               <h4>Email    :{{($admin->email)}}</h4>
    </div>
</div>

@stop