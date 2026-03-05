<?php
/**
 * Scroll Effect extension class.
 *
 * @package XproELementorAddonsPro
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Scroll_Effect {

	static $should_script_enqueue = false; //phpcs:ignore PSR2.Classes.PropertyDeclaration.ScopeMissing

	public static function init() {

		add_action( 'elementor/element/common/_section_style/after_section_end', array( __CLASS__, 'register' ), 1 );
		add_action( 'elementor/frontend/widget/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );

	}

	/**
	 * Set should_script_enqueue based extension settings
	 *
	 * @param Element_Base $section
	 *
	 * @return void
	 */
	public static function should_script_enqueue( Element_Base $section ) {

		if ( self::$should_script_enqueue ) {
			return;
		}

		if ( 'yes' === $section->get_settings_for_display( 'xpro_elementor_scroll_fx' ) ) {
			self::enqueue_scripts();

			self::$should_script_enqueue = true;

			remove_action( 'elementor/frontend/widget/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'lax' );
		wp_enqueue_script( 'xpro-scroll-effect', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/scroll-effect/js/scroll-effect.min.js', null, XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'section_xpro_elementor_scroll',
			array(
				'label' => __( 'Scroll Effect', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx',
			array(
				'label'              => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'prefix_class'       => 'xpro-scroll-effect-',
			)
		);

		//Horizontal Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_horizontal_toggle',
			array(
				'label'              => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_horizontal_amount',
			array(
				'label'              => __( 'Amount', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 200,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_horizontal_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_horizontal_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_horizontal_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_horizontal_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_horizontal_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Vertical Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_vertical_toggle',
			array(
				'label'              => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_vertical_amount',
			array(
				'label'              => __( 'Amount', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 200,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_vertical_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_vertical_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_vertical_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_vertical_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_vertical_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Rotate Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_rotate_toggle',
			array(
				'label'              => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'selectors'          => array(
					'{{WRAPPER}}' => 'transform-origin:center center;',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_rotate_amount',
			array(
				'label'              => __( 'Amount', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 180,
				),
				'range'              => array(
					'px' => array(
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_rotate_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_rotate_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_rotate_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_rotate_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_rotate_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Flip Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_flip_toggle',
			array(
				'label'              => __( 'Flip', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_flip_amount',
			array(
				'label'              => __( 'Amount', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 180,
				),
				'range'              => array(
					'px' => array(
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_flip_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_flip_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_flip_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_flip_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_flip_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Scale Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_scale_toggle',
			array(
				'label'              => __( 'Scale', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_scale_amount_start',
			array(
				'label'              => __( 'Start Scale', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 1,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_scale_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_scale_amount_end',
			array(
				'label'              => __( 'End Scale', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 1.4,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_scale_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_scale_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_scale_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_scale_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_scale_toggle' => 'yes',
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Fade Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_fade_toggle',
			array(
				'label'              => __( 'Fade', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_fade_amount_start',
			array(
				'label'              => __( 'Start Opacity', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0.2,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_fade_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_fade_amount_end',
			array(
				'label'              => __( 'End Opacity', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 1,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_fade_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_fade_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_fade_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_fade_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_fade_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Blur Transform
		$element->add_control(
			'xpro_elementor_scroll_fx_blur_toggle',
			array(
				'label'              => __( 'Blur', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_blur_amount_start',
			array(
				'label'              => __( 'Start Blur', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_blur_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_blur_amount_end',
			array(
				'label'              => __( 'End Blur', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 5,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_blur_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_blur_start_offset',
			array(
				'label'              => __( 'Start Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_blur_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_scroll_fx_blur_end_offset',
			array(
				'label'              => __( 'End Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0,
				),
				'range'              => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx_blur_toggle' => 'yes',
					'xpro_elementor_scroll_fx'             => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		$element->add_control(
			'xpro_elementor_scroll_fx_disable',
			array(
				'label'              => __( 'Disable On', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'multiple'           => true,
				'default'            => 'tablet',
				'options'            => array(
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
					'tablet' => __( 'Tablet & Mobile', 'xpro-elementor-addons-pro' ),
					'mobile' => __( 'Mobile', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'xpro_elementor_scroll_fx' => 'yes',
				),
				'render_type'        => 'none',
				'frontend_available' => true,
			)
		);

		$element->end_controls_section();
	}
}

Xpro_Elementor_Scroll_Effect::init();
