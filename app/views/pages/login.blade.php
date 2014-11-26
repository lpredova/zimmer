  @extends('master')

  @section('content')
  <div class="container">
    <h2>This will be login page</h2>


        {{Form::open(array('url'=>'/login','method'=>'POST'))}}
                {{ Form::text('username',Input::old('username'),array('placeholder' => 'username or email')) }}
                 {{ $errors->first('username') }}

                {{ Form::password('password')}}
                {{ $errors->first('password') }}

                {{ Form::submit('Login') }}
        {{ Form::close() }}

        <br>
        <div  style="color: #ffffff">
            <p><b>We hate default passwords !!!</b> But this is special case so your credentials for every type of user are:</p>
            <br>
            <h3>We appologize if some options don't work,this web app is still under heavy construction !!! </h3>

            <h2>admin:admin</h2>
            <h2>owner:owner</h2>
            <h2>user:user123</h2>
        </div>
    </div>

  @stop