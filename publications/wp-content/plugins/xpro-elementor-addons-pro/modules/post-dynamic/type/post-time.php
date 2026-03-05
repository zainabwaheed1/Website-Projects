<?php

namespace XproElementorAddonsPro\Module\Post_Dynamic;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Post_Time extends Tag {

	public function get_name() {
		return 'xpro-post-time';
	}

	public function get_title() {
		return __( 'Post Time', 'xpro-elementor-addons-pro' );
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
		$time_type = $settings['type'];
		$format    = $settings['format'];
		switch ( $format ) {
			case 'default':
				$date_format = '';
				break;
			case 'custom':
				$date_format = $this->get_settings( 'custom_format' );
				break;
			default:
				$date_format = $format;
				break;
		}

		if ( 'post_date_gmt' === $time_type ) {
			$value = get_the_time( $date_format, $post_data->ID );
		} else {
			$value = get_the_modified_time( $date_format, $post_data->ID );
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
					'g:i a'   => gmdate( 'g:i a' ),
					'g:i A'   => gmdate( 'g:i A' ),
					'H:i'     => gmdate( 'H:i' ),
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
