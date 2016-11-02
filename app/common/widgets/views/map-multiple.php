<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20-Sep-16
 * Time: 8:30 PM
 */

use yii\helpers\Html;

?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        height: 500px;
    }
</style>


<!-- Here comes the map -->

<div id="map"></div>
<script>

    var map;

    function initMap() {

        var image = 'http://zenous.com/files/turnik.png';

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?= Html::encode($latitude) ?>, lng: <?= Html::encode($longitude) ?>},
            zoom: 17,
            styles: [
                {
                    featureType: 'all',
                    stylers: [
                        { saturation: -90 }
                    ]
                },{
                    featureType: 'road.arterial',
                    elementType: 'geometry',
                    stylers: [
                        { hue: '#00ffee' },
                        { saturation: 50 }
                    ]
                },
                {
                    featureType: 'transit.station',
                    elementType: 'labels',
                    stylers: [
                        { visibility: 'off' }
                    ]
                },
                {
                    featureType: 'poi.business',
                    elementType: 'labels',
                    stylers: [
                        { visibility: 'off' }
                    ]
                },
                {
                    featureType: "landscape.man_made",
                    elementType: "geometry.fill",
                    stylers: [
                        {"weight": 4.1},
                        {"color": "#ebdfff"},
                        {"lightness": 44},
                        {"hue": "#0019ff"}
                    ]
                }
            ]
        });

        marker1 = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: 50.459395, lng: 30.516951},
            icon: image
        });
        marker1.addListener('click', toggleBounce);


        marker2 = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: <?= Html::encode($latitude) ?>, lng: <?= Html::encode($longitude) ?>},
            icon: image
        });

        marker2.addListener('click', toggleBounce);
    }

    function DROP() {
        for (var i =0; i < markerArray.length; i++) {
            setTimeout(function() {
                addMarkerMethod();
            }, i * 200);
        }
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }


    //EXTENDING MAP TO INCLUDE ALL MARKERS

    //create empty LatLngBounds object
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();

    for (i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        //extend the bounds to include each marker's position
        bounds.extend(marker.position);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    //now fit the map to the newly inclusive bounds
    map.fitBounds(bounds);

    //(optional) restore the zoom level after the map is done scaling
    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(3);
        google.maps.event.removeListener(listener);
    });


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb_TlwYWYwQ-pDP51VV2skw2VZvMmmcrs&callback=initMap"
        async defer></script>

