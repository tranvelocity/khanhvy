<?php
$id = jackrose_increment_number();
$latlong = explode( ',', $instance['center'] );
$latlong = array_map( 'trim', $latlong );
$center['lat'] = $latlong[0];
$center['long'] = $latlong[1];

// Define locations (markers)
$markers = array();
foreach ( $instance['pins'] as $pin ) :
	$latlong = explode( ',', $pin['latlong'] );
	$latlong = array_map( 'trim', $latlong );
	$pin['lat'] = isset( $latlong[0] ) ? $latlong[0] : 0;
	$pin['long'] = isset( $latlong[1] ) ? $latlong[1] : 0;

	// Set position object.
	$marker['position'] = array( 'lat' => floatval( $pin['lat'] ), 'lng' => floatval( $pin['long'] ) );

	// Marker icon.
	if ( ! empty( $pin['icon'] ) ) {
		$marker['icon'] = wp_get_attachment_url( $pin['icon'] );
	}

	// Info window content.
	$marker['info_window'] = $pin['info_window'];

	// Fixed options: animation & info window max width.
	$marker['animation'] = 2; // google.maps.Animation.DROP;
	$marker['info_window_max_width'] = 300;

	// Push to array.
	$markers[] = $marker;
endforeach;

// Merge markers with map options.
$attr = apply_filters( 'jackrose_siteorigin_google_maps_args', array(
	'options' => array(
		'center' => array( 'lat' => floatval( $center['lat'] ), 'lng' => floatval( $center['long'] ) ),
		'disableDefaultUI' => true,
		'draggable' => $instance['draggable'],
		'scrollwheel' => false,
		'zoom' => $instance['zoom'],
		'zoomControl' => true,
		'styles' => json_decode( $instance['style'] ),
	),
	'locations' => $markers,
) );

?>
<div class="jackrose-sow-google-maps" data-jackrose-target="gmaps-<?php echo esc_attr( $id ); ?>" data-jackrose-arguments="<?php echo esc_attr( json_encode( $attr ) ); ?>" data-jackrose-api-key="<?php echo esc_attr( $instance['api_key'] ); ?>">
	<div id="gmaps-<?php echo esc_attr( $id ); ?>"></div>
	<style type="text/css">
	#gmaps-<?php echo ( $id ); ?> {
		height: <?php echo $instance['height']; ?>px;
	}
	@media screen and ( max-width: 767px ) {
		#gmaps-<?php echo ( $id ); ?> {
			height: <?php echo $instance['height_mobile']; ?>px;
		}
	}
	</style>
</div><!-- .jackrose-sow-google-maps -->