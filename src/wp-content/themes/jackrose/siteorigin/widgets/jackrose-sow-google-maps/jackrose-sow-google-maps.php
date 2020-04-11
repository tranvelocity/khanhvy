<?php
/*
Widget Name: Jack & Rose: Google Maps
Description: Gooble Maps with pin locations.
Author: SingleStroke
Author URI: https://singlestroke.io/
*/

class JackRose_SOW_Google_Maps extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'jackrose-sow-google-maps',
			esc_html__( 'Jack & Rose: Google Maps', 'jackrose' ),
			array(
				'description' => esc_html__( 'Gooble Maps with pin locations.', 'jackrose' ),
				'panels_groups' => array( 'jackrose' ),
			),
			array(

			),
			array(
				'center' => array(
					'type' => 'text',
					'label' => esc_html__( 'Default center point coordinate', 'jackrose' ),
					'description' => esc_html__( 'Format: [latitude], [longitude]. e.g. "-7.966620, 112.632632"', 'jackrose' ),
				),
				'pins' => array(
					'type' => 'repeater',
					'label' => esc_html__( 'Pins', 'jackrose' ),
					'item_name' => esc_html__( 'Location', 'jackrose' ),
					'item_label' => array(
						'selector' => "[id*='title']",
						'update_event' => 'change',
						'value_method' => 'val',
					),
					'fields' => array(
						'latlong' => array(
							'type' => 'text',
							'label' => esc_html__( 'Coordinate', 'jackrose' ),
							'description' => esc_html__( 'Format: [latitude], [longitude]. e.g. "-7.966620, 112.632632"', 'jackrose' ),
						),
						'icon' => array(
							'type' => 'media',
							'label' => esc_html__( 'Icon', 'jackrose' ),
							'library' => 'image',
						),
						'info_window' => array(
							'type' => 'tinymce',
							'label' => esc_html__( 'Content (info window)', 'jackrose' ),
						),
					),
				),
				'height' => array(
					'type' => 'slider',
					'label' => esc_html__( 'Height', 'jackrose' ),
					'min' => 0,
					'max' => 800,
					'default' => 600,
					'integer' => true,
				),
				'height_mobile' => array(
					'type' => 'slider',
					'label' => esc_html__( 'Height (mobile)', 'jackrose' ),
					'min' => 0,
					'max' => 800,
					'default' => 340,
					'integer' => true,
				),
				'zoom' => array(
					'type' => 'slider',
					'label' => esc_html__( 'Zoom level', 'jackrose' ),
					'min' => 0,
					'max' => 18,
					'default' => 15,
					'integer' => true,
				),
				'draggable' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Draggable maps', 'jackrose' ),
					'default' => true,
				),
				'style' => array(
					'type' => 'textarea',
					'label' => esc_html__( 'Style JSON', 'jackrose' ),
					'description' => wp_kses( __( 'Get pre-styled JSON from %s or create your own at <a href="https://snazzymaps.com/">Snazzy Maps</a>.', 'jackrose' ), array( 'a' => array( 'href' => array() ) ) ),
					'default' => '[{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]',
				),
				'api_key' => array(
					'type' => 'text',
					'label' => esc_html__( 'API key (required)', 'jackrose' ),
					'description' => wp_kses( __( 'Since June 22, 2016: Usage of the Google Maps APIs now requires a key. Get your API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">here</a> and then paste the generated API key here.', 'jackrose' ), array( 'a' => array( 'href' => array() ) ) ),
				),
			),
			JACKROSE_SITEORIGIN_DIR . '/widgets/jackrose-sow-google-maps/'
		);
	}

	function initialize() {
		$this->register_frontend_scripts( array(
			array(
				'google-maps-init',
				JACKROSE_SITEORIGIN . '/widgets/jackrose-sow-google-maps/js/jackrose-google-map-init.js',
				array(),
				'',
				true,
			),
		) );
	}

	function modify_instance( $instance ) {
		/**
		 * Add 'info_window' separated from 'title'.
		 * @since 1.4.0
		 */
		if ( array_key_exists( 'pins', $instance ) && count( $instance['pins'] ) > 0 ) {
			foreach ( $instance['pins'] as &$pin ) {
				// check if there is no info_window
				if ( ! empty( $pin['title'] ) && empty( $pin['info_window'] ) ) {
					$pin['info_window'] = $pin['title'];
					unset( $pin['title'] );
				}
			}
		}

		return $instance;
	}
}

siteorigin_widget_register( 'jackrose-sow-google-maps', __FILE__, 'JackRose_SOW_Google_Maps' );