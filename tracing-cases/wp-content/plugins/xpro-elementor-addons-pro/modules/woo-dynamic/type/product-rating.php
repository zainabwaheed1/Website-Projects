<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Rating extends Tag {

	public function get_name() {
		return 'xpro-product-rating';
	}

	public function get_title() {
		return __( 'Product Rating', 'xpro-elementor-addons-pro' );
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
			return '';
		}

		$field = $this->get_settings( 'field' );
		$value = '';
		switch ( $field ) {
			case 'average_rating':
				$value = $product->get_average_rating();
				break;
			case 'rating_count':
				$value = $product->get_rating_count();
				break;
			case 'review_count':
				$value = $product->get_review_count();
				break;
		}

		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'field',
			array(
				'label'   => __( 'Format', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'average_rating' => __( 'Average Rating', 'xpro-elementor-addons-pro' ),
					'rating_count'   => __( 'Rating Count', 'xpro-elementor-addons-pro' ),
					'review_count'   => __( 'Review Count', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'average_rating',
			)
		);
	}
}
