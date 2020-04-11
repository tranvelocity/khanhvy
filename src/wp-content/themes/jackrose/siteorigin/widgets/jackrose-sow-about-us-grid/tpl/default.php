<div class="jackrose-sow-about-us-grid">
	<?php foreach ( $instance['items'] as $i => $item ) : ?>
		<div class="jackrose-sow-about-us-grid-item jackrose-sow-about-us-grid-item-photo-<?php echo ( $i % 2 == 0 ) ? 'left' : 'right'; ?> clear <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>"
			style="background-color: <?php echo esc_attr( $item['bg_color'] ); ?>">
			<div class="jackrose-sow-about-us-grid-item-photo">
				<?php $img = wp_get_attachment_image_src( $item[ 'photo' ], 'grid' ); ?>
				<div class="jackrose-sow-about-us-grid-item-photo-image" style="background-image: url(<?php echo esc_attr( $img[0] ); ?>);"></div>
			</div><!-- .jackrose-sow-about-us-grid-item-photo -->
			<div class="jackrose-sow-about-us-grid-item-text">
				<h4 class="jackrose-sow-about-us-grid-item-name typography-heading"><?php echo ( $item['name'] ); ?></h4>
				<div class="jackrose-sow-about-us-grid-item-content"><?php echo ( $item['description'] ); ?></div>
				<div class="jackrose-sow-about-us-grid-item-links">
					<?php foreach ( $item['links'] as $link ) : ?>
						<a href="<?php echo sow_esc_url( $link['url'] ); ?>">
							<span class="fa fa-<?php echo esc_attr( $link['type'] ); ?>"></span>
							<span class="screen-reader-text"><?php echo $link['type']; ?></span>
						</a>
					<?php endforeach; ?>
				</div><!-- .jackrose-sow-about-us-grid-item-links -->
			</div><!-- .jackrose-sow-about-us-grid-item-text -->
		</div><!-- .jackrose-sow-about-us-grid-item -->
	<?php endforeach; ?>
</div><!-- .jackrose-sow-about-us-grid -->