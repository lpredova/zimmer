@extends('owner.index')
@section('ownerContent')

<hr>
<h1>Apartments</h1>
<a href="/zimmer-frei/public/owner/apartments/new">New apartment</a>
 <ul>
     <table>
     <thead>
        <tr>
            <th>Naziv</th>
            <th>Adresa</th>
            <th>Telefon</th>
            <th>Email</th>
        </tr>
     </thead>
     @foreach($apartments as $apartment)
         <tr>
            <td>{{$apartment->name}}</td>
            <td>{{$apartment->address}}</td>
            <td>{{$apartment->phone}}</td>
            <td>{{$apartment->email}}</td>
            <td><a href="/zimmer-frei/public/owner/apartments/show/{{$apartment->id}}">Edit</a></td>
         </tr>
     @endforeach
     </table>
 </ul>


@stop