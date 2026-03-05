<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Url extends Data_Tag {

	public function get_name() {
		return 'xpro-acf-url';
	}

	public function get_title() {
		return __( 'ACF URL', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic';
	}

	public function get_categories() {
		return array(
			Module::URL_CATEGORY,
		);
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function get_value( array $options = array() ) {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['key'] ) ) {
			return false;
		}
		list( $field, $meta_key, $value ) = Acf_Dynamic::instance()->get_acf_field_value( $this );

		if ( $field ) {
			if ( is_array( $value ) && isset( $value[0] ) ) {
				$value = $value[0];
			}

			if ( $value ) {
				if ( ! isset( $field['return_format'] ) ) {
					$field['return_format'] = isset( $field['save_format'] ) ? $field['save_format'] : '';
				}

				switch ( $field['type'] ) {
					case 'email':
						if ( $value ) {
							$value = 'mailto:' . $value;
						}
						break;
					case 'image':
					case 'file':
						switch ( $field['return_format'] ) {
							case 'array':
							case 'object':
								$value = $value['url'];
								break;
							case 'id':
								if ( 'image' === $field['type'] ) {
									$src   = wp_get_attachment_image_src( $value, 'full' );
									$value = $src[0];
								} else {
									$value = wp_get_attachment_url( $value );
								}
								break;
						}
						break;
					case 'post_object':
					case 'relationship':
						$value = get_permalink( $value );
						break;
					case 'taxonomy':
						$value = get_term_link( $value, $field['taxonomy'] );
						break;
					case 'link':
						if ( is_array( $value ) ) {
							$value = $value['url'];
						} else {
							$value;
						}
				}
			}
		} else {
			// Field settings has been deleted or not available.
			$value = get_field( $meta_key );
		}

		if ( empty( $value ) && $this->get_settings( 'fallback' ) ) {
			$value = $this->get_settings( 'fallback' );
		}

		return wp_kses_post( $value );
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
				'label'   => __( 'Fallback', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
			)
		);
	}

	protected function get_supported_fields() {
		return array(
			'url',
			'image',
			'file',
			'text',
			'email',
			'relationship',
			'link',
			'page_link',
			'post_object',
			'taxonomy',

		);
	}
}
