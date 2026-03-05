<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic\Group;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Image extends Data_Tag {


	public function get_name() {
		return 'xpro-acf-group-image';
	}

	public function get_title() {
		return __( 'ACF Group Image', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic';
	}

	public function get_categories() {
		return array(
			Module::MEDIA_CATEGORY,
			Module::IMAGE_CATEGORY,
		);
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function get_value( array $options = array() ) {
		$image_data = array(
			'id'  => null,
			'url' => '',
		);

		$settings = $this->get_settings_for_display();
		if ( empty( $settings['key'] ) ) {
			return array();
		}

		list( $field, $value ) = Acf_Dynamic::instance()->get_acf_group_field_value( $this );
		if ( $field && is_array( $field ) ) {
			if ( 'url' === $field['type'] ) {
				$value = array(
					'id'  => 0,
					'url' => $value,
				);
			} else {
				$field['return_format'] = isset( $field['save_format'] ) ? $field['save_format'] : $field['return_format'];
				if ( ! empty( $value ) ) {
					switch ( $field['return_format'] ) {
						case 'object':
						case 'array':
							$value = $value;
							break;
						case 'url':
							$value = array(
								'id'  => 0,
								'url' => $value,
							);
							break;
						case 'id':
							$src   = wp_get_attachment_url( $value );
							$value = array(
								'id'  => $value,
								'url' => $src,
							);
							break;
					}
				}
			}
		}

		if ( ! empty( $value ) && is_array( $value ) ) {
			$image_data['id']  = $value['id'];
			$image_data['url'] = $value['url'];
		}

		if ( empty( $value ) && $settings['fallback'] ) {
			$image_data = array(
				'id'  => $settings['fallback']['id'],
				'url' => $settings['fallback']['url'],
			);
		}

		return $image_data;
	}

	protected function register_controls() {
		Acf_Dynamic::instance()->register_xpro_dynamic_group_controls( $this, $this->get_supported_fields() );
		$this->add_control(
			'fallback',
			array(
				'label' => __( 'Fallback', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);
	}

	public function get_supported_fields() {
		return array(
			'image',
			'file',
			'url',
		);
	}
}
