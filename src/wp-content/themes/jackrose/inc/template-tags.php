<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Jack_&_Rose
 */

if ( ! function_exists( 'jackrose_header' ) ) :
	/**
	 * Prints HTML with meta information for header.
	 */
	function jackrose_header() {
		?>
		<div id="header" class="header-anchor header-anchor-<?php echo esc_attr( jackrose_get_theme_mod( 'header_position' ) ); ?>">
			<header id="masthead" class="header-section site-header header-floating" role="banner">
				<div class="wrapper">

					<?php if ( is_front_page() && ! is_paged() ) : ?>
						<h1 class="header-logo site-branding">
					<?php else : ?>
						<p class="header-logo site-branding">
					<?php endif; ?>

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

							<?php
							$logo = jackrose_get_theme_mod( 'header_logo' );
							$logo = ( is_integer( $logo ) ) ? $logo : jackrose_get_attachment_id_from_url( $logo );
							?>

							<?php if ( ! empty( $logo ) ) : ?>
								<?php echo wp_get_attachment_image( $logo , 'full', 0, array( 'alt' => esc_attr( get_bloginfo( 'name' ) ) ) ); ?>
							<?php else : ?>
								<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
							<?php endif; ?>
						</a>

					<?php if ( is_front_page() && ! is_paged() ) : ?>
						</h1><!-- .site-branding -->
					<?php else : ?>
						</p><!-- .site-branding -->
					<?php endif; ?>

					<?php
					$ribbon_text = jackrose_get_theme_mod( 'header_ribbon_text' );
					$ribbon_href = jackrose_get_theme_mod( 'header_ribbon_href' );
					?>

					<?php if ( ! empty( $ribbon_text ) && ! empty( $ribbon_href ) ) : ?>
						<a class="ribbon-menu anchor-link" href="<?php echo esc_url( $ribbon_href ); ?>">
							<span><?php echo ( $ribbon_text ); ?></span>
						</a><!-- .ribbon-menu -->
					<?php endif; ?>

					<nav id="site-navigation" class="header-navigation main-navigation clear" role="navigation">
						
						<button class="header-navigation-toggle menu-toggle toggle">
							<span class="fa fa-navicon"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'jackrose' ); ?></span>
						</button>

						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

					</nav><!-- #site-navigation -->

				</div><!-- .wrapper -->
			</header><!-- #masthead -->
		</div><!-- .header-anchor -->
		<?php
	}
endif;

if ( ! function_exists( 'jackrose_background_music' ) ) :
	/**
	 * Prints HTML with meta information for page background music.
	 */
	function jackrose_background_music() {
		$background_music = jackrose_get_theme_mod( 'background_music' );
		$embed = false;
		foreach ( $background_music as $b ) {
			if ( is_page_template( 'page-templates/' . $b . '.php' ) ) {
				$embed = true;
				break;
			}
		}

		$embed_code = '';
		if ( 'mp3' == jackrose_get_theme_mod( 'background_music_source' ) ) {
			$mp3 = jackrose_get_theme_mod( 'background_music_mp3' );
			if ( ! empty( $mp3 ) ) {
				$embed_code = '<audio controls preload="none" ' . ( jackrose_get_theme_mod( 'background_music_mp3_autoplay' ) ? 'autoplay' : '' ) . ' ' . ( jackrose_get_theme_mod( 'background_music_mp3_loop' ) ? 'loop' : '' ) . '><source src="' . $mp3 . '" type="audio/mpeg"></audio>';
			}
		} elseif ( 'embed' == jackrose_get_theme_mod( 'background_music_source' ) ) {
			$embed_code = jackrose_get_theme_mod( 'background_music_embed' );
		}

		if ( $embed && ! empty( $embed_code ) ) : ?>
			<div id="background-music" class="background-music background-music-<?php echo esc_attr( jackrose_get_theme_mod( 'background_music_position' ) ); ?>">
				<button class="background-music-toggle toggle"><span class="fa fa-music"></span></button>
				<div class="background-music-embed">
					<?php if ( wp_oembed_get( $embed_code ) ) {
						echo wp_oembed_get( $embed_code );
					} else {
						echo ( $embed_code ); // WPCS: XSS OK.
					} ?>
				</div>
			</div>
		<?php endif;
	}
endif;

