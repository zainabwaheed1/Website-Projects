<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Restaurant_Menu extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'menu_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'custom', 'price', 'description', 'rest_btn' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'Restaurant Menu: Title', 'xpro-elementor-addons-pro' );
			case 'custom':
				return __( 'Restaurant Menu: Custom', 'xpro-elementor-addons-pro' );
			case 'price':
				return __( 'Restaurant Menu: Price', 'xpro-elementor-addons-pro' );
			case 'description':
				return __( 'Restaurant Menu: Description', 'xpro-elementor-addons-pro' );
			case 'rest_btn':
				return __( 'Restaurant Menu: Button', 'xpro-elementor-addons-pro' );
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
			case 'custom':
			case 'price':
			case 'rest_btn':
				return 'LINE';
			case 'description':
				return 'AREA';
			default:
				return '';
		}
	}
}
