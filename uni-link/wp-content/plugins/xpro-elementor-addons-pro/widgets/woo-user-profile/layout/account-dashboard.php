<div class="xpro-woo-up-myacc-dash">
	<!-- my account tabs -->
	<div class="xpro-woo-up-account-sec xpro-woo-top-main-sec">
		<?php

		use Elementor\Group_Control_Image_Size;
		use Elementor\Icons_Manager;

		$author_id       = get_the_author_meta( 'ID' );
		$current_user_id = get_current_user_id();

		$avatar_url = get_avatar_url( $current_user_id, array( 'size' => 100 ) );
		?>
		<div class="xpro-woo-avatar-main-cls xpro-woo-up-left-sec">
			<img class="xpro-woo-avatar-img" src="<?php echo esc_url( $avatar_url ); ?>" alt="not found">
		</div>

		<div class="xpro-woo-up-right-sec">
			<?php
			global $current_user;
			?>
			<div class="xpro-up-username">
				<?php echo esc_html( $current_user->display_name ); ?>
			</div>
			<div class="xpro-up-email">
				<?php echo esc_html( $current_user->user_email ); ?>
			</div>
		</div>
	</div>

	<!-- tabs list -->
	<div class="xpro-up-list-wrapper">
		<!-- dynamic list -->
		<?php foreach ( $settings['item'] as $i => $item ) { ?>
			<li class="xpro-up-list-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
				<?php
				$target   = $item['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
				echo ( $item['link']['url'] ) ? '<a href="' . esc_url( $item['link']['url'] ) . '" ' . esc_attr( $target ) . esc_attr( $nofollow ) . '>' : '';
				?>
				<?php if ( 'none' !== $item['media_type'] ) : ?>
					<div class="xpro-up-list-media xpro-up-list-media-type-<?php echo esc_attr( $item['media_type'] ); ?>">
						<?php
						if ( 'icon' === $item['media_type'] && $item['icon'] ) {
							Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) );
						}

						if ( 'image' === $item['media_type'] && $item['image'] ) {
							echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' ) );
						}

						if ( 'custom' === $item['media_type'] && $item['custom'] ) {
							echo '<i class="xpro-up-list-custom">' . esc_html( $item['custom'] ) . '</i>';
						}
						?>
					</div>
				<?php endif; ?>

				<div class="xpro-up-list-content">
					<?php if ( $item['title'] ) : ?>
						<h3 class="xpro-up-list-title">
							<?php echo esc_html( $item['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( $item['description'] ) : ?>
						<p class="xpro-up-list-desc">
							<?php echo esc_html( $item['description'] ); ?></p>
					<?php endif; ?>
				</div>
				<?php echo ( $item['link']['url'] ) ? '</a>' : ''; ?>
			</li>
		<?php } ?>
	</div>

	<?php if ( 'yes' === $settings['display_logout'] ) : ?>
		<div class="xpro-up-logout-wrapper">
			<li class="xpro-up-list-item">
				<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">
					<div class="xpro-up-list-media xpro-up-list-media-type-icon">
						<?php Icons_Manager::render_icon( $settings['logout_icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</div>
					<div class="xpro-up-list-content">
						<h3 class="xpro-up-list-title"><?php echo esc_html__( 'Logout', 'xpro-elementor-addons-pro' ); ?></h3>
					</div>
				</a>
			</li>
		</div>
	<?php endif; ?>

</div>
