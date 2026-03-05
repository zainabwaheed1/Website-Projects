<?php

namespace XproElementorAddonsPro\Inc;

defined( 'ABSPATH' ) || exit;

class Xpro_Elementor_Module_Pro_List {


	/**
	 * Instance
	 *
	 * @since 0.1.8
	 * @access private
	 * @static
	 *
	 * @var Xpro_Elementor_Module_Pro_List The single instance of the class.
	 */

	private static $instance = null;

	private static $list = array(
		'mega-menu'            => array(
			'slug'    => 'mega_menu',
			'title'   => 'Mega Menu',
			'package' => 'pro',
		),
		'scroll-effect'        => array(
			'slug'    => 'scroll_effect',
			'title'   => 'Scroll Effect',
			'package' => 'pro',
		),
		'3d-tilt-parallax'     => array(
			'slug'    => '3d_tilt_parallax',
			'title'   => '3D Tilt Parallax',
			'package' => 'pro',
		),
		'mouse-effect'         => array(
			'slug'    => 'mouse_effect',
			'title'   => 'Mouse Effect',
			'package' => 'pro',
		),
		'background-parallax'  => array(
			'slug'    => 'background-parallax',
			'title'   => 'Background Parallax',
			'package' => 'pro',
		),
		'live-copy'            => array(
			'slug'    => 'live_copy',
			'title'   => 'Cross Domain Copy/Paste',
			'package' => 'pro',
		),
		'display-conditions'   => array(
			'slug'    => 'display_conditions',
			'title'   => 'Display Conditions',
			'package' => 'pro',
		),
		'background-particles' => array(
			'slug'    => 'background-particles',
			'title'   => 'Background Particles',
			'package' => 'pro',
		),
		'dynamic-tags'         => array(
			'slug'    => 'dynamic-tags',
			'title'   => 'Global Dynamic Tags',
			'package' => 'pro',
		),
		'acf-dynamic'          => array(
			'slug'    => 'acf_dynamic',
			'title'   => 'ACF Dynamic Tags',
			'package' => 'pro',
		),
		'post-dynamic'         => array(
			'slug'    => 'post_dynamic',
			'title'   => 'Post Dynamic Tags',
			'package' => 'pro',
		),
		'woo-dynamic'          => array(
			'slug'    => 'woo_dynamic',
			'title'   => 'Woo Dynamic Tags',
			'package' => 'pro',
		),
		'custom-js'            => array(
			'slug'    => 'custom_js',
			'title'   => 'Custom JS',
			'package' => 'pro',
		),
		'smoke-effect'         => array(
			'slug'    => 'smoke_effect',
			'title'   => 'Smoke Effect',
			'package' => 'pro',
		),
		'animated-gradient'    => array(
			'slug'    => 'animated_gradient',
			'title'   => 'Animated Gradient',
			'package' => 'pro',
		),
	);

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Xpro_Elementor_Module_Pro_List An instance of the class.
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

	/**
	 * Usage:
	 * get full list >> get_list() []
	 *
	 */
	public function get_list() {
		$all_list = self::$list;

		return $all_list;
	}
}
