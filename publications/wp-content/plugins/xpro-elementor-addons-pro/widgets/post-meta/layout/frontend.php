<?php

ob_start();
if ( ! empty( $settings['xpro-post-meta-list'] ) ) {
	foreach ( $settings['xpro-post-meta-list'] as $repeater_item ) {
		$this->render_item( $repeater_item );
	}
}
$items_html = ob_get_clean();

if ( empty( $items_html ) ) {
	return;
}

if ( 'inline' === $settings['view'] ) {
	$this->add_render_attribute( 'xpro-post-meta-list', 'class', 'xpro-post-meta-inline' );
}

$this->add_render_attribute( 'xpro-post-meta-list', 'class', 'xpro-post-meta' );
?>
	<ul <?php $this->print_render_attribute_string( 'xpro-post-meta-list' ); ?>>
		<?php xpro_elementor_kses( $items_html ); ?>
	</ul>
<?php
