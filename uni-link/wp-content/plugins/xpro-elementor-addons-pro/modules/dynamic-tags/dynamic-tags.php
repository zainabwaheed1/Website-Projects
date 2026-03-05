<?php

namespace XproElementorAddonsPro\Module;

use Elementor\Plugin;
use XproElementorAddonsPro\Libs\Xpro_Elementor_License;
use XproElementorAddonsPro\Module\Dynamic_Tags\Custom_PHP;
use XproElementorAddonsPro\Module\Dynamic_Tags\Site_Field;
use XproElementorAddonsPro\Module\Dynamic_Tags\Term_Field;
use XproElementorAddonsPro\Module\Dynamic_Tags\Term_Image;
use XproElementorAddonsPro\Module\Dynamic_Tags\Term_Taxonomy;
use XproElementorAddonsPro\Module\Dynamic_Tags\User_Avatar;
use XproElementorAddonsPro\Module\Dynamic_Tags\User_Field;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Dynamic_Tags {

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

		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/term-field.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/term-image.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/term-taxonomy.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/user-field.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/user-avatar.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/site-field.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/dynamic-tags/type/custom-php.php';

	}

	public static function register_dynamic_tags( $dynamic_tags ) {

		if ( 'valid' !== Xpro_Elementor_License::$license_activate ) {
			return;
		}

		Plugin::$instance->dynamic_tags->register_group(
			'xpro-dynamic-tags',
			array(
				'title' => __( 'Global - Xpro', 'xpro-elementor-addons-pro' ),
			)
		);

		//Post Dynamic
		$dynamic_tags->register( new Term_Field() );
		$dynamic_tags->register( new Term_Image() );
		$dynamic_tags->register( new Term_Taxonomy() );
		$dynamic_tags->register( new User_Field() );
		$dynamic_tags->register( new User_Avatar() );
		$dynamic_tags->register( new Site_Field() );
		$dynamic_tags->register( new Custom_PHP() );

	}

}


Dynamic_Tags::instance();
