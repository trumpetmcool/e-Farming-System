var map;
var infowindowsArray = [];
var activeInfoWindow;
var infowindow;
var local;
var infoText;
var markers;
var infoWindows;
var bounds = null;
var activeBounds = null;
var start;
var currentInfo;
var flag;
var currentZoom = 7;
var currentLocation = new google.maps.LatLng(31.3,-92.0);
var curLat;
var curLng;
var geocoder;
var rectangles;
var rectanglesArray;
/*
function toggleInfoWindow(location, ttl) {
  if (activeInfoWindow) {
    activeInfoWindow.close();
    if (map.getCenter() != start) {
      map.setCenter(start);
    }
  }
  infowindow = new google.maps.InfoWindow({
    position: location,
    map: map,
    content: infoText.get(ttl)
  });
  activeInfoWindow = infowindow;
  activeInfoWindow.open(map);
  if (map.getZoom() >= 15) {
    map.setCenter(local.get(ttl));
  }
}
*/
function updateCenter() {
  map.setOptions({
    center: currentLocation
  });
}
function showAddress(address) {
  geocoder.geocode({'address': address},
    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
	map.setZoom(15);
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
  });
}

function removeRectangle(name) {
  $.each(rectanglesArray, function(key, value) {
    if (value == name) {
      rectanglesArray.splice(key, 1);
    }
  });
  rectangles.get(name).setMap(null);
}

function makeRectangle(x1, y1, x2, y2, ttl) {
  var bounds = new google.maps.LatLngBounds(new google.maps.LatLng(x1, y1), new google.maps.LatLng(x2, y2));
  var rectangle = new google.maps.Rectangle({
    bounds: bounds,
    map: map,
    fillColor: "#CCC",
    fillOpacity: .5,
    strokeColor: "#fff",
    strokeOpacity: .5,
    strokeWeight: 5
  });
  rectanglesArray.push(ttl);
  rectangles.set(ttl, rectangle);
  map.fitBounds(bounds);
}

