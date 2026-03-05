<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Title extends Tag {

	public function get_name() {
		return 'xpro-product-title';
	}

	public function get_title() {
		return __( 'Product Title', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-woo-dynamic';
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
		);
	}

	public function render() {
		$xpro_product_data = get_demo_product_data();
		$product_id        = $xpro_product_data->ID;
		$product           = wc_get_product( $product_id );
		if ( ! $product ) {
			return;
		}
		echo wp_kses_post( $product->get_title() );
	}
}
