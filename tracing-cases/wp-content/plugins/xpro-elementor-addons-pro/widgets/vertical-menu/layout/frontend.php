<div class="xpro-elementor-vertical-menu-wrapper xpro-elementor-vertical-menu-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
	<?php

	if ( ! empty( $settings['nav_menu'] ) ) {
		wp_nav_menu(
			array(
				'menu'            => $settings['nav_menu'],
				'container_class' => 'xpro-elementor-vertical-navbar',
				'menu_class'      => 'xpro-elementor-vertical-navbar-nav',
				'fallback_cb'     => 'wp_page_menu',
				'echo'            => true,
				'walker'          => new Xpro_Elementor_Navwalker(),
			)
		);
	}

	?>
</div>
