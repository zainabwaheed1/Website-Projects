<div class="blog-sidebar-item blog-sidebar-search">
    <form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type='search' name="s" placeholder="<?php esc_attr_e( 'Search Here...', 'drake' )?>" class="form-control" id="search-box" value="<?php the_search_query(); ?>">                   
        <button><i class="las la-search"></i></button>
    </form>
</div>


