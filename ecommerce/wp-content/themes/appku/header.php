<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="NuEWVUNMDoslBRG3nfriUWEppsaCPn86yGKMxNDnGrY" />
    <?php wp_head();?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>

    <!-- Google tag (gtag.js) -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CRQR0VSYHH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-CRQR0VSYHH');
</script>
    
</head>
<body <?php body_class(); ?>>
	
	
	 <!--custom cursor start  -->
    <div id="cursor"></div>
    <div id="cursor-border"></div>
    <!--custom cursor start  -->
	
	<!-- Custom Chat Bot -->
	<script src="https://chatbot.beyonderissolutions.com/scripts/bundle.js"></script>	
<?php
    wp_body_open();

    /**
    *
    * Preloader
    *
    * Hook appku_preloader_wrap
    *
    * @Hooked appku_preloader_wrap_cb 10
    *
    */
    do_action( 'appku_preloader_wrap' );

    /**
    *
    * appku header
    *
    * Hook appku_header
    *
    * @Hooked appku_header_cb 10
    *
    */
    do_action( 'appku_header' );