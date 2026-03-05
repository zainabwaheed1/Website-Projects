<div class="xpro-elementor-carousel-gallery-wrapper">

	<?php use Elementor\Icons_Manager;

	if ( 'simple' === $settings['carousel_layout'] || 'creative' === $settings['carousel_layout'] ) { ?>

		<div id="xpro-gallery-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-elementor-carousel-gallery owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

			<?php

			foreach ( $album_gallery as $key => $item ) :

				$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

				?>
				<div class="xpro-elementor-carousel-gallery-item-wrapper xpro-elementor-carousel-gallery-type-<?php echo esc_attr( $settings['carousel_layout'] ); ?>">

					<?php if ( 'simple' === $settings['carousel_layout'] ) : ?>

						<div class="xpro-elementor-carousel-gallery-item xpro-carousel-hover-style-<?php echo esc_attr( $settings['hover_effect'] ); ?>" data-title="<?php echo esc_html( $item['title_text'] ); ?>" data-src-preview="<?php echo esc_url( $item['preview_link'] ); ?>">

							<div class="xpro-elementor-carousel-gallery-item-inner">

								<figure class="xpro-item-img" data-xpro-thumb="<?php echo esc_url( wp_get_attachment_image_url( $item['image']['id'], 'thumbnail', false ) ); ?>">
									<?php
									if ( $item['image']['url'] && $item['image']['id'] ) {
										echo wp_get_attachment_image( attachment_url_to_postid( $item['image']['url'] ), $settings['thumbnail_size'], false );
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
										<?php if ( 'yes' !== $settings['text_outside'] && ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] || 'yes' === $settings['button'] ) ) { ?>
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

						<?php if ( 'yes' === $settings['text_outside'] && ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] || 'yes' === $settings['button'] ) ) { ?>
							<!-- Content -->
							<div class="xpro-outside-content">
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

					<?php endif; ?>

					<?php if ( 'creative' === $settings['carousel_layout'] ) : ?>
						<div class="xpro-elementor-carousel-gallery-item xpro-carousel-hover-style-<?php echo esc_attr( $settings['hover_effect'] ); ?>" data-title="<?php echo esc_html( $item['title_text'] ); ?>" data-src-preview="<?php echo esc_url( $item['preview_link'] ); ?>">
							<div class="xpro-elementor-carousel-gallery-item-inner">
								<figure class="xpro-item-img" data-xpro-thumb="<?php echo esc_url( wp_get_attachment_image_url( $item['image']['id'], 'thumbnail', false ) ); ?>">
									<?php
									if ( $item['image']['id'] ) {
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
									</div>
								</div>
							</div>
							<?php if ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] || 'yes' === $settings['button'] ) { ?>
								<!-- Content -->
								<div class="xpro-elementor-carousel-content-area">
									<div class="xpro-elementor-carousel-content-right">
										<?php if ( ! empty( $item['title_text'] ) && 'yes' === $settings['caption'] ) { ?>
											<h4 class="xpro-title"><?php echo esc_html( $item['title_text'] ); ?></h4>
										<?php } ?>
										<?php if ( ! empty( $item['desc_text'] ) && 'yes' === $settings['description'] ) { ?>
											<p class="xpro-desc"><?php echo esc_html( $item['desc_text'] ); ?></p>
										<?php } ?>
										<?php if ( ! empty( $settings['button_text'] ) && 'yes' === $settings['button'] ) { ?>
											<a href="javascript:void(0);" class="xpro-item-btn"><?php echo esc_html( $settings['button_text'] ); ?></a>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>

					<?php endif; ?>
				</div>

				<?php
			endforeach;

			?>

		</div>

	<?php } ?>

	<?php if ( 'unique' === $settings['carousel_layout'] ) { ?>

		<div class="xpro-slick-slider-full xpro-slider-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ); ?>">

			<div class="xpro-slick-right-content">
				<!--Slick Slider-->
				<div class="xpro-slider-slick-image">
					<?php

					foreach ( $album_gallery as $key => $item ) :

						$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

						$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
						$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

						?>

						<div class="slider-slide">
							<div class="xpro-slide-image">

								<figure class="xpro-item-img">
									<?php
									if ( $item['image']['url'] && $item['image']['id'] ) {
										echo wp_get_attachment_image( attachment_url_to_postid( $item['image']['url'] ), $settings['thumbnail_size'], false );
									} else {
										echo '<img src="' . esc_html( $item['image']['url'] ) . '">';
									}
									?>

								</figure>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>

			<div class="xpro-slick-left-content">
				<!--Slick Slider-->
				<div class="xpro-slider-slick-content">

					<?php

					foreach ( $album_gallery as $key => $item ) :

						?>
						<div class="xpro-slider-slick-slide xpro-preview-type-<?php echo esc_attr( $settings['preview_type'] ); ?>" data-title="<?php echo esc_html( $item['title_text'] ); ?>" data-src-preview="<?php echo esc_url( $item['preview_link'] ); ?>" data-xpro-thumb="<?php echo esc_url( wp_get_attachment_image_url( $item['image']['id'], 'thumbnail', false ) ); ?>">
							<?php if ( ! empty( $item['title_text'] ) && 'yes' === $settings['caption'] ) { ?>
								<h4 class="xpro-title"><?php echo esc_html( $item['title_text'] ); ?></h4>
							<?php } ?>
							<?php if ( ! empty( $item['desc_text'] ) && 'yes' === $settings['description'] ) { ?>
								<p class="xpro-desc"><?php echo esc_html( $item['desc_text'] ); ?></p>
							<?php } ?>
							<?php if ( ! empty( $settings['button_text'] ) && 'yes' === $settings['button'] ) { ?>
								<a href="javascript:void(0);" class="xpro-item-btn"><?php echo esc_html( $settings['button_text'] ); ?></a>
							<?php } ?>
						</div>

					<?php endforeach; ?>
				</div>

			</div>

			<?php if ( 'yes' === $settings['nav'] ) { ?>
				<!--Slider Arrows-->
				<div class="xpro-slider-slick-arrows">
					<button type="button" role="presentation" class="slick-nav-prev"></button>
					<button type="button" role="presentation" class="slick-nav-next"></button>
				</div>
			<?php } ?>

		</div>

	<?php } ?>

	<?php require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'carousel-portfolio/layout/popup.php'; ?>

</div>
