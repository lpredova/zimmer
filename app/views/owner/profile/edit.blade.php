@extends('owner.index')
@section('ownerContent')
    <h2>My user profile</h2>

    {{Form::open(array('url'=>'owner/profile/update','method'=>'PUT'))}}


                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($user->name))}}
                    {{$errors->first('name')}}

                    {{Form::label('surname', 'Surname') }}
                    {{Form::text('surname',($user->surname))}}
                    {{ $errors->first('surname') }}

                    {{Form::label('username', 'Username') }}
                    {{Form::text('username',($user->username))}}
                    {{ $errors->first('username') }}

                    {{Form::label('password', 'Password') }}
                    {{Form::text('password',($user->password))}}
                    {{ $errors->first('password') }}

                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email',($user->email))}}
                    {{$errors->first('email') }}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone',($user->phone))}}
                    {{ $errors->first('phone')}}

                    {{Form::submit('Save')}}
    {{ Form::close() }}

  @stop