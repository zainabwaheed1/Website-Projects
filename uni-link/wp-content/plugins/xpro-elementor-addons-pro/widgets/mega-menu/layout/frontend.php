<?php use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use XproElementorAddonsPro\Xpro_Mega_Menu_Walker;
?>

<div class="xpro-mega-menu-wrapper xpro-mega-menu-layout-<?php echo esc_attr( $settings['layout'] ); ?> xpro-mega-menu-responsive-<?php echo esc_attr( $settings['responsive_breakpoint'] ); ?> xpro-push-<?php echo esc_attr( $settings['responsive_entrance_animation'] ); ?>">

	<?php if ( 'none' !== $settings['responsive_breakpoint'] ) { ?>
	<!--Toggle Button-->
	<div class="xpro-mega-menu-toggle-wrapper">
		<button role="button" class="xpro-mega-menu-toggle-btn">
			<?php if ( $settings['hamburger_toggle_text'] ) : ?>
			<span class="xpro-mega-menu-toggle-btn-text"><?php echo esc_html( $settings['hamburger_toggle_text'] ); ?></span>
			<?php endif; ?>
			<?php Icons_Manager::render_icon( $settings['hamburger_toggle_icon'], array( 'aria-hidden' => 'true' ) ); ?>
		</button>
	</div>
	<div class="xpro-mega-menu-overlay"></div>
	<?php } ?>

	<div class="xpro-mega-menu-inner">
		<?php if ( 'none' !== $settings['responsive_breakpoint'] ) { ?>
		<!--Close Button-->
		<button role="button" class="xpro-mega-menu-closed-btn">
			<?php Icons_Manager::render_icon( $settings['hamburger_close_icon'], array( 'aria-hidden' => 'true' ) ); ?>
		</button>
			<?php
			if ( $settings['logo']['id'] || $settings['logo']['url'] ) {
				$attr  = 'custom' === $settings['logo_link_type'] && $settings['logo_link']['is_external'] ? ' target="_blank"' : '';
				$attr .= 'custom' === $settings['logo_link_type'] && $settings['logo_link']['nofollow'] ? ' rel="nofollow"' : '';
				$attr .= 'custom' === $settings['logo_link_type'] && $settings['logo_link']['url'] ? ' href="' . $settings['logo_link']['url'] . '"' : ' href="' . home_url() . '"';
				?>
			<a <?php echo $attr; ?> class="xpro-mega-menu-logo">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'logo' ); ?>
			</a>
				<?php
			}
		}

		if ( ! empty( $settings['nav_menu'] ) ) {
			wp_nav_menu(
				array(
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'container'       => 'div',
					'container_id'    => 'xpro-mega-menu-' . $settings['nav_menu'],
					'container_class' => 'xpro-mega-menu-navbar',
					'menu_id'         => 'main-menu',
					'menu'            => $settings['nav_menu'],
					'menu_class'      => 'xpro-mega-menu-navbar-nav',
					'link_before'     => '<span class="menu-item-title">',
					'link_after'      => '</span>',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'walker'          => ( class_exists( '\XproElementorAddonsPro\Xpro_Mega_Menu_Walker' ) ? new Xpro_Mega_Menu_Walker() : '' ),
					'sub_indicator'   => $settings['submenu_icon'],
				)
			);
		}
		?>
	</div>

</div>
