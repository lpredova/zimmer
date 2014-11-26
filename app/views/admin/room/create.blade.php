@extends('admin.index')
@section('adminContent')

    <h2>Adding new room</h2>
    {{Form::open(array('url'=>'admin/apartments/store','method'=>'POST'))}}
    
                     {{ Form::label('owner', 'Owner') }}
                     {{Form::select('owner',$owners, 'key', array('class' => 'name'));}}
                     
                     {{ Form::label('type', 'Type') }}
                     {{Form::select('type',$types, 'key', array('class' => 'name'));}}
                     
                     {{Form::label('country', 'Conutry') }}
                     {{Form::select('country',$countries, 'key', array('class' => 'name'));}}
    
                     {{ Form::label('name', 'Name') }}
                     {{Form::text('name')}}
                     {{$errors->first('name')}}

                     {{Form::label('description', 'Description') }}
                     {{Form::text('description')}}
                     {{ $errors->first('description') }}

                     {{Form::label('address', 'address') }}
                     {{Form::text('address')}}
                     {{ $errors->first('address') }}

                      {{Form::label('capacity', 'Capacity') }}
                      {{Form::text('capacity')}}
                      {{ $errors->first('capacity') }}

                     {{ Form::label('email', 'Email') }}
                     {{Form::text('email')}}
                     {{$errors->first('email') }}


                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone')}}
                     {{ $errors->first('phone')}}
                     
                    {{ Form::label('phone_2', 'Phone') }}
                    {{Form::text('phone_2')}}
                     {{ $errors->first('phone_2')}}

                    {{ Form::label('lat', 'Lat') }}
                    {{Form::text('lat')}}
                    {{ $errors->first('lat') }}
                    
                    {{ Form::label('lng', 'Lng') }}
                    {{Form::text('lng')}}
                    {{ $errors->first('lng') }}


                    {{Form::submit('Create apartment')}}
            {{ Form::close() }}
  @stop