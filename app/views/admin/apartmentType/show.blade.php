@extends('admin.index')
@section('adminContent')


    <h2>Type details</h2>
       <a href="/zimmer-frei/public/admin/apartment_types/edit/{{$apartment_types->id}}">Edit</a>
       <h4>Name    :{{($apartment_types->name)}}</h4>

  @stop