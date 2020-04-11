<?php
/*
Widget Name: Jack & Rose: Quote
Description: Blockquote with citation.
Author: SingleStroke
Author URI: https://singlestroke.io/
*/

class JackRose_SOW_Quote extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'jackrose-sow-quote',
			esc_html__( 'Jack & Rose: Quote', 'jackrose' ),
			array(
				'description' => esc_html__( 'Blockquote with citation.', 'jackrose' ),
				'panels_groups' => array( 'jackrose' ),
			),
			array(

			),
			array(
				'quotes' => array(
					'type' => 'repeater',
					'label' => esc_html__( 'Quotes', 'jackrose' ),
					'item_name' => esc_html__( 'Quote', 'jackrose' ),
					'item_label' => array(
						'selector' => "[id*='text']",
						'update_event' => 'change',
						'value_method' => 'val',
					),
					'fields' => array(
						'text' => array(
							'type' => 'textarea',
							'label' => esc_html__( 'Quote text', 'jackrose' ),
						),
						'name' => array(
							'type' => 'text',
							'label' => esc_html__( 'Name', 'jackrose' ),
						),
					),
				),
				'autoplay' => array(
					'type' => 'number',
					'label' => esc_html__( 'Autoslide (miliseconds)', 'jackrose' ),
					'description' => esc_html__( '0 means no autoslide.', 'jackrose' ),
					'default' => 5000,
				),
				'alignment' => array(
					'type' => 'select',
					'label' => esc_html__( 'Alignment', 'jackrose' ),
					'options' => array(
						'left' => esc_html__( 'Left', 'jackrose' ),
						'center' => esc_html__( 'Center', 'jackrose' ),
						'right' => esc_html__( 'Right', 'jackrose' ),
					),
					'default' => 'center',
				),
			),
			JACKROSE_SITEORIGIN_DIR . '/widgets/jackrose-sow-quote/'
		);
	}

	function initialize() {
		$this->register_frontend_scripts( array(
			array(
				'flickity',
				JACKROSE_SITEORIGIN . '/widgets/jackrose-sow-quote/js/flickity.pkgd.min.js',
				array( 'jquery' ),
				'1.2.1',
				true,
			),
		) );
		$this->register_frontend_styles( array(
			array(
				'flickity',
				JACKROSE_SITEORIGIN . '/widgets/jackrose-sow-quote/css/flickity.min.css',
				array(),
				'1.2.1',
			),
		) );
	}
}

siteorigin_widget_register( 'jackrose-sow-quote', __FILE__, 'JackRose_SOW_Quote' );