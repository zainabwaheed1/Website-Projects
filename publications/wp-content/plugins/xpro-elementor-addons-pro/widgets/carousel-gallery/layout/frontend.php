<div class="xpro-elementor-carousel-gallery-wrapper">

	<div id="xpro-gallery-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-elementor-carousel-gallery owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

		<?php
		use Elementor\Icons_Manager;
		use Elementor\Utils;

		if ( 'simple' === $settings['gallery_type'] ) {

			foreach ( $simple_gallery['items'] as $gid => $item ) :

				$attachment = xpro_elementor_get_attachment( $gid );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

				?>

				<div class="xpro-elementor-carousel-gallery-item xpro-carousel-hover-style-<?php echo esc_attr( $settings['hover_effect'] ); ?>">
					<div class="xpro-elementor-carousel-gallery-item-inner" data-xpro-lightbox data-src="<?php echo esc_url( ( $gid ) ? wp_get_attachment_image_url( $gid, 'full', false ) : Utils::get_placeholder_image_src() ); ?>">
						<figure class="xpro-item-img">
							<?php
							if ( $gid ) {
								echo wp_get_attachment_image( $gid, $settings['thumbnail_size'], false );
							} else {
								echo '<img src="' . esc_url( Utils::get_placeholder_image_src() ) . '">';
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

				<?php
			endforeach;
		}
		?>

		<?php
		if ( 'album' === $settings['gallery_type'] ) {

			foreach ( $album_gallery as $key => $item ) :

				$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

				?>

				<div class="xpro-elementor-carousel-gallery-item xpro-carousel-hover-style-<?php echo esc_attr( $settings['hover_effect'] ); ?>">

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

						<!--Preview-->
						<div class="xpro-elementor-gallery-preview">
							<?php foreach ( $item['images'] as $k => $image ) { ?>
								<span class="xpro-elementor-gallery-preview" data-xpro-lightbox data-src="<?php echo esc_url( $image['url'] ? $image['url'] : wp_get_attachment_url( $image['id'] ) ); ?>"></span>
							<?php } ?>
						</div>

					</div>

				</div>

				<?php
			endforeach;
		}
		?>

	</div>

</div>
