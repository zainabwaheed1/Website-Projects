<div class="xpro-list-portfolio-wrapper">

	<?php if ( '1' === $settings['layout'] ) : ?>

		<div class="xpro-list-portfolio-half">

			<div class="xpro-list-portfolio-menu-wrapper">
				<ul class="xpro-list-portfolio-items">
					<?php foreach ( $settings['portfolio'] as $key => $item ) { ?>
						<li data-xpro-title="<?php echo esc_attr( $item['title_text'] ); ?>" data-xpro-image-id="<?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['title_text'] ) ); ?>" data-xpro-thumb="<?php echo esc_url( wp_get_attachment_image_url( $item['image']['id'], 'thumbnail', false ) ); ?>" class="xpro-list-item <?php echo esc_attr( ( 0 === $key ) ? 'active' : '' ); ?> xpro-preview-type-<?php echo esc_attr( $settings['preview_type'] ); ?>" data-src-preview="<?php echo esc_url( $item['preview_link'] ); ?>"><?php echo esc_attr( $item['title_text'] ); ?></li>
					<?php } ?>
				</ul>
			</div>

			<div class="xpro-list-portfolio-image-wrapper">
				<?php foreach ( $settings['portfolio'] as $key => $item ) { ?>
					<figure class="<?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['title_text'] ) ); ?><?php echo ( 0 === $key ) ? ' active' : ''; ?>">
						<?php
						if ( $item['image']['id'] ) {
							echo wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'], false );
						} else {
							echo '<img src="' . esc_url( $item['image']['url'] ) . '">';
						}
						?>
					</figure>
				<?php } ?>
			</div>

		</div>

	<?php endif; ?>

	<?php if ( '2' === $settings['layout'] ) : ?>

		<div class="xpro-list-portfolio-full">

			<div class="xpro-list-portfolio-menu-wrapper">
				<ul class="xpro-list-portfolio-items">
					<?php foreach ( $settings['portfolio'] as $key => $item ) { ?>
						<li data-xpro-title="<?php echo esc_attr( $item['title_text'] ); ?>" data-xpro-image-id="<?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['title_text'] ) ); ?>" data-xpro-thumb="<?php echo esc_url( wp_get_attachment_image_url( $item['image']['id'], 'thumbnail', false ) ); ?>" class="xpro-list-item xpro-preview-type-<?php echo esc_attr( $settings['preview_type'] ); ?>" data-src-preview="<?php echo esc_url( $item['preview_link'] ); ?>"><?php echo esc_attr( $item['title_text'] ); ?></li>
					<?php } ?>
				</ul>
			</div>

			<div class="xpro-list-portfolio-image-wrapper">
				<?php foreach ( $settings['portfolio'] as $key => $item ) { ?>
					<figure class="<?php echo esc_attr( xpro_elementor_friendly_str_replace( $item['title_text'] ) ); ?>">
						<?php
						if ( $item['image']['id'] ) {
							echo wp_get_attachment_image( $item['image']['id'], $settings['thumbnail_size'], false );
						} else {
							echo '<img src="' . esc_url( $item['image']['url'] ) . '">';
						}
						?>
					</figure>
				<?php } ?>
			</div>

		</div>

	<?php endif; ?>

	<?php require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'list-portfolio/layout/popup.php'; ?>

</div>
