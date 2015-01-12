zimmerApp.controller('apartmentCtrl', ['$scope', '$routeParams', '$cookieStore', 'detailApartments'
    , 'rateFactory', 'favoriteFactory',
    function ($scope, $routeParams, $cookieStore, detailApartments, rateFactory, favoriteFactory) {
        $scope.dataLoaded = false


        $scope.submitRating = function () {
            if ($cookieStore.get("username") == null || $cookieStore.get("token") == null) {
                swal("OOPS!", "Looks like you're not logged in!", "warning");
            }
            else {
                var rating = {
                    //todo edit this later
                    rating: 4,
                    apartment: $scope.apartments_detail[0].id,
                    username: $cookieStore.get("username"),
                    _token: $cookieStore.get("token")
                };

                rateFactory.rate(rating)
                    .success(
                    function (data) {
                        if (data.response == 'OK') {
                            $scope.ratedRating={color:'#f1c40f',pointer:'none'}
                            swal("TNX!", "Sucessufully rated", "success");
                        }
                    }
                )
                    .error(
                    function (data) {
                        swal("Oops...", "Something went wrong!", "error");                    }
                )
            }
        }

        $scope.submitFavs = function () {

            if ($cookieStore.get("username") == null || $cookieStore.get("token") == null) {
                swal("OOPS!", "Looks like you're not logged in!", "warning");
            }

            var favorite = {
                //todo edit this
                apartment: $scope.apartments_detail[0].id,
                username: $cookieStore.get("username"),
                token: $cookieStore.get("token")
            };

            favoriteFactory.favorite(favorite)
                .success(
                function (data) {
                    console.log(data)
                    console.log(data.response)
                    if (data.response == 'OK') {
                        $scope.ratedFavorite={color:'#f1c40f',pointer:'none'}
                        swal("Good job!", "Favorite added", "success");
                    }
                    else {
                        swal("OOPS!", "Something went wrong!", "warning");
                    }
                }
            )
                .error(
                function (data) {
                    console.log(data)
                    swal("OOPS!", "Something went wrong!", "warning");
                })
        }

        detailApartments.getApartmentDetails($routeParams.id)
            .success(function (data) {

                $scope.dataLoaded = true
                $scope.apartments_detail = data.response


                $scope.map = {
                    center: {
                        latitude: data.response[0].lat,
                        longitude: data.response[0].lng
                    },
                    zoom: 11
                };

                $scope.options = {scrollwheel: false};

                $scope.marker = {
                    id: 0,
                    coords: {
                        latitude: data.response[0].lat,
                        longitude: data.response[0].lng
                    },
                    icon: '/assets/images/marker-green.png'
                };

                $scope.circles = [
                    {
                        id: 1,
                        center: {
                            latitude: data.response[0].lat,
                            longitude: data.response[0].lng
                        },
                        radius: 5000,
                        stroke: {
                            color: '#08B21F',
                            weight: 2,
                            opacity: 1
                        },
                        fill: {
                            color: '#08B21F',
                            opacity: 0.5
                        },
                        geodesic: true, // optional: defaults to false
                        draggable: true, // optional: defaults to false
                        clickable: true, // optional: defaults to true
                        editable: true, // optional: defaults to false
                        visible: true // optional: defaults to true
                    }]

                $scope.rate = data.response.stars;
                $scope.max = 5;
                $scope.isReadonly = false;

                $scope.hoveringOver = function (value) {
                    $scope.overStar = value;
                    $scope.percent = 100 * (value / $scope.max);
                };

                $scope.ratingStates = [
                    {stateOn: 'glyphicon-star', stateOff: 'glyphicon-star-empty'},
                ];


                $scope.dataLoaded = true
            })
    }]);
