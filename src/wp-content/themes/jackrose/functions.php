<?php
/**
 * Jack & Rose functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jack_&_Rose
 */

/**
 * Define constant variables.
 */
define( 'JACKROSE_CSS_DIR', get_template_directory() . '/css' );
define( 'JACKROSE_JS_DIR', get_template_directory() . '/js' );
define( 'JACKROSE_INCLUDES_DIR', get_template_directory() . '/inc' );
define( 'JACKROSE_IMAGES_DIR', get_template_directory() . '/images' );
define( 'JACKROSE_WIDGETS_DIR', get_template_directory() . '/widgets' );
define( 'JACKROSE_PAGE_TEMPLATES_DIR', get_template_directory() . '/page-templates' );
define( 'JACKROSE_PLUGINS_DIR', get_template_directory() . '/plugins' );
define( 'JACKROSE_SITEORIGIN_DIR', get_template_directory() . '/siteorigin' );
define( 'JACKROSE_DEMO_DIR', get_template_directory() . '/demo' );

define( 'JACKROSE_CSS', get_template_directory_uri() . '/css' );
define( 'JACKROSE_JS', get_template_directory_uri() . '/js' );
define( 'JACKROSE_INCLUDES', get_template_directory_uri() . '/inc' );
define( 'JACKROSE_IMAGES', get_template_directory_uri() . '/images' );
define( 'JACKROSE_WIDGETS', get_template_directory_uri() . '/widgets' );
define( 'JACKROSE_PAGE_TEMPLATES', get_template_directory_uri() . '/page-templates' );
define( 'JACKROSE_PLUGINS', get_template_directory_uri() . '/plugins' );
define( 'JACKROSE_SITEORIGIN', get_template_directory_uri() . '/siteorigin' );
define( 'JACKROSE_DEMO', get_template_directory_uri() . '/demo' );

define( 'JACKROSE_CUSTOMIZER_OPTION_KEY', 'singlestroke_jackrose_customizer' );
define( 'JACKROSE_VERSION_OPTION_KEY', 'singlestroke_jackrose_version' );

/**
 * Define theme's global data.
 */
global $jackrose_data;

// Theme data.
$jackrose_data['theme_data'] = wp_get_theme( get_template() );

// Social media links.
$jackrose_data['social_media_links'] = apply_filters( 'jackrose_social_media', array(
	'facebook' => esc_html__( 'Facebook', 'jackrose' ),
	'twitter' => esc_html__( 'Twitter', 'jackrose' ),
	'instagram' => esc_html__( 'Instagram', 'jackrose' ),
	'pinterest' => esc_html__( 'Pinterest', 'jackrose' ),
	'youtube' => esc_html__( 'Youtube', 'jackrose' ),
	'vimeo' => esc_html__( 'Vimeo', 'jackrose' ),
	'google-plus' => esc_html__( 'Google Plus', 'jackrose' ),
	'tumblr' => esc_html__( 'Tumblr', 'jackrose' ),
	'linkedin' => esc_html__( 'LinkedIn','jackrose' ),
	'dribbble' => esc_html__( 'Dribbble', 'jackrose' ),
	'bloglovin' => esc_html__( 'Bloglovin&#39;', 'jackrose' ),
	'behance' => esc_html__( 'Behance', 'jackrose' ),
	'rss' => esc_html__( 'RSS', 'jackrose' ),
) );

// Typography types.
$jackrose_data['typography_types'] = apply_filters( 'jackrose_typography_types', array(
	'body' => esc_html__( 'Body', 'jackrose' ),
	'headings' => esc_html__( 'Headings (h1 - h6)', 'jackrose' ),
	'section_heading' => esc_html__( 'Section heading', 'jackrose' ),
	'menu' => esc_html__( 'Menu', 'jackrose' ),
) );

/**
 * Include additional modules.
 */
// SingleStroke branding.
require_once( JACKROSE_INCLUDES_DIR . '/singlestroke-branding.php' );

// Extra functions.
require_once( JACKROSE_INCLUDES_DIR . '/extras.php' );

// Helper functions.
require_once( JACKROSE_INCLUDES_DIR . '/helpers.php' );

// Template tags.
require_once( JACKROSE_INCLUDES_DIR . '/template-tags.php' );

// Customizer options powered by Kirki.
require_once( JACKROSE_INCLUDES_DIR . '/customizer.php' );

// Demo Data Import powered by One Click Demo Import.
require_once( JACKROSE_INCLUDES_DIR . '/import-demo-data.php' );

// Jetpack compatibility.
require_once( JACKROSE_INCLUDES_DIR . '/jetpack.php' );

// SiteOrigin compatibility.
require_once( JACKROSE_INCLUDES_DIR . '/siteorigin.php' );

// Migrate to newer versions.
require_once( JACKROSE_INCLUDES_DIR . '/migrate.php' );

/**
 * TGMPA.
 */
