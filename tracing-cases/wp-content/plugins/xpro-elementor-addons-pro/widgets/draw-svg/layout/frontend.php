<?php if ( ! empty( $settings['svg']['value']['url'] ) ) : ?>
	<div class="xpro-draw-svg-wrapper">
		<?php echo file_get_contents( $settings['svg']['value']['url'] ); ?>
	</div>
<?php endif; ?>
