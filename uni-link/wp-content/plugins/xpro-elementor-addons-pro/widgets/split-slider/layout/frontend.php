<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Plugin;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;

?>

<div class="xpro-split-slider-wrapper xpro-slider-dots-<?php echo esc_attr( $settings['dots_orientation'] ?? 'horizontal' ); ?>-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">

	<div id="xpro-split-slider-left-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-split-slider-inner xpro-split-slider-1">
		<?php foreach ( $settings['split_slider_item_1'] as $slider_item_1 ) : ?>
		<div class="">
			<div class="slider-slide">
				<?php
				if ( 'dynamic' === $slider_item_1['split_slider_layout_1'] ) {
					Xpro_Elementor_Widget_Area_Utils::parse( $slider_item_1['split_slider_content_1'], $this->get_id(), $slider_item_1['_id'] );
				} elseif ( 'template' === $slider_item_1['split_slider_layout_1'] ) {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $slider_item_1['split_slider_template_1'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} elseif ( 'image' === $slider_item_1['split_slider_layout_1'] ) {
					?>
					<div class="xpro-split-slider-img">
						<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $slider_item_1, 'split_slider_media_thumbnail_1', 'split_slider_image_1' ) ); ?>
					</div><?php } else { ?>
				<div class="xpro-split-slider-content">
					<?php if ( $slider_item_1['split_slider_title_1'] ) { ?>
						<h4 class="xpro-split-slider-title"><?php echo wp_kses_post( $slider_item_1['split_slider_title_1'] ); ?></h4>
					<?php } ?>

					<?php if ( $slider_item_1['split_slider_description_1'] ) { ?>
						<div class="xpro-split-slider-text"><?php echo wp_kses_post( $slider_item_1['split_slider_description_1'] ); ?></div>
					<?php } ?>

					<?php
					if ( $slider_item_1['split_slider_btn_1'] ) {

						$html_tag_1 = ( $slider_item_1['split_slider_btn_link_1'] ) ? 'a' : 'span';
						$attr_1     = $slider_item_1['split_slider_btn_link_1']['url'] ? ' href="' . $slider_item_1['split_slider_btn_link_1']['url'] . '"' : '';
						$attr_1    .= $slider_item_1['split_slider_btn_link_1']['is_external'] ? ' target="_blank"' : '';
						$attr_1    .= $slider_item_1['split_slider_btn_link_1']['nofollow'] ? ' rel="nofollow"' : '';
						?>
					<<?php echo esc_attr( $html_tag_1 ); ?> <?php xpro_elementor_kses( $attr_1 ); ?>
					class="xpro-split-slider-btn"><?php echo esc_attr( $slider_item_1['split_slider_btn_1'] ); ?>
				</<?php echo esc_attr( $html_tag_1 ); ?>>
			<?php } ?>
			</div>
			<?php } ?>

		</div>
	</div>
	<?php endforeach; ?>
</div>

<div id="xpro-split-slider-right-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-split-slider-inner xpro-split-slider-2">
	<?php foreach ( $settings['split_slider_item_2'] as $slider_item_2 ) : ?>
	<div class="">
		<div class="slider-slide">
			<?php
			if ( 'dynamic' === $slider_item_2['split_slider_layout_2'] ) {
				Xpro_Elementor_Widget_Area_Utils::parse( $slider_item_2['split_slider_content_2'], $this->get_id(), $slider_item_2['_id'] );
			} elseif ( 'template' === $slider_item_2['split_slider_layout_2'] ) {
				echo Plugin::instance()->frontend->get_builder_content_for_display( $slider_item_2['split_slider_template_2'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} elseif ( 'image' === $slider_item_2['split_slider_layout_2'] ) {
				?>
				<div class="xpro-split-slider-img">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $slider_item_2, 'split_slider_media_thumbnail_2', 'split_slider_image_2' ) ); ?>
				</div>
				<?php
			} else {
				?>
			<div class="xpro-split-slider-content">
				<?php if ( $slider_item_2['split_slider_title_2'] ) { ?>
					<h4 class="xpro-split-slider-title"><?php echo wp_kses_post( $slider_item_2['split_slider_title_2'] ); ?></h4>
				<?php } ?>

				<?php if ( $slider_item_2['split_slider_description_2'] ) { ?>
					<div class="xpro-split-slider-text"><?php echo wp_kses_post( $slider_item_2['split_slider_description_2'] ); ?></div>
				<?php } ?>

				<?php
				if ( $slider_item_2['split_slider_btn_2'] ) {

					$html_tag_2 = ( $slider_item_2['split_slider_btn_link_2'] ) ? 'a' : 'span';
					$attr_2     = $slider_item_2['split_slider_btn_link_2']['url'] ? ' href="' . $slider_item_2['split_slider_btn_link_2']['url'] . '"' : '';
					$attr_2    .= $slider_item_2['split_slider_btn_link_2']['is_external'] ? ' target="_blank"' : '';
					$attr_2    .= $slider_item_2['split_slider_btn_link_2']['nofollow'] ? ' rel="nofollow"' : '';
					?>
				<<?php echo esc_attr( $html_tag_2 ); ?> <?php xpro_elementor_kses( $attr_2 ); ?>
				class="xpro-split-slider-btn"><?php echo esc_attr( $slider_item_2['split_slider_btn_2'] ); ?>
			</<?php echo esc_attr( $html_tag_2 ); ?>>
		<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php endforeach; ?>
</div>

<?php if ( 'yes' === $settings['dots'] ) { ?>
	<div class="slider-dots-box"></div>
<?php } ?>
</div>

<?php if ( 'yes' === $settings['nav'] ) { ?>
	<div class="xpro-slider-navigation xpro-slider-navigation-position-<?php echo esc_attr( $settings['nav_positions'] ); ?> xpro-slider-navigation-<?php echo esc_attr( $settings['nav_orientation'] ); ?>-<?php echo esc_attr( $settings['nav_layout'] ); ?>">
		<button type="button" class="slick-nav-prev" id="slick-nav-prev"></button>
		<button type="button" class="slick-nav-next" id="slick-nav-next"></button>
	</div>
<?php } ?>
