  @extends('master')

  @section('content')
    <h2>Registration form owner</h2>


    <h3><a href="/signup">Looking for palce to stay ?</a></h3>

    {{Form::open(array('url'=>'/register/owner','method'=>'POST'))}}
                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name')}}

                    {{ Form::label('surname', 'Surname') }}
                    {{Form::text('surname')}}

                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email')}}

                    {{ Form::label('username', 'Username') }}
                    {{Form::text('username')}}

                    {{ Form::label('password', 'Password') }}
                    {{Form::password('password')}}

                    {{ Form::label('confirm_password', 'Confirm Password') }}
                    {{Form::password('confirm_password')}}


                    {{Form::submit('Register me')}}
            {{ Form::close() }}
  @stop