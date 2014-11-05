@extends('admin.index')
@section('adminContent')
    <h2>Editing {{$user->name}}{{$user->surname}} </h2>

    {{Form::open(array('url'=>'/admin/users/update/'.($user->id),'method'=>'PUT'))}}

                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($user->name))}}
                    {{ $errors->first('name') }}

                    {{ Form::label('surname', 'Surname') }}
                    {{Form::text('surname',($user->surname))}}
                    {{ $errors->first('surname') }}

                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email',($user->email))}}
                    {{ $errors->first('email') }}

                    {{Form::label('username', 'Username') }}
                    {{Form::text('username',($user->username))}}
                    {{ $errors->first('username') }}

                    {{ Form::label('password', 'Password') }}
                    {{Form::password('password')}}
                    {{ $errors->first('password')}}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone',($user->phone))}}
                    {{ $errors->first('phone') }}


                    {{ Form::label('role', 'Role') }}
                    {{Form::select('role',$roles,($user->role_id), array('class' => 'name'));}}

                    {{Form::submit('Update user')}}
    {{ Form::close() }}

 {{Form::open(array('url'=>'/admin/users/destroy/'.($user->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}

  @stop