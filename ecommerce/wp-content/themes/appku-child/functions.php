<?php
/**
 *
 * @Packge      appku
 * @Author      Validthemes
 * @Author URL  https://themeforest.net/user/validthemes/portfolio
 * @version     1.0
 *
 */

/**
 * Enqueue style of child theme
 */
function appku_child_enqueue_styles() {

    wp_enqueue_style( 'appku-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'appku-child-style', get_stylesheet_directory_uri() . '/style.css',array( 'appku-style' ),wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'appku_child_enqueue_styles', 100000 );





