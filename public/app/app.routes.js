/**
 * Created by lovro on 08/12/14.
 */
zimmerApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'components.home.index.html',
                controller: 'HomepageCtrl'
            }).
            when('/discover', {
                templateUrl: 'components/discover/index.html',
                controller: 'DiscoverCtrl'
            }).
            when('/near', {
                templateUrl: 'components/near/index.html',
                controller: 'NearCtrl'
            }).
            when('/about', {
                templateUrl: 'components/about/index.html',
                controller: 'AboutCtrl'
            }).
            when('/login', {
                templateUrl: 'components/login/index.html',
                controller: 'LoginCtrl'
            }).
            when('/signup_user', {
                templateUrl: 'components/signup_user/index.html',
                controller: 'SignupUserCtrl'
            }).
            when('/signup_owner', {
                templateUrl: 'components/signup_owner/index.html',
                controller: 'SignupOwnerCtrl'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);
