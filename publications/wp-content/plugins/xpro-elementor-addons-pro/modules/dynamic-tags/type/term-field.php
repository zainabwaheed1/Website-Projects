<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Term_Field extends Tag {

	public function get_name() {
		return 'xpro-term-field';
	}

	public function get_title() {
		return __( 'Term Field', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic-tags';
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
			Module::NUMBER_CATEGORY,
			Module::URL_CATEGORY,
			Module::POST_META_CATEGORY,
			Module::COLOR_CATEGORY,
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
			'term_field',
			array(
				'label'   => __( 'Field', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'name'         => __( 'Term name', 'xpro-elementor-addons-pro' ),
					'description'  => __( 'Term description', 'xpro-elementor-addons-pro' ),
					'count'        => __( 'Posts count', 'xpro-elementor-addons-pro' ),
					'term_id'      => __( 'Term ID', 'xpro-elementor-addons-pro' ),
					'term_url'     => __( 'Term URL', 'xpro-elementor-addons-pro' ),
					'custom_field' => __( 'Meta Field', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'custom_field',
			array(
				'label'     => __( 'Meta Field', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'term_field' => array( 'custom_field' ),
				),
			)
		);
	}

	public function render() {

		$tax          = $this->get_settings( 'taxonomy' );
		$field        = $this->get_settings( 'term_field' );
		$custom_field = $this->get_settings( 'custom_field' );

		if ( empty( $tax ) ) {
			return;
		}

		$current_object = get_queried_object();

		if ( ! $current_object ) {
			$this->render_post_term( get_the_ID(), $tax, $field, $custom_field );

			return;
		}

		$class = get_class( $current_object );

		if ( 'WP_Term' === $class ) {
			$this->render_term_data( $current_object, $tax, $field, $custom_field );
		} else {
			$this->render_post_term( get_the_ID(), $tax, $field, $custom_field );
		}

	}

	public function render_post_term( $post_id, $tax, $field, $custom_field ) {

		if ( ! $post_id ) {
			return;
		}

		$post_terms = wp_get_post_terms( $post_id, $tax );

		if ( is_wp_error( $post_terms ) || empty( $post_terms ) ) {
			return;
		}

		$term = $post_terms[0];

		$this->render_term_data( $term, $tax, $field, $custom_field );

	}

	public function render_term_data( $term, $tax, $field, $custom_field ) {

		switch ( $field ) {

			case 'custom_field':
				if ( ! empty( $custom_field ) ) {
					$meta = get_term_meta( $term->term_id, $custom_field, true );

					if ( is_array( $meta ) ) {
						echo implode( ', ', $meta );
					} else {
						echo $meta;
					}
				}

				break;

			case 'term_url':
				$term_url = get_term_link( $term->term_id, $tax );

				if ( is_wp_error( $term_url ) ) {
					$term_url = '';
				}

				echo $term_url;
				break;

			default:
				if ( isset( $term->$field ) ) {
					echo $term->$field;
				}

				break;
		}

	}

	private function get_taxonomies_list() {

		$list = xpro_elementor_get_taxonomies( array( 'public' => true ), 'object', true );

		return $list;

	}

}
