<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || exit;

class Xpro_Elementor_Widget_Pro_List {


	/**
	 * Instance
	 *
	 * @since 0.1.8
	 * @access private
	 * @static
	 *
	 * @var Xpro_Elementor_Widget_Pro_List The single instance of the class.
	 */

	private static $instance = null;

	private static $list = array(
		'advance-gallery'       => array(
			'slug'    => 'advance_gallery',
			'title'   => 'Advanced Gallery',
			'package' => 'pro',
		),
		'carousel-gallery'      => array(
			'slug'    => 'carousel_gallery',
			'title'   => 'Carousel Gallery',
			'package' => 'pro',
		),
		'advance-portfolio'     => array(
			'slug'    => 'advance_portfolio',
			'title'   => 'Advanced Portfolio',
			'package' => 'pro',
		),
		'carousel-portfolio'    => array(
			'slug'    => 'carousel_portfolio',
			'title'   => 'Carousel Portfolio',
			'package' => 'pro',
		),
		'advanced-posts'        => array(
			'slug'    => 'advanced_posts',
			'title'   => 'Advanced Posts',
			'package' => 'pro',
		),
		'list-portfolio'        => array(
			'slug'    => 'list_portfolio',
			'title'   => 'List Portfolio',
			'package' => 'pro',
		),
		'advance-heading'       => array(
			'slug'    => 'advance_heading',
			'title'   => 'Advanced Heading',
			'package' => 'pro',
		),
		'animated-heading'      => array(
			'slug'    => 'animated_heading',
			'title'   => 'Animated Headline',
			'package' => 'pro',
		),
		'image-masking'         => array(
			'slug'    => 'image_masking',
			'title'   => 'Image Masking',
			'package' => 'pro',
		),
		'advance-tabs'          => array(
			'slug'    => 'advance_tabs',
			'title'   => 'Advanced Tabs',
			'package' => 'pro',
		),
		'advance-accordion'     => array(
			'slug'    => 'advance_accordion',
			'title'   => 'Advanced Accordion',
			'package' => 'pro',
		),
		'pricing-carousel'      => array(
			'slug'    => 'pricing_carousel',
			'title'   => 'Pricing Carousel',
			'package' => 'pro',
		),
		'pricing-matrix'        => array(
			'slug'    => 'pricing_matrix',
			'title'   => 'Pricing Matrix',
			'package' => 'pro',
		),
		'info-box'              => array(
			'slug'    => 'info_box',
			'title'   => 'Info Box',
			'package' => 'pro',
		),
		'dual-button'           => array(
			'slug'    => 'dual_button',
			'title'   => 'Dual Button',
			'package' => 'pro',
		),
		'vertical-menu'         => array(
			'slug'    => 'vertical_menu',
			'title'   => 'Vertical Menu',
			'package' => 'pro',
		),
		'hamburger'             => array(
			'slug'    => 'hamburger',
			'title'   => 'Hamburger',
			'package' => 'pro',
		),
		'product-view-360'      => array(
			'slug'    => 'product_view_360',
			'title'   => '360° Product View',
			'package' => 'pro',
		),
		'slider'                => array(
			'slug'    => 'slider',
			'title'   => 'Multi Layer Slider',
			'package' => 'pro',
		),
		'team-carousel'         => array(
			'slug'    => 'team_carousel',
			'title'   => 'Team Carousel',
			'package' => 'pro',
		),
		'testimonial-carousel'  => array(
			'slug'    => 'testimonial_carousel',
			'title'   => 'Testimonial Carousel',
			'package' => 'pro',
		),
		'logo-carousel'         => array(
			'slug'    => 'logo_carousel',
			'title'   => 'Logo Carousel',
			'package' => 'pro',
		),
		'hover-card'            => array(
			'slug'    => 'hover_card',
			'title'   => 'Hover Card',
			'package' => 'pro',
		),
		'countdown'             => array(
			'slug'    => 'countdown',
			'title'   => 'Countdown',
			'package' => 'pro',
		),
		'flip-box'              => array(
			'slug'    => 'flip_box',
			'title'   => 'Flip Box',
			'package' => 'pro',
		),
		'post-meta'             => array(
			'slug'    => 'post_meta',
			'title'   => 'Post Meta',
			'package' => 'pro',
		),
		'post-comments'         => array(
			'slug'    => 'post_comments',
			'title'   => 'Post Comments',
			'package' => 'pro',
		),
		'post-navigation'       => array(
			'slug'    => 'post_navigation',
			'title'   => 'Post Navigation',
			'package' => 'pro',
		),
		'post-carousel'         => array(
			'slug'    => 'post_carousel',
			'title'   => 'Post Carousel',
			'package' => 'pro',
		),
		'post-list'             => array(
			'slug'    => 'post_list',
			'title'   => 'Post List',
			'package' => 'pro',
		),
		'post-tiles'            => array(
			'slug'    => 'post_tiles',
			'title'   => 'Post Tiles',
			'package' => 'pro',
		),
		'draw-svg'              => array(
			'slug'    => 'draw_svg',
			'title'   => 'Draw SVG',
			'package' => 'pro',
		),
		'modal-popup'           => array(
			'slug'    => 'modal_popup',
			'title'   => 'Modal Popup',
			'package' => 'pro',
		),
		'breadcrumb'            => array(
			'slug'    => 'breadcrumb',
			'title'   => 'Breadcrumb',
			'package' => 'pro',
		),
		'restaurant-menu'       => array(
			'slug'    => 'restaurant_menu',
			'title'   => 'Restaurant Menu',
			'package' => 'pro',
		),
		'image-accordion'       => array(
			'slug'    => 'image_accordion',
			'title'   => 'Image Accordion',
			'package' => 'pro',
		),
		'device-slider'         => array(
			'slug'    => 'device_slider',
			'title'   => 'Device Slider',
			'package' => 'pro',
		),
		'google-map'            => array(
			'slug'    => 'google_map',
			'title'   => 'Google Map',
			'package' => 'pro',
		),
		'street-map'            => array(
			'slug'    => 'street_map',
			'title'   => 'Street Map',
			'package' => 'pro',
		),
		'calendly'              => array(
			'slug'    => 'calendly',
			'title'   => 'Calendly',
			'package' => 'pro',
		),
		'vertical-timeline'     => array(
			'slug'    => 'vertical_timeline',
			'title'   => 'Vertical Timeline',
			'package' => 'pro',
		),
		'creative-button'       => array(
			'slug'    => 'creative_button',
			'title'   => 'Creative Button',
			'package' => 'pro',
		),
		'slide-anything'        => array(
			'slug'    => 'slide_anything',
			'title'   => 'Slide Anything',
			'package' => 'pro',
		),
		'unfold'                => array(
			'slug'    => 'unfold',
			'title'   => 'Unfold',
			'package' => 'pro',
		),
		'scroll-to-top'         => array(
			'slug'    => 'scroll_to_top',
			'title'   => 'Scroll To Top',
			'package' => 'pro',
		),
		'cookies'               => array(
			'slug'    => 'cookies',
			'title'   => 'Cookies',
			'package' => 'pro',
		),
		'alert-box'             => array(
			'slug'    => 'alert_box',
			'title'   => 'Alert Box',
			'package' => 'pro',
		),
		'woo-product-meta'      => array(
			'slug'    => 'xpro_elementor_woo_product_meta',
			'title'   => 'Product Meta',
			'package' => 'pro',
		),
		'woo-product-tabs'      => array(
			'slug'    => 'xpro_elementor_woo_product_tabs',
			'title'   => 'Product Tabs',
			'package' => 'pro',
		),
		'woo-cart'              => array(
			'slug'    => 'xpro_elementor_woo_cart',
			'title'   => 'Woo Cart',
			'package' => 'pro',
		),
		'preloader'             => array(
			'slug'    => 'preloader',
			'title'   => 'Preloader',
			'package' => 'pro',
		),
		'video'                 => array(
			'slug'    => 'video',
			'title'   => 'Video',
			'package' => 'pro',
		),
		'lightbox'              => array(
			'slug'    => 'lightbox',
			'title'   => 'Lightbox',
			'package' => 'pro',
		),
		'woo-product-carousel'  => array(
			'slug'    => 'xpro_elementor_woo_product_carousel',
			'title'   => 'Woo Products Carousel',
			'package' => 'pro',
		),
		'ajax-live-search'      => array(
			'slug'    => 'xpro_elementor_ajax_live_search',
			'title'   => 'Ajax Live Search',
			'package' => 'pro',
		),
		'one-page-navigation'   => array(
			'slug'    => 'one_page_navigation',
			'title'   => 'One Page Navigation',
			'package' => 'pro',
		),
		'source-code'           => array(
			'slug'    => 'source_code',
			'title'   => 'Source Code',
			'package' => 'pro',
		),
		'image-magnify'         => array(
			'slug'    => 'image_magnify',
			'title'   => 'Image Magnify',
			'package' => 'pro',
		),
		'instagram-feed'        => array(
			'slug'    => 'instagram_feed',
			'title'   => 'Instagram Feed',
			'package' => 'pro',
		),
		'facebook-feed'         => array(
			'slug'    => 'facebook_feed',
			'title'   => 'Facebook Feed',
			'package' => 'pro',
		),
		'woo-category'          => array(
			'slug'    => 'woo_category',
			'title'   => 'Woo Category Grid',
			'package' => 'pro',
		),
		'woo-category-carousel' => array(
			'slug'    => 'woo_category_carousel',
			'title'   => 'Woo Category Carousel',
			'package' => 'pro',
		),
		'woo-mini-cart'         => array(
			'slug'    => 'woo_mini_cart',
			'title'   => 'Woo Mini Cart',
			'package' => 'pro',
		),
		'woo-user-profile'      => array(
			'slug'    => 'woo_user_profile',
			'title'   => 'Woo User Profile',
			'package' => 'pro',
		),
		'woo-my-account'        => array(
			'slug'    => 'woo_my_account',
			'title'   => 'Woo My Account',
			'package' => 'pro',
		),
		'woo-product-filters'   => array(
			'slug'    => 'woo_product_filters',
			'title'   => 'Woo Products Filter',
			'package' => 'pro',
		),
		'woo-checkout'          => array(
			'slug'    => 'woo_checkout',
			'title'   => 'Woo Checkout',
			'package' => 'pro',
		),
		'woo-notices'           => array(
			'slug'    => 'woo_notices',
			'title'   => 'Woo Notices',
			'package' => 'pro',
		),
		'split-slider'          => array(
			'slug'    => 'split_slider',
			'title'   => 'Split Slider',
			'package' => 'pro',
		),
		'text-marquee'          => array(
			'slug'    => 'text_marquee',
			'title'   => 'Text Marquee',
			'package' => 'pro',
		),
		'image-marquee'         => array(
			'slug'    => 'image_marquee',
			'title'   => 'Image Marquee',
			'package' => 'pro',
		),
		'textual-showcase'      => array(
			'slug'    => 'textual_showcase',
			'title'   => 'Textual Showcase',
			'package' => 'pro',
		),
		'audio-player'          => array(
			'slug'    => 'audio_player',
			'title'   => 'Audio Player',
			'package' => 'pro',
		),
		'coupon-code'           => array(
			'slug'    => 'coupon_code',
			'title'   => 'Coupon Code',
			'package' => 'pro',
		),
		'loop-builder'          => array(
			'slug'    => 'loop_builder',
			'title'   => 'Loop Builder',
			'package' => 'pro',
		),
		'video-gallery'         => array(
			'slug'    => 'video_gallery',
			'title'   => 'Video Gallery',
			'package' => 'pro',
		),
		'mailchimp'             => array(
			'slug'    => 'mailchimp',
			'title'   => 'MailChimp',
			'package' => 'pro',
		),
		'loop-carousel'         => array(
			'slug'    => 'loop_carousel',
			'title'   => 'Loop Carousel',
			'package' => 'pro',
		),
		'remote-arrows'         => array(
			'slug'    => 'remote_arrows',
			'title'   => 'Remote Arrows',
			'package' => 'pro',
		),
		'video-carousel'        => array(
			'slug'    => 'video_carousel',
			'title'   => 'Video Carousel',
			'package' => 'pro',
		),
		'flip-book-3d'          => array(
			'slug'    => 'flip_book_3d',
			'title'   => '3D Flip book',
			'package' => 'pro',
		),
	);

	/**
	 * Constructor
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function __construct() {
	}

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Xpro_Elementor_Widget_Pro_List An instance of the class.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_list() {
		$all_list = self::$list;

		return $all_list;
	}
}
