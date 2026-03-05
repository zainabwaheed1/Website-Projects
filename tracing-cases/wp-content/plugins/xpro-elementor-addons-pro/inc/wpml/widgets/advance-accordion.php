<?php
/**
 * Advanced Accordion integration
 */
namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Advance_Accordion extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'accordion_items';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'editor' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'Advanced Accordion: Title', 'xpro-elementor-addons-pro' );
			case 'editor':
				return __( 'Advanced Accordion: Content Editor', 'xpro-elementor-addons-pro' );
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
				return 'LINE';
			case 'editor':
				return 'VISUAL';
			default:
				return '';
		}
	}
}
