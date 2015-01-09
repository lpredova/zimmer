@extends('admin.index')
@section('adminContent')

        <div class="row">
            <div class="col-md-8">
                <h2>Ajdi {{$id}}</h2>

                {{Form::open(array('url'=>'admin/ratings/update/'.$id,'method'=>'PUT'))}}


                {{ Form::label('rating', 'Rating')}}
                {{Form::text('rating',$rating->rating,array('class' => 'form-control'))}}
                {{$errors->first('rating')}}

                {{Form::textarea('comment',$rating->comment,array('class' => 'form-control'))}}

                {{Form::submit('Update',array('class' => 'submit-btn btn btn-large btn-primary col-md-12'))}}
                    {{ Form::close() }}
            </div>
            <div class="pull-right">{{Form::open(array('url'=>'admin/ratings/destroy/'.$id,'method'=>'DELETE'))}}
                {{Form::submit('Delete',array('class' => 'btn btn-large btn-alert'))}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop