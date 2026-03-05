<?php

use Elementor\Group_Control_Image_Size;

$direction = ($settings['image_marque_orientation'] === 'vertical') ? $settings['image_marquee_vertical_direction'] : $settings['image_marquee_horizontal_direction'];

?>

<div class="xpro-img-marquee-wrapper xpro-img-marquee-<?php echo esc_attr( $settings['image_marque_orientation'] ); ?>">
	<div class="xpro-img-marquee-inner">
		<div class="xpro-img-marquee-media xpro-animate-<?php echo esc_attr( $direction ); ?>">
			<?php foreach ( $settings['image_marquee_item'] as $items ) : ?>

				<?php if ( $items['image_marquee'] ) { ?>
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $items, 'marquee_media_thumbnail', 'image_marquee' ) ); ?>
				<?php } ?>

			<?php endforeach; ?>
		</div>

		<div class="xpro-img-marquee-media xpro-animate-<?php echo esc_attr( $direction ); ?>-copy">
			<?php foreach ( $settings['image_marquee_item'] as $items ) : ?>

				<?php if ( $items['image_marquee'] ) { ?>
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $items, 'marquee_media_thumbnail', 'image_marquee' ) ); ?>
				<?php } ?>

			<?php endforeach; ?>
		</div>
	</div>
</div>

