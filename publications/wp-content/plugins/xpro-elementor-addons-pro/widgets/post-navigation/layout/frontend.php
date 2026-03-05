<?php

$prev_label = '';
$next_label = '';
$prev_arrow = '';
$next_arrow = '';

if ( 'yes' === $settings['show_label'] ) {
	$prev_label = '<span class="xpro-elementor-post-navigation-prev-label">' . $settings['prev_label'] . '</span>';
	$next_label = '<span class="xpro-elementor-post-navigation-next-label">' . $settings['next_label'] . '</span>';
}

if ( 'yes' === $settings['show_arrow'] ) {
	if ( is_rtl() ) {
		$prev_icon_class = str_replace( 'left', 'right', $settings['arrow'] );
		$next_icon_class = $settings['arrow'];
	} else {
		$prev_icon_class = $settings['arrow'];
		$next_icon_class = str_replace( 'left', 'right', $settings['arrow'] );
	}

	$prev_arrow = '<span class="xpro-elementor-post-navigation-arrow-wrapper xpro-elementor-post-navigation-arrow-prev"><i class="' . $prev_icon_class . '" aria-hidden="true"></i><span class="elementor-screen-only">' . esc_html__( 'Prev', 'xpro-elementor-addons-pro' ) . '</span></span>';
	$next_arrow = '<span class="xpro-elementor-post-navigation-arrow-wrapper xpro-elementor-post-navigation-arrow-next"><i class="' . $next_icon_class . '" aria-hidden="true"></i><span class="elementor-screen-only">' . esc_html__( 'Next', 'xpro-elementor-addons-pro' ) . '</span></span>';
}

$prev_title = '';
$next_title = '';

if ( 'yes' === $settings['show_title'] ) {
	$prev_title = '<span class="xpro-elementor-post-navigation-prev-title">%title</span>';
	$next_title = '<span class="xpro-elementor-post-navigation-next-title">%title</span>';
}

$in_same_term = false;
$post_type    = get_post_type( get_queried_object_id() );

?>
<div class="xpro-elementor-post-navigation">
	<div class="xpro-elementor-post-navigation-prev xpro-elementor-post-navigation-link">
		<?php previous_post_link( '%link', $prev_arrow . '<span class="xpro-elementor-post-navigation-link-prev">' . $prev_label . $prev_title . '</span>', $in_same_term ); ?>
	</div>
	<?php if ( 'yes' === $settings['show_separator'] ) : ?>
		<div class="xpro-elementor-post-navigation-separator-wrapper">
			<div class="xpro-elementor-post-navigation-separator"></div>
		</div>
	<?php endif; ?>
	<div class="xpro-elementor-post-navigation-next xpro-elementor-post-navigation-link">
		<?php next_post_link( '%link', '<span class="xpro-elementor-post-navigation-link-next">' . $next_label . $next_title . '</span>' . $next_arrow, $in_same_term ); ?>
	</div>
</div>
