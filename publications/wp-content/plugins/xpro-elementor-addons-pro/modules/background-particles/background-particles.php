<?php
/**
 * Background Particles extension class.
 *
 * @package XproELementorAddons
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Background_Particles {

	static $should_script_enqueue = false; //phpcs:ignore PSR2.Classes.PropertyDeclaration.ScopeMissing

	public static function init() {

		add_action( 'elementor/element/section/section_background/after_section_end', array( __CLASS__, 'register' ), 10 );
		add_action( 'elementor/element/container/section_background/after_section_end', array( __CLASS__, 'register' ), 10 );
		add_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		add_action( 'elementor/frontend/container/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 99 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
	}

	/**
	 * Set should_script_enqueue based extension settings
	 *
	 * @param Element_Base $section
	 *
	 * @return void
	 */
	public static function should_script_enqueue( Element_Base $section ) {

		$settings = $section->get_settings_for_display();

		if ( self::$should_script_enqueue ) {
			return;
		}

		if ( 'yes' === $section->get_settings_for_display( 'xpro_elementor_particles_fx_enable' ) ) {
			self::enqueue_scripts();

			self::$should_script_enqueue = true;

			remove_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'particles' );
		wp_enqueue_script( 'xpro-bg-particles', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/background-particles/js/background-particles.min.js', array( 'jquery' ), XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register( Element_Base $element ) {

		$element->start_controls_section(
			'section_xpro_elementor_particles',
			array(
				'label' => __( 'Background Particles', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$element->add_control(
			'xpro_elementor_particles_fx_enable',
			array(
				'label'              => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'separator'          => 'before',
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$default_particles = '{"particles":{"number":{"value":80,"density":{"enable":true,"value_area":1042.21783956259}},"color":{"value":"#e6e6e6"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.4734885849793636,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":12.03412060865523,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":64.13648243462092,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":false}';

		$element->add_control(
			'xpro_elementor_particles_fx_json_notice',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-control-field-description',
				'raw'             => __( '<a href="https://vincentgarreau.com/particles.js/" target="_blank">Click here</a> to generate JSON for the below field.', 'xpro-elementor-addons-pro' ),
				'condition'       => array(
					'xpro_elementor_particles_fx_enable' => 'yes',
				),
			)
		);

		$element->add_control(
			'xpro_elementor_particles_fx_json',
			array(
				'type'               => Controls_Manager::CODE,
				'label'              => esc_html__( 'Enter JSON', 'xpro-elementor-addons-pro' ),
				'default'            => $default_particles,
				'render_type'        => 'template',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_particles_fx_enable' => 'yes',
				),
			)
		);

		$element->end_controls_section();

	}

}

Xpro_Elementor_Background_Particles::init();
