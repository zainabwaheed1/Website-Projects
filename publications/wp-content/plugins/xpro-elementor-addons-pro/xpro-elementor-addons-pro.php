<?php
/**
 * Plugin Name: Xpro Elementor Addons - Pro
 * Description: Xpro Elementor Addons - Pro is the Most Advanced 130+ Widgets Pack for Elementor. Create highly attractive websites with Powerful Widgets, Premium Extensions & more.
 * Plugin URI:  https://elementor.wpxpro.com/
 * Author:      Xpro
 * Author URI:  https://www.wpxpro.com/
 * Version:     1.4.6.3
 * Developer:  Xpro Team
 * Text Domain: xpro-elementor-addons-pro
 * Elementor tested up to: 3.27.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

define( 'XPRO_ELEMENTOR_ADDONS_PRO_VERSION', '1.4.6.3' );
// define( 'INNER_ELEMENTOR_WIDGET_CONTAINER_PRO', false );
define( 'XPRO_ELEMENTOR_ADDONS_PRO__FILE__', __FILE__ );
define( 'XPRO_ELEMENTOR_ADDONS_PRO_BASE', plugin_basename( __FILE__ ) );
define( 'XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH', plugin_dir_path( XPRO_ELEMENTOR_ADDONS_PRO__FILE__ ) );
define( 'XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL', plugin_dir_url( XPRO_ELEMENTOR_ADDONS_PRO__FILE__ ) );
define( 'XPRO_ELEMENTOR_ADDONS_PRO_ASSETS', trailingslashit( XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'assets' ) );
define( 'XPRO_ELEMENTOR_ADDONS_PRO_WIDGET', trailingslashit( XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'widgets' ) );

/**
 * Main Xpro Elementor Addons Class
 *
 * The init class that runs the Xpro ELementor Addons plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 */
final class XPRO_ELEMENTOR_ADDONS_PRO {

	/**
	 * Constructor
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		//Fires when Xpro Elementor Pro Addons was fully loaded
		do_action( 'xpro_elementor_addons_pro_loaded' );

		//Edd Update
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'libs/license/update.php';
		add_action( 'admin_init', array( $this, 'xpro_elementor_addons_pro_updater' ), 0 );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain(
			'xpro-elementor-addons-pro',
			false,
			dirname( plugin_basename( XPRO_ELEMENTOR_ADDONS_PRO__FILE__ ) ) . '/language/'
		);
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function init() {

		// Check if Xpro Elementor Addons installed and activated
		if ( ! did_action( 'xpro_elementor_addons_loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_xpro_elementor_addons' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once plugin_dir_path( __FILE__ ) . 'plugin.php';
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function admin_notice_missing_xpro_elementor_addons() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$screen = get_current_screen();

		if ( 'plugins' === $screen->base ) {
			if ( file_exists( WP_PLUGIN_DIR . '/xpro-elementor-addons/xpro-elementor-addons.php' ) ) {
				$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
					esc_html__( '"%1$s" requires "%2$s" to be activated. %3$s', 'xpro-elementor-addons-pro' ),
					'<strong>' . esc_html__( 'Xpro Elementor Addons - Pro', 'xpro-elementor-addons-pro' ) . '</strong>',
					'<strong>' . esc_html__( 'Xpro Elementor Addons', 'xpro-elementor-addons-pro' ) . '</strong>',
					'<p><a href="' . wp_nonce_url( 'plugins.php?action=activate&plugin=xpro-elementor-addons/xpro-elementor-addons.php', 'activate-plugin_xpro-elementor-addons/xpro-elementor-addons.php' ) . '" class="button-primary">' . esc_html__( 'Activate', 'xpro-elementor-addons-pro' ) . '</a></p>'
				);
			} else {
				$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
					esc_html__( '"%1$s" requires "%2$s" to be installed. %3$s', 'xpro-elementor-addons-pro' ),
					'<strong>' . esc_html__( 'Xpro Elementor Addons - Pro', 'xpro-elementor-addons-pro' ) . '</strong>',
					'<strong>' . esc_html__( 'Xpro Elementor Addons', 'xpro-elementor-addons-pro' ) . '</strong>',
					'<p><a href="' . wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=xpro-elementor-addons' ), 'install-plugin_xpro-elementor-addons' ) . '" class="button-primary">' . esc_html__( 'Install', 'xpro-elementor-addons-pro' ) . '</a></p>'
				);
			}

			printf( '<div class="notice notice-warning"><p>%1$s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		}
	}

	/**
	 * Edd update
	 *
	 * @since 0.1.8
	 * @access public
	 */

	public function xpro_elementor_addons_pro_updater() {

		$license_key = trim( get_option( 'xpro_elementor_license_data', '' ) );

		$edd_update = new XproElementorAddonsPro\Libs\Xpro_Elementor_Edd_Update(
			'https://www.wpxpro.com/',
			__FILE__,
			array(
				'version'   => XPRO_ELEMENTOR_ADDONS_PRO_VERSION,
				'license'   => $license_key,
				'item_id'   => 6632,
				'item_name' => 'Xpro Elementor Addons – Pro',
				'author'    => 'Xpro',
				'beta'      => false,
			)
		);
	}
}

// Instantiate XPRO_ELEMENTOR_ADDONS_PRO.
new XPRO_ELEMENTOR_ADDONS_PRO();
