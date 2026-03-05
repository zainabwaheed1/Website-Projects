<?php
/**
 * Imaged Accordion integration
 */
namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Image_Accordion extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'image_accordion_item';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'description', 'button_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'Image Accordion: Title', 'xpro-elementor-addons-pro' );
			case 'editor':
				return __( 'Image Accordion: Content Editor', 'xpro-elementor-addons-pro' );
			case 'button_text':
				return __( 'Image Accordion: Button', 'xpro-elementor-addons-pro' );
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
			case 'button_text':
				return 'LINE';
			case 'description':
				return 'AREA';
			default:
				return '';
		}
	}
}
