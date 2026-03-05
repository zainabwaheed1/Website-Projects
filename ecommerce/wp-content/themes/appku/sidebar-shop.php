<?php
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Appku
	* @Version     : 1.0
	* @Author     : Appku
    * @Author URI : https://themeforest.net/user/validthemes/portfolio
	*
	*/

	if( ! is_active_sidebar( 'appku-woo-sidebar' ) ){
		return;
	}
?>
<div class="col-lg-4 col-xl-3">
	<!-- Sidebar Begin -->
	<aside class="sidebar mt-5 mt-lg-0">
		<?php
			dynamic_sidebar( 'appku-woo-sidebar' );
		?>
	</aside>
	<!-- Sidebar End -->
</div>