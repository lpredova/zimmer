@extends('admin.index')
@section('adminContent')
    <h2>Editing {{$apartment_types->name}} </h2>

    {{Form::open(array('url'=>'admin/apartment_types/update/'.($apartment_types->id),'method'=>'PUT'))}}

                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($apartment_types->name))}}
                    {{ $errors->first('name') }}

                    {{Form::submit('Update type')}}
    {{ Form::close() }}

 {{Form::open(array('url'=>'admin/apartment_types/destroy/'.($apartment_types->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}

  @stop