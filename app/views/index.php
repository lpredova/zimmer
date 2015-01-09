<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/fancybox/jquery.fancybox-v=2.1.5.css'>
    <link rel='stylesheet' href='assets/css/font-awesome.min.css'>
    <link rel='stylesheet' href='assets/css/transitions.css'>
    <link rel='stylesheet' href='assets/css/animate.css'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600,300,200&subset=latin,latin-ext'>
</head>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="fa fa-bars fa-lg"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="/assets/images/logo_mini.png" alt="" id="logo">
                <img src="/assets/images/zimmer-letters.png" alt="" id="logo-letters">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Home</a>
                </li>
                <li><a href="/special">Special offers</a>
                </li>
                <li><a href="/near">Near</a>
                </li>
                <li><a href="/about">About</a>
                </li>
                <li><a class="getApp" href="/login">Login</a>
                </li>
                <li><a href="/signup">Signup</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<body ng-app="zimmerApp">
    <!--Container-->
    <div class="view-animate-container">
        <div ng-view class="view-animate"></div>
    </div>

</body>


<!--AngularJS resources-->
<script src='https://code.angularjs.org/1.3.5/angular.min.js'></script>
<script src="//code.angularjs.org/1.2.13/angular-cookies.js"></script>
<script src="https://code.angularjs.org/1.3.5/angular-sanitize.min.js"></script>
<script src='/bower_components/angular/angular-animate.min.js'></script>
<script src='/bower_components/angular-bootstrap/ui-bootstrap.min.js'></script>
<script src='/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js'></script>
<script src='/bower_components/ngInfiniteScroll/build/ng-infinite-scroll.min.js'></script>

<script src='/bower_components/angular/angular-route.js'></script>

<!--Angular maps-->
<script src='/bower_components/lodash/dist/lodash.min.js'></script>
<script src='/bower_components/angular-google-maps/dist/angular-google-maps.js'></script>
<script src='/bower_components/angularjs-geolocation/dist/angularjs-geolocation.min.js'></script>


<script src='/app/app.module.js'></script>
<script src='/app/app.routes.js'></script>

<!--Angular controllers-->
<script src='/app/components/about/AboutController.js'></script>
<script src='/app/components/home/HomeController.js'></script>
<script src='/app/components/special/SpecialController.js'></script>
<script src='/app/components/near/NearController.js'></script>
<script src='/app/components/signup_owner/signupOwnerController.js'></script>
<script src='/app/components/signup_user/signupUserController.js'></script>
<script src='/app/components/login/LoginController.js'></script>
<script src='/app/components/apartment/apartmentController.js'></script>

<!--Angular factory/services-->
<script src='/app/services/authentication/services.js'></script>
<script src='/app/services/apartments/nearApartments.js'></script>
<script src='/app/services/apartments/detailApartments.js'></script>
<script src='/app/services/specials/specialOffers.js'></script>

<script src='/app/services/registration/signupUser.js'></script>
<script src='/app/services/registration/signupOwner.js'></script>

<!--Angular directives-->
<script type="text/javascript" src='/app/shared/directives.js'></script>
<script type="text/javascript" src='/app/shared/filters.js'></script>

</html>