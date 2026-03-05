<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Sale extends Tag {

	public function get_name() {
		return 'xpro-product-sale';
	}

	public function get_title() {
		return __( 'Product Sale', 'xpro-elementor-addons-pro' );
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

		$value = '';

		if ( $product->is_on_sale() ) {
			$value = $this->get_settings( 'text' );
		}

		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'text',
			array(
				'label'   => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Sale!', 'xpro-elementor-addons-pro' ),
			)
		);
	}
}
