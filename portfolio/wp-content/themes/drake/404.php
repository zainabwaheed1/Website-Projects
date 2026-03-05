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
                    <h1><?php esc_html_e('Error Page','drake' ); ?></h1>
                    <ul class="breadcrumbs">
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Home', 'drake' )?></a> <i class="las la-angle-right"></i>
                        </li>
                        <li><?php esc_html_e( '404 Error', 'drake' )?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcrumb -->

<!-- Start 404 
============================================= -->

<div class="error-page-area relative text-center">
<div class="container">
    <div class="error-box default-padding">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1><?php esc_html_e( '404', 'drake' )?></h1>
            <h2><?php esc_html_e( 'SORRY PAGE WAS NOT FOUND!', 'drake' )?></h2>
                <div class="sidebar-item search">
<div class="sidebar-info">
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type='search' name="s" placeholder="<?php esc_attr_e( 'Search Here...', 'drake' )?>" class="form-control" id="search-box" value="<?php the_search_query(); ?>" >
    <button type="submit"><i class="las la-search"></i></button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- End 404 -->


<?php if( class_exists( 'ReduxFrameworkPlugin' ) ) { 
    get_footer('v1');
}
else {
    get_footer();
}
