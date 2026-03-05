<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Gallery extends Data_Tag {
	public function get_name() {
		return 'xpro-post-gallery';
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_title() {
		return __( 'Post Image Attachments', 'xpro-elementor-addons-pro' );
	}

	public function get_categories() {
		return array(
			Module::GALLERY_CATEGORY,
		);
	}

	public function get_value( array $options = array() ) {
		$settings  = $this->get_settings_for_display();
		$post_data = get_demo_post_data();
		$post_id   = $post_data->ID;
		$images    = get_attached_media( 'image', $post_id );
		if ( empty( $images ) ) {
			return false;
		}
		$value = array();

		foreach ( $images as $image ) {
			$value[] = array(
				'id' => $image->ID,
			);
		}

		return $value;
	}
}
