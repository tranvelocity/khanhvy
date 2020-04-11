<?php
/*
Widget Name: Jack & Rose: Guestbook
Description: Guestbook via Gwolle Guestbook
Author: SingleStroke
Author URI: https://singlestroke.io/
*/

class JackRose_SOW_Guestbook extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'jackrose-sow-guestbook',
			esc_html__( 'Jack & Rose: Guestbook', 'jackrose' ),
			array(
				'description' => esc_html__( 'Guestbook via Gwolle Guestbook', 'jackrose' ),
				'panels_groups' => array( 'jackrose' ),
			),
			array(

			),
			array(
				'mode' => array(
					'type' => 'select',
					'label' => esc_html__( 'Guestbook mode', 'jackrose' ),
					'description' => wp_kses( __( 'Please install <a href="https://wordpress.org/plugins/gwolle-gb/">Gwolle Guestbook</a> plugin and go to Guestbook Settings page, and then select the form mode here.', 'jackrose' ), array( 'a' => array( 'href' => array() ) ) ),
					'options' => array(
						'write-read' => esc_html__( 'Form and list', 'jackrose' ),
						'write' => esc_html__( 'Form only', 'jackrose' ),
						'read' => esc_html__( 'List only', 'jackrose' ),
					),
					'default' => 'write-read',
				),
				'global' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Use as global Guestbook ID.', 'jackrose' ),
					'description' => esc_html__( 'Disable this option will make unique Guestbook ID according to the current page ID. All entries in other pages would not appear in this Guestbook.', 'jackrose' ),
					'default' => true,
				),
			),
			JACKROSE_SITEORIGIN_DIR . '/widgets/jackrose-sow-guestbook/'
		);
	}
}

siteorigin_widget_register( 'jackrose-sow-guestbook', __FILE__, 'JackRose_SOW_Guestbook' );
