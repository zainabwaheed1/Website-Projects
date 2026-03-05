<?php

use Elementor\Icons_Manager;

if ( 'yes' === $settings['search_redirect'] ) {
	$search_id   = 's';
	$search_name = 's';
} else {
	$search_id   = 'xpro_elementor_search_keyword';
	$search_name = 'xpro_elementor_search_keyword';
}
?>

<form class="xpro-elementor-search-wrapper xpro-elementor-search-layout-<?php echo esc_attr( $settings['layout'] ); ?>" method="get" id="searchform" autocomplete="off" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-ajaxURL="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'xpro-live-search-nonce' ) ); ?>" role="search">

	<div class="xpro-elementor-search-inner">
		<label class="sr-only" for="s"><?php esc_html_e( 'Search', 'xpro-elementor-addons-pro' ); ?></label>
		<div class="xpro-elementor-search-input-group">
			<input class="field form-control xpro-search-keyword-cls" name="<?php echo esc_attr( $search_id ); ?>" id="<?php echo esc_attr( $search_name ); ?>" type="text" placeholder="<?php echo esc_html( $settings['placeholder'] ); ?>" value="<?php the_search_query(); ?>">
			<?php if ( '4' !== $settings['layout'] && '5' !== $settings['layout'] ) : ?>
				<button id="searchsubmit" class="xpro-elementor-search-button" type="submit">
					<?php
					if ( 'text' === $settings['button_type'] ) {
						echo esc_html( $settings['button_text'] );
					} else {
						Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
					}
					?>
				</button>
			<?php endif; ?>
		</div>
		<input type="hidden" name="post_type" value="<?php echo esc_html( $settings['post_type'] ); ?>">
		<?php if ( '4' === $settings['layout'] || '5' === $settings['layout'] ) : ?>
			<button class="xpro-elementor-search-button-close" type="button">
			</button>
		<?php endif; ?>
		<!-- ajax fetch wrapper -->
		<div class="xpro-ajax-data-fetch-wrapper xpro-ajax-data-fetch-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
			<div id="xpro_elementor_live_search_data_fetch" class="xpro-ajax-live-search-posts"></div>
		</div>
		<!-- ajax fetch wrapper end-->
	</div>

	<?php if ( '4' === $settings['layout'] || '5' === $settings['layout'] ) : ?>
		<button class="xpro-elementor-search-button" type="button">
			<?php
			if ( 'text' === $settings['button_type'] ) {
				echo esc_html( $settings['button_text'] );
			} else {
				Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
			}
			?>
		</button>
	<?php endif; ?>
</form>
