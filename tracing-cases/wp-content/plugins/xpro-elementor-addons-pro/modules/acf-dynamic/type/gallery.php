<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Gallery extends Data_Tag {


	public function get_name() {
		return 'xpro-acf-gallery';
	}

	public function get_title() {
		return __( 'ACF Gallery', 'xpro-elementor-addons-pro' );
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

		if ( ! defined( '\ACF_PRO' ) ) {
			return array();
		}

		$images   = array();
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['key'] ) ) {
			return array();
		}
		list( $field, $meta_key, $value ) = Acf_Dynamic::instance()->get_acf_field_value( $this );
		$field['return_format']           = isset( $field['save_format'] ) ? $field['save_format'] : $field['return_format'];
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
			'gallery',
		);
	}
}
