<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Gallery extends Data_Tag {

	public function get_name() {
		return 'xpro-product-gallery';
	}

	public function get_title() {
		return __( 'Product Gallery', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-woo-dynamic';
	}

	public function get_categories() {
		return array(
			Module::GALLERY_CATEGORY,
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

		$value = array();

		$attachment_ids = $product->get_gallery_image_ids();

		foreach ( $attachment_ids as $attachment_id ) {
			$value[] = array(
				'id' => $attachment_id,
			);
		}

		return $value;
	}
}
