@extends('admin.index')
@section('adminContent')

<h1>Users</h1>
<a href="admin/city/new">New city</a>
 <ul>
     <table>
     @foreach($city as $c)
         <tr>
            <td>{{$c->name}}</td>
            <td>{{$c->lat}}</td>
            <td>{{$c->lng}}</td>
            <td>{{$c->country->name}}</td>
            <td><a href="admin/city/show/{{$c->id}}">Edit city</a></td>
         </tr>
     @endforeach
     </table>
 </ul>

@stop