<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Price extends Tag {

	public function get_name() {
		return 'xpro-product-price';
	}

	public function get_title() {
		return __( 'Product Price', 'xpro-elementor-addons-pro' );
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

		$format = $this->get_settings( 'format' );
		$value  = '';
		switch ( $format ) {
			case 'both':
				$value = $product->get_price_html();
				break;
			case 'original':
				$value = wc_price( $product->get_regular_price() ) . $product->get_price_suffix();
				break;
			case 'sale' && $product->is_on_sale():
				$value = wc_price( $product->get_sale_price() ) . $product->get_price_suffix();
				break;
		}

		echo $value;
	}

	protected function register_controls() {
		$this->add_control(
			'format',
			array(
				'label'   => __( 'Format', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'both'     => __( 'Both', 'xpro-elementor-addons-pro' ),
					'original' => __( 'Original', 'xpro-elementor-addons-pro' ),
					'sale'     => __( 'Sale', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'both',
			)
		);
	}
}
