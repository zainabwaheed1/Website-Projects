<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Term_Image extends Data_Tag {

	private $default_object = null;
	private $current_object = null;

	public function get_name() {
		return 'xpro-term-image';
	}

	public function get_title() {
		return __( 'Term Image', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic-tags';
	}

	public function get_categories() {
		return array(
			Module::IMAGE_CATEGORY,
		);
	}

	/**
	 * Register Controls
	 *
	 * Registers the Dynamic tag controls
	 *
	 * @return void
	 * @since 2.0.0
	 * @access protected
	 *
	 */
	protected function register_controls() {

		$this->add_control(
			'taxonomy',
			array(
				'label'   => __( 'Taxonomy', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_taxonomies_list(),
				'default' => key( $this->get_taxonomies_list() ),
			)
		);

		$this->add_control(
			'meta_field',
			array(
				'label' => __( 'Meta Field', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::TEXT,
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

	public function get_value( array $options = array() ) {

		$tax        = $this->get_settings( 'taxonomy' );
		$meta_field = $this->get_settings( 'meta_field' );

		if ( empty( $tax ) || empty( $meta_field ) ) {
			return $this->get_settings( 'fallback' );
		}

		$current_object = $this->get_current_object();

		if ( ! $current_object ) {
			return $this->get_post_term_data( get_the_ID(), $tax, $meta_field );
		}

		$class = get_class( $current_object );

		if ( 'WP_Term' === $class ) {
			return $this->get_term_data( $current_object, $meta_field );
		} else {
			return $this->get_post_term_data( get_the_ID(), $tax, $meta_field );
		}

	}

	public function get_current_object() {

		if ( null === $this->current_object ) {
			$this->current_object = $this->get_default_object();
		}

		return $this->current_object;

	}

	public function get_default_object() {

		if ( null !== $this->default_object ) {
			return $this->default_object;
		}

		$default_object     = false;
		$this->current_user = wp_get_current_user();

		global $post;

		if ( is_singular() ) {
			$default_object = $this->current_post = $post;
		} elseif ( is_tax() || is_category() || is_tag() || is_author() ) {
			$default_object     = $this->current_term = get_queried_object();
			$this->current_post = $post;
		} elseif ( wp_doing_ajax() ) {
			if ( isset( $_REQUEST['editor_post_id'] ) ) {
				$post_id = $_REQUEST['editor_post_id'];
			} elseif ( isset( $_REQUEST['post_id'] ) ) {
				$post_id = $_REQUEST['post_id'];
			} else {
				$post_id = false;
			}

			if ( ! $post_id ) {
				$default_object = $this->current_post = false;
			} else {
				$default_object = $this->current_post = get_post( $post_id );
			}
		} elseif ( is_archive() || is_home() || is_post_type_archive() ) {
			$default_object = $this->current_post = $post;
		} elseif ( $post ) {
			$default_object = $this->current_post = $post;
		}

		$this->default_object = $default_object;

		return $this->default_object;

	}

	public function get_post_term_data( $post_id, $tax, $meta_field ) {

		if ( ! $post_id ) {
			return $this->get_settings( 'fallback' );
		}

		$post_terms = wp_get_post_terms( $post_id, $tax );

		if ( is_wp_error( $post_terms ) || empty( $post_terms ) ) {
			return $this->get_settings( 'fallback' );
		}

		$term = $post_terms[0];

		return $this->get_term_data( $term, $meta_field );

	}

	public function get_term_data( $term, $meta_field ) {

		if ( ! empty( $meta_field ) ) {

			$meta = get_term_meta( $term->term_id, $meta_field, true );

			if ( $meta ) {
				return $this->get_attachment_image_data_array( $meta );
			} else {
				return $this->get_settings( 'fallback' );
			}
		} else {
			return $this->get_settings( 'fallback' );
		}

	}

	public function get_attachment_image_data_array( $img_data = null, $include = 'all' ) {

		$result = false;

		if ( empty( $img_data ) ) {
			return $result;
		}

		if ( is_numeric( $img_data ) ) {

			switch ( $include ) {
				case 'id':
					$result = array(
						'id' => $img_data,
					);
					break;

				case 'url':
					$result = array(
						'url' => wp_get_attachment_url( $img_data ),
					);
					break;

				default:
					$result = array(
						'id'  => $img_data,
						'url' => wp_get_attachment_url( $img_data ),
					);
			}
		} elseif ( filter_var( $img_data, FILTER_VALIDATE_URL ) ) {

			switch ( $include ) {
				case 'id':
					$result = array(
						'id' => attachment_url_to_postid( $img_data ),
					);
					break;

				case 'url':
					$result = array(
						'url' => $img_data,
					);
					break;

				default:
					$result = array(
						'id'  => attachment_url_to_postid( $img_data ),
						'url' => $img_data,
					);
			}
		} elseif ( is_array( $img_data ) && isset( $img_data['id'] ) && isset( $img_data['url'] ) ) {

			switch ( $include ) {
				case 'id':
					$result = array(
						'id' => $img_data['id'],
					);
					break;

				case 'url':
					$result = array(
						'url' => $img_data['url'],
					);
					break;

				default:
					$result = $img_data;
			}
		}

		return $result;
	}

	private function get_taxonomies_list() {

		$list = xpro_elementor_get_taxonomies( array( 'public' => true ), 'object', true );

		return $list;

	}

}
