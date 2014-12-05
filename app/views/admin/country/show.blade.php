@extends('admin.index')
@section('adminContent')


    <h2>Details of {{$country->name}}</h2>
       <a href="admin/countries/edit/{{$country->id}}">Edit</a>
       <h4>Name : {{$country->name}}</h4>

  @stop