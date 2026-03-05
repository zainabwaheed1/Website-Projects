<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

echo '<!-- Single Post -->';
?>
<div <?php post_class(); ?> >
<?php
	if(has_post_thumbnail( )){
		$class = 'item';
	}else{
		$class = 'item thumb-less';
	}
	echo '<div class="'.esc_attr($class).'">';
	    // Blog Post Thumbnail
	    do_action( 'appku_blog_post_thumb' );

	    echo '<div class="info">';
	        // Blog Post Content
	        do_action( 'appku_blog_post_content' );
	        // Excerpt And Read More Button
	        do_action( 'appku_blog_postexcerpt_read_content' );
	    echo '</div>';
    echo '</div>';
echo '</div>';
echo '<!-- End Single Post -->';