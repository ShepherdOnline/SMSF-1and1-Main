var map;
function initializeShops() {
    var locations = [document.getElementById('map').getAttribute('data-description'), document.getElementById('map').getAttribute('data-latidute'), document.getElementById('map').getAttribute('data-longitude'), 1];
    var center = new google.maps.LatLng(locations[1], locations[2]);
    var roadAtlasStyles = [
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#e9e9e9"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#dedede"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#333333"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f2f2f2"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        }
    ];

    var mapOptions;
    if (jQuery(window).width() > 1024) {
        mapOptions = {
            zoom: parseInt(document.getElementById('map').getAttribute('data-zoom')),
            center: center,
            scaleControl: false,
            scrollwheel: false,
            draggable: true,
            minZoom: 3,
            maxZoom: 21,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
            }
        };
    } else {
        mapOptions = {
            zoom: parseInt(document.getElementById('map').getAttribute('data-zoom')),
            center: center,
            scaleControl: false,
            scrollwheel: false,
            draggable: false,
            minZoom: 3,
            maxZoom: 21,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
            }
        };
    }
    map = new google.maps.Map(document.getElementById('map'),
            mapOptions);

    var styledMapOptions = {
        name: 'US Road Atlas'
    };

    var usRoadMapType = new google.maps.StyledMapType(
            roadAtlasStyles, styledMapOptions);

    map.mapTypes.set('usroadatlas', usRoadMapType);
    map.setMapTypeId('usroadatlas');

    var marker;

    var image = {
        //url: template_directory_uri.url + '/images/map_icon.png',
        size: new google.maps.Size(42, 63),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 42)
    };


    var shape = {
        coord: [1, 1, 1, 71, 71, 62, 62, 1],
        type: 'poly'
    };
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[1], locations[2]),
        map: map,
//        icon: image,
        shape: shape,
        zIndex: locations[4]

    });
    if (locations[0] != '') {
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function () {
            infowindow.setContent(locations[0]);
            infowindow.open(map, marker);
        }));
        infowindow.setContent(locations[0]);
        infowindow.open(map, marker);
    }


    function addMarker(feature) {
        var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
        });
    }
}

google.maps.event.addDomListener(window, 'load', initializeShops);
