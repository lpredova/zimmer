zimmerApp.controller('nearCtrl',
    ['$scope', 'geolocation', 'nearApartments', 'uiGmapGoogleMapApi', 'favoriteFactory', '$cookieStore',
        function ($scope, geolocation, nearApartments, uiGmapGoogleMapApi, favoriteFactory, $cookieStore) {

            $scope.dataLoaded = false
            $scope.showMap = false

            $scope.submitFavs = function (id, $index) {
                if ($cookieStore.get("username") == null || $cookieStore.get("token") == null) {
                    swal("OOPS!", "Looks like you're not logged in!", "warning");
                    return 0
                }

                var favorite = {
                    //todo edit this
                    apartment: id,
                    username: $cookieStore.get("username"),
                    token: $cookieStore.get("token")
                };

                favoriteFactory.favorite(favorite)
                    .success(
                    function (data) {
                        console.log(data)
                        console.log(data.response)
                        if (data.response == 'OK') {
                            $scope.selectedIndex = $index;
                            swal("Good job!", "Favorite added", "success");
                        }
                        else {
                            swal("OOPS!", "Something went wrong!", "warning");
                        }
                    }
                )
                    .error(
                    function (data) {
                        swal("OOPS!", "Looks like you're not logged in!", "warning");
                    })
            }

            geolocation.getLocation().then(function (data) {
                $scope.geoCoordinates = {
                    lat: data.coords.latitude,
                    lng: data.coords.longitude
                }
                if($cookieStore.get("lat")==null || $cookieStore.get("lng")==null ){
                    $cookieStore.put("lat", data.coords.latitude);
                    $cookieStore.put("lng", data.coords.longitude);
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
                                    icon: '/assets/images/marker-green.png',
                                    show: false
                                };
                                ret["id"] = i;

                                ret.onClick = function () {
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
                    .error(function () {
                        console.log('error')
                    });
            })
        }]).filter('split', function () {
        return function (input, splitChar, splitIndex) {
            return input.split(splitChar)[splitIndex];
        }
    });