  @extends('master')

  @section('content')
    <h2>This will be login page</h2>


        {{Form::open(array('url'=>'/login/','method'=>'POST'))}}
                {{ Form::text('username') }}
                {{ Form::password('password') }}
                {{ Form::submit('Login') }}
        {{ Form::close() }}

  @stop