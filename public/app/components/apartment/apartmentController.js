zimmerApp.controller('apartmentCtrl', ['$scope', '$routeParams', 'detailApartments',
    function ($scope, $routeParams, detailApartments) {
        $scope.dataLoaded = false

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
                    icon: '/assets/images/marker-red.png'
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

                $scope.dataLoaded = true
            })
    }]);

