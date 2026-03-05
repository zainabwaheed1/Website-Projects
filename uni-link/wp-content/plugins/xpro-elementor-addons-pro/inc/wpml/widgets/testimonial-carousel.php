<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Testimonial_Carousel extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'item';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'name', 'designation', 'description' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'name':
				return __( 'Testimonial: Name', 'xpro-elementor-addons-pro' );
			case 'designation':
				return __( 'Testimonial: Designation', 'xpro-elementor-addons-pro' );
			case 'description':
				return __( 'Testimonial: Description', 'xpro-elementor-addons-pro' );
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
			case 'name':
			case 'designation':
				return 'LINE';
			case 'description':
				return 'AREA';
			default:
				return '';
		}
	}
}
