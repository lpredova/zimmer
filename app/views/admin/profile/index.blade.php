@extends('admin.index')
@section('adminContent')


<hr>
<h1>User profile owerview</h1>
  <a href="/zimmer-frei/public/admin/profile/edit">Edit</a>
               <h4>Name    :{{($admin->name)}}</h4>
               <h4>Surname    :{{($admin->surname)}}</h4>
               <h4>Username    :{{($admin->username)}}</h4>
               <h4>Email    :{{($admin->email)}}</h4>
@stop