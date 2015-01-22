@extends('admin.index')
@section('adminContent')


    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    @if(Session::has('success'))
        <div class="alert-box success">
            <h2>{{ Session::get('success') }}</h2>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Push notifications</h1>

                {{Form::open(array('url'=>'/admin/sendPush','method'=>'POST'))}}

                {{ Form::label('gcm-title', 'Title') }}
                {{ Form::text('gcm-title', null, ['class' => 'form-control'])}}
                {{ $errors->first('gcm-title')}}

                {{ Form::label('gcm-message', 'Message') }}
                {{ Form::textarea('gcm-message', null, ['class' => 'form-control']) }}
                {{ $errors->first('gcm-message')}}

                {{Form::submit('Send notification',['class' => 'btn button-primary'])}}
                {{ Form::close() }}
            </div>
        </div>
    </div>


@stop