<?php
use Elementor\Icons_Manager;
use Elementor\Utils;

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
			<ul class="cbp-l-filters-button" data-default-filter="<?php echo esc_html( $this->_default_filter ); ?>">

				<?php if ( 'yes' === $settings['filter_all'] ) : ?>
					<li class="cbp-filter-item-active cbp-filter-item" data-filter="*"><?php echo esc_html( $settings['filter_all_text'] ? $settings['filter_all_text'] : '' ); ?></li>
				<?php endif; ?>

				<?php
				foreach ( $simple_gallery['menu'] as $key => $val ) {

					echo '<li class="cbp-filter-item" data-filter=".' . esc_attr( $key ) . '">' . esc_html( $val ) . '</li>';

				}
				?>

			</ul>

		</div>
	<?php endif; ?>

	<!-- Main Gallery -->
	<div class="pluginResize xpro-elementor-gallery-wrapper cbp">

		<?php
		if ( 'simple' === $settings['gallery_type'] ) {

			$s = 0;

			foreach ( $simple_gallery['items'] as $gid => $item ) :

				$attachment = xpro_elementor_get_attachment( $gid );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

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
											<?php if ( ! empty( $description ) && 'yes' === $settings['description'] ) { ?>
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
				$s ++;
				if ( $s === $settings['item_per_page'] ) {
					break;
				}

			endforeach;
		}
		?>

		<?php
		if ( 'album' === $settings['gallery_type'] ) {

			$b = 0;

			foreach ( $album_gallery as $key => $item ) :

				$attachment = xpro_elementor_get_attachment( $item['image']['id'] );

				$caption     = ! empty( $attachment && $attachment['caption'] ) ? $attachment['caption'] : '';
				$description = ! empty( $attachment && $attachment['description'] ) ? $attachment['description'] : '';

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
											<?php if ( ! empty( $description ) && 'yes' === $settings['description'] ) { ?>
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
				$b ++;
				if ( $b === $settings['item_per_page'] ) {
					break;
				}
			endforeach;
		}
		?>

	</div>

	<?php require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-gallery/layout/loadmore.php'; ?>

</div>
