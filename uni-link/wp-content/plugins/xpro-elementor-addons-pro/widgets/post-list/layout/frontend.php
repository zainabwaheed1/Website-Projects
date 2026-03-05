<?php

global $post;

use Elementor\Icons_Manager;

$limit = $settings['content_length'] ? $settings['content_length'] : 15;

$content = explode( ' ', get_the_excerpt(), $limit );

if ( count( $content ) >= $limit ) {
	array_pop( $content );
	$content = implode( ' ', $content ) . '...';
} else {
	$content = implode( ' ', $content );
}

$content = preg_replace( '`[[^]]*]`', '', $content);

?>

<div class="xpro-post-list-item">
	<?php if ( has_post_thumbnail() && 'yes' === $settings['show_image'] ) : ?>
		<div class="xpro-post-list-image">
			<?php echo wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), $settings['thumbnail_size'] ); ?>
		</div>
	<?php endif; ?>

	<div class="xpro-post-list-content">
		<?php if ( ! empty( $settings['show_meta'] ) && 'before_title' === $settings['meta_position'] ) : ?>
			<ul class="xpro-post-list-meta-list">
				<?php foreach ( $settings['show_meta'] as $meta ) : ?>
					<?php if ( 'date' === $meta ) : ?>
						<li class="xpro-post-list-meta-date">
							<?php Icons_Manager::render_icon( $settings['date_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<?php the_time( get_option( 'date_format' ) ); ?>
						</li>
					<?php endif; ?>
					<?php if ( 'category' === $meta && get_the_category_list() ) : ?>
						<li class="xpro-post-grid-meta-category">
							<?php Icons_Manager::render_icon( $settings['category_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<span><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( 'comments' === $meta ) : ?>
						<li class="xpro-post-list-meta-comments">
							<?php Icons_Manager::render_icon( $settings['comments_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<?php comments_number( esc_html__( 'No Comments', 'xpro-elementor-addons-pro' ), esc_html__( '1 Comment', 'xpro-elementor-addons-pro' ), esc_html__( '% Comments', 'xpro-elementor-addons-pro' ) ); ?>
						</li>
					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
			<h2 class="xpro-post-list-title"><?php the_title(); ?></h2>
		</a>

		<?php if ( ! empty( $settings['show_meta'] ) && 'after_title' === $settings['meta_position'] ) : ?>
			<ul class="xpro-post-list-meta-list">
				<?php foreach ( $settings['show_meta'] as $meta ) : ?>
					<?php if ( 'date' === $meta ) : ?>
						<li class="xpro-post-list-meta-date">
							<?php Icons_Manager::render_icon( $settings['date_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<?php the_time( get_option( 'date_format' ) ); ?>
						</li>
					<?php endif; ?>
					<?php if ( 'category' === $meta && get_the_category_list() ) : ?>
						<li class="xpro-post-grid-meta-category">
							<?php Icons_Manager::render_icon( $settings['category_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<span><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( 'comments' === $meta ) : ?>
						<li class="xpro-post-list-meta-comments">
							<?php Icons_Manager::render_icon( $settings['comments_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<?php comments_number( esc_html__( 'No Comments', 'xpro-elementor-addons-pro' ), esc_html__( '1 Comment', 'xpro-elementor-addons-pro' ), esc_html__( '% Comments', 'xpro-elementor-addons-pro' ) ); ?>
						</li>
					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( 'yes' === $settings['show_content'] ) : ?>
			<p class="xpro-post-list-excerpt"><?php xpro_elementor_kses( $content ); ?></p>
		<?php endif; ?>

		<?php if ( 'yes' === $settings['show_readmore'] ) : ?>
			<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="xpro-post-list-btn"><?php echo esc_html( $settings['readmore_text'] ); ?></a>
		<?php endif; ?>

		<?php if ( 'yes' === $settings['show_author'] ) : ?>
			<div class="xpro-post-list-author">
				<?php if ( 'yes' === $settings['show_author_avatar'] ) : ?>
					<img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="author-avatar">
				<?php endif; ?>
				<div class="xpro-post-list-author-content">
					<?php if ( $settings['author_title'] ) : ?>
						<span class="xpro-post-list-author-title"><?php echo esc_html( $settings['author_title'] ); ?></span>
					<?php endif; ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="xpro-post-list-author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>
