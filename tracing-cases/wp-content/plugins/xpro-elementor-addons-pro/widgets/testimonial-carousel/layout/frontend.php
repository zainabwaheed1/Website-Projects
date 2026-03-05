<div class="xpro-testimonial-slider-wrapper xpro-swiper-slider-theme xpro-swiper-slider xpro-swiper-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-swiper-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

	<div id="xpro-testimonial-slider-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-testimonial-slider swiper-container">
		<div class="swiper-wrapper">
			<?php
			foreach ( $settings['item'] as $i => $item ) {

				$title_tag   = ( $item['name_link']['url'] ) ? 'a' : 'h3';
				$title_attr  = $item['name_link']['is_external'] ? ' target="_blank"' : '';
				$title_attr .= $item['name_link']['nofollow'] ? ' rel="nofollow"' : '';
				$title_attr .= $item['name_link']['url'] ? ' href="' . $item['name_link']['url'] . '"' : '';

				?>

			<div class="swiper-slide xpro-testimonial-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
				<div class="elementor-widget-container">
					<?php if ( '4' === $settings['layout'] || '5' === $settings['layout'] || '10' === $settings['layout'] ) { ?>
						<?php if ( $item['image']['id'] || $item['image']['url'] ) : ?>
							<div class="xpro-testimonial-image">
								<?php
								$image_markup = ( ! empty( $item['image']['id'] ) ) ? wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'] ) : '';
								echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $item['image']['url'] ) . '">';
								?>
							</div>
						<?php endif; ?>
					<?php } ?>

					<?php echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '<div class="xpro-testimonial-inner-wrapper">' : ''; ?>
					<div class="xpro-testimonial-content">

						<?php if ( 'yes' === $settings['show_quote'] && $settings['quote_icon']['value'] && '6' !== $settings['layout'] && '9' !== $settings['layout'] && '10' !== $settings['layout'] ) : ?>
							<span class="xpro-testimonial-quote">
								<?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
						<?php endif; ?>

						<?php if ( 'none' !== $settings['ratting_style'] && ( '2' === $settings['layout'] || '6' === $settings['layout'] || '10' === $settings['layout'] ) ) { ?>
							<div class="xpro-testimonial-rating xpro-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
								<?php
								if ( 'num' === $settings['ratting_style'] ) {
									echo esc_html( $settings['ratting']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
								} else {
									for ( $x = 1; $x <= 5; $x ++ ) {
										if ( $x <= $item['ratting']['size'] ) {
											echo '<i class="fas fa-star xpro-rating-filled" aria-hidden="true"></i>';
										} else {
											echo '<i class="fas fa-star" aria-hidden="true"></i>';
										}
									}
								}
								?>

							</div>
						<?php } ?>

						<?php if ( $item['description'] ) : ?>
							<div class="xpro-testimonial-description">
								<?php xpro_elementor_kses( $item['description'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( 'none' !== $settings['ratting_style'] && ( '1' === $settings['layout'] || '3' === $settings['layout'] || '7' === $settings['layout'] || '8' === $settings['layout'] || '9' === $settings['layout'] || '11' === $settings['layout'] || '12' === $settings['layout'] ) ) { ?>
							<div class="xpro-testimonial-rating xpro-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
								<?php
								if ( 'num' === $settings['ratting_style'] ) {
									echo esc_html( $item['ratting']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
								} else {
									for ( $x = 1; $x <= 5; $x ++ ) {
										if ( $x <= $item['ratting']['size'] ) {
											echo '<i class="fas fa-star xpro-rating-filled" aria-hidden="true"></i>';
										} else {
											echo '<i class="fas fa-star" aria-hidden="true"></i>';
										}
									}
								}
								?>

							</div>
						<?php } ?>
					</div>
					<div class="xpro-testimonial-author">
						<?php if ( '4' !== $settings['layout'] && '5' !== $settings['layout'] && '10' !== $settings['layout'] ) { ?>
							<?php if ( $item['image']['id'] || $item['image']['url'] ) : ?>
								<div class="xpro-testimonial-image">
									<?php
									$image_markup = ( ! empty( $item['image']['id'] ) ) ? wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'] ) : '';
									echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $item['image']['url'] ) . '">';
									?>
								</div>
							<?php endif; ?>
						<?php } ?>
						<?php if ( $item['name'] || $item['designation'] ) { ?>
						<div class="xpro-testimonial-author-bio">
							<?php if ( $item['name'] ) : ?>
							<<?php echo esc_attr( $title_tag ); ?> <?php xpro_elementor_kses( $title_attr ); ?>class="xpro-testimonial-title"><?php echo esc_attr( $item['name'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
					<?php endif; ?>
							<?php if ( $item['designation'] ) : ?>
							<h4 class="xpro-testimonial-designation"><?php xpro_elementor_kses( $item['designation'] ); ?></h4>
						<?php endif; ?>
					</div>
				<?php } ?>
					<?php if ( 'none' !== $settings['ratting_style'] && ( '4' === $settings['layout'] || '5' === $settings['layout'] ) ) { ?>
						<div class="xpro-testimonial-rating xpro-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
							<?php
							if ( 'num' === $settings['ratting_style'] ) {
								echo esc_html( $item['ratting']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
							} else {
								for ( $x = 1; $x <= 5; $x ++ ) {
									if ( $x <= $item['ratting']['size'] ) {
										echo '<i class="fas fa-star xpro-rating-filled" aria-hidden="true"></i>';
									} else {
										echo '<i class="fas fa-star" aria-hidden="true"></i>';
									}
								}
							}
							?>

						</div>
					<?php } ?>
				</div>
				<?php echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '</div>' : ''; ?>

			</div>
		</div>
		<?php } ?>
	</div>

</div>

<?php if ( $settings['nav'] ) : ?>
	<button type="button" class="swiper-button-prev"></button>
	<button type="button" class="swiper-button-next"></button>
<?php endif; ?>

<?php if ( $settings['dots'] ) : ?>
    <div class="swiper-pagination"></div>
<?php endif; ?>

</div>

<?php if ( '11' === $settings['layout'] || '12' === $settings['layout'] ) : ?>
	<div class="xpro-testimonial-thumbs xpro-testimonial-thumbs-layout-<?php echo esc_attr( $settings['layout'] ); ?> swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ( $settings['item'] as $i => $item ) { ?>
				<div class="swiper-slide">
					<div class="xpro-testimonial-thumbs-inner">
						<?php if ( $item['image']['id'] || $item['image']['url'] ) : ?>
							<div class="xpro-testimonial-image">
								<?php
								$image_markup = ( ! empty( $item['image']['id'] ) ) ? wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'] ) : '';
								echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $item['image']['url'] ) . '">';
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>
