@extends('admin.index')
@section('adminContent')
<h1>Users</h1>
<a href="/zimmer-frei/public/admin/users/new">New user</a>
 <ul>
     <table>
     @foreach($users as $user)
         <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td><img src='{{$user->avatar}}' alt="user_avatar"></td>
            <td><a href="/zimmer-frei/public/admin/users/show/{{$user->id}}">Edit</a></td>
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

