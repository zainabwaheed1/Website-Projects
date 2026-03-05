<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Stock extends Tag {

	public function get_name() {
		return 'xpro-product-stock';
	}

	public function get_title() {
		return __( 'Product Stock', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-woo-dynamic';
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
			Module::NUMBER_CATEGORY,
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

		if ( 'yes' === $this->get_settings( 'show_text' ) ) {
			$value = wc_get_stock_html( $product );
		} else {
			$value = $product->get_stock_quantity();
		}

		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'show_text',
			array(
				'label'     => __( 'Show Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off' => __( 'Hide', 'xpro-elementor-addons-pro' ),
			)
		);
	}
}
