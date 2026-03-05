<?php

namespace XproElementorAddonsPro\Module;

use Elementor\Plugin;
use XproElementorAddonsPro\Libs\Xpro_Elementor_License;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Dynamic {

	public static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			self::$_instance->init();
		}

		return self::$_instance;
	}

	public static function init() {
		self::include_files();
		add_action( 'elementor/dynamic_tags/register', array( __CLASS__, 'register_dynamic_tags' ) );

	}

	public static function include_files() {

		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-title.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-custom-field.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-date.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-excerpt.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-content.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-featured-image.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-gallery.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-term.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-time.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/post-dynamic/type/post-url.php';

	}

	public static function register_dynamic_tags( $dynamic_tags ) {

		if ( 'valid' !== Xpro_Elementor_License::$license_activate ) {
			return;
		}

		Plugin::$instance->dynamic_tags->register_group(
			'xpro-post-dynamic',
			array(
				'title' => __( 'Post - Xpro', 'xpro-elementor-addons-pro' ),
			)
		);

		//Post Dynamic
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Title() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Excerpt() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Content() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Featured_Image() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Gallery() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Gallery() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Term() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Time() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Url() );
		$dynamic_tags->register( new \XproElementorAddonsPro\Module\Post_Dynamic\Post_Custom_Field() );

	}
}


Post_Dynamic::instance();
