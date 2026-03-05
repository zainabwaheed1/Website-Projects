<div class="xpro-alert-box-wrapper xpro-alert-box-<?php echo esc_attr( $settings['type'] ); ?>">
	<?php if ( $settings['title'] ) : ?>
		<sapn class="xpro-alert-box-title"><?php echo esc_html( $settings['title'] ); ?></sapn>
	<?php endif; ?>

	<?php if ( $settings['description'] ) : ?>
		<sapn class="xpro-alert-box-txt"><?php echo esc_html( $settings['description'] ); ?></sapn>
	<?php endif; ?>

	<?php if ( '' !== $settings['cross_button'] ) : ?>
		<span class="xpro-alert-box-btn">
		<i class="fas fa-times" aria-hidden="true"></i>
	</span>
	<?php endif; ?>
</div>
