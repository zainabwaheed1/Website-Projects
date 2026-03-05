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

$main_class = '';
$counter++;

switch ($settings['layout']) {
	case "1":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "2":
		$main_class = $counter === 2 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "3":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "4":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "5":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "6":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "7":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "8":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	case "10":
		$main_class = $counter === 1 ? ' xpro-post-tiles-featured-item' : '';
		break;
	default:
		$main_class = '';
}

?>

<div class="xpro-post-tiles-item<?php echo esc_attr($main_class); ?>">


	<?php
	if ( has_post_thumbnail() && 'yes' === $settings['show_image'] ) :
		echo wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), $settings['thumbnail_size'] );
	endif;
	?>

	<div class="xpro-post-tiles-content">
		<?php if ( ! empty( $settings['show_meta'] ) ) : ?>
			<ul class="xpro-post-tiles-meta-list">
				<?php foreach ( $settings['show_meta'] as $meta ) : ?>
					<?php if ( 'admin' === $meta && get_the_category_list() ) : ?>
						<li class="xpro-post-grid-meta-admin">
							<?php Icons_Manager::render_icon( $settings['admin_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<span><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( 'date' === $meta ) : ?>
						<li class="xpro-post-tiles-meta-date">
							<?php Icons_Manager::render_icon( $settings['date_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<?php the_time( get_option( 'date_format' ) ); ?>
						</li>
					<?php endif; ?>
					<?php if ( 'comments' === $meta ) : ?>
						<li class="xpro-post-tiles-meta-comments">
							<?php Icons_Manager::render_icon( $settings['comments_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							<?php comments_number( esc_html__( 'No Comments', 'xpro-elementor-addons-pro' ), esc_html__( '1 Comment', 'xpro-elementor-addons-pro' ), esc_html__( '% Comments', 'xpro-elementor-addons-pro' ) ); ?>
						</li>
					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
			<h2 class="xpro-post-tiles-title"><?php the_title(); ?></h2>
		</a>

		<?php if ( 'yes' === $settings['show_content'] ) : ?>
			<p class="xpro-post-tiles-excerpt"><?php echo wp_kses_post( $content ); ?></p>
		<?php endif; ?>

		<?php if ( 'yes' === $settings['show_readmore'] ) : ?>
			<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="xpro-post-tiles-btn"><?php echo esc_html( $settings['readmore_text'] ); ?></a>
		<?php endif; ?>

	</div>

	<?php if ( 'yes' === $settings['show_badge'] ) : ?>
		<span class="xpro-post-tiles-badge xpro-badge xpro-badge-<?php echo esc_attr( $settings['badge_position'] ); ?>"><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></span>
	<?php endif; ?>

</div>
