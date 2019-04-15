$(document).ready(function() {
  if($('#maps-location').length>0){
    initialize();
  }
});
function initialize() {
  if ($('#maps-location').length>0) {
    var latlng = new google.maps.LatLng(google_maps_lat,google_maps_long);
  }
  var myOptions = {
    zoom: 19,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,

  };
  var map = new google.maps.Map(document.getElementById("maps-location"), myOptions);

  var myMarker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: site_name,
    // icon: "//maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png",
    label: {
      color: '#ce171f',
      fontWeight: '700',
      fontSize: '14px',
      text: site_name,

    },
    icon: {
      labelOrigin: new google.maps.Point(11, 60),
      url: '//maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png',
      size: new google.maps.Size(30, 48),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(11, 40),
    },
  });
  var contentString = '<div id="content">' +
    '<h2 style="font-size:14px;color:#ce171f;padding-top: 5px;">'+site_name+'</h2>' +
    '<p style="font-size:14px;">Hotline: '+phone_number+'</p>' +
    '<p style="font-size:14px;">Giờ mở cửa: '+Open_door+'</p>' +
    '</div>';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });
  myMarker.addListener('click', function() {
    infowindow.open(map, myMarker);
  });
}