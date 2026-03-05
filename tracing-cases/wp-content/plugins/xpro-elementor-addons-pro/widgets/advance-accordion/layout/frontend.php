<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;
?>
<div class="xpro-accordion-wrapper xpro-accordion-align-<?php echo esc_attr( $settings['alignment'] ); ?>">
	<?php foreach ( $settings['accordion_items'] as $k => $item ) { ?>
		<div class="xpro-accordion-list<?php echo esc_attr( ( 'yes' === $item['default_active'] ) ? ' active' : '' ); ?>">
			<div class="xpro-accordion-header" data-tab="#xpro-accordion-<?php echo esc_attr( $item['_id'] ); ?>">

				<?php if ( 'icon' === $item['media_type'] ) : ?>
					<div class="xpro-accordion-icon">
						<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</div>
				<?php endif; ?>
				<?php if ( 'image' === $item['media_type'] ) : ?>
					<div class="xpro-accordion-image">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'media_thumbnail', 'image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $item['title'] ) ) : ?>
					<h3 class="xpro-accordion-title"><?php echo esc_html( $item['title'] ); ?></h3>
				<?php endif; ?>

				<?php if ( $settings['toggle_icon'] ) : ?>
					<span class="xpro-toggle-icon">
						<?php Icons_Manager::render_icon( $settings['toggle_icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</span>
				<?php endif; ?>

			</div>
			<div class="xpro-accordion-content">
				<?php
				if ( 'dynamic' === $item['source'] ) {
					Xpro_Elementor_Widget_Area_Utils::parse( $item['accordion_content'], $this->get_id(), $item['_id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} elseif ( 'template' === $item['source'] ) {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $item['accordion_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					xpro_elementor_kses( $item['editor'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
		</div>
	<?php } ?>
</div>
