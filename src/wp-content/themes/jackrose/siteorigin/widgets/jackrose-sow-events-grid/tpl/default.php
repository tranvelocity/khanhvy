<div class="jackrose-sow-events-grid jackrose-sow-events-grid-<?php echo esc_attr( $instance['columns'] ); ?>-columns clear">
	<?php foreach ( $instance['events'] as $event ) : ?>
		<div class="jackrose-sow-events-grid-item <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">
			<div class="jackrose-sow-events-grid-item-wrapper" style="background-color: <?php echo esc_attr( $event['bg_color'] ); ?>">
				<?php if ( ! empty( $event['photo'] ) ) : ?>
					<?php
					echo empty( $event['photo_link'] ) ? '<div class="jackrose-sow-events-grid-item-photo">' : '<a href="' . sow_esc_url( $event['photo_link'] ) . '" class="jackrose-sow-events-grid-item-photo">' ;
						echo wp_get_attachment_image( $event['photo'], 1 < $instance['columns'] ? 'grid' : 'full' );
					echo empty( $event['photo_link'] ) ? '</div>' : '</a>' ;
					?>
				<?php endif; ?>

				<?php if ( ! empty( $event['icon'] ) ) : ?>
					<div class="jackrose-sow-events-grid-item-icon"><?php echo wp_get_attachment_image( $event['icon'], 'full' ); ?></div>
				<?php endif; ?>
				
				<?php if ( ! empty( $event['title'] ) ) : ?>
					<h4 class="jackrose-sow-events-grid-item-title typography-heading"><?php echo ( $event['title'] ); ?></h4>
				<?php endif; ?>

				<?php if ( ! empty( $event['description'] ) ) : ?>
					<div class="jackrose-sow-events-grid-item-description"><?php echo ( $event['description'] ); ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $event['summary'] ) ) : ?>
					<div class="jackrose-sow-events-grid-item-summary"><?php echo ( $event['summary'] ); ?></div>
				<?php endif; ?>
			</div><!-- .jackrose-sow-events-grid-item-wrapper -->
		</div><!-- .jackrose-sow-events-grid-item -->
	<?php endforeach; ?>
</div><!-- .jackrose-sow-events-grid -->