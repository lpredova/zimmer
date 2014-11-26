@extends('admin.index')
@section('adminContent')

<h1>Countries avaliable</h1>
<a href="/zimmer-frei/public/admin/countries/new">Add country</a>
<a href="/zimmer-frei/public/admin/city">Cities</a>

 <ul>
     <table>
     @foreach($countries as $country)
         <tr>
            <td>{{$country->name}}</td>
            <td><a href="/zimmer-frei/public/admin/countries/show/{{$country->id}}">Edit</a></td>
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