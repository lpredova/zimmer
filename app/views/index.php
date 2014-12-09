<!DOCTYPE html>
<html ng-app="zimmerApp">

<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/fancybox/jquery.fancybox-v=2.1.5.css'>
    <link rel='stylesheet' href='assets/css/font-awesome.min.css'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600,300,200&subset=latin,latin-ext'>
    
    
    
</head>
<div class="navbar navbar-fixed-top">
    <div class="container">
        <ul class="nav row">
            <li  class="col-12 col-sm-2"><a href="/"><span class="text">Home</span></a></li>
            <li  class="col-12 col-sm-2"><a href="/discover"><span class="text">Discover</span></a></li>
            <li  class="col-12 col-sm-2"><a href="/near"> <span class="text">Near</span></a></li>
            <li  class="col-12 col-sm-2"><a href="/about"> <span class="text">About</span></a></li>
            <li  class="col-12 col-sm-2"><a href="/login"> <span class="text">Login</span></a></li>
            <li  class="col-12 col-sm-2"><a href="/signup"> <span class="text">Sign up</span></a></li>
        </ul>
    </div>
</div>

<body>

<hr>
    <div ng-view>
    </div>

</body>

<!--AngularJS resources-->
<!--<script src='bower_components/angular/angular.min.js'></script>-->
<script src='https://code.angularjs.org/1.3.5/angular.min.js'></script>
<script src="//code.angularjs.org/1.2.13/angular-cookies.js"></script>
<script src="https://code.angularjs.org/1.3.5/angular-sanitize.min.js"></script>
<script src='bower_components/angular/angular-animate.min.js'></script>
<script src='bower_components/angular/angular-route.js'></script>
<!--Angular maps-->
<script src='bower_components/lodash/dist/lodash.min.js'></script>
<script src='bower_components/angular-google-maps/dist/angular-google-maps.js'></script>

<script src='app/app.module.js'></script>
<script src='app/app.routes.js'></script>

<!--Angular controllers-->
<script src='app/components/about/aboutController.js'></script>
<script src='app/components/home/homeController.js'></script>
<script src='app/components/discover/discoverController.js'></script>
<script src='app/components/near/nearController.js'></script>
<script src='app/components/signup_owner/signupOwnerController.js'></script>
<script src='app/components/signup_user/signupUserController.js'></script>
<script src='app/components/login/loginController.js'></script>

<!--Angular factory-->
<script src='app/services/authentication/services.js'></script>

</html>