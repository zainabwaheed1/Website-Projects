<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Video_Carousel extends \WPML_Elementor_Module_With_Items {

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
		return array( 'title_text', 'desc_text', 'content_caption' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title_text':
				return __( 'Video Carousel: Title', 'xpro-elementor-addons-pro' );
			case 'desc_text':
				return __( 'Video Carousel: Description', 'xpro-elementor-addons-pro' );
			case 'content_caption':
				return __( 'Video Carousel: Lightbox Caption', 'xpro-elementor-addons-pro' );
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
				return 'LINE';
			case 'desc_text':
				return 'AREA';
			default:
				return '';
		}
	}
}
