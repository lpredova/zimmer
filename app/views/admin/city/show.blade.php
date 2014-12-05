
@extends('admin.index')
@section('adminContent')


 <ul>
     <table>
     @foreach($city as $c)
     <h1>City {{$c->name}}</h1>
     <a href="admin/city/edit/{{$c->id}}">Edit city</a>

            Name : {{$c->name}}
            <br>
            Lat :{{$c->lat}}
                        <br>

            Lng : {{$c->lng}}
                        <br>

            Country : {{$c->country->name}}
     @endforeach
     </table>
 </ul>

@stop
  @stop