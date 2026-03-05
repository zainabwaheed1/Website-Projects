<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Post_Term extends Tag {

	public function get_name() {
		return 'xpro-post-term';
	}

	public function get_title() {
		return __( 'Post Term', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function is_settings_required() {
		return true;
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
		);
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['key'] ) ) {
			return false;
		}

		$post_data = get_demo_post_data();
		$post_id   = $post_data->ID;
		if ( 'yes' === $settings['link'] ) {
			$value = get_the_term_list( $post_id, $settings['key'], '', $settings['separator'] );
		} else {
			$terms = get_the_terms( $post_id, $settings['key'] );

			if ( is_wp_error( $terms ) || empty( $terms ) ) {
				return '';
			}

			$term_names = array();

			foreach ( $terms as $term ) {
				$term_names[] = '<span>' . $term->name . '</span>';
			}

			$value = implode( $settings['separator'], $term_names );
		}

		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'key',
			array(
				'label'   => __( 'Taxonomy', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->xpro_get_post_taxomony(),
				'default' => '',
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'   => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => ', ',
			)
		);

		$this->add_control(
			'link',
			array(
				'label'   => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
	}

	public function xpro_get_post_taxomony() {
		$options   = array(
			'' => __( 'Select', 'xpro-elementor-addons-pro' ),
		);
		$post_data = get_demo_post_data();

		if ( isset( $post_data->ID ) ) {
			$post_type            = get_post_type( $post_data->ID );
			$taxonomy_filter_args = array(
				'show_in_nav_menus' => true,
				'object_type'       => array( $post_type ),
			);

			$taxonomy_filter_args = apply_filters( 'xpro_post_dynamic_tax_filter', $taxonomy_filter_args );
			$taxonomies           = $this->get_taxonomies( $taxonomy_filter_args, 'object' );

			foreach ( $taxonomies as $taxonomy => $object ) {
				$options[ $taxonomy ] = $object->label;
			}
		}

		return $options;
	}


	public static function get_taxonomies( $args = array(), $output = 'names', $operator = 'and' ) {
		global $wp_taxonomies;
		$field = ( 'names' === $output ) ? 'name' : false;

		// Handle 'object_type' separately.
		if ( isset( $args['object_type'] ) ) {
			$object_type = (array) $args['object_type'];
			unset( $args['object_type'] );
		}

		$taxonomies = wp_filter_object_list( $wp_taxonomies, $args, $operator );
		if ( isset( $object_type ) ) {
			foreach ( $taxonomies as $tax => $tax_data ) {
				if ( ! array_intersect( $object_type, $tax_data->object_type ) ) {
					unset( $taxonomies[ $tax ] );
				}
			}
		}

		if ( $field ) {
			$taxonomies = wp_list_pluck( $taxonomies, $field );
		}

		return $taxonomies;
	}
}
