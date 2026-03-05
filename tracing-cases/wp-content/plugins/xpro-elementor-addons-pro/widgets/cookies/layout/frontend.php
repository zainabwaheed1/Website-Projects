<div class="xpro-cookies-wrapper animated <?php echo esc_attr( $settings['cookies_animation'] ); ?> xpro-cookies-<?php echo esc_attr( $settings['position'] ); ?>">
	<div class="xpro-cookies-content">
		<?php if ( $settings['description'] ) : ?>
			<p class="xpro-cookies-txt"><?php xpro_elementor_kses( $settings['description'] ); ?></p>
		<?php endif; ?>

		<?php if ( $settings['anchor_text'] ) : ?>
			<a class="xpro-cookies-anchor-text" href="<?php echo esc_url( $settings['anchor_link']['url'] ); ?>" target="_blank" role="button"><?php echo esc_html( $settings['anchor_text'] ); ?></a>
		<?php endif; ?>
	</div>
	<?php if ( $settings['btn'] ) : ?>
		<button class="xpro-cookies-btn" type="button"><?php echo esc_html( $settings['btn'] ); ?></button>
	<?php endif; ?>
</div>
