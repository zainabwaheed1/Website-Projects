<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Woo_Filter_Filter extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'product_filter_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'filter_title' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'filter_title':
				return __( 'Woo Product Filter: Title', 'xpro-elementor-addons-pro' );
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
			case 'filter_title':
				return 'LINE';
			default:
				return '';
		}
	}
}
