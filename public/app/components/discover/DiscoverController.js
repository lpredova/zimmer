/**
 * Created by lovro on 08/12/14.
 */


zimmerApp.controller('discoverCtrl',
    function ($scope, uiGmapGoogleMapApi) {
        $scope.dataLoaded = false


        uiGmapGoogleMapApi.then(function (maps) {
            $scope.map = {center: {latitude: 45.815011, longitude: 15.981919}, zoom: 13};
            $scope.dataLoaded = true


        })

    });