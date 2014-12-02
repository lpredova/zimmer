@extends('admin.index')
@section('adminContent')


    <h2>New fitting</h2>
    {{Form::open(array('url'=>'admin/fitting/store','method'=>'POST'))}}
                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name')}}
                    {{$errors->first('name') }}

                    {{ Form::label('description', 'Description') }}
                    {{Form::text('description')}}
                    {{ $errors->first('description') }}

                    {{ Form::label('icon', 'Icon') }}
                    {{Form::text('icon')}}
                    {{ $errors->first('icon') }}

                    {{Form::submit('Add fitting')}}
            {{ Form::close() }}
  @stop