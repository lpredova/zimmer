/**
 * Created by lovro on 08/12/14.
 */
zimmerApp.controller('nearCtrl',
    ['$scope', 'geolocation', 'nearApartments', 'uiGmapGoogleMapApi',
        function ($scope, geolocation, nearApartments, uiGmapGoogleMapApi) {

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
                    }, zoom: 10
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
                                    title: value.name + ";" + value.picture + ";" + value.phone + ";" + value.id,
                                    icon: '/assets/images/marker-red.png',
                                    show: false
                                };
                                ret["id"] = i;

                                ret.onClick = function () {
                                    ret.show = !ret.show;
                                };
                                return ret;
                            };


                            /*var createUserLocation = function (i) {
                             var ret = {
                             latitude: $scope.map.center.latitude,
                             longitude: $scope.map.center.longitude,
                             icon: '/assets/images/marker-yellow.png',
                             title: "Your location;http://static.weltsport.net/bilder/shared/base/dummy_user.png;none;" + 0,
                             show: true
                             };
                             ret.onClick = function () {
                             console.log("Clicked!");
                             ret.show = !ret.show;
                             };
                             ret["id"] = i;
                             return ret;
                             }*/

                            angular.forEach(data.response, function (value, key) {
                                var marker = createMarker(n, value)
                                this.push(marker);
                                /*if(n==(Object.keys(data.response).length)-1){
                                 var marker = createUserLocation(n+1)
                                 this.push(marker);
                                 }*/
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
        }]).filter('split', function () {
        return function (input, splitChar, splitIndex) {
            return input.split(splitChar)[splitIndex];
        }
    });