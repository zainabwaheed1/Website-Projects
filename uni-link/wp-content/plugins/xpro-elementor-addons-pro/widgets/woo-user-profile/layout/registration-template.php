<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

	<?php do_action( 'woocommerce_register_form_start' ); ?>


	<!-- disable default woo check to generate username -->
	<?php
	if ( 'yes' === $settings['disable_default_woo_check'] ) {
		?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_username"><?php esc_html_e( 'Username', 'xpro-elementor-addons-pro' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo esc_html( ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : '' ); ?>" required/>
		</p>

		<?php
	} else {
		?>
		<!-- if check no default woo check will work -->
		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_username"><?php esc_html_e( 'Username', 'xpro-elementor-addons-pro' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo esc_html( ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : '' ); ?>" required/>
			</p>

		<?php endif; ?>

	<?php } ?>


	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="reg_email"><?php esc_html_e( 'Email address', 'xpro-elementor-addons-pro' ); ?>&nbsp;<span
					class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo esc_url( ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : '' ); ?>" required/>
	</p>

	<!-- disable default check to auto generate password-->
	<?php
	if ( 'yes' === $settings['disable_default_woo_check'] ) {
		?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_password"><?php esc_html_e( 'Password', 'xpro-elementor-addons-pro' ); ?>&nbsp;<span
						class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required/>
		</p>
		<?php
	} else {
		?>
		<!-- if check no default woo check will work -->
		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_password"><?php esc_html_e( 'Password', 'xpro-elementor-addons-pro' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required/>
			</p>

		<?php else : ?>

			<p class="xpro-woo-info"><?php esc_html_e( 'A password will be sent to your email address.', 'xpro-elementor-addons-pro' ); ?></p>

		<?php endif; ?>
	<?php } ?>

	<?php do_action( 'woocommerce_register_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
		<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'xpro-elementor-addons-pro' ); ?>"><?php esc_html_e( 'Register', 'xpro-elementor-addons-pro' ); ?></button>
	</p>

	<?php do_action( 'woocommerce_register_form_end' ); ?>

</form>
