<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Short_Description extends Tag {

	public function get_name() {
		return 'xpro-product-short-description';
	}

	public function get_title() {
		return __( 'Product Short Description', 'xpro-elementor-addons-pro' );
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

		if ( ! $product_id ) {
			return;
		}
		$product = wc_get_product( $product_id );
		if ( ! $product ) {
			return;
		}

		echo wp_kses_post( $product->get_short_description() );
	}
}
