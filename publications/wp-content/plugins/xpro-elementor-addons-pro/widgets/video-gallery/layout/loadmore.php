<?php use Elementor\Icons_Manager;

if ( 'none' !== $settings['load_more'] && 'custom' !== $settings['load_more'] ) : ?>

	<div class="cbp-loadMore-block1 cbp-loadMore-<?php echo esc_attr( $this->get_id() ); ?>">

		<?php
		$ag = 0;

		foreach ( $gallery as $key => $item ) :

			$ag ++;

			$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

			$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
			$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

			if ( $ag > $settings['item_per_page'] ) {

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

				<!--Item-->
				<div data-fancybox="gallery-<?php echo esc_attr( $this->get_id() ); ?>" data-src="<?php echo esc_url( $preview_link ); ?>" data-caption="<?php echo wp_kses_post( $item['content_caption'] ); ?>" class="cbp-item xpro-elementor-gallery-item <?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['filter'] ) ); ?>">
					<div class="cbp-caption">
						<div class="cbp-caption-defaultWrap" data-xpro-thumb="<?php echo esc_url( wp_get_attachment_image_url( $item['image']['id'], 'thumbnail', false ) ); ?>">
							<?php
							if ( $item['image']['url'] && $item['image']['id'] ) {
								echo wp_get_attachment_image( attachment_url_to_postid( $item['image']['url'] ), $settings['thumbnail_size'], false );
							} else {
								echo '<img src="' . esc_url( $item['image']['url'] ) . '">';
							}
							?>
						</div>
						<div class="cbp-caption-activeWrap">
							<div class="cbp-l-caption-alignCenter">
								<!-- Overlay -->
								<div class="cbp-l-caption-body">
									<?php if ( 'yes' === $settings['icon'] ) { ?>
										<!-- Icon -->
										<span class="xpro-overlay-icon">
										<?php Icons_Manager::render_icon( $settings['icon_name'], array( 'aria-hidden' => 'true' ) ); ?>
								</span>
									<?php } ?>

									<?php if ( 'yes' !== $settings['text_outside'] && ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] ) ) { ?>
										<!-- Content -->
										<div class="xpro-overlay-content">
											<?php if ( ! empty( $item['title_text'] ) && 'yes' === $settings['caption'] ) { ?>
												<h4 class="xpro-title"><?php echo esc_html( $item['title_text'] ); ?></h4>
											<?php } ?>
											<?php if ( ! empty( $item['desc_text'] ) && 'yes' === $settings['description'] ) { ?>
												<p class="xpro-desc"><?php echo wp_kses_post( $item['desc_text'] ); ?></p>
											<?php } ?>
										</div>
									<?php } ?>

								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $settings['text_outside'] && ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] ) ) { ?>
						<!-- Content -->
						<div class="xpro-outside-content">
							<?php if ( ! empty( $item['title_text'] ) && 'yes' === $settings['caption'] ) { ?>
								<h4 class="xpro-title"><?php echo esc_html( $item['title_text'] ); ?></h4>
							<?php } ?>
							<?php if ( ! empty( $item['desc_text'] ) && 'yes' === $settings['description'] ) { ?>
								<p class="xpro-desc"><?php echo wp_kses_post( $item['desc_text'] ); ?></p>
							<?php } ?>
						</div>
					<?php } ?>
				</div>

				<?php
			}
		endforeach;

		?>

	</div>

	<?php

	$count = $ag - $settings['item_per_page'];

	?>

	<div class="cbp-l-loadMore-button xpro-gallery-elementor-loadmore">
		<a href="<?php echo esc_url( get_permalink( get_queried_object_id() ) . '#' . $this->get_id() ); ?>" class="cbp-l-loadMore-link" rel="nofollow">
			<span class="cbp-l-loadMore-defaultText"><?php echo esc_html( $settings['load_more_text'] ); ?> <?php
			if ( $count > 0 && 'yes' === $settings['load_more_count'] ) {
				?>
				(
					<span class="cbp-l-loadMore-loadItems"><?php echo esc_attr( $count ); ?></span>)<?php } ?></span>
			<span class="cbp-l-loadMore-loadingText"><?php echo esc_html( $settings['load_more_loading_text'] ); ?></span>
			<span class="cbp-l-loadMore-noMoreLoading"><?php echo esc_html( $settings['load_more_no_left'] ); ?></span>
		</a>
	</div>

<?php endif; ?>

<?php
if ( 'custom' === $settings['load_more'] ) :

	$target   = $settings['custom_link']['is_external'] ? ' target="_blank"' : '';
	$nofollow = $settings['custom_link']['nofollow'] ? ' rel="nofollow"' : '';

	?>

	<div class="xpro-gallery-elementor-custom-link">
		<a href="<?php echo esc_url( $settings['custom_link']['url'] ); ?>" <?php echo esc_attr( $target ) . esc_attr( $nofollow ); ?>class="xpro-gallery-elementor-link">
			<span><?php echo esc_html( $settings['load_more_text'] ); ?></span>
		</a>
	</div>

<?php endif; ?>
