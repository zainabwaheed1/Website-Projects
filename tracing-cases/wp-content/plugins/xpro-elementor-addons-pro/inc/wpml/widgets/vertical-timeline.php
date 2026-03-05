<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Vertical_Timeline extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'vertical_timeline_item';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'date_custom', 'sub_title', 'description', 'custom' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'Vertical Timeline: Title', 'xpro-elementor-addons-pro' );
			case 'date_custom':
				return __( 'Vertical Timeline: Date', 'xpro-elementor-addons-pro' );
			case 'sub_title':
				return __( 'Vertical Timeline: Sub Title', 'xpro-elementor-addons-pro' );
			case 'description':
				return __( 'Vertical Timeline: Description', 'xpro-elementor-addons-pro' );
			case 'custom':
				return __( 'Vertical Timeline: Custom', 'xpro-elementor-addons-pro' );
			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
			case 'date_custom':
			case 'sub_title':
			case 'custom':
				return 'LINE';
			case 'description':
				return 'AREA';
			default:
				return '';
		}
	}
}
