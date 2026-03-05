<?php

namespace XproElementorAddonsPro\Module\Woo_Dynamic;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;


class Product_Cat_Image extends Data_Tag {

	public function get_name() {
		return 'xpro-product-cat-image';
	}

	public function get_title() {
		return __( 'Product Category Image', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-woo-dynamic';
	}

	public function get_categories() {
		return array(
			Module::IMAGE_CATEGORY,
			Module::MEDIA_CATEGORY,

		);
	}

	public function get_value( array $options = array() ) {
		$GLOBALS['post'];
		$image_data  = array();
		$category_id = '';

		if ( is_product_category() ) {
			$category_id = get_queried_object_id();
		} elseif ( is_product() ) {
			$xpro_product_data = get_demo_product_data();
			$product_id        = $xpro_product_data->ID;
			$product           = wc_get_product( $product_id );
			if ( ! $product ) {
				return;
			}
			if ( $product ) {
				$category_ids = $product->get_category_ids();
				if ( ! empty( $category_ids ) ) {
					$category_id = $category_ids[0];
				}
			}
		}

		if ( 'xpro-themer' === $GLOBALS['post']->post_type ) {
			$xpro_post_ID     = $GLOBALS['post']->ID;
			$xpro_render_mode = get_post_meta( $xpro_post_ID, 'xpro_render_mode', true );
			switch ( $xpro_render_mode ) {
				case 'archive_template':
					$term_data   = get_preview_term_data();
					$category_id = $term_data['prev_term_id'];
					break;
				case 'post_template':
				case 'block_layout':
					$xpro_product_data = get_demo_product_data();
					$product_id        = $xpro_product_data->ID;
					if ( ! $product_id ) {
						return array();
					}
					$product = wc_get_product( $product_id );
					if ( ! $product ) {
						return array();
					}
					if ( $product ) {
						$category_ids = $product->get_category_ids();
						if ( ! empty( $category_ids ) ) {
							$category_id = $category_ids[0];
						}
					}
					break;
			}
		}
		if ( ! $category_id ) {
			return array();
		}

		$image_id = get_term_meta( $category_id, 'thumbnail_id', true );

		if ( empty( $image_id ) ) {
			return array();
		}

		$src = wp_get_attachment_image_src( $image_id, 'full' );

		$image_data = array(
			'id'  => $image_id,
			'url' => $src[0],
		);

		return $image_data;
	}
}
