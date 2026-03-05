<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Color extends Data_Tag {

	public function get_name() {
		return 'xpro-acf-color';
	}

	public function get_title() {
		return __( 'ACF Color', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic';
	}

	public function get_categories() {
		return array(
			Module::COLOR_CATEGORY,
		);
	}

	public function get_panel_template_setting_key() {
		return 'key';
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
		$this->add_control(
			'fallback',
			array(
				'label' => __( 'Fallback', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
	}

	protected function get_supported_fields() {
		return array(
			'color_picker',
		);
	}

	protected function get_value( array $options = array() ) {

		$settings = $this->get_settings_for_display();

		if ( empty( $settings['key'] ) ) {
			return array();
		}

		list( $field, $meta_key, $value ) = Acf_Dynamic::instance()->get_acf_field_value( $this );

		if ( 'array' === $field['return_format'] ) {
			$value = '';
		}

		if ( empty( $value ) && $this->get_settings( 'fallback' ) ) {
			$value = $this->get_settings( 'fallback' );
		}

		return $value;
	}
}