function updateMap(zoom, location, ttl, toggle) {
  if (activeInfoWindow) {
    activeInfoWindow.close();
  }
  map.setOptions({
    center: location,
    zoom: zoom
  });
  infowindow = new google.maps.InfoWindow({
    position: local.get(ttl),
    map: map,
    content: infoText.get(ttl)
  });
  currentLocation = location;
  currentZoom = zoom;
  activeInfoWindow = infowindow;
  activeInfoWindow.open(map, markers.get(ttl));
}
function toggleInfoWindowOff(location, ttl) {
  activeInfoWindow.close();
}
  function initialize() {
    //<!-- var latlng = new google.maps.LatLng(30.409861,-91.177369); -->
    start = new google.maps.LatLng(31.3,-92.0);
    local = new google.maps.MVCObject();
    infoText = new google.maps.MVCObject();
    //markers = new google.maps.MVCObject();
    markers = new google.maps.MVCArray([]);
    rectanglesArray = new google.maps.MVCArray([]);
    rectangles = new google.maps.MVCObject();
    infoWindows = new google.maps.MVCObject();
    geocoder = new google.maps.Geocoder();
    var mapDiv = document.getElementById("map_canvas");
    var myOptions = {
      zoom: 7,
      center: start,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl: false,
      scrollwheel: false,
      disableDoubleClickZoom: true
    };
    var WMS_URL_ROUTE = "http://ahowic1-3.lsu.edu/cgi-bin/mapserv?map=";
    map = new google.maps.Map(mapDiv, myOptions);
    //Define custom WMS tiled layer
var SLPLayer =
 new google.maps.ImageMapType (
 {
  getTileUrl:
    function (coord, zoom) { 
      var proj = map.getProjection(); 
      var zfactor = Math.pow(2, zoom); 
       // get Long Lat coordinates
      var top = proj.fromPointToLatLng(
             new google.maps.Point(coord.x * 256 / zfactor, coord.y * 256 / zfactor) ); 
      var bot = proj.fromPointToLatLng(
            new google.maps.Point((coord.x + 1) * 256 / zfactor, (coord.y + 1) * 256 / zfactor)); 
      //create the Bounding box string
      var bbox = top.lng() + ", " + bot.lat() + ", " + bot.lng() + ", " + top.lat();
      
       //base WMS URL
    /*   var url = "http://ahowic1-3.lsu.edu/cgi-bin/mapserv?map=/var/www/html/3380/mapserver-5.6.6/tests/test.map&";
       url += "&REQUEST=GetMap"; //WMS operation
       url += "&SERVICE=WMS"; //WMS service
       url += "&VERSION=1.1.1"; //WMS version 
       url += "&LAYERS=" + "typologie,hm2003"; //WMS layers
       url += "&FORMAT=image/png"; //WMS format
       url += "&BGCOLOR=0xFFFFFF" ;
       url += "&TRANSPARENT=TRUE" ;
       url += "&SRS=EPSG:4326"; //set WGS84 
       url += "&BBOX="+ bbox; // set bounding box
       url += "&WIDTH=256"; //tile size in google
       url += "&HEIGHT=256" ; */
       url = "http://casoilresource.lawr.ucdavis.edu/cgi-bin/mapserv?map=/data1/website/mapserver/dhtml/mapunit_wms.map&&REQUEST=GetMap&SERVICE=WMS&VERSION=1.1.1&LAYERS=statsgo_combined&STYLES=&FORMAT=image/png&BGCOLOR=0xFFFFFF&TRANSPARENT=TRUE&SRS=EPSG:4326&BBOX="+bbox+"&WIDTH=256&HEIGHT=256&reaspect=false"
       return url; // return URL for the tile    
     }, //getTileURL
 tileSize: new google.maps.Size(256, 256),
 isPng: true
 }); 
 //add WMS layer 
 map.overlayMapTypes.push(SLPLayer); 
    var louisianaLayer = new google.maps.KmlLayer('http://dl.dropbox.com/u/11740380/louisiana.kml', {
      map: null,
      preserveViewport: true,
      suppressInfoWindows: true
    });
    
/*
    var eBatonRougeLayer = new google.maps.KmlLayer('http://dl.dropbox.com/u/11740380/EBR.kml', {
      map: map,
      preserveViewport: true,
      suppressInfoWindows: true
    });
    var newOrleansLayer = new google.maps.KmlLayer('http://dl.dropbox.com/u/11740380/NO.kml', {
      map: null,
      preserveViewport: true,
      suppressInfoWindows: true
    });
    var lafayetteLayer = new google.maps.KmlLayer('http://dl.dropbox.com/u/11740380/LAF.kml', {
      map: null,
      preserveViewport: true,
      suppressInfoWindows: true
    });
    var rustinLayer = new google.maps.KmlLayer('http://dl.dropbox.com/u/11740380/RUST.kml', {
      map: null,
      preserveViewport: true,
      suppressInfoWindows: true
    });
    */
    google.maps.event.addListener(louisianaLayer, 'click', function() {
      activeInfoWindow.close();
    });
    google.maps.event.addListener(map, 'click', function() {
      activeInfoWindow.close();
    });
    google.maps.event.addListener(map, 'bounds_changed', function() {   
      var bounds = map.getBounds();
      var southWest = bounds.getSouthWest();
      var northEast = bounds.getNorthEast();
      var box = northEast.lng() + ", " + southWest.lat() + ", " + southWest.lng() + ", " + northEast.lat();
      var soil_box_url = "http://casoilresource.lawr.ucdavis.edu/soil_web/reflector_api/soils.php?what=mapunit&legend_style=grouped&bbox=" + box;
      document.getElementById("side").src = soil_box_url;
     }); 
    google.maps.event.addListener(map, 'zoom_changed', function() {
      if (map.getZoom() < 10)
        louisianaLayer.setMap(map);
      else
        louisianaLayer.setMap(null);
      if (map.getZoom() < 12)
        map.setOptions({ mapTypeId: google.maps.MapTypeId.ROADMAP });
      else
        map.setOptions({ mapTypeId: google.maps.MapTypeId.HYBRID });
    }); 
  }
  google.maps.event.addDomListener(window, 'load', initialize);
  window.onresize = updateCenter;
