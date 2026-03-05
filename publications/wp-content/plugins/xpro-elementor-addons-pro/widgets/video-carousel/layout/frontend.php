<div class="xpro-elementor-carousel-gallery-wrapper">

	<div id="xpro-gallery-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-elementor-carousel-gallery owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

		<?php
		use Elementor\Icons_Manager;
		use Elementor\Utils;

		$album_gallery = $this->get_settings_for_display( 'gallery' );

		foreach ( $album_gallery as $key => $item ) :

			$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

			$preview_link = '';

			if ( 'image' === $item['lightbox_content_type'] && $item['content_image'] ) {
				$preview_link = $item['content_image']['url'];
			} elseif ( 'video' === $item['lightbox_content_type'] && $item['video_link'] ) {
				$preview_link = $item['video_link']['url'];
			} elseif ( 'vimeo' === $item['lightbox_content_type'] && $item['vimeo_link'] ) {
				$preview_link = $item['vimeo_link']['url'];
			} elseif ( 'youtube' === $item['lightbox_content_type'] && $item['youtube_link'] ) {
				$preview_link = $item['youtube_link']['url'];
			}

			?>

			<div data-fancybox="gallery-<?php echo esc_attr( $this->get_id() ); ?>" data-src="<?php echo esc_url( $preview_link ); ?>" data-caption="<?php echo wp_kses_post( $item['content_caption'] ); ?>" class="xpro-elementor-carousel-gallery-item xpro-carousel-hover-style-<?php echo esc_attr( $settings['hover_effect'] ); ?>">

				<div class="xpro-elementor-carousel-gallery-item-inner" data-xpro-lightbox data-src="<?php echo esc_url( $item['image']['url'] ? $item['image']['url'] : wp_get_attachment_url( $item['image']['id'] ) ); ?>">

					<figure class="xpro-item-img">
						<?php
						if ( $item['image']['url'] && $item['image']['id'] ) {
							echo wp_get_attachment_image( attachment_url_to_postid( $item['image']['url'] ), $settings['thumbnail_size'], false );
						} elseif ( $item['image']['id'] && wp_get_attachment_image( $item['image']['id'] ) ) {
							echo wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'], false );
						} else {
							echo '<img src="' . esc_url( $item['image']['url'] ) . '">';
						}
						?>
					</figure>

					<!-- Overlay -->
					<div class="xpro-slide-caption">
						<div class="xpro-slide-caption-body">
							<?php if ( 'yes' === $settings['icon'] ) { ?>
								<!-- Icon -->
								<span class="xpro-overlay-icon">
									<?php Icons_Manager::render_icon( $settings['icon_name'], array( 'aria-hidden' => 'true' ) ); ?>
								</span>
							<?php } ?>
							<?php if ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] ) { ?>
								<!-- Content -->
								<div class="xpro-overlay-content">
									<?php if ( ! empty( $item['title_text'] ) && 'yes' === $settings['caption'] ) { ?>
										<h4 class="xpro-title"><?php echo esc_html( $item['title_text'] ); ?></h4>
									<?php } ?>
									<?php if ( ! empty( $item['desc_text'] ) && 'yes' === $settings['description'] ) { ?>
										<p class="xpro-desc"><?php echo wp_kses_post( $item['desc_text'] ); ?></p>
									<?php } ?>
									<?php if ( ! empty( $settings['button_text'] ) && 'yes' === $settings['button'] ) { ?>
										<a href="javascript:void(0);" class="xpro-item-btn"><?php echo esc_html( $settings['button_text'] ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>

				</div>

			</div>

			<?php
		endforeach;

		?>

	</div>

</div>
