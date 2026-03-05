<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Url extends Data_Tag {

	public function get_name() {
		return 'xpro-post-url';
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_title() {
		return __( 'Post Url', 'xpro-elementor-addons-pro' );
	}

	public function get_categories() {
		return array(
			Module::URL_CATEGORY,
			Module::TEXT_CATEGORY,
		);
	}


	public function get_value( array $options = array() ) {
		$post_data = get_demo_post_data();
		$post_url  = get_permalink( $post_data->ID );

		return $post_url;
	}

}
