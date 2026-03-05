<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Featured_Image extends Data_Tag {

	public function get_name() {
		return 'xpro-post-featured-image';
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_title() {
		return __( 'Post Featured Image', 'xpro-elementor-addons-pro' );
	}

	public function get_categories() {
		return array(
			Module::IMAGE_CATEGORY,
		);
	}

	public function get_value( array $options = array() ) {
		$settings     = $this->get_settings_for_display();
		$post_data    = get_demo_post_data();
		$post_id      = $post_data->ID;
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		if ( $thumbnail_id ) {
			$image_data = array(
				'id'  => $thumbnail_id,
				'url' => wp_get_attachment_image_src( $thumbnail_id, $settings['thumbnail_size'] )[0],
			);
		} else {
			$image_data = $settings['fallback'];
		}

		return $image_data;
	}

	protected function register_controls() {
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail',
				'exclude' => array( 'custom' ),
				'include' => array(),
				'default' => 'large',
			)
		);
		$this->add_control(
			'fallback',
			array(
				'label' => __( 'Fallback', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);
	}

}