if ( ! function_exists( 'jackrose_hero_section' ) ) :
	/**
	 * Prints HTML with meta information for hero section.
	 */
	function jackrose_hero_section() {
		
		if ( is_page() && class_exists( 'Attachments' ) ) :
			global $wp_query;
			$attachments = new Attachments( 'jackrose_hero_slider', $wp_query->post->ID );

			if ( $attachments->exist() ) : ?>
				<div id="hero" class="hero-section">
					<div class="hero-slider" data-jackrose-autoplay="<?php echo esc_attr( jackrose_get_theme_mod( 'hero_slider_autoplay' ) ); ?>">
						<?php $i = 0; while ( $attachment = $attachments->get() ) : ?>

							<div id="hero-slide-<?php echo esc_attr( $i ); ?>" class="hero-slide">
								<div class="hero-slide-background section-background">
									<?php if ( 'video' == $attachments->type() ) : ?>
										<?php
										$subtype = $attachments->subtype();
										$url = $attachments->url();
										$filename = str_replace( basename( $url ), basename( $url, '.' . $subtype ), $url );
										$meta = wp_get_attachment_metadata( $attachments->id() );
										?>

										<?php if ( '' != $attachments->field( 'video_poster' ) ) : ?>
											<img class="image-bg" alt=""
												src="<?php echo esc_url( $attachments->field( 'video_poster' ) ); ?>"
												width="<?php echo esc_attr( $meta['width'] ); ?>"
												height="<?php echo esc_attr( $meta['height'] ); ?>"
												<?php echo ( $attachments->field( 'parallax' ) ) ? 'data-stellar-ratio="0.5"' : ''; ?>>
										<?php endif; ?>

										<video autoplay loop muted preload="none" class="video-bg"
											width="<?php echo esc_attr( $meta['width'] ); ?>"
											height="<?php echo esc_attr( $meta['height'] ); ?>"
											<?php echo ( $attachments->field( 'parallax' ) ) ? 'data-stellar-ratio="0.5"' : ''; ?>>
											<source type="video/mp4" src="<?php echo esc_attr( $filename ); ?>.mp4">
											<source type="video/ogg" src="<?php echo esc_attr( $filename ); ?>.ogv">
											<source type="video/webm" src="<?php echo esc_attr( $filename ); ?>.webm">
										</video>
									<?php elseif ( 'image' == $attachments->type() ) : ?>
										<?php $meta = wp_get_attachment_metadata( $attachments->id() ); ?>
										<img class="image-bg" alt=""
											src="<?php echo esc_attr( wp_get_attachment_url( $attachments->id() ) ); ?>"
											width="<?php echo esc_attr( $meta['width'] ); ?>"
											height="<?php echo esc_attr( $meta['height'] ); ?>"
											<?php echo ( $attachments->field( 'parallax' ) ) ? 'data-stellar-ratio="0.5"' : ''; ?>>
									<?php endif; ?>
								</div>
								<div class="hero-slide-overlay" style="background-color: <?php echo esc_attr( $attachments->field( 'overlay' ) ); ?>"></div>
							</div><!-- .slide -->

						<?php $i++; endwhile; ?>
					</div><!-- .hero-slider -->

					<?php if ( jackrose_get_theme_mod( 'hero_effect' ) ) : ?>
						<div id="hero-effect" class="hero-effect" data-jackrose-effect="<?php echo esc_attr( jackrose_get_theme_mod( 'hero_effect' ) ); ?>"></div>
					<?php endif; ?>

					<?php jackrose_hero_logo(); ?>
				</div><!-- #hero -->
			<?php endif;
		endif;
	}
endif;

if ( ! function_exists( 'jackrose_hero_logo' ) ) :
	/**
	 * Prints HTML with meta information for hero section logo.
	 */
	function jackrose_hero_logo() {
		?>
		<div id="hero-logo" class="hero-logo">
			<div class="wrapper">
				<?php
				$logo = jackrose_get_theme_mod( 'hero_logo' );
				$logo = ( is_integer( $logo ) ) ? $logo : jackrose_get_attachment_id_from_url( $logo );
				?>
				
				<?php if ( ! empty( $logo ) ) : ?>
					<div class="hero-logo-image">
						<?php echo wp_get_attachment_image( $logo , 'full', 0, array(
							'alt' => esc_attr( get_bloginfo( 'name' ) ),
						) ); ?>
					</div>
				<?php endif; ?>

				<?php
				$button_text = jackrose_get_theme_mod( 'hero_button_text' );
				$button_href = jackrose_get_theme_mod( 'hero_button_href' );
				?>

				<?php if ( ! empty( $button_text ) && ! empty( $button_href ) ) : ?>
					<div class="hero-action">
						<a href="<?php echo esc_url( $button_href ); ?>" class="hero-button anchor-link"><span><?php echo ( $button_text ); ?></span><i class="fa fa-angle-double-down"></i></a>
					</div>
				<?php endif; ?>
			</div><!-- .wrapper -->
		</div><!-- .hero-logo -->
		<?php
	}
endif;

if ( ! function_exists( 'jackrose_footer' ) ) :
	/**
	 * Prints HTML with meta information for footer section.
	 */
	function jackrose_footer() {
		?>
		<footer id="colophon" class="footer-section site-footer" role="contentinfo">
			<div class="wrapper">
				<?php
				$logo = jackrose_get_theme_mod( 'footer_logo' );
				$logo = ( is_integer( $logo ) ) ? $logo : jackrose_get_attachment_id_from_url( $logo );
				?>

				<?php if ( ! empty( $logo ) ) : ?>
					<div class="footer-logo">
						<?php echo wp_get_attachment_image( $logo , 'full', 0, array(
							'alt' => esc_attr( get_bloginfo( 'name' ) ),
						) ); ?>
					</div><!-- .footer-logo -->
				<?php endif; ?>

				<?php
				$copyright = jackrose_get_theme_mod( 'footer_copyright_text' );
				?>

				<?php if ( ! empty( $copyright ) ) : ?>
					<div class="footer-copyright site-info">
						<?php echo html_entity_decode( $copyright ); ?>
					</div><!-- .site-info -->
				<?php endif; ?>

			</div><!-- .wrapper -->
		</footer><!-- #colophon -->
		<?php
	}
endif;

if ( ! function_exists( 'jackrose_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function jackrose_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<a href="' . get_permalink() . '" class="posted-on">' . $time_string . '</a>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'jackrose_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function jackrose_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: by line */
			printf(
				'<span class="byline">' . esc_html_x( 'Posted by %s', 'post author', 'jackrose' ) . '</span>',
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'jackrose' ) );
			if ( $categories_list ) {
				echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'jackrose' ), esc_html__( '1 Comment', 'jackrose' ), esc_html__( '% Comments', 'jackrose' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'jackrose' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
