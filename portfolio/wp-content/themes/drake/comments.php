<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<?php if ( have_comments() ) : ?>
    <div class="comments-area">
    <h3><?php comments_number( esc_html__('0 Comment', 'drake'), esc_html__('1 Comment', 'drake'), esc_html__('% Comments', 'drake') ); ?></h3>
    <ul class="comments">
        <li class="comments-list">
        <?php wp_list_comments('callback=drake_theme_comment'); ?>
        </li>
    </ul>
</div>

<?php
// Are there comments to navigate through?
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
<div class="text-center">
<ul class="pagination">
<li>
<?php //Create pagination links for the comments on the current post, with single arrow heads for previous/next
paginate_comments_links( 
array(
'prev_text' => wp_specialchars_decode('<i class="fa fa-angle-left"></i>',ENT_QUOTES),
'next_text' => wp_specialchars_decode('<i class="fa fa-angle-right"></i>',ENT_QUOTES),
));  ?>
</li> 
</ul>
</div>
<?php endif; // Check for comment navigation ?>
<?php if ( ! comments_open() && get_comments_number() ) : ?>
<p class="no-comments"><?php echo esc_html__( 'Comments are closed.' , 'drake' ); ?></p>
<?php endif; ?> 
<?php endif; ?>





<?php
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                'id_form' => '',        
                'class_form' => '', 
                'title_reply_before'=> '<h3>',                
                'title_reply'=> esc_html__( 'Leave a Comment', 'drake' ),
                'title_reply_after'=> '</h3>',
                'fields' => apply_filters( 'comment_form_default_fields', array(
                    'cookies' => '',
                    'author' => '<div class="row">
    <div class="col-md-6">
        <div class="input-group">
            <!-- Name -->
            <input  type="text"  placeholder="'. esc_attr__('Name', 'drake').'" >
        </div>
    </div>',
                    
                    'email' =>'
                     <div class="col-md-6">
        <div class="input-group">
        <input type="email" placeholder="'.esc_attr__('Email', 'drake').'" >
        </div>
</div></div>'  ,                                                                                 
              ) ), 

                'comment_field' => '
                <div class="col-md-12">
        <div class="input-group">
        <!-- Comment -->
        <textarea  name="comment"'.$aria_req.'placeholder="'.esc_attr__('Your Comment', 'drake').'" ></textarea>
     </div></div>',    

                 'label_submit' => ''.esc_attr__('Post Comment', 'drake').'',
                 'comment_notes_before' => '',
                 'submit_button' => '<div class="col-md-12">
                    <button name="%1$s" type="submit" id="%2$s" class="submit-comment-btn theme-btn %3$s" value="%4$s">%4$s</button>
             </div>',
                   'comment_notes_after' => '',                    
        )
?>


<?php if ( comments_open() ) : ?>
<div class="comment-form">
<?php comment_form($comment_args); ?>
</div>
<?php endif; ?> 

<!-- End Comments Form -->
