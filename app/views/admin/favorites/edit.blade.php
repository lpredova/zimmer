@extends('admin.index')
@section('adminContent')

    <div class="container">

        <div class="row">
            <h2>Editing {{$favorites->username}} 's comment</h2>
                <div class="col-md-8">
                    {{Form::open(array('url'=>'admin/favorites/update/'.($id),'method'=>'PUT'))}}
                    <div class="col-md-12">

                        {{ Form::label('title', 'Title')}}
                        {{Form::text('title',Input::old('title',$favorites->title),array('class' => 'form-control'))}}
                        {{$errors->first('title')}}
                        {{Form::textarea('description',Input::old('description'),array('class' => 'form-control'))}}

                        {{Form::submit('Update',array('class' => 'submit-btn btn btn-large btn-primary col-md-12'))}}
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="pull-right">{{Form::open(array('url'=>'admin/favorites/destroy/'.($id),'method'=>'DELETE'))}}
                    {{Form::submit('Delete',array('class' => 'btn btn-large btn-alert'))}}
                    {{ Form::close() }}
                </div>

        </div>
    </div>
@stop