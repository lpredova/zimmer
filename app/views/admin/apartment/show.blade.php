@extends('admin.index')
@section('adminContent')


    <h2>Details {{$apartment->name}}</h2>
       <a href="/zimmer-frei/public/admin/apartments/edit/{{$apartment->id}}">Edit</a>
       <a href="/zimmer-frei/public/admin/pictures/new/">Add pictures</a>

       <h4>Name    :{{($apartment->name)}}</h4>
       <h4>Description :{{($apartment->description)}}</h4>
       <h4>Capacity :{{($apartment->capacity)}}</h4>
       <h4>Address   :{{($apartment->address)}}</h4>
       <h4>Email   :{{($apartment->email)}}</h4>
       <h4>Phone   :{{($apartment->phone)}}</h4>
       <h4>Phone no2   :{{($apartment->phone_2)}}</h4>
       <h4>Rating   :{{($apartment->rating)}}</h4>
       <h4>Lat   :{{($apartment->lat)}}</h4>
       <h4>Lng   :{{($apartment->lng)}}</h4>
       <h4>Owner   :{{($apartment->owner_id)}}</h4>
       <h4>Country   :{{($apartment->country_id)}}</h4>
  @stop