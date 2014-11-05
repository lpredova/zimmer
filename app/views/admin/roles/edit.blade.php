@extends('admin.index')
@section('adminContent')
    <h2>This is editing {{$role->name}} role</h2>

    {{Form::open(array('url'=>'admin/roles/update/'.($role->id),'method'=>'PUT'))}}
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name',($role->name))}}

                    {{Form::submit('Edit role')}}
    {{ Form::close() }}



 {{Form::open(array('url'=>'admin/roles/destroy/'.($role->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}

  @stop