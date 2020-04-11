<?php
/**
 * Template Name: Invitation
 *
 * The template for displaying online invitation page.
 *
 * @package Jack_&_Rose
 * @since 1.5
 */

get_header( 'invitation' ); ?>

	<div id="primary" class="content-area no-sidebar">
		<main id="main" class="site-main" role="main">

			<div class="invitation">
				<div class="invitation-inner">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'blank' ); ?>

					<?php endwhile; // End of the loop. ?>
				</div><!-- .invitation-inner -->
			</div><!-- .invitation -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer( 'invitation' ); ?>
