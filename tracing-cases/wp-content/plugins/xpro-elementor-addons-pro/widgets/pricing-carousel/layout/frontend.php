<div id="xpro-pricing-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-pricing-carousel owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

	<?php
	use Elementor\Icons_Manager;

	foreach ( $settings['items'] as $key => $item ) :
		?>
		<div class="xpro-pricing-item<?php echo ( 'yes' === $item['featured'] ) ? ' xpro-pricing-carousel-featured' : ''; ?>">

			<?php if ( ! empty( $item['badge_text'] ) ) : ?>
				<span class="xpro-badge xpro-badge-<?php echo esc_attr( $settings['badge_position'] ); ?>"><?php echo esc_html( $item['badge_text'] ); ?></span>
			<?php endif; ?>

			<?php if ( 'before_header' === $settings['media_position'] ) { ?>
				<?php if ( 'icon' === $item['media_type'] && $item['icon']['value'] ) : ?>
					<div class="xpro-pricing-icon">
						<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</div>
				<?php endif; ?>
				<?php if ( 'image' === $item['media_type'] && $item['image']['url'] ) : ?>
					<div class="xpro-pricing-media">
						<?php echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'media_thumbnail', 'image' ) ); ?>
					</div>
				<?php endif; ?>
			<?php } ?>

			<?php if ( ! empty( $item['title'] ) ) : ?>
				<div class="xpro-pricing-title-wrapper">
					<h2 class="xpro-pricing-title"><?php echo esc_html( $item['title'] ); ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( 'after_header' === $settings['media_position'] ) { ?>
				<?php if ( 'icon' === $item['media_type'] && $item['icon']['value'] ) : ?>
					<div class="xpro-pricing-icon">
						<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</div>
				<?php endif; ?>
				<?php if ( 'image' === $item['media_type'] && $item['image']['url'] ) : ?>
					<div class="xpro-pricing-media">
						<?php echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'media_thumbnail', 'image' ) ); ?>
					</div>
				<?php endif; ?>
			<?php } ?>

			<?php if ( 'before_features' === $settings['price_position'] ) { ?>
				<div class="xpro-pricing-price-box xpro-pricing-price-box-style-<?php echo esc_attr( $settings['price_style'] ); ?>">
					<div class="xpro-pricing-price-tag">
				<span class="xpro-pricing-currency">
					 <?php echo( ( 'none' !== $item['currency'] ) ? self::get_currency_symbol( $item['currency'] ) : $item['currency_custom'] ); ?>
				</span>
				<span class="xpro-pricing-price">
					<?php echo esc_html( $item['price'] ); ?>
				</span>
					</div>

					<?php if ( ! empty( $item['period'] ) ) : ?>
						<p class="xpro-pricing-price-period"><?php echo esc_html( $item['period'] ); ?></p>
					<?php endif; ?>

				</div>
			<?php } ?>

			<?php if ( 'before_features' === $settings['description_position'] && $item['item_description'] ) { ?>
				<div class="xpro-pricing-description-wrapper">
					<div class="xpro-pricing-description">
						<?php xpro_elementor_kses( $item['item_description'] ); ?>
					</div>
				</div>
			<?php } ?>

			<?php
			if ( 'before_features' === $settings['button_position'] && $item['button_title'] ) {
				$target   = $item['button_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<div class="xpro-pricing-btn-wrapper"><a class="xpro-pricing-btn" href="<?php echo esc_url( $item['button_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>><?php echo esc_html( $item['button_title'] ); ?></a></div>
				<?php
			}
			?>

			<div class="xpro-pricing-features">

				<?php if ( ! empty( $item['list_title'] ) ) : ?>
					<h4 class="xpro-pricing-features-title"><?php echo esc_html( $item['list_title'] ); ?></h4>
				<?php endif; ?>

				<ul class="xpro-pricing-features-list">

					<?php
					for ( $x = 1; $x <= 20; $x ++ ) {
						if ( 'yes' === $item[ 'list_item_' . $x ] && ( $item[ 'list_item_' . $x . '_icon' ] || $item[ 'list_item_' . $x . '_text' ] ) ) {
							?>
							<li class="<?php echo esc_attr( $item[ 'list_item_' . $x . '_status' ] ); ?>">

								<?php if ( $item[ 'list_item_' . $x . '_icon' ] ) : ?>
									<span class="xpro-pricing-feature-icon"><?php Icons_Manager::render_icon( $item[ 'list_item_' . $x . '_icon' ], array( 'aria-hidden' => 'true' ) ); ?></span>
								<?php endif; ?>

								<?php if ( $item[ 'list_item_' . $x . '_text' ] ) : ?>
									<span class="xpro-pricing-feature-title">
											<?php echo esc_html( $item[ 'list_item_' . $x . '_text' ] ); ?>
										</span>
								<?php endif; ?>
							</li>
							<?php
						}
					}
					?>

				</ul>

			</div>

			<?php if ( 'yes' === $settings['show_separator'] ) { ?>
				<div class="xpro-pricing-separator"></div>
			<?php } ?>

			<?php if ( 'after_features' === $settings['description_position'] && $item['item_description'] ) { ?>
				<div class="xpro-pricing-description-wrapper">
					<div class="xpro-pricing-description">
						<?php xpro_elementor_kses( $item['item_description'] ); ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( 'after_features' === $settings['price_position'] ) { ?>
				<div class="xpro-pricing-price-box xpro-pricing-price-box-style-<?php echo esc_attr( $settings['price_style'] ); ?>">
					<div class="xpro-pricing-price-tag">
				<span class="xpro-pricing-currency">
					 <?php echo( ( 'none' !== $item['currency'] ) ? self::get_currency_symbol( $item['currency'] ) : $item['currency_custom'] ); ?>
				</span>
						<span class="xpro-pricing-price">
					<?php echo esc_html( $item['price'] ); ?>
				</span>
					</div>

					<?php if ( ! empty( $item['period'] ) ) : ?>
						<p class="xpro-pricing-price-period"><?php echo esc_html( $item['period'] ); ?></p>
					<?php endif; ?>

				</div>
			<?php } ?>

			<?php
			if ( 'after_features' === $settings['button_position'] && $item['button_title'] ) {
				$target   = $item['button_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<div class="xpro-pricing-btn-wrapper"><a class="xpro-pricing-btn" href="<?php echo esc_url( $item['button_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>><?php echo esc_html( $item['button_title'] ); ?></a></div>
				<?php
			}
			?>

		</div>
	<?php endforeach; ?>

</div>


