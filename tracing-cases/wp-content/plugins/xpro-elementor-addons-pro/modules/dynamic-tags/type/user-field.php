<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class User_Field extends Tag {

	public function get_name() {
		return 'xpro-user-field';
	}

	public function get_title() {
		return __( 'User Field', 'xpro-elementor-addons-pro' );
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

	protected function register_controls() {

		$this->add_control(
			'source',
			array(
				'label'   => esc_html__( 'Source', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''       => esc_html__( 'Current', 'xpro-elementor-addons-pro' ),
					'author' => esc_html__( 'Author', 'xpro-elementor-addons-pro' ),
					'other'  => esc_html__( 'Other', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'user_id',
			array(
				'label'     => __( 'User', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => xpro_elementor_get_authors_list(),
				'default'   => key( xpro_elementor_get_authors_list() ),
				'condition' => array(
					'source' => 'other',
				),
			)
		);

		$this->add_control(
			'tag_field',
			array(
				'label'  => esc_html__( 'Field', 'xpro-elementor-addons-pro' ),
				'type'   => Controls_Manager::SELECT,
				'groups' => array(
					array(
						'label'   => esc_html__( 'Common', 'xpro-elementor-addons-pro' ),
						'options' => array(
							'display_name'    => esc_html__( 'Display Name', 'xpro-elementor-addons-pro' ),
							'description'     => esc_html__( 'Description (Bio)', 'xpro-elementor-addons-pro' ),
							'user_login'      => esc_html__( 'Login', 'xpro-elementor-addons-pro' ),
							'user_email'      => esc_html__( 'Email', 'xpro-elementor-addons-pro' ),
							'user_url'        => esc_html__( 'Url (Website)', 'xpro-elementor-addons-pro' ),
							'user_registered' => esc_html__( 'Registered', 'xpro-elementor-addons-pro' ),
							'roles'           => esc_html__( 'Roles', 'xpro-elementor-addons-pro' ),
						),
					),
					array(
						'label'   => esc_html__( 'Link', 'xpro-elementor-addons-pro' ),
						'options' => array(
							'link' => esc_html__( 'Link (Posts Archive)', 'xpro-elementor-addons-pro' ),
						),
					),
					array(
						'label'   => esc_html__( 'Name', 'xpro-elementor-addons-pro' ),
						'options' => array(
							'first_name'    => esc_html__( 'First Name', 'xpro-elementor-addons-pro' ),
							'last_name'     => esc_html__( 'Last Name', 'xpro-elementor-addons-pro' ),
							'nickname'      => esc_html__( 'Nickname', 'xpro-elementor-addons-pro' ),
							'user_nicename' => esc_html__( 'Nicename', 'xpro-elementor-addons-pro' ),
						),
					),
					array(
						'label'   => esc_html__( 'Other', 'xpro-elementor-addons-pro' ),
						'options' => array(
							'ID'                  => esc_html__( 'ID', 'xpro-elementor-addons-pro' ),
							'admin_color'         => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
							'comment_shortcuts'   => esc_html__( 'Comment Shortcuts', 'xpro-elementor-addons-pro' ),
							'user_activation_key' => esc_html__( 'Activation Key', 'xpro-elementor-addons-pro' ),
							'user_pass'           => esc_html__( 'Password', 'xpro-elementor-addons-pro' ),
							'user_status'         => esc_html__( 'Status', 'xpro-elementor-addons-pro' ),
							'user_level'          => esc_html__( 'Level', 'xpro-elementor-addons-pro' ),
							'plugins_last_view'   => esc_html__( 'Plugins last view', 'xpro-elementor-addons-pro' ),
							'plugins_per_page'    => esc_html__( 'Plugins per page', 'xpro-elementor-addons-pro' ),
							'rich_editing'        => esc_html__( 'Rich Editing', 'xpro-elementor-addons-pro' ),
							'syntax_highlighting' => esc_html__( 'Syntax Highlighting', 'xpro-elementor-addons-pro' ),
						),
					),
					array(
						'label'   => esc_html__( 'Custom', 'xpro-elementor-addons-pro' ),
						'options' => array(
							'' => esc_html__( 'Custom', 'xpro-elementor-addons-pro' ),
						),
					),
				),
			)
		);

		$this->add_control(
			'custom',
			array(
				'label'     => esc_html__( 'Meta Field', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'tag_field' => '',
				),
			)
		);
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings ) ) {
			return;
		}

		$user_id = $this->get_user_id();
		if ( ! $user_id ) {
			return;
		}

		if ( ! empty( $settings['tag_field'] ) ) {
			switch ( $settings['tag_field'] ) {
				case 'link':
					$meta = get_author_posts_url( $user_id );
					break;
				case 'roles':
					global $wp_roles;
					$user  = get_userdata( $user_id );
					$roles = (array) $user->roles;
					$meta  = array();
					if ( ! empty( $roles ) ) {
						foreach ( $roles as $role ) {
							if ( empty( $wp_roles->roles[ $role ]['name'] ) ) {
								$meta[] = $role;
							} else {
								$meta[] = $wp_roles->roles[ $role ]['name'];
							}
						}
					}
					break;
				default:
					$meta = get_the_author_meta( $settings['tag_field'], $user_id );
			}
		} else {
			$meta = get_the_author_meta( $settings['custom'], $user_id );
		}

		echo $this->to_string( $meta );
	}

	public function get_user_id() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings ) ) {
			return;
		}

		$user_id = get_current_user_id();

		if ( ! empty( $settings['source'] ) ) {
			if ( $settings['source'] == 'author' ) {
				$user_id = $this->get_author_id();
			}
			if ( $settings['source'] == 'other' ) {
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

	public static function empty( $source, $key = false ) {
		if ( is_array( $source ) ) {
			$source = array_filter( $source );
		}
		if ( $key ) {
			return Utils::is_empty( $source, $key );
		}

		return empty( $source );
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
