@extends('admin.index')
@section('adminContent')


    <h2>This is showing {{$role->name}} role</h2>
    <a href="admin/roles/edit/{{$role->id}}">Edit</a>

    <h4>Role :{{($role->name)}}</h4>

  @stop