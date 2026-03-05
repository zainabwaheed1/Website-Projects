<div class="xpro-text-marquee-wrapper">
	<div class="xpro-text-marquee-inner">
		<div class="xpro-text-marquee-media xpro-animate-<?php echo esc_attr( $settings['text_marquee_direction'] ); ?>">
			<?php foreach ( $settings['text_marquee_item'] as $items ) : ?>

				<?php if ( $items['text_marquee'] ) { ?>
					<span class="xpro-text-marquee-txt"><?php echo esc_html( $items['text_marquee'] ); ?></span>
				<?php } ?>

			<?php endforeach; ?>
			<?php foreach ( $settings['text_marquee_item'] as $items ) : ?>

				<?php if ( $items['text_marquee'] ) { ?>
					<span class="xpro-text-marquee-txt"><?php echo esc_html( $items['text_marquee'] ); ?></span>
				<?php } ?>

			<?php endforeach; ?>
		</div>
	</div>
</div>

