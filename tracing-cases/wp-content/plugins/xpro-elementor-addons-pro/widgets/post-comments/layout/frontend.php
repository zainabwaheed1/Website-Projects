<?php

use Elementor\Plugin;

if ( ! comments_open() ) :
	?>
	<div class="xpro-alert xpro-alert-<?php echo esc_attr( $settings['skin_temp'] ); ?>" role="alert">
		<span class="xpro-alert-title">
			<?php esc_html_e( 'Comments are closed.', 'xpro-elementor-addons-pro' ); ?>
		</span>
		<span class="xpro-alert-description">
				<?php esc_html_e( 'Switch on comments from either the discussion box on the WordPress post edit screen or from the WordPress discussion settings.', 'xpro-elementor-addons-pro' ); ?>
		</span>
	</div>
	<?php
else :
	comments_template();
endif;
