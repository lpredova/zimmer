zimmerApp.factory('detailApartments', ['$http', '$sanitize', '$cookieStore', function ($http, $sanitize, $cookieStore) {
    return {
        getApartmentDetails: function (id) {
            var params = {
                params: {
                    lat: $cookieStore.get("lat"),
                    lng: $cookieStore.get("lng"),
                    apartment_id: $sanitize(id)
                }
            };
            return $http.get("/api/v1/apartmentDetails", params);
        }
    };
}]);
