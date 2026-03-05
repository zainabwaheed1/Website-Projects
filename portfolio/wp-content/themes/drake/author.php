<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package drake
 */

if( class_exists( 'ReduxFrameworkPlugin' ) ) { 
    get_header('pages');
}
else {
    get_header();
}
?>

<!-- Start Breadcrumb 
============================================= -->
<section class="breadcrumb-area">
    <div class="custom-container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1><?php esc_html_e('All posts by ' , 'drake' ); echo get_the_author(); ?></h1>
                    <ul class="breadcrumbs">
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Home', 'drake' )?></a> <i class="las la-angle-right"></i>
                        </li>
                        <li><?php esc_html_e( 'Author Archives', 'drake' )?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcrumb -->

<!-- Start Blog
============================================= -->
<section class="blog-content-area">
    <div class="custom-container">
        <div class="row">
            <?php if ( is_active_sidebar( 'main-sidebar' ) ) : { ?>
            <div class="col-md-8">
                 <?php } else : ?>
                 <div class="col-lg-12">
                <?php endif; ?>
                <div class="blog-items">
                    <?php 
                        if ( have_posts() ) : 
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/content', 'single' );
                        endwhile; 
                        endif; 
                    ?>
                </div>
                <div class="pagi-area">
                    <?php echo drake_pagination(); ?>
                </div>
            </div>
            <div class="col-md-4">
                <aside class="blog-sidebar">
                    <?php get_sidebar(); ?>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- End Blog -->



<?php if( class_exists( 'ReduxFrameworkPlugin' ) ) { 
    get_footer('v1');
}
else {
    get_footer();
}
