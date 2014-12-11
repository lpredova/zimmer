/**
 * Created by lovro on 08/12/14.
 */
zimmerApp.controller('nearCtrl',
    function ($scope, geolocation, nearApartments) {

        $scope.dataLoaded=false

        geolocation.getLocation().then(function (data) {


            $scope.map = {
                center: {
                    latitude: data.coords.latitude,
                    longitude: data.coords.longitude
                }, zoom: 12, bounds: {}
            };
            $scope.options = {
                scrollwheel: false
            };

            $scope.geoCoordinates = {
                lat: data.coords.latitude,
                lng: data.coords.longitude
            }

            nearApartments.getApartments($scope.geoCoordinates)
                .success(function (data) {

                    $scope.apartments = data.response

                    $scope.mapMarkers = []
                    var markers = []
                    var n = 0


                    var createMarker = function (i, value, idKey) {

                        var ret = {
                            latitude: value.lat,
                            longitude: value.lng,
                            title: 'title'
                        };
                        ret["id"] = i;
                        return ret;
                    };

                    angular.forEach(data.response, function (value, key) {
                        var marker = createMarker(n, value)
                        this.push(marker);
                        n++

                    }, markers);

                    $scope.mapMarkers = markers;
                    $scope.dataLoaded = true

                })
                .error(function (err) {
                    console.log('error')
                });
        });

        //$scope.map = {center: {latitude: 45.815011, longitude: 15.981919}, zoom: 13};

    });