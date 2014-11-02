@extends('admin.index')
@section('adminContent')

    <h2>This is new role adding</h2>
    {{Form::open(array('url'=>'admin/roles/store','method'=>'POST'))}}
                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name')}}

                    {{Form::submit('Create role')}}
            {{ Form::close() }}
  @stop