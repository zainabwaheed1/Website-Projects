<?php
use Elementor\Icons_Manager;
use Elementor\Utils;

if ( 'none' !== $settings['load_more'] && 'custom' !== $settings['load_more'] ) : ?>

	<div class="cbp-loadMore-block1 cbp-loadMore-<?php echo esc_attr( $this->get_id() ); ?>">

		<?php
		$sg = 0;

		foreach ( $instagram_data['data'] as $gid => $item ) :

			$sg ++;

			$caption = $item['caption'];

			if ( $sg > $settings['item_per_page'] ) {
				?>

				<!--Item-->
				<div class="cbp-item xpro-elementor-gallery-item">
					<div class="cbp-caption">
						<div class="cbp-caption-defaultWrap">

							<?php
							echo '<img src="' . esc_url( ( 'VIDEO' === $item['media_type'] ) ? $item['thumbnail_url'] : $item['media_url'] ) . '">';
							?>

						</div>
						<div class="cbp-caption-activeWrap">
							<div class="cbp-l-caption-alignCenter" data-xpro-lightbox data-src="<?php echo esc_url( ( 'VIDEO' === $item['media_type'] ) ? $item['thumbnail_url'] : $item['media_url'] ); ?>">
								<!-- Overlay -->
								<div class="cbp-l-caption-body">
									<?php if ( 'yes' === $settings['icon'] ) { ?>
										<!-- Icon -->
										<span class="xpro-overlay-icon">
										<?php Icons_Manager::render_icon( $settings['icon_name'], array( 'aria-hidden' => 'true' ) ); ?>
								</span>
									<?php } ?>

									<?php if ( 'yes' === $settings['caption'] ) { ?>
										<!-- Content -->
										<div class="xpro-overlay-content">
											<?php if ( ! empty( $caption ) && 'yes' === $settings['caption'] ) { ?>
												<h4 class="xpro-title"><?php echo esc_html( $caption ); ?></h4>
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
		?>

	</div>

	<?php

	$count = $sg - $settings['item_per_page'];

	?>

	<div class="cbp-l-loadMore-button xpro-gallery-elementor-loadmore">
		<a href="<?php echo esc_url( get_permalink() . '#' . $this->get_id() ); ?>" class="cbp-l-loadMore-link" rel="nofollow">
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
