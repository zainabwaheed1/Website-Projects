<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic\Group;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Gallery extends Data_Tag {


	public function get_name() {
		return 'xpro-acf-group-gallery';
	}

	public function get_title() {
		return __( 'ACF Group Gallery', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic';
	}

	public function get_categories() {
		return array(
			Module::GALLERY_CATEGORY,
		);
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function get_value( array $options = array() ) {
		$images = array();
		// TODO: Implement get_value() method.
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['key'] ) ) {
			return array();
		}
		list( $field, $value ) = Acf_Dynamic::instance()->get_acf_group_field_value( $this );
		if ( empty( $field ) ) {
			return;
		}

		$field['return_format'] = isset( $field['save_format'] ) ? $field['save_format'] : $field['return_format'];

		if ( empty( $value ) ) {
			return array();
		}

		switch ( $field['return_format'] ) {
			case 'array':
				foreach ( $value as $image ) {
					$images[] = array(
						'id' => $image['ID'],
					);
				}
				break;
			case 'id':
				foreach ( $value as $image ) {
					$images[] = array(
						'id' => $image,
					);
				}
				break;
			case 'url':
				foreach ( $value as $image ) {
					$image    = attachment_url_to_postid( $image );
					$images[] = array(
						'id' => $image,
					);
				}
				break;
		}

		return $images;
	}

	protected function register_controls() {
		Acf_Dynamic::instance()->register_xpro_dynamic_group_controls( $this, $this->get_supported_fields() );
	}

	public function get_supported_fields() {
		return array(
			'gallery',
		);
	}
}
