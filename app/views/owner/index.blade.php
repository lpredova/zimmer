@include('...admin.includes.header')
<h2>Welcome "{{ Auth::user()->username }}" to OWNER the protected page!</h2>
<p>Your user ID is: {{ Auth::user()->id }}</p>


@section('content')




@stop