<?php

namespace XproElementorAddonsPro\Module;

use Elementor\Plugin;
use XproElementorAddonsPro\Libs\Xpro_Elementor_License;

class Woo_Dynamic {

	public static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			self::$_instance->init();
		}

		return self::$_instance;
	}

	public static function init() {

		if ( ! class_exists( 'woocommerce' ) ) {
			return;
		}

		self::include_files();
		add_action( 'elementor/dynamic_tags/register', array( __CLASS__, 'register_dynamic_tags' ) );

	}

	public static function include_files() {

		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-title.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-cat-image.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-gallery.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-image.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-price.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-rating.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-sale.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-short-description.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-sku.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-stock.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-term.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/woo-dynamic/type/product-term.php';

	}

	public static function register_dynamic_tags( $dynamic_tags ) {

		if ( 'valid' !== Xpro_Elementor_License::$license_activate ) {
			return;
		}

		Plugin::$instance->dynamic_tags->register_group(
			'xpro-woo-dynamic',
			array(
				'title' => __( 'Woo - Xpro', 'xpro-elementor-addons-pro' ),
			)
		);

		//Post Dynamic
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Title() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Cat_Image() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Gallery() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Image() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Price() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Rating() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Sale() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_SKU() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Stock() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Term() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Term() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Woo_Dynamic\Product_Short_Description() );

	}
}


Woo_Dynamic::instance();
