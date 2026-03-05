<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'APPKU_DIR_URI' ) ) {
    define('APPKU_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'APPKU_DIR_ASSIST_URI' ) ) {
    define( 'APPKU_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'APPKU_DIR_CSS_URI' ) ) {
    define( 'APPKU_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Skin Css File
if ( ! defined( 'APPKU_DIR_SKIN_CSS_URI' ) ) {
    define( 'APPKU_DIR_SKIN_CSS_URI', get_theme_file_uri('/assets/css/skins/') );
}


// Js File URI
if (!defined('APPKU_DIR_JS_URI')) {
    define('APPKU_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// External PLugin File URI
if (!defined('APPKU_DIR_PLUGIN_URI')) {
    define('APPKU_DIR_PLUGIN_URI', get_theme_file_uri( '/assets/plugins/'));
}

// Base Directory
if (!defined('APPKU_DIR_PATH')) {
    define('APPKU_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('APPKU_DIR_PATH_INC')) {
    define('APPKU_DIR_PATH_INC', APPKU_DIR_PATH . 'inc/');
}

//APPKU framework Folder Directory
if (!defined('APPKU_DIR_PATH_FRAM')) {
    define('APPKU_DIR_PATH_FRAM', APPKU_DIR_PATH_INC . 'appku-framework/');
}

//Classes Folder Directory
if (!defined('APPKU_DIR_PATH_CLASSES')) {
    define('APPKU_DIR_PATH_CLASSES', APPKU_DIR_PATH_INC . 'classes/');
}

//Hooks Folder Directory
if (!defined('APPKU_DIR_PATH_HOOKS')) {
    define('APPKU_DIR_PATH_HOOKS', APPKU_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'APPKU_DEMO_DIR_PATH' ) ){
    define( 'APPKU_DEMO_DIR_PATH', APPKU_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'APPKU_DEMO_DIR_URI' ) ){
    define( 'APPKU_DEMO_DIR_URI', APPKU_DIR_URI.'inc/demo-data/' );
}