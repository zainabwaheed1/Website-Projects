<?php

/**
 * drake functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package drake
 */

/**
 * Required Files
 */

 require_once get_template_directory() . '/inc/drake-class-wp-bootstrap-navwalker.php';

require_once get_template_directory() . '/inc/redux/config.php';
require_once get_template_directory() . '/inc/redux/color.php';

// /*TGM PLUGIN*/
require_once get_template_directory() . '/tgm-plugin/recommend_plugins.php';

/**
 * Enqueue Google Fonts
 */

function drake_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'drake' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Inter:100,200,300,400,500,600,700,800,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
        }
    return $font_url;
}

/**
 * Register and Enqueue Styles.
 */

function drake_register_styles() {
    
    wp_enqueue_style( 'line-awesome','https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css' );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );

    wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' );

    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );

    wp_enqueue_style( 'smooth-scrollbar', get_template_directory_uri() . '/assets/css/smooth-scrollbar.css' );

    wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/assets/css/lightbox.min.css' );

    wp_enqueue_style( 'drake-style', get_template_directory_uri() . '/assets/css/style.css' );

    wp_enqueue_style( 'unit-test', get_template_directory_uri() . '/assets/css/unit-test.css' );
    
    wp_enqueue_style( 'drake-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );

    wp_enqueue_style( 'drake-fonts', drake_fonts_url(), array(), '1.0.0' );


    if( class_exists( 'ReduxFrameworkPlugin' ) ) { 

    global $drake_options; 

    if ($drake_options['main_color_drake'] == 1) {
    
    }

    elseif ($drake_options['main_color_drake'] == 2) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-2.css' );
    } 

    elseif ($drake_options['main_color_drake'] == 3) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-3.css' );
    } 

    elseif ($drake_options['main_color_drake'] == 4) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-4.css' );
    } 

    elseif ($drake_options['main_color_drake'] == 5) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-5.css' );
    } 

    elseif ($drake_options['main_color_drake'] == 6) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-6.css' );
    }

    elseif ($drake_options['main_color_drake'] == 7) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-7.css' );
    } 

    elseif ($drake_options['main_color_drake'] == 8) {
    wp_enqueue_style( 'drake-color', get_template_directory_uri() . '/assets/css/theme-color/color-8.css' );
    }  

    } 

}
add_action( 'wp_enqueue_scripts', 'drake_register_styles' );


/**
 * Register and Enqueue Scripts.
 */

function drake_register_scripts() {

    wp_enqueue_script(
        'drake-jquery',
        get_template_directory_uri() . '/assets/js/jquery.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'bootstrap-bundle',
        get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'owl-carousel',
        get_template_directory_uri() . '/assets/js/owl.carousel.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'gsap',
        get_template_directory_uri() . '/assets/js/gsap.min.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'ScrollTrigger',
        get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'ScrollToPlugin',
        get_template_directory_uri() . '/assets/js/ScrollToPlugin.min.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'lightbox',
        get_template_directory_uri() . '/assets/js/lightbox.min.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'drake-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'ajax-form',
        get_template_directory_uri() . '/assets/js/ajax-form.js',
        array( 'jquery' ),
        '',
        true
    );

    wp_enqueue_script(
        'drake-color',
        get_template_directory_uri() . '/assets/js/color.js',
        array( 'jquery' ),
        '',
        true
    );
}

add_action( 'wp_enqueue_scripts', 'drake_register_scripts' );

/**
 * drake Theme Configuration
 */

function drake_theme_config(){

    // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
         add_theme_support( 'post-thumbnails' );

        // add_image_size( 'drake-blog', 350, 262, false);
         add_image_size( 'drake-blog-standard', 705, 330, false);
        // add_image_size( 'drake-blog-sidebar', 730, 400, false);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',

        ) );

    if ( ! isset( $content_width ) ) $content_width = 900;

    $drake_lang = get_template_directory_uri() . '/languages';
    load_theme_textdomain('drake', $drake_lang);

    if( class_exists( 'ReduxFrameworkPlugin' ) ) { 
            register_nav_menus(
                array(
                'main-menu' => esc_html__( 'Main Menu', 'drake' ),
                )
            ); 
        } else
        {
            register_nav_menus(
                array(
                'main-menu' => esc_html__( 'Main Menu', 'drake' ),
                )
            ); 
        }
}

add_action( 'after_setup_theme', 'drake_theme_config' , 0 );

function drake_category() {

$categories = get_the_category();

$separator = ' ';

$output = '';

if($categories){

  foreach($categories as $category) {

      $output .= '<a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>'.$separator;

  }

  echo trim($output, $separator);

}

}

function drake_pagination() {

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) return; 

$big = 999999999; // need an unlikely integer

$pages = paginate_links( array(
        'prev_text' => wp_specialchars_decode('<i class="las la-angle-double-left"></i>',ENT_QUOTES),
        'next_text' => wp_specialchars_decode('<i class="las la-angle-double-right"></i>',ENT_QUOTES),
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<nav aria-label="navigation"><ul class="pagination">';
        foreach ( $pages as $page ) {
                echo "<li class='page-item'>$page</li>";
        }
       echo '</ul></nav>';
        }
}

// Tag Cloud
add_filter( 'widget_tag_cloud_args', 'drake_change_tag_cloud_font_sizes');
function drake_change_tag_cloud_font_sizes( array $args ) {
    $args['default'] = '13';
    $args['smallest'] = '13';
    $args['largest'] = '13';
    $args['unit'] = 'px';

    return $args;
}

/**
 * drake Register Widgets
 */

add_action( 'widgets_init', 'drake_widgets_init' );
function drake_widgets_init() {

        register_sidebar( array(
        'name' => esc_html__( 'Main Sidebar', 'drake' ),
        'id' => 'main-sidebar',
        'description' => esc_html__( 'Widgets in this area will be shown on all posts and pages.', 'drake' ),
        'before_widget' => '<div id="%1$s" class="blog-sidebar-item blog-latest-posts %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}

function drake_import_files() {
    return array(

        array(
            'import_file_name'           => 'Drake Personal Portfolio',
            'import_file_url'            => 'https://wpriverthemes.com/import/drake-alpha/data.xml',
            'import_widget_file_url'     => 'https://wpriverthemes.com/import/drake-alpha/widget.wie',
            'import_customizer_file_url' => 'https://wpriverthemes.com/import/drake-alpha/custom.dat',
            'import_redux'               => array(
                array(
                    'file_url'    => 'https://wpriverthemes.com/import/drake-alpha/redux.json',
                    'option_name' => 'drake_options',
                ),
            ),
            'import_notice'                => esc_html__( 'Import process may take 2-5 minutes. If you facing any issues please contact our support.', 'drake' ),
            'preview_url'                => 'https://wpriverthemes.com/drake/',
        ),


    );
}
add_filter( 'pt-ocdi/import_files', 'drake_import_files' );

// drake Comments Display

function drake_theme_comment($comment, $args, $depth) {
    //echo 's';
   $GLOBALS['comment'] = $comment;
   $gravatar = get_avatar($comment,$size='100' ); ?>
    <div class="comment-item">
        <div class="comment-body">
            <div class="comment-avatar">
                <?php echo get_avatar($comment,$size='80' ); ?>
            </div>

            <div class="comment-content">
                <h4><?php printf( get_comment_author_link()) ?><span class="date"><?php the_time('F j, Y'); ?></span></h4>
                
                <p><?php comment_text() ?></p>
                 <?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply' , 'depth' => $depth,'max_depth' => $args['max_depth']))) ?>
            </div>
        </div>
    </div>
<?php
}

