<div class="jackrose-sow-countdown align-<?php echo esc_attr( $instance['alignment'] ); ?>" data-jackrose-target="<?php echo esc_attr( $instance['target'] ); ?>" data-jackrose-build="<?php echo esc_attr( $instance['build'] ); ?>">
	<?php
	$builds = explode( '_', $instance['build'] );
	?>
	<?php foreach ( $builds as $build ) : ?>
		<?php switch ( $build ) {
			case 'm':
				$type = 'months';
				break;
			case 'D': case 'n':
				$type = 'days';
				break;
			case 'H':
				$type = 'hours';
				break;
			case 'M':
				$type = 'minutes';
				break;
			case 'S':
				$type = 'seconds';
				break;
		} ?>
		<div class="jackrose-sow-countdown-fragment jackrose-sow-countdown-<?php echo esc_attr( $type ); ?>"
		data-jackrose-format="<?php echo esc_attr( $build ); ?>"
		data-jackrose-singular="<?php echo esc_attr( $instance[ $type ]['label_singular'] ); ?>"
		data-jackrose-plural="<?php echo esc_attr( $instance[ $type ]['label_plural'] ); ?>">
			<big></big><small></small>
		</div><!-- .jackrose-sow-countdown-fragment -->
	<?php endforeach; ?>
</div><!-- .jackrose-sow-countdown -->