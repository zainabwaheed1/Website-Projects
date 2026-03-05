<?php

use Elementor\Icons_Manager;

if ( null === WC()->cart ) {
	return;
}
$product_count = WC()->cart->get_cart_contents_count();
$sub_total     = WC()->cart->get_cart_subtotal();

if ( 'dropdown' === $settings['cart_layout'] ) {
	$layout = 'dropdown';
} elseif ( 'modal' === $settings['cart_layout'] ) {
	$layout = 'modal';
} elseif ( 'off_canvas' === $settings['cart_layout'] ) {
	$layout = $settings['layout'];
}

$hover_animation = ( '2d-transition' === $settings['hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['hover_2d_css_animation'] : ( ( 'background-transition' === $settings['hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['hover_background_css_animation'] : ( ( 'unique' === $settings['hover_animation'] ) ? 'xpro-elementor-button-hover-style-' . $settings['hover_unique_animation'] : 'xpro-elementor-button-animation-none' ) );
?>
<div class="xpro-elementor-hamburger-wrapper xpro-elementor-mini-cart-wrapper xpro-elementor-hamburger-layout-<?php echo esc_attr( $layout ); ?> xpro-elementor-mini-cart-layout-<?php echo esc_attr( $settings['cart_layout'] ); ?> xpro-elementor-mini-cart-style-<?php echo esc_attr( $settings['cart_style'] ); ?>">

	<button type="button" class="xpro-elementor-hamburger-toggle xpro-elementor-minicart-toggle <?php echo esc_attr( $hover_animation ); ?> xpro-align-icon-<?php echo esc_attr( ( 'left' === $settings['icon_align'] ) ? 'left' : 'right' ); ?>">
		<!-- cart button -->
		<span class="xpro-elementor-hamburger-toggle-inner">
			<?php if ( $settings['icon'] ) : ?>

				<span class="xpro-elementor-hamburger-toggle-media xpro-minicart-icon">
					<!-- cart icon -->
					<?php
					Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
					?>
					<?php if ( $settings['show_badge'] ) : ?>
						<span id="xpro-cart-btn-badge" class="xpro-cart-btn-badge">
							<!-- badge count -->
							<?php echo esc_html( $product_count ); ?>
						</span>
					<?php endif; ?>
				</span>


				<?php if ( 'text' === $settings['select_txt_type'] ) : ?>
					<span class="xpro-button-text">
						<?php echo esc_html( $settings['text'] ); ?>
					</span>
				<?php elseif ( 'subtotal' === $settings['select_txt_type'] ) : ?>
					<span class="xpro-mc__btn-subtotal">
						<!-- subtoal -->
						<?php xpro_elementor_kses( $sub_total ); ?>
					</span>
				<?php endif; ?>

			<?php endif; ?>
		</span>
	</button>

	<div class="xpro-elementor-hamburger-overlay"></div>
	<!-- cart inner content -->
	<div class="xpro-elementor-hamburger-inner xpro-mini-cart-content-inner">
		<!-- close button -->
		<div class="xpro-elementor-hamburger-close-wrapper">
			<button class="xpro-elementor-hamburger-close-btn">
				<?php Icons_Manager::render_icon( $settings['close_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</button>
		</div>
		<!-- cart item -->
		<div class="xpro-woo-mini-cart-content">
			<h2 class="xpro-mini-cart-heading">
				Your Cart
				<?php if ( $product_count ) : ?>
					<!-- count -->
					(<span class="xpro-mini-cart-item-count">
						<!-- bage count -->
						<?php echo esc_html( $product_count ); ?>
					</span>)
				<?php endif; ?>
			</h2>
			<div class="xpro-mini-cart-items">
				<?php
				require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-mini-cart/layout/mini-cart.php';
				?>
			</div>
		</div>
	</div>
	<!-- cart inner content end-->
</div>
