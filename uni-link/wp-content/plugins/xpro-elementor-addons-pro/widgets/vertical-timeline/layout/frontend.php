<div class="xpro-vertical-timeline-wrapper">
	<?php

	use Elementor\Group_Control_Image_Size;
	use Elementor\Icons_Manager;

	foreach ( $settings['vertical_timeline_item'] as $i => $item ) : ?>
		<div class="xpro-vertical-timeline-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
			<div class="xpro-vertical-timeline-inner">

				<div class="xpro-vertical-timeline-date">
					<div class="xpro-vertical-timeline-dates">
						<?php if ( 'image' === $item['date_media_type'] || 'custom' === $item['date_media_type'] || 'date_custom' === $item['date_media_type'] ) : ?>
							<!-- Media Type -->
							<?php
							if ( 'image' === $item['date_media_type'] && $item['date_image'] ) {
								echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'date_image_thumbnail', 'date_image' ) );
							}

							if ( 'custom' === $item['date_media_type'] && $item['title'] ) {
								echo '<span class="xpro-vertical-timeline-title">' . esc_html( $item['title'] ) . '</span>';
							}
							if ( 'custom' === $item['date_media_type'] && $item['date_custom'] ) {
								echo '<span class="xpro-vertical-timeline-time">' . esc_html( $item['date_custom'] ) . '</span>';
							}
							?>
						<?php endif; ?>
					</div>
				</div>

				<div class="xpro-vertical-timeline-media">
					<div class="xpro-vertical-timeline-media-box">
						<?php if ( 'icon' === $item['bullet_media_type'] || 'image' === $item['bullet_media_type'] || 'custom' === $item['bullet_media_type'] ) : ?>
							<!-- Media Type -->
							<div class="xpro-vertical-timeline-media">
								<?php
								if ( 'icon' === $item['bullet_media_type'] && $item['icon'] ) {
									Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) );
								}

								if ( 'image' === $item['bullet_media_type'] && $item['image'] ) {
									echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'bullet_image_thumbnail', 'image' ) );
								}

								if ( 'custom' === $item['bullet_media_type'] && $item['custom'] ) {
									echo '<span class="xpro-vertical-timeline-media-custom">' . esc_html( $item['custom'] ) . '</span>';
								}
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="xpro-vertical-timeline-content">
					<div class="xpro-vertical-timeline-content-inner">
						<?php if ( 'none' !== $item['content_media_type'] ) : ?>
							<!-- Media Type -->
							<div class="xpro-vertical-timeline-content-media">
								<?php
								if ( 'image' === $item['content_media_type'] && $item['content_image'] ) {
									echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'content_image_thumbnail', 'content_image' ) );
								}

								?>
							</div>
						<?php endif; ?>

						<div class="xpro-vertical-timeline-content-desc">

							<?php if ( $item['sub_title'] ) : ?>
								<!-- Title -->
								<h2 class="xpro-vertical-timeline-sub-title"><?php echo esc_html( $item['sub_title'] ); ?></h2>
							<?php endif; ?>

							<?php if ( $item['description'] ) : ?>
								<p class="xpro-vertical-timeline-text"><?php xpro_elementor_kses( $item['description'] ); ?></p>
							<?php endif; ?>

							<?php if ( $item['date_custom'] ) : ?>
								<span class="xpro-vertical-timeline-content-time"><?php echo esc_html( $item['date_custom'] ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
