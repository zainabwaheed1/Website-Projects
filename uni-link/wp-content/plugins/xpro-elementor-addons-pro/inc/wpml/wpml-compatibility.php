<?php

namespace XproElementorAddonsPro\Inc;

class Xpro_WPML_Compatibility {

	private static $_instance = null;

	private function __construct() {

		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'wpml_pro_widgets' ) );

	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function wpml_pro_widgets( $widgets ) {

		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/advance-accordion.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/advance-gallery.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/advance-portfolio.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/advance-tabs.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/carousel-portfolio.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/image-accordion.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/list-portfolio.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/one-page-navigation.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/post-meta.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/pricing-carousel.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/restaurant-menu.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/street-map.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/team-carousel.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/testimonial-carousel.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/text-marquee.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/textual-showcase.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/vertical-timeline.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/woo-product-filter.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/video-gallery.php';
		include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/widgets/video-carousel.php';

		$widgets_map = array(
			'xpro-advance-accordion'     => array(
				'conditions'        => array( 'widgetType' => 'xpro-advance-accordion' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Advance_Accordion',
			),
			'xpro-advance-gallery'       => array(
				'conditions'        => array( 'widgetType' => 'xpro-advance-gallery' ),
				'fields'            => array(
					array(
						'field'       => 'load_more_text',
						'type'        => __( 'Advanced Gallery: Load More Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_loading_text',
						'type'        => __( 'Advanced Gallery: Loading Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_no_left',
						'type'        => __( 'Advanced Gallery: No More Works', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
				'integration-class' => __NAMESPACE__ . '\\WPML_Advance_Gallery',
			),
			'xpro-advance-heading'       => array(
				'conditions' => array( 'widgetType' => 'xpro-advance-heading' ),
				'fields'     => array(
					array(
						'field'       => 'title_before',
						'type'        => __( 'Advanced Heading: Title Before', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'title_center',
						'type'        => __( 'Advanced Heading: Title Center', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'title_after',
						'type'        => __( 'Advanced Heading: Title After', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'subtitle',
						'type'        => __( 'Advanced Heading: Subtitle', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'separator_text',
						'type'        => __( 'Advanced Heading: Separator Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Advanced Heading: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'shadowText',
						'type'        => __( 'Advanced Heading: Shadow Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
				),
			),
			'xpro-advance-portfolio'     => array(
				'conditions'        => array( 'widgetType' => 'xpro-advance-portfolio' ),
				'fields'            => array(
					array(
						'field'       => 'load_more_text',
						'type'        => __( 'Advanced Portfolio: Load More Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_loading_text',
						'type'        => __( 'Advanced Portfolio: Loading Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_no_left',
						'type'        => __( 'Advanced Portfolio: No More Works', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
				'integration-class' => __NAMESPACE__ . '\\WPML_Advance_Portfolio',
			),
			'xpro-advance-tabs'          => array(
				'conditions'        => array( 'widgetType' => 'xpro-advance-tabs' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Advance_Tabs',
			),
			'xpro-advanced-posts'        => array(
				'conditions' => array( 'widgetType' => 'xpro-advanced-posts' ),
				'fields'     => array(
					array(
						'field'       => 'readmore_text',
						'type'        => __( 'Advanced Posts: Read More Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'author_title',
						'type'        => __( 'Advanced Posts: Author Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_text',
						'type'        => __( 'Advanced Posts: Load More Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_loading_text',
						'type'        => __( 'Advanced Posts: Loading Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_no_left',
						'type'        => __( 'Advanced Posts: No More Works', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'prev_label',
						'type'        => __( 'Advanced Posts: Prev Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'next_label',
						'type'        => __( 'Advanced Posts: Next Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-ajax-live-search'      => array(
				'conditions' => array( 'widgetType' => 'xpro-ajax-live-search' ),
				'fields'     => array(
					array(
						'field'       => 'placeholder',
						'type'        => __( 'Ajax Search: Placeholder', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_text',
						'type'        => __( 'Ajax Search: Button Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-alert-box'             => array(
				'conditions' => array( 'widgetType' => 'xpro-alert-box' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Alert: Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Alert: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-animated-heading'      => array(
				'conditions' => array( 'widgetType' => 'xpro-animated-heading' ),
				'fields'     => array(
					array(
						'field'       => 'title_before',
						'type'        => __( 'Animated Heading: Title Before', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'title_center',
						'type'        => __( 'Animated Heading: Title Center', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'title_after',
						'type'        => __( 'Animated Heading: Title After', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'subtitle',
						'type'        => __( 'Animated Heading: Subtitle', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Advanced Heading: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'separator_text',
						'type'        => __( 'Animated Heading: Separator', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'shadowText',
						'type'        => __( 'Animated Heading: Shadow Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
				),
			),
			'xpro-elementor-breadcrumb'  => array(
				'conditions' => array( 'widgetType' => 'xpro-elementor-breadcrumb' ),
				'fields'     => array(
					array(
						'field'       => 'home',
						'type'        => __( 'Breadcrumbs: Home', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'blog',
						'type'        => __( 'Breadcrumbs: Blog', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'search',
						'type'        => __( 'Breadcrumbs: Search', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'date',
						'type'        => __( 'Breadcrumbs: Date', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'error_404',
						'type'        => __( 'Breadcrumbs: 404', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-carousel-portfolio'    => array(
				'conditions'        => array( 'widgetType' => 'xpro-carousel-portfolio' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Carousel_Portfolio',
			),
			'xpro-cookies'               => array(
				'conditions' => array( 'widgetType' => 'xpro-cookies' ),
				'fields'     => array(
					array(
						'field'       => 'description',
						'type'        => __( 'Cookies: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'anchor_text',
						'type'        => __( 'Cookies: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn',
						'type'        => __( 'Cookies: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-countdown'             => array(
				'conditions' => array( 'widgetType' => 'xpro-countdown' ),
				'fields'     => array(
					array(
						'field'       => 'label_days',
						'type'        => __( 'Countdown: Days', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'label_hours',
						'type'        => __( 'Countdown: Hours', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'label_minutes',
						'type'        => __( 'Countdown: Minutes', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'label_seconds',
						'type'        => __( 'Countdown: Seconds', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-coupon-code'           => array(
				'conditions' => array( 'widgetType' => 'xpro-coupon-code' ),
				'fields'     => array(
					array(
						'field'       => 'coupon_text',
						'type'        => __( 'Coupon: Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-creative-button'       => array(
				'conditions' => array( 'widgetType' => 'xpro-creative-button' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Creative Button: Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-dual-button'           => array(
				'conditions' => array( 'widgetType' => 'xpro-dual-button' ),
				'fields'     => array(
					array(
						'field'       => 'button_primary_text',
						'type'        => __( 'Dual Button:Primary Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_secondary_text',
						'type'        => __( 'Dual Button: Secondary Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-facebook-feed'         => array(
				'conditions' => array( 'widgetType' => 'xpro-facebook-feed' ),
				'fields'     => array(
					array(
						'field'       => 'read_more_text',
						'type'        => __( 'Facebook Feed: Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-flip-box'              => array(
				'conditions' => array( 'widgetType' => 'xpro-flip-box' ),
				'fields'     => array(
					array(
						'field'       => 'front_title',
						'type'        => __( 'Flip Box: Front Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'front_description',
						'type'        => __( 'Flip Box: Front Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'front_badge_text',
						'type'        => __( 'Flip Box: Front Badge', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'back_title',
						'type'        => __( 'Flip Box: Back Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'back_description',
						'type'        => __( 'Flip Box: Back Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'back_btn_text',
						'type'        => __( 'Flip Box: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-hamburger'             => array(
				'conditions' => array( 'widgetType' => 'xpro-hamburger' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Hamburger: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-hover-card'            => array(
				'conditions' => array( 'widgetType' => 'xpro-hover-card' ),
				'fields'     => array(
					array(
						'field'       => 'sub_title',
						'type'        => __( 'Hover Card: Sub Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'title',
						'type'        => __( 'Hover Card: Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Hover Card: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'counter',
						'type'        => __( 'Hover Card: Counter', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_title',
						'type'        => __( 'Hover Card: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-image-accordion'       => array(
				'conditions'        => array( 'widgetType' => 'xpro-image-accordion' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Image_Accordion',
			),
			'xpro-infobox'               => array(
				'conditions' => array( 'widgetType' => 'xpro-infobox' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Info Box: Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'subtitle',
						'type'        => __( 'Info Box: Sub Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'separator_text',
						'type'        => __( 'Info Box: Separator Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Info Box: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'badge_text',
						'type'        => __( 'Info Box: Badge Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_title',
						'type'        => __( 'Info Box: Button Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-instagram-feed'        => array(
				'conditions' => array( 'widgetType' => 'xpro-instagram-feed' ),
				'fields'     => array(
					array(
						'field'       => 'load_more_text',
						'type'        => __( 'Instagram Feed: Load More Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_loading_text',
						'type'        => __( 'Instagram Feed: Loading Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'load_more_no_left',
						'type'        => __( 'Instagram Feed: Load No More', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-lightbox'              => array(
				'conditions' => array( 'widgetType' => 'xpro-lightbox' ),
				'fields'     => array(
					array(
						'field'       => 'toggler_txt_btn',
						'type'        => __( 'Light Box: Toggle Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'toggler_content_caption',
						'type'        => __( 'Light Box: Caption', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-list-portfolio'        => array(
				'conditions'        => array( 'widgetType' => 'xpro-list-portfolio' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_List_Portfolio',
			),
			'xpro-mailchimp'             => array(
				'conditions' => array( 'widgetType' => 'xpro-mailchimp' ),
				'fields'     => array(
					array(
						'field'       => 'email_label',
						'type'        => __( 'Mailchimp: Email Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'email_placeholder',
						'type'        => __( 'Mailchimp: Email Placeholder', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Mailchimp: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'firstname_label',
						'type'        => __( 'Mailchimp: First Name', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'firstname_placeholder',
						'type'        => __( 'Mailchimp: First Name Placeholder', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'lastname_label',
						'type'        => __( 'Mailchimp: Last Name', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'lastname_placeholder',
						'type'        => __( 'Mailchimp: Last Name Placeholder', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'success_message',
						'type'        => __( 'Mailchimp: Success Message', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'error_message',
						'type'        => __( 'Mailchimp: Error Message', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'required_field_message',
						'type'        => __( 'Mailchimp: Require Message', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-mega-menu'             => array(
				'conditions' => array( 'widgetType' => 'xpro-mega-menu' ),
				'fields'     => array(
					array(
						'field'       => 'hamburger_toggle_text',
						'type'        => __( 'Mega Menu: Toggle Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-modal-popup'           => array(
				'conditions' => array( 'widgetType' => 'xpro-modal-popup' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Modal Popup: Toggle Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-one-page-navigation'   => array(
				'conditions'        => array( 'widgetType' => 'xpro-one-page-navigation' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_One_Page_Navigation',
			),
			'xpro-post-carousel'         => array(
				'conditions' => array( 'widgetType' => 'xpro-post-carousel' ),
				'fields'     => array(
					array(
						'field'       => 'readmore_text',
						'type'        => __( 'Post Carousel: Read More', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'author_title',
						'type'        => __( 'Post Carousel: Author Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-post-list'             => array(
				'conditions' => array( 'widgetType' => 'xpro-post-list' ),
				'fields'     => array(
					array(
						'field'       => 'readmore_text',
						'type'        => __( 'Post List: Read More', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'author_title',
						'type'        => __( 'Post List: Author title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'prev_label',
						'type'        => __( 'Post List: Prev Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'next_label',
						'type'        => __( 'Post List: Next Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-post-meta'             => array(
				'conditions'        => array( 'widgetType' => 'xpro-post-meta' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Post_Meta',
			),
			'xpro-post-navigation'       => array(
				'conditions' => array( 'widgetType' => 'xpro-post-navigation' ),
				'fields'     => array(
					array(
						'field'       => 'prev_label',
						'type'        => __( 'Post Navigation: Prev Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'next_label',
						'type'        => __( 'Post Navigation: Next Label', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-post-tiles'            => array(
				'conditions' => array( 'widgetType' => 'xpro-post-tiles' ),
				'fields'     => array(
					array(
						'field'       => 'readmore_text',
						'type'        => __( 'Post Tiles: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-pricing-carousel'      => array(
				'conditions'        => array( 'widgetType' => 'xpro-pricing-carousel' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Pricing_Carousel',
			),
			'xpro-restaurant-menu'       => array(
				'conditions'        => array( 'widgetType' => 'xpro-restaurant-menu' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Restaurant_Menu',
			),
			'xpro-scroll-to-top'         => array(
				'conditions' => array( 'widgetType' => 'xpro-scroll-to-top' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Scroll To Top: Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-source-code'           => array(
				'conditions' => array( 'widgetType' => 'xpro-source-code' ),
				'fields'     => array(
					array(
						'field'       => 'copy_btn_text',
						'type'        => __( 'Source Code: Copy Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'after_copy_btn_text',
						'type'        => __( 'Source Code: Copied Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-street-map'            => array(
				'conditions'        => array( 'widgetType' => 'xpro-street-map' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Street_Map',
			),
			'xpro-team-carousel'         => array(
				'conditions'        => array( 'widgetType' => 'xpro-team-carousel' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Team_Carousel',
			),
			'xpro-testimonial-carousel'  => array(
				'conditions'        => array( 'widgetType' => 'xpro-testimonial-carousel' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Testimonial_Carousel',
			),
			'xpro-text-marquee'          => array(
				'conditions'        => array( 'widgetType' => 'xpro-text-marquee' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Text_Marquee',
			),
			'xpro-textual-showcase'      => array(
				'conditions'        => array( 'widgetType' => 'xpro-textual-showcase' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Textual_Showcase',
			),
			'xpro-unfold'                => array(
				'conditions' => array( 'widgetType' => 'xpro-unfold' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Unfold: Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_unfold_text',
						'type'        => __( 'Unfold: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_fold_text',
						'type'        => __( 'Unfold: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-vertical-timeline'     => array(
				'conditions'        => array( 'widgetType' => 'xpro-vertical-timeline' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Vertical_Timeline',
			),
			'xpro-video-gallery'         => array(
				'conditions'        => array( 'widgetType' => 'xpro-video-gallery' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Video_Gallery',
			),
			'xpro-video-carousel'        => array(
				'conditions'        => array( 'widgetType' => 'xpro-video-carousel' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Video_Carousel',
			),
			'xpro-remote-arrows'         => array(
				'conditions' => array( 'widgetType' => 'xpro-remote-arrows' ),
				'fields'     => array(
					array(
						'field'       => 'next_btn_text',
						'type'        => __( 'Button Text: Next', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'prev_btn_text',
						'type'        => __( 'Button Text: Prev', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-woo-category'          => array(
				'conditions' => array( 'widgetType' => 'xpro-woo-category' ),
				'fields'     => array(
					array(
						'field'       => 'btn_txt',
						'type'        => __( 'Woo Category: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-woo-category-carousel' => array(
				'conditions' => array( 'widgetType' => 'xpro-woo-category-carousel' ),
				'fields'     => array(
					array(
						'field'       => 'btn_txt',
						'type'        => __( 'Woo Category Carousel: Button', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-woo-mini-cart'         => array(
				'conditions' => array( 'widgetType' => 'xpro-woo-mini-cart' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Woo Mini Cart: Toggle', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
			'xpro-woo-product-filters'   => array(
				'conditions'        => array( 'widgetType' => 'xpro-woo-product-filters' ),
				'fields'            => array(),
				'integration-class' => __NAMESPACE__ . '\\WPML_Woo_Product_Filter',
			),
			'xpro-woo-user-profile'      => array(
				'conditions' => array( 'widgetType' => 'xpro-woo-user-profile' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Woo User Profile: Text', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'custom',
						'type'        => __( 'Woo User Profile: Custom', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'title',
						'type'        => __( 'Woo User Profile: Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Woo User Profile: Description', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'AREA',
					),
				),
			),
			'xpro-flip-book-3d'          => array(
				'conditions' => array( 'widgetType' => 'xpro-flip-book-3d' ),
				'fields'     => array(
					array(
						'field'       => 'btn_text',
						'type'        => __( '3d Flip Book: Title', 'xpro-elementor-addons-pro' ),
						'editor_type' => 'LINE',
					),
				),
			),
		);

		foreach ( $widgets_map as $key => $data ) {

			$widget_name = $key;

			$entry = array(
				'conditions' => array(
					'widgetType' => $widget_name,
				),
				'fields'     => isset( $data['fields'] ) ? $data['fields'] : array(),
			);

			if ( isset( $data['integration-class'] ) ) {
				$entry['integration-class'] = $data['integration-class'];
			}

			$widgets[ $widget_name ] = $entry;
		}

		return $widgets;
	}

}

Xpro_WPML_Compatibility::instance();
