<?php
use Elementor\Plugin;
use Elementor\Utils;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;
?>

<div class="xpro-slider-wrapper xpro-slider-dots-<?php echo esc_attr( $settings['dots_orientation'] ?? 'horizontal' ); ?>-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">
	<div id="xpro-slider-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-slider xpro-slider-animation-<?php echo esc_attr( $settings['slide_animation'] ); ?>">
		<?php foreach ( $settings['slider_item'] as $i => $item ) { ?>
			<div class="slick-slide">
				<?php
				if ( 'dynamic' === $item['item_source'] ) {
					Xpro_Elementor_Widget_Area_Utils::parse( $item['item_content'], $this->get_id(), $item['_id'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $item['item_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
		<?php } ?>
	</div>
	<?php if ( 'yes' === $settings['nav'] ) : ?>
		<div class="xpro-slider-navigation xpro-slider-navigation-position-<?php echo esc_attr( $settings['nav_positions'] ?? 'default' ); ?> xpro-slider-navigation-<?php echo esc_attr( $settings['nav_orientation'] ?? 'horizontal' ); ?>-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?>"></div>
	<?php endif; ?>
</div>

<?php if ( $settings['thumbs'] ) : ?>
	<!--Slider Thumbs-->
	<div class="xpro-slider-thumbs-wrapper">
		<div class="xpro-slider-thumbs xpro-thumbs-layout-<?php echo esc_attr( $settings['thumbs_layout'] ); ?> xpro-thumbs-orientation-<?php echo esc_attr( $settings['thumbs_orientation'] ); ?>">
			<?php foreach ( $settings['slider_item'] as $i => $item ) { ?>
				<div class="slick-slide">
					<div class="xpro-slider-thumb-image">
						<?php
						if ( ! empty( $item['thumbnail']['id'] ) ) {
							echo wp_get_attachment_image( $item['thumbnail']['id'], 'thumbnail' );
						} else {
							?>
							<img src="<?php echo esc_url( $item['thumbnail']['url'] ); ?>" alt="thumb">
							<?php
						}
						?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>
