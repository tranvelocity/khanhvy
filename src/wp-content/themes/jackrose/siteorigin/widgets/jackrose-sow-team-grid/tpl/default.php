<div class="jackrose-sow-team-grid jackrose-sow-team-grid-<?php echo esc_attr( $instance['columns'] ); ?>-columns clear">
	<?php foreach ( $instance['members'] as $i => $member ) : ?>
		<div class="jackrose-sow-team-grid-item <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">
			<div class="jackrose-sow-team-grid-item-photo"><?php echo wp_get_attachment_image( $member[ 'photo' ], 'full' ); ?></div>
			<div class="jackrose-sow-team-grid-item-name typography-heading"><?php echo ( $member['name'] ); ?></div>
		</div><!-- .jackrose-sow-team-grid-item -->
	<?php endforeach; ?>
</div><!-- .jackrose-sow-team-grid -->