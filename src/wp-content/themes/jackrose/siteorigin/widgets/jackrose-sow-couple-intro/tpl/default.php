<div class="jackrose-sow-couple-intro align-<?php echo esc_attr( $instance['alignment'] ); ?>">
	<?php
	$first = '';
	$second = '';

	if ( $instance['order'] != 'groom-bride' ) {
		$first = 'bride';
		$second = 'groom';
	} else {
		$first = 'groom';
		$second = 'bride';
	}
	?>
	<div class="jackrose-sow-couple-intro-<?php echo esc_attr( $first ); ?> <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">
		<div class="jackrose-sow-couple-intro-photo">
			<?php $image = wp_get_attachment_image( $instance[ $first ][ 'photo' ], 'full' ); ?>
			<?php if ( ! empty( $image ) ) echo ( $image ); ?>
		</div>

		<div class="jackrose-sow-couple-intro-name typography-heading"><?php echo ( $instance[ $first ][ 'name' ] ); ?></div>
	</div><!-- .jackrose-sow-couple-intro-<?php echo esc_attr( $first ); ?> -->

	<div class="jackrose-sow-couple-intro-separator <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">
		<?php $sep = wp_get_attachment_image( $instance[ 'separator' ], 'full' ); ?>
		
		<?php if ( ! empty( $sep ) ) echo ( $sep ); ?>
	</div><!-- .jackrose-sow-couple-intro-separator -->

	<div class="jackrose-sow-couple-intro-<?php echo esc_attr( $second ); ?> <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">
		<div class="jackrose-sow-couple-intro-photo">
			<?php $image = wp_get_attachment_image( $instance[ $second ][ 'photo' ], 'full' ); ?>
			<?php if ( ! empty( $image ) ) echo ( $image ); ?>
		</div>

		<div class="jackrose-sow-couple-intro-name typography-heading"><?php echo ( $instance[ $second ][ 'name' ] ); ?></div>
	</div><!-- .jackrose-sow-couple-intro-<?php echo esc_attr( $second ); ?> -->
</div><!-- .jackrose-sow-couple-intro -->