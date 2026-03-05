<?php

use Elementor\Icons_Manager;

$html_tag = ( $settings['box_link']['url'] ) ? 'a' : 'div';
$attr     = ( $settings['creative_btn_css_id'] ) ? ' id="' . $settings['creative_btn_css_id'] . '"' : '';
$attr    .= $settings['box_link']['is_external'] ? ' target="_blank"' : '';
$attr    .= $settings['box_link']['nofollow'] ? ' rel="nofollow"' : '';
$attr    .= $settings['box_link']['url'] ? ' href="' . $settings['box_link']['url'] . '"' : '';
$attr    .= ( $settings['onclick_event'] ) ? ' onclick="' . $settings['onclick_event'] . '"' : '';

if ( $settings['box_link']['custom_attributes'] ) {
	$attributes = explode( ',', $settings['box_link']['custom_attributes'] );

	foreach ( $attributes as $attribute ) {
		if ( ! empty( $attribute ) ) {
			$custom_attr = explode( '|', $attribute, 2 );
			if ( ! isset( $custom_attr[1] ) ) {
				$custom_attr[1] = '';
			}
			$attr .= ' ' . $custom_attr[0] . '="' . $custom_attr[1] . '"';
		}
	}
}
?>

<div class="xpro-creative-btn-wrapper xpro-creative-btn-layout-<?php echo esc_attr( $settings['layout'] ); ?> xpro-align-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>">

	<<?php echo esc_attr( $html_tag ); ?> <?php xpro_elementor_kses( $attr ); ?> class="xpro-creative-btn">

	<?php if ( '2' === $settings['layout'] ) : ?>
		<svg aria-hidden="true" class="xpro-creative-btn-svg" width="70" height="70" viewBox="0 0 70 70">
			<path class="xpro-creative-btn-svg-circle" d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z"></path>
			<path class="xpro-creative-btn-svg-path" d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z" pathLength="1"></path>
		</svg>
	<?php endif; ?>

	<?php if ( '4' === $settings['layout'] ) : ?>
		<div class="xpro-creative-btn-content">
			<div class="xpro-creative-btn-content-inner">
				<?php if ( $settings['text'] ) : ?>
					<span class=""><?php echo esc_html( $settings['text'] ); ?></span>
				<?php endif; ?>

				<?php if ( $settings['text'] ) : ?>
					<span class=""><?php echo esc_html( $settings['text'] ); ?></span>
				<?php endif; ?>

				<?php if ( $settings['text'] ) : ?>
					<span class=""><?php echo esc_html( $settings['text'] ); ?></span>
				<?php endif; ?>

				<?php if ( $settings['text'] ) : ?>
					<span class=""><?php echo esc_html( $settings['text'] ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $settings['text'] && '5' === $settings['layout'] ) : ?>
		<svg class="xpro-creative-btn-text-circle" viewBox="0 0 500 500">
			<defs>
				<path id="textcircle" d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z"></path>
			</defs>
			<text>
				<textPath xlink:href="#textcircle" aria-label="Projects &amp; client work 2020" textLength="900"><?php echo esc_html( $settings['text'] ); ?></textPath>
			</text>
		</svg>
	<?php endif; ?>

	<?php if ( '10' === $settings['layout'] ) : ?>
		<div class="xpro-creative-btn-hvr-setting">
			<ul class="xpro-creative-btn-hvr-setting-inner">
				<li class="xpro-creative-btn-hvr-effect"></li>
				<li class="xpro-creative-btn-hvr-effect"></li>
				<li class="xpro-creative-btn-hvr-effect"></li>
				<li class="xpro-creative-btn-hvr-effect"></li>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( '15' === $settings['layout'] ) : ?>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
		<span class="box"></span>
	<?php endif; ?>

	<div class="xpro-creative-btn-media">
		<?php if ( '12' !== $settings['layout'] && '14' !== $settings['layout'] && $settings['icon']['value'] ) : ?>
			<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
		<?php endif; ?>

		<?php if ( '12' === $settings['layout'] ) : ?>
			<div class="icon-right left"></div>
			<div class="icon-right after"></div>
		<?php endif; ?>

		<?php if ( $settings['text'] && '5' !== $settings['layout'] ) : ?>
			<span class="xpro-creative-btn-text"><?php echo esc_html( $settings['text'] ); ?></span>
		<?php endif; ?>
	</div>

	<?php if ( '13' === $settings['layout'] ) : ?>
		<span class="xpro-creative-btn-line"></span>
	<?php endif; ?>

</<?php echo esc_attr( $html_tag ); ?>>

</div>
