<?php

use Elementor\Icons_Manager;
use Elementor\Plugin;

if ( 'dropdown' === $settings['up_layout'] ) {
	$layout = 'dropdown';
} elseif ( 'modal' === $settings['up_layout'] ) {
	$layout = 'modal';
} elseif ( 'off_canvas' === $settings['up_layout'] ) {
	$layout = $settings['layout'];
}

$hover_animation = ( '2d-transition' === $settings['hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['hover_2d_css_animation'] : ( ( 'background-transition' === $settings['hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['hover_background_css_animation'] : ( ( 'unique' === $settings['hover_animation'] ) ? 'xpro-elementor-button-hover-style-' . $settings['hover_unique_animation'] : 'xpro-elementor-button-animation-none' ) );
?>
<div class="xpro-elementor-hamburger-wrapper xpro-elementor-mini-cart-wrapper xpro-elementor-up-wrapper xpro-elementor-hamburger-layout-<?php echo esc_attr( $layout ); ?> xpro-elementor-mini-cart-layout-<?php echo esc_attr( $settings['up_layout'] ); ?> xpro-elementor-mini-cart-style-<?php echo esc_attr( $settings['up_style'] ); ?>">

	<button type="button"
			class="xpro-elementor-hamburger-toggle xpro-elementor-minicart-toggle <?php echo esc_attr( $hover_animation ); ?> xpro-align-icon-<?php echo esc_attr( ( 'left' === $settings['icon_align'] ) ? 'left' : 'right' ); ?>">
		<!-- up button -->
		<span class="xpro-elementor-hamburger-toggle-inner">
			<?php if ( $settings['icon'] ) : ?>

				<span class="xpro-elementor-hamburger-toggle-media xpro-up-user-icon">
					<!-- user icon -->
					<?php
					Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
					?>
				</span>

				<?php if ( 'text' === $settings['select_txt_type'] ) : ?>
					<span class="xpro-button-text">
						<?php echo esc_html( $settings['text'] ); ?>
					</span>
				<?php endif; ?>

			<?php endif; ?>
		</span>
	</button>

	<div class="xpro-elementor-hamburger-overlay"></div>
	<!-- up inner content -->
	<div class="xpro-elementor-hamburger-inner xpro-mini-cart-content-inner xpro-woo-up-content-inner">
		<!-- close button -->
		<div class="xpro-elementor-hamburger-close-wrapper">
			<button class="xpro-elementor-hamburger-close-btn">
				<?php Icons_Manager::render_icon( $settings['close_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</button>
		</div>
		<!-- tabs item -->
		<div class="xpro-woo-mini-cart-content xpro-woo-up-content">
			<?php
			//preview endpoint
			if ( Plugin::$instance->editor->is_edit_mode() ) {
				if ( 'login' === $settings['preview_endpoint'] ) {
					//user profile form
					require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/user-profile-form.php';
				} elseif ( 'signup' === $settings['preview_endpoint'] ) {
					//user profile form
					require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/user-profile-form.php';
				} elseif ( 'dash' === $settings['preview_endpoint'] ) {
					//account dashboard
					require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/account-dashboard.php';
					?>
					<?php
				}
			} else {
				?>
				<?php
				if ( is_user_logged_in() ) {
					//account dashboard
					require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/account-dashboard.php';
					?>
					<?php
				} else {
					//user profile form
					require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/user-profile-form.php';
					?>
					<?php
				}
			}
			?>
		</div>
	</div>
	<!-- cart inner content end-->
</div>
