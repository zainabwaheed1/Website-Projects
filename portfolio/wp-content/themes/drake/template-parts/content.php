<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="blog-item">
    <div class="blog-thumbnail">
        <?php the_post_thumbnail('drake-blog-standard'); ?>
    </div>
    <div class="blog-item-content">
        <ul class="meta">
            <li>
                <a class="author">
                   <i class="lar la-user-circle"></i><?php the_time(get_option('date_format')) ?>
                </a>
            </li>
            <li>
                 <?php if(has_category()) { ?>
                <a href="#" class="comments"><?php drake_category();?><?php } ?></a>
            </li>
        </ul>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e ('Read More','drake' ); ?></a>
    </div>
</div> 

</div> 