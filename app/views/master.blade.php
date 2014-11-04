 <html>
 <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
 	@include('includes.head')
 </head>
 <body>
 <div class="container">

 	<header class="row">
 		@include('includes.header')
 	</header>

 	<div id="main" class="row">

 			@yield('content')

 	</div>

 	<footer class="row">
 		@include('includes.footer')
 	</footer>

 </div>
 </body>
 </html>