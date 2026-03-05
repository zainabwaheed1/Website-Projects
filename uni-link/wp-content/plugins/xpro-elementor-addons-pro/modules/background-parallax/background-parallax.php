<?php
/**
 * Background Parallax extension class.
 *
 * @package XproELementorAddons
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Background_Parallax {

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

		if ( 'yes' === $section->get_settings_for_display( 'xpro_elementor_parallax_fx_enable' ) ) {
			self::enqueue_scripts();

			self::$should_script_enqueue = true;

			remove_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'should_script_enqueue' ) );
		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'parallaxie' );
		wp_enqueue_script( 'xpro-bg-parallax', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/background-parallax/js/background-parallax.min.js', array( 'jquery' ), XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register( Element_Base $element ) {

		$element->start_controls_section(
			'section_xpro_elementor_parallax',
			array(
				'label' => __( 'Background Parallax', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$element->add_control(
			'xpro_elementor_parallax_fx_enable',
			array(
				'label'              => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'separator'          => 'before',
				'prefix_class'       => 'xpro-parallax-',
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_parallax_fx_speed',
			array(
				'label'              => __( 'Speed', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 0.5,
				),
				'range'              => array(
					'px' => array(
						'min'  => -2,
						'max'  => 2,
						'step' => 0.1,
					),
				),
				'condition'          => array(
					'xpro_elementor_parallax_fx_enable' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'xpro_elementor_parallax_fx_offset',
			array(
				'label'              => __( 'Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'condition'          => array(
					'xpro_elementor_parallax_fx_enable' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->end_controls_section();

	}
}

Xpro_Elementor_Background_Parallax::init();
