<?php
/*
Widget Name: Jack & Rose: Events Grid
Description: Event boxes in grid layout.
Author: SingleStroke
Author URI: https://singlestroke.io/
*/

class JackRose_SOW_Events_Grid extends SiteOrigin_Widget {
	function __construct() {
		global $jackrose_data;

		parent::__construct(
			'jackrose-sow-events-grid',
			esc_html__( 'Jack & Rose: Events Grid', 'jackrose' ),
			array(
				'description' => esc_html__( 'Event boxes in grid layout.', 'jackrose' ),
				'panels_groups' => array( 'jackrose' ),
			),
			array(
				
			),
			array(
				'events' => array(
					'type' => 'repeater',
					'label' => esc_html__( 'Events', 'jackrose' ),
					'item_name' => esc_html__( 'Event', 'jackrose' ),
					'item_label' => array(
						'selector' => "[id*='title']",
						'update_event' => 'change',
						'value_method' => 'val',
					),
					'fields' => array(
						'title' => array(
							'type' => 'text',
							'label' => esc_html__( 'Event title', 'jackrose' ),
						),
						'photo' => array(
							'type' => 'media',
							'label' => esc_html__( 'Photo', 'jackrose' ),
							'library' => 'image',
						),
						'photo_link' => array(
							'type' => 'link',
							'label' => esc_html__( 'Photo link', 'jackrose' ),
						),
						'description' => array(
							'type' => 'tinymce',
							'label' => esc_html__( 'Description', 'jackrose' ),
							'rows' => 3,
						),
						'summary' => array(
							'type' => 'text',
							'label' => esc_html__( 'Summary', 'jackrose' ),
							'description' => esc_html__( 'Contains event summary: when & where the event will be held.', 'jackrose' ),
						),
						'icon' => array(
							'type' => 'media',
							'label' => esc_html__( 'Icon', 'jackrose' ),
							'description' => esc_html__( 'Max size: 60x60px', 'jackrose' ),
							'library' => 'image',
						),
						'bg_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'BG Color', 'jackrose' ),
						),
					),
				),
				'columns' => array(
					'type' => 'slider',
					'label' => esc_html__( 'Number of columns', 'jackrose' ),
					'min' => 1,
					'max' => 4,
					'default' => 2,
					'integer' => true,
				),
				'animation' => array(
					'type' => 'select',
					'label' => esc_html__( 'Item Animation', 'jackrose' ),
					'description' => esc_html__( 'Custom enter animation for each item.', 'jackrose' ),
					'options' => array(
						false => esc_html__( 'Disabled', 'jackrose' ),
						'fade-in' => esc_html__( 'Fade In', 'jackrose' ),
						'fade-in-up' => esc_html__( 'Fade In Up', 'jackrose' ),
					),
					'default' => 'none',
				),
			),
			JACKROSE_SITEORIGIN_DIR . '/widgets/jackrose-sow-events-grid/'
		);
	}
}

siteorigin_widget_register( 'jackrose-sow-events-grid', __FILE__, 'JackRose_SOW_Events_Grid' );