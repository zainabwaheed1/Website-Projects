<?php

use Elementor\Icons_Manager;

$primary_tag   = ( $settings['button_primary_link']['url'] ) ? 'a' : 'span';
$primary_attr  = ( $settings['button_primary_css_id'] ) ? ' id="' . $settings['button_primary_css_id'] . '"' : '';
$primary_attr .= $settings['button_primary_link']['is_external'] ? ' target="_blank"' : '';
$primary_attr .= $settings['button_primary_link']['nofollow'] ? ' rel="nofollow"' : '';
$primary_attr .= $settings['button_primary_link']['url'] ? ' href="' . $settings['button_primary_link']['url'] . '"' : '';
$primary_attr .= ( $settings['button_primary_onclick_event'] ) ? ' onclick="' . $settings['button_primary_onclick_event'] . '"' : '';

if ( $settings['button_primary_link']['custom_attributes'] ) {
	$attributes = explode( ',', $settings['button_primary_link']['custom_attributes'] );

	foreach ( $attributes as $attribute ) {
		if ( ! empty( $attribute ) ) {
			$custom_attr = explode( '|', $attribute, 2 );
			if ( ! isset( $custom_attr[1] ) ) {
				$custom_attr[1] = '';
			}
			$primary_attr .= ' ' . $custom_attr[0] . '="' . $custom_attr[1] . '"';
		}
	}
}

$primary_animation   = ( '2d-transition' === $settings['button_primary_hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['button_primary_hover_2d_css_animation'] : ( ( 'background-transition' === $settings['button_primary_hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['button_primary_hover_background_css_animation'] : ( ( 'unique' === $settings['button_primary_hover_animation'] ) ? 'xpro-elementor-button-hover-style-' . $settings['button_primary_hover_unique_animation'] : 'xpro-elementor-button-animation-none' ) );
$secondary_animation = ( '2d-transition' === $settings['button_secondary_hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['button_secondary_hover_2d_css_animation'] : ( ( 'background-transition' === $settings['button_secondary_hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['button_secondary_hover_background_css_animation'] : ( ( 'unique' === $settings['button_secondary_hover_animation'] ) ? 'xpro-elementor-button-hover-style-' . $settings['button_secondary_hover_unique_animation'] : 'xpro-elementor-button-animation-none' ) );

$secondary_tag   = ( $settings['button_secondary_link']['url'] ) ? 'a' : 'span';
$secondary_attr  = ( $settings['button_secondary_css_id'] ) ? ' id="' . $settings['button_secondary_css_id'] . '"' : '';
$secondary_attr .= $settings['button_secondary_link']['is_external'] ? ' target="_blank"' : '';
$secondary_attr .= $settings['button_secondary_link']['nofollow'] ? ' rel="nofollow"' : '';
$secondary_attr .= $settings['button_secondary_link']['url'] ? ' href="' . $settings['button_secondary_link']['url'] . '"' : '';
$secondary_attr .= ( $settings['button_secondary_onclick_event'] ) ? ' onclick="' . $settings['button_secondary_onclick_event'] . '"' : '';

if ( $settings['button_secondary_link']['custom_attributes'] ) {
	$attributes = explode( ',', $settings['button_secondary_link']['custom_attributes'] );

	foreach ( $attributes as $attribute ) {
		if ( ! empty( $attribute ) ) {
			$custom_attr = explode( '|', $attribute, 2 );
			if ( ! isset( $custom_attr[1] ) ) {
				$custom_attr[1] = '';
			}
			$secondary_attr .= ' ' . $custom_attr[0] . '="' . $custom_attr[1] . '"';
		}
	}
}

?>

<div class="xpro-dual-button-wrapper xpro-dual-button-stack-<?php echo esc_attr( $settings['stack'] ); ?>">

	<<?php echo esc_attr( $primary_tag ); ?> <?php xpro_elementor_kses( $primary_attr ); ?> class="xpro-elementor-button xpro-elementor-button-primary <?php echo esc_attr( $primary_animation ); ?> xpro-align-icon-<?php echo ( 'left' === $settings['button_primary_icon_align'] ) ? 'left' : 'right'; ?>">
	<?php if ( $settings['button_primary_icon'] ) : ?>
		<span class="xpro-elementor-button-media">
			<?php Icons_Manager::render_icon( $settings['button_primary_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
		<?php
	endif;
	?>
	<span class="xpro-button-text"><?php echo esc_html( $settings['button_primary_text'] ); ?></span>
</<?php echo esc_attr( $primary_tag ); ?>>

<<?php echo esc_attr( $secondary_tag ); ?> <?php xpro_elementor_kses( $secondary_attr ); ?> class="xpro-elementor-button xpro-elementor-button-secondary <?php echo esc_attr( $secondary_animation ); ?> xpro-align-icon-<?php echo ( 'left' === $settings['button_secondary_icon_align'] ) ? 'left' : 'right'; ?>">
<?php if ( $settings['button_secondary_icon'] ) : ?>
	<span class="xpro-elementor-button-media">
		<?php Icons_Manager::render_icon( $settings['button_secondary_icon'], array( 'aria-hidden' => 'true' ) ); ?>
		</span>
	<?php
endif;
?>
<span class="xpro-button-text"><?php echo esc_html( $settings['button_secondary_text'] ); ?></span>
</<?php echo esc_attr( $secondary_tag ); ?>>

<?php if ( 'yes' === $settings['separator'] && $settings['separator_text'] ) : ?>
	<span class="xpro-dual-button-separator"><?php echo esc_html( $settings['separator_text'] ); ?></span>
<?php endif; ?>

</div>
