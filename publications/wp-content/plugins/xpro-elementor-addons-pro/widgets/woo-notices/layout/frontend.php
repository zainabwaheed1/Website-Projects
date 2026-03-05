<?php use Elementor\Plugin;

if ( Plugin::$instance->editor->is_edit_mode() || is_preview() ) :
	?>
	<div class="woocommerce-message" role="alert">
		<a href="#" tabindex="1" class="button wc-forward"><?php esc_html_e( 'View cart', 'xpro-elementor-addons-pro' ); ?></a><?php esc_html_e( '“Beanie” has been added to your cart.', 'xpro-elementor-addons-pro' ); ?>
	</div>
<?php else : ?>
	<div class="xpro-checkout-notice">
		<?php is_single() ? wc_print_notices() : ''; ?>
	</div>
<?php endif; ?>
