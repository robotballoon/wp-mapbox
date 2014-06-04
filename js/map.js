jQuery(document).ready(function($){
  // prepare geojson object for building
  var geojson = {};
  geojson['type'] = 'FeatureCollection';
  geojson['features'] = [];

  // for length of your id array in template-points.php - build geojson features
  for (i=0; i<ids.length; i++) {
    var newFeature = {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [lons[i], lats[i]]
      },
      "properties": {
        "title": titles[i],
        "desc": excerpts[i]
        // "postID": ids[i]
      }
    }
    geojson['features'].push(newFeature); 
  }
  console.log(geojson);

  // use geoJSON to make the map
  var map = L.mapbox.map('map', 'umkcmaps.iciao40c');
    var featureLayer = map.featureLayer.setGeoJSON(geojson);
  // fit the bounds of your points
  map.fitBounds(featureLayer.getBounds());

  // click the point in the list, the map centers on the marker
  // this is just a treat, not required for the page to work
  // $('.point').click(function(){
  //   var point = this.id;
  //   console.log(point);
  //   map.featureLayer.eachLayer(function(marker) {
  //     var name = marker.feature.properties.postID;
  //     console.log(name);
  //     if(name == point) {
  //       map.panTo(marker.getLatLng());
  //       marker.openPopup();
  //     }
  //   });
  // });
});