<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Custom_Field extends Tag {

	public function get_name() {
		return 'xpro-post-custom-field';
	}

	public function get_title() {
		return __( 'Post Custom Field', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function is_settings_required() {
		return true;
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
			Module::URL_CATEGORY,
			Module::POST_META_CATEGORY,
			Module::COLOR_CATEGORY,
		);
	}

	public function render() {
		$post_data = get_demo_post_data();
		$post_id   = $post_data->ID;
		$key       = $this->get_settings( 'key' );

		if ( empty( $key ) ) {
			$key = $this->get_settings( 'custom_key' );
		}

		if ( empty( $key ) ) {
			return;
		}

		$value = get_post_meta( $post_id, $key, true );

		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'key',
			array(
				'label'   => __( 'Key', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_custom_keys_array(),
			)
		);

		$this->add_control(
			'custom_key',
			array(
				'label'       => __( 'Custom Key', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'key',
				'condition'   => array(
					'key' => '',
				),
			)
		);
	}

	public function get_custom_keys_array() {
		$options = array(
			'' => __( 'Select', 'xpro-elementor-addons-pro' ),
		);

		$post_data = get_demo_post_data();
		if ( isset( $post_data->ID ) ) {
			$custom_keys = get_post_custom_keys( $post_data->ID );

			if ( ! empty( $custom_keys ) ) {
				foreach ( $custom_keys as $custom_key ) {
					if ( '_' !== substr( $custom_key, 0, 1 ) ) {
						$options[ $custom_key ] = $custom_key;
					}
				}
			}
		}

		return $options;
	}
}
