<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Advance_Portfolio extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'gallery';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'filter', 'title_text', 'desc_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'filter':
				return __( 'Advanced Portfolio: Filter', 'xpro-elementor-addons-pro' );
			case 'title_text':
				return __( 'Advanced Portfolio: Title', 'xpro-elementor-addons-pro' );
			case 'desc_text':
				return __( 'Advanced Portfolio: Description', 'xpro-elementor-addons-pro' );
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
			case 'title_text':
			case 'filter':
				return 'LINE';
			case 'desc_text':
				return 'AREA';
			default:
				return '';
		}
	}
}
