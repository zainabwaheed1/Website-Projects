<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $appku_post_id = get_the_ID();

            // Get the page settings manager
            $appku_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $appku_page_settings_model = $appku_page_settings_manager->get_model( $appku_post_id );

            // Retrieve the color we added before
            $appku_header_style = $appku_page_settings_model->get_settings( 'appku_header_style' );
            $appku_header_builder_option = $appku_page_settings_model->get_settings( 'appku_header_builder_option' );

            if( $appku_header_style == 'header_builder'  ) {

                if( !empty( $appku_header_builder_option ) ) {
                    $appkuheader = get_post( $appku_header_builder_option );
                    echo '<header>';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $appkuheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $appku_header_builder_trigger = appku_opt('appku_header_options');
                if( $appku_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $appku_global_header_select = get_post( appku_opt( 'appku_header_select_options' ) );
                    $header_post = get_post( $appku_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    appku_global_header_option();
                }
            }
        } else {
            $appku_header_options = appku_opt('appku_header_options');
            if( $appku_header_options == '1' ) {
                appku_global_header_option();
            } else {
                $appku_header_select_options = appku_opt('appku_header_select_options');
                $appkuheader = get_post( $appku_header_select_options );
                echo '<header>';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $appkuheader->ID );
                echo '</header>';
            }
        }
    } else {
        appku_global_header_option();
    }