<div class="xpro-image-accordion-wrapper">
	<?php foreach ( $settings['image_accordion_item'] as $i => $item ) : ?>

	<div class="xpro-image-accordion-item xpro-image-accordion-<?php echo esc_attr( $settings['trigger'] ); ?> <?php echo esc_attr( ( 'yes' === $item['active'] ) ? 'active' : '' ); ?>" style="background-image: url('<?php echo esc_url( $item['image']['url'] ); ?>'); ">
		<div class="xpro-image-accordion-content">
			<div class="xpro-image-accordion-cont-wrap animated <?php echo esc_attr( $settings['content_animation'] ); ?>">
				<?php if ( $item['title'] ) : ?>
					<<?php echo esc_attr($item['title_tag']); ?> class="xpro-image-accordion-title"><?php echo esc_html( $item['title'] ); ?></<?php echo esc_attr($item['title_tag']); ?>>
				<?php endif; ?>

				<?php if ( $item['description'] ) : ?>
					<p class="xpro-image-accordion-text"><?php xpro_elementor_kses( $item['description'] ); ?></p>
				<?php endif; ?>

				<?php
				$title_tag   = ( $item['button_link']['url'] ) ? 'a' : 'span';
				$title_attr  = $item['button_link']['is_external'] ? ' target="_blank"' : '';
				$title_attr .= $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
				$title_attr .= $item['button_link']['url'] ? ' href="' . $item['button_link']['url'] . '"' : '';
				?>

				<?php if ( $item['button_text'] ) : ?>
				<<?php echo esc_attr( $title_tag ); ?> <?php echo $title_attr; ?>
				class="xpro-image-accordion-btn"><?php echo esc_attr( $item['button_text'] ); ?>
			</<?php echo esc_attr( $title_tag ); ?>>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endforeach; ?>
</div>
