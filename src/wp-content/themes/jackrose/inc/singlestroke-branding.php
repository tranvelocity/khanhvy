<?php
/**
 * SingleStroke branding.
 *
 * @package SingleStroke
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Exit if White Label mode is active.
 */
if ( defined( 'SINGLESTROKE_WHITE_LABEL' ) && SINGLESTROKE_WHITE_LABEL ) {
	return;
}

/**
 * Add theme dashboard page.
 */
function singlestroke_add_theme_dashboard_page() {
	$parent_theme = wp_get_theme( get_template() );
	
	add_menu_page(
		sprintf( esc_html__( '%s Dashboard', 'singlestroke' ), $parent_theme->get( 'Name' ) ),
		$parent_theme->get( 'Name' ),
		'edit_theme_options',
		get_template() . '-dashboard',
		'singlestroke_render_theme_dashboard_page',
		'dashicons-screenoptions',
		59
	);

	add_submenu_page(
		get_template() . '-dashboard',
		sprintf( esc_html__( '%s Dashboard', 'singlestroke' ), $parent_theme->get( 'Name' ) ),
		esc_html__( 'Dashboard', 'singlestroke' ),
		'edit_theme_options',
		get_template() . '-dashboard',
		'singlestroke_render_theme_dashboard_page'
	);
}
add_action( 'admin_menu', 'singlestroke_add_theme_dashboard_page', 1 );

/**
 * Redirect to dashboard page when theme is activated.
 */
function singlestroke_after_switch_theme() {
	wp_redirect( add_query_arg( array( 'page' => get_template() . '-dashboard', 'tab' => 'getting-started' ), admin_url( 'admin.php' ) ) );
}
add_action( 'after_switch_theme', 'singlestroke_after_switch_theme' );

/**
 * Render theme dashboard page.
 */
