/**
 * Created by lovro on 08/12/14.
 */
zimmerApp.config(['$routeProvider','$locationProvider',
    function($routeProvider,$locationProvider) {

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });

        $routeProvider.
            when('/', {
                templateUrl: 'app/components/home/index.html',
                controller: 'homeCtrl'
            }).
            when('/logout', {
                templateUrl: 'app/components/home/index.html',
                controller: 'homeCtrl'
            }).
            when('/about', {
                templateUrl: 'app/components/about/index.html',
                controller: 'aboutCtrl'
            }).
            when('/special', {
                templateUrl: 'app/components/special/index.html',
                controller: 'specialCtrl'
            }).
            when('/near', {
                templateUrl: 'app/components/near/index.html',
                controller: 'nearCtrl'
            }).

            when('/login', {
                templateUrl: 'app/components/login/index.html',
                controller: 'loginCtrl'
            }).
            when('/signup', {
                templateUrl: 'app/components/signup_user/index.html',
                controller: 'SignUpUserCtrl'
            }).
            when('/signup_owner', {
                templateUrl: 'app/components/signup_owner/index.html',
                controller: 'SignUpOwnerCtrl'
            }).
            when('/apartment/:id', {
                templateUrl: '/app/components/apartment/index.html',
                controller: 'apartmentCtrl'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]
);

zimmerApp.run(function($cookieStore, $rootScope,$window) {
    $rootScope.checkLogin = function () {
        if($cookieStore.get("username")!=null){
            $rootScope.saved_username = $cookieStore.get("username")
            return true
        }
        else{
            return false
        }
    }
    $rootScope.Logout = function () {

        /**
         * Clearing cookie information
         */
        $cookieStore.remove('username');
        $cookieStore.remove('token');

        var url = 'http://' + window.location.hostname + ":" + window.location.port + '/logout'

        $window.location.href = url

    }
})
