console.log('test')
zimmerApp.factory('specialOffers', ['$http',  function ($http) {
    return {
        getSpecialOffers: function () {
            return  $http.get("/api/v1/apartmentSpecialOffers");
        }
    };
}]);
