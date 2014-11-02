  @extends('master')

  @section('content')
    <h2>This will be login page</h2>


        {{Form::open(array('url'=>'/login','method'=>'POST'))}}
                {{ Form::text('username',Input::old('username'),array('placeholder' => 'username or password')) }}
                 {{ $errors->first('username') }}

                {{ Form::password('password')}}
                {{ $errors->first('password') }}

                {{ Form::submit('Login') }}
        {{ Form::close() }}

  @stop