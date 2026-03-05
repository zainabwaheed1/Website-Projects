<?php

use Elementor\Plugin;

global $product, $post;

$post_type = $post->post_type;

$get_all_product = array(
	'orderby'     => 'date',
	'numberposts' => - 1,
	'order'       => 'ASC',
	'return'      => 'ids',
	'status'      => 'publish'
);

$get_all_product_ids = wc_get_products( $get_all_product );

if ( empty( $product ) && Plugin::$instance->editor->is_edit_mode() && ( empty( $get_all_product_ids ) ) ) {
	?>
	<p class="xpro-alert xpro-alert-warning">
		<span class="xpro-alert-title"><?php echo esc_html__( 'Product Not Found', 'xpro-elementor-addons-pro' ); ?></span>
		<span class="xpro-alert-description"><?php echo esc_html__( 'Sorry, but nothing matched your selection. Please try again with some different keywords.', 'xpro-elementor-addons-pro' ); ?></span>
	</p>
	<?php
	return;
}
$args           = array(
	'limit'   => 1,
	'orderby' => 'date',
	'order'   => 'ASC',
	'return'  => 'ids',
	'status'  => 'publish'
);
$get_product_id = wc_get_products( $args );
if ( $get_product_id ) {
	$first_product_id = $get_product_id[0];
}
if ( is_single() && 'xpro-themer' !== $post_type && 'xpro_content' !== $post_type && 'product' === $post_type ) {
	$product_id = get_the_id();
} else {
	if ( ! empty( $get_product_id ) ) {
		$product_id = $first_product_id;
	}
}

if ( isset( $product_id ) && '' !== $product_id ) {

	$product = wc_get_product( $product_id );
	if ( $product ) :
		$product_data = $product->get_data();
		$post         = get_post( $product_id, OBJECT );

		setup_postdata( $post );
		do_action( 'xpro_elementor_woo_before_product' );
		?>

		<div class="xpro-woo-themer-module-wrapper woocommerce clearfix">
			<div class="xpro-woo-themer-module-layout-cls">
				<div class="xpro-woo-product-meta-cls">
					<div class="product_meta">
						<?php do_action( 'woocommerce_product_meta_start' ); ?>

						<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

							<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'xpro-elementor-addons-pro' ); ?>
								<span class="sku"><?php echo ( $product->get_sku() ) ? esc_html( $product->get_sku() ) : esc_html__( 'N/A', 'xpro-elementor-addons-pro' ); ?></span>
							</span>

						<?php endif; ?>

						<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'xpro-elementor-addons-pro' ) . ' ', '</span>' ); ?>

						<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'xpro-elementor-addons-pro' ) . ' ', '</span>' ); ?>

						<?php do_action( 'woocommerce_product_meta_end' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		do_action( 'xpro_elementor_woo_after_product' );
		wp_reset_postdata();
	endif;
}
