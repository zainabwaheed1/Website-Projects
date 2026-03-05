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
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook appku_blog_start_wrap
    *
    * @Hooked appku_blog_start_wrap_cb 10
    *  
    */
    do_action( 'appku_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook appku_blog_col_start_wrap
    *
    * @Hooked appku_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'appku_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook appku_blog_content
    *
    * @Hooked appku_blog_content_cb 10
    *  
    */
    do_action( 'appku_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook appku_blog_pagination
    *
    * @Hooked appku_blog_pagination_cb 10
    *  
    */
    do_action( 'appku_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook appku_blog_col_end_wrap
    *
    * @Hooked appku_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'appku_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook appku_blog_sidebar
    *
    * @Hooked appku_blog_sidebar_cb 10
    *  
    */
    do_action( 'appku_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook appku_blog_end_wrap
    *
    * @Hooked appku_blog_end_wrap_cb 10
    *  
    */
    do_action( 'appku_blog_end_wrap' );

    //footer
    get_footer();