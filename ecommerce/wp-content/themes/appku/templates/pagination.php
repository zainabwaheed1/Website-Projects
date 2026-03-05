<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    $prev_link = get_previous_posts_link();
    $next_link = get_next_posts_link();
    // as suggested in comments
    if ($prev_link || $next_link) :
?>
<!-- Post Pagination -->

<div class="row">
    <div class="col-md-12 pagi-area text-center">
        <nav aria-label="navigation">
            <?php
                $prev   = '<i class="fas fa-angle-double-left"></i>';
                $next   = '<i class="fas fa-angle-double-right"></i>';


                global $wp_query;
                $links = paginate_links( array(
                    'current' => max( 1, get_query_var( 'paged' ) ),
                    'total'   => $wp_query->max_num_pages,
                    'type'    => 'list',
                    'prev_text'          => '<i class="fas fa-angle-double-left"></i>',
                    'next_text'          => '<i class="fas fa-angle-double-right"></i>',

                ) );

                $links = str_replace( "page-numbers", "pagination", $links );

                echo wp_kses_post( $links );
            ?>
        </nav>
    </div>
</div>
<!-- End of Post Pagination -->
<?php
    endif;