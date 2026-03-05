<?php

use Elementor\Utils;

?>
<div class="xpro-logo-carousel-wrapper">
	<div id="xpro-logo-carousel-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-logo-carousel owl-carousel xpro-owl-theme xpro-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> xpro-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">
		<?php foreach ( $settings['logo_list'] as $index => $item ) { ?>
			<?php
			$image        = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
			$repeater_key = 'grid_item' . $index;
			$html_tag     = 'div';
			$this->add_render_attribute( $repeater_key, 'class', 'xpro-logo-carousel-item' );

			if ( $item['link']['url'] ) {
				$html_tag = 'a';
				$this->add_render_attribute( $repeater_key, 'class', 'xpro-logo-carousel-link' );
				$this->add_link_attributes( $repeater_key, $item['link'] );
			}
			?>
		<<?php echo esc_attr( $html_tag ); ?> <?php $this->print_render_attribute_string( $repeater_key ); ?>>
		<figure class="xpro-logo-carousel-figure">
			<?php
			if ( $image ) {
				echo wp_get_attachment_image(
					$item['image']['id'],
					$settings['thumbnail_size'],
					false,
					array(
						'class' => 'xpro-logo-grid-img elementor-animation-' . esc_attr( $settings['hover_animation'] ),
					)
				);
			} else {
				printf(
					'<img class="xpro-logo-grid-img elementor-animation-%s" src="%s" alt="%s">',
					esc_attr( $settings['hover_animation'] ),
					esc_url( $item['image']['url'] ),
					esc_attr( $item['name'] )
				);
			}
			?>
		</figure>
	</<?php echo esc_attr( $html_tag ); ?>>
	<?php } ?>
</div>
</div>
