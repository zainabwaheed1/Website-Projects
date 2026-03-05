<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/appku-constants.php';

//theme setup
require_once APPKU_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once APPKU_DIR_PATH_INC . 'essential-scripts.php';

//NavWalker
require_once APPKU_DIR_PATH_INC . 'appku-navwalker.php';

// plugin activation
require_once APPKU_DIR_PATH_FRAM . 'plugins-activation/appku-active-plugins.php';

// meta options
require_once APPKU_DIR_PATH_FRAM . 'appku-meta/appku-config.php';

// page breadcrumbs
require_once APPKU_DIR_PATH_INC . 'appku-breadcrumbs.php';

// sidebar register
require_once APPKU_DIR_PATH_INC . 'appku-widgets-reg.php';

//essential functions
require_once APPKU_DIR_PATH_INC . 'appku-functions.php';

// theme dynamic css
require_once APPKU_DIR_PATH_INC . 'appku-commoncss.php';

// helper function
require_once APPKU_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once APPKU_DEMO_DIR_PATH . 'demo-import.php';

// appku options
require_once APPKU_DIR_PATH_FRAM . 'appku-options/appku-options.php';

// hooks
require_once APPKU_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once APPKU_DIR_PATH_HOOKS . 'hooks-functions.php';

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


// lazy loading



