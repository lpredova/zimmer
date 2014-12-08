/**
 * Created by lovro on 08/12/14.
 */
zimmerApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'app/components/home/index/html',
                controller: 'homeCtrl'
            }).
            when('/about', {
                templateUrl: 'app/components/about/index.html',
                controller: 'aboutCtrl'
            }).
            when('/discover', {
                templateUrl: 'app/components/discover/index.html',
                controller: 'discoverCtrl'
            }).
            when('/near', {
                templateUrl: 'app/components/near/index.html',
                controller: 'nearCtrl'
            }).

            when('/login', {
                templateUrl: 'app/components/login/index.html',
                controller: 'loginCtrl'
            }).
            when('/signup_user', {
                templateUrl: 'app/components/signup_user/index.html',
                controller: 'SignupUserCtrl'
            }).
            when('/signup_owner', {
                templateUrl: 'app/components/signup_owner/index.html',
                controller: 'signupOwnerCtrl'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]
);
