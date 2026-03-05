<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Video_Gallery extends \WPML_Elementor_Module_With_Items {

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
		return array( 'filter', 'title_text', 'desc_text', 'content_caption' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'filter':
				return __( 'Video Gallery: Filter', 'xpro-elementor-addons-pro' );
			case 'title_text':
				return __( 'Video Gallery: Title', 'xpro-elementor-addons-pro' );
			case 'desc_text':
				return __( 'Video Gallery: Description', 'xpro-elementor-addons-pro' );
			case 'content_caption':
				return __( 'Video Gallery: Content Caption', 'xpro-elementor-addons-pro' );
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
			case 'content_caption':
			case 'filter':
				return 'LINE';
			case 'desc_text':
				return 'AREA';
			default:
				return '';
		}
	}
}
