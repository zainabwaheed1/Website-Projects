<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// enqueue css
function appku_common_custom_css(){
	wp_enqueue_style( 'appku-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = appku_opt( 'appku_css_editor' );
    $preloader_display  =  appku_opt('appku_display_preloader');
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";
    
    if( get_header_image() ){
        $appku_header_bg =  get_header_image();
    }else{
        if( appku_meta( 'page_breadcrumb_settings' ) == 'page' && is_page() ){
            if( ! empty( appku_meta( 'breadcumb_image' ) ) ){
                $appku_header_bg = appku_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $appku_header_bg ) ){
        $customcss .= ".breadcrumb-area{
            background:url('{$appku_header_bg}');
            background-position: top;
            background-size: contain;
        }";
    }
    if( !empty( $preloader_display ) ){
        $appku_pre_img = appku_opt( 'appku_preloader_img','url' );
        if( ! empty( appku_opt( 'appku_preloader_img','url' ) ) ){
            $customcss .= ".se-pre-con{
                background:url('{$appku_pre_img}')!important;
                text-align: center;
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                text-align: center;
                line-height: 1;
                width: 96px;
                height: 48px;
                display: inline-block;
                position: relative;
                background: #fff;
                border-radius: 48px 48px 0 0;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                overflow: hidden;
                            }";
        }
    }
    
	// theme color
	$appkuthemecolor = appku_opt('appku_theme_color');

    list($r, $g, $b) = sscanf( $appkuthemecolor, "#%02x%02x%02x");

    $appku_real_color = $r.','.$g.','.$b;
	if( !empty( $appkuthemecolor ) ) {
		$customcss .= ":root {
		  --color-primary: rgb({$appku_real_color});
		}";
	}

	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'appku-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'appku_common_custom_css', 100 );