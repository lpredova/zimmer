@extends('admin.index')
@section('adminContent')

     @foreach($city as $c)

    <h2>Editing {{$c->name}}{{$c->surname}} </h2>

    {{Form::open(array('url'=>'admin/city/update/'.($c->id),'method'=>'PUT'))}}

                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($c->name))}}
                    {{ $errors->first('name') }}

                    {{ Form::label('lat', 'Latitude') }}
                    {{Form::text('lat',($c->lat))}}
                    {{ $errors->first('lat') }}

                    {{ Form::label('lng', 'Longitude') }}
                    {{Form::text('lng',($c->lng))}}
                    {{ $errors->first('lng') }}

                    {{ Form::label('country', 'County') }}
                    {{Form::select('country',$country,($c->county_id), array('class' => 'name'));}}

                    {{Form::submit('Update city')}}
    {{ Form::close() }}

 {{Form::open(array('url'=>'admin/city/destroy/'.($c->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}
    @endforeach

  @stop