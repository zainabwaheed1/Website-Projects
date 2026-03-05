<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Term extends Tag {

	public function get_name() {
		return 'xpro-product-term';
	}

	public function get_title() {
		return __( 'Product Term', 'xpro-elementor-addons-pro' );
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

		$settings = $this->get_settings();

		$value = get_the_term_list( $product_id, $settings['taxonomy'], '', $settings['separator'] );

		echo wp_kses_post( $value );
	}

	protected function register_advanced_section() {
		parent::register_advanced_section();

		$this->update_control(
			'before',
			array(
				'default' => __( 'Categories', 'xpro-elementor-addons-pro' ) . ': ',
			)
		);
	}

	protected function register_controls() {
		$taxonomy_filter_args = array(
			'show_in_nav_menus' => true,
			'object_type'       => array( 'product' )
		);

		$taxonomies = get_taxonomies( $taxonomy_filter_args, 'objects' );

		$options = array(
			'' => __( 'Select', 'xpro-elementor-addons-pro' )
		);

		foreach ( $taxonomies as $taxonomy => $object ) {
			$options[ $taxonomy ] = $object->label;
		}

		$this->add_control(
			'taxonomy',
			array(
				'label'   => __( 'Taxonomy', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $options,
				'default' => 'product_cat',
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'   => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => ', ',
			)
		);
	}
}
