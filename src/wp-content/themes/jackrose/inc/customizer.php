<?php
/**
 * Jack & Rose Theme Customizer.
 *
 * @package Jack_&_Rose
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $jackrose_data;

// SingleStroke wrapper class & functions for Kirki.
require_once( JACKROSE_INCLUDES_DIR . '/singlestroke-kirki.php' );

/**
 * Register Customizer config.
 */
function jackrose_kirki_custom_css() {
	?>
	<style type="text/css">
		.customize-control {
			margin-bottom: 24px;
		}
		.customize-control-kirki-typography .wrapper,
		.customize-control-kirki-spacing .wrapper {
			width: auto !important;
			padding: 10px 10px 15px !important;
			box-shadow: none !important;
			background-color: #fff;
			margin: 10px 0 0;
		}
		.customize-control-kirki-typography .wrapper > *,
		.customize-control-kirki-spacing .wrapper > * {
			padding: 0 5px;
			box-sizing: border-box;
		}
		.customize-control-kirki-switch .switch {
			margin-bottom: 0 !important;
		}
		.customize-control-kirki-switch .switch label {
			display: table;
			margin-bottom: 0 !important;
		}
		.customize-control-kirki-switch .switch-off, .customize-control-kirki-switch .switch-on {
			display: table-cell;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'jackrose_kirki_custom_css' );

/**
 * Register Customizer config.
 */
SingleStroke_Kirki::add_config( 'jackrose', array(
	'option_type' => 'option',
	'option_name' => JACKROSE_CUSTOMIZER_OPTION_KEY,
) );

/**
 * Register Customizer sections.
 */
$i = 160;
SingleStroke_Kirki::add_section( 'preloader', array(
	'title'    => esc_html__( 'Preloader', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'background_music', array(
	'title'    => esc_html__( 'Background Music', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'styles', array(
	'title'    => esc_html__( 'Styles', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'header', array(
	'title'    => esc_html__( 'Header', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'hero', array(
	'title'    => esc_html__( 'Hero Section', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'sidebar', array(
	'title'    => esc_html__( 'Sidebar', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'footer', array(
	'title'    => esc_html__( 'Footer', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'invitation', array(
	'title'    => esc_html__( 'Invitation Page Template', 'jackrose' ),
	'priority' => ++$i,
) );
SingleStroke_Kirki::add_section( 'custom_css', array(
	'title'    => esc_html__( 'Custom CSS', 'jackrose' ),
	'priority' => ++$i,
) );

/**
 * Register Customizer options.
 */
$hr = 0;

// Preloader.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'preloader',
	'section'     => 'preloader',
	'type'        => 'multicheck',
	'label'       => esc_html__( 'Show preloader on', 'jackrose' ),
	'choices'     => array(
		'one-page'   => esc_html__( 'One Page template pages', 'jackrose' ),
		'invitation' => esc_html__( 'Invitation template pages', 'jackrose' ),
		'standard'   => esc_html__( 'Standard pages', 'jackrose' ),
	),
	'default'     => array( 'one-page' ),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_preloader_bg',
	'section'     => 'preloader',
	'type'        => 'color',
	'label'       => esc_html__( 'BG color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#b4d2c8',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '#preloader, .pace-progress',
			'property' => 'background-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'preloader_logo',
	'section'     => 'preloader',
	'type'        => 'image',
	'label'       => esc_html__( 'Preloader logo', 'jackrose' ),
	'description' => esc_html__( 'Recommended to have the same dimension as hero logo.', 'jackrose' ),
	'default'     => '',
) );

// Background music.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music',
	'section'     => 'background_music',
	'type'        => 'multicheck',
	'label'       => esc_html__( 'Play background music on', 'jackrose' ),
	'choices'     => array(
		'one-page' => esc_html__( 'One Page template pages', 'jackrose' ),
		'invitation' => esc_html__( 'Invitation template pages', 'jackrose' ),
		'standard' => esc_html__( 'Standard pages', 'jackrose' ),
	),
	'default'     => array( 'one-page' ),
	'partial_refresh' => array(
		'background_music' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music_position',
	'section'     => 'background_music',
	'type'        => 'select',
	'label'       => esc_html__( 'Widget position', 'jackrose' ),
	'choices'     => array(
		'bottom-right' => esc_html__( 'bottom right', 'jackrose' ),
		'bottom-left'  => esc_html__( 'bottom left', 'jackrose' ),
	),
	'default'     => 'bottom-right',
	'partial_refresh' => array(
		'background_music_position' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music_source',
	'section'     => 'background_music',
	'type'        => 'select',
	'label'       => esc_html__( 'Source', 'jackrose' ),
	'choices'     => array(
		'embed' => esc_html__( 'Youtube / Vimeo embed code', 'jackrose' ),
		'mp3'   => esc_html__( 'MP3 file', 'jackrose' ),
	),
	'default'     => 'embed',
	'partial_refresh' => array(
		'background_music_source' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music_embed',
	'section'     => 'background_music',
	'type'        => 'textarea',
	'label'       => esc_html__( 'Music embed code, e.g. Souncloud embed code', 'jackrose' ),
	'description' => esc_html__( 'If filled, an icon would appear on the bottom right of the page to control the music playback. You can leave this option blank to disable background music.', 'jackrose' ),
	'active_callback' => array(
		array(
			'setting'  => 'background_music_source',
			'operator' => '==',
			'value'    => 'embed',
		),
	),
	'partial_refresh' => array(
		'background_music_embed' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
	'sanitize_callback' => 'jackrose_unfiltered_sanitize',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music_mp3',
	'section'     => 'background_music',
	'type'        => 'upload',
	'label'       => esc_html__( 'Use MP3 file', 'jackrose' ),
	'active_callback' => array(
		array(
			'setting'  => 'background_music_source',
			'operator' => '==',
			'value'    => 'mp3',
		),
	),
	'partial_refresh' => array(
		'background_music_mp3' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music_mp3_autoplay',
	'section'     => 'background_music',
	'type'        => 'switch',
	'label'       => esc_html__( 'MP3 autoplay', 'jackrose' ),
	'default'     => 1,
	'active_callback' => array(
		array(
			'setting'  => 'background_music_source',
			'operator' => '==',
			'value'    => 'mp3',
		),
	),
	'partial_refresh' => array(
		'background_music_mp3_autoplay' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'background_music_mp3_loop',
	'section'     => 'background_music',
	'type'        => 'switch',
	'label'       => esc_html__( 'MP3 loop', 'jackrose' ),
	'default'     => 1,
	'active_callback' => array(
		array(
			'setting'  => 'background_music_source',
			'operator' => '==',
			'value'    => 'mp3',
		),
	),
	'partial_refresh' => array(
		'background_music_mp3_loop' => array(
			'selector'        => '#background-music',
			'render_callback' => 'jackrose_background_music',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'note_background_music',
	'section'     => 'background_music',
	'type'        => 'custom',
	'label'       => esc_html__( 'More..', 'jackrose' ),
	'default'     => wp_kses(
		__( 'For more customizable background music, we suggest you to use <a href="https://wordpress.org/plugins/soundy-background-music/">Soundy Background Music</a> plugin as it comes with additional options.', 'jackrose' ),
		array( 'a' => array( 'href' => array() ) )
	),
) );

// Styles.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'animation',
	'section'     => 'styles',
	'type'        => 'switch',
	'label'       => esc_html__( 'Page builder animation', 'jackrose' ),
	'description' => esc_html__( 'Jack & Rose Page Builder elements has option to enable "animation" (when element entering the page). Uncheck this option would disable all animations configured in the Page Builder.', 'jackrose' ),
	'default'     => 1,
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_accent',
	'section'     => 'styles',
	'type'        => 'color',
	'label'       => esc_html__( 'Color accent', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#b4d2c8',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => 'a',
			'property' => 'color',
		),
		array(
			'element'  => '.jackrose-sow-gallery-grid-filters a.active',
			'property' => 'border-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_button_bg',
	'section'     => 'styles',
	'type'        => 'color',
	'label'       => esc_html__( 'Button BG color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#b4d2c8',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.button, button, input[type="button"], input[type="reset"], input[type="submit"]',
			'property' => 'background-color',
		),
		array(
			'element'  => '.button, button, input[type="button"], input[type="reset"], input[type="submit"]',
			'property' => 'border-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_button_text',
	'section'     => 'styles',
	'type'        => 'color',
	'label'       => esc_html__( 'Button text color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.button, button, input[type="button"], input[type="reset"], input[type="submit"]',
			'property' => 'color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_button_bg_hover',
	'section'     => 'styles',
	'type'        => 'color',
	'label'       => esc_html__( 'Button BG color (hover)', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#bcd7ce',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.button:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:focus, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, .button:active, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active',
			'property' => 'background-color',
		),
		array(
			'element'  => '.button:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:focus, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, .button:active, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active',
			'property' => 'border-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_button_text_hover',
	'section'     => 'styles',
	'type'        => 'color',
	'label'       => esc_html__( 'Button text color (hover)', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.button:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:focus, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, .button:active, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active',
			'property' => 'color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'typography_subsets',
	'section'     => 'styles',
	'type'        => 'multicheck',
	'label'       => esc_html__( 'Font subsets', 'jackrose' ),
	'choices'     => jackrose_font_subsets(),
	'default'     => array( 'latin' ),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'typography_body_font_family',
	'section'     => 'styles',
	'type'        => 'select',
	'label'       => esc_html__( 'Body font family', 'jackrose' ),
	'description' => esc_html__( 'Used in normal paragraphs.', 'jackrose' ),
	'choices'     => jackrose_font_choices(),
	'default'     => 'serif',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'typography_section_heading_font_family',
	'section'     => 'styles',
	'type'        => 'select',
	'label'       => esc_html__( 'Section heading font family', 'jackrose' ),
	'description' => esc_html__( 'Used in section heading.', 'jackrose' ),
	'choices'     => jackrose_font_choices(),
	'default'     => 'Alex Brush',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'typography_headings_font_family',
	'section'     => 'styles',
	'type'        => 'select',
	'label'       => esc_html__( 'Headings font family', 'jackrose' ),
	'description' => esc_html__( 'Used in normal headings (h1 - h6).', 'jackrose' ),
	'choices'     => jackrose_font_choices(),
	'default'     => 'serif',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'typography_menu_font_family',
	'section'     => 'styles',
	'type'        => 'select',
	'label'       => esc_html__( 'Menu & button font family', 'jackrose' ),
	'description' => esc_html__( 'Used in header navigation and button.', 'jackrose' ),
	'choices'     => jackrose_font_choices(),
	'default'     => 'serif',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'note_advanced_styles',
	'section'     => 'styles',
	'type'        => 'custom',
	'label'       => esc_html__( 'Changing font sizes etc.', 'jackrose' ),
	'default'     => wp_kses(
		__( 'To customize font size, line height, etc, please use Custom CSS. Adding those options into this Theme Options page will make the page bloated and hurt performance. We also recommend <a href="https://siteorigin.com/css/">SiteOrigin CSS Editor</a> plugin for customizing CSS with a nice visual preview.', 'jackrose' ),
		array( 'a' => array( 'href' => array() ) )
	),
) );

// Header.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'header_position',
	'section'     => 'header',
	'type'        => 'select',
	'label'       => esc_html__( 'Header section position', 'jackrose' ),
	'choices'     => array(
		'top'    => esc_html__( 'Top (before hero section)', 'jackrose' ),
		'bottom' => esc_html__( 'Bottom (after hero section)', 'jackrose' ),
	),
	'default'     => 'bottom',
	'partial_refresh' => array(
		'header_position' => array(
			'selector'        => '#header',
			'render_callback' => 'jackrose_header',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'header_logo',
	'section'     => 'header',
	'type'        => 'image',
	'label'       => esc_html__( 'Header logo', 'jackrose' ),
	'description' => esc_html__( 'Max width: 60px, max height: 50px;', 'jackrose' ),
	'default'     => '',
	'partial_refresh' => array(
		'header_logo' => array(
			'selector'        => '#header',
			'render_callback' => 'jackrose_header',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_bg',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'BG color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-section, .header-navigation ul ul',
			'property' => 'background-color',
		),
		array(
			'element'  => '.header-navigation > div',
			'property' => 'background-color',
			'media_query' => '@media screen and ( max-width: 1023px )',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_border',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'Border color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#e5e5e5',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-section, .header-navigation ul ul, .header-navigation ul ul li',
			'property' => 'border-color',
		),
		array(
			'element'  => '.header-navigation > div > ul, .header-navigation li',
			'property' => 'border-color',
			'media_query' => '@media screen and ( max-width: 1023px )',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_link',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'Link color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#888888',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-section, .header-section a, .header-navigation-toggle',
			'property' => 'color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_link_hover',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'Link hover color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#444444',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-section a:hover, .header-section a:focus, .header-navigation-toggle:hover, .header-navigation-toggle:focus',
			'property' => 'color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_link_border',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'Link hover border', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#b4d2c8',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-navigation > div > ul > li > a:hover:after, .header-navigation > div > ul > li > a.focus:after',
			'property' => 'background-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'header_ribbon_text',
	'section'     => 'header',
	'type'        => 'text',
	'label'       => esc_html__( 'Ribbon text', 'jackrose' ),
	'description' => esc_html__( 'Leave it blank to hide the ribbon.', 'jackrose' ),
	'default'     => '',
	'partial_refresh' => array(
		'header_ribbon_text' => array(
			'selector'        => '#header',
			'render_callback' => 'jackrose_header',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'header_ribbon_href',
	'section'     => 'header',
	'type'        => 'text',
	'label'       => esc_html__( 'Ribbon target URL', 'jackrose' ),
	'default'     => '',
	'partial_refresh' => array(
		'header_ribbon_href' => array(
			'selector'        => '#header',
			'render_callback' => 'jackrose_header',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_ribbon_bg',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'Ribbon BG', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#b4d2c8',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-section .ribbon-menu, .header-section .ribbon-menu:hover, .header-section .ribbon-menu:focus',
			'property' => 'background-color',
		),
		array(
			'element'  => '.header-section .ribbon-menu:after',
			'property' => 'border-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_header_ribbon_text',
	'section'     => 'header',
	'type'        => 'color',
	'label'       => esc_html__( 'Ribbon text', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.header-section .ribbon-menu, .header-section .ribbon-menu:hover, .header-section .ribbon-menu:focus',
			'property' => 'color',
		),
	),
) );

// Hero Section.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'hero_logo',
	'section'     => 'hero',
	'type'        => 'image',
	'label'       => esc_html__( 'Hero logo', 'jackrose' ),
	'description' => esc_html__( 'Only displayed in a page with hero images or videos.', 'jackrose' ),
	'default'     => '',
	'partial_refresh' => array(
		'hero_logo' => array(
			'selector'        => '#hero-logo',
			'render_callback' => 'jackrose_hero_logo',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'hero_slider_autoplay',
	'section'     => 'hero',
	'type'        => 'number',
	'label'       => esc_html__( 'Hero slider autoplay (miliseconds)', 'jackrose' ),
	'description' => esc_html__( 'Set to 0 to disable autoplay', 'jackrose' ),
	'default'     => '5000',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'hero_effect',
	'section'     => 'hero',
	'type'        => 'select',
	'label'       => esc_html__( 'Effect', 'jackrose' ),
	'choices'     => array(
		false   => esc_html__( 'No effect', 'jackrose' ),
		'petal' => esc_html__( 'Sakura petal', 'jackrose' ),
		'snow'  => esc_html__( 'Snow', 'jackrose' ),
	),
	'default'     => 'petal',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_hero_effect',
	'section'     => 'hero',
	'type'        => 'color',
	'choices'     => array( 'alpha' => true ),
	'label'       => esc_html__( 'Effect color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.sakura.hero-effect-item',
			'property' => 'background',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'hero_button_text',
	'section'     => 'hero',
	'type'        => 'text',
	'label'       => esc_html__( 'Hero button text', 'jackrose' ),
	'description' => esc_html__( 'Leave it blank to hide the button.', 'jackrose' ),
	'default'     => esc_html__( 'Enter Site', 'jackrose' ),
	'partial_refresh' => array(
		'hero_button_text' => array(
			'selector'        => '#hero-logo',
			'render_callback' => 'jackrose_hero_logo',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'hero_button_href',
	'section'     => 'hero',
	'type'        => 'text',
	'label'       => esc_html__( 'Hero button target URL', 'jackrose' ),
	'description' => esc_html__( 'Fill with #[section-id] to enable smooth scrolling to the targeted section, e.g. #contact or #rsvp.', 'jackrose' ),
	'default'     => '#intro',
	'partial_refresh' => array(
		'hero_button_href' => array(
			'selector'        => '#hero-logo',
			'render_callback' => 'jackrose_hero_logo',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_hero_button',
	'section'     => 'hero',
	'type'        => 'color',
	'label'       => esc_html__( 'Hero button color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.hero-button, .hero-button:hover, .hero-button:focus',
			'property' => 'color',
		),
	),
) );

// Sidebar.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'sidebar',
	'section'     => 'sidebar',
	'type'        => 'multicheck',
	'label'       => esc_html__( 'Show sidebar on default pages', 'jackrose' ),
	'choices'     => array(
		'home'    => esc_html__( 'Posts index home page', 'jackrose' ),
		'archive' => esc_html__( 'Archive pages', 'jackrose' ),
		'search'  => esc_html__( 'Search page', 'jackrose' ),
		'single'  => esc_html__( 'Single post page', 'jackrose' ),
		'index'   => esc_html__( 'Other default pages', 'jackrose' ),
	),
	'default'     => array( 'home', 'archive', 'search', 'single', 'index' ),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'note_page_sidebar',
	'section'     => 'sidebar',
	'type'        => 'custom',
	'label'       => esc_html__( 'Sidebar on pages', 'jackrose' ),
	'default'     => esc_html__( 'To disable sidebar on Pages, please select "One Page" or "Full Width" page template in the Page editor.', 'jackrose' ),
) );

// Footer.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_padding',
	'section'     => 'footer',
	'type'        => 'text',
	'label'       => esc_html__( 'Padding', 'jackrose' ),
	'default'     => '6em 0 3em',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'padding',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_footer_bg',
	'section'     => 'footer',
	'type'        => 'color',
	'label'       => esc_html__( 'BG color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'background-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_bg_image',
	'section'     => 'footer',
	'type'        => 'image',
	'label'       => esc_html__( 'BG image', 'jackrose' ),
	'default'     => '',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'background-image',
			'value_pattern' => 'url($)',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_bg_size',
	'section'     => 'footer',
	'type'        => 'select',
	'label'       => esc_html__( 'BG size', 'jackrose' ),
	'choices'     => array(
		'auto'    => esc_html__( 'auto', 'jackrose' ),
		'cover'   => esc_html__( 'cover', 'jackrose' ),
		'contain' => esc_html__( 'contain', 'jackrose' ),
	),
	'default'     => 'cover',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'background-size',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_bg_repeat',
	'section'     => 'footer',
	'type'        => 'select',
	'label'       => esc_html__( 'BG repeat', 'jackrose' ),
	'choices'     => array(
		'no-repeat' => esc_html__( 'no repeat', 'jackrose' ),
		'repeat-x'  => esc_html__( 'repeat X', 'jackrose' ),
		'repeat-y'  => esc_html__( 'repeat Y', 'jackrose' ),
		'repeat'    => esc_html__( 'repeat both', 'jackrose' ),
	),
	'default'     => 'no-repeat',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'background-repeat',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_bg_position',
	'section'     => 'footer',
	'type'        => 'select',
	'label'       => esc_html__( 'BG position', 'jackrose' ),
	'choices'     => array(
		'left top'      => esc_html__( 'left top', 'jackrose' ),
		'left center'   => esc_html__( 'left center', 'jackrose' ),
		'left bottom'   => esc_html__( 'left bottom', 'jackrose' ),
		'center top'    => esc_html__( 'center top', 'jackrose' ),
		'center center' => esc_html__( 'center center', 'jackrose' ),
		'center bottom' => esc_html__( 'center bottom', 'jackrose' ),
		'right top'     => esc_html__( 'right top', 'jackrose' ),
		'right center'  => esc_html__( 'right center', 'jackrose' ),
		'right bottom'  => esc_html__( 'right bottom', 'jackrose' ),
	),
	'default'     => 'center center',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'background-position',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_footer_text',
	'section'     => 'footer',
	'type'        => 'color',
	'label'       => esc_html__( 'Text color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#888888',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section',
			'property' => 'color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_footer_link',
	'section'     => 'footer',
	'type'        => 'color',
	'label'       => esc_html__( 'Link color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#444444',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.footer-section a, .footer-section a:hover, .footer-section a:focus',
			'property' => 'color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_logo',
	'section'     => 'footer',
	'type'        => 'image',
	'label'       => esc_html__( 'Logo', 'jackrose' ),
	'default'     => '',
	'partial_refresh' => array(
		'footer_logo' => array(
			'selector'        => '#colophon',
			'render_callback' => 'jackrose_footer',
			'container_inclusive' => true,
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'footer_copyright_text',
	'section'     => 'footer',
	'type'        => 'textarea',
	'label'       => esc_html__( 'Copyright text', 'jackrose' ),
	'default'     => sprintf(
		esc_html__( 'Copyright &copy; %s &mdash; designed by %s', 'jackrose' ),
		date( 'Y' ),
		'<a href="' . esc_url( $jackrose_data['theme_data']->get( 'AuthorURI' ) ) . '">' . $jackrose_data['theme_data']->get( 'Author' ) . '</a>'
	),
	'partial_refresh' => array(
		'footer_copyright_text' => array(
			'selector'        => '#colophon',
			'render_callback' => 'jackrose_footer',
			'container_inclusive' => true,
		),
	),
	'sanitize_callback' => 'jackrose_unfiltered_sanitize',
) );

// Invitation Page Template.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'note_invitation',
	'section'     => 'invitation',
	'type'        => 'custom',
	'label'       => esc_html__( 'Invitation Page Template', 'jackrose' ),
	'default'     => esc_html__( 'These options below only applies to page with "Invitation" page template.', 'jackrose' ),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'color_invitation_bg',
	'section'     => 'invitation',
	'type'        => 'color',
	'label'       => esc_html__( 'BG color', 'jackrose' ),
	'choices'     => array( 'alpha' => true ),
	'default'     => '#c8dcd2',
	'output'      => array(
		array(
			'element'  => '.page-template-invitation',
			'property' => 'background-color',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'invitation_bg_image',
	'section'     => 'invitation',
	'type'        => 'image',
	'label'       => esc_html__( 'BG image', 'jackrose' ),
	'default'     => '',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-template-invitation',
			'property' => 'background-image',
			'value_pattern' => 'url($)'
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'invitation_bg_size',
	'section'     => 'invitation',
	'type'        => 'select',
	'label'       => esc_html__( 'BG size', 'jackrose' ),
	'choices'     => array(
		'auto'    => esc_html__( 'auto', 'jackrose' ),
		'cover'   => esc_html__( 'cover', 'jackrose' ),
		'contain' => esc_html__( 'contain', 'jackrose' ),
	),
	'default'     => 'cover',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-template-invitation',
			'property' => 'background-size',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'invitation_bg_repeat',
	'section'     => 'invitation',
	'type'        => 'select',
	'label'       => esc_html__( 'BG repeat', 'jackrose' ),
	'choices'     => array(
		'no-repeat' => esc_html__( 'no repeat', 'jackrose' ),
		'repeat-x'  => esc_html__( 'repeat X', 'jackrose' ),
		'repeat-y'  => esc_html__( 'repeat Y', 'jackrose' ),
		'repeat'    => esc_html__( 'repeat both', 'jackrose' ),
	),
	'default'     => 'no-repeat',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-template-invitation',
			'property' => 'background-repeat',
		),
	),
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'invitation_bg_position',
	'section'     => 'invitation',
	'type'        => 'select',
	'label'       => esc_html__( 'BG position', 'jackrose' ),
	'choices'     => array(
		'left top'      => esc_html__( 'left top', 'jackrose' ),
		'left center'   => esc_html__( 'left center', 'jackrose' ),
		'left bottom'   => esc_html__( 'left bottom', 'jackrose' ),
		'center top'    => esc_html__( 'center top', 'jackrose' ),
		'center center' => esc_html__( 'center center', 'jackrose' ),
		'center bottom' => esc_html__( 'center bottom', 'jackrose' ),
		'right top'     => esc_html__( 'right top', 'jackrose' ),
		'right center'  => esc_html__( 'right center', 'jackrose' ),
		'right bottom'  => esc_html__( 'right bottom', 'jackrose' ),
	),
	'default'     => 'center center',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-template-invitation',
			'property' => 'background-position',
		),
	),
) );

// Custom Scripts.
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'custom_css',
	'section'     => 'custom_css',
	'type'        => 'textarea',
	'label'       => esc_html__( 'Custom CSS', 'jackrose' ),
	'description' => esc_html__( 'Your custom CSS to override the default style or anything which can not be configured via this Customizer', 'jackrose' ),
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'elegant',
		'height'   => 200,
	),
	'sanitize_callback' => 'jackrose_unfiltered_sanitize',
) );
SingleStroke_Kirki::add_field( 'jackrose', array(
	'settings'    => 'note_custom_css',
	'section'     => 'custom_css',
	'type'        => 'custom',
	'label'       => esc_html__( 'Using visual CSS editor', 'jackrose' ),
	'default'     => wp_kses(
		__( 'We recommend <a href="https://siteorigin.com/css/">SiteOrigin CSS Editor</a> plugin if you want to make custom CSS changes with interactive UI to select the elements.', 'jackrose' ),
		array( 'a' => array( 'href' => array() ) )
	),
) );