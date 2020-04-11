<div class="jackrose-sow-buttons align-<?php echo esc_attr( $instance['alignment'] ); ?> <?php echo ( ! empty( $instance['animation'] ) ) ? 'jackrose-animation-' . esc_attr( $instance['animation'] ) : ''; ?>">
	<?php foreach ( $instance['buttons'] as $button ) : ?>
		<a class="jackrose-sow-button button" href="<?php echo sow_esc_url( $button['url'] ); ?>" <?php echo ( $button['new_tab'] ) ? ' target="_blank"' : ''; ?>>
			<?php echo ( $button['text'] ); ?>
		</a>
	<?php endforeach; ?>
</div>