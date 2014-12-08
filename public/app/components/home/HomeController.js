/**
 * Created by lovro on 08/12/14.
 */

var zimmerControllers = angular.module('zimmerControllers', []);

zimmerControllers.controller('HomepageCtrl', ['$scope',
    function($scope) {


        $scope.first = "Heureka !"
        console.log('home controller here')

    }]);