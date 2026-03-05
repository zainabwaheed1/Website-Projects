<?php
/*
 * Template Name: Blog page
 */
get_header('pages'); ?>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post();       
  the_content(); // displays whatever you wrote in the wordpress editor
  endwhile; endif; //ends the loop
 ?>

 <!-- Start Breadcrumb 
============================================= -->
<section class="breadcrumb-area">
    <div class="custom-container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1><?php the_title(); ?></h1>
                    <ul class="breadcrumbs">
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Home', 'drake' )?></a> <i class="las la-angle-right"></i>
                        </li>
                        <li><?php the_title(); ?></li>
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

<?php get_footer('v1'); ?>