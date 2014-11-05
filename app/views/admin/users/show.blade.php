@extends('admin.index')
@section('adminContent')


    <h2>Details {{$user->name}} {{$user->surname}}</h2>
       <a href="/zimmer-frei/public/admin/users/edit/{{$user->id}}">Edit</a>

       <h4>Name    :{{($user->name)}}</h4>
       <h4>Surname :{{($user->surname)}}</h4>
       <h4>Username :{{($user->username)}}</h4>
       <h4>Email   :{{($user->email)}}</h4>
       <h4>Phone   :{{($user->phone)}}</h4>
       <h4>Role   :{{($user->role_id)}}</h4>

  @stop