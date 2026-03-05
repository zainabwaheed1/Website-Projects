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
    appku_setPostViews( get_the_ID() );
    ?>
    <div <?php post_class(); ?> >
        <div class="blog-item-box">
        <?php
            if( class_exists('ReduxFramework') ) {
                $appku_post_details_title_position = appku_opt('appku_post_details_title_position');
            } else {
                $appku_post_details_title_position = 'header';
            }

            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );

            // Blog Post Thumbnail
            do_action( 'appku_blog_post_thumb' );

            if( $appku_post_details_title_position != 'header' ) {
                echo '<h3>'.wp_kses( get_the_title(), $allowhtml ).'</h3>';
            }
            echo '<div class="info">';
                // Blog Post Meta
                do_action( 'appku_blog_post_meta' );

                if( get_the_content() ){
                    echo '<div class="blog-content">';
                        the_content();
                        // Link Pages
                        appku_link_pages();
                    echo '</div>';
                }
            echo '</div>';        
        echo '</div>';
    echo '</div>';
    /**
    *
    * Hook for Blog Details Author Bio
    *
    * Hook appku_blog_details_author_bio
    *
    * @Hooked appku_blog_details_author_bio_cb 10
    *
    */
    do_action( 'appku_blog_details_author_bio' );

    $appku_post_tag = get_the_tags();
    if( class_exists('ReduxFramework') ) {
        $appku_post_details_share_options = appku_opt('appku_post_details_share_options');
        $appku_show_post_tag = appku_opt( 'appku_display_post_tags' );
    } else {
        $appku_show_post_tag = true;
        $appku_post_details_share_options = false;
    }

    if( ! empty( $appku_post_tag ) && $appku_show_post_tag || $appku_post_details_share_options ){
        echo '<div class="post-tags share">';
            if( $appku_show_post_tag  && is_array( $appku_post_tag ) && ! empty( $appku_post_tag ) ){
                if( count( $appku_post_tag ) > 1 ){
                    $tag_text = __( 'Tags: ', 'appku' );
                }else{
                    $tag_text = __( 'Tag: ', 'appku' );
                }
                echo '<div class="tags">';
                    echo '<h4>'.esc_html( $tag_text ).'</h4>';
                    foreach( $appku_post_tag as $tags ){
                        echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a> ';
                    }
                echo '</div>';
            }
            /**
            *
            * Hook for Blog Social Share Options
            *
            * Hook appku_blog_details_share_options
            *
            * @Hooked appku_blog_details_share_options_cb 10
            *
            */
            do_action( 'appku_blog_details_share_options' );
            
        echo '</div>';
        
    }

    /**
    *
    * Hook for Blog Navigation
    *
    * Hook appku_blog_details_post_navigation
    *
    * @Hooked appku_blog_details_post_navigation_cb 10
    *
    */
    do_action( 'appku_blog_details_post_navigation' );

    /**
    *
    * Hook for Blog Details Comments
    *
    * Hook appku_blog_details_comments
    *
    * @Hooked appku_blog_details_comments_cb 10
    *
    */
    do_action( 'appku_blog_details_comments' );