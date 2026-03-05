<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if ( 'image' === $settings['lightbox_content_type'] && $settings['content_image'] ) {
	$attr = $settings['content_image']['url'];
} elseif ( 'video' === $settings['lightbox_content_type'] && $settings['video_link'] ) {
	$attr = $settings['video_link']['url'];
} elseif ( 'vimeo' === $settings['lightbox_content_type'] && $settings['vimeo_link'] ) {
	$attr = $settings['vimeo_link']['url'];
} elseif ( 'youtube' === $settings['lightbox_content_type'] && $settings['youtube_link'] ) {
	$attr = $settings['youtube_link']['url'];
} elseif ( 'google-map' === $settings['lightbox_content_type'] && $settings['content_google_map'] ) {
	$attr = $settings['content_google_map']['url'];
}

?>

<div class="xpro-lightbox-wrapper">
	<div class="xpro-lightbox-inner" data-fancybox="<?php echo esc_attr( $settings['lightbox_group'] ); ?>" <?php echo esc_attr( $settings['content_google_map'] ? 'data-type="iframe"' : '' ); ?> data-src="<?php echo esc_url( $attr ); ?>" data-slug="<?php echo esc_attr( $settings['lightbox_slug'] ); ?>" data-caption="<?php echo esc_html( $settings['content_caption'] ); ?>">
		<?php if ( 'btn' === $settings['lightbox_toggler'] ) : ?>
			<button type="button"
					class="xpro-lightbox-btn xpro-lightbox-btn-align-<?php echo esc_attr( ( 'left' === $settings['btn_icon_align'] ) ? 'left' : 'right' ); ?>">
				<?php Icons_Manager::render_icon( $settings['btn_icon'], array( 'aria-hidden' => 'true' ) ); ?>

				<?php if ( $settings['toggler_txt_btn'] ) : ?>
					<span class="xpro-lightbox-btn-txt"><?php echo esc_html( $settings['toggler_txt_btn'] ); ?></span>
				<?php endif; ?>
			</button>
		<?php endif; ?>

		<?php if ( 'image' === $settings['lightbox_toggler'] ) : ?>
			<div class="xpro-lightbox-poster">
				<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_thumbnail', 'image' ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( 'icon' === $settings['lightbox_toggler'] ) : ?>
			<div class="xpro-lightbox-icon xpro-lightbox-icon-effect-<?php echo esc_attr( $settings['icon_effect'] ); ?>">
				<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
