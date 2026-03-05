<?php

// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
   exit();
}

/**
 * Plugin Name: Appku Core
 * Description: This is a helper plugin of appku theme
 * Version:     1.0
 * Author:      Validthemes
 * Author URI:  https://themeforest.net/user/validthemes/portfolio
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: appku
 */

// Define Constant
define( 'APPKU_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'APPKU_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'APPKU_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );
define( 'APPKU_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );
define( 'APPKU_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
define( 'APPKU_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );
define( 'APPKU_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'appku-template/' );

// load textdomain
load_plugin_textdomain( 'appku', false, basename( dirname( __FILE__ ) ) . '/languages' );

//include file.
require_once APPKU_PLUGIN_INC_PATH .'appkucore-functions.php';
require_once APPKU_PLUGIN_INC_PATH . 'MCAPI.class.php';
require_once APPKU_PLUGIN_INC_PATH .'appkuajax.php';
require_once APPKU_PLUGIN_INC_PATH .'builder/builder.php';

require_once APPKU_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget
require_once APPKU_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
// require_once APPKU_PLUGIN_WIDGET_PATH . 'gallery-widget.php';
require_once APPKU_PLUGIN_WIDGET_PATH . 'appku-about-widget.php';
require_once APPKU_PLUGIN_WIDGET_PATH . 'appku-contact-widget.php';
require_once APPKU_PLUGIN_WIDGET_PATH . 'appku-download-button-widget.php';
require_once APPKU_PLUGIN_WIDGET_PATH . 'appku-cta-widget.php';

//addons
require_once APPKU_ADDONS . 'addons.php';