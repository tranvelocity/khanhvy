<?php
/*
Widget Name: Jack & Rose: RSVP Form
Description: RSVP form via Contact Form 7
Author: SingleStroke
Author URI: https://singlestroke.io/
*/

class JackRose_SOW_RSVP_Form extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'jackrose-sow-rsvp-form',
			esc_html__( 'Jack & Rose: RSVP Form', 'jackrose' ),
			array(
				'description' => esc_html__( 'RSVP form via Contact Form 7', 'jackrose' ),
				'panels_groups' => array( 'jackrose' ),
			),
			array(

			),
			array(
				'form' => array(
					'type' => 'select',
					'label' => esc_html__( 'Form', 'jackrose' ),
					'description' => wp_kses( __( 'Please install <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> plugin and create a new form, and then select the form here.', 'jackrose' ), array( 'a' => array( 'href' => array() ) ) ),
					'options' => jackrose_get_contact_form_7_posts(),
					'default' => 'center',
				),
			),
			JACKROSE_SITEORIGIN_DIR . '/widgets/jackrose-sow-rsvp-form/'
		);
	}
}

siteorigin_widget_register( 'jackrose-sow-rsvp-form', __FILE__, 'JackRose_SOW_RSVP_Form' );

function jackrose_get_contact_form_7_posts() {
	$array = get_posts( array(
		'post_type' => 'wpcf7_contact_form',
		'orderby' => 'title',
	) );
	$return = array();

	foreach ( $array as $form ) {
		$return[ $form->ID ] = $form->post_title;
	}

	return $return;
}