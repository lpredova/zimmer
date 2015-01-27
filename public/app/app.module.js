'use strict';
var zimmerApp = angular.module('zimmerApp', [
        'ngRoute',
        'ngAnimate',
        'uiGmapgoogle-maps',
        'ngCookies',
        'ngSanitize',
        'geolocation',
        'ui.bootstrap',
        'infinite-scroll',
        ])
        .constant('AUTH_EVENTS', {
            loginSuccess: 'auth-login-success',
            loginFailed: 'auth-login-failed',
            logoutSuccess: 'auth-logout-success',
            sessionTimeout: 'auth-session-timeout',
            notAuthenticated: 'auth-not-authenticated',
            notAuthorized: 'auth-not-authorized'
        });