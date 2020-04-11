<?php
/*
Widget Name: Jack & Rose: Team Grid
Description: Lists of crew members.
Author: SingleStroke
Author URI: https://singlestroke.io/
*/

class JackRose_SOW_Team_Grid extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'jackrose-sow-team-grid',
			esc_html__( 'Jack & Rose: Team Grid', 'jackrose' ),
			array(
				'description' => esc_html__( 'Lists of team members.', 'jackrose' ),
				'panels_groups' => array( 'jackrose' ),
			),
			array(
				
			),
			array(
				'members' => array(
					'type' => 'repeater',
					'label' => esc_html__( 'People List', 'jackrose' ),
					'item_name' => esc_html__( 'Person', 'jackrose' ),
					'item_label' => array(
						'selector' => "[id*='name']",
						'update_event' => 'change',
						'value_method' => 'val',
					),
					'fields' => array(
						'name' => array(
							'type' => 'text',
							'label' => esc_html__( 'Name', 'jackrose' ),
						),
						'photo' => array(
							'type' => 'media',
							'label' => esc_html__( 'Photo', 'jackrose' ),
							'library' => 'image',
						),
					),
				),
				'columns' => array(
					'type' => 'slider',
					'label' => esc_html__( 'Number of columns', 'jackrose' ),
					'min' => 1,
					'max' => 4,
					'default' => 4,
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
			JACKROSE_SITEORIGIN_DIR . '/widgets/jackrose-sow-team-grid/'
		);
	}
}

siteorigin_widget_register( 'jackrose-sow-team-grid', __FILE__, 'JackRose_SOW_Team_Grid' );