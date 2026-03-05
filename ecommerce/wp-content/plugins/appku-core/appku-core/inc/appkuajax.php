<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function appku_core_essential_scripts( ) {
    wp_enqueue_script('appku-ajax',APPKU_PLUGDIRURI.'assets/js/appku.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'appku-ajax',
    'appkuajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'appku-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','appku_core_essential_scripts');


// appku Section subscribe ajax callback function
add_action( 'wp_ajax_appku_subscribe_ajax', 'appku_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_appku_subscribe_ajax', 'appku_subscribe_ajax' );

function appku_subscribe_ajax( ){
  $apiKey = appku_opt('appku_subscribe_apikey');
  $listid = appku_opt('appku_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'appku-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'appku').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);
           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'appku').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'appku').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'appku').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'appku').'</div>';
        }
   }

   wp_die();

}