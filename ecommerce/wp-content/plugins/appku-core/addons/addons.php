<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Appku Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Appku_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}


	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        // Register widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);

        // category register
		add_action( 'elementor/elements/categories_registered',[ $this, 'appku_elementor_widget_categories' ] );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'appku' ),
			'<strong>' . esc_html__( 'Appku Core', 'appku' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'appku' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'appku' ),
			'<strong>' . esc_html__( 'Appku Core', 'appku' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'appku' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'appku' ),
			'<strong>' . esc_html__( 'Appku Core', 'appku' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'appku' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( APPKU_ADDONS . '/widgets/section-title.php' );
		// require_once( APPKU_ADDONS . '/widgets/button.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-banner.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-about-us.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-subscribe-form.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-features.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-feature-banner.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-counterup.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-overview.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-working-process.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-testimonials.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-pricing.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-brand.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-team.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-progressbar.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-team-information.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-single-contact-info.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-contact-form.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-gallery.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-project-info.php' );
		require_once( APPKU_ADDONS . '/widgets/blog-post.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-get-app.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-tab.php' );
		require_once( APPKU_ADDONS . '/widgets/image.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-service.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-video-btn.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-app-features.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-item-list.php' );
		require_once( APPKU_ADDONS . '/widgets/appku-features-tab.php' );
		

		// Header Elements
		require_once( APPKU_ADDONS . '/header/header.php' );


		// Footer Elements
		require_once( APPKU_ADDONS . '/footer-widgets/newsletter-widget.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Section_Title_Widget() );
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Blog_Post() );
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_About_Us() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Subscribe_Widgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Feature() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Feature_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Counterup() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Overview() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Working_Process() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Pricing() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Brand_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Team() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Progressbar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Team_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Single_Contact_Info_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Contact_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Project_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Blog_Post() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Getapp() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Tab_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Service() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Vdo_Btn() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_App_Feature() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Feature_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Feature_Tab() );
		
		// Header Widget Register
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Header() );


		// Footer Widget Register
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Appku_Newsletter_Widgets() );

	}

    public function widget_scripts() {
        wp_enqueue_script(
            'appku-frontend-script',
            APPKU_PLUGDIRURI . 'assets/js/appku-frontend.js',
            array('jquery'),
            false,
            true
		);
	}
	

    function appku_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'appku',
            [
                'title' => __( 'Appku', 'appku' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
        $elements_manager->add_category(
            'appku_footer_elements',
            [
                'title' => __( 'Appku Footer Elements', 'appku' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'appku_header_elements',
            [
                'title' => __( 'Appku Header Elements', 'appku' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

	}

}

Appku_Extension::instance();