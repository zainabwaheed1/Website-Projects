<?php

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Base_Tag;
use Elementor\Plugin;
use XproElementorAddonsPro\Libs\Xpro_Elementor_License;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Acf_Dynamic {

	public static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			self::$_instance->init();
		}

		return self::$_instance;
	}

	public static function init() {
		self::include_files();
		add_action( 'elementor/dynamic_tags/register', array( __CLASS__, 'register_dynamic_tags' ) );
	}

	public static function include_files() {

		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/type/text.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/type/color.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/type/number.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/type/gallery.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/type/image.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/type/url.php';

		//Group
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/group/text.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/group/color.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/group/number.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/group/gallery.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/group/image.php';
		require_once XPRO_ELEMENTOR_ADDONS_PRO_DIR_PATH . 'modules/acf-dynamic/group/url.php';

	}

	public static function register_dynamic_tags( $dynamic_tags ) {

		if ( 'valid' !== Xpro_Elementor_License::$license_activate ) {
			return;
		}

		if ( class_exists( 'ACF' ) ) {
			Plugin::$instance->dynamic_tags->register_group(
				'xpro-dynamic',
				array(
					'title' => __( 'ACF - Xpro', 'xpro-elementor-addons-pro' ),
				)
			);

			//Acf Dynamic
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Text() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Color() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Number() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Gallery() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Image() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Url() );

			//ACF GROUP
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Group\Text() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Group\Color() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Group\Number() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Group\Gallery() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Group\Image() );
			$dynamic_tags->register( new \XproElementorAddonsPro\Module\Acf_Dynamic\Group\Url() );

		}

	}

	public static function get_acf_field_value( Base_Tag $tag ) {

		$key = $tag->get_settings( 'key' );

		if ( empty( $key ) ) {
			return false;
		}
		if ( ! empty( $key ) ) {
			list( $field_key, $meta_key ) = explode( ':', $key );

			if ( 'options' === $field_key ) {
				$field = get_field_object( $meta_key, $field_key );
				$value = get_field( $field['name'], 'option' );
			} else {
				$field     = get_field_object( $field_key, get_queried_object() );
				$post_data = get_demo_post_data();
				$post_id   = $post_data->ID;
				switch ( $field['type'] ) {
					case 'oembed':
					case 'google_map':
						$value = get_post_meta( $post_id, $field['name'], true );
						break;
					case 'radio':
					case 'checkbox':
					case 'select':
						if ( 'radio' === $field['type'] ) {
							$selected   = array();
							$selected[] = get_field( $field['name'], $post_id );
						} else {
							$selected = get_field( $field['name'], $post_id );
						}

						$value = array();
						if ( ! empty( $selected ) ) {
							switch ( $field['return_format'] ) {
								case 'value':
									foreach ( $field['choices'] as $key => $label ) {
										if ( is_array( $selected ) ) {
											if ( in_array( $key, $selected, true ) ) {
												$value[ $key ] = $label;
											}
										} else {
											if ( $key === $selected ) {
												$value[ $key ] = $label;
											}
										}
									}
									break;
								case 'label':
									foreach ( $field['choices'] as $key => $label ) {
										if ( is_array( $selected ) ) {
											if ( in_array( $label, $selected, true ) ) {
												$value[ $key ] = $label;
											}
										} else {
											if ( $label === $selected ) {
												$value[ $key ] = $label;
											}
										}
									}
									break;
								case 'array':
									$is_nested_array = false;
									if ( array_key_exists( 0, $selected ) ) {
										$is_nested_array = true;
									}
									$selected_size = count( $selected );
									if ( $is_nested_array ) {
										foreach ( $selected as $select ) {
											$value[ $select['value'] ] = $select['label'];
										}
									} else {
										$value[ $selected['value'] ] = $selected['label'];
									}

									break;
							}
						}
						break;
					default:
						$value = get_field( $field['name'], $post_id );
				}
			}

			return array( $field, $meta_key, $value );
		}

		return array();
	}

	public static function get_acf_group_field_value( Base_Tag $tag ) {

		$settings = $tag->get_settings();

		if ( empty( $settings['key'] ) ) {
			return;
		}

		$group_data = explode( ':', $settings['key'] );

		if ( ! empty( $group_data[0] ) && ! empty( $group_data[1] ) && ! empty( $group_data[2] ) ) {
			$field_loc = $group_data[0];

			$group_field = $group_data[2];
			if ( 'option' === $field_loc ) {
				$field            = get_field_object( $group_data[1] );
				$group_field_data = get_field( $group_field, 'option' );
			} else {
				$field            = get_field_object( $group_data[1], get_queried_object() );
				$post_data        = get_demo_post_data();
				$post_id          = $post_data->ID;
				$group_field_data = get_field( $group_field, $post_id );
			}
			$sub_field = $settings['group_sub_field'];
		}

		if ( empty( $sub_field ) ) {
			return;
		}

		$sub_fields = $field['sub_fields'];
		foreach ( $sub_fields as $sfield ) {
			if ( $sfield['name'] === $sub_field ) {
				$sub_field_obj = $sfield;
			}
		}

		if ( $sub_field && $group_field_data && array_key_exists( $sub_field, $group_field_data ) ) {

			switch ( $sub_field_obj['type'] ) {
				case 'oembed':
				case 'google_map':
					if ( 'option' === $field_loc ) {
						$value = get_option( 'options_' . $group_data[2] . '_' . $sub_field );
					} else {
						$value = $group_field_data[ $sub_field ];
						$value = get_post_meta( $post_id, $group_field . '_' . $sub_field, true );
					}

					break;
				case 'radio':
				case 'checkbox':
				case 'select':
					if ( 'radio' === $sub_field_obj['type'] ) {
						$selected   = array();
						$selected[] = $group_field_data[ $sub_field ];
					} else {
						$selected = $group_field_data[ $sub_field ];
					}
					$value = array();
					if ( ! empty( $selected ) ) {
						switch ( $sub_field_obj['return_format'] ) {
							case 'value':
								foreach ( $sub_field_obj['choices'] as $key => $label ) {
									if ( is_array( $selected ) ) {
										if ( in_array( $key, $selected, true ) ) {
											$value[ $key ] = $label;
										}
									} else {
										if ( $key === $selected ) {
											$value[ $key ] = $label;
										}
									}
								}
								break;
							case 'label':
								foreach ( $sub_field_obj['choices'] as $key => $label ) {
									if ( is_array( $selected ) ) {
										if ( in_array( $label, $selected, true ) ) {
											$value[ $key ] = $label;
										}
									} else {
										if ( $label === $selected ) {
											$value[ $key ] = $label;
										}
									}
								}
								break;
							case 'array':
								$is_nested_array = false;
								if ( array_key_exists( 0, $selected ) ) {
									$is_nested_array = true;
								}
								$selected_size = count( $selected );
								if ( $is_nested_array ) {
									foreach ( $selected as $select ) {
										$value[ $select['value'] ] = $select['label'];
									}
								} else {
									$value[ $selected['value'] ] = $selected['label'];
								}

								break;
						}
					}
					break;
				default:
					$value = $group_field_data[ $sub_field ];

			}

			return array( $sub_field_obj, $value );
		}
	}

	//Group

	public function xpro_get_acf_group( $sup_field ) {
		$groups     = array();
		$acf_groups = acf_get_field_groups();
		foreach ( $acf_groups as $acf_group ) {
			$is_on_option_page = false;
			foreach ( $acf_group['location'] as $locations ) {
				foreach ( $locations as $location ) {
					if ( 'options_page' === $location['param'] ) {
						$is_on_option_page = true;
					}
				}
			}
			$only_on_option_page = '';
			if ( true === $is_on_option_page && ( is_array( $acf_group['location'] ) && count( $acf_group['location'] ) === 1 ) ) {
				$only_on_option_page = true;
			}
			$fields  = acf_get_fields( $acf_group );
			$options = array();
			foreach ( $fields as $field ) {
				if ( in_array( $field['type'], $sup_field, true ) ) {
					if ( $only_on_option_page ) {
						$options[ 'options:' . $field['name'] ] = 'Option:' . $field['label'];
					} else {
						if ( true === $is_on_option_page ) {
							$options[ 'options:' . $field['name'] ] = 'Option:' . $field['label'];
						}

						$options[ $field['key'] . ':' . $field['name'] ] = $field['label'];
					}
				}
			}
			if ( empty( $options ) ) {
				continue;
			}

			if ( ! empty( $options ) ) {
				$groups[] = array(
					'label'   => $acf_group['title'],
					'options' => $options,
				);
			}
		}

		return $groups;
	}

	public function register_xpro_dynamic_group_controls( $tag, $sup_fields ) {

		$acf_groups   = $this->xpro_get_acf_field_groups();
		$group_fields = $this->xpro_get_group_fields();

		$tag->add_control(
			'key',
			array(
				'label'   => __( 'Group Field', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'groups'  => $group_fields,
				'default' => '',
			)
		);

		foreach ( $acf_groups as $acf_group ) {
			$fields = $this->xpro_get_acf_fields( $acf_group );

			foreach ( $fields as $field ) {

				if ( 'group' === $field['type'] ) {
					$tag->add_control(
						'group_sub_field',
						array(
							'label'     => __( 'Sub Field', 'xpro-elementor-addons-pro' ),
							'type'      => Controls_Manager::SELECT,
							'options'   => $this->xpro_acf_get_group_sub_fields( $field['key'], $sup_fields ),
							'condition' => array(
								'key' => array(
									'post:' . $field['key'] . ':' . $field['name'],
									'option:' . $field['key'] . ':' . $field['name'],
								),
							),
						)
					);
				}
			}
		}

	}

	public function xpro_get_acf_field_groups() {

		$acf_groups = acf_get_field_groups();

		return $acf_groups;
	}

	public function xpro_get_group_fields() {

		$groups     = array();
		$acf_groups = acf_get_field_groups();
		foreach ( $acf_groups as $acf_group ) {
			$is_on_option_page = false;
			foreach ( $acf_group['location'] as $locations ) {
				foreach ( $locations as $location ) {
					if ( $location['param'] === 'options_page' ) {
						$is_on_option_page = true;
					}
				}
			}
			$only_on_option_page = '';
			if ( $is_on_option_page === true && ( is_array( $acf_group['location'] ) && 1 === count( $acf_group['location'] ) ) ) {
				$only_on_option_page = true;
			}
			$fields  = acf_get_fields( $acf_group );
			$options = array();
			foreach ( $fields as $field ) {
				if ( $field['type'] === 'group' ) {
					if ( $only_on_option_page ) {
						$options[ 'option:' . $field['key'] . ':' . $field['name'] ] = 'Option: ' . $field['label'];
					} else {
						if ( true === $is_on_option_page ) {
							$options[ 'option:' . $field['key'] . ':' . $field['name'] ] = 'Option: ' . $field['label'];
						}

						$options[ 'post:' . $field['key'] . ':' . $field['name'] ] = $field['label'];
					}
				}
			}
			if ( empty( $options ) ) {
				continue;
			}

			//  if ( 1 === count( $options ) ) {
			//    $options = array( - 1 => ' -- ' ) + $options;
			//  }

			if ( ! empty( $options ) ) {
				$groups[] = array(
					'label'   => $acf_group['title'],
					'options' => $options,
				);
			}
		}

		return $groups;
	}

	public function xpro_get_acf_fields( $acf_group = array() ) {
		$group_fields = acf_get_fields( $acf_group );

		return $group_fields;
	}

	public function xpro_acf_get_group_sub_fields( $field_id, $sup_fields ) {
		$options = array(
			'' => __( 'Select', 'xpro-elementor-addons-pro' )
		);
		$field   = acf_get_field( $field_id );
		if ( '' !== $field ) {
			$sub_fields = $field['sub_fields'];
			if ( is_array( $sub_fields ) ) {
				foreach ( $sub_fields as $sub_field ) {
					if ( in_array( $sub_field['type'], $sup_fields, true ) ) {
						$options[ $sub_field['name'] ] = $sub_field['label'];
					}
				}
			}
		}

		return $options;
	}
}


Acf_Dynamic::instance();
