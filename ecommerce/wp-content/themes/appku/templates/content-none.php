<?php

/**
 * @Packge 	   : Appku
 * @Version    : 1.0
 * @Author 	   : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}

$allowhtml = array(
    'p'         => array(
        'class'     => array()
    ),
    'span'      => array(),
    'a'         => array(
        'href'      => array(),
        'title'     => array(),
        'class'     => array(),
    ),
    'br'        => array(),
    'em'        => array(),
    'strong'    => array(),
    'b'         => array(),
);

?>
<div class="col-lg-12 grid-item mb-4 pb-1">
	<h4 class="page-title"><?php esc_html_e( 'Nothing Found', 'appku' ); ?></h4>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	    <p  class="nof-desc mb-0"><?php echo sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'appku' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	    <p class="nof-desc mb-0"><?php esc_html_e( 'Sorry, We could not find any results for your search. You can give it another try through the search form below. Please try again with some different keywords.', 'appku' ); ?></p>
    	<div class="content-none-search">
			<div class="widget widget_search mb-0">
				<?php get_search_form(); ?>
			</div>
		</div>

	<?php else : ?>

	    <p class="nof-desc "><?php wp_kses( _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'appku' ), $allowhtml ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>