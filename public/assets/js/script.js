/******************
 * = Map  *
 ******************/
jQuery(document).ready(function ($) {

    /*Creating a map*/
    var map = new GMaps({
        div: '#map',
        lat: 46.305168,
        lng: 16.333088,
        zoom: 11
        //disableDefaultUI: true
    });

    /*Giving some style to the map*/
    var styles = [[{"saturation": 0}], {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [{"lightness": 200}, {"visibility": "simplified"}]
    }, {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}]
    }, {
        "featureType": "administrative",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}]
    }, {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}, {"saturation": 45}]
    }, {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}, {"saturation": -45}]
    }, {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{"visibility": "simplified"}, {"saturation": 45}]
    }, {
        "featureType": "landscape",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}, {"saturation": 45}]
    }, {
        "featureType": "transit",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}, {"saturation": 45}]
    }];

    map.addStyle({
        styledMapName: "Styled Map",
        styles: styles,
        mapTypeId: "map_style"
    });
    map.setStyle("map_style");

    /*Testing adding some pins*/
    var url = "/api/v1/place";

    $.ajax({

        type: 'GET',
        url: url,
        dataType: 'text',
        data: {
            'city_code': 1
        },
        success: function (data) {

            var markers = [];
            var json = $.parseJSON(data);
            var i = 0;

            $.each(json, function () {

                while (i < Object.keys(json.response).length) {
                    markers.push({
                        lat: json.response[i].lat,
                        lng: json.response[i].lng,
                        title: json.response[i].name
                    });
                    i++
                }
            });
            map.addMarkers(markers)
        }
    });

});