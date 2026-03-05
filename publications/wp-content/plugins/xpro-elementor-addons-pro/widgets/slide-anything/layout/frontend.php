<div class="xpro-slide-anything-wrapper">
	<div id="xpro-slide-anything-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-slide-anything owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">
		<?php

		use Elementor\Plugin;
		use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;

		foreach ( $settings['slider_item'] as $i => $item ) {
			?>
			<div class="xpro-slide-item-inner elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
				<?php
				if ( 'template' === $item['source'] ) {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $item['item_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					Xpro_Elementor_Widget_Area_Utils::parse( $item['item_content'], $this->get_id(), $item['_id'] );
				}
				?>
			</div>
		<?php } ?>
	</div>
</div>
