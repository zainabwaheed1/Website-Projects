<?php
use Elementor\Icons_Manager;
?>
<div class="xpro-coupon-code-wrapper">
	<div <?php $this->print_render_attribute_string( 'coupon-data' ); ?>>
		<div class="xpro-coupon-msg" id="xpro-coupon-code-msg-<?php echo esc_attr( $this->get_id() ); ?>">
			<div class="xpro-coupon-msg-text">
				<?php if ( $settings['coupon_text_icon']['value'] ) : ?>
					<span class="xpro-button-icon-align xpro-margin-small-right">
							<?php
							Icons_Manager::render_icon(
								$settings['coupon_text_icon'],
								array(
									'aria-hidden' => 'true',
								)
							);
							?>
						</span>
				<?php endif; ?>
				<?php echo esc_html( $settings['coupon_text'] ); ?>
			</div>
			<div class="xpro-coupon-code-copied">
				<?php echo esc_html__( 'COPIED', 'xpro-elementor-addons-pro' ); ?>
			</div>
		</div>
		<div class="xpro-coupon-code-final" id="xpro-coupon-code-final-<?php echo esc_attr( $this->get_id() ); ?>">
			<span class="xpro-coupon-code-text"><?php echo esc_html( $settings['coupon_code'] ); ?></span>
			<span class="xpro-coupon-code-copied"><?php echo esc_html__( 'COPIED', 'xpro-elementor-addons-pro' ); ?></span>
		</div>
	</div>
</div>
