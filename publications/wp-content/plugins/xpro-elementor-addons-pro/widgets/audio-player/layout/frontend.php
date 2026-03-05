<div class="xpro-audio-player">
	<div <?php $this->print_render_attribute_string( 'audio-player' ); ?>></div>
	<div id="jp_container_<?php echo esc_attr( $id ); ?>" class="jp-audio" role="application" aria-label="media player">
		<div class="jp-type-playlist">
			<div class="jp-gui jp-interface">
				<div class="jp-controls">

					<div class="xpro-player-control-item">
						<a href="javascript:void(0);" class="jp-play" tabindex="1" title="<?php esc_html_e( 'Play', 'xpro-elementor-addons-pro' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 42 42"><path d="M36.1 20.2 7.1.2C6.8 0 6.4-.1 6 .1c-.3.2-.5.5-.5.9v40c0 .4.2.7.5.9.2.1.3.1.5.1s.4-.1.6-.2l29-20c.3-.2.4-.5.4-.8s-.2-.6-.4-.8zM7.5 39.1V2.9L33.7 21 7.5 39.1z"/></svg>
						</a>
						<a href="javascript:void(0);" class="jp-pause" tabindex="1" title="<?php esc_html_e( 'Pause', 'xpro-elementor-addons-pro' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 42 42"><path d="M14.5 0c-.6 0-1 .4-1 1v40c0 .6.4 1 1 1s1-.4 1-1V1c0-.6-.4-1-1-1zM27.5 0c-.6 0-1 .4-1 1v40c0 .6.4 1 1 1s1-.4 1-1V1c0-.6-.4-1-1-1z"/></svg>
						</a>
					</div>

					<?php if ( 'yes' === $settings['seek_bar'] ) : ?>
						<div class="xpro-player-control-bar">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( 'time' === $settings['time_duration'] || 'both' === $settings['time_duration'] ) : ?>
						<div class="xpro-player-control-item">
							<div class="jp-current-time"></div>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === $settings['volume_mute'] ) : ?>
						<div class="xpro-player-control-item xpro-audio-player-mute">
							<a href="javascript:void(0);" class="jp-mute" tabindex="1" title="<?php esc_html_e( 'Mute', 'xpro-elementor-addons-pro' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 52 52"><path d="M28.4 3.4c-1-.6-2.1-.5-3.1 0l-.1.1L11.6 15H1c-.6 0-1 .4-1 1v19c0 .3.1.5.3.7s.4.3.7.3h10.6l13.5 12.4s.1.1.2.1c.5.3 1 .4 1.6.4.5 0 1-.1 1.5-.4 1-.6 1.6-1.6 1.6-2.8V6.2c0-1.2-.6-2.2-1.6-2.8zM28 45.9c0 .4-.2.8-.6 1-.2.1-.5.3-1 0L13 34.6V30c0-.6-.4-1-1-1s-1 .4-1 1v4H2V17h9v4c0 .6.4 1 1 1s1-.4 1-1v-4.5L26.4 5.1c.5-.2.9-.1 1 0 .4.2.6.6.6 1v39.8zM38.8 7.1c-.5-.2-1.1.1-1.3.6-.2.5.1 1.1.6 1.3C45.3 11.4 50 18 50 25.5s-4.8 14.1-11.8 16.6c-.5.2-.8.7-.6 1.3.1.4.5.7.9.7.1 0 .2 0 .3-.1C46.7 41.3 52 33.9 52 25.5c0-8.3-5.3-15.7-13.2-18.4z"/><path d="M43 25.5c0-6-4-11.3-9.7-13-.5-.2-1.1.2-1.2.7-.2.5.2 1.1.7 1.2 4.9 1.4 8.3 6 8.3 11s-3.4 9.6-8.3 11c-.5.2-.8.7-.7 1.2.1.4.5.7 1 .7h.3C39 36.8 43 31.5 43 25.5z"/></svg>
							</a>
							<a href="javascript:void(0);" class="jp-unmute" tabindex="1" title="<?php esc_html_e( 'Unmute', 'xpro-elementor-addons-pro' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 54 54"><path d="m46.4 26 7.3-7.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L45 24.6l-7.3-7.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l7.3 7.3-7.3 7.3c-.4.4-.4 1 0 1.4.2.2.5.3.7.3s.5-.1.7-.3l7.3-7.3 7.3 7.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L46.4 26zM28.4 4.4c-1-.6-2.1-.5-3.1 0l-.1.1L11.6 16H1c-.6 0-1 .4-1 1v19c0 .3.1.5.3.7s.4.3.7.3h10.6l13.5 12.4s.1.1.2.1c.5.3 1 .4 1.6.4.5 0 1-.1 1.5-.4 1-.6 1.6-1.6 1.6-2.8V7.2c0-1.2-.6-2.2-1.6-2.8zM28 46.8c0 .4-.2.8-.6 1-.2.1-.5.3-1 0L13 35.6V31c0-.6-.4-1-1-1s-1 .4-1 1v4H2V18h9v4c0 .6.4 1 1 1s1-.4 1-1v-4.5L26.4 6.1c.5-.2.9-.1 1 0 .4.2.6.6.6 1v39.7z"/></svg>
							</a>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === $settings['volume_bar'] ) : ?>
						<div class="xpro-player-control-item">
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
						</div>
					<?php endif; ?>

				</div>

			</div>
		</div>
	</div>
</div>
