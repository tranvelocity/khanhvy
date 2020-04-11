<?php
/**
 * The header for invitation page template.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jack_&_Rose
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class( jackrose_get_theme_mod( 'animation' ) ? 'jackrose-enable-animations' : 'jackrose-disable-animations' ); ?>>

		<?php
		$preloader = jackrose_get_theme_mod( 'preloader' );
		$embed = false;
		foreach ( $preloader as $p ) {
			if ( is_page_template( 'page-templates/' . $p . '.php' ) ) {
				$embed = true;
				break;
			}
		}
		?>

		<?php if ( $embed ) : ?>
			<div id="preloader" class="preloader">
				<div class="wrapper">
					<div class="preloader-content">
						<?php
						$logo = jackrose_get_theme_mod( 'preloader_logo' );
						$logo = ( is_integer( $logo ) ) ? $logo : jackrose_get_attachment_id_from_url( $logo );
						?>

						<?php if ( ! empty( $logo ) ) : ?>
							<?php
							$meta = wp_get_attachment_metadata( $logo );
							$type = pathinfo( wp_get_attachment_url( $logo ), PATHINFO_EXTENSION );
							$data = file_get_contents( get_attached_file( $logo ) );
							$base64 = base64_encode( $data );
							?>
							<img src="<?php echo esc_attr( 'data:image/' . $type . ';base64,' . $base64 ); ?>" width="<?php echo esc_attr( $meta['width'] ); ?>" height="<?php echo esc_attr( $meta['height'] ); ?>" alt="">
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jackrose' ); ?></a>
			<div id="top"></div>

			<div id="content" class="site-content content-section">
				<div class="wrapper">