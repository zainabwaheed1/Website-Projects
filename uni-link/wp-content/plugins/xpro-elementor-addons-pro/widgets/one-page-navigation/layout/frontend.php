<?php
$responsive = ( 'none' !== $settings['horizontal_positions'] ) ? 'xpro-position-' . $settings['vertical_positions'] . $settings['horizontal_positions'] : '';
?>

<div class="xpro-one-page-nav-wrapper xpro-one-page-nav-<?php echo esc_attr( $settings['Orientation'] ); ?> <?php echo esc_attr( $responsive ); ?>">
	<ul class="xpro-one-page-nav">
		<?php foreach ( $settings['one_page_nav_list'] as $i => $item ) : ?>
			<li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
				<a href="#<?php echo esc_attr( $item['page_nav_section_id'] ); ?>" class="xpro-one-page-nav-anchor">
					<?php if ( $item['icon'] ) : ?>
						<div class="xpro-one-page-nav-icon">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === $item['enable_tooltip_text'] && $item['tooltip_text'] ) : ?>
						<div class="xpro-one-page-nav-tooltip"><?php echo esc_html( $item['tooltip_text'] ); ?></div>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
