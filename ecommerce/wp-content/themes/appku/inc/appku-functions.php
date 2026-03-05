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
    exit;
}

 // theme option callback
function appku_opt( $id = null, $url = null ){
    global $appku_opt;

    if( $id && $url ){

        if( isset( $appku_opt[$id][$url] ) && $appku_opt[$id][$url] ){
            return $appku_opt[$id][$url];
        }
    }else{
        if( isset( $appku_opt[$id] )  && $appku_opt[$id] ){
            return $appku_opt[$id];
        }
    }
}


// theme logo withour moble device

function appku_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= appku_img_tag( array(
            "class" => "img-fluid",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !appku_opt('appku_text_title') && appku_opt('appku_site_logo', 'url' )  ){

        $siteLogo = '<img class="logo" src="'.esc_url( appku_opt('appku_site_logo', 'url' ) ).'" alt="'.esc_attr( get_bloginfo('name') ).'" />';
        return '<a class="navbar-brand" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';
    }elseif( appku_opt('appku_text_title') ){
        return '<h2 class="logo-text"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( appku_opt('appku_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="logo-text"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// theme logo for mobile device
function appku_mobile_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= appku_img_tag( array(
            "class" => "img-fluid",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !appku_opt('appku_text_title') && appku_opt('appku_site_logo', 'url' )  ){

        $siteLogo = '<img class="logo" src="'.esc_url( appku_opt('appku_site_logo', 'url' ) ).'" alt="'.esc_attr( get_bloginfo('name') ).'" />';
        return '<a class="mob-logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';
    }elseif( appku_opt('appku_text_title') ){
        return '<h2 class="logo-text"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( appku_opt('appku_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="logo-text"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}
// custom meta id callback
function appku_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_appku_'.$id, true );
    return $value;
}


// Blog Date Permalink
function appku_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function appku_iframe_match() {
    $audio_content = appku_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function appku_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function appku_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'appku' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'appku' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}

// image alt tag
function appku_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function appku_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function appku_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'appku_pingback_header' );


// Excerpt More
function appku_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'appku_excerpt_more' );


// appku comment template callback
function appku_comment_callback( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment; ?>

    <div class="comment-item" id="comment-<?php comment_ID(); ?>"> 
        <?php if ( $avarta = get_avatar( $comment ) ) :
            printf( '<div class="avatar">%1$s</div>', $avarta );
        endif; ?>
        <div class='content'>
            <div class="title">
                <?php 
                    if ( $comment->user_id != '0' ) {
                        printf( '<h5>%1$s</h5>', get_user_meta( $comment->user_id, 'nickname', true ) );
                    } else {
                        printf( '<h5>%1$s</h5>', get_comment_author_link() );
                    }
                ?>
                <span><?php echo get_comment_date( 'j M Y' ); ?></span>
                <span><?php $edit_reply_text = esc_html__( 'Edit', 'appku' ); edit_comment_link( '<i class="fal fa-pencil"></i>'.$edit_reply_text, '  ', '' ); ?></span>
            </div>    
           
            <?php comment_text() ?>
            <div class='comments-info'>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <span class="unapproved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'appku' ); ?></span>
                <?php endif; ?>
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text' => '<i class="fa fa-reply"></i>Reply' ) ) ) ?>
            </div>
            
        </div>
    </div>
<?php
}

//body class
add_filter( 'body_class', 'appku_body_class' );
function appku_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $appku_blog_single_sidebar = appku_opt('appku_blog_single_sidebar');


        if(is_active_sidebar('appku-blog-sidebar')){
            if($appku_blog_single_sidebar == '2'){
                $classes[] = 'left-sidebar';
            }elseif($appku_blog_single_sidebar == '3'){
                $classes[] = 'right-sidebar';
            }else{
                $classes[] = 'blog-standard';
            }
        }else{
           $classes[] = 'blog-standard'; 
        }

    } else {
        if( !is_active_sidebar('appku-blog-sidebar') ) {
            $classes[] = 'blog-standard';
        }else{
            $classes[] = 'right-sidebar';
        }
    }
    return $classes;
}


