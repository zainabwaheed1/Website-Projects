<?php
/**
 * Header file for the drake WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drake
 */

?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.png'); ?>">

    
<?php  wp_head(); ?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	
<main class="blog-leftsidebar-main">

<header class="header-area">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-md-2 col-sm-6">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="<?php echo esc_attr__( 'Logo', 'drake' )?>">
                </a>
            </div>
            <div class="col-md-10 col-sm-6">
                <div class="header-right">
                <i class="las la-bars show-menu-toggle"></i>

                   <nav>
                    <i class="las la-times close-menu"></i>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <?php 
                    wp_nav_menu( array(

                    'theme_location'  => 'main-menu',
                    'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'       => 'ul',
                    'menu_class'      => 'nav-menu align-center justify-content-end',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'items_wrap'      => '<ul data-in="#" data-out="#" class="%2$s" id="%1$s">%3$s</ul>',
                    'walker'          => new Drake_Bootstrap_Navwalker(),
                    ) );
                    ?> 
                </nav> 
                   
                </div>
            </div>
        </div>
    </div>
</header>

