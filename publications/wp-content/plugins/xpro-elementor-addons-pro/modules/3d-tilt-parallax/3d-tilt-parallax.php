<?php
/**
 * 3D Tilt Parallax extension class.
 *
 * @package XproELementorAddonsPro
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_3D_Tilt_Parallax {

	static $should_script_enqueue = false; //phpcs:ignore PSR2.Classes.PropertyDeclaration.ScopeMissing

	public static function init() {

		add_action( 'elementor/element/common/_section_style/after_section_end', array( __CLASS__, 'register' ), 1 );
		add_action( 'elementor/frontend/widget/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
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

		if ( self::$should_script_enqueue ) {
			return;
		}

		if ( 'yes' === $section->get_settings_for_display( 'xpro_elementor_3d_tilt_parallax_fx' ) ) {
			self::enqueue_scripts();

			self::$should_script_enqueue = true;

			remove_action( 'elementor/frontend/widget/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'vanilla-tilt' );
		wp_enqueue_script( 'xpro-3d-tilt-parallax', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/3d-tilt-parallax/js/3d-tilt-parallax.min.js', null, XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'section_xpro_elementor_3d_tilt_parallax',
			array(
				'label' => __( '3D Tilt Parallax', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx',
			array(
				'label'        => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'xpro-3d-tilt-parallax-',
			)
		);

		//Mouse Track
		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_track_toggle',
			array(
				'label'              => __( 'Mouse Track', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_track_direction',
			array(
				'label'              => __( 'Direction', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'opposite',
				'options'            => array(
					'direct'   => __( 'Direct', 'xpro-elementor-addons-pro' ),
					'opposite' => __( 'Opposite', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_track_speed',
			array(
				'label'              => __( 'Speed', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 2,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx_track_toggle' => 'yes',
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->end_popover();

		//Mouse 3D Tilt
		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_tilt_toggle',
			array(
				'label'              => __( '3D Tilt', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_tilt_direction',
			array(
				'label'              => __( 'Direction', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'opposite',
				'options'            => array(
					'direct'   => __( 'Direct', 'xpro-elementor-addons-pro' ),
					'opposite' => __( 'Opposite', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx_tilt_toggle' => 'yes',
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
			)
		);

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_tilt_speed',
			array(
				'label'              => __( 'Speed', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 4,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx_tilt_toggle' => 'yes',
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_tilt_scale',
			array(
				'label'              => __( 'Scale', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 1.1,
				),
				'range'              => array(
					'px' => array(
						'min'  => 1,
						'max'  => 2,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx_tilt_toggle' => 'yes',
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_tilt_glare',
			array(
				'label'              => __( 'Glare', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0.5,
				),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx_tilt_toggle' => 'yes',
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_3d_tilt_parallax_fx_relative',
			array(
				'label'              => __( 'Effects Relative To', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '',
				'options'            => array(
					''     => __( 'Default', 'xpro-elementor-addons-pro' ),
					'body' => __( 'Entire Page', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'condition'          => array(
					'xpro_elementor_3d_tilt_parallax_fx_tilt_toggle' => 'yes',
					'xpro_elementor_3d_tilt_parallax_fx' => 'yes',
				),
			)
		);

		$element->end_popover();

		$element->end_controls_section();
	}
}

Xpro_Elementor_3D_Tilt_Parallax::init();
