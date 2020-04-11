<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Jack_&_Rose
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo ( in_array( 'single', jackrose_get_theme_mod( 'sidebar' ) ) ) ? 'with-sidebar' : 'no-sidebar'; ?>">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( in_array( 'single', jackrose_get_theme_mod( 'sidebar' ) ) ) get_sidebar(); ?>
<?php get_footer(); ?>