function appku_footer_global_option(){

    // Appku Footer Bottom Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $appku_footer_bottom_active = appku_opt( 'appku_disable_footer_bottom' );
    }else{
        $appku_footer_bottom_active = '1';
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
    );       
    echo '<footer class="text-light footer-custom-style">';
        if( ( is_active_sidebar( 'appku-footer-1' ) || is_active_sidebar( 'appku-footer-2' ) || is_active_sidebar( 'appku-footer-3' ) || is_active_sidebar( 'appku-footer-4' ) )) {
            echo '<div class="container">';
                echo '<div class="f-items default-padding">';
                    echo '<div class="row">';
                    if( is_active_sidebar( 'appku-footer-1' )){
                       dynamic_sidebar( 'appku-footer-1' ); 
                    }
                    if( is_active_sidebar( 'appku-footer-2' )){
                       dynamic_sidebar( 'appku-footer-2' ); 
                    }
                    if( is_active_sidebar( 'appku-footer-3' )){
                       dynamic_sidebar( 'appku-footer-3' ); 
                    } 
                    if( is_active_sidebar( 'appku-footer-4' )){
                       dynamic_sidebar( 'appku-footer-4' ); 
                    }  
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        if( $appku_footer_bottom_active == '1' ){
            if( ! empty( appku_opt( 'appku_copyright_text' ) ) ){
                echo '<!-- Start Footer Bottom -->';
                echo '<div class="footer-bottom">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-lg-6">';
                                echo '<p class="text-start">'.wp_kses( appku_opt( 'appku_copyright_text' ), $allowhtml ).'</p>';
                            echo '</div>';
                            if( has_nav_menu( 'footer-menu' ) ){
                                echo '<div class="col-lg-6 text-end link">';
                                    wp_nav_menu( array(
                                        'theme_location'  => 'footer-menu',
                                    ) );

                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<!-- End Footer Bottom -->';
            }
        }
    echo '</footer>';
}

function appku_social_icon(){
    $appku_social_icon = appku_opt( 'appku_social_links' );
    if( ! empty( $appku_social_icon ) && isset( $appku_social_icon ) ){
        foreach( $appku_social_icon as $social_icon ){
            if( ! empty( $social_icon['title'] ) ){
                echo '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i>'.esc_html( $social_icon['description'] ).'</a>';
            }
        }
    }
}

// global header
function appku_global_header_option() {

    echo '<header>';
        if( class_exists( 'ReduxFramework' ) ){
            $appku_btn      = appku_opt( 'appku_btn_text' );
            $appku_btn_url  = appku_opt( 'appku_btn_url' );
        }else{
            $appku_btn      = '';
            $appku_btn_url  = '';
        }
        echo '<nav class="navbar mobile-sidenav navbar-common navbar-sticky navbar-default validnavs">';


            echo '<div class="container d-flex justify-content-between align-items-center">';            

                echo '<!-- Start Header Navigation -->';
                echo '<div class="navbar-header">';
                    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>';
                   echo appku_theme_logo();
                echo '</div>';
                echo '<!-- End Header Navigation -->';

                echo '<!-- Collect the nav links, forms, and other content for toggling -->';
                echo '<div class="collapse navbar-collapse" id="navbar-menu">';
                    echo appku_mobile_theme_logo();
                    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-times"></i></button>';
                    if( has_nav_menu('primary-menu') ) {
                        wp_nav_menu( array(
                            'theme_location'  => 'primary-menu',
                            'container'       => 'ul',
                            'menu_class'      => 'nav navbar-nav navbar-right',
                            'fallback_cb'     => 'Appku_Bootstrap_Navwalker::fallback',
                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>',
                            'walker'          => new Appku_Bootstrap_Navwalker(),
                        ) );
                    }
                    
                echo '</div><!-- /.navbar-collapse -->';
                if( $appku_btn ){
                    echo '<div class="attr-right">';
                       echo ' <!-- Start Atribute Navigation --><div class="attr-nav"><ul><li class="button"><a href="'.esc_url(appku_opt( 'appku_btn_url' )).'">'.esc_html(appku_opt( 'appku_btn_text' )).'</a></li></ul></div>';
                    echo '</div>';
                        echo '<!-- End Atribute Navigation -->';
                }

                echo '<!-- Main Nav -->';
            echo '</div> ';  
            echo '<!-- Overlay screen for menu -->';
            echo '<div class="overlay-screen"></div>';
            echo '<!-- End Overlay screen for menu -->';
        echo '</nav>';
    echo '</header>';
}

//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'appku_remove_tagcloud_inline_style',10,1 );
function appku_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

function appku_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function appku_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'appku' );
    }
    return $count;
}

// password protected form
add_filter('the_password_form','appku_password_form',10,1);
function appku_password_form( $output ) {
    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post"><div class="theme-input-group">
        <input name="post_password" type="password" class="theme-input-style" placeholder="'.esc_attr__( 'Enter Password','appku' ).'">
        <button type="submit" class="submit-btn btn-fill">'.esc_html__( 'Enter','appku' ).'</button></div></form>';
    return $output;
}

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'appku_cat_count_span' );
function appku_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'appku_archive_count_span' );
function appku_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">(', $links);
    $links = str_replace(')', ')</span>', $links);
	return $links;
}


if( ! function_exists( 'appku_blog_category' ) ){
    function appku_blog_category(){
        if( class_exists( 'ReduxFramework' ) ){
            $appku_display_post_category =  appku_opt('appku_display_post_category');
        }else{
            $appku_display_post_category = '1';
        }

        if( $appku_display_post_category ){
            $appku_post_categories = get_the_category();
            if( is_array( $appku_post_categories ) && ! empty( $appku_post_categories ) ){
                if( appku_opt( 'appku_blog_style' ) == '2' ){
                    $padding_class = 'mb-20';
                }else{
                    $padding_class = '';
                }
                echo '<div class="blog-category '.esc_attr( $padding_class ).'">';
                    echo ' <a href="'.esc_url( get_term_link( $appku_post_categories[0]->term_id ) ).'">'.esc_html( $appku_post_categories[0]->name ).'</a> ';
                echo '</div>';
            }
        }
    }
}

// Add Extra Class On Comment Reply Button
function appku_custom_comment_reply_link( $content ) {
    $extra_classes = 'replay-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'appku_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function appku_custom_edit_comment_link( $content ) {
    $extra_classes = 'replay-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'appku_custom_edit_comment_link', 99);


function appku_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        if( ! is_single() ){
            if( appku_opt( 'appku_blog_style' ) == '3' ){
                $classes[] = "item grid-wide";
            }else{
                $classes[] = "single-item";
            }
        }else{
            $classes[] = "item";
        }
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }

    return $classes;
}
add_filter( 'post_class', 'appku_post_classes', 10, 3 );