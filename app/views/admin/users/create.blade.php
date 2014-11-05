@extends('admin.index')
@section('adminContent')




    <h2>This is creating new user</h2>
    {{Form::open(array('url'=>'/admin/users/store','method'=>'POST'))}}
                     {{ Form::label('name', 'Name') }}
                     {{Form::text('name')}}
                      {{ $errors->first('name') }}

                     {{ Form::label('surname', 'Surname') }}
                     {{Form::text('surname')}}
                      {{ $errors->first('surname') }}

                     {{ Form::label('email', 'Email') }}
                     {{Form::text('email')}}
                      {{ $errors->first('email') }}

                     {{Form::label('username', 'Username') }}
                     {{Form::text('username')}}
                      {{ $errors->first('username') }}

                    {{ Form::label('password', 'Password') }}
                    {{Form::password('password')}}
                     {{ $errors->first('password')}}

                    {{Form::label('confirm_password', 'Confirm Password') }}
                    {{Form::password('confirm_password')}}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone')}}
                    {{ $errors->first('phone') }}


                    {{ Form::label('role', 'Role') }}
                    {{Form::select('role',$roles, 'key', array('class' => 'name'));}}

                    {{Form::submit('Create new user')}}
            {{ Form::close() }}
  @stop