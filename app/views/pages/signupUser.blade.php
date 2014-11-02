  @extends('master')

  @section('content')
    <h2>Registration form user</h2>


    <h3><a href="signup/owner">Trying to rent your aparment ?</a></h3>
    
    {{Form::open(array('url'=>'/register/user','method'=>'POST'))}}
                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name')}}
                    {{ $errors->first('name') }}
                    
                    {{ Form::label('surname', 'Surname') }}
                    {{Form::text('surname')}}
                    {{ $errors->first('surname') }}
                    
                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email')}}
                    {{ $errors->first('email') }}
                    
                    {{ Form::label('username', 'Username') }}
                    {{Form::text('username')}}
                    {{ $errors->first('username') }}
                    
                    {{ Form::label('password', 'Password') }}
                    {{Form::password('password')}}
                    {{ $errors->first('password') }}
                    
                    {{ Form::label('confirm_password', 'Confirm Password') }}
                    {{Form::password('confirm_password')}}


                    {{Form::submit('Register me')}}
            {{ Form::close() }}
  @stop