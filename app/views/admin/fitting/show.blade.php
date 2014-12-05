
@extends('admin.index')
@section('adminContent')


 <ul>
     <table>
     @foreach($fitting as $f)
     <h1>{{$f->name}}</h1>
     <a href="admin/fitting/edit/{{$f->id}}">Edit Fitting</a>

            <br>
            Name : {{$f->name}}
            <br>
            Description :{{$f->description}}
                        <br>
           Icon : {{$f->icon}}
     </table>
     @endforeach
 </ul>

@stop
  @stop