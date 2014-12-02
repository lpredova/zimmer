@extends('admin.index')
@section('adminContent')
<div class="col-lg-12">
    <h2>Add apartment type</h2>
    <hr>
    {{Form::open(array('url'=>'admin/apartment_types/store','method'=>'POST'))}}
                     {{ Form::label('name', 'Name') }}
                     {{Form::text('name','',array('class'=>'col-lg-8'))}}
                     {{ $errors->first('name') }}

                    {{Form::submit('Create new type')}}
            {{ Form::close() }}
    </div>
  @stop