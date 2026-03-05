<?php use Elementor\Plugin;

$due_date = gmdate( 'M d Y G:i:s', strtotime( $settings['due_date'] ) ); ?>
<div class="xpro-countdown-wrapper">
	<ul class="xpro-countdown xpro-countdown-separator-<?php echo esc_attr( $settings['separator'] ); ?>"
		data-date="<?php echo esc_attr( $due_date ); ?>">
		<li class="xpro-countdown-item xpro-countdown-item-days">
			<span data-days class="xpro-countdown-time xpro-countdown-days">0</span>
			<?php if ( $settings['label_days'] ) : ?>
				<span class="xpro-countdown-label xpro-countdown-label-days"><?php echo esc_html( $settings['label_days'] ); ?></span>
			<?php endif; ?>
		</li>
		<li class="xpro-countdown-item xpro-countdown-item-hours">
			<span data-hours class="xpro-countdown-time xpro-countdown-hours">0</span>
			<?php if ( $settings['label_hours'] ) : ?>
				<span class="xpro-countdown-label xpro-countdown-label-hours"><?php echo esc_html( $settings['label_hours'] ); ?></span>
			<?php endif; ?>
		</li>
		<li class="xpro-countdown-item xpro-countdown-item-minutes">
			<span data-minutes class="xpro-countdown-time xpro-countdown-minutes">0</span>
			<?php if ( $settings['label_minutes'] ) : ?>
				<span class="xpro-countdown-label xpro-countdown-label-minutes"><?php echo esc_html( $settings['label_minutes'] ); ?></span>
			<?php endif; ?>
		</li>
		<li class="xpro-countdown-item xpro-countdown-item-seconds">
			<span data-seconds class="xpro-countdown-time xpro-countdown-seconds">0</span>
			<?php if ( $settings['label_seconds'] ) : ?>
				<span class="xpro-countdown-label xpro-countdown-label-seconds"><?php echo esc_html( $settings['label_seconds'] ); ?></span>
			<?php endif; ?>
		</li>
	</ul>
	<?php if ( 'message' === $settings['end_action_type'] || 'template' === $settings['end_action_type'] ) : ?>
		<div class="xpro-countdown-content xpro-countdown-content-type-<?php echo esc_attr( $settings['end_action_type'] ); ?>">
			<?php
			if ( 'message' === $settings['end_action_type'] ) {
				xpro_elementor_kses( $settings['end_message'] );
			}
			?>
			<?php
			if ( 'template' === $settings['end_action_type'] ) {
				echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	<?php endif; ?>
</div>
