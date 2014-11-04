@extends('admin.index')
@section('adminContent')

    <h2>This is creating apartment type</h2>
    {{Form::open(array('url'=>'admin/apartment_types/store','method'=>'POST'))}}
                     {{ Form::label('name', 'Name') }}
                     {{Form::text('name')}}
                      {{ $errors->first('name') }}

                    {{Form::submit('Create new type')}}
            {{ Form::close() }}
  @stop