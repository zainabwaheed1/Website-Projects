<?php

use Elementor\Icons_Manager;
use Elementor\Plugin;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;

$hover_animation = ( '2d-transition' === $settings['hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['hover_2d_css_animation'] : ( ( 'background-transition' === $settings['hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['hover_background_css_animation'] : ( ( 'unique' === $settings['hover_animation'] ) ? 'xpro-elementor-button-hover-style-' . $settings['hover_unique_animation'] : 'xpro-elementor-button-animation-none' ) );

$cookie = isset( $_COOKIE[ 'xpro-modal-popup-cookies-' . $this->get_id() ] ) ? $_COOKIE[ 'xpro-modal-popup-cookies-' . $this->get_id() ] : '';

?>
<div class="xpro-elementor-modal-popup-wrapper xpro-elementor-modal-popup-layout-<?php echo esc_attr( $settings['layout'] ); ?><?php echo esc_attr( $cookie === 'valid' ? ' xpro-hide' : '' ); ?>">

	<?php if ( 'default' === $settings['layout'] ) : ?>
		<button type="button"
				class="xpro-elementor-modal-popup-toggle <?php echo esc_attr( $hover_animation ); ?> xpro-align-icon-<?php echo esc_attr( ( 'left' === $settings['icon_align'] ) ? 'left' : 'right' ); ?>">
		<span class="xpro-elementor-modal-popup-toggle-inner">
		<?php if ( $settings['icon'] ) : ?>
			<span class="xpro-elementor-modal-popup-toggle-media">
				<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
		<?php endif; ?>
			<span class="xpro-button-text"><?php echo esc_attr( $settings['text'] ); ?></span>
		</span>
		</button>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['overlay'] ) : ?>
		<div class="xpro-elementor-modal-popup-overlay"></div>
	<?php endif; ?>
	<div class="xpro-elementor-modal-popup-inner">
		<div class="xpro-elementor-modal-popup animated <?php echo esc_attr( $settings['modal_animation'] ); ?>">
			<div class="xpro-elementor-modal-popup-close-wrapper">
				<button class="xpro-elementor-modal-popup-close-btn">
					<?php Icons_Manager::render_icon( $settings['close_icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</button>
			</div>
			<?php
			if ( 'template' === $settings['source'] ) {
				   echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['xpro_elementor_modal_popup_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				Xpro_Elementor_Widget_Area_Utils::parse( $settings['xpro_elementor_modal_popup_content'], $this->get_id(), 99 );
			}
			?>
		</div>
	</div>
</div>
