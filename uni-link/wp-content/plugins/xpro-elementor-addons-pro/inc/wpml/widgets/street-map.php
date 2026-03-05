<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Street_Map extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'markers';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'marker_title', 'marker_content' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'marker_title':
				return __( 'Street Map: Title', 'xpro-elementor-addons-pro' );
			case 'marker_content':
				return __( 'Street Map: Content', 'xpro-elementor-addons-pro' );
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
			case 'marker_title':
				return 'LINE';
			case 'marker_content':
				return 'AREA';
			default:
				return '';
		}
	}
}
