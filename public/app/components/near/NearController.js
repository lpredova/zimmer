/**
 * Created by lovro on 08/12/14.
 */
zimmerApp.controller('nearCtrl',
    function ($scope, geolocation,  nearApartments, uiGmapGoogleMapApi) {

        $scope.dataLoaded = false
        $scope.showMap = false

        geolocation.getLocation().then(function (data) {
            $scope.geoCoordinates = {
                lat: data.coords.latitude,
                lng: data.coords.longitude
            }

            $scope.map = {
                center: {
                    latitude: data.coords.latitude,
                    longitude: data.coords.longitude
                }, zoom: 11
            };
            $scope.options = {
                scrollwheel: false
            };

            nearApartments.getApartments($scope.geoCoordinates)
                .success(function (data) {

                    $scope.apartments = data.response


                    uiGmapGoogleMapApi.then(function (maps) {
                        $scope.mapMarkers = []
                        var markers = []
                        var n = 0

                        var createMarker = function (i, value, idKey) {
                            var ret = {
                                latitude: value.lat,
                                longitude: value.lng,
                                title: value.name +";"+value.picture +";"+ value.phone,
                                icon: '/assets/images/marker-red.png',
                                show: false
                            };
                            ret["id"] = i;

                            ret.onClick = function() {
                                console.log("Clicked!");
                                ret.show = !ret.show;
                            };
                            return ret;
                        };


                        angular.forEach(data.response, function (value, key) {
                            var marker = createMarker(n, value)
                            this.push(marker);
                            n++
                        }, markers);

                        $scope.mapMarkers = markers;
                        $scope.showMap = true
                        $scope.dataLoaded = true
                    });
                })
                .error(function (err) {
                    console.log('error')
                });
        })
    }).filter('split', function() {

        return function(input, splitChar, splitIndex) {
            return input.split(splitChar)[splitIndex];
        }
    });