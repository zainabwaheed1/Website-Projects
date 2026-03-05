<?php
/**
 * Background Animated Gradient extension class.
 *
 * @package XproELementorAddons
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Animated_Gradient {

	static $should_script_enqueue = false; //phpcs:ignore PSR2.Classes.PropertyDeclaration.ScopeMissing

	public static function init() {
		add_action( 'elementor/element/section/section_background/after_section_end', array( __CLASS__, 'register' ), 10 );
		add_action( 'elementor/element/container/section_background/after_section_end', array( __CLASS__, 'register' ), 10 );
		add_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		add_action( 'elementor/frontend/container/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 99 );
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

		if ( 'yes' === $section->get_settings_for_display( 'xpro_animated_gradient_fx_enable' ) ) {
			self::enqueue_scripts();

			self::$should_script_enqueue = true;

			remove_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'granim' );
		wp_enqueue_script( 'xpro-animated-gradient', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/animated-gradient/js/animated-gradient.min.js', array( 'jquery' ), XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register( Element_Base $element ) {

		$element->start_controls_section(
			'section_xpro_animated_gradient',
			array(
				'label' => __( 'Animated Gradient', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$element->add_control(
			'xpro_animated_gradient_fx_enable',
			array(
				'label'              => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'separator'          => 'before',
				'prefix_class'       => 'xpro-animated-gradient-',
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_animated_gradient_fx_direction',
			array(
				'label'              => esc_html__( 'Direction', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'left-right',
				'options'            => array(
					'left-right' => esc_html__( 'Left to Right', 'xpro-elementor-addons-pro' ),
					'diagonal'   => esc_html__( 'Diagonal', 'xpro-elementor-addons-pro' ),
					'top-bottom' => esc_html__( 'Top to Bottom', 'xpro-elementor-addons-pro' ),
					'radial'     => esc_html__( 'Radial', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'condition'          => array(
					'xpro_animated_gradient_fx_enable' => 'yes',
				),
			)
		);

		$element->add_control(
			'xpro_animated_gradient_fx_blend_mode',
			array(
				'type'        => Controls_Manager::SELECT,
				'label'       => esc_html__( 'Blend mode', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'default'     => '',
				'options'     => array(
					''            => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
					'normal'      => esc_html__( 'Normal', 'xpro-elementor-addons-pro' ),
					'multiply'    => esc_html__( 'Multiply', 'xpro-elementor-addons-pro' ),
					'screen'      => esc_html__( 'Screen', 'xpro-elementor-addons-pro' ),
					'overlay'     => esc_html__( 'Overlay', 'xpro-elementor-addons-pro' ),
					'darken'      => esc_html__( 'Darken', 'xpro-elementor-addons-pro' ),
					'lighten'     => esc_html__( 'Lighten', 'xpro-elementor-addons-pro' ),
					'color-dodge' => esc_html__( 'Color Dodge', 'xpro-elementor-addons-pro' ),
					'color-burn'  => esc_html__( 'Color Burn', 'xpro-elementor-addons-pro' ),
					'hard-light'  => esc_html__( 'Hard Light', 'xpro-elementor-addons-pro' ),
					'soft-light'  => esc_html__( 'Soft Light', 'xpro-elementor-addons-pro' ),
					'difference'  => esc_html__( 'Difference', 'xpro-elementor-addons-pro' ),
					'exclusion'   => esc_html__( 'Exclusion', 'xpro-elementor-addons-pro' ),
					'hue'         => esc_html__( 'Hue', 'xpro-elementor-addons-pro' ),
					'saturation'  => esc_html__( 'Saturation', 'xpro-elementor-addons-pro' ),
					'color'       => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
					'luminosity'  => esc_html__( 'Luminosity', 'xpro-elementor-addons-pro' ),
				),
				'condition'   => array(
					'xpro_animated_gradient_fx_enable' => 'yes',
				),
				'selectors'   => array(
					'#xpro-animated-gradient-{{ID}}' => 'mix-blend-mode: {{SIZE}}',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'xpro_animated_gradient_fx_start_color',
			array(
				'label' => esc_html__( 'Start Color', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::COLOR,
				'alpha'  => false,
			)
		);

		$repeater->add_control(
			'xpro_animated_gradient_fx_end_color',
			array(
				'label' => esc_html__( 'End Color', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::COLOR,
				'alpha'  => false,
			)
		);

		$element->add_control(
			'xpro_animated_gradient_fx_color_list',
			array(
				'label'              => __( 'Colors', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'prevent_empty'      => false,
				'title_field'        => '{{{ xpro_animated_gradient_fx_start_color }}} - {{{ xpro_animated_gradient_fx_end_color }}}',
				'default'            => array(
					array(

						'xpro_animated_gradient_fx_start_color' => '#ff9966',
						'xpro_animated_gradient_fx_end_color' => '#ff5e62',
					),
					array(

						'xpro_animated_gradient_fx_start_color' => '#FF6B6B',
						'xpro_animated_gradient_fx_end_color' => '#556270',
					),
					array(

						'xpro_animated_gradient_fx_start_color' => '#80d3fe',
						'xpro_animated_gradient_fx_end_color' => '#7ea0c4',
					),
				),
				'condition'          => array(
					'xpro_animated_gradient_fx_enable' => 'yes',
				),
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_animated_gradient_fx_transition_speed',
			array(
				'label'              => esc_html__( 'Transition Speed (s)', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					),
				),
				'condition'          => array(
					'xpro_animated_gradient_fx_enable' => 'yes',
				),
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_animated_gradient_fx_opacity',
			array(
				'label'     => esc_html__( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => .1,
						'step' => .1,
					),
				),
				'selectors' => array(
					'#xpro-animated-gradient-{{ID}}' => 'opacity: {{SIZE}}',
				),
				'condition' => array(
					'xpro_animated_gradient_fx_enable' => 'yes',
				),
			)
		);

		$element->end_controls_section();

	}
}

Xpro_Elementor_Animated_Gradient::init();
