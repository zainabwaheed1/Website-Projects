<?php

use Elementor\Icons_Manager;
use Elementor\Plugin;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;

$hover_animation = ( '2d-transition' === $settings['hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['hover_2d_css_animation'] : ( ( 'background-transition' === $settings['hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['hover_background_css_animation'] : ( ( 'unique' === $settings['hover_animation'] ) ? 'xpro-elementor-button-hover-style-' . $settings['hover_unique_animation'] : 'xpro-elementor-button-animation-none' ) );
?>
<div class="xpro-elementor-hamburger-wrapper xpro-elementor-hamburger-layout-<?php echo esc_attr( $settings['layout'] ); ?>">

	<div class="xpro-elementor-hamburger-toggle-wrapper">
	<button type="button" class="xpro-elementor-hamburger-toggle <?php echo esc_attr( $hover_animation ); ?> xpro-align-icon-<?php echo esc_attr( ( 'left' === $settings['icon_align'] ) ? 'left' : 'right' ); ?>">
		<span class="xpro-elementor-hamburger-toggle-inner">
		<?php if ( $settings['icon'] ) : ?>
			<span class="xpro-elementor-hamburger-toggle-media">
				<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
		<?php endif; ?>
			<span class="xpro-button-text"><?php echo esc_html( $settings['text'] ); ?></span>
		</span>
	</button>
	</div>

	<div class="xpro-elementor-hamburger-overlay"></div>
	<div class="xpro-elementor-hamburger-inner">
		<div class="xpro-elementor-hamburger-close-wrapper">
			<button class="xpro-elementor-hamburger-close-btn">
				<?php Icons_Manager::render_icon( $settings['close_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</button>
		</div>
		<?php
		if ( 'template' === $settings['source'] ) {
			echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['xpro_elementor_hamburger_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			Xpro_Elementor_Widget_Area_Utils::parse( $settings['xpro_elementor_hamburger_content'], $this->get_id(), 99 );
		}
		?>
	</div>

</div>
