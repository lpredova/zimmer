@extends('admin.index')
@section('adminContent')

    <h2>Editing {{$fitting->name}}</h2>

    {{Form::open(array('url'=>'admin/fitting/update/'.($fitting->id),'method'=>'PUT'))}}

                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($fitting->name))}}
                    {{ $errors->first('name') }}

                    {{ Form::label('description', 'Description') }}
                    {{Form::text('description',($fitting->description))}}
                    {{ $errors->first('lat') }}

                    {{ Form::label('icon', 'Icon') }}
                    {{Form::text('icon',($fitting->icon))}}
                    {{ $errors->first('icon') }}

                    {{Form::submit('Update fitting')}}
    {{ Form::close() }}

 {{Form::open(array('url'=>'admin/fitting/destroy/'.($fitting->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}

  @stop