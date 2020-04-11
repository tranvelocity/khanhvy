<?php
/**
 * Import demo data functions.
 *
 * @package Jack_&_Rose
 */

/**
 * Admin page setup.
 */
function jackrose_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = get_template() . '-dashboard';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'jackrose' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'jackrose' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = get_template() . '-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'jackrose_ocdi_plugin_page_setup' );

/**
 * Demo data list.
 */
function jackrose_ocdi_import_files( $list ) {
	$list[] = array(
		'import_file_name'           => 'Demo Data v1.5',
		'import_file_url'            => JACKROSE_DEMO . '/default/posts.xml',
		'import_widget_file_url'     => JACKROSE_DEMO . '/default/widgets.json',
		'import_customizer_file_url' => JACKROSE_DEMO . '/default/customizer.ser',
		'import_preview_image_url'   => JACKROSE_DEMO . '/default/thumbnail.png',
	);
	return $list;
}
add_filter( 'pt-ocdi/import_files', 'jackrose_ocdi_import_files' );

/**
 * Delete default posts.
 */
function jackrose_ocdi_delete_defaults_posts() {
	wp_delete_post( 1, true ); // "Hello world!"
	wp_delete_post( 2, true ); // "Sample Page"
	wp_delete_post( 3, true ); // "(Auto Draft)"
	wp_delete_post( 4, true ); // "Contact Form 1"
}
add_action( 'import_start', 'jackrose_ocdi_delete_defaults_posts', 99 );

/**
 * Remove default widgets on sidebar.
 */
function jackrose_ocdi_before_widgets_import( $selected_import ) {
	$sidebar_widgets = get_option( 'sidebars_widgets' );
	if ( isset( $sidebar_widgets['sidebar'] ) ) {
		$sidebar_widgets['sidebar'] = array();
		update_option( 'sidebars_widgets', $sidebar_widgets );
	}
}
add_action( 'pt-ocdi/before_widgets_import', 'jackrose_ocdi_before_widgets_import' );

/**
 * Add intro text.
 */
function jackrose_ocdi_plugin_intro_text( $default_text ) {
	$default_text .= '<div class="ocdi__intro-text"><p>' . esc_html__( 'Some images might be converted to blank gray images, due to a copyright policy from the original owner. It is normal, and you can easily change them to your own images.', 'jackrose' ) . '</p></div>';

	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'jackrose_ocdi_plugin_intro_text' );

/**
 * Apply demo settings.
 */
function jackrose_ocdi_after_import( $selected_import ) {
	/**
	 * Front page settings.
	 */
	// Set front page display option to "Static page".
	update_option( 'show_on_front', 'page', true );

	// Front page id.
	$page_on_front = get_page_by_path( 'home-slider' );
	if ( $page_on_front ) {
		update_option( 'page_on_front', $page_on_front->ID );
	}

	// Blog page id.
	$page_for_posts = get_page_by_path( 'blog' );
	if ( $page_for_posts ) {
		update_option( 'page_for_posts', $page_for_posts->ID );
	}

	/**
	 * Assign images on customizer options.
	 */
	// Get customizer option.
	$customizer = get_option( JACKROSE_CUSTOMIZER_OPTION_KEY );

	// Declare theme_mod key and image slug.
	$images = array(
		// theme_mod key => image slug
		'preloader_logo' => 'hero-logo',
		'hero_logo' => 'hero-logo',
		'header_logo' => 'header-logo',
		'footer_logo' => 'footer-logo',
		'footer_bg_image' => 'footer',
	);

	foreach ( $images as $theme_mod_key => $image_slug ) {
		// Get attachment object.
		$image_obj = jackrose_get_attachment_by_slug( $image_slug );

		if ( $image_obj ) {
			// Set value to attachment url.
			$customizer[ $theme_mod_key ] = wp_get_attachment_url( $image_obj->ID );
		}
	}

	// Save customizer option.
	update_option( JACKROSE_CUSTOMIZER_OPTION_KEY, $customizer );

	/**
	 * Change all absolute URLs in customizer to current site URLs.
	 */
	// Get customizer option.
	$customizer = get_option( JACKROSE_CUSTOMIZER_OPTION_KEY );

	// Declare theme_mod key.
	$texts = array(
		'header_ribbon_href',
	);

	foreach ( $texts as $text ) {
		// Change ribbon menu URL.
		$customizer[ $text ] = str_replace( 'http://singlestroke.io/demo/jackrose-wp', home_url(), $customizer[ $text ] );
	}

	// Save customizer option.
	update_option( JACKROSE_CUSTOMIZER_OPTION_KEY, $customizer );

	/**
	 * Assign menu location.
	 */
	// Get all nav menu locations.
	$nav_menu_locations = get_theme_mod( 'nav_menu_locations', array() );

	// Declare menu location and menu object slug.
	$nav_menus = array( 
		// location => menu slug
		'primary' => 'primary',
	);

	foreach ( $nav_menus as $nav_location => $nav_menu_slug ) {
		// Get menu object.
		$menu_obj = wp_get_nav_menu_object( $nav_menu_slug );

		if ( $menu_obj ) {
			// Set location.
			$nav_menu_locations[ $nav_location ] = $menu_obj->term_id;

			// Get menu items.
			$menu_items = wp_get_nav_menu_items( $nav_menu_slug );

			foreach ( $menu_items as $menu_item ) {
				// Replace all custom link domain url to current domain url.
				if ( 'custom' == $menu_item->type ) {

					// Update menu item url.
					update_post_meta( $menu_item->ID, '_menu_item_url', str_replace( 'http://singlestroke.io/demo/jackrose-wp', home_url(), $menu_item->url ) );
				}
			}
		}
	}
	
	// Save location changes
	set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
}
add_action( 'pt-ocdi/after_import', 'jackrose_ocdi_after_import' );
