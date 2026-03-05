<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Term_Taxonomy extends Tag {

	public function get_name() {
		return 'xpro-term-tag';
	}

	public function get_title() {
		return esc_html__( 'Term Taxonomy', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic-tags';
	}

	public function get_categories() {
		return array(
			Module::BASE_GROUP,
			Module::TEXT_CATEGORY,
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
			'taxonomy_field',
			array(
				'label'       => esc_html__( 'Field', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'term_taxonomy_id'     => esc_html__( 'Term Taxonomy ID', 'xpro-elementor-addons-pro' ),
					'taxonomy'             => esc_html__( 'Taxonomy Query Var', 'xpro-elementor-addons-pro' ),
					'label'                => esc_html__( 'Taxonomy Label (Plural)', 'xpro-elementor-addons-pro' ),
					'labels_singular_name' => esc_html__( 'Taxonomy Label (Singular)', 'xpro-elementor-addons-pro' ),
					'description'          => esc_html__( 'Taxonomy Description', 'xpro-elementor-addons-pro' ),
					'rewrite_slug'         => esc_html__( 'Taxonomy Slug', 'xpro-elementor-addons-pro' ),
				),
				'default'     => 'label',
				'label_block' => true,
			)
		);
	}

	public function render() {

		$settings = $this->get_settings_for_display();

		if ( empty( $settings ) ) {
			return;
		}

		$meta    = false;
		$term_id = $this->get_term_id();

		if ( $term_id ) {
			if ( ! empty( $settings['taxonomy_field'] ) ) {
				$taxonomy = get_term_field( 'taxonomy', $term_id );
				$meta     = $taxonomy;
				$tax      = get_taxonomy( $taxonomy );
				switch ( $settings['taxonomy_field'] ) {
					case 'taxonomy':
						$meta = $taxonomy;
						break;
					case 'term_taxonomy_id':
						$meta = get_term_field( $settings['taxonomy_field'], $term_id );
						break;
					case 'rewrite_slug':
						if ( ! empty( $tax->rewrite ) ) {
							$meta = $tax->rewrite['slug'];
						}
						break;
					case 'labels_singular_name':
						if ( ! empty( $tax->labels->singular_name ) ) {
							$meta = $tax->labels->singular_name;
						}
						break;
					case 'description':
						if ( ! empty( $tax->description ) ) {
							$meta = $tax->description;
						}
						break;
					case 'taxonomy_name':
						$meta = $tax->labels->name;
						break;
					default:
						if ( ! empty( $tax->label ) ) {
							$meta = $tax->label;
						}
				}
			}

			xpro_elementor_kses( $this->to_string( $meta ) );
		}
	}

	public function get_term_id() {
		$term = get_queried_object();
		if ( $term && is_object( $term ) && get_class( $term ) == 'WP_Term' ) {
			return $term->term_id;
		}

		return false;
	}

	public function to_string( $data, $listed = false ) {
		if ( is_object( $data ) ) {
			switch ( get_class( $data ) ) {
				case 'WP_Term':
					return $data->name;
				case 'WP_Post':
					return $data->post_title;
				case 'WP_User':
					return $data->display_name;
				case 'WP_Comment':
					return $data->comment_content;
				default:
					$data = (array) $data;
			}
		}
		if ( is_array( $data ) ) {
			if ( ! empty( $data['post_title'] ) ) {
				return $data['post_title'];
			}
			if ( ! empty( $data['display_name'] ) ) {
				return $data['display_name'];
			}
			if ( ! empty( $data['name'] ) ) {
				return $data['name'];
			}
			if ( ! empty( $data['comment_content'] ) ) {
				return $data['comment_content'];
			}
			if ( count( $data ) == 1 ) {
				$first = reset( $data );

				return $this->to_string( $first );
			}

			return $this->implode( $data, ', ', $listed );
		}

		return $data;
	}

	public function implode( $pieces = array(), $glue = ', ', $listed = false ) {
		$string = '';
		if ( is_string( $pieces ) ) {
			$string = $pieces;
		}
		if ( ! empty( $pieces ) && is_array( $pieces ) ) {
			if ( $listed ) {
				$string .= ( is_string( $listed ) ) ? '<' . $listed . '>' : '<ul>';
			}
			$i = 0;
			foreach ( $pieces as $av ) {
				if ( $listed ) {
					$string .= '<li>';
				}
				if ( is_object( $av ) ) {
					$av = $this->to_string( $av );
				}
				if ( is_array( $av ) ) {
					$string .= $this->implode( $av, $glue, $listed );
				} else {
					if ( $i ) {
						$string .= $glue;
					}
					$string .= $av;
				}
				if ( $listed ) {
					$string .= '</li>';
				}
				$i ++;
			}
			if ( $listed ) {
				$string .= ( is_string( $listed ) ) ? '</' . $listed . '>' : '</ul>';
			}
		}

		return $string;
	}

}
