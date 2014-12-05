@extends('admin.index')
@section('adminContent')


        @foreach($pictures as $picture)

                Title : {{$picture->title}}
                Image: <img src='{{$picture->url}}' alt="apartment_picture">
                <a href="/pictures/edit/{{$picture->id}}">Edit</a>


         @endforeach
  @stop