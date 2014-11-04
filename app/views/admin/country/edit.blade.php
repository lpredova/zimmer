@extends('admin.index')
@section('adminContent')
    <h2>Editing {{$country->name}}</h2>

    {{Form::open(array('url'=>'admin/countries/update/'.($country->id),'method'=>'PUT'))}}

                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($country->name))}}
                    {{ $errors->first('name') }}

                    {{Form::submit('Update country')}}
    {{ Form::close() }}

 {{Form::open(array('url'=>'admin/countries/destroy/'.($country->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}

  @stop