@extends('admin.index')
@section('adminContent')

<h1>Pictures</h1>
<a href="admin/pictures/new">New picture</a>
 <ul>
     <table>
     @foreach($pictures as $picture)
         <tr>
            <td>{{$picture->title}}</td>
            <td><img src='{{$picture->url}}' alt="apartment_picture"></td>
            <td><a href="admin/pictures/show/{{$picture->id}}">Edit</a></td>
         </tr>
     @endforeach
     </table>
 </ul>

@if(Session::has('success'))
    <div class="alert-box success">
        <h2>{{ Session::get('success') }}</h2>
    </div>
@endif

@stop