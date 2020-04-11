<div class="jackrose-sow-guestbook">
	<?php echo do_shortcode( '[gwolle_gb' . ( 'write-read' == $instance['mode'] ? '' : '_' . $instance['mode'] ) . ( $instance['global'] ? '' : ' book_id="' . $post->ID . '"' ) . ' button="false"]' ); ?>
</div>