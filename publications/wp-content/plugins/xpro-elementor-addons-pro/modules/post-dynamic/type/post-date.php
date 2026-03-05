<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Date extends Tag {

	public function get_name() {
		return 'xpro-post-date';
	}

	public function get_title() {
		return __( 'Post Date', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-post-dynamic';
	}

	public function get_categories() {
		return array(
			Module::TEXT_CATEGORY,
		);
	}

	public function render() {
		$settings  = $this->get_settings_for_display();
		$post_data = get_demo_post_data();
		$date_type = $settings['type'];
		$format    = $settings['format'];
		if ( 'human' === $format ) {
			/* translators: %s: Human readable date/time. */
			$value = sprintf( __( '%s ago', 'xpro-elementor-addons-pro' ), human_time_diff( strtotime( $post_data->{$date_type} ) ) );
		} else {
			switch ( $format ) {
				case 'default':
					$date_format = '';
					break;
				case 'custom':
					$date_format = $settings['custom_format'];
					break;
				default:
					$date_format = $format;
					break;
			}

			if ( 'post_date_gmt' === $date_type ) {
				$value = get_the_date( $date_format, $post_data->ID );
			} else {
				$value = get_the_modified_date( $date_format, $post_data->ID );
			}
		}
		echo wp_kses_post( $value );
	}

	protected function register_controls() {
		$this->add_control(
			'type',
			array(
				'label'   => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'post_date_gmt'     => __( 'Post Published', 'xpro-elementor-addons-pro' ),
					'post_modified_gmt' => __( 'Post Modified', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'post_date_gmt',
			)
		);

		$this->add_control(
			'format',
			array(
				'label'   => __( 'Format', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
					'F j, Y'  => gmdate( 'F j, Y' ),
					'Y-m-d'   => gmdate( 'Y-m-d' ),
					'm/d/Y'   => gmdate( 'm/d/Y' ),
					'd/m/Y'   => gmdate( 'd/m/Y' ),
					'human'   => __( 'Human Readable', 'xpro-elementor-addons-pro' ),
					'custom'  => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'custom_format',
			array(
				'label'       => __( 'Custom Format', 'xpro-elementor-addons-pro' ),
				'default'     => '',
				'description' => sprintf( '<a href="https://go.elementor.com/wordpress-date-time/" target="_blank">%s</a>', __( 'Documentation on date and time formatting', 'xpro-elementor-addons-pro' ) ),
				'condition'   => array(
					'format' => 'custom',
				),
			)
		);
	}
}
