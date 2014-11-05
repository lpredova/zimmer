@extends('admin.index')
@section('adminContent')

<h1>Roles</h1>
<a href="/zimmer-frei/public/admin/roles/new">New role</a>
 <ul>
     <table>
     @foreach($roles as $role)
         <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td><a href="/zimmer-frei/public/admin/roles/show/{{$role->id}}">Edit</a></td>
         </tr>
     @endforeach
     </table>
 </ul>


@stop