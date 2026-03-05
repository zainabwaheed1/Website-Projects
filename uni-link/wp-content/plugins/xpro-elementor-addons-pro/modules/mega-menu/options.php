<?php

namespace XproElementorAddonsPro\Module\MegaMenu;

use XproElementorAddonsPro\Module\Xpro_Elementor_Mega_Menu;

defined( 'ABSPATH' ) || exit;

class Options {

	protected $current_menu_id = null;
	private $dir;
	private $url;

	public function __construct() {

		add_action( 'admin_footer', array( $this, 'options_menu_item' ) );
		add_action( 'admin_footer', array( $this, 'options_megamenu' ) );
		add_action( 'admin_head', array( $this, 'save_megamenu_options' ) );
	}

	public function options_menu_item() {
		$screen = get_current_screen();
		if ( 'nav-menus' !== $screen->base ) {
			return;
		}

		$file = XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/mega-menu/template/megamenu-popup.php';

		if ( is_readable( $file ) ) {
			include $file;
		}

	}

	public function options_megamenu() {
		$screen = get_current_screen();
		if ( 'nav-menus' !== $screen->base ) {
			return;
		}

		$menu_id = $this->current_menu_id();
		$data    = xpro_megamenu_option( Xpro_Elementor_Mega_Menu::$megamenu_settings_key, array() );
		$data    = ( isset( $data[ 'menu_location_' . $menu_id ] ) ) ? $data[ 'menu_location_' . $menu_id ] : array();

		include XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/mega-menu/template/megamenu-trigger.php';

	}

	public function current_menu_id() {

		if ( null !== $this->current_menu_id ) {
			return $this->current_menu_id;
		}

		$nav_menus            = wp_get_nav_menus( array( 'orderby' => 'name' ) );
		$menu_count           = count( $nav_menus );
		$nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;
		$add_new_screen       = ( isset( $_GET['menu'] ) && 0 == $_GET['menu'] ) ? true : false;

		$this->current_menu_id = $nav_menu_selected_id;

		// If we have one theme location, and zero menus, we take them right into editing their first menu
		$page_count                  = wp_count_posts( 'page' );
		$one_theme_location_no_menus = 1 === count( get_registered_nav_menus() ) && ! $add_new_screen && empty( $nav_menus ) && ! empty( $page_count->publish );

		// Get recently edited nav menu
		$recently_edited = absint( get_user_option( 'nav_menu_recently_edited' ) );
		if ( empty( $recently_edited ) && is_nav_menu( $this->current_menu_id ) ) {
			$recently_edited = $this->current_menu_id;
		}

		// Use $recently_edited if none are selected
		if ( empty( $this->current_menu_id ) && ! isset( $_GET['menu'] ) && is_nav_menu( $recently_edited ) ) {
			$this->current_menu_id = $recently_edited;
		}

		// On deletion of menu, if another menu exists, show it
		if ( ! $add_new_screen && 0 < $menu_count && isset( $_GET['action'] ) && 'delete' == $_GET['action'] ) {
			$this->current_menu_id = $nav_menus[0]->term_id;
		}

		// Set $this->current_menu_id to 0 if no menus
		if ( $one_theme_location_no_menus ) {
			$this->current_menu_id = 0;
		} elseif ( empty( $this->current_menu_id ) && ! empty( $nav_menus ) && ! $add_new_screen ) {
			// if we have no selection yet, and we have menus, set to the first one in the list
			$this->current_menu_id = $nav_menus[0]->term_id;
		}

		return $this->current_menu_id;

	}

	public function save_megamenu_options() {
		$screen = get_current_screen();
		if ( 'nav-menus' !== $screen->base || ! isset( $_POST['update-nav-menu-nonce'] ) ) {
			return;
		}
		$menu_id    = isset( $_POST['menu'] ) ? $_POST['menu'] : 0;
		$is_enabled = isset( $_POST['is_enabled'] ) ? $_POST['is_enabled'] : 0;

		$data                                = xpro_megamenu_option( Xpro_Elementor_Mega_Menu::$megamenu_settings_key, array() );
		$data[ 'menu_location_' . $menu_id ] = array(
			'is_enabled' => $is_enabled,
		);

		xpro_megamenu_save_option( Xpro_Elementor_Mega_Menu::$megamenu_settings_key, $data );
	}
}

new Options();
