<?php
use Elementor\Plugin;
add_filter( 'woocommerce_account_menu_items', array( $this, 'customize_my_account_tabs' ) );
?>

<div class="xpro-woo-my-account-wrap xpro-woocommerce-my-account-wrapper">
	<?php do_action( 'xpro_elementor_woo_before_my_account_wrap' ); ?>

	<div class="xpro-woo-product-my-account xpro-woo-my-account-position-<?php echo esc_attr( $settings['tabs_position'] ); ?>">
		<?php do_action( 'xpro_elementor_woo_before_my_account_content', $settings ); ?>
		<?php
		if ( ! empty( $settings['endpoint'] ) && Plugin::instance()->editor->is_edit_mode() ) {
			global $wp;
			$wp->query_vars[ $settings['endpoint'] ] = 1;
		}
		add_filter( 'woocommerce_account_menu_items', array( $this, 'customize_my_account_tabs' ) );

		if ( Plugin::$instance->editor->is_edit_mode() ) {
			?>
			<div class="woocommerce">
				<?php
				/**
				 * My Account navigation template.
				 */
				wc_get_template( 'myaccount/navigation.php' );
				?>
				<div class="woocommerce-MyAccount-content">
					<?php
					/**
					 * My Account content.
					 */
					if ( '' === $settings['endpoint'] ) {
						wc_get_template(
							'myaccount/dashboard.php',
							array(
								'current_user' => get_user_by( 'id', get_current_user_id() ),
							)
						);
					} elseif ( 'orders' === $settings['endpoint'] ) {
						$current_page    = empty( $current_page ) ? 1 : absint( $current_page );
						$customer_orders = wc_get_orders(
							apply_filters(
								'woocommerce_my_account_my_orders_query',
								array(
									'customer' => get_current_user_id(),
									'page'     => $current_page,
									'paginate' => true,
								)
							)
						);
						wc_get_template(
							'myaccount/orders.php',
							array(
								'current_page'    => absint( $current_page ),
								'customer_orders' => $customer_orders,
								'has_orders'      => 0 < $customer_orders->total,
							)
						);
					} elseif ( 'downloads' === $settings['endpoint'] ) {
						if ( is_null( WC()->cart ) ) {
							wc_load_cart();
						}
						wc_get_template( 'myaccount/downloads.php', array( 'user' => get_user_by( 'id', get_current_user_id() ) ) );
					} elseif ( 'edit-address' === $settings['endpoint'] ) {
						$load_address = '';
						$page_title   = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'xpro-elementor-addons-pro' ) : esc_html__( 'Shipping address', 'xpro-elementor-addons-pro' );
						do_action( 'woocommerce_before_edit_account_address_form' );
						?>
						<?php if ( ! $load_address ) : ?>
							<?php wc_get_template( 'myaccount/my-address.php' ); ?>
						<?php else : ?>
							<form method="post">
                                <h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3><?php // @codingStandardsIgnoreLine
								?>
								<div class="woocommerce-address-fields">
									<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
									<div class="woocommerce-address-fields__field-wrapper">
										<?php
										foreach ( $address as $key => $field ) {
											woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
										}
										?>
									</div>
									<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
									<p>
										<button type="submit" class="button" name="save_address"
												value="<?php esc_attr_e( 'Save address', 'xpro-elementor-addons-pro' ); ?>"><?php esc_html_e( 'Save address', 'xpro-elementor-addons-pro' ); ?></button>
										<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
										<input type="hidden" name="action" value="edit_address"/>
									</p>
								</div>
							</form>
						<?php endif; ?>
						<?php
						do_action( 'woocommerce_after_edit_account_address_form' );
					} elseif ( 'edit-account' === $settings['endpoint'] ) {
						wc_get_template( 'myaccount/form-edit-account.php', array( 'user' => get_user_by( 'id', get_current_user_id() ) ) );
					}
					?>
				</div>
			</div>
			<?php
		} else {
			if ( ! ( Plugin::$instance->editor->is_edit_mode() ) && is_account_page() ) {
				echo do_shortcode( '[woocommerce_my_account]' );
			} else {
				?>
				<div class="xpro-alert xpro-alert-warning" role="alert">
					<span class="xpro-elementor-alert-title">
						<?php esc_html_e( 'Notice - Woo My Account', 'xpro-elementor-addons-pro' ); ?>
					</span>
					<span class="xpro-elementor-alert-description">
						<?php esc_html_e( 'Set your current page as default My Account Page under Woocommerce > Advanced > My Account Page to make this widget works properly.', 'xpro-elementor-addons-pro' ); ?>
					</span>
				</div>
				<?php
			}
		}
		remove_filter( 'woocommerce_account_menu_items', array( $this, 'customize_my_account_tabs' ) );
		?>
		<?php do_action( 'xpro_elementor_woo_after_my_account_content', $settings ); ?>
	</div>

	<?php do_action( 'xpro_elementor_woo_after_my_account_wrap' ); ?>
</div>
