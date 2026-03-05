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

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( appku_meta('page_breadcrumb_area') ) ) {
            $appku_page_breadcrumb_area  = appku_meta('page_breadcrumb_area');
        } else {
            $appku_page_breadcrumb_area = '1';
        }
    }else{
        $appku_page_breadcrumb_area = '1';
    }

    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );

    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $appku_page_breadcrumb_area == '1' ) {
            if( class_exists( 'ReduxFramework' )  ){
                $class = '';
            }else{
                $class = 'thumb-less';
            }
            echo '<!-- Page title -->';
            echo '<div class="breadcrumb-area custom-breadcrumb shadow dark bg-cover text-center text-light '.esc_attr($class).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col-lg-12 col-md-12">';
                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                                if( appku_meta('page_breadcrumb_settings') == 'page' ) {
                                    $appku_page_title_switcher = appku_meta('page_title');
                                } elseif( appku_opt('appku_page_title_switcher') == true ) {
                                    $appku_page_title_switcher = appku_opt('appku_page_title_switcher');
                                }else{
                                    $appku_page_title_switcher = '1';
                                }
                            } else {
                                $appku_page_title_switcher = '1';
                            }

                            if( $appku_page_title_switcher == '1' ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    $appku_page_title_tag    = appku_opt('appku_page_title_tag');
                                }else{
                                    $appku_page_title_tag    = 'h1';
                                }

                                if( defined( 'CMB2_LOADED' )  ){
                                    if( !empty( appku_meta('page_title_settings') ) ) {
                                        $appku_custom_title = appku_meta('page_title_settings');
                                    } else {
                                        $appku_custom_title = 'default';
                                    }
                                }else{
                                    $appku_custom_title = 'default';
                                }

                                if( $appku_custom_title == 'default' ) {
                                    echo appku_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $appku_page_title_tag ),
                                            "text"  => esc_html( get_the_title( ) ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    echo appku_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $appku_page_title_tag ),
                                            "text"  => esc_html( appku_meta('custom_page_title') ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }

                            }
                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                                if( appku_meta('page_breadcrumb_settings') == 'page' ) {
                                    $appku_breadcrumb_switcher = appku_meta('page_breadcrumb_trigger');
                                } else {
                                    $appku_breadcrumb_switcher = appku_opt('appku_enable_breadcrumb');
                                }

                            } else {
                                $appku_breadcrumb_switcher = '1';
                            }

                            if( $appku_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                                appku_breadcrumbs(
                                    
                                );
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
        }
    } else {
        if( class_exists( 'ReduxFramework' )  ){
            $class = '';
        }else{
            $class = 'thumb-less';
        }
        echo '<!-- Page title -->';
        echo '<div class="breadcrumb-area shadow dark bg-cover text-center text-light '.esc_attr($class).'">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-lg-12 col-md-12">';
                        if( class_exists( 'ReduxFramework' )  ){
                            $appku_page_title_switcher  = appku_opt('appku_page_title_switcher');
                        }else{
                            $appku_page_title_switcher = '1';
                        }

                        if( $appku_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $appku_page_title_tag    = appku_opt('appku_page_title_tag');
                            }else{
                                $appku_page_title_tag    = 'h1';
                            }
                            if ( is_archive() ){
                                echo appku_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $appku_page_title_tag ),
                                        "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif ( is_home() ){
                                $appku_blog_page_title_setting = appku_opt('appku_blog_page_title_setting');
                                $appku_blog_page_title_switcher = appku_opt('appku_blog_page_title_switcher');
                                $appku_blog_page_custom_title = appku_opt('appku_blog_page_custom_title');
                                if( class_exists('ReduxFramework') ){
                                    if( $appku_blog_page_title_switcher ){
                                        echo appku_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $appku_page_title_tag ),
                                                "text"  => !empty( $appku_blog_page_custom_title ) && $appku_blog_page_title_setting == 'custom' ? esc_html( $appku_blog_page_custom_title) : esc_html__( 'FAQ', 'appku' ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }else{
                                    echo appku_heading_tag(
                                        array(
                                            "tag"   => "h1",
                                            "text"  => esc_html__( 'Blog', 'appku' ),
                                            'class' => 'breadcumb-title',
                                        )
                                    );
                                }
                            }elseif( is_search() ){
                                echo appku_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $appku_page_title_tag ),
                                        "text"  => esc_html__( 'Search Result', 'appku' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif( is_404() ){
                                echo appku_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $appku_page_title_tag ),
                                        "text"  => esc_html__( '404 PAGE', 'appku' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }else{
                                $posttitle_position  = appku_opt('appku_post_details_title_position');
                                $postTitlePos = false;
                                if( is_single() ){
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }
                                }
                                if( $postTitlePos != true ){
                                    echo appku_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $appku_page_title_tag ),
                                            "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $appku_post_details_custom_title  = appku_opt('appku_post_details_custom_title');
                                    }else{
                                        $appku_post_details_custom_title = __( 'Blog Details','appku' );
                                    }

                                    if( !empty( $appku_post_details_custom_title ) ) {
                                        echo appku_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $appku_page_title_tag ),
                                                "text"  => wp_kses( $appku_post_details_custom_title, $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }
                            }
                        }
                        if( class_exists('ReduxFramework') ) {
                            $appku_breadcrumb_switcher = appku_opt( 'appku_enable_breadcrumb' );
                        } else {
                            $appku_breadcrumb_switcher = '1';
                        }
                        if( $appku_breadcrumb_switcher == '1' ) {
                            appku_breadcrumbs(
                                array(
                                    'breadcrumbs_classes' => 'nav',
                                )
                            );
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }