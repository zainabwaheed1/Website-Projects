<?php
use Elementor\Icons_Manager;
use Elementor\Plugin;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area_Utils;
?>
<div class="xpro-unfold-wrapper xpro-unfold-<?php echo esc_attr( $settings['trigger'] ); ?>">
	<div class="xpro-unfold-inner">
		<?php if ( $settings['title'] ) : ?>
			<!-- Title -->
			<h2 class="xpro-unfold-title"><?php echo esc_html( $settings['title'] ); ?></h2>
		<?php endif; ?>

		<div class="xpro-unfold-content">
			<div class="xpro-unfold-content-inner">
				<?php
				if ( 'dynamic' === $settings['source'] ) {
					Xpro_Elementor_Widget_Area_Utils::parse( $settings['unfold_content'], $this->get_id(), 99 );
				} elseif ( 'template' === $settings['source'] ) {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['unfold_template'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					?>
					<p class="xpro-unfold-content-txt"><?php xpro_elementor_kses( $settings['editor'] ); ?></p>
					<?php
				}
				?>
			</div>
		</div>

		<button class="xpro-unfold-btn xpro-unfold-align-icon-<?php echo esc_attr( $settings['icon_position'] ); ?>">

			<?php if ( $settings['unfold_icon']['value'] ) : ?>
				<span class="xpro-unfold-media icon1">
				<?php Icons_Manager::render_icon( $settings['unfold_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
			<?php endif; ?>

			<?php if ( $settings['fold_icon']['value'] ) : ?>
				<span class="xpro-unfold-media icon2">
				<?php Icons_Manager::render_icon( $settings['fold_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
			<?php endif; ?>

			<?php if ( $settings['button_unfold_text'] || $settings['button_fold_text'] ) : ?>
				<span class="xpro-unfold-btn-text btn1"><?php echo esc_html( $settings['button_unfold_text'] ); ?></span>
				<span class="xpro-unfold-btn-text btn2"><?php echo esc_html( $settings['button_fold_text'] ); ?></span>
			<?php endif; ?>

		</button>
	</div>
</div>
