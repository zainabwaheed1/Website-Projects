<?php

namespace XproElementorAddonsPro;

use Elementor\Plugin;
use XproElementorAddons\Libs\Xpro_Elementor_Dashboard;
use XproElementorAddonsPro\Inc\Xpro_Elementor_Module_Pro_List;
use XproElementorAddonsPro\Inc\Xpro_Elementor_Widget_Pro_List;
use XproElementorAddonsPro\Libs\Xpro_Elementor_License;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 0.1.8
 */
class Xpro_Elementor_Addons_Pro {


	/**
	 * Instance
	 *
	 * @since 0.1.8
	 * @access private
	 * @static
	 *
	 * @var Xpro_Elementor_Addons_Pro The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Xpro_Elementor_Addons_Pro An instance of the class.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}

		return self::$instance;
	}

	public function init() {

		$this->include_files();

		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		// Init Elementor
		add_action( 'elementor/init', array( $this, 'xpro_elementor_init' ) );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ), 99 );

		// Register widgets
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );

		//Register Modules
		add_action( 'init', array( $this, 'register_modules' ) );

		//After Save
		add_action( 'elementor/editor/after_save', array( $this, 'clear_cache_elementor' ) );

		//Plugin Row Meta
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . XPRO_ELEMENTOR_ADDONS_PRO_BASE, array( $this, 'plugin_action_links' ) );

		//WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'mini_cart_fragments' ) );
		}
	}

	/**
	 * Include Files
	 *
	 * @since 0.1.8
	 * @access public
	 */

	public function include_files() {

		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'libs/license/license.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/module-list.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/widget-list.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'classes/xpro-mega-menu-walker.php';

		// WPML Compatibility
		if ( in_array( 'sitepress-multilingual-cms/sitepress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) && in_array( 'wpml-string-translation/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
			require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'inc/wpml/wpml-compatibility.php';
		}

	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function widget_scripts() {

		//CSS
		wp_enqueue_style(
			'xpro-elementor-addons-pro-widgets',
			XPRO_ELEMENTOR_ADDONS_PRO_ASSETS . 'css/xpro-widgets.css',
			array(),
			XPRO_ELEMENTOR_ADDONS_PRO_VERSION
		);
		wp_enqueue_style(
			'xpro-elementor-addons-pro-responsive',
			XPRO_ELEMENTOR_ADDONS_PRO_ASSETS . 'css/xpro-responsive.css',
			array(),
			XPRO_ELEMENTOR_ADDONS_PRO_VERSION
		);

		//JS
		wp_enqueue_script(
			'xpro-elementor-addons-pro-widgets',
			XPRO_ELEMENTOR_ADDONS_PRO_ASSETS . 'js/xpro-widgets.js',
			array( 'jquery' ),
			XPRO_ELEMENTOR_ADDONS_PRO_VERSION,
			true
		);

		wp_script_add_data( 'xpro-elementor-addons-pro-widgets', 'async', true );

		if ( class_exists( 'woocommerce' ) ) {
			wp_enqueue_style(
				'xpro-elementor-addons-pro-woo',
				XPRO_ELEMENTOR_ADDONS_PRO_ASSETS . 'css/xpro-woo-widgets.css',
				null,
				XPRO_ELEMENTOR_ADDONS_PRO_VERSION
			);
			wp_enqueue_script(
				'xpro-elementor-addons-pro-woo',
				XPRO_ELEMENTOR_ADDONS_PRO_ASSETS . 'js/xpro-woo-widgets.js',
				array( 'jquery' ),
				XPRO_ELEMENTOR_ADDONS_PRO_VERSION,
				true
			);

			wp_script_add_data( 'xpro-elementor-addons-pro-woo', 'async', true );

		}
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public function register_widgets( $widgets_manager ) {

		if ( 'valid' !== Xpro_Elementor_License::$license_activate ) {
			return;
		}

		$all_widgets    = Xpro_Elementor_Widget_Pro_List::instance()->get_list();
		$active_widgets = Xpro_Elementor_Dashboard::instance()->utils->get_option( 'xpro_elementor_widget_list', array_keys( $all_widgets ) );

		if ( ! empty( $active_widgets ) && is_array( $active_widgets ) ) {
			foreach ( $active_widgets as $widget_slug ) {
				if ( array_key_exists( $widget_slug, $all_widgets ) ) {
					if ( 'pro' === $all_widgets[ $widget_slug ]['package'] ) {
						require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'widgets/' . str_replace( '_', '-', $widget_slug ) . '/' . str_replace( '_', '-', $widget_slug ) . '.php';
						$class_name = '\XproElementorAddonsPro\Widget\\' . $this->make_classname( $widget_slug );
						if ( class_exists( $class_name ) ) {
							$widgets_manager->register( new $class_name() );
						}
					}
				}
			}
		}
	}

	/**
	 * Clear Cache Elementor After Save
	 *
	 * For Dynamic Content Responsive Issue
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function clear_cache_elementor() {
		Plugin::$instance->files_manager->clear_cache();
	}

	/**
	 * Auto generate classname from path.
	 *
	 * @since 0.1.8
	 * @access public
	 */
	public static function make_classname( $dirname ) {
		$dirname    = pathinfo( $dirname, PATHINFO_FILENAME );
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );
		return $class_name;
	}

	/**
	 * Register Modules
	 *
	 * Register Modules Settings.
	 *
	 * @since 0.1.8
	 * @access public
	 */

	public function register_modules() {

		if ( 'valid' !== Xpro_Elementor_License::$license_activate ) {
			return;
		}

		$all_modules    = Xpro_Elementor_Module_Pro_List::instance()->get_list();
		$active_modules = Xpro_Elementor_Dashboard::instance()->utils->get_option( 'xpro_elementor_module_list', array_keys( $all_modules ) );

		if ( ! empty( $active_modules ) && is_array( $active_modules ) ) {
			foreach ( $active_modules as $module_slug ) {
				if ( array_key_exists( $module_slug, $all_modules ) ) {
					if ( 'pro' === $all_modules[ $module_slug ]['package'] ) {
						include_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/' . str_replace( '_', '-', $module_slug ) . '/' . str_replace( '_', '-', $module_slug ) . '.php';
					}
				}
			}
		}
	}

	/**
	 * Elementor Init
	 *
	 * @since 0.1.8
	 * @access public
	 */

	public function xpro_elementor_init() {

		//Register Category
		Plugin::$instance->elements_manager->add_category(
			'xpro-widgets-pro',
			array(
				'title' => esc_html__( 'Xpro Addons - Pro', 'xpro-elementor-addons-pro' ),
				'icon'  => 'eicon-pro-icon',
			)
		);
	}

	/**
	 * mincart update
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function mini_cart_fragments( $fragments ) {
		$fragments['span.xpro-cart-btn-badge']       = '<span class="xpro-cart-btn-badge">' . WC()->cart->get_cart_contents_count() . '</span>';
		$fragments['span.xpro-mini-cart-item-count'] = '<span class="xpro-mini-cart-item-count">' . WC()->cart->get_cart_contents_count() . '</span>';
		$fragments['span.xpro-mc__btn-subtotal']     = '<span class="xpro-mc__btn-subtotal">' . WC()->cart->get_cart_subtotal() . '</span>';
		ob_start();
		?>
		<div class="xpro-mini-cart-items">
			<?php require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-mini-cart/layout/mini-cart.php'; ?>
		</div>
		<?php
		$fragments['div.xpro-mini-cart-items'] = ob_get_clean();

		return $fragments;
	}

	/**
	 * Plugin row meta.
	 *
	 * Adds row meta links to the plugin list table
	 *
	 * Fired by `plugin_row_meta` filter.
	 *
	 * @param array $plugin_meta An array of the plugin's metadata, including
	 *                            the version, author, author URI, and plugin URI.
	 * @param string $plugin_file Path to the plugin file, relative to the plugins
	 *                            directory.
	 *
	 * @return array An array of plugin row meta links.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function plugin_row_meta( $plugin_meta, $plugin_file ) {
		if ( XPRO_ELEMENTOR_ADDONS_PRO_BASE === $plugin_file ) {
			$row_meta    = array( 'docs' => '<a href="https://elementor.wpxpro.com/docs/" aria-label="' . esc_attr( esc_html__( 'View Documentation', 'xpro-elementor-addons-pro' ) ) . '" target="_blank">' . esc_html__( 'Documentation', 'xpro-elementor-addons-pro' ) . '</a>' );
			$plugin_meta = array_merge( $plugin_meta, $row_meta );
		}

		return $plugin_meta;
	}

	/**
	 * Plugin action links.
	 *
	 * Adds action links to the plugin list table
	 *
	 * Fired by `plugin_action_links` filter.
	 *
	 * @param array $links An array of plugin action links.
	 *
	 * @return array An array of plugin action links.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function plugin_action_links( $links ) {
		$settings_link = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=xpro-elementor-addons' ), esc_html__( 'Settings', 'xpro-elementor-addons-pro' ) );
		array_unshift( $links, $settings_link );

		$links['activate_pro'] = sprintf( '<a href="%1$s" class="xpro-elementor-addons-gopro">%2$s</a>', admin_url( 'admin.php?page=xpro-elementor-addons-license' ), esc_html__( 'License', 'xpro-elementor-addons-pro' ) );

		return $links;
	}

}

// Instantiate Xpro_Elementor_Addons_Pro Class
Xpro_Elementor_Addons_Pro::instance();
