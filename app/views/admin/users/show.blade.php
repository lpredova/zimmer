@extends('admin.index')
@section('adminContent')

    @foreach($user as $u)

       <h2>Details {{$u->name}} {{$u->surname}}</h2>
                  <a href="admin/users/edit/{{$u->id}}">Edit</a>

                  <h4>Name    :{{$u->name}}</h4>
                  <h4>Surname :{{($u->surname)}}</h4>
                  <h4>Username :{{($u->username)}}</h4>
                  <h4>Email   :{{($u->email)}}</h4>
                  <h4>Phone   :{{($u->phone)}}</h4>
                  <h4>Role   :{{$u->role->name}}</h4>
    @endforeach



  @stop