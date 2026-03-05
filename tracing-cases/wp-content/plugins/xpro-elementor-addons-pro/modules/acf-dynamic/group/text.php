<?php

namespace XproElementorAddonsPro\Module\Acf_Dynamic\Group;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use XproElementorAddonsPro\Module\Acf_Dynamic;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Text extends Tag {
	public function get_name() {
		return 'xpro-acf-group-text';
	}

	public function get_title() {
		return __( 'ACF Group Text', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic';
	}

	public function get_categories(): array {
		return array(
			Module::TEXT_CATEGORY,
			Module::POST_META_CATEGORY,
			Module::NUMBER_CATEGORY,
		);
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function render() {
		$settings = $this->get_settings();
		if ( empty( $settings ) ) {
			return;
		}
		$value                 = '';
		list( $field, $value ) = Acf_Dynamic::instance()->get_acf_group_field_value( $this );

		if ( $field && ! empty( $field['type'] ) ) {

			switch ( $field['type'] ) {
				case 'radio':
				case 'checkbox':
				case 'select':
					$selected_value = array();
					if ( 'yes' === $settings['show_label'] ) {
						foreach ( $value as $item ) {
							$selected_value[] = $item;
						}
					} else {
						foreach ( $value as $key => $item ) {
							$selected_value[] = $key;
						}
					}
					if ( is_array( $selected_value ) ) {
						$value = implode( $settings['separator'], $selected_value );
					} else {
						$value = $selected_value;
					}
					break;
				case 'oembed':
					$value = $value;
					// Get from db without formatting.
					break;
				case 'google_map':
					$value = $value['address'];
			}
		} else {
			// Field settings has been deleted or not available.
			$value = $value;
		}

		if ( $settings['show_label'] && $field['label'] ) {
			$value = $field['label'] . ': ' . $value;
		}

		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		Acf_Dynamic::instance()->register_xpro_dynamic_group_controls( $this, $this->get_supported_fields() );
		$this->add_control(
			'show_label',
			array(
				'label'        => __( 'Show Label', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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

	public function get_supported_fields() {
		return array(
			'text',
			'url',
			'textarea',
			'number',
			'email',
			'password',
			'wysiwyg',
			'select',
			'checkbox',
			'radio',
			'true_false',
			'oembed',
			'google_map',
			'date_picker',
			'time_picker',
			'date_time_picker',
			'color_picker',
		);
	}
}
