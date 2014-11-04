@include('user.include.header')
<h2>Welcome "{{ Auth::user()->username }}" to USER the protected page!</h2>

@section('content')




@stop