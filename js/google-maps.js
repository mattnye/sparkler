function initialize(address) {
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		'address': address,
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var map_options = {
				zoom: 15,
				scrollwheel: false,
				draggable : false,
				center: results[0].geometry.location,
				mapTypeControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DEFAULT,
					position: google.maps.ControlPosition.TOP_RIGHT
				},
				streetViewControl: false,
				streetViewControlOptions: {
					position: google.maps.ControlPosition.RIGHT_BOTTOM
				},
				zoomControl: false,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.DEFAULT,
					position: google.maps.ControlPosition.RIGHT_BOTTOM
				},
			}
			var map = new google.maps.Map(document.getElementById('map-canvas'), map_options);
			
			// Offset center
			map.panBy(-181,-36);
			
			// Add marker
			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});
			
			// Add infowindow
			var content = '<div class="map-infowindow">' +
				'<div class="map-infowindow-heading">' + address + '</div>' +
				'<div class="map-infowindow-link"><a href="http://maps.google.com/maps?q=' + address + '" target="_blank">View on Google Maps</a></div>' +
				'</div>';
				
			var infowindow = new google.maps.InfoWindow({
				content: content,
				maxWidth: 300,
			});
			
			// Open infowindow on click
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
			
			// Open infowindow on map load
			infowindow.open(map, marker);
		}
	});
}

// Get address
var address = $('#map-canvas').attr('data-address');

// Display map
google.maps.event.addDomListener(window, 'load', initialize(address));