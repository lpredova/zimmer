@extends('admin.index')
@section('adminContent')

<h1>Countries avaliable</h1>
<a href="countries/new">Add country</a>
<a href="city">Cities</a>

 <ul>
     <table>
     @foreach($countries as $country)
         <tr>
            <td>{{$country->name}}</td>
            <td><a href="countries/show/{{$country->id}}">Edit</a></td>
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