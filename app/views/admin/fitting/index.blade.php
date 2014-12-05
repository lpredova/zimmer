@extends('admin.index')
@section('adminContent')

<h1>Fitting</h1>
<a href="admin/fitting/new">New fitting</a>
 <ul>
     <table>
     @foreach($fittings as $fitting)
         <tr>
            <td>{{$fitting->name}}</td>
            <td>{{$fitting->icon}}</td>
            <td><a href="admin/fitting/show/{{$fitting->id}}">Edit fitting</a></td>
         </tr>
     @endforeach
     </table>
 </ul>

@stop