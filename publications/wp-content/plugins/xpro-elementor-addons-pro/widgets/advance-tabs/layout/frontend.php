<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;

$postition  = $settings['tabs_position'];
$layout     = ( 'horizontal' === $postition ) ? $settings['tabs_horizontal_layout'] : $settings['tabs_vertical_layout'];
$responsive = ( 'none' !== $settings['tabs_responsive_type'] ) ? ' xpro-tab-' . $settings['tabs_responsive_type'] . '-' . $settings['tabs_responsive_show'] : '';

?>

<div id="xpro-tab-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-tab-main xpro-tabs-<?php echo esc_attr( $postition ); ?> xpro-tab-layout-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $responsive ); ?>">

	<!-- Tab List Wrapper-->
	<div class="xpro-tab-list-wrapper">

		<div class="xpro-tab-select-option">
			<span class="xpro-tab-select-content"></span>
			<i class="fas fa-chevron-down"></i>
		</div>

		<!-- Tab List-->
		<ul class="xpro-tab-list">

			<?php

			foreach ( $settings['tab_items'] as $i => $item ) {
				$tab_count = $i + 1;
				?>

				<li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?><?php echo esc_attr( ( 1 === $tab_count ) ? ' active' : '' ); ?>">

					<a href="#xpro-tab-<?php echo esc_attr( $item['_id'] ); ?>" data-text="<?php echo esc_attr( $tab_count ); ?>">

						<div class="xpro-tab-media-wrapper">
							<?php if ( 'icon' === $item['media_type'] ) : ?>
								<div class="xpro-tab-icon">
									<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
								</div>
							<?php endif; ?>
							<?php if ( 'image' === $item['media_type'] ) : ?>
								<div class="xpro-tab-media-image">
									<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'media_thumbnail', 'image' ) ); ?>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $item['title'] ) ) : ?>
							<span class="xpro-tab-title"><?php echo esc_html( $item['title'] ); ?></span>
						<?php endif; ?>

					</a>

				</li>

				<?php
			}

			?>

		</ul>
	</div>

	<!-- Tab Content Wrapper-->
	<div class="xpro-tab-content-wrapper">

		<?php

		foreach ( $settings['tab_items'] as $i => $item ) {

			$tab_count = $i + 1;

			?>

			<!-- Tab Content -->
			<a class="tab-accordion-label elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?><?php echo ( 1 === $tab_count ) ? ' active' : ''; ?>" href="#xpro-tab-<?php echo esc_attr( $item['_id'] ); ?>" data-text="<?php echo esc_attr( $tab_count ); ?>">

				<div class="xpro-tab-media-wrapper">
					<?php if ( 'icon' === $item['media_type'] ) : ?>
						<div class="xpro-tab-media-icon">
							<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</div>
					<?php endif; ?>
					<?php if ( 'image' === $item['media_type'] ) : ?>
						<div class="xpro-tab-media-image">
							<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'media_thumbnail', 'image' ) ); ?>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $item['title'] ) ) : ?>
					<span><?php echo esc_html( $item['title'] ); ?></span>
				<?php endif; ?>

			</a>
			<div class="xpro-tab-content animated<?php echo ( 'none' !== $settings['tab_animation'] ) ? ' ' . esc_attr( $settings['tab_animation'] ) : ''; ?><?php echo esc_attr( ( 1 === $tab_count ) ) ? ' active' : ''; ?>" id="xpro-tab-<?php echo esc_attr( $item['_id'] ); ?>">
				<?php
				if ( 'dynamic' === $item['source'] ) {
					Xpro_Elementor_Widget_Area_Utils::parse( $item['tab_content'], $this->get_id(), $item['_id'] );
				} elseif ( 'template' === $item['source'] ) {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $item['tab_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					xpro_elementor_kses( $item['editor'] );
				}
				?>
			</div>

			<?php
		}

		?>

	</div>

</div>

