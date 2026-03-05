<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package drake
 */
?>

<div class="blog-details-content blog-item">
    <div class="blog-thumbnail">
        <?php the_post_thumbnail('drake-blog-standard'); ?>
    </div>
    <ul class="meta">
        <li>
            <a class="author">
                <i class="lar la-user-circle"></i> <?php the_time(get_option('date_format')) ?>
            </a>
        </li>
        <li>
            <a href="#" class="comments"> <?php drake_category();?><?php ?>
            </a>
        </li>
    </ul>
    <p><?php the_content(); ?></p>

    <ul class="tags">
     <li><?php the_tags('','',); ?></li>
    </ul>
</div>

