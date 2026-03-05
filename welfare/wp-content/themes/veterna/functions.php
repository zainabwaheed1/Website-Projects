<?php
/**
 * Theme Functions
 *
 * @author Jegtheme
 * @package veterna
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

defined( 'VETERNA_VERSION' ) || define( 'VETERNA_VERSION', '1.0.1' );
defined( 'VETERNA_DIR' ) || define( 'VETERNA_DIR', trailingslashit( get_template_directory() ) );

defined( 'GUTENVERSE_COMPANION_REQUIRED_VERSION' ) || define( 'GUTENVERSE_COMPANION_REQUIRED_VERSION', '1.0.5' );
defined( 'GUTENVERSE_FRAMEWORK_REQUIRED_VERSION' ) || define( 'GUTENVERSE_FRAMEWORK_REQUIRED_VERSION', '2.0.0' );

require get_parent_theme_file_path( 'inc/autoload.php' );

Veterna\Init::instance();
