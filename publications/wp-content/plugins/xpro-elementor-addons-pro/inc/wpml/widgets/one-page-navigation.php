<?php
/**
 * One Page Navigation integration
 */
namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_One_Page_Navigation extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'one_page_nav_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'tooltip_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'tooltip_text':
				return __( 'One Page Navigation: Tooltip Text', 'xpro-elementor-addons-pro' );
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
			case 'tooltip_text':
				return 'LINE';
			default:
				return '';
		}
	}
}
