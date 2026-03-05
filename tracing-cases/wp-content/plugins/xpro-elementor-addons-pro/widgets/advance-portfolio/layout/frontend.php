<?php
use Elementor\Icons_Manager;
?>
<div class="xpro-elementor-gallery xpro-elementor-gallery-layout-<?php echo esc_attr( $settings['gallery_style'] ); ?>">

	<?php if ( 'yes' === $settings['show_filter'] ) : ?>
		<div class="xpro-elementor-gallery-filter xpro-filter-dropdown-<?php echo esc_attr( $settings['show_dropdown'] ); ?>">

			<!-- select content dropdown -->
			<div class="xpro-select-option">
				<span class="xpro-select-content"><?php echo esc_html( $settings['filter_all_text'] ? $settings['filter_all_text'] : '' ); ?></span>
				<i class="xpro-select-icon fas fa-chevron-down"></i>
			</div>

			<!-- Filters List -->
			<ul class="cbp-l-filters-button" data-default-filter="<?php echo esc_attr( $this->_default_filter ); ?>">

				<?php if ( 'yes' === $settings['filter_all'] ) : ?>
					<li class="cbp-filter-item-active cbp-filter-item" data-filter="*"><?php echo esc_html( $settings['filter_all_text'] ? $settings['filter_all_text'] : '' ); ?></li>
				<?php endif; ?>

				<?php
				foreach ( $gallery_data['menu'] as $key => $val ) {

					echo '<li class="cbp-filter-item" data-filter=".' . esc_attr( $key ) . '">' . esc_html( $val ) . '</li>';

				}
				?>

			</ul>

		</div>
	<?php endif; ?>

	<!-- Main Gallery -->
	<div class="pluginResize xpro-elementor-gallery-wrapper cbp">

		<?php
		$b = 0;

		foreach ( $gallery as $key => $item ) :

			$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

			$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
			$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

			?>

			<!--Item-->
			<div class="cbp-item xpro-elementor-gallery-item xpro-preview-type-<?php echo esc_attr( $settings['preview_type'] ); ?> <?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['filter'] ) ); ?>" data-title="<?php echo esc_html( $item['title_text'] ); ?>" data-src-preview="<?php echo esc_url( $item['preview_link'] ); ?>">
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

								<?php if ( 'yes' !== $settings['text_outside'] && ( 'yes' === $settings['description'] || 'yes' === $settings['caption'] || 'yes' === $settings['button'] ) ) { ?>
									<!-- Content -->
									<div class="xpro-overlay-content">
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
							<p class="xpro-desc"><?php echo esc_html( $item['desc_text'] ); ?></p>
						<?php } ?>
						<?php if ( ! empty( $settings['button_text'] ) && 'yes' === $settings['button'] ) { ?>
							<a href="javascript:void(0);" class="xpro-item-btn"><?php echo esc_html( $settings['button_text'] ); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>

			<?php
			$b ++;
			if ( $b === $settings['item_per_page'] ) {
				break;
			}
		endforeach;

		?>

	</div>

	<?php
	require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-portfolio/layout/loadmore.php';
	require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-portfolio/layout/popup.php';
	?>


</div>
