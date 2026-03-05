<?php
/**
 * Nav menu page MegaMenu trigger template
 */

defined( 'ABSPATH' ) || exit;
?>
<script>
	var xpro_megamenu_trigger_markup = `
	<div class="xpro-megamenu-trigger" id="xpro-megamenu-trigger">
		<div class="xpro-toggle">
			<input id="xpro-menu-metabox-input-is-enabled" <?php checked( ( isset( $data['is_enabled'] ) ? $data['is_enabled'] : '' ), '1' ); ?> type="checkbox" class="xpro-toggle__check xpro-menu-is-enabled" name="is_enabled" value="1">
			<b class="xpro-toggle__switch"></b>
			<b class="xpro-toggle__track"></b>
		</div>
		<h3 class="xpro-dashboard-widgets__item-title">
			<label for="xpro-menu-metabox-input-is-enabled">Enable Mega Menu</label>
		</h3>
	</div>
	`;
	var xpro_megamenu_nonce = `<?php echo esc_attr( wp_create_nonce( 'wp_rest' ) ); ?>`;
	var xpro_admin_ajax = `<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>`;
</script>
