@extends('admin.index')
@section('adminContent')


<div class="content">
    <div class="col-lg-12">
        <h1>Profile owerview</h1>
        <hr>

        <a href="profile/edit">Edit</a>
                <h4><img class="img-circle" src="{{Auth::user()->avatar}}"></h4>
               <h4>Name    :{{(Auth::user()->name)}}</h4>
               <h4>Surname    :{{(Auth::user()->surname)}}</h4>
               <h4>Username    :{{(Auth::user()->username)}}</h4>
               <h4>Email    :{{(Auth::user()->email)}}</h4>
    </div>
</div>

@stop