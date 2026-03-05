(function($){
    "use strict";
    
    let $appku_page_breadcrumb_area      = $("#_appku_page_breadcrumb_area");
    let $appku_page_settings             = $("#_appku_page_breadcrumb_settings");
    let $appku_page_breadcrumb_image     = $("#_appku_breadcumb_image");
    let $appku_page_title                = $("#_appku_page_title");
    let $appku_page_title_settings       = $("#_appku_page_title_settings");

    if( $appku_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--appku-page-breadcrumb-settings").show();
        if( $appku_page_settings.val() == 'global' ) {
            $(".cmb2-id--appku-breadcumb-image").hide();
            $(".cmb2-id--appku-page-title").hide();
            $(".cmb2-id--appku-page-title-settings").hide();
            $(".cmb2-id--appku-custom-page-title").hide();
            $(".cmb2-id--appku-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--appku-breadcumb-image").show();
            $(".cmb2-id--appku-page-title").show();
            $(".cmb2-id--appku-page-breadcrumb-trigger").show();
    
            if( $appku_page_title.val() == '1' ) {
                $(".cmb2-id--appku-page-title-settings").show();
                if( $appku_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--appku-custom-page-title").hide();
                } else {
                    $(".cmb2-id--appku-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--appku-page-title-settings").hide();
                $(".cmb2-id--appku-custom-page-title").hide();
    
            }
        }
    } else {
        $appku_page_breadcrumb_area.parents('.cmb2-id--appku-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $appku_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--appku-page-breadcrumb-settings").show();
            if( $appku_page_settings.val() == 'global' ) {
                $(".cmb2-id--appku-breadcumb-image").hide();
                $(".cmb2-id--appku-page-title").hide();
                $(".cmb2-id--appku-page-title-settings").hide();
                $(".cmb2-id--appku-custom-page-title").hide();
                $(".cmb2-id--appku-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--appku-breadcumb-image").show();
                $(".cmb2-id--appku-page-title").show();
                $(".cmb2-id--appku-page-breadcrumb-trigger").show();
        
                if( $appku_page_title.val() == '1' ) {
                    $(".cmb2-id--appku-page-title-settings").show();
                    if( $appku_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--appku-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--appku-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--appku-page-title-settings").hide();
                    $(".cmb2-id--appku-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--appku-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $appku_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--appku-page-title-settings").show();
            if( $appku_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--appku-custom-page-title").hide();
            } else {
                $(".cmb2-id--appku-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--appku-page-title-settings").hide();
            $(".cmb2-id--appku-custom-page-title").hide();

        }
    });

    //page settings
    $appku_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--appku-breadcumb-image").hide();
            $(".cmb2-id--appku-page-title").hide();
            $(".cmb2-id--appku-page-title-settings").hide();
            $(".cmb2-id--appku-custom-page-title").hide();
            $(".cmb2-id--appku-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--appku-breadcumb-image").show();
            $(".cmb2-id--appku-page-title").show();
            $(".cmb2-id--appku-page-breadcrumb-trigger").show();
    
            if( $appku_page_title.val() == '1' ) {
                $(".cmb2-id--appku-page-title-settings").show();
                if( $appku_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--appku-custom-page-title").hide();
                } else {
                    $(".cmb2-id--appku-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--appku-page-title-settings").hide();
                $(".cmb2-id--appku-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $appku_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--appku-custom-page-title").hide();
        } else {
            $(".cmb2-id--appku-custom-page-title").show();
        }
    });
    
})(jQuery);