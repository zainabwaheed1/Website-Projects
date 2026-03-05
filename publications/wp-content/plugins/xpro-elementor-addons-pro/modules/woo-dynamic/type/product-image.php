<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Image extends Data_Tag {

	public function get_name() {
		return 'xpro-product-image';
	}

	public function get_title() {
		return __( 'Product Image', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-woo-dynamic';
	}

	public function get_categories() {
		return array(
			Module::IMAGE_CATEGORY,
			Module::MEDIA_CATEGORY,

		);
	}

	public function get_value( array $options = array() ) {
		$xpro_product_data = get_demo_product_data();
		$product_id        = $xpro_product_data->ID;

		if ( ! $product_id ) {
			return;
		}
		$product = wc_get_product( $product_id );
		if ( ! $product ) {
			return;
		}

		$image_id = $product->get_image_id();

		if ( ! $image_id ) {
			return array();
		}

		$src = wp_get_attachment_image_src( $image_id, 'full' );

		return array(
			'id'  => $image_id,
			'url' => $src[0],
		);
	}
}