require_once( JACKROSE_INCLUDES_DIR . '/class-tgm-plugin-activation.php' );
function jackrose_tgmpa_register() {
	$plugins = array(
		array(
			'name'               => esc_html__( 'Kirki', 'jackrose' ),
			'slug'               => 'kirki',
			'required'           => true,
			'description'        => esc_html__( 'Mandatory plugin used to configure the Customizer (Theme Options) settings.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'Page Builder by SiteOrigin', 'jackrose' ),
			'slug'               => 'siteorigin-panels',
			'required'           => true,
			'description'        => esc_html__( 'Mandatory plugin used for page builder features.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'SiteOrigin Widgets Bundle', 'jackrose' ),
			'slug'               => 'so-widgets-bundle',
			'required'           => true,
			'description'        => esc_html__( 'Mandatory plugin used for page builder features.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'Attachments', 'jackrose' ),
			'slug'               => 'attachments',
			'required'           => true,
			'description'        => esc_html__( 'Mandatory plugin used to configure the Hero Slider section on your landing page.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'Contact Form 7', 'jackrose' ),
			'slug'               => 'contact-form-7',
			'required'           => true,
			'description'        => esc_html__( 'Help you to create an easy and simple RSVP / contact form and send the entries to your email.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'Contact Form Advanced Database', 'jackrose' ),
			'slug'               => 'contact-form-advanced-database/',
			'required'           => false,
			'description'        => esc_html__( 'Allow you to keep and manage your RSVP entries on WordPress Dashboard.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'Gwolle Guestbook', 'jackrose' ),
			'slug'               => 'gwolle-gb',
			'required'           => false,
			'description'        => esc_html__( 'Help you to create a Guestbook form and manage the entries easily.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'One Click Demo Import', 'jackrose' ),
			'slug'               => 'one-click-demo-import',
			'required'           => false,
			'description'        => esc_html__( 'Allow you to import all data from demo site just in ONE CLICK.', 'jackrose' ),
		),
		array(
			'name'               => esc_html__( 'Envato Market', 'jackrose' ),
			'slug'               => 'envato-market',
			'required'           => false,
			'source'             => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'version'            => '1.0.0-RC2',
			'description'        => esc_html__( 'Enable notifications and automatic theme update for this theme.', 'jackrose' ),
		),
	);

	$message = '<table class="widefat striped" style="width: auto; margin: 20px 0;"><tbody>';
	foreach ( $plugins as $plugin ) {
		$message .= '<tr><td><strong>' . $plugin['name'] . ':</strong></td><td>' . $plugin['description'] . '</td></tr>';
	}
	$message .= '</tbody></table>';

	$config = array(
		'id'           => get_template(),
		'menu'         => get_template() . '-plugins',
		'parent_slug'  => get_template() . '-dashboard',
		'message'      => $message,
		'strings'      => array(
			'menu_title' => esc_html__( 'Install Plugins', 'jackrose' ),
		),
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'jackrose_tgmpa_register' );

if ( ! function_exists( 'jackrose_setup' ) ) :
/**
 * Theme setup.
 */
function jackrose_setup() {
	// Translation.
	load_theme_textdomain( 'singlestroke', get_template_directory() . '/languages' );
	load_theme_textdomain( 'jackrose', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Title tag.
	add_theme_support( 'title-tag' );

	// Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Register menus.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'jackrose' ),
	) );

	// HTML5 tags support.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add image sizes.
	add_image_size( 'content', 1080 );
	add_image_size( 'grid', 540 );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// add_theme_support( 'custom-header' );
	// add_theme_support( 'custom-background' );
}
endif; // jackrose_setup
add_action( 'after_setup_theme', 'jackrose_setup' );

/**
 * Content width.
 */
function jackrose_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jackrose_content_width', 1080 );
}
add_action( 'after_setup_theme', 'jackrose_content_width', 0 );

/**
 * Register widgets area.
 */
function jackrose_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jackrose' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jackrose_widgets_init' );

/**
 * Enqueue scripts.
 */
function jackrose_enqueue_scripts() {
	global $jackrose_data;

	// Preloader.
	$preloader = jackrose_get_theme_mod( 'preloader' );
	$embed = false;
	if ( is_page_template( 'page-templates/one-page.php' ) ) {
		if ( in_array( 'one-page', $preloader ) ) $embed = true;
	} else {
		if ( in_array( 'standard', $preloader ) ) $embed = true;
	}
	if ( $embed ) {
		?>
		<script type="text/javascript">
		paceOptions = {
			target: '#preloader .preloader-content',
		}
		</script>
		<?php
		wp_enqueue_script( 'pace', JACKROSE_JS . '/pace.min.js', array(), '1.0.2-edited' );
	}

	if ( jackrose_get_theme_mod( 'hero_effect' ) ) {
		wp_enqueue_script( 'sakura', JACKROSE_JS . '/jquery-sakura.min.js', array( 'jquery' ), '1.0.0', true );
	}

	// Libraries.
	wp_register_script( 'inview', JACKROSE_JS . '/jquery.inview.min.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'imagesloaded', JACKROSE_JS . '/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.0', true );
	wp_register_script( 'stellar', JACKROSE_JS . '/jquery.stellar.min.js', array( 'jquery' ), '0.6.2', true );
	wp_register_script( 'flickity', JACKROSE_JS . '/flickity.pkgd.min.js', array( 'jquery' ), '1.2.1', true );

	// Main JS.
	wp_enqueue_script( 'jackrose', JACKROSE_JS . '/main.js', array(
		'jquery',
		'inview',
		'imagesloaded',
		'stellar',
		'flickity',
	), $jackrose_data['theme_data']->get( 'Version' ), true );

	// Comment reply (WordPress).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply', true );
	}
}
add_action( 'wp_enqueue_scripts', 'jackrose_enqueue_scripts' );

/**
 * Enqueue styles.
 */
function jackrose_enqueue_styles() {
	global $jackrose_data;

	// Google Fonts
	$google_fonts_link = jackrose_generate_google_fonts_url();
	if ( ! empty( $google_fonts_link ) ) {
		wp_enqueue_style( 'google-fonts', $google_fonts_link );
	}

	// Libraries
	wp_register_style( 'font-awesome', JACKROSE_CSS . '/font-awesome.min.css', array(), '4.6.3' );
	wp_register_style( 'flickity', JACKROSE_CSS . '/flickity.min.css', array(), '1.2.1' );

	// Main CSS.
	wp_enqueue_style( 'jackrose', is_child_theme() ? get_template_directory_uri() . '/style.css' : get_stylesheet_uri(), array(
		'font-awesome',
		'flickity',
	), $jackrose_data['theme_data']->get( 'Version' ) );

	// Generated CSS.
	ob_start(); include( JACKROSE_CSS_DIR . '/custom.php' ); $style_custom = ob_get_clean();
	wp_add_inline_style( 'jackrose', $style_custom );

	// Custom CSS.
	wp_add_inline_style( 'jackrose', html_entity_decode( jackrose_get_theme_mod( 'custom_css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'jackrose_enqueue_styles' );

/**
 * Editor style.
 */
function jackrose_editor_style() {
	global $jackrose_data;

	// Google Fonts
	$google_fonts_link = jackrose_generate_google_fonts_url();
	if ( ! empty( $google_fonts_link ) ) {
		add_editor_style( str_replace( ',', '%2C', $google_fonts_link ) );
	}

	// Styles
	$args = array();
	foreach ( $jackrose_data['typography_types'] as $type => $label ) {
		$args[ 'typography_' . $type . '_font_family' ] = urlencode( jackrose_format_font_family_css( jackrose_get_theme_mod( 'typography_' . $type . '_font_family' ) ) );
	}
	$args[ 'color_accent' ] = urlencode( jackrose_get_theme_mod( 'color_accent' ) );

	add_editor_style( add_query_arg( $args, JACKROSE_CSS . '/editor.php' ) );
}
add_action( 'admin_init', 'jackrose_editor_style' );

/**
 * Plugin setup: Attachments.
 */
function jackrose_hero_slider( $attachments ) {
	$args = array(
		'label'         => esc_html__( 'Hero Slider', 'jackrose' ),
		'post_type'     => array( 'page' ),
		'position'      => 'normal',
		'priority'      => 'high',
		'limit'         => -1,
		'filetype'      => array( 'image', 'video' ),
		'note'          => esc_html__( 'Add background image / video into a fullscreen hero slider. Leave it blank also means disabling the hero section. Adding video: upload 3 formats, mp4, ogv / ogg, webm with the same filename. Select only one of them, the template will automatically call the other formats. To add hero logo, go to Appearance > Hero > Hero Logo.', 'jackrose' ),
		'append'        => true,
		'button_text'   => esc_html__( 'Add Images / Videos', 'jackrose' ),
		'modal_text'    => esc_html__( 'Add Files', 'jackrose' ),
		'router'        => 'browse',
		'post_parent'   => false,
		'fields'        => array(
			array(
				'name'    => 'parallax',
				'type'    => 'select',
				'label'   => esc_html__( 'Enable parallax scrolling.', 'jackrose' ),
				'meta'    => array(
					'options' => array(
						1 => esc_html__( 'yes', 'jackrose' ),
						0 => esc_html__( 'no', 'jackrose' ),
					),
				),
			),
			array(
				'name'    => 'overlay',
				'type'    => 'text',
				'label'   => esc_html__( 'Overlay Color (format: rgba, e.g. "rgba(0,0,0,0)").', 'jackrose' ),
			),
			array(
				'name'    => 'video_poster',
				'type'    => 'text',
				'label'   => esc_html__( 'Video Poster URL (fallback image for mobile devices, mandatory if you use video background, should be the same size ratio as the video file. Please upload your image from Media > Add New and then copy paste the URL to this field).', 'jackrose' ),
			),
		),
	);

	$attachments->register( 'jackrose_hero_slider', $args );
}
add_action( 'attachments_register', 'jackrose_hero_slider' );
add_filter( 'attachments_default_instance', '__return_false' );