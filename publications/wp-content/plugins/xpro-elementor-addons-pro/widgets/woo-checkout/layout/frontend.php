<?php

use Elementor\Plugin;


if ( ! function_exists( 'WC' ) || empty( WC()->cart ) ) {
	return;
}

if ( WC()->cart->get_cart_contents_count() < 1 ) {
	$products = wc_get_products(
		array(
			'status' => array( 'publish' ),
			'type'   => array( 'simple' ),
			'return' => 'ids',
			'limit'  => 1
		)
	);

	if ( ! empty( $products ) ) {
		WC()->cart->add_to_cart( $products[0], 1 );
	}
}

?>

<div class="xpro-woo-checkout">
	<?php echo xpro_elementor_do_shortcode( 'woocommerce_checkout' ); ?>
</div>
