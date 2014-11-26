@extends('admin.index')
@section('adminContent')




    <h2>This is adding new picture for apartment</h2>
    {{Form::open(array('url'=>'admin/pictures/store','method'=>'POST'))}}
                     {{ Form::label('name', 'Name') }}
                     {{Form::text('name')}}
                      {{ $errors->first('name') }}


                    {{Form::submit('Add picture')}}
            {{ Form::close() }}
  @stop