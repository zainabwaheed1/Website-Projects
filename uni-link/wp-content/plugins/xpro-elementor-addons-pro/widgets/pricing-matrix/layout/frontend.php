<?php

use Elementor\Icons_Manager;

?>
<div class="xpro-matrix-wrapper">

	<!--Dots-->
	<div class="xpro-matrix-dots"></div>

	<!-- Start Pricing -->
	<div class="xpro-matrix xpro-matrix-style-<?php echo esc_attr( $settings['pricing_matrix_style'] ); ?>">
		<div class="xpro-matrix-comparison">
			<div class="xpro-matrix-head"><?php echo esc_html( $settings['packages_title'] ); ?></div>
			<div class="xpro-matrix-body">
				<ul class="xpro-matrix-package-list">
					<?php foreach ( $settings['packages_item'] as $key => $package ) { ?>
						<li><?php echo esc_html( $package['packages_item_text'] ); ?>
							<?php if ( $package['packages_item_tooltip_text'] ) : ?>
								<i class="fas fa-question xpro-matrix-tooltip-toggle">
									<span class="xpro-matrix-tooltip"><?php echo wp_kses_post( $package['packages_item_tooltip_text'] ); ?></span>
								</i>
							<?php endif; ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>

		<!-- Pricing Carousel -->
		<div id="xpro-matrix-slider-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-matrix-slider-wrapper owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?>">
			<?php foreach ( $settings['items'] as $i => $item ) { ?>
				<div data-dot="<?php echo esc_attr( ( $item['title'] ) ? $item['title'] : $i + 1 ); ?>" class="item<?php echo esc_attr( ( 'yes' === $item['featured'] ) ? ' featured' : '' ); ?>">
					<div class="xpro-matrix-item-head">

						<?php if ( $item['badge_text'] ) : ?>
							<span class="xpro-matrix-badge"><?php echo esc_html( $item['badge_text'] ); ?></span>
						<?php endif; ?>

						<?php if ( $item['title'] ) : ?>
							<h3 class="xpro-matrix-item-name"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( $item['item_description'] ) : ?>
							<p class="xpro-matrix-item-desc"><?php echo wp_kses_post( $item['item_description'] ); ?></p>
						<?php endif; ?>

						<h2 class="xpro-matrix-item-price">
							<?php if ( $item['currency'] ) : ?>
								<span class="xpro-matrix-currency"><?php echo esc_html( ( 'custom' !== $item['currency'] ) ? $this->get_currency_symbol( $item['currency'] ) : $item['currency_custom'] ); ?></span>
							<?php endif; ?>
							<?php if ( $item['price'] ) : ?>
								<span class="xpro-matrix-item-price-number"><?php echo esc_html( $item['price'] ); ?></span>
							<?php endif; ?>
							<?php if ( $item['price_original'] ) : ?>
								<span class="xpro-matrix-item-discount"><?php echo esc_html( ( 'custom' !== $item['currency'] ) ? $this->get_currency_symbol( $item['currency'] ) : $item['currency_custom'] ); ?><?php echo esc_html( $item['price_original'] ); ?></span>
							<?php endif; ?>
						</h2>

						<?php if ( $item['period'] ) : ?>
							<p class="xpro-matrix-item-duration"><?php echo esc_html( $item['period'] ); ?></p>
						<?php endif; ?>

						<?php
						if ( '1' === $settings['pricing_matrix_style'] || '2' === $settings['pricing_matrix_style'] || '3' === $settings['pricing_matrix_style'] ) :
							$target   = $item['button_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
							?>
							<a href="<?php echo esc_url( $item['button_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>class="xpro-matrix-item-button"><?php echo esc_html( $item['button_title'] ); ?></a>
						<?php endif; ?>
					</div>
					<div class="xpro-matrix-item-body">
						<ul class="xpro-matrix-item-list">

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

							<?php
							if ( '4' === $settings['pricing_matrix_style'] || '5' === $settings['pricing_matrix_style'] || '6' === $settings['pricing_matrix_style'] ) :
								$target   = $item['button_link']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
								?>
								<li class="xpro-matrix-button-wrapper">
									<a href="<?php echo esc_url( $item['button_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>class="xpro-matrix-item-button"><?php echo esc_html( $item['button_title'] ); ?></a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>

</div>
