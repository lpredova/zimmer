 <html ng-app="zimmerApp">
 <head lang="en">
 	@include('includes.head')
 </head>
 <body>
 		@include('includes.header')



 		{{--@yield('content')--}}

 		<div class="view-container">
            <div ng-view class="view-frame"></div>
        </div>


 		@include('includes.footer')
 </body>
 </html>