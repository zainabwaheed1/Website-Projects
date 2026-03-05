<?php

use XproElementorAddons\Libs\Dashboard\Classes\Xpro_Elementor_Dashboard_Utils;

$user_settings = Xpro_Elementor_Dashboard_Utils::instance()->get_option( 'xpro_elementor_user_data', array() );
$api_key       = isset( $user_settings['mailchimp']['api_key'] ) ? $user_settings['mailchimp']['api_key'] : '';

?>

<form class="xpro-mailchimp-form xpro-mailchimp-layout-<?php echo esc_attr( $settings['mailchimp_layout'] ); ?>" id="xpro-mailchimp-form-<?php echo esc_attr( $this->get_id() ); ?>" method="POST" data-api-key="<?php echo esc_attr( $api_key ); ?>" data-list-id="<?php echo esc_attr( $settings['mailchimp_audience'] ); ?>" action="<?php echo esc_url( site_url() . '/wp-admin/admin-ajax.php?action=xpro_elementor_mailchimp_form&nonce=' . wp_create_nonce( 'xpro-mailchimp-nonce' ) ); ?>">
	<div class="xpro-mailchimp-subscribe-message"></div>
    <div class="xpro-mailchimp-fields">

		<?php if ( 'yes' === $settings['firstname_enable'] ) : ?>
			<!-- Name Field -->
			<div class="xpro-mailchimp-firstname">
				<?php echo '' !== $settings['firstname_label'] ? '<label for="xpro-mailchimp-first-name">' . esc_html( $settings['firstname_label'] ) . '</label>' : ''; ?>
				<input id="xpro-mailchimp-first-name" type="text" name="xpro_mailchimp_firstname" placeholder="<?php echo esc_attr( $settings['firstname_placeholder'] ); ?>">
			</div>
		<?php endif; ?>

		<?php if ( 'yes' === $settings['lastname_enable'] ) : ?>
			<!-- Name Field -->
			<div class="xpro-mailchimp-lastname">
				<?php echo '' !== $settings['lastname_label'] ? '<label for="xpro-mailchimp-last-name">' . esc_html( $settings['lastname_label'] ) . '</label>' : ''; ?>
				<input id="xpro-mailchimp-last-name" type="text" name="xpro_mailchimp_lastname" placeholder="<?php echo esc_attr( $settings['lastname_placeholder'] ); ?>">
			</div>
		<?php endif; ?>

		<!-- Email Field -->
		<div class="xpro-mailchimp-email">
			<?php echo '' !== $settings['email_label'] ? '<label for="xpro-mailchimp-email">' . esc_html( $settings['email_label'] ) . '</label>' : ''; ?>
			<input id="xpro-mailchimp-email" type="email" name="xpro_mailchimp_email" placeholder="<?php echo esc_attr( $settings['email_placeholder'] ); ?>" required="required">
		</div>

		<!-- Subscribe Button -->
		<div class="xpro-mailchimp-subscribe">
			<button type="submit" id="xpro-subscribe-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-mailchimp-subscribe-btn">
				<?php echo esc_html( $settings['btn_text'] ); ?>
				<i aria-hidden="true" class="fas fa-circle-notch"></i>
			</button>
		</div>
	</div>
</form>
