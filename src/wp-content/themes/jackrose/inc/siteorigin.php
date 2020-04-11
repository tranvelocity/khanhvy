<?php
/**
 * Jack & Rose SiteOrigin functions and definitions.
 *
 * @package Jack_&_Rose
 */

/**
 * Add custom widgets.
 */
function jackrose_siteorigin_widgets_widget_folders( $folders ) {
	$folders[] = JACKROSE_SITEORIGIN_DIR . '/widgets/';
	return $folders;
}
add_filter( 'siteorigin_widgets_widget_folders', 'jackrose_siteorigin_widgets_widget_folders' );

/**
 * Add custom row styles options.
 */
function jackrose_siteorigin_panels_row_style_fields( $fields ) {
	// Anchor ID.
	$fields['anchor'] = array(
		'name' => esc_html__( 'Anchor ID', 'jackrose' ),
		'type' => 'text',
		'group' => 'attributes',
		'description' => esc_html__( 'Used in Smooth Scrolling navigation. Please enter alphanumeric, dash ( _ ), and hyphen ( - ) only.', 'jackrose' ),
		'priority' => 11,
	);

	// Jackrose Parallax
	$fields['background_display']['options']['jackrose-parallax'] = esc_html__( 'Jackrose Parallax', 'jackrose' );

	return $fields;
}
add_filter( 'siteorigin_panels_row_style_fields', 'jackrose_siteorigin_panels_row_style_fields' );

/**
 * Add custom widget styles options.
 */
function jackrose_siteorigin_panels_widget_style_fields( $fields ) {
	// Anchor ID.
	$fields['anchor'] = array(
		'name' => esc_html__( 'Anchor ID', 'jackrose' ),
		'type' => 'text',
		'group' => 'attributes',
		'description' => esc_html__( 'Used in Smooth Scrolling navigation. Please enter alphanumeric, dash ( _ ), and hyphen ( - ) only.', 'jackrose' ),
		'priority' => 11,
	);

	// Animation.
	$fields['animation'] = array(
		'name' => esc_html__( 'Animation', 'jackrose' ),
		'type' => 'select',
		'group' => 'attributes',
		'description' => esc_html__( 'Widget\'s enter (inview) animation.', 'jackrose' ),
		'options' => array(
			false => esc_html__( 'Disabled', 'jackrose' ),
			'fade-in' => esc_html__( 'Fade In', 'jackrose' ),
			'fade-in-up' => esc_html__( 'Fade In Up', 'jackrose' ),
		),
		'priority' => 12,
	);
	
	return $fields;
}
add_filter( 'siteorigin_panels_widget_style_fields', 'jackrose_siteorigin_panels_widget_style_fields' );

/**
 * Add custom widget attributes.
 */
function jackrose_siteorigin_panels_widget_style_attributes( $attributes, $args ) {
	if ( ! empty( $args['anchor'] ) ) {
		$attributes['id'] = esc_attr( $args['anchor'] );
		$attributes['data-jackrose-anchor'] = esc_attr( $args['anchor'] );
	}

	if ( ! empty( $args['animation'] ) ) {
		$attributes['class'][] = 'jackrose-animation-' . esc_attr( $args['animation'] );
	}

	if ( ! empty( $args['background_display'] ) && ! empty( $args['background_image_attachment'] ) ) {
		$img = wp_get_attachment_image_src( $args['background_image_attachment'], 'full' );

		if ( ! empty( $img ) && 'jackrose-parallax' == $args['background_display'] ) {
			// Remove background-image inline style.
			$attributes['style'] = preg_replace( '/background-image: url\((.*?)\);/', '', $attributes['style'] );
			
			// Construct data for generating parallax background on javascript.
			$attributes['data-jackrose-background-parallax'] = json_encode( array(
				'src' => $img[0],
				'width' => $img[1],
				'height' => $img[2],
				'ratio' => apply_filters( 'jackrose_parallax_ratio', 0.5 ),
			) );
		}
	}

	return $attributes;
}
add_filter( 'siteorigin_panels_widget_style_attributes', 'jackrose_siteorigin_panels_widget_style_attributes', 10, 2 );
add_filter( 'siteorigin_panels_row_style_attributes', 'jackrose_siteorigin_panels_widget_style_attributes', 10, 2 );

/**
 * Add dialog tabs.
 */
function jackrose_siteorigin_panels_widget_dialog_tabs( $tabs ) {
	$tabs['jackrose'] = array(
		'title' => esc_html__( 'Jack & Rose', 'jackrose' ) . ' <span class="dashicons dashicons-warning"></span>',
		'filter' => array(
			'groups' => array( 'jackrose' ),
		),
	);

	return $tabs;
}
add_filter( 'siteorigin_panels_widget_dialog_tabs', 'jackrose_siteorigin_panels_widget_dialog_tabs' );

/**
 * Set recommended widgets.
 */
function jackrose_siteorigin_widgets_groups( $widgets ) {
	$widgets['SiteOrigin_Widget_Editor_Widget']['groups'][] = 'jackrose';
	$widgets['SiteOrigin_Widget_Image_Widget']['groups'][] = 'jackrose';
	$widgets['SiteOrigin_Panels_Widgets_Layout']['groups'][] = 'jackrose';
	return $widgets;
}
add_filter( 'siteorigin_panels_widgets', 'jackrose_siteorigin_widgets_groups', 20 );

/**
 * Force activate the custom widgets.
 */
function jackrose_siteorigin_widgets_active_widgets( $widgets ) {
	$widgets['sow-editor'] = true;
	$widgets['sow-image'] = true;

	$dirs = glob( JACKROSE_SITEORIGIN_DIR . '/widgets/*', GLOB_ONLYDIR );

	foreach ( $dirs as $dir ) {
		$dir = str_replace( JACKROSE_SITEORIGIN_DIR . '/widgets/', '', $dir );
		$widgets[ $dir ] = true;
	}

	return $widgets;
}
add_filter( 'siteorigin_widgets_active_widgets', 'jackrose_siteorigin_widgets_active_widgets' );

/**
 * Set panels setting (FORCE CONFIGURATION).
 */
function jackrose_siteorigin_panels_settings() {
	$configurations = get_option( 'siteorigin_panels_settings' );

	$configurations['responsive'] = true;
	$configurations['mobile-width'] = 767;
	$configurations['margin-bottom'] = 30;
	$configurations['margin-sides'] = 30;

	// Save changes.
	update_option( 'siteorigin_panels_settings', $configurations );
}
add_action( 'init', 'jackrose_siteorigin_panels_settings', 1 );

/**
 * Empty cell class.
 */
function jackrose_siteorigin_panels_render( $html, $post_id, $post ) {
	$html = preg_replace( '/>&nbsp;<\/(.*?)>/', '></$1>', $html );

	return $html;
}
add_filter( 'siteorigin_panels_render', 'jackrose_siteorigin_panels_render', 10, 3 );

/**
 * Add prebuilt layouts.
 */
function jackrose_siteorigin_panels_prebuilt_layouts( $layouts ) {
	$layouts['home'] = include( JACKROSE_SITEORIGIN_DIR . '/prebuilts/home.php' );
	$layouts['invitation'] = include( JACKROSE_SITEORIGIN_DIR . '/prebuilts/invitation.php' );

	return $layouts;
}
add_filter( 'siteorigin_panels_prebuilt_layouts', 'jackrose_siteorigin_panels_prebuilt_layouts' );