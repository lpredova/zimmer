@extends('admin.index')
@section('adminContent')


<hr>
<h1>Rooms</h1>
<a href="/zimmer-frei/public/admin/rooms/new">Add room</a>
     <table>
     <thead>
        <tr>
            <th>Title</th>
            <th>Capacity</th>
            <th>Stars</th>
            <th>Email</th>
            <th>Price (Ojra)</th>
            <th>Owner</th>
        </tr>
     </thead>
     @foreach($rooms as $room)
         <tr>
            <td>{{$room->name}}</td>
            <td>{{$room->capacity}}</td>
            <td>{{$room->stars}}</td>
            <td>{{$room->description}}</td>
            <td>{{$room->price}}</td>
            <td>{{$room->apartment->name}}</td>
            <td><a href="/zimmer-frei/public/admin/rooms/show/{{$room->id}}">Edit</a></td>
         </tr>
     @endforeach
     </table>

@stop