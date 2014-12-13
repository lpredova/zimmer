zimmerApp.factory('detailApartments', ['$http', '$sanitize', function ($http, $sanitize) {

    return {
        getApartmentDetails: function (apartment_id) {

            var params = {
                params: {
                    apartment_id: $sanitize(apartment_id)
                }

            };

            var apartment = $http.get("/api/v1/apartmentDetails", params);
            return apartment;
        }
    };
}]);
