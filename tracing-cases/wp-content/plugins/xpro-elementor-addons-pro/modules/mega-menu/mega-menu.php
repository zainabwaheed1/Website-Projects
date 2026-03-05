<?php

/**
 * Mega Menu Support for Navigation Widget
 *
 * @package XproElementorAddonsPro
 */

namespace XproElementorAddonsPro\Module;

use WP_Query;

class Xpro_Elementor_Mega_Menu {

	public static $menuitem_settings_key = 'xpro_menuitem_settings';
	public static $megamenu_settings_key = 'megamenu_settings';
	public $dir;
	public $url;

	public function __construct() {

		$this->dir = dirname( __FILE__ ) . '/';

		// enqueue scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		// Register widgets
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );

		// include all necessary files
		include $this->dir . '/options.php';
	}

	public function enqueue_scripts() {

		$screen = get_current_screen();

		if ( 'nav-menus' === $screen->base ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'aesthetic-icon-picker', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/css/aesthetic-icon-picker.min.css', false, XPRO_ELEMENTOR_ADDONS_VERSION );
			wp_enqueue_style( 'aesthetic-icon-picker-fonts', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/css/aesthetic-icon-picker-fonts.min.css', false, XPRO_ELEMENTOR_ADDONS_VERSION );
			wp_enqueue_style( 'jquery-modal', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/css/jquery.modal.min.css', false, '0.9.1' );
			wp_enqueue_style( 'xpro-icons', XPRO_ELEMENTOR_ADDONS_ASSETS . 'css/xpro-icons.min.css', false, XPRO_ELEMENTOR_ADDONS_VERSION );
			wp_enqueue_style( 'xpro-menu-admin-style', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/mega-menu/assets/css/mega-menu.css', false, XPRO_ELEMENTOR_ADDONS_PRO_VERSION );

			wp_enqueue_script( 'aesthetic-icon-picker', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/js/aesthetic-icon-picker.min.js', array( 'jquery' ), XPRO_ELEMENTOR_ADDONS_VERSION, true );
			wp_enqueue_script( 'jquery-modal-script', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/js/jquery.modal.min.js', array( 'jquery' ), '0.9.1', true );
			wp_enqueue_script( 'xpro-menu-admin-script', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/mega-menu/assets/js/mega-menu.js', array( 'jquery', 'wp-color-picker' ), XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
			wp_localize_script( 'xpro-menu-admin-script', 'xproMenu', array( 'items' => $this->menu_items() ) );
		}
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @access public
	 */
	public function register_widgets( $widgets_manager ) {
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'widgets/mega-menu/mega-menu.php';
		if ( class_exists( '\XproElementorAddonsPro\Widget\Mega_Menu' ) ) {
			$widgets_manager->register( new \XproElementorAddonsPro\Widget\Mega_Menu() );
		}
	}

	/**
	 * @return array
	 */
	public function menu_items() {

		$args  = array(
			'post_type'   => 'nav_menu_item',
			'post_status' => 'publish',
			'nopaging'    => true,
			'fields'      => 'ids',
		);
		$items = new WP_Query( $args );

		$menu_item = array();

		foreach ( $items->posts as $item ) {
			$data = get_post_meta( $item, self::$menuitem_settings_key, true );
			$data = (array) json_decode( $data );

			if ( isset( $data['menu_enable'] ) && 1 == $data['menu_enable'] ) {
				$menu_item[] = '#menu-item-' . $item;
			}
		}

		return $menu_item;
	}

}

new Xpro_Elementor_Mega_Menu();
