@extends('owner.index')
@section('ownerContent')

    @foreach($room as $r)
            <h2>Editing {{$r->name}} </h2>

            {{Form::open(array('url'=>'owner/room/update/'.($r->id),'method'=>'PUT'))}}

                            {{ Form::label('apartment', 'Apartment') }}
                            {{Form::select('apartment',$apartments, $r->apartment_id, array('class' => 'name'));}}


                            {{ Form::label('name', 'Name') }}
                            {{Form::text('name',($r->name))}}
                            {{$errors->first('name')}}

                            {{Form::label('capacity', 'Capacity') }}
                            {{Form::text('capacity',($r->capacity))}}
                            {{ $errors->first('capacity') }}

                            {{ Form::label('stars', 'Stars') }}
                            {{Form::text('stars',($r->stars))}}
                            {{$errors->first('stars') }}

                            {{Form::label('price', 'Price') }}
                            {{Form::text('price',($r->price))}}
                            {{ $errors->first('price') }}

                            {{Form::label('description', 'Description') }}
                            {{Form::text('description',($r->description))}}
                            {{ $errors->first('description') }}

                            {{Form::submit('Update room')}}
            {{ Form::close() }}

            {{Form::open(array('url'=>'owner/room/destroy/'.($r->id),'method'=>'DELETE'))}}
                            {{Form::submit('Delete')}}
            {{ Form::close() }}
    @endforeach

  @stop