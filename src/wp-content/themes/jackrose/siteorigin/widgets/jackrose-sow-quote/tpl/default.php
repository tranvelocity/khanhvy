<div class="jackrose-sow-quote align-<?php echo esc_attr( $instance['alignment'] ); ?>" data-jackrose-autoplay="<?php echo esc_attr( $instance['autoplay'] ); ?>">
	<?php foreach ( $instance['quotes'] as $quote ) : ?>
		<div class="jackrose-sow-quote-item">
			<div class="jackrose-sow-quote-text"><?php echo ( $quote['text'] ); ?></div>
			<div class="jackrose-sow-quote-name"><?php echo ( $quote['name'] ); ?></div>
		</div><!-- .jackrose-sow-quote-item -->
	<?php endforeach; ?>
</div><!-- .jackrose-sow-quote -->