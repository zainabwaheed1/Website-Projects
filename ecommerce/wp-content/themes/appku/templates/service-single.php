<?php
/**
 * Template Name: Service Single
 * Description: The template file for displaying service single pages
 *
 * @package Appku
 */

get_header();?>
	<div class="services-details-area">
        <div class="container">
            <div class="services-details-items">
            <?php
             while ( have_posts() ) : the_post();

				the_content();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
            </div>
        </div>
    </div>
    
<?php 
get_footer();