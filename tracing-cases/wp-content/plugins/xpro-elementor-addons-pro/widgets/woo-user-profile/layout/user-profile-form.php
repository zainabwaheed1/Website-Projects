<!-- login/sign up -->
<div class="xpro-up-tabs">
	<ul id="xpro-up-tabs-nav" class="xpro-up-tabs-cls">
		<li><a href="#xpro-up-tab1"><?php echo esc_html__( 'Login', 'xpro-elementor-addons-pro' ); ?></a></li>
		<div class="xpro-up-border-wrapper">
			<div class="xpro-up-border-inner"></div>
		</div>
		<li><a href="#xpro-up-tab2"><?php echo esc_html__( 'Sign Up', 'xpro-elementor-addons-pro' ); ?></a></li>
	</ul> <!-- END xpro-up-tabs-nav -->
	<div id="tabs-content" class="xpro-up-content-wrapper">
		<div id="xpro-up-tab1" class="xpro-up-tab-content">
			<?php
			require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/login-template.php';
			?>
		</div>
		<div id="xpro-up-tab2" class="xpro-up-tab-content">
			<?php
			require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/registration-template.php';
			?>
		</div>
	</div> <!-- end tabs-content -->
</div> <!-- end login/sign up -->
