@extends('admin.index')
@section('adminContent')
    <h2>Admin profile</h2>

    {{Form::open(array('url'=>'admin/profile/update','method'=>'PUT'))}}


                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',(Auth::user()->name))}}
                    {{$errors->first('name')}}

                    {{Form::label('surname', 'Surname') }}
                    {{Form::text('surname',(Auth::user()->surname))}}
                    {{ $errors->first('surname') }}

                    {{Form::label('username', 'Username') }}
                    {{Form::text('username',(Auth::user()->username))}}
                    {{ $errors->first('username') }}

                    {{Form::label('password', 'Password') }}
                    {{Form::text('password',(Auth::user()->password))}}
                    {{ $errors->first('password') }}

                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email',(Auth::user()->email))}}
                    {{$errors->first('email') }}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone',(Auth::user()->phone))}}
                    {{ $errors->first('phone')}}

                    {{Form::submit('Save')}}
    {{ Form::close() }}

  @stop