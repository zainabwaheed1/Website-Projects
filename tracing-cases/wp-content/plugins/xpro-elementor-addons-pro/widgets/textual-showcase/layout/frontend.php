<?php

use Elementor\Group_Control_Image_Size;

?>

<div class="xpro-textual-showcase-wrapper">
	<div class="xpro-textual-showcase-item">
		<?php foreach ( $settings['textual_item'] as $i => $items ) : ?>

			<?php if ( 'text' === $items['layout'] ) { ?>
				<span class="elementor-repeater-item-<?php echo esc_attr( $items['_id'] ); ?> xpro-textual-showcase-txt"><?php echo esc_attr( $items['textual_text'] ); ?></span>
			<?php } ?>

			<?php if ( 'image' === $items['layout'] ) { ?>
				<span class=" elementor-repeater-item-<?php echo esc_attr( $items['_id'] ); ?> xpro-textual-showcase-img<?php echo ( $items['textual_normal_image']['url'] && $items['textual_hover_image']['url'] ) ? ' xpro-textual-showcase-hover-effect' : ''; ?>">
				<span class="xpro-textual-showcase-img-normal">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $items, 'textual_media_thumbnail', 'textual_normal_image' ) ); ?>
				</span>
				<span class="xpro-textual-showcase-img-hover">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $items, 'textual_media_thumbnail', 'textual_hover_image' ) ); ?>
				</span>
			</span>
			<?php } ?>

		<?php endforeach; ?>
	</div>
</div>

