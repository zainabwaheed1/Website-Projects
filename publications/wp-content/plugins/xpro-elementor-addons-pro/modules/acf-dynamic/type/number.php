<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Number extends Tag {

	public function get_name() {
		return 'xpro-acf-number';
	}

	public function get_title() {
		return __( 'ACF Number', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic';
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function get_categories() {

		return array(
			Module::TEXT_CATEGORY,
			Module::POST_META_CATEGORY,
			Module::NUMBER_CATEGORY,
		);
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['key'] ) ) {
			return;
		}
		list( $field, $meta_key, $value ) = Acf_Dynamic::instance()->get_acf_field_value( $this );
		if ( empty( $value ) ) {
			$value = ! empty( $settings['fallback'] ) ? $settings['fallback'] : 0;
		}
		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'key',
			array(
				'label'   => __( 'Select Field', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'groups'  => Acf_Dynamic::instance()->xpro_get_acf_group( $this->get_supported_fields() ),
				'default' => '',
			)
		);
	}

	public function get_supported_fields() {
		return array(
			'text',
			'number',
		);
	}
}
