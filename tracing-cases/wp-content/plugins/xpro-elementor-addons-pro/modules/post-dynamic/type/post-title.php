<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Title extends Tag {

	public function get_name() {
		return 'xpro-post-title';
	}

	public function get_title() {
		return __( 'Post Title', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
		);
	}

	public function render() {
		$post_data = get_demo_post_data();
		echo wp_kses_post( $post_data->post_title );
	}
}
