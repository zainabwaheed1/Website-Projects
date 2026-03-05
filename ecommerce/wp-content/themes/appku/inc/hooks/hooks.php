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

	/**
	* Hook for preloader
	*/
	add_action( 'appku_preloader_wrap', 'appku_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'appku_main_wrapper_start', 'appku_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'appku_header', 'appku_header_cb', 10 );

	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'appku_blog_start_wrap', 'appku_blog_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'appku_blog_col_start_wrap', 'appku_blog_col_start_wrap_cb', 10 );

	/**
	* Hook for Service Column Start Wrapper
	*/
    add_action( 'appku_service_col_start_wrap', 'appku_service_col_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'appku_blog_col_end_wrap', 'appku_blog_col_end_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'appku_blog_end_wrap', 'appku_blog_end_wrap_cb', 10 );

	/**
	* Hook for Blog Pagination
	*/
    add_action( 'appku_blog_pagination', 'appku_blog_pagination_cb', 10 );

    /**
	* Hook for Blog Content
	*/
	add_action( 'appku_blog_content', 'appku_blog_content_cb', 10 );

    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'appku_blog_sidebar', 'appku_blog_sidebar_cb', 10 );


    /**
	* Hook for Service Sidebar
	*/
	add_action( 'appku_service_sidebar', 'appku_service_sidebar_cb', 10 );

    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'appku_blog_details_sidebar', 'appku_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'appku_blog_details_wrapper_start', 'appku_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'appku_blog_post_meta', 'appku_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'appku_blog_details_share_options', 'appku_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'appku_blog_details_author_bio', 'appku_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'appku_blog_details_tags_and_categories', 'appku_blog_details_tags_and_categories_cb', 10 );
	add_action( 'appku_blog_details_post_navigation', 'appku_blog_details_post_navigation_cb', 10 );

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'appku_blog_details_comments', 'appku_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('appku_blog_details_col_start','appku_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('appku_blog_details_col_end','appku_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('appku_blog_details_wrapper_end','appku_blog_details_wrapper_end_cb');

	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('appku_blog_post_thumb','appku_blog_post_thumb_cb');

	/**
	* Hook for Blog Post Content
	*/
	add_action('appku_blog_post_content','appku_blog_post_content_cb');


	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('appku_blog_postexcerpt_read_content','appku_blog_postexcerpt_read_content_cb');

	/**
	* Hook for footer content
	*/
	add_action( 'appku_footer_content', 'appku_footer_content_cb', 10 );

	/**
	* Hook for main wrapper end
	*/
	add_action( 'appku_main_wrapper_end', 'appku_main_wrapper_end_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'appku_page_start_wrap', 'appku_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'appku_page_end_wrap', 'appku_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'appku_page_col_start_wrap', 'appku_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'appku_page_col_end_wrap', 'appku_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'appku_page_sidebar', 'appku_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'appku_page_content', 'appku_page_content_cb', 10 );