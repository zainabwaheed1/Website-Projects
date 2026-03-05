<?php
/**
 * Plugin Name: Drake Core
 * Description: Drake Core Plugin Contains Elementor Widgets Specifically created for drake WordPress Theme.
 * Plugin URI:  wordpressriverthemes.com/drake
 * Version:     3.0.1
 * Author:      WordPressRiver
 * Author URI:  https://themeforest.net/user/wordpressriver/portfolio
 * Text Domain: drake-core
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */


if ( !defined('ABSPATH') )
    die('-1');

// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'drake_core' ) ) {
	/**
	 * Main drake Core Class
	 *
	 * The main class that initiates and runs the drake Core plugin.
	 *
	 * @since 1.7.0
	 */
	final class drake_core {
		/**
		 * drake Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 Moved from property with that name to a constant.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0' ;
		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 Moved from property with that name to a constant.
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '1.7.0';
		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 Moved from property with that name to a constant.
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.4' ;
        /**
         * Plugin's directory paths
         * @since 1.0
         */
        const CSS = null;
        const JS = null;
        const IMG = null;
        const VEND = null;

		/**
		 * Instance
		 *
		 * Holds a single instance of the `drake_core` class.
		 *
		 * @since 1.7.0
		 *
		 * @access private
		 * @static
		 *
		 * @var drake_core A single instance of the class.
		 */
		private static  $_instance = null ;
		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 * @static
		 *
		 * @return drake_core An instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @since 1.7.0
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'drake-core' ), '1.7.0' );
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @since 1.7.0
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'drake-core' ), '1.7.0' );
		}

		/**
		 * Constructor
		 *
		 * Initialize the drake Core plugins.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function __construct() {
			$this->core_includes();
			$this->init_hooks();
			do_action( 'drake_core_loaded' );
		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function core_includes() {
		
		}

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @since 1.7.0
		 *
		 * @access private
		 */
		private function init_hooks() {
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'drake-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}



		/**
		 * Init drake Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @since 1.0.0
		 * @since 1.7.0 The logic moved from a standalone function to this class method.
		 *
		 * @access public
		 */
		public function init() {

			if ( !did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}

			// Check for required Elementor version

			if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}

			// Check for required PHP version

			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}

			// Add new Elementor Categories
			add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

			// Register Widget Styles
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_widget_styles' ] );

			// Register Widget Scripts
			add_action( 'elementor/frontend/after_register_scripts', [ $this,'register_widget_scripts' ] );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_scripts' ] );

			// Register New Widgets
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.1.0
		 * @since 1.7.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {
			$message = sprintf(
			/* translators: 1: drake Core 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'drake-core' ),
				'<strong>' . esc_html__( 'drake core', 'drake-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'drake-core' ) . '</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.1.0
		 * @since 1.7.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {
			$message = sprintf(
			/* translators: 1: drake Core 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'drake-core' ),
				'<strong>' . esc_html__( 'drake Core', 'drake-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'drake-core' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {
			$message = sprintf(
			/* translators: 1: drake Core 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'drake-core' ),
				'<strong>' . esc_html__( 'drake Core', 'drake-core' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'drake-core' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Add new Elementor Categories
		 *
		 * Register new widget categories for drake Core widgets.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function add_elementor_category() {
			\Elementor\Plugin::instance()->elements_manager->add_category( 'drake', [
				'title' => __( 'drake Elements', 'drake-core' ),
			], 1 );
		}


		/**
		 * Register Widget Scripts
		 *
		 * Register custom scripts required to run Saasland Core.
		 *
		 * @since 1.6.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function register_widget_scripts() {
			wp_register_script( 'main', plugins_url( '/assets/js/main.js', __FILE__ ), array( 'jquery' ), false, true );
		}




		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run Saasland Core.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		
		public function enqueue_widget_styles() {

		}

		/**
		 * Register New Widgets
		 *
		 * Include drake Core widgets files and register them in Elementor.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function on_widgets_registered() {
			$this->include_widgets();
			$this->register_widgets();
		}

		/**
		 * Include Widgets Files
		 *
		 * Load drake Core widgets files.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access private
		 */
		private function include_widgets() {
					
			require_once( __DIR__ . '/widgets/drake-hero.php');

			require_once( __DIR__ . '/widgets/drake-about.php');

			require_once( __DIR__ . '/widgets/drake-resume.php');

			require_once( __DIR__ . '/widgets/drake-services.php');

			require_once( __DIR__ . '/widgets/drake-skills.php');

			require_once( __DIR__ . '/widgets/drake-portfolio.php');

			require_once( __DIR__ . '/widgets/drake-testimonial.php');

			require_once( __DIR__ . '/widgets/drake-clients.php');

			require_once( __DIR__ . '/widgets/drake-pricing.php');

			require_once( __DIR__ . '/widgets/drake-contact.php');
        }
			
		/**
		 * Register Widgets
		 *
		 * Register drake Core widgets.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access private
		 */
		private function register_widgets() {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakehero_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakeabout_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakeresume_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakeservices_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakeskill_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakeportfolio_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_draketestimonial_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakeclients_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakepricing_Widget() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_drake_drakecontact_Widget() );
			
		}
	}
} 
// Make sure the same function is not loaded twice in free/premium versions.

if ( !function_exists( 'drake_core_load' ) ) {
	/**
	 * Load drake Core
	 *
	 * Main instance of drake_core.
	 *
	 * @since 1.0.0
	 * @since 1.7.0 The logic moved from this function to a class method.
	 */
	function drake_core_load() {
		return drake_core::instance();
	}

	// Run drake Core
    drake_core_load();
}