<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
?>

<div class="xpro-rest-menu-wrapper xpro-rest-menu-<?php echo esc_attr( $settings['layout'] ); ?>">
	<div class="xpro-rest-menu-inner">
		<?php foreach ( $settings['menu_list'] as $i => $item ) : ?>
			<div class="xpro-rest-menu-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">

				<?php if ( 'icon' === $item['media_type'] || 'image' === $item['media_type'] || 'custom' === $item['media_type'] ) : ?>
					<span class="xpro-rest-menu-media">
					<?php
					if ( 'icon' === $item['media_type'] && $item['icon'] ) {
						Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) );
					}

					if ( 'image' === $item['media_type'] && $item['image'] ) {
						echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' ) );
					}

					if ( 'custom' === $item['media_type'] && $item['custom'] ) {
						?>
						<span class="xpro-rest-menu-media-custom"><?php echo esc_html( $item['custom'] ); ?></span>
						<?php
					}
					?>
				</span>
				<?php endif; ?>

				<div class="xpro-rest-menu-content">
					<div class="xpro-rest-menu-info">

						<?php
						if ( $item['title'] ) :
							$html_tag = ( $item['title_link']['url'] ) ? 'a' : 'div';
							$attr     = $item['title_link']['url'] ? ' href="' . $item['title_link']['url'] . '"' : '';
							$attr    .= $item['title_link']['is_external'] ? ' target="_blank"' : '';
							$attr    .= $item['title_link']['nofollow'] ? ' rel="nofollow"' : '';
							?>
							<!-- Title -->
							<<?php echo esc_attr( $html_tag ); ?> <?php xpro_elementor_kses( $attr ); ?> class="xpro-rest-menu-info-title">
								<?php echo esc_html( $item['title'] ); ?>
							</<?php echo esc_attr( $html_tag ); ?>>

						<?php endif; ?>

						<?php if ( $settings['show_sep'] ) : ?>
							<!-- Separator -->
							<div class="xpro-rest-menu-info-separator">
								<span></span>
							</div>
						<?php endif; ?>

						<?php if ( $item['price'] && 'before' === $settings['price_position'] ) : ?>
							<!-- Before Price -->
							<span class="xpro-rest-menu-info-price"><?php echo esc_html( $item['price'] ); ?></span>
						<?php endif; ?>

					</div>

					<?php if ( $item['description'] ) : ?>
						<!-- Text -->
						<p class="xpro-rest-menu-text"><?php xpro_elementor_kses( $item['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( $item['price'] && 'after' === $settings['price_position'] ) : ?>
						<!-- After Price -->
						<span class="xpro-rest-menu-info-price"><?php echo esc_html( $item['price'] ); ?></span>
					<?php endif; ?>

					<?php
					if ( $item['rest_btn'] && 'yes' === $item['show_btn'] ) :
						$btn_html_tag = ( $item['rest_btn_link']['url'] ) ? 'a' : 'span';
						$btn_attr     = $item['rest_btn_link']['url'] ? ' href="' . $item['rest_btn_link']['url'] . '"' : '';
						$btn_attr    .= $item['rest_btn_link']['is_external'] ? ' target="_blank"' : '';
						$btn_attr    .= $item['rest_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
						?>
						<<?php echo esc_attr( $btn_html_tag ); ?> <?php xpro_elementor_kses( $btn_attr ); ?> class="xpro-rest-menu-btn">
							<?php
							if ( $item['button_icon'] && 'before' === $item['rest_btn_icon_position'] ) {
								Icons_Manager::render_icon( $item['button_icon'], array( 'aria-hidden' => 'true' ) );
							}
							?>
							<?php echo esc_html( $item['rest_btn'] ); ?>
							<?php
							if ( $item['button_icon'] && 'after' === $item['rest_btn_icon_position'] ) {
								Icons_Manager::render_icon( $item['button_icon'], array( 'aria-hidden' => 'true' ) );
							}
							?>
						</<?php echo esc_attr( $btn_html_tag ); ?>>
					<?php endif; ?>

				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
