@include('owner.include.header')
<h2>Welcome "{{ Auth::user()->username }}" to OWNER the protected page!</h2>


@section('content')




@stop