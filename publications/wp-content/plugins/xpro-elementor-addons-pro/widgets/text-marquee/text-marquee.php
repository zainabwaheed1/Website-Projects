<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Group_Control_Foreground;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Xpro Elementor Addons
 *
 * Elementor widget.
 *
 * @since 0.1.8
 */
class Text_Marquee extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-text-marquee';
	}

	/**
	 * Get widget inner wrapper.
	 *
	 * Retrieve widget require the inner wrapper or not.
	 * 
	 */
	public function has_widget_inner_wrapper(): bool {
		$has_wrapper = ! Plugin::$instance->experiments->is_feature_active('e_optimized_markup');
		return $has_wrapper;
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Text Marquee', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @return string Widget icon.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-center-align xpro-widget-pro-label';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_categories() {
		return array( 'xpro-widgets-pro' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_keywords() {
		return array( 'text-marquee', 'marquee', 'text' );
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 0.1.8
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_general_text_marquee',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text_marquee',
			array(
				'label'       => esc_html__( 'Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => esc_html__( 'Default Text', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your Text here', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'text_marquee_item',
			array(
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'show_label'         => false,
				'separator'          => 'after',
				'title_field'        => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{text_marquee}}'
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => array(
					array(
						'text_marquee' => __( 'Default Text', 'xpro-elementor-addons-pro' ),
					),
					array(
						'text_marquee' => __( 'Default Text', 'xpro-elementor-addons-pro' ),
					),
					array(
						'text_marquee' => __( 'Default Text', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_control(
			'text_marquee_direction',
			array(
				'label'   => esc_html__( 'Direction', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => esc_html__( 'Left', 'xpro-elementor-addons-pro' ),
					'right' => esc_html__( 'Right', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'    => array(
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-text-marquee-txt' => 'padding:0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'animation_speed',
			array(
				'label'      => __( 'Animation Speed', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'size' => 0.2,
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-text-marquee-media' => 'animation-duration: calc({{SIZE}}s * 100);',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text_marquee',
			array(
				'label' => __( 'Text', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'marquee_text_typography',
				'selector' => '{{WRAPPER}} .xpro-text-marquee-txt',
			)
		);

		$this->add_control(
			'marquee_text_outline',
			array(
				'label'        => __( 'Outline Text', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'marquee_text_outline_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E9E9E9',
				'selectors' => array(
					'{{WRAPPER}} .xpro-text-marquee-txt' => '-webkit-text-fill-color: transparent; -webkit-text-stroke-width: 1px; -webkit-text-stroke-color: {{VALUE}}; color: {{VALUE}}',
				),
				'condition' => array(
					'marquee_text_outline' => 'yes',
				),
			)
		);

		$this->add_control(
			'marquee_text_outline_width',
			array(
				'label'      => __( 'Stroke Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-text-marquee-txt' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'marquee_text_outline' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'      => 'shadow_text_gradient',
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .xpro-text-marquee-txt',
				'condition' => array(
					'marquee_text_outline!' => 'yes',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'text-marquee/layout/frontend.php';

	}

}
