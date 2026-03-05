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
    exit;
}

function appku_widgets_init() {

    if( class_exists('ReduxFramework') ) {
        $appku_sidebar_widget_title_heading_tag = appku_opt('appku_sidebar_widget_title_heading_tag');
    } else {
        $appku_sidebar_widget_title_heading_tag = 'h4';
    }

    //sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'appku' ),
        'id'            => 'appku-blog-sidebar',
        'description'   => esc_html__( 'Add Blog Sidebar Widgets Here.', 'appku' ),
        'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="title"><'.esc_attr($appku_sidebar_widget_title_heading_tag).'>',
        'after_title'   => '</'.esc_attr($appku_sidebar_widget_title_heading_tag).'></div>',
    ) );

    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'appku' ),
        'id'            => 'appku-page-sidebar',
        'description'   => esc_html__( 'Add Page Sidebar Widgets Here.', 'appku' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="title"><h4>',
        'after_title'   => '</h4></div>',
    ) );

    if( class_exists( 'ReduxFramework' ) ){
        // footer widgets register
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 1', 'appku' ),
           'id'            => 'appku-footer-1',
           'before_widget' => '<div class="col-lg-4 col-md-6 item"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h4 class="title">',
           'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 2', 'appku' ),
           'id'            => 'appku-footer-2',
           'before_widget' => '<div class="col-lg-2 col-md-6 item"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h4 class="title">',
           'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 3', 'appku' ),
           'id'            => 'appku-footer-3',
           'before_widget' => '<div class="col-lg-3 col-md-6 item"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h4 class="title">',
           'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 4', 'appku' ),
           'id'            => 'appku-footer-4',
           'before_widget' => '<div class="col-lg-3 col-md-6 item"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h4 class="title">',
           'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Service Widgets Area', 'appku' ),
           'id'            => 'appku-service-area',
           'before_widget' => '<div class="single-widget"><div id="%1$s" class="services-sidebar %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h4 class="widget-title">',
           'after_title'   => '</h4>',
        ) );
    }

}

add_action( 'widgets_init', 'appku_widgets_init' );