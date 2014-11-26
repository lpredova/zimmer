@extends('admin.index')
@section('adminContent')
    <h2>Editing {{$apartment->name}} </h2>

    {{Form::open(array('url'=>'admin/apartments/update/'.($apartment->id),'method'=>'PUT'))}}

                    {{ Form::label('owner', 'Owner') }}
                    {{Form::select('owner',$owners, $apartment->owner_id, array('class' => 'name'));}}

                    {{ Form::label('type', 'Type') }}
                    {{Form::select('type',$types, $apartment->type_id, array('class' => 'name'));}}

                    {{Form::label('country', 'Conutry') }}
                    {{Form::select('country',$countries, $apartment->country_id, array('class' => 'name'));}}

                    {{ Form::label('name', 'Name') }}
                    {{Form::text('name',($apartment->name))}}
                    {{$errors->first('name')}}

                    {{Form::label('description', 'Description') }}
                    {{Form::text('description',($apartment->description))}}
                    {{ $errors->first('description') }}

                    {{Form::label('address', 'address') }}
                    {{Form::text('address',($apartment->address))}}
                    {{ $errors->first('address') }}

                    {{Form::label('capacity', 'Capacity') }}
                    {{Form::text('capacity',($apartment->capacity))}}
                    {{ $errors->first('capacity') }}

                    {{ Form::label('email', 'Email') }}
                    {{Form::text('email',($apartment->email))}}
                    {{$errors->first('email') }}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone',($apartment->phone))}}
                    {{ $errors->first('phone')}}

                    {{ Form::label('phone_2', 'Phone') }}
                    {{Form::text('phone_2',($apartment->phone_2))}}
                    {{ $errors->first('phone_2')}}

                    {{Form::label('lat', 'Lat') }}
                    {{Form::text('lat',($apartment->lat))}}
                    {{ $errors->first('lat') }}

                    {{Form::label('lng', 'Lng') }}
                    {{Form::text('lng',($apartment->lng))}}
                    {{ $errors->first('lng') }}

                    {{Form::submit('Update user')}}
    {{ Form::close() }}

 {{Form::open(array('url'=>'admin/apartments/destroy/'.($apartment->id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete')}}
    {{ Form::close() }}

  @stop