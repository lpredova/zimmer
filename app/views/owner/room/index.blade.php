@extends('owner.index')
@section('ownerContent')


<hr>
<h1>My Rooms</h1>
<a href="owner/room/new">New room</a>
 <ul>
     <table>
     <thead>
        <tr>
            <th>Name</th>
            <th>Capacity</th>
            <th>Stars</th>
            <th>Price</th>
        </tr>
     </thead>
     @foreach($rooms as $room)
         <tr>
            <td>{{$room->room_name}}</td>
            <td>{{$room->capacity}}</td>
            <td>{{$room->stars}}</td>
            <td>{{$room->price}}</td>
            <td><a href="owner/room/show/{{$room->id}}">Edit</a></td>
         </tr>
     @endforeach
     </table>
 </ul>

@stop