@extends('admin.index')
@section('adminContent')


<a href="/zimmer-frei/public/admin/apartment_types">Apartment categories</a>

<hr>
<h1>Apartments</h1>
<a href="/zimmer-frei/public/admin/apartments/new">New apartment</a>
 <ul>
     <table>
     <thead>
        <tr>
            <th>Naziv</th>
            <th>Adresa</th>
            <th>Telefon</th>
            <th>Email</th>
            <th>Vlasnik</th>
        </tr>
     </thead>
     @foreach($apartments as $apartment)
         <tr>
            <td>{{$apartment->name}}</td>
            <td>{{$apartment->address}}</td>
            <td>{{$apartment->phone}}</td>
            <td>{{$apartment->email}}</td>
            <td>{{$apartment->user->username}}</td>
            <td><a href="/zimmer-frei/public/admin/apartments/show/{{$apartment->id}}">Edit</a></td>
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