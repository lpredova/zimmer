/**
 * Created by lovro on 08/12/14.
 */
'use strict';

/*var zimmerApp = angular.module('zimmerApp', [
    'ngRoute',
    'ngAnimate',
    'uiGmapgoogle-maps',
    'zimmerControllers'
]);*/


var zimmerApp = angular.module('zimmerApp', ['ngRoute']);
zimmerApp.config(function($routeProvider){
    $routeProvider.when('/', {
        controller: 'testController',
        templateUrl: 'test.html'
    })
})

var controllers = {};
controllers.testController = function($scope){
    $scope.first = "Info";
    $scope.customers=[
        {name:'jerry',city:'chicago'},
        {name:'tom',city:'houston'},
        {name:'enslo',city:'taipei'}
    ];
}

zimmerApp.controller(controllers)
