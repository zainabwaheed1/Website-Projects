<?php

use XproElementorAddons\Inc\Xpro_Elementor_Widget_List;
use XproElementorAddons\Libs\Xpro_Elementor_Dashboard;

	$license_status = get_option( 'xpro_elementor_license_status', 'invalid' );
	$license_action = ( 'invalid' !== $license_status ) ? 'deactivate_license' : 'activate_license';

?>
<div class="xpro-dashboard">
	<form method="POST" id="xpro-dashboard-settings-form-license" data-id="6632" data-action="<?php echo esc_attr( $license_action ); ?>" data-name="xpro-elementor-addons-pro" data-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'xpro_elementor_license_nonce' ) ); ?>">

		<!-- Xpro Dasboard Header -->
		<div class="xpro-dashboard-header">
			<div class="xpro-row">
				<div class="xpro-col-6">
					<div class="xpro-dashboard-header-info">
						<a href="<?php echo esc_url( 'https://elementor.wpxpro.com/' ); ?>" target="_blank" class="xpro-dashboard-header-logo">
							<img src="<?php echo esc_url( XPRO_ELEMENTOR_ADDONS_ASSETS . '/admin/images/xpro-logo-dark.png' ); ?>" alt="xpro-logo">
						</a>
					</div>
				</div>
				<div class="xpro-col-6">
					<div class="xpro-dashboard-header-panel">
						<span class="xpro-elementor-addon-version">
							<?php echo esc_html__( 'Version: ', 'xpro-elementor-addons-pro' ) . XPRO_ELEMENTOR_ADDONS_PRO_VERSION; // phpcs:ignore ?>
						</span>
						<span class="xpro-elementor-addon-package">
							<?php echo esc_html__( 'License: ', 'xpro-elementor-addons-pro' ) . ucwords( xpro_elementor_get_package_type() ); // phpcs:ignore ?>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="xpro-dashboard-body">
			<div class="xpro-row">

				<div class="xpro-col-lg-9">
					<!--Nav Tabs-->
					<div class="xpro-dashboard-tabs-wrapper">
						<ul class="xpro-dashboard-tabs">
							<li class="active">
								<a href="#xpro-license" class="xpro-dashboard-tab-link-license">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25.045 25.003"><path data-name="Path 3" d="M24.286 19.115c-.459-.018-.92-.005-1.38-.006h-.875a5.157 5.157 0 0 0-10.208 0H1.032c-.678 0-1.034.255-1.036.739s.358.743 1.032.743h10.821a5.133 5.133 0 0 0 1.779 3.195 5.116 5.116 0 0 0 6.462.133 5.171 5.171 0 0 0 1.941-3.328h.389c.621 0 1.243.012 1.864-.007a.735.735 0 1 0 0-1.469m-7.352 4.4a3.669 3.669 0 1 1 3.688-3.707 3.681 3.681 0 0 1-3.688 3.707"/><path data-name="Path 4" d="M1.02 5.884H3a5.15 5.15 0 0 0 10.2 0h10.852c.644 0 1-.261 1-.737s-.346-.727-1-.727H13.23C12.35 1.535 10.738.097 8.31.005a5 5 0 0 0-3.035.851A5.17 5.17 0 0 0 3.011 4.42h-1.99c-.662 0-1 .243-1.013.716s.345.748 1.02.748M8.16 1.473a3.678 3.678 0 1 1-3.736 3.634A3.686 3.686 0 0 1 8.16 1.473"/></svg>
									<?php echo esc_html__( 'License', 'xpro-elementor-addons-pro' ); ?>
								</a>
							</li>
						</ul>
					</div>

					<!--Nav Tabs Content-->
					<div class="xpro-dashboard-content-wrapper">
						<div class="xpro-dashboard-tab-content xpro-dashboard-tab-dashboard active" id="xpro-license">
							<div class="xpro-dashboard-tab-content-inner">
								<!--Header Area-->
								<div class="xpro-dashboard-tab-content-header">
									<!--Header Title-->
									<h2 class="xpro-dashboard-tab-content-title">
										<?php echo esc_html__( 'License Details', 'xpro-elementor-addons-pro' ); ?>
									</h2>
								</div>

								<div class="xpro-dashboard-tab-content-body">
									<div class="xpro-dashboard-license-table">
										<div class="xpro-license-result-error"><?php echo esc_html__( 'License is not valid, Please provide valid license key.', 'xpro-elementor-addons-pro' ); ?></div>
										<div class="xpro-dashboard-license-table-row">
											<h3 class="xpro-dashboard-license-label"><?php echo esc_html__( 'Plugin Version : ', 'xpro-elementor-addons-pro' ); ?></h3>
											<p class="xpro-dashboard-license-detail"><?php echo esc_html__( 'Xpro Elementor Addons - Pro V', 'xpro-elementor-addons-pro' ) . XPRO_ELEMENTOR_ADDONS_PRO_VERSION; // phpcs:ignore ?></p>
										</div>
										<div class="xpro-dashboard-license-table-row">
											<label for="xpro-dashboard-license-label-input" class="xpro-dashboard-license-label"><?php echo esc_html__( 'License Key : ', 'xpro-elementor-addons-pro' ); ?></label>
											<input type="password" required placeholder="-----------" id="xpro-dashboard-license-label-input" autocomplete="off" value="<?php echo !empty(get_option( 'xpro_elementor_license_data' )) ? '********************************' : ''; // phpcs:ignore ?>"/>
										</div>
										<div class="xpro-dashboard-license-table-row">
											<label for="xpro-dashboard-license-label-input" class="xpro-dashboard-license-label">License Status : </label>
											<span class="xpro-dashboard-license-status<?php echo ( 'invalid' !== $license_status ) ? esc_attr( ' active' ) : ''; ?>"><?php echo ( 'invalid' !== $license_status ) ? esc_html__( 'Active', 'xpro-elementor-addons-pro' ) : esc_html__( 'Not Active', 'xpro-elementor-addons-pro' ); // phpcs:ignore ?></span>
										</div>
										<div class="xpro-dashboard-license-table-row">
											<h3 class="xpro-dashboard-license-label"><?php echo esc_html__( 'Expiry Date : ', 'xpro-elementor-addons-pro' ); ?></h3>
											<p class="xpro-dashboard-license-detail"><?php echo ( get_option( 'xpro_elementor_license_expires' ) ? get_option( 'xpro_elementor_license_expires' ) : '0000-00-00' ); // phpcs:ignore ?></p>
										</div>
										<button type="submit" class="xpro-dashboard-license-submit"><span><?php echo ( 'invalid' !== $license_status ) ? esc_html__( 'Deactivate License', 'xpro-elementor-addons-pro' ) : esc_html__( 'Activate License', 'xpro-elementor-addons-pro' ); // phpcs:ignore ?></span> <i class="dashicons dashicons-update d-none" aria-hidden="true"></i></button>
									</div>
								</div>

							</div>
						</div>
					</div>

					<!--Help & Support-->
					<div class="xpro-dashboard-support-wrapper">
						<div class="xpro-dashboard-support-content">
							<h4 class="xpro-dashboard-label"><?php echo esc_html__( 'Need Help?', 'xpro-elementor-addons-pro' ); ?></h4>
							<h3><?php echo esc_html__( 'Expert Support', 'xpro-elementor-addons-pro' ); ?></h3>
							<p><?php echo esc_html__( 'Feel like consulting our support team? Contact our 24/7 user support and we will happily assist you with any.', 'xpro-elementor-addons-pro' ); ?></p>
							<a target="_blank" href="<?php echo esc_url( 'https://elementor.wpxpro.com/docs' ); ?>" ><?php echo esc_html__( 'Contact Us', 'xpro-elementor-addons-pro' ); ?></a>
						</div>
						<div class="xpro-dashboard-support-image">
							<img src="<?php echo esc_url( XPRO_ELEMENTOR_ADDONS_ASSETS . '/admin/images/support-image-1.png' ); ?>" alt="support">
						</div>
					</div>
				</div>

				<div class="xpro-col-lg-3">
					<div class="xpro-dashboard-sidebar">
						<div class="xpro-dashboard-social-wrapper">
							<h4 class="xpro-dashboard-label"><?php echo esc_html__( 'Our Social', 'xpro-elementor-addons-pro' ); ?></h4>
							<div class="xpro-dashboard-social-list">
								<a href="https://www.facebook.com/xproelementor/" target="_blank"><i class="dashicons dashicons-facebook-alt" aria-hidden="true"></i></a>
								<a href="https://www.instagram.com/xproelementor/" target="_blank"><i class="dashicons dashicons-instagram" aria-hidden="true"></i></a>
								<a href="https://twitter.com/xproelementor" target="_blank"><i class="dashicons dashicons-twitter" aria-hidden="true"></i></a>
							</div>
						</div>
						<div class="xpro-dashboard-widget-count-wrapper">
							<?php
							$widgets_all  = Xpro_Elementor_Widget_List::instance()->get_list();
							$widget_count = array();
							foreach ( $widgets_all as $i => $w ) {
								if ( 'pro-disabled' !== $w['package'] ) {
									$widget_count[ $w['slug'] ] = $w;
								}
							}

							if ( ! Xpro_Elementor_Dashboard::instance()->utils->get_option( 'xpro_elementor_widget_list' ) ) {
								$widgets_active = get_option( 'xpro_elementor_widget_list', array_keys( $widget_count ) );
							} else {
								$widgets_active = Xpro_Elementor_Widget_List::instance()->get_list( false, '', 'active' );
							}

							?>
							<h4 class="xpro-dashboard-label">
								<?php echo esc_html__( 'Overview', 'xpro-elementor-addons-pro' ); ?>
							</h4>
							<ul class="xpro-dashboard-widget-count-list">
								<li>
									<span class="xpro-dashboard-widget-count">
										<?php echo esc_html( count( $widgets_all ) ); ?>
									</span>
									<span class="xpro-dashboard-widget-count-text">
										<?php echo esc_html__( 'Widgets', 'xpro-elementor-addons-pro' ); ?></span>
								</li>
								<li>
									<span class="xpro-dashboard-widget-count">
										<?php echo esc_html( count( $widgets_active ) ); ?>
									</span>
									<span class="xpro-dashboard-widget-count-text">
										<?php echo esc_html__( 'Active', 'xpro-elementor-addons-pro' ); ?>
									</span>
								</li>
								<li>
									<span class="xpro-dashboard-widget-count">
										<?php echo esc_html( ( count( $widgets_all ) - count( $widgets_active ) ) ); ?>
									</span>
									<span class="xpro-dashboard-widget-count-text">
										<?php echo esc_html__( 'Inactive', 'xpro-elementor-addons-pro' ); ?>
									</span>
								</li>
							</ul>
							<div class="xpro-dashboard-widget-count-btn-wrapper">
								<a target="_blank" href="<?php echo esc_url( 'https://elementor.wpxpro.com/widgets' ); ?>" class="xpro-dashboard-widget-count-btn">
									<?php echo esc_html__( 'Explore Widgets', 'xpro-elementor-addons-pro' ); ?>
								</a>
							</div>
						</div>
						<div class="xpro-dashboard-featured-wrapper">
							<h4 class="xpro-dashboard-label"><?php echo esc_html__( 'Featured Widgets', 'xpro-elementor-addons-pro' ); ?></h4>
							<?php
							$featured = array(
								'multi-layer-slider' => array(
									'title'       => __( 'Multi Layer Slider', 'xpro-elementor-addons-pro' ),
									'icon'        => 'xi xi-multi-layer-slider',
									'description' => __( 'Powerful slider to create eye-popping slides for your websites.', 'xpro-elementor-addons-pro' ),
									'url'         => 'https://elementor.wpxpro.com/multi-layer-slider/',
								),
								'advanced-portfolio' => array(
									'title'       => __( 'Advanced Portfolio', 'xpro-elementor-addons-pro' ),
									'icon'        => 'xi xi-advance-portfolio',
									'description' => __( 'Design amazing portfolios using our premium layouts & hover effects.', 'xpro-elementor-addons-pro' ),
									'url'         => 'https://elementor.wpxpro.com/advanced-portfolio/',
								),
								'advanced-gallery'   => array(
									'title'       => __( 'Advanced Gallery', 'xpro-elementor-addons-pro' ),
									'icon'        => 'xi xi-advance-gallery',
									'description' => __( 'The most advanced gallery widget to create beautiful layouts.', 'xpro-elementor-addons-pro' ),
									'url'         => 'https://elementor.wpxpro.com/advanced-gallery/',
								),
							);
							?>
							<div class="xpro-dashboard-featured-carousel owl-carousel">
								<?php $f_count = 1; foreach ( $featured as $i => $item ) { ?>
									<div data-item="<?php echo esc_attr( $f_count ); ?>" class="xpro-dashboard-featured-item">
										<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
										<h3><?php echo esc_html( $item['title'] ); ?></h3>
										<p><?php echo esc_html( $item['description'] ); ?></p>
										<a target="_blank" href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html__( 'Discove More', 'xpro-elementor-addons-pro' ); ?></a>
									</div>
									<?php $f_count ++; } ?>
							</div>
						</div>
						<div class="xpro-dashboard-documentation-wrapper">
							<h4 class="xpro-dashboard-label"><?php echo esc_html__( 'Documentation', 'xpro-elementor-addons-pro' ); ?></h4>
							<p><?php echo esc_html__( 'We have prepared comprehensive documentation for you to get the most of our powerful Elementor Widgets. Let’s understand how our widgets work.', 'xpro-elementor-addons-pro' ); ?></p>
							<a target="_blank" href="<?php echo esc_url( 'https://elementor.wpxpro.com/docs' ); ?>" ><?php echo esc_html__( 'View Documentation', 'xpro-elementor-addons-pro' ); ?></a>
						</div>
					</div
				</div>

			</div>
		</div>

	</form>
</div>
