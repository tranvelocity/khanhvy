<?php
$filters = array();
$tagged = array();
foreach ( $instance['photos'] as $i => $photo ) {
	$tags = explode( ',', $photo['tags'] );
	$tags = array_map( 'trim', $tags );
	$tagged[ $i ] = array();

	foreach ( $tags as $tag ) {
		if ( ! in_array( $tag, $filters ) ) {
			$filters[ sanitize_key( $tag ) ] = $tag;
		}
		$tagged[ $i ][] = 'jackrose-sow-' . sanitize_key( $tag );
	}
}
asort( $filters );
?>
<div class="jackrose-sow-gallery-grid">
	<?php if ( $instance['filter'] ) : ?>
		<div class="jackrose-sow-gallery-grid-filters">
			<a href="#" class="jackrose-sow-gallery-grid-filter active" data-filter="*"><?php echo ( $instance[ 'label_all_photos' ] ); ?></a>
			<?php foreach ( $filters as $key => $filter ) : ?>
				<a href="#" class="jackrose-sow-gallery-grid-filter" data-filter=".jackrose-sow-<?php echo esc_attr( $key ); ?>"><?php echo ( $filter ); ?></a>
			<?php endforeach; ?>
		</div><!-- .jackrose-sow-gallery-grid-filters -->
	<?php endif; ?>
	<div class="jackrose-sow-gallery-grid-items jackrose-sow-gallery-grid-<?php echo esc_attr( $instance['columns'] ); ?>-columns lightgallery clear">
		<?php foreach ( $instance['photos'] as $i => $photo ) : ?>
			<?php if ( empty( $photo['image'] ) ) continue; ?>
			<div class="jackrose-sow-gallery-grid-item <?php echo esc_attr( implode( ' ', $tagged[ $i ] ) ); ?>">
				<a href="<?php echo sow_esc_url( wp_get_attachment_url( $photo['image'] ) ); ?>">
					<?php echo wp_get_attachment_image( $photo['image'], 'grid' ); ?>
				</a>
			</div><!-- .jackrose-sow-gallery-grid-item -->
		<?php endforeach; ?>
	</div><!-- .jackrose-sow-gallery-grid-items -->
</div><!-- .jackrose-sow-gallery-grid -->