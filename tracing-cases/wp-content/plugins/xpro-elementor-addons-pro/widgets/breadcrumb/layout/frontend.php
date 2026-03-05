<?php
$length = $settings['max_word_length'];
$trail  = 'yes' === $settings['show_trail'];

?>
<div class="xpro-breadcrumb-wrapper">
	<?php xpro_elementor_kses( $this->get_breadcrumb_markup( get_the_ID(), $length, $trail ) ); ?>
</div>
