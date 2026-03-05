<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic\Group;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Number extends Tag {

	public function get_name() {
		return 'xpro-acf-group-number';
	}

	public function get_title() {
		return __( 'ACF Group Number', 'xpro-elementor-addons-pro' );
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
		list( $field, $value ) = Acf_Dynamic::instance()->get_acf_group_field_value( $this );
		if ( empty( $value ) ) {
			$value = ! empty( $settings['fallback'] ) ? $settings['fallback'] : 0;
		}
		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		Acf_Dynamic::instance()->register_xpro_dynamic_group_controls( $this, $this->get_supported_fields() );
	}

	public function get_supported_fields() {
		return array(
			'text',
			'number',
		);
	}
}
