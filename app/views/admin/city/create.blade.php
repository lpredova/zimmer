@extends('admin.index')
@section('adminContent')


    <h2>New city</h2>
    {{Form::open(array('url'=>'admin/city/store','method'=>'POST'))}}
                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name')}}
                    {{$errors->first('name') }}

                    {{ Form::label('lat', 'Latitude') }}
                    {{Form::text('lat')}}
                    {{ $errors->first('lat') }}

                    {{ Form::label('lng', 'Longitude') }}
                    {{Form::text('lng')}}
                    {{ $errors->first('lng') }}

                    {{ Form::label('country', 'Country') }}
                    {{Form::select('country',$country, 'key', array('class' => 'name'));}}

                    {{Form::submit('Add city')}}
            {{ Form::close() }}
  @stop