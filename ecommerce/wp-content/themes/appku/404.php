<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $appku404title        = appku_opt( 'appku_fof_title' );
        $appku404subtitle     = appku_opt( 'appku_fof_subtitle' );
        $appku404description  = appku_opt( 'appku_fof_description' );
        $appku404btntext      = appku_opt( 'appku_fof_btn_text' );
    } else {
        $appku404title        = __( '404', 'appku' );
        $appku404subtitle     = __( 'Oops! That page can’t be found', 'appku' );
        $appku404description  = __( 'Sorry, but the page you are looking for does not existing', 'appku' );
        $appku404btntext      = __( ' Back To Home', 'appku');    
    }


    // get header
    get_header();

    echo '<div class="error-page-area text-center default-padding">';
        echo '<div class="container">';
            echo '<div class="row align-center">';
                echo '<div class="col-lg-8 offset-lg-2">';
                    echo '<div class="error-box">';
                        echo '<h1>'.esc_html( $appku404title ).'</h1>';
                        echo '<h2>'.esc_html( $appku404subtitle ).'</h2>';
                        echo '<p>'.esc_html( $appku404description ).'</p>';
                        echo '<a class="btn circle btn-theme effect btn-md" href="'.esc_url( home_url('/') ).'">'.esc_html( $appku404btntext ).'</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    //footer
    get_footer();