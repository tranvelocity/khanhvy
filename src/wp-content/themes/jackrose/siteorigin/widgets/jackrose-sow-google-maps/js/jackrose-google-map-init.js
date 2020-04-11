var googleMaps = {};
var initGoogleMaps = function() {
	window.addEventListener( 'load', function() {
		var elements = document.getElementsByClassName( 'jackrose-sow-google-maps' );

		for ( var i = 0; i < elements.length; i++ ) {
			var id = elements[i].getAttribute( 'data-jackrose-target' ),
			    args = JSON.parse( elements[i].getAttribute( 'data-jackrose-arguments' ) );

			// Initialize map.
			googleMaps[id] = {};
			googleMaps[id]['map'] = new google.maps.Map( document.getElementById( id ), args.options );

			// Initialize markers.
			googleMaps[id]['markers'] = {};
			for ( var j = 0; j < args.locations.length; j++ ) {
				var location = args.locations[j];

				// Add new marker.
				googleMaps[id]['markers'][j] = new google.maps.Marker({
					position: location['position'],
					map: googleMaps[id]['map'],
					icon: location['icon'],
					animation: location['animation'],
				});;

				// Add new info window to marker.
				if ( location['info_window'].length > 0 ) {
					googleMaps[id]['markers'][j]['infoWindow'] = new google.maps.InfoWindow({
						content: location['info_window'],
						maxWidth: location['info_window_max_width'],
					});

					googleMaps[id]['markers'][j].addListener( 'click', function() {
						this.infoWindow.open( this.map, this );
					});
				}
			}
		};
	});
}

if ( window.google && window.google.maps ) {
	// Call init.
	window.initGoogleMaps();
} else {
	// Get all Google Maps widgets.
	var elements = document.getElementsByClassName( 'jackrose-sow-google-maps' );

	// Fetch the API key from the first elemement.
	var apiKey = elements[0].getAttribute( 'data-jackrose-api-key' );

	// Build the URL.
	var apiUrl = 'https://maps.googleapis.com/maps/api/js?callback=initGoogleMaps';
	if ( apiKey ) {
		apiUrl += '&key=' + apiKey;
	}

	// Create <script> tag
	var script = document.createElement( 'script' );
	script.setAttribute( 'async', true );
	script.setAttribute( 'defer', true );
	script.setAttribute( 'src', apiUrl );
	script.setAttribute( 'type', 'text/javascript' );

	document.body.appendChild( script );
}