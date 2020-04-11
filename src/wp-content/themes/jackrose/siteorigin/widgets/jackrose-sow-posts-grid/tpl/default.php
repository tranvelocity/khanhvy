<?php
$the_query = new WP_Query( siteorigin_widget_post_selector_process_query( $instance['posts'] ) );
?>
<div class="jackrose-sow-blog-grid jackrose-sow-blog-grid-<?php echo esc_attr( $instance['columns'] ); ?>-columns clear">
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="jackrose-sow-blog-post <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">

			<?php if ( has_post_thumbnail() ) : ?>
				<a class="jackrose-sow-blog-post-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail( 1 < $instance['columns'] ? 'grid' : 'full' ); ?>
				</a>
			<?php endif; ?>

			<div class="jackrose-sow-blog-post-text">
				<h4 class="jackrose-sow-blog-post-title typography-heading">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>

				<div class="jackrose-sow-blog-post-content">
					<?php echo apply_filters( 'the_excerpt', wp_trim_words( get_the_content(), 30 ) ); ?>
				</div>
			</div>

		</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>