     <!--AngularJS resources-->
     {{ HTML::script('bower_components/angular/angular.min.js') }}
     {{ HTML::script('bower_components/angular/angular-animate.min.js') }}
     {{ HTML::script('bower_components/angular/angular-route.js') }}
     <!--Angular maps-->
     {{HTML::script('bower_components/lodash/dist/lodash.min.js') }}
     {{ HTML::script('bower_components/angular-google-maps/dist/angular-google-maps.js') }}

     {{ HTML::script('app/app.module.js') }}
     {{ HTML::script('app/app.routes.js') }}

      <!--Angular controllers-->
      {{ HTML::script('app/components/home/homeController.js') }}
      {{ HTML::script('app/components/about/aboutController.js') }}
      {{ HTML::script('app/components/discover/discoverController.js') }}
      {{ HTML::script('app/components/login/loginController.js') }}
      {{ HTML::script('app/components/near/nearController.js') }}
      {{ HTML::script('app/components/signup_owner/signupOwnerController.js') }}
      {{ HTML::script('app/components/signup_user/signupUserController.js') }}


    {{ HTML::script('assets/js/modernizr.custom.js') }}
    {{ HTML::script('assets/js/html5shiv.js') }}

    {{ HTML::script('assets/js/jquery-1.10.2.min.js') }}
    {{ HTML::script('assets/js/jquery-migrate-1.2.1.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/fancybox/jquery.fancybox.pack-v=2.1.5.js') }}

    {{ HTML::script('assets/js/jquery.easing.1.3.js') }}
