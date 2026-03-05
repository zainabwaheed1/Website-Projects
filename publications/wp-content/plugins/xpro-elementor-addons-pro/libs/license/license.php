<?php

namespace XproElementorAddonsPro\Libs;

use Xpro_Elementor_Addons;

/**
 * Class Xpro_Elementor_License
 *
 * Main Xpro_Elementor_License class
 * @since 0.1.8
 */
class Xpro_Elementor_License {

	public static $license_activate = 'invalid';
	/**
	 * Instance
	 *
	 * @since 0.1.8
	 * @access private
	 * @static
	 *
	 * @var Xpro_Elementor_License The single instance of the class.
	 */
	private static $instance = null;
	public $utils;

	/**
	 *  Xpro_Elementor_License class constructor
	 *
	 * Register Xpro_Elementor_License action hooks and filters
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_settings_submenus' ), 99 );
		add_action( 'admin_init', array( $this, 'license_check' ) );
		add_action( 'wp_ajax_xpro_elementor_license_data', array( $this, 'ajax_license_action' ) );

		self::$license_activate = get_option( 'xpro_elementor_license_status', 'invalid' );

	}

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Xpro_Elementor_License An instance of the class.
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

	public function register_settings_submenus() {

		add_submenu_page(
			Xpro_Elementor_Addons::PAGE_SLUG,
			esc_html__( 'License', 'xpro-elementor-addons-pro' ),
			esc_html__( 'License', 'xpro-elementor-addons-pro' ),
			'manage_options',
			Xpro_Elementor_Addons::LICENSE_PAGE_SLUG,
			array( $this, 'register_settings_contents_license' ),
			1
		);

	}

	public function register_settings_contents_license() {
		include __DIR__ . '/views/settings-license.php';
	}

	public function license_check() {

		$id      = '6632';
		$action  = 'check_license ';
		$license = get_option( 'xpro_elementor_license_data' );

		if ( ! $license ) {
			return false;
		}

		$request = wp_remote_post( 'https://www.wpxpro.com/?edd_action=' . $action . '&item_id=' . $id . '&license=' . $license . '&url=' . get_home_url() );

		if ( is_wp_error( $request ) ) {
			return false;
		}

		$body = wp_remote_retrieve_body( $request );

		$data = json_decode( $body );

		$ajaxresult['status'] = isset($data->license) ? $data->license : '';

		if ( isset( $data->license ) && 'disabled' === $data->license ) {
			update_option( 'xpro_elementor_license_status', 'invalid' );
			update_option( 'xpro_elementor_license_expires', '' );
		}

		return false;

	}

	public function ajax_license_action() {

		check_ajax_referer( 'xpro_elementor_license_nonce', 'nonce' );

		$id      = ( $_POST['id'] ) ? sanitize_text_field( $_POST['id'] ) : '';
		$action  = ( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : '';
		$license = ( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : '';

		$request = wp_remote_post( 'https://www.wpxpro.com/?edd_action=' . $action . '&item_id=' . $id . '&license=' . $license . '&url=' . get_home_url() );

		if ( is_wp_error( $request ) ) {
			return false;
		}

		$body = wp_remote_retrieve_body( $request );

		$data = json_decode( $body );

		if (  isset( $data->license ) && 'valid' === $data->license ) {
			update_option( 'xpro_elementor_license_status', 'valid' );
			update_option( 'xpro_elementor_license_data', $license );
			update_option( 'xpro_elementor_license_expires', $data->expires );
		} else {
			update_option( 'xpro_elementor_license_status', 'invalid' );
			update_option( 'xpro_elementor_license_data', '' );
			update_option( 'xpro_elementor_license_expires', '' );
		}

		wp_send_json( $data );

		return false;

	}

}

// Instantiate Xpro_Elementor_License Class
Xpro_Elementor_License::instance();
