<div class="xpro-facebook-feed-wrapper xpro-facebook-feed-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
	<?php

	use Elementor\Utils;
	use XproElementorAddons\Libs\Dashboard\Classes\Xpro_Elementor_Dashboard_Utils;

	$user_settings = Xpro_Elementor_Dashboard_Utils::instance()->get_option( 'xpro_elementor_user_data', array() );

	$page_id      = isset( $user_settings['facebook']['app_id'] ) ? $user_settings['facebook']['app_id'] : '';
	$access_token = isset( $user_settings['facebook']['access_token'] ) ? $user_settings['facebook']['access_token'] : '';

	$xpro_facebook_feed_cash = '_' . $this->get_id() . '_facebook_cash';
	$transient_key           = $page_id . $xpro_facebook_feed_cash;
	$facebook_feed_data      = get_transient( $transient_key );
	$messages                = array();

	if ( false === $facebook_feed_data ) {
		$url_queries        = 'fields=status_type,created_time,from,message,story,full_picture,permalink_url,attachments.limit(1){type,media_type,title,description,unshimmed_url},comments.summary(total_count),reactions.summary(total_count)';
		$url                = "https://graph.facebook.com/v4.0/{$page_id}/posts?{$url_queries}&access_token={$access_token}";
		$data               = wp_remote_get( $url );
		$facebook_feed_data = json_decode( wp_remote_retrieve_body( $data ), true );
		set_transient( $transient_key, $facebook_feed_data, 0 );
	}

	if ( 'yes' === $settings['remove_cache'] ) {
		delete_transient( $transient_key );
	}

	if ( ! empty( $facebook_feed_data ) && array_key_exists( 'error', $facebook_feed_data ) ) {
		$messages['error'] = $facebook_feed_data['error']['message'];
	}

	if ( ! empty( $messages ) ) {
		foreach ( $messages as $key => $message ) {
			printf( '<div class="xpro-alert xpro-alert-warning">%1$s</div>', esc_html( $message ) );
		}
		return;
	}

	switch ( $settings['sort_by'] ) {
		case 'old-posts':
			usort(
				$facebook_feed_data['data'],
				function ( $a, $b ) {
					if ( strtotime( $a['created_time'] ) === strtotime( $b['created_time'] ) ) {
						return 0;
					}
					return ( strtotime( $a['created_time'] ) < strtotime( $b['created_time'] ) ? -1 : 1 );
				}
			);
			break;
		case 'like_count':
			usort(
				$facebook_feed_data['data'],
				function ( $a, $b ) {
					if ( $a['reactions']['summary'] === $b['reactions']['summary'] ) {
						return 0;
					}
					return ( $a['reactions']['summary'] > $b['reactions']['summary'] ) ? -1 : 1;
				}
			);
			break;
		case 'comment_count':
			usort(
				$facebook_feed_data['data'],
				function ( $a, $b ) {
					if ( $a['comments']['summary'] === $b['comments']['summary'] ) {
						return 0;
					}
					return ( $a['comments']['summary'] > $b['comments']['summary'] ) ? -1 : 1;
				}
			);
			break;
		default:
			$facebook_feed_data;
	}

	$items = $facebook_feed_data['data'];
	if ( ! empty( $settings['post_limit'] ) ) {
		$items = array_splice( $items, 0, $settings['post_limit'] );
	}
	$link_target = 'target="_blank"';
	if ( ! empty( $settings['link_target'] ) && '_self' === $settings['link_target'] ) {
		$link_target = 'target="_self"';
	}

	?>
	<div class="xpro-facebook-feed-grid">
		<?php
		foreach ( $items as $item ) :
				$page_url   = "https://facebook.com/{$item['from']['id']}";
				$avatar_url = "https://graph.facebook.com/v4.0/{{$item['from']['id']}/picture";

				$description = ! empty( $item['message'] ) ? explode( ' ', $item['message'] ) : array();
			if ( ! empty( $settings['description_word_count'] ) && count( $description ) > $settings['description_word_count'] ) {
				$description_shorten = array_slice( $description, 0, $settings['description_word_count'] );
				$description         = implode( ' ', $description_shorten ) . '...';
			} else {
				$description = ! empty( $item['message'] ) ? $item['message'] : '';
			}
			?>
				<div class="xpro-facebook-feed-item">

					<?php if ( 'yes' === $settings['show_feature_image'] && ! empty( $item['full_picture'] ) ) : ?>
						<div class="xpro-facebook-feed-feature-image">
							<img src="<?php echo esc_url( ( $item['full_picture'] ) ? $item['full_picture'] : Utils::get_placeholder_image_src() ); ?>" alt="<?php esc_url( $item['from']['name'] ); ?>">
							<?php if ( 'yes' === $settings['show_likes_comments'] && '3' === $settings['layout'] ) : ?>
								<div class="xpro-facebook-footer">
									<div class="xpro-facebook-meta">
										<div class="xpro-facebook-likes">
											<?php echo esc_html( $item['reactions']['summary']['total_count'] ); ?>
											<i class="far fa-thumbs-up"></i>
										</div>
										<div class="xpro-facebook-comments">
											<?php echo esc_html( $item['comments']['summary']['total_count'] ); ?>
											<i class="far fa-comment"></i>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endif ?>

				<div class="xpro-facebook-content-wrapper">
					<?php if ( 'yes' === $settings['show_user_image'] || 'yes' === $settings['show_name'] || 'yes' === $settings['show_date'] ) : ?>
					<div class="xpro-facebook-author">
						<?php if ( 'yes' === $settings['show_user_image'] ) : ?>
							<a href="<?php echo esc_url( $page_url ); ?>" <?php echo wp_kses_post( $link_target ); ?>>
								<img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $item['from']['name'] ); ?>" class="xpro-facebook-avatar">
							</a>
						<?php endif; ?>

						<?php if ( '4' !== $settings['layout'] ) : ?>
								<div class="xpro-facebook-user">
								<?php if ( 'yes' === $settings['show_name'] ) : ?>
								<a href="<?php echo esc_url( $page_url ); ?>" class="xpro-facebook-author-name" <?php echo wp_kses_post( $link_target ); ?>>
									<?php echo esc_html( $item['from']['name'] ); ?>
								</a>
							<?php endif; ?>

								<?php if ( 'yes' === $settings['show_date'] ) : ?>
								<div class="xpro-facebook-date">
									<?php echo esc_html( gmdate( 'M d Y', strtotime( $item['created_time'] ) ) ); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( 'yes' === $settings['show_description'] || 'yes' === $settings['read_more'] ) : ?>
						<div class="xpro-facebook-content">
						<?php if ( 'yes' === $settings['show_description'] && ! empty( $description ) ) : ?>
							<p><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>
						<?php
						if ( 'yes' === $settings['read_more'] ) :
							?>
							<a href="<?php echo esc_url( $item['permalink_url'] ); ?>" <?php echo wp_kses_post( $link_target ); ?> class="xpro-facebook-feed-readmore">
								<?php echo esc_html( $settings['read_more_text'] ); ?>
							</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( 'yes' === $settings['show_likes_comments'] && '3' !== $settings['layout'] ) : ?>
						<div class="xpro-facebook-footer">
							<div class="xpro-facebook-meta">
								<div class="xpro-facebook-likes">
									<?php echo esc_html( $item['reactions']['summary']['total_count'] ); ?>
									<i class="far fa-thumbs-up"></i>
									<?php esc_html_e( 'Like', 'xpro-elementor-addons-pro' ); ?>
								</div>
								<div class="xpro-facebook-comments">
									<?php echo esc_html( $item['comments']['summary']['total_count'] ); ?>
									<i class="far fa-comment"></i>
									<?php esc_html_e( 'comment', 'xpro-elementor-addons-pro' ); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				</div>
			<?php endforeach; ?>
	</div>
</div>


