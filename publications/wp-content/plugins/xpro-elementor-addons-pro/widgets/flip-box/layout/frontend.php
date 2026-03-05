<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
?>
<div class="xpro-flip-box-wrapper<?php echo esc_attr( ( 'yes' === $settings['3d_depth'] ) ? ' xpro-flip-box-3d' : '' ); ?> xpro-animate-<?php echo esc_attr( $settings['flip_animation_style'] ); ?>">
	<div class="xpro-flip-box-inner">
		<!-- Front Side -->
		<div class="xpro-flip-box-front">
			<?php if ( $settings['front_badge_text'] ) { ?>
				<!-- Badge -->
				<span class="xpro-flip-box-badge xpro-badge xpro-badge-<?php echo esc_attr( $settings['front_badge_position'] ); ?>"><?php echo esc_attr( $settings['front_badge_text'] ); ?></span>
			<?php } ?>
			<div class="xpro-flip-box-front-inner">
				<div class="xpro-flip-box-wrap">
					<div class="xpro-flip-box-wrap-inner">
						<?php if ( 'icon' === $settings['front_media_type'] || 'image' === $settings['front_media_type'] ) : ?>
							<span class="xpro-flip-icon-image">
							<?php
							if ( 'icon' === $settings['front_media_type'] && $settings['front_icon'] ) {
								Icons_Manager::render_icon( $settings['front_icon'], array( 'aria-hidden' => 'true' ) );
							}
							if ( 'image' === $settings['front_media_type'] ) {
								echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_media_thumbnail', 'front_image' ) );
							}
							?>
						</span>
						<?php endif; ?>

						<?php if ( $settings['front_separator'] && 'before' === $settings['front_separator_position'] ) { ?>
							<!-- Before Separator -->
							<div class="xpro-flip-box-separator"></div>
						<?php } ?>

						<?php if ( $settings['front_title'] ) { ?>
							<!-- Title -->
							<h2 class="xpro-flip-title"><?php echo esc_html( $settings['front_title'] ); ?></h2>
						<?php } ?>

						<?php if ( $settings['front_separator'] && 'after' === $settings['front_separator_position'] ) { ?>
							<!-- After Separator -->
							<div class="xpro-flip-box-separator"></div>
						<?php } ?>


						<?php if ( $settings['front_description'] ) { ?>
							<!-- Description -->
							<div class="xpro-flip-content">
								<div class="xpro-flip-text"><?php echo wp_kses_post( $settings['front_description'] ); ?></div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<!-- Back Side -->
		<div class="xpro-flip-box-back">
			<div class="xpro-flip-box-back-inner">
				<div class="xpro-flip-box-wrap">
					<div class="xpro-flip-box-wrap-inner">
						<?php if ( 'icon' === $settings['back_media_type'] || 'image' === $settings['back_media_type'] ) : ?>
							<span class="xpro-flip-icon-image">
							<?php
							if ( 'icon' === $settings['back_media_type'] && $settings['back_icon'] ) {
								Icons_Manager::render_icon( $settings['back_icon'], array( 'aria-hidden' => 'true' ) );
							}
							if ( 'image' === $settings['back_media_type'] ) {
								echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_media_thumbnail', 'back_image' ) );
							}
							?>
						</span>
						<?php endif; ?>

						<?php if ( $settings['back_separator'] && 'before' === $settings['back_separator_position'] ) { ?>
							<!-- Before Separator -->
							<div class="xpro-flip-box-separator"></div>
						<?php } ?>

						<?php if ( $settings['back_title'] ) { ?>
							<!-- Title -->
							<h2 class="xpro-flip-title"><?php echo esc_html( $settings['back_title'] ); ?></h2>
						<?php } ?>

						<?php if ( $settings['back_separator'] && 'after' === $settings['back_separator_position'] ) { ?>
							<!-- Before Separator -->
							<div class="xpro-flip-box-separator"></div>
						<?php } ?>

						<?php if ( $settings['back_description'] ) { ?>
							<!-- Description -->
							<div class="xpro-flip-content">
								<div class="xpro-flip-text"><?php echo wp_kses_post( $settings['back_description'] ); ?></div>
							</div>
						<?php } ?>

						<?php
						if ( $settings['back_btn'] && $settings['back_btn_text'] ) {
							$target   = $settings['back_btn_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $settings['back_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
							echo '<a class="xpro-flip-box-btn" href="' . esc_attr( $settings['back_btn_link']['url'] ) . '"' . esc_attr( $target ) . esc_attr( $nofollow ) . '>' . esc_html( $settings['back_btn_text'] ) . '</a>';
						}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
