@extends('admin.index')
@section('adminContent')

    <h2>Add new country</h2>
    {{Form::open(array('url'=>'admin/countries/store','method'=>'POST'))}}
                     {{ Form::label('name', 'Name') }}
                     {{Form::text('name')}}
                      {{ $errors->first('name') }}

                    {{Form::submit('Create new country')}}
            {{ Form::close() }}
  @stop