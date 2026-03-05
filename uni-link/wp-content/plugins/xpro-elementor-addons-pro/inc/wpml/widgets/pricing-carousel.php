<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || die();

class WPML_Pricing_Carousel extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'items';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'price', 'period', 'item_description', 'button_title', 'badge_text', 'list_item_1_text', 'list_item_1_tooltip_text', 'list_item_2_text', 'list_item_2_tooltip_text', 'list_item_3_text', 'list_item_3_tooltip_text', 'list_item_3_text', 'list_item_3_tooltip_text', 'list_item_4_text', 'list_item_4_tooltip_text', 'list_item_5_text', 'list_item_5_tooltip_text', 'list_item_6_text', 'list_item_6_tooltip_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'Pricing Carousel: Title', 'xpro-elementor-addons-pro' );
			case 'price':
				return __( 'Pricing Carousel: Price', 'xpro-elementor-addons-pro' );
			case 'period':
				return __( 'Pricing Carousel: Period', 'xpro-elementor-addons-pro' );
			case 'item_description':
				return __( 'Pricing Carousel: Description', 'xpro-elementor-addons-pro' );
			case 'button_title':
				return __( 'Pricing Carousel: Button', 'xpro-elementor-addons-pro' );
			case 'badge_text':
				return __( 'Pricing Carousel: Badge', 'xpro-elementor-addons-pro' );
			case 'list_item_1_text':
				return __( 'Pricing Carousel: List Item 1', 'xpro-elementor-addons-pro' );
			case 'list_item_1_tooltip_text':
				return __( 'Pricing Carousel: List Item 1 Tooltip Text', 'xpro-elementor-addons-pro' );
			case 'list_item_2_text':
				return __( 'Pricing Carousel: List Item 2', 'xpro-elementor-addons-pro' );
			case 'list_item_2_tooltip_text':
				return __( 'Pricing Carousel: List Item 2 Tooltip Text', 'xpro-elementor-addons-pro' );
			case 'list_item_3_text':
				return __( 'Pricing Carousel: List Item 3', 'xpro-elementor-addons-pro' );
			case 'list_item_3_tooltip_text':
				return __( 'Pricing Carousel: List Item 3 Tooltip Text', 'xpro-elementor-addons-pro' );
			case 'list_item_4_text':
				return __( 'Pricing Carousel: List Item 4', 'xpro-elementor-addons-pro' );
			case 'list_item_4_tooltip_text':
				return __( 'Pricing Carousel: List Item 4 Tooltip Text', 'xpro-elementor-addons-pro' );
			case 'list_item_5_text':
				return __( 'Pricing Carousel: List Item 5', 'xpro-elementor-addons-pro' );
			case 'list_item_5_tooltip_text':
				return __( 'Pricing Carousel: List Item 5 Tooltip Text', 'xpro-elementor-addons-pro' );
			case 'list_item_6_text':
				return __( 'Pricing Carousel: List Item 6', 'xpro-elementor-addons-pro' );
			case 'list_item_6_tooltip_text':
				return __( 'Pricing Carousel: List Item 6 Tooltip Text', 'xpro-elementor-addons-pro' );
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
			case 'price':
			case 'period':
			case 'button_title':
			case 'badge_text':
			case 'list_item_1_text':
			case 'list_item_1_tooltip_text':
			case 'list_item_2_text':
			case 'list_item_2_tooltip_text':
			case 'list_item_3_text':
			case 'list_item_3_tooltip_text':
			case 'list_item_4_text':
			case 'list_item_4_tooltip_text':
			case 'list_item_6_text':
			case 'list_item_6_tooltip_text':
				return 'LINE';
			case 'item_description':
				return 'AREA';
			default:
				return '';
		}
	}
}
