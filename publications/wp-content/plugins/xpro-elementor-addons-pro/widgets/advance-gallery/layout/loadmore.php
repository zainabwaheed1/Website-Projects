<?php
use Elementor\Icons_Manager;
use Elementor\Utils;

if ( 'none' !== $settings['load_more'] && 'custom' !== $settings['load_more'] ) : ?>

	<div class="cbp-loadMore-block1 cbp-loadMore-<?php echo esc_attr( $this->get_id() ); ?>">

		<?php
		if ( 'simple' === $settings['gallery_type'] ) {

			$sg = 0;

			foreach ( $simple_gallery['items'] as $gid => $item ) :

				$sg ++;

				$attachment = xpro_elementor_get_attachment( $gid );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

				if ( $sg > $settings['item_per_page'] ) {
					?>

					<!--Item-->
					<div class="cbp-item xpro-elementor-gallery-item <?php echo esc_attr( $item ); ?>">
						<div class="cbp-caption">
							<div class="cbp-caption-defaultWrap">
								<?php
								if ( $gid ) {
									echo wp_get_attachment_image( $gid, $settings['thumbnail_size'], false );
								} else {
									echo '<img src="' . esc_url( Utils::get_placeholder_image_src() ) . '">';
								}
								?>
							</div>
							<div class="cbp-caption-activeWrap">
								<div class="cbp-l-caption-alignCenter" data-xpro-lightbox data-src="<?php echo esc_url( ( $gid ) ? wp_get_attachment_image_url( $gid, 'full', false ) : Utils::get_placeholder_image_src() ); ?>">
									<!-- Overlay -->
									<div class="cbp-l-caption-body">
										<?php if ( 'yes' === $settings['icon'] ) { ?>
											<!-- Icon -->
											<span class="xpro-overlay-icon">
											<?php Icons_Manager::render_icon( $settings['icon_name'], array( 'aria-hidden' => 'true' ) ); ?>
											</span>
										<?php } ?>

										<?php if ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] ) { ?>
											<!-- Content -->
											<div class="xpro-overlay-content">
												<?php if ( ! empty( $caption ) && 'yes' === $settings['caption'] ) { ?>
													<h4 class="xpro-title"><?php echo esc_html( $caption ); ?></h4>
												<?php } ?>
												<?php if ( ! empty( $caption ) && 'yes' === $settings['description'] ) { ?>
													<p class="xpro-desc"><?php echo esc_html( $description ); ?></p>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
				}

			endforeach;

		}
		?>

		<?php
		if ( 'album' === $settings['gallery_type'] ) {

			$ag = 0;

			foreach ( $album_gallery as $key => $item ) :

				$ag ++;

				$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

				if ( $ag > $settings['item_per_page'] ) {
					?>

					<!--Item-->
					<div class="cbp-item xpro-elementor-gallery-item <?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['filter'] ) ); ?>">
						<div class="cbp-caption">
							<div class="cbp-caption-defaultWrap">
								<?php
								if ( $item['image']['url'] && $item['image']['id'] ) {
									echo wp_get_attachment_image( attachment_url_to_postid( $item['image']['url'] ), $settings['thumbnail_size'], false );
								} elseif ( $item['image']['id'] && wp_get_attachment_image( $item['image']['id'] ) ) {
									echo wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'], false );
								} else {
									echo '<img src="' . esc_url( $item['image']['url'] ) . '">';
								}
								?>
							</div>
							<div class="cbp-caption-activeWrap">
								<div class="cbp-l-caption-alignCenter" data-xpro-lightbox data-src="<?php echo esc_url( $item['image']['url'] ? $item['image']['url'] : wp_get_attachment_url( $item['image']['id'] ) ); ?>">
									<!-- Overlay -->
									<div class="cbp-l-caption-body">
										<?php if ( 'yes' === $settings['icon'] ) { ?>
											<!-- Icon -->
											<span class="xpro-overlay-icon">
											<?php Icons_Manager::render_icon( $settings['icon_name'], array( 'aria-hidden' => 'true' ) ); ?>
									</span>
										<?php } ?>

										<?php if ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] ) { ?>
											<!-- Content -->
											<div class="xpro-overlay-content">
												<?php if ( ! empty( $caption ) && 'yes' === $settings['caption'] ) { ?>
													<h4 class="xpro-title"><?php echo esc_html( $caption ); ?></h4>
												<?php } ?>
												<?php if ( ! empty( $caption ) && 'yes' === $settings['description'] ) { ?>
													<p class="xpro-desc"><?php echo esc_html( $description ); ?></p>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<!--Preview-->
						<div class="xpro-elementor-gallery-preview">
							<?php foreach ( $item['images'] as $k => $image ) { ?>
								<span class="xpro-elementor-gallery-preview" data-xpro-lightbox data-src="<?php echo esc_url( $image['url'] ? $image['url'] : wp_get_attachment_url( $image['id'] ) ); ?>"></span>
							<?php } ?>
						</div>
					</div>

					<?php
				}
			endforeach;
		}
		?>

	</div>

	<?php

	$count = ( 'simple' === $settings['gallery_type'] ) ? $sg - $settings['item_per_page'] : $ag - $settings['item_per_page'];

	?>

	<div class="cbp-l-loadMore-button xpro-gallery-elementor-loadmore">
		<a href="<?php echo esc_url( get_permalink( get_queried_object_id() ) . '#' . $this->get_id() ); ?>" class="cbp-l-loadMore-link" rel="nofollow">
		<span class="cbp-l-loadMore-defaultText"><?php echo esc_html( $settings['load_more_text'] ); ?> <?php
		if ( $count > 0 && 'yes' === $settings['load_more_count'] ) {
			?>
				(<span class="cbp-l-loadMore-loadItems"><?php echo esc_attr( $count ); ?></span>)<?php } ?></span>
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
