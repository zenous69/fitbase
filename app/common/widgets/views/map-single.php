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

    // To add the marker to the map, call setMap();
    marker.setMap(map);

    function initMap() {

        var image = 'http://zenous.com/files/turnik.png';

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?= Html::encode($coordinate->latitude) ?>, lng: <?= Html::encode($coordinate->longitude) ?>},
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

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: <?= Html::encode($coordinate->latitude) ?>, lng: <?= Html::encode($coordinate->longitude) ?>},
            icon: image
        });

        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }



</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb_TlwYWYwQ-pDP51VV2skw2VZvMmmcrs&callback=initMap"
        async defer></script>