function singlestroke_render_theme_dashboard_page() {
	$parent_theme = wp_get_theme( get_template() );

	ob_start();
	?>
	<style type="text/css">
	.singlestroke-theme-dashboard-header {
		margin-bottom: 2em;
	}
	.singlestroke-theme-dashboard-rate a {
		text-decoration: none;
	}
	.singlestroke-theme-dashboard-badge {
		background-image: url(<?php echo esc_url( get_template_directory_uri() . '/img/badge.png' ); ?>) !important;
		background-size: 100px;
		background-position: center 20px;
		padding-top: 130px;
		height: 30px;
		font-weight: normal;
	}
	.singlestroke-theme-dashboard-card {
		min-width: none;
		max-width: none;
		margin: 2em 0;
	}
	.singlestroke-theme-dashboard-card h2 {
		margin-top: 1em;
	}
	.singlestroke-theme-dashboard-requirement-description {
		display: block;
		margin: 0.5em 0;
		font-size: 0.9em;
		opacity: 0.6;
	}
	.singlestroke-theme-dashboard-requirement-description code {
		font-size: inherit;
		font-weight: inherit;
	}
	.singlestroke-theme-dashboard-color-green {
		color: green;
	}
	.singlestroke-theme-dashboard-color-red {
		color: red;
	}
	</style>
	<div class="singlestroke-dashboard-wrap wrap about-wrap">
		<div class="singlestroke-theme-dashboard-header wp-clearfix">
			<h1><?php printf( esc_html__( 'Welcome to %s', 'singlestroke' ), $parent_theme->get( 'Name' ) ); ?></h1>

			<p class="about-text"><?php printf( esc_html__( '%1$s is now installed! To make sure you have all the features working properly, please install all the required plugins and read our documentation page first to get familiar with the features. We hope you enjoy working with %1$s!', 'singlestroke' ), $parent_theme->get( 'Name' ) ); ?></p>
			<p class="singlestroke-theme-dashboard-rate description"><?php printf( esc_html__( 'If you love %s, please rate us', 'singlestroke' ), $parent_theme->get( 'Name' ) ); ?> <a href="<?php echo esc_url( add_query_arg( 'action', 'rate', $parent_theme->get( 'ThemeURI' ) ) ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</a></p>
			<div class="singlestroke-theme-dashboard-badge wp-badge"><?php printf( esc_html__( 'Version %s', 'singlestroke' ), $parent_theme->get( 'Version' ) ); ?></div>
		</div>

		<?php
		$tabs = array(
			'getting-started' => esc_html__( 'Getting Started', 'singlestroke' ),
			'status' => esc_html__( 'System Status', 'singlestroke' ),
		);
		$current = isset( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : '';
		if ( ! in_array( $current, array_keys( $tabs ) ) ) {
			$current = 'status';
		}
		?>

		<h2 class="singlestroke-theme-dashboard-nav-tab-wrapper nav-tab-wrapper wp-clearfix">
			<?php foreach ( $tabs as $key => $label ) : ?>
				<a href="<?php echo esc_url( add_query_arg( array( 'page' => get_template() . '-dashboard', 'tab' => $key ), admin_url( 'admin.php' ) ) ); ?>" class="nav-tab <?php echo esc_attr( $key == $current ? 'nav-tab-active' : '' ); ?>"><?php echo ( $label ); ?></a>
			<?php endforeach; ?>
			<a href="<?php echo esc_url( add_query_arg( 'action', 'documentation', trailingslashit( $parent_theme->get( 'ThemeURI' ) ) ) ); ?>" class="nav-tab"><?php esc_html_e( 'Documentation', 'singlestroke' ); ?></a>
			<a href="<?php echo esc_url( add_query_arg( 'action', 'support', trailingslashit( $parent_theme->get( 'ThemeURI' ) ) ) ); ?>" class="nav-tab"><?php esc_html_e( 'Support', 'singlestroke' ); ?></a>
		</h2>

		<div class="singlestroke-theme-dashboard-tab">
			<div class="singlestroke-theme-dashboard-card card">

				<?php switch ( $current ) :
					case 'getting-started':
						?>
						<h2><?php esc_html_e( 'Getting Started', 'singlestroke' ); ?></h2>
						<div class="wp-clearfix two-col">
							<div class="col">
								<h3><?php esc_html_e( 'Step 1 - Install Required Plugins', 'singlestroke' ); ?></h3>
								<p><?php echo wp_kses(
									sprintf(
										__( 'Before start working with the theme, first thing to do is install all the required plugins. It is mandatory, otherwise some features might not work properly. Please go to <strong>%s > Install Plugins</strong> page.', 'singlestroke' ),
										$parent_theme->get( 'Name' )
									),
									array( 'strong' => array() )
								); ?></p>
							</div>
							<div class="col">
								<h3><?php esc_html_e( 'Step 2 - Install Demo Data', 'singlestroke' ); ?></h3>
								<p><?php echo wp_kses(
									sprintf(
										__( 'You can <strong>optionally</strong> replicate our demo site content as a starting point using the One Click Demo Data Import feature (intended for fresh installation only). Please go to <strong>%s > Import Demo Data</strong> page.', 'singlestroke' ),
										$parent_theme->get( 'Name' )
									),
									array( 'strong' => array() )
								); ?></p>
							</div>
						</div>
						<div class="wp-clearfix two-col">
							<div class="col">
								<h3><?php esc_html_e( 'Step 3 - Automatic Updates', 'singlestroke' ); ?></h3>
								<p><?php echo wp_kses(
									sprintf(
										__( 'You can activate the automatic theme updates for our future releases by going to <strong>Envato Market</strong> menu and then follow the instructions in the page (make sure you have installed <strong>Envato Market plugin</strong>).', 'singlestroke' ),
										$parent_theme->get( 'Name' )
									),
									array( 'strong' => array() )
								); ?></p>
							</div>
							<div class="col">
								<h3><?php esc_html_e( 'Step 4 - You are ready!', 'singlestroke' ); ?></h3>
								<p><?php echo wp_kses(
									sprintf(
										__( 'Your theme setup is finished! Before you start building your pages and customizing, we suggest you to read our <strong>documentation page</strong> to get more familiar with the features and avoid any issues.', 'singlestroke' ),
										$parent_theme->get( 'Name' )
									),
									array( 'strong' => array() )
								); ?></p>
							</div>
						</div>
						<?php
						break;

					default:
						global $wpdb;

						function singlestroke_size_string_to_bytes( $string ) {
							if ( preg_match( '/^(\d+)(.)$/', $string, $matches ) ) {
								switch ( strtoupper( $matches[2] ) ) {
									case 'K':
										return $matches[1] * 1024;
										break;
									case 'M':
										return $matches[1] * pow( 1024, 2 );
										break;
									case 'G':
										return $matches[1] * pow( 1024, 3 );
										break;
									case 'T':
										return $matches[1] * pow( 1024, 4 );
										break;
									case 'P':
										return $matches[1] * pow( 1024, 5 );
										break;
									default:
										return $matches[0];
										break;
								}
							}
						}

						$requirements = apply_filters( 'singlestroke_theme_recommended_requirements', array(
							array(
								'current' => get_bloginfo( 'version' ),
								'label'   => esc_html__( 'WordPress version', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please update your WordPress version to at least version <code>4.5</code> for full compatibility with our features.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( version_compare( get_bloginfo( 'version' ), '4.5' ) >= 0 ),
							),
							array(
								'current' => phpversion(),
								'label'   => esc_html__( 'PHP version', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please upgrade your PHP version to at least version <code>5.6</code>. The theme and plugins might use some new functions which are not supported in older PHP version.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( version_compare( phpversion(), '5.6' ) >= 0 ),
							),
							array(
								'current' => $wpdb->db_version(),
								'label'   => esc_html__( 'MySQL version', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please upgrade your MySQL version to at least version <code>5.5</code>.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( version_compare( $wpdb->db_version(), '5.5' ) >= 0 ),
							),
							array(
								'current' => ini_get( 'upload_max_filesize' ),
								'label'   => esc_html__( 'Server Upload Max Filesize', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please increase your server\'s <code>upload_max_filesize</code> to at least <code>16M</code> for optimum performance.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( singlestroke_size_string_to_bytes( ini_get( 'upload_max_filesize' ) ) >= 16 * 1024 * 1024 ),
							),
							array(
								'current' => ini_get( 'post_max_size' ),
								'label'   => esc_html__( 'Server Post Max Size', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please increase your server\'s <code>post_max_size</code> to at least <code>16M</code> for optimum performance.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( singlestroke_size_string_to_bytes( ini_get( 'post_max_size' ) ) >= 16 * 1024 * 1024 ),
							),
							array(
								'current' => ini_get( 'memory_limit' ),
								'label'   => esc_html__( 'Server Memory Limit', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please increase your server\'s <code>memory_limit</code> to at least <code>64M</code>. If you have many active plugins, you might need to increase the memory_limit to <code>128M</code>.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( singlestroke_size_string_to_bytes( ini_get( 'memory_limit' ) ) >= 64 * 1024 * 1024 ),
							),
							array(
								'current' => ini_get( 'allow_url_fopen' ) ? esc_html__( 'Allowed', 'singlestroke' ) : esc_html__( 'Not allowed', 'singlestroke' ),
								'label'   => esc_html__( 'Server Allow URL fopen', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please enable (allow) your server\'s <code>allow_url_fopen</code> as it is used by the theme.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ini_get( 'allow_url_fopen' ),
							),
							array(
								'current' => ini_get( 'max_execution_time' ),
								'label'   => esc_html__( 'Server Max Execution Time', 'singlestroke' ),
								'warning' => wp_kses( __( 'Please increase your server\'s <code>max_execution_time</code> to at least <code>120</code> (2 minutes) to avoid errors during demo data import or plugins installation.', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => ( ini_get( 'max_execution_time' ) >= 120 ),
							),
							array(
								'current' => $parent_theme->get( 'Version' ),
								'label'   => esc_html__( 'Main Theme version', 'singlestroke' ),
								'warning' => '',
								'check'   => null,
							),
							array(
								'current' => is_child_theme() ? esc_html__( 'Installed', 'singlestroke' ) : esc_html__( 'Not installed', 'singlestroke' ),
								'label'   => esc_html__( 'Child theme', 'singlestroke' ),
								'warning' => wp_kses( __( 'If you need to make direct changes to the theme\'s files, you have to use the Child Theme (an integrated Child Theme sample is included in the theme download package).', 'singlestroke' ), array( 'code' => array() ) ),
								'check'   => null,
							),
							array(
								'current' => ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? esc_html__( 'ON', 'singlestroke' ) : esc_html__( 'OFF', 'singlestroke' ),
								'label'   => esc_html__( 'WordPress Debug Mode', 'singlestroke' ),
								'warning' => '',
								'check'   => null,
							),
						) );
						?>
						<h2><?php esc_html_e( 'System Status', 'singlestroke' ); ?></h2>
						<table class="widefat striped">
							<col style="width: 50%;">
							<col style="width: 30px;">
							<col style="width: 50%;">
							<thead>
								<tr>
									<th><?php esc_html_e( 'Requirements', 'singlestroke' ); ?></th>
									<th colspan="2"><?php esc_html_e( 'Your Current Setting', 'singlestroke' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $requirements as $key => $requirement ) : ?>
									<?php
									$mark = '&nbsp;';
									if ( isset( $requirement['check'] ) ) {
										switch ( $requirement['check'] ) {
											case true:
												$mark = '<span class="singlestroke-theme-dashboard-requirement-check singlestroke-theme-dashboard-color-green dashicons dashicons-yes"></span>';
												break;

											case false:
												$mark = '<span class="singlestroke-theme-dashboard-requirement-check singlestroke-theme-dashboard-color-red dashicons dashicons-no"></span>';
												break;
										}										
									}
									?>
									<tr>
										<td><?php echo ( $requirement['label'] ); ?></td>
										<td><?php echo ( $mark ); ?></td>
										<td>
											<span class="singlestroke-theme-dashboard-requirement-current"><?php echo ( $requirement['current'] ); ?></span>
											<?php echo ( $requirement['check'] ? '' : ( ! empty( $requirement['warning'] ) ? '<span class="singlestroke-theme-dashboard-requirement-description">' . $requirement['warning'] . '</span>' : '' ) ); ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<p><em>** <?php printf( __( 'Points with the red cross mark (%s) should be adjusted, otherwise your website might not work properly and lead to issues. Please contact your hosting provider if you don\'t know how to configure your server settings.', 'singlestroke' ), '<span class="singlestroke-theme-dashboard-color-red dashicons dashicons-no"></span>' ); ?></em></p>

						<br><hr><br>

						<p><strong><?php esc_html_e( 'Copy this snippet when you create a new support ticket. It might help our team to solve your issue even faster!', 'singlestroke' ); ?></strong></p>
						<p>
							<textarea name="singlestroke-system-status" rows="<?php echo esc_attr( count( $requirements ) + 1 ); ?>" cols="60" class="widefat" readonly onfocus="this.select()" onclick="this.select()">SYSTEM STATUS: <?php foreach ( $requirements as $key => $requirement ) echo "\n" . $requirement['label'] . ': ' . $requirement['current']; ?></textarea>
						</p>
						<?php
						break;
					
				endswitch; ?>
			</div>
		</div>
	</div>
	<?php
	$html = ob_get_clean();

	// Allow developer to override the dashboard page for white label purpose.
	echo apply_filters( 'singlestroke_render_theme_dashboard_page', $html );
}