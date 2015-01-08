@extends('admin.index')
@section('adminContent')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Editing {{$apartment->name}} </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">

                {{Form::open(array('url'=>'admin/apartments/update/'.($apartment->id),'method'=>'PUT'))}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            {{Form::label('owner', 'Owner') }}
                            {{Form::select('owner',$owners, $apartment->owner_id, array('class' => 'name'));}}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('type', 'Type') }}
                            {{Form::select('type',$types, $apartment->type_id, array('class' => 'name'));}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('city', 'City') }}
                            {{Form::select('city',$cities, $apartment->city_id, array('class' => 'name'));}}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    {{Form::label('active', 'Active') }}
                    {{Form::checkbox('active',1,Input::old('active',$apartment->active),array('class' => 'checkbox check-prim'))}}
                    {{ $errors->first('active') }}
                </div>
                <div class="col-md-6">
                    {{Form::label('special', 'Special offer') }}
                    {{Form::checkbox('special',1,Input::old('special',$apartment->special),array('class' => 'checkbox check-prim'))}}
                    {{ $errors->first('special') }}
                </div>

                <div class="col-md-12">

                    {{ Form::label('name', 'Name')}}
                    {{Form::text('name',($apartment->name),array('class' => 'form-control'))}}
                    {{$errors->first('name')}}

                    {{Form::label('description', 'Description') }}
                    {{Form::text('description',($apartment->description),array('class' => 'form-control'))}}
                    {{ $errors->first('description') }}

                    {{Form::label('address', 'address') }}
                    {{Form::text('address',($apartment->address),array('class' => 'form-control'))}}
                    {{ $errors->first('address') }}

                    {{Form::label('capacity', 'Capacity') }}
                    {{Form::text('capacity',($apartment->capacity),array('class' => 'form-control'))}}
                    {{ $errors->first('capacity') }}

                    {{ Form::label('email', 'Email') }}
                    {{Form::email('email',($apartment->email),array('class' => 'form-control'))}}
                    {{$errors->first('email') }}

                    {{ Form::label('phone', 'Phone') }}
                    {{Form::text('phone',($apartment->phone),array('class' => 'form-control'))}}
                    {{ $errors->first('phone')}}

                    {{ Form::label('phone_2', 'Phone') }}
                    {{Form::text('phone_2',($apartment->phone_2),array('class' => 'form-control'))}}
                    {{ $errors->first('phone_2')}}

                    {{Form::label('lat', 'Lat') }}
                    {{Form::text('lat',($apartment->lat),array('class' => 'form-control'))}}
                    {{ $errors->first('lat') }}

                    {{Form::label('lng', 'Lng') }}
                    {{Form::text('lng',($apartment->lng),array('class' => 'form-control'))}}
                    {{ $errors->first('lng') }}


                    {{Form::submit('Update',array('class' => 'submit-btn btn btn-large btn-primary col-md-12'))}}
                    {{ Form::close() }}
                </div>
            </div>
            <div class="pull-right">{{Form::open(array('url'=>'admin/apartments/destroy/'.($apartment->id),'method'=>'DELETE'))}}
                {{Form::submit('Delete',array('class' => 'btn btn-large btn-alert'))}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop