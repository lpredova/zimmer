@extends('admin.index')
@section('adminContent')


Show details about room

        @foreach($room as $r)
            <h2>Details {{$r->name}}</h2>
               <a href="admin/rooms/edit/{{$r->id}}">Edit</a>
               <a href="admin/rooms/new/">Add pictures</a>
        
               <h4>Name of the room :{{($r->name)}}</h4>
               <h4>Description :{{($r->description)}}</h4>
               <h4>Capacity :{{($r->capacity)}}</h4>
               <h4>Stars :{{($r->stars)}}</h4>
               <h4>Price :{{($r->price)}}</h4>
               <h4>Apartment   :{{($r->apartment->name)}}</h4>
       @endforeach
  @stop