<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

$attr  = 'playsinline';
$attr .= 'yes' === $settings['autoplay'] ? ' autoplay' : '';
$attr .= 'yes' === $settings['loop'] ? ' loop' : '';
$attr .= 'yes' === $settings['muted'] ? ' muted' : '';
?>

<div class="xpro-video-wrapper">
	<div class="xpro-video-inner">

		<?php if ( $settings['show_image_overlay'] ) : ?>
			<div class="xpro-sticky-video-overlay xpro-image">
				<?php if ( $settings['custom_image_overlay'] ) : ?>
					<?php
					if ( $settings['custom_image_overlay'] ) {
						echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'custom_media_thumbnail', 'custom_image_overlay' ) );
					}
					?>
				<?php endif; ?>

				<?php if ( $settings['custom_overlay_icon'] ) : ?>
					<div class="xpro-sticky-video-overlay-media">
						<?php
						if ( $settings['custom_overlay_icon'] ) {
							Icons_Manager::render_icon( $settings['custom_overlay_icon'], array( 'aria-hidden' => 'true' ) );
						}
						?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="xpro-video-box xpro-sticky-video-<?php echo esc_attr( $settings['sticky_position'] ); ?>">
			<div class="sticky-cross-btn xpro-sticky-cross-btn-<?php echo esc_attr( $settings['sticky_cross_btn_position'] ); ?>">
				<i class="fas fa-times"></i>
			</div>
			<div class="xpro-video-box-wrap xpro-image">
				<?php if ( 'video' === $settings['video_type'] && $settings['video_link'] ) : ?>
					<video id="player" class="plyr__video-embed xpro-player" <?php echo esc_attr( $attr ); ?>>
						<source type="video/mp4" src="<?php echo esc_url( $settings['video_link'] ); ?>">
					</video>
				<?php endif; ?>

				<?php if ( 'hosted' === $settings['video_type'] && $settings['hosted_url']['url'] ) : ?>
					<video id="player" class="plyr__video-embed xpro-player" <?php echo esc_attr( $attr ); ?>>
						<source type="video/mp4" src="<?php echo esc_url( $settings['hosted_url']['url'] ); ?>">
					</video>
				<?php endif; ?>

				<?php if ( 'vimeo' === $settings['video_type'] && $settings['vimeo_link'] ) : ?>
					<div class="plyr__video-embed xpro-player" id="player">
						<iframe src="<?php echo esc_url($settings['vimeo_link']); ?>" allowfullscreen allowtransparency
								allow="autoplay"></iframe>
					</div>
				<?php endif; ?>

				<?php
				if ( 'youtube' === $settings['video_type'] && $settings['youtube_link'] ) :
					$video_id  = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $settings['youtube_link'], $match ) ) ? $match[1] : false;
					$video_url = '//www.youtube.com/embed/' . $video_id . '?autoplay=1&mute=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;playsinline=1&playlist=' . $video_id;
					?>
					<div class="plyr__video-embed xpro-player" id="player">
						<iframe src="<?php echo esc_url( $video_url ); ?>" allowfullscreen allowtransparency
								allow="autoplay"></iframe>
					</div>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>
