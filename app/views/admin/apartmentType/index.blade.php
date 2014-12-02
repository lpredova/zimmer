@extends('admin.index')
@section('adminContent')

<div class="col-lg-12">
<h1>Apartment types</h1>
        <a href="/zimmer-frei/public/admin/apartment_types/new">New type</a>
        <hr>
         <ul>
             <table>
             @foreach($apartment_types as $type)
                 <tr>
                    <td>{{$type->name}}</td>
                    <td><a href="/zimmer-frei/public/admin/apartment_types/show/{{$type->id}}">Edit</a></td>
                 </tr>
             @endforeach
             </table>
         </ul>
            @if(Session::has('success'))
                <div class="alert-box success">
                    <h2>{{ Session::get('success') }}</h2>
                </div>
            @endif
</div>
@stop