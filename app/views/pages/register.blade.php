  @extends('master')

  @section('content')
    <h2>This will be registration</h2>
    {{Form::open(array('url'=>'signup','method'=>'POST'))}}
                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name')}}
                    
                    {{ Form::label('surname', 'Surname') }}
                    {{Form::text('surname')}}
                    
                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email')}}
                    
                    {{ Form::label('username', 'Userame') }}
                    {{Form::text('username')}}
                    
                    {{ Form::label('name', 'Password') }}
                    {{Form::password('password')}}
                    
                    {{ Form::label('name', 'Confirm Password') }}
                    {{Form::password('confirm_password')}}
                    {{Form::submit('Register me')}}
            {{ Form::close() }}
  @stop