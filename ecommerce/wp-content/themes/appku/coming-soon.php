<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 * Template Name: Coming Soon Page
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $appkucoming_soontitle     = appku_opt( 'appku_coming_soon_title' );
        $appkucoming_soonsubtitle  = appku_opt( 'appku_coming_soon_subtitle' );
        $appkucoming_soonbtntext   = appku_opt( 'appku_coming_soon_btn_text' );
    } else {
        $appkucoming_soontitle     = __( 'Website Under Construction', 'appku' );
        $appkucoming_soonsubtitle  = __( 'Website Under Construction. Work Is Going On For The Website Please Stay With Us.', 'appku' );
        $appkucoming_soonbtntext   = __( 'Return To Home', 'appku' );
    }


    // get header
    get_header();

    echo '<section class="vs-error-wrapper space">';
        echo '<div class="container">';
            echo '<div class="error-content text-center">';
                if( ! empty( appku_opt( 'appku_coming_soon_image', 'url' ) ) ){
                    echo '<div class="error-img">';
                        echo appku_img_tag( array(
                            'url'   => esc_url( appku_opt( 'appku_coming_soon_image', 'url' ) ),
                        ) );
                    echo '</div>';
                }
                echo '<div class="row justify-content-center">';
                    echo '<div class="col-xl-9">';
                        if( ! empty( $appkucoming_soontitle ) ){
                            echo '<h2 class="error-title">'.esc_html( $appkucoming_soontitle ).'</h2>';
                        }
                        if( ! empty( $appkucoming_soonsubtitle ) ){
                            echo '<p class="error-text px-xl-5">'.esc_html( $appkucoming_soonsubtitle ).'</p>';
                        }
                        echo '<a href="'.esc_url( home_url('/') ).'" class="vs-btn mask-btn"><span class="btn-text">'.esc_html( $appkucoming_soonbtntext ).'</span><span class="btn-text-mask">'.esc_html( $appkucoming_soonbtntext ).'</span></a>';

                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';

    //footer
    get_footer();