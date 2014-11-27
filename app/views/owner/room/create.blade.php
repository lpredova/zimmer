@extends('owner.index')
@section('ownerContent')

    <h2>Adding new room</h2>
    {{Form::open(array('url'=>'owner/room/store','method'=>'POST'))}}

                     {{ Form::label('apartment', 'Apartment') }}
                     {{Form::select('apartment',$apartments, 'key', array('class' => 'name'));}}

                     {{Form::label('name', 'Name of the room') }}
                     {{Form::text('name')}}
                     {{ $errors->first('name') }}

                     {{ Form::label('capacity', 'Capacity') }}
                     {{Form::text('capacity')}}
                     {{ $errors->first('capacity') }}

                     {{Form::label('stars', 'Stars') }}
                     {{Form::text('stars')}}
                     {{ $errors->first('stars') }}

                      {{Form::label('price', 'Price') }}
                      {{Form::text('price')}}
                      {{ $errors->first('price') }}

                     {{ Form::label('description', 'Description') }}
                     {{Form::text('description')}}
                     {{$errors->first('description')}}

                    {{Form::submit('Create Room')}}
            {{ Form::close() }}
  @stop
  @stop