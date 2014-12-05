@extends('admin.index')
@section('adminContent')


Show details

        @foreach($apartment as $a)
            <h2>Details {{$a->name}}</h2>
               <a href="admin/apartments/edit/{{$a->id}}">Edit</a>
               <a href="admin/pictures/new">Add pictures</a>
               <a href="admin/rooms/new">Add rooms</a>

               <h4>Name    :{{($a->name)}}</h4>
               <h4>Description :{{($a->description)}}</h4>
               <h4>Capacity :{{($a->capacity)}}</h4>
               <h4>Address   :{{($a->address)}}</h4>
               <h4>Email   :{{($a->email)}}</h4>
               <h4>Phone   :{{($a->phone)}}</h4>
               <h4>Phone no2   :{{($a->phone_2)}}</h4>
               <h4>Rating   :{{($a->rating)}}</h4>
               <h4>Lat   :{{($a->lat)}}</h4>
               <h4>Lng   :{{($a->lng)}}</h4>
               <h4>Owner   :{{($a->user->username)}}</h4>
               <h4>City   :{{($a->city->name)}}</h4>
       @endforeach
  @stop