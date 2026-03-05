<?php

$animation = ($settings['image_hover_animation']) ? ' elementor-animation-' . $settings['image_hover_animation'] : '';

$this->add_render_attribute( 'wrapper', 'class', 'xpro-image' . $animation );

$link = $this->get_link_url( $settings );

if ( $link ) {
	$this->add_link_attributes( 'link', $link );

	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
		$this->add_render_attribute( 'link', [
			'class' => 'elementor-clickable',
		] );
	}

	if ( 'custom' !== $settings['link_to'] ) {
		$this->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
	}
} ?>
    <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $link ) : ?>
            <a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<?php endif; ?>
				<?php echo (!empty($settings['image']['id'])) ? wp_get_attachment_image( $settings['image']['id'], $settings['thumbnail_size'] ) : '<img src="' . $settings['image']['url'] . '">'; ?>
                <?php if ( $link ) : ?>
            </a>
		<?php endif; ?>
    </div>
<?php
