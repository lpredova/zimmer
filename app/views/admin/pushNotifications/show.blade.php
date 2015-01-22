@extends('admin.index')
@section('adminContent')


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Push notifications</h1>
                <label>Push message</label>
                <textarea class="form-control" cols="3" rows="10" name="gcm-message">

                </textarea>
                <a class="btn btn-default"
                   href='/admin/sendPush'>Send
                    push notification</a>
            </div>
        </div>

    </div>


@stop