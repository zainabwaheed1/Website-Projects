<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class User_Avatar extends Data_Tag {

	public function get_name() {
		return 'xpro-user-avatar';
	}

	public function get_title() {
		return esc_html__( 'User Avatar', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic-tags';
	}

	public function get_categories() {
		return array(
			Module::BASE_GROUP,
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
			'source',
			array(
				'label'       => esc_html__( 'Source', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					''       => esc_html__( 'Current', 'xpro-elementor-addons-pro' ),
					'author' => esc_html__( 'Author', 'xpro-elementor-addons-pro' ),
					'other'  => esc_html__( 'Other', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'user_id',
			array(
				'label'       => __( 'User', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     => xpro_elementor_get_authors_list(),
				'default'     => key( xpro_elementor_get_authors_list() ),
				'condition'   => array(
					'source' => 'other',
				),
			)
		);

		$this->add_control(
			'gravatar',
			array(
				'label'   => esc_html__( 'Use Gravatar', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'gravatar_default',
			array(
				'label'     => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''                 => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
					'retro'            => esc_html__( '8bit', 'xpro-elementor-addons-pro' ),
					'monsterid'        => esc_html__( 'Monster', 'xpro-elementor-addons-pro' ),
					'wavatar'          => esc_html__( 'Cartoon face', 'xpro-elementor-addons-pro' ),
					'identicon'        => esc_html__( 'Geometric pattern', 'xpro-elementor-addons-pro' ),
					'mp'               => esc_html__( 'Mistery Person', 'xpro-elementor-addons-pro' ),
					'robohash'         => esc_html__( 'Robohash', 'xpro-elementor-addons-pro' ),
					'blank'            => esc_html__( 'Transparent GIF', 'xpro-elementor-addons-pro' ),
					'gravatar_default' => esc_html__( 'Gravatar logo', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'gravatar!' => '',
				),
			)
		);

		$this->add_control(
			'gravatar_force_default',
			array(
				'label'     => esc_html__( 'Force Default', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'gravatar!' => '',
				),
			)
		);

		$this->add_control(
			'gravatar_size',
			array(
				'label'      => esc_html__( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 2048,
					),
				),
				'condition'  => array(
					'gravatar!' => '',
				),
			)
		);

		$this->add_control(
			'custom_avatar',
			array(
				'label'       => esc_html__( 'Custom Meta', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => array(
					'gravatar' => '',
				),
			)
		);

		$this->add_control(
			'custom_fallback_img',
			array(
				'label'     => esc_html__( 'Fallback', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'gravatar' => '',
				),
			)
		);

	}

	public function get_value( array $options = array() ) {
		$settings = $this->get_settings();
		if ( empty( $settings ) ) {
			return;
		}

		$user_id = $this->get_user_id();
		if ( ! $user_id ) {
			return;
		}

		$id  = '';
		$url = '';
		if ( $user_id ) {
			if ( $settings['gravatar'] ) {
				$args = array();
				if ( ! empty( $settings['gravatar_default'] ) ) {
					$args['default'] = $settings['gravatar_default'];
				}
				if ( ! empty( $settings['gravatar_force_default'] ) ) {
					$args['force_default'] = (bool) $settings['gravatar_force_default'];
				}
				if ( ! empty( $settings['gravatar_size']['size'] ) ) {
					$args['size'] = $settings['gravatar_size']['size'];
				}
				$url = get_avatar_url( $user_id, $args );
			} else {
				// custom field
				$meta = $this->get_user_field( $user_id, $settings['custom_avatar'] );
				$img  = $this->get_image( $meta );
				if ( ! $this->empty( $img ) && ! empty( $img['url'] ) ) {
					if ( ! empty( $img['id'] ) ) {
						$id = $img['id'];
					}
					$url = $img['url'];
				} else {
					if ( ! empty( $settings['custom_fallback_img']['url'] ) ) {
						$id  = $settings['custom_fallback_img']['id'];
						$url = $settings['custom_fallback_img']['url'];
					}
				}
			}
		}

		return array(
			'id'  => $id,
			'url' => $url,
		);
	}

	public function get_user_id() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings ) ) {
			return;
		}

		$user_id = get_current_user_id();

		if ( ! empty( $settings['source'] ) ) {
			if ( 'author' === $settings['source'] ) {
				$user_id = $this->get_author_id();
			}
			if ( 'other' === $settings['source'] ) {
				if ( ! empty( $settings['user_id'] ) ) {
					$user_id = $settings['user_id'];
				}
			}
		}

		return $user_id;
	}

	public function get_author_id() {
		global $authordata;
		if ( empty( $authordata->ID ) ) {
			$post = get_post();
			if ( ! empty( $post ) ) {
				$authordata = get_userdata( $post->post_author ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			}
		}

		return get_the_author_meta( 'ID' );
	}

	public function get_user_field( $field = 'display_name', $user_id = null, $single = null ) {
		$value = null;
		if ( is_numeric( $field ) && intval( $field ) ) {
			$tmp     = $user_id;
			$user_id = $field;
			$field   = $tmp;
		}
		$user_id = ( is_numeric( $user_id ) && intval( $user_id ) ) ? intval( $user_id ) : get_current_user_id();
		$user_id = ( is_numeric( $user_id ) && intval( $user_id ) ) ? intval( $user_id ) : get_the_author_meta( 'ID' );
		$user    = get_user_by( 'ID', $user_id );
		if ( $user ) {
			$value = $this->get_wp_object_field( $user, $field, $single );
		}

		return $this->adjust_data( $value, $single );
	}

	public function get_wp_object_field( $obj, $field, $single = true ) {
		$value = $type = null;

		if ( $value === null ) {
			if ( property_exists( $obj, $field ) ) {
				$value = $obj->{$field};
			}
		}
		if ( $value === null ) {
			$class = strtolower( get_class( $obj ) );
			$tmp   = explode( '_', $class );
			if ( count( $tmp ) == 2 ) {
				list( $wp, $type ) = $tmp;
			} else {
				$type = 'user';
			}
			if ( property_exists( $obj, $type . '_' . $field ) ) {
				$value = $obj->{$type . '_' . $field};
			}
		}
		if ( $value === null && $type ) {
			$obj_id = $this->get_id( $obj );
			if ( metadata_exists( $type, $obj_id, $field ) ) {
				$value = get_metadata( $type, $obj_id, $field, $single );
			}
		}

		if ( $value === null ) {
			if ( get_class( $obj ) == 'WP_User' && property_exists( $obj, 'data' ) ) {
				$obj = $obj->data;

				return $this->get_wp_object_field( $obj, $field, $single );
			}
		}

		return $value;
	}

	public function adjust_data( $value, $single = true ) {
		if ( ! empty( $value ) ) {
			if ( is_array( $value ) ) {
				if ( $single === true || count( $value ) == 1 ) {
					return $this->adjust_data( reset( $value ), $single );
				}
			}

			return $value;
		}

		return '';
	}

	public static function get_image( $meta = null ) {
		$id  = '';
		$url = '';
		if ( ! empty( $meta ) ) {
			if ( is_numeric( $meta ) ) {
				$id  = intval( $meta );
				$url = wp_get_attachment_url( $id );
			}
			if ( is_string( $meta ) ) {
				if ( filter_var( $meta, FILTER_VALIDATE_URL ) ) {
					$url = $meta;
					$id  = attachment_url_to_postid( $meta );
				}
			}
			if ( is_array( $meta ) ) {
				if ( isset( $meta['url'] ) ) {
					$url = $meta['url'];
				}
				if ( isset( $meta['src'] ) ) {
					$url = $meta['src'];
				}
				if ( isset( $meta['guid'] ) ) {
					$url = $meta['guid'];
				}
				if ( isset( $meta['ID'] ) ) {
					$id  = intval( $meta['ID'] );
					$url = wp_get_attachment_url( $id );
				}
			}
		}
		if ( $url ) {
			return array(
				'id'  => $id,
				'url' => $url,
			);
		}

		return false;
	}

	public static function empty( $source, $key = false ) {
		if ( is_array( $source ) ) {
			$source = array_filter( $source );
		}
		if ( $key ) {
			return Utils::is_empty( $source, $key );
		}

		return empty( $source );
	}

}
