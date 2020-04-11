<?php
/**
 * Procedures which run automatically for version migrating.
 *
 * @package Jack_&_Rose
 */

/**
 * Create version option key.
 */
if ( ! get_option( JACKROSE_VERSION_OPTION_KEY ) ) {
	add_option( JACKROSE_VERSION_OPTION_KEY, '1.0.0' );
}

/**
 * Migrate to v1.3.
 */
if ( version_compare( '1.3.0', get_option( JACKROSE_VERSION_OPTION_KEY ) ) > 0 ) {
	/**
	 * New options structure.
	 */
	$old = get_theme_mods();

	// Check if there is existing data.
	if ( ! empty( $old ) ) {
		// Define new values array.
		$new = array();

		// Hero slider autoplay convert from "seconds" to "miliseconds".
		$new['hero_slider_autoplay'] = jackrose_get_theme_mod( 'hero_slider_autoplay' ) * 1000;

		// Convert "Hero position" to "Header position".
		$new['header_position'] = ( 'below-header' == jackrose_get_theme_mod( 'hero_position' ) ? 'top' : 'bottom' );

		// Join the array.
		$join = array_merge( $old, $new );

		// Save new options.
		update_option( JACKROSE_CUSTOMIZER_OPTION_KEY, $join );
	}

	/**
	 * Update migration status.
	 */
	update_option( JACKROSE_VERSION_OPTION_KEY, '1.3.0' );
}

/**
 * Migrate to v1.4.
 */
if ( version_compare( '1.4.0', get_option( JACKROSE_VERSION_OPTION_KEY ) ) > 0 ) {
	/**
	 * Migrate SiteOrigin Widgets.
	 */
	$posts = get_posts( array(
		'post_type' => get_post_types(),
		'posts_per_page' => -1,
		'meta_key' => 'panels_data',
	) );

	// Check if there is existing data.
	if ( ! empty( $posts ) ) {
		// Iterate to each posts to refactor its panels_data.
		foreach ( $posts as $p ) {
			// Get panels_data value.
			$pm = get_post_meta( $p->ID, 'panels_data', true );

			// Change class name on all widgets.
			foreach ( $pm['widgets'] as &$w ) {
				if ( ! array_key_exists( 'panels_info', $w ) || ! array_key_exists( 'class', $w['panels_info'] ) ) continue;

				$w['panels_info']['class'] = str_replace( 'JackRose_SO_', 'JackRose_SOW_', $w['panels_info']['class'] );

				if ( 'JackRose_SOW_Event_Grid' == $w['panels_info']['class'] ) {
					$w['panels_info']['class'] = 'JackRose_SOW_Events_Grid';
				}

				if ( 'JackRose_SOW_Crew' == $w['panels_info']['class'] ) {
					$w['panels_info']['class'] = 'JackRose_SOW_Team_Grid';
				}
			}

			// Change jr-parallax to jackrose-parallax on all row attributes.
			foreach ( $pm['grids'] as &$g ) {
				if ( ! array_key_exists( 'style', $g ) || ! array_key_exists( 'background_display', $g['style'] ) ) continue;

				if ( 'jr-parallax' == $g['style']['background_display'] ) {
					$g['style']['background_display'] = 'jackrose-parallax';
				}
			}

			update_post_meta( $p->ID, 'panels_data', $pm );
		}
	};

	/**
	 * Migrate Customizer options.
	 */
	$customizer = get_option( JACKROSE_CUSTOMIZER_OPTION_KEY, array() );

	// Check if there is existing data.
	if ( ! empty( $customizer ) ) {
		// Custom CSS classes.
		if ( array_key_exists( 'custom_css', $customizer ) && ! empty( $customizer['custom_css'] ) ) {
			$customizer['custom_css'] = str_replace( 'jr-so-', 'jackrose-sow-', $customizer['custom_css'] );
			$customizer['custom_css'] = str_replace( 'jr-', 'jackrose-', $customizer['custom_css'] );
		}

		// Save new options.
		update_option( JACKROSE_CUSTOMIZER_OPTION_KEY, $customizer );
	}

	/**
	 * Update migration status.
	 */
	update_option( JACKROSE_VERSION_OPTION_KEY, '1.4.0' );
}