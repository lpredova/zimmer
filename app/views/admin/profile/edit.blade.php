@extends('admin.index')
@section('adminContent')
    <h2>Admin profile</h2>

    {{Form::open(array('url'=>'admin/profile/update','method'=>'PUT'))}}


                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($admin->name))}}
                    {{$errors->first('name')}}

                    {{Form::label('surname', 'Surname') }}
                    {{Form::text('surname',($admin->surname))}}
                    {{ $errors->first('surname') }}

                    {{Form::label('username', 'Username') }}
                    {{Form::text('username',($admin->username))}}
                    {{ $errors->first('username') }}

                    {{Form::label('password', 'Password') }}
                    {{Form::text('password',($admin->password))}}
                    {{ $errors->first('password') }}

                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email',($admin->email))}}
                    {{$errors->first('email') }}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone',($admin->phone))}}
                    {{ $errors->first('phone')}}

                    {{Form::submit('Save')}}
    {{ Form::close() }}

  @stop