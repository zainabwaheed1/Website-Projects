<?php

use Elementor\Icons_Manager;
use XproElementorAddons\Libs\Dashboard\Classes\Xpro_Elementor_Dashboard_Utils;

$user_settings = Xpro_Elementor_Dashboard_Utils::instance()->get_option( 'xpro_elementor_user_data', array() );

$user_id      = isset( $user_settings['instagram']['user_id'] ) ? $user_settings['instagram']['user_id'] : '';
$access_token = isset( $user_settings['instagram']['access_token'] ) ? $user_settings['instagram']['access_token'] : '';

$xpro_instagram_feed_cache = '_' . $this->get_id() . '_instagram_cache';
$transient_key             = $user_id . $xpro_instagram_feed_cache;
$instagram_data            = get_transient( $transient_key );
$messages                  = array();

if ( false === $instagram_data && $access_token ) {
	$url            = 'https://graph.instagram.com/me/media/?fields=caption,id,media_type,media_url,permalink,thumbnail_url,timestamp,username&limit=100&access_token=' . esc_html( $access_token );
	$instagram_data = wp_remote_retrieve_body( wp_remote_get( $url ) );
	$instagram_data = json_decode( $instagram_data, true );
	set_transient( $transient_key, $instagram_data, 0 );
}

if ( 'yes' === $settings['remove_cache'] ) {
	delete_transient( $transient_key );
}

if ( empty( $access_token ) ) {
	$messages['invalid_token_id'] = __( 'Please set your instagram access token in "Xpro Elementor Addons Settings" to show your feed correctly', 'xpro-elementor-addons-pro' );
} elseif ( empty( $access_token ) || empty( $instagram_data ) ) {
	$messages['invalid_token_id'] = __( 'Please Input valid Access token', 'xpro-elementor-addons-pro' );
} elseif ( array_key_exists( 'error', $instagram_data ) ) {
	$messages['invalid_token'] = $instagram_data['error']['message'];
} elseif ( empty( $instagram_data['data'] ) ) {
	$messages['data_empty'] = __( 'Whoops! It seems like this account has not created any post yet. Please, make some post on Instagram.', 'xpro-elementor-addons-pro' );
}


if ( ! empty( $messages ) ) {
	foreach ( $messages as $key => $message ) {
		printf(
			'<div class="xpro-alert xpro-alert-warning" role="alert">
                        <span class="xpro-alert-description">%1$s</span>
                        </div>',
			esc_html( $message )
		);
	}
	return;
}

?>
<div class="xpro-elementor-gallery xpro-elementor-gallery-layout-<?php echo esc_attr( $settings['gallery_style'] ); ?>">
<!-- Main Gallery -->
<div class="pluginResize xpro-elementor-gallery-wrapper cbp">

	<?php
	$s = 0;
	foreach ( $instagram_data['data'] as $gid => $item ) :

		$caption = !empty($item['caption']) ? $item['caption'] : '';

		?>

		<!--Item-->
		<div class="cbp-item xpro-elementor-gallery-item">
			<div class="cbp-caption">
				<div class="cbp-caption-defaultWrap">

					<?php
					echo '<img src="' . esc_url( ( 'VIDEO' === $item['media_type'] ) ? $item['thumbnail_url'] : $item['media_url'] ) . '">';
					?>

				</div>
				<div class="cbp-caption-activeWrap">
					<div class="cbp-l-caption-alignCenter" data-xpro-lightbox data-src="<?php echo esc_url( ( 'VIDEO' === $item['media_type'] ) ? $item['thumbnail_url'] : $item['media_url'] ); ?>">
						<!-- Overlay -->
						<div class="cbp-l-caption-body">
							<?php if ( 'yes' === $settings['icon'] ) { ?>
								<!-- Icon -->
								<span class="xpro-overlay-icon">
									<?php Icons_Manager::render_icon( $settings['icon_name'], array( 'aria-hidden' => 'true' ) ); ?>
								</span>
							<?php } ?>

							<?php if ( 'yes' === $settings['caption'] ) { ?>
								<!-- Content -->
								<div class="xpro-overlay-content">
									<?php if ( ! empty( $caption ) && 'yes' === $settings['caption'] ) { ?>
										<h4 class="xpro-title"><?php echo esc_html( $caption ); ?></h4>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$s ++;
		if ( $s === $settings['item_per_page'] ) {
			break;
		}

	endforeach;
	?>

</div>
	<?php require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'instagram-feed/layout/loadmore.php'; ?>
</div>
