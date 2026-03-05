<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
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
class Creative_Button extends Widget_Base {

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
		return 'xpro-creative-button';
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
		return __( 'Creative Button', 'xpro-elementor-addons-pro' );
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
		return 'xi-mouse-3 xpro-widget-pro-label';
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
		return array( 'creative', 'button', 'creative-button' );
	}

	/**
	 * Retrieve the list of style the widget depended on.
	 *
	 * Used to set style dependencies required to run the widget.
	 *
	 * @return array Widget style dependencies.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'              => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1'  => esc_html__( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2'  => esc_html__( 'Style 2', 'xpro-elementor-addons-pro' ),
					'3'  => esc_html__( 'Style 3', 'xpro-elementor-addons-pro' ),
					'4'  => esc_html__( 'Style 4', 'xpro-elementor-addons-pro' ),
					'5'  => esc_html__( 'Style 5', 'xpro-elementor-addons-pro' ),
					'6'  => esc_html__( 'Style 6', 'xpro-elementor-addons-pro' ),
					'7'  => esc_html__( 'Style 7', 'xpro-elementor-addons-pro' ),
					'8'  => esc_html__( 'Style 8', 'xpro-elementor-addons-pro' ),
					'9'  => esc_html__( 'Style 9', 'xpro-elementor-addons-pro' ),
					'10' => esc_html__( 'Style 10', 'xpro-elementor-addons-pro' ),
					'11' => esc_html__( 'Style 11', 'xpro-elementor-addons-pro' ),
					'12' => esc_html__( 'Style 12', 'xpro-elementor-addons-pro' ),
					'13' => esc_html__( 'Style 13', 'xpro-elementor-addons-pro' ),
					'14' => esc_html__( 'Style 14', 'xpro-elementor-addons-pro' ),
					'15' => esc_html__( 'Style 15', 'xpro-elementor-addons-pro' ),
					'16' => esc_html__( 'Style 16', 'xpro-elementor-addons-pro' ),
					'17' => esc_html__( 'Style 17', 'xpro-elementor-addons-pro' ),
					'18' => esc_html__( 'Style 18', 'xpro-elementor-addons-pro' ),
					'19' => esc_html__( 'Style 19', 'xpro-elementor-addons-pro' ),
					'20' => esc_html__( 'Style 20', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => 'Button Text',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'box_link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_responsive_control(
			'creative_btn_align',
			array(
				'label'     => esc_html__( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-h-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-wrapper' => 'text-align: {{VALUE}};',
				),
				'default'   => 'left',
				'toggle'    => true,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'layout!' => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'icon[value]!' => '',
					'layout!'      => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'creative_btn_css_id',
			array(
				'label'       => __( 'Button ID', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'xpro-elementor-addons-pro' ),
				'separator'   => 'before',

			)
		);

		$this->add_control(
			'onclick_event',
			array(
				'label'       => esc_html__( 'onClick Event', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'myFunction()',
			)
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'btn_width',
			array(
				'label'      => esc_html__( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-2 .xpro-creative-btn-svg'                 => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-creative-btn-layout-5 .xpro-creative-btn-text-circle,
					{{WRAPPER}} .xpro-creative-btn-layout-13 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-16 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-17 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-18 .xpro-creative-btn' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '2', '5', '13', '14', '15', '16', '17', '18' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_height',
			array(
				'label'      => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-13 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-16 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-17 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-18 .xpro-creative-btn' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'layout' => array( '13', '14', '15', '16', '17', '18' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-creative-btn-text,{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn-content span,{{WRAPPER}} .xpro-creative-btn-layout-5 .xpro-creative-btn-text-circle > text > textPath',
			)
		);

		$this->start_controls_tabs( 'creative_btn_style' );

		$this->start_controls_tab(
			'creative_btn_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'btn_blend_mode',
			array(
				'label'     => esc_html__( 'Blend Mode', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'difference',
				'options'   => array(
					'normal'      => esc_html__( 'Normal', 'xpro-elementor-addons-pro' ),
					'color'       => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
					'color-burn'  => esc_html__( 'Color Burn', 'xpro-elementor-addons-pro' ),
					'multiply'    => esc_html__( 'Multiply', 'xpro-elementor-addons-pro' ),
					'difference'  => esc_html__( 'Difference', 'xpro-elementor-addons-pro' ),
					'darken'      => esc_html__( 'Darken', 'xpro-elementor-addons-pro' ),
					'overlay'     => esc_html__( 'Overlay', 'xpro-elementor-addons-pro' ),
					'lighten'     => esc_html__( 'Lighten', 'xpro-elementor-addons-pro' ),
					'color-dodge' => esc_html__( 'Color Dodge', 'xpro-elementor-addons-pro' ),
					'saturation'  => esc_html__( 'Saturation', 'xpro-elementor-addons-pro' ),
					'screen'      => esc_html__( 'Screen', 'xpro-elementor-addons-pro' ),
					'luminosity'  => esc_html__( 'Luminosity', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-media > i,
					{{WRAPPER}} .xpro-creative-btn-media > .xpro-creative-btn-text' => 'mix-blend-mode: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '6', '7', '8' ),
				),
			)
		);

		$this->add_control(
			'btn_normal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-media > i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-creative-btn-media > svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'icon[value]!' => '',
					'layout!'      => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'btn_normal_icons_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-12 .icon-right:after,
					{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'btn_normal_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-media .xpro-creative-btn-text,
					{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn-content-inner span'             => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-creative-btn-layout-5 .xpro-creative-btn-text-circle > text > textPath' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btn_normal_bg',
				'label'     => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-creative-btn-layout-1 .xpro-creative-btn::before,
				{{WRAPPER}} .xpro-creative-btn-layout-3 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-6 .xpro-creative-btn::before,
				{{WRAPPER}} .xpro-creative-btn-layout-7 .xpro-creative-btn::before,
				{{WRAPPER}} .xpro-creative-btn-layout-8 .xpro-creative-btn::before,
				{{WRAPPER}} .xpro-creative-btn-layout-9 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-10 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-11 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-12 .xpro-creative-btn:hover:before,
				{{WRAPPER}} .xpro-creative-btn-layout-13 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn:after,
				{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-16 .xpro-creative-btn:before,
				{{WRAPPER}} .xpro-creative-btn-layout-17 .xpro-creative-btn:before,
				{{WRAPPER}} .xpro-creative-btn-layout-18 .xpro-creative-btn:before,
				{{WRAPPER}} .xpro-creative-btn-layout-19 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-20 .xpro-creative-btn',
				'condition' => array(
					'layout!' => array( '2', '5' ),
				),
			)
		);

		$this->add_control(
			'btn_normal_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-line' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '13' ),
				),
			)
		);

		$this->add_control(
			'btn_normal_outline_color',
			array(
				'label'     => __( 'Outline Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-1 .xpro-creative-btn::after' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '1' ),
				),
			)
		);

		$this->add_control(
			'btn_normal_stroke_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-2 .xpro-creative-btn-svg-circle,
					{{WRAPPER}} .xpro-creative-btn-layout-2 .xpro-creative-btn-svg-path' => 'stroke: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '2' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'creative_btn_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'btn_hv_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn:hover .xpro-creative-btn-media > i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-creative-btn:hover .xpro-creative-btn-media > svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'icon[value]!' => '',
					'layout!'      => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'btn_hv_icons_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-12 .xpro-creative-btn:hover .icon-right:after,
					{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn:hover:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'btn_hv_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn:hover .xpro-creative-btn-text,
					{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn:hover .xpro-creative-btn-content-inner span'             => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-creative-btn-layout-5 .xpro-creative-btn:hover .xpro-creative-btn-text-circle > text > textPath' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btn_hv_bg',
				'label'     => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-creative-btn-layout-1 .xpro-creative-btn:hover:before,
				{{WRAPPER}} .xpro-creative-btn-layout-3 .xpro-creative-btn:hover,
				{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn:hover,
				{{WRAPPER}} .xpro-creative-btn-layout-6 .xpro-creative-btn:hover::before,
				{{WRAPPER}} .xpro-creative-btn-layout-7 .xpro-creative-btn:hover::before,
				{{WRAPPER}} .xpro-creative-btn-layout-8 .xpro-creative-btn:hover::before,
				{{WRAPPER}} .xpro-creative-btn-layout-9 .xpro-creative-btn::before,
				{{WRAPPER}} .xpro-creative-btn-layout-9 .xpro-creative-btn::after,
				{{WRAPPER}} .xpro-creative-btn-layout-10 .xpro-creative-btn-hvr-effect,
				{{WRAPPER}} .xpro-creative-btn-layout-11 .xpro-creative-btn:before,
				{{WRAPPER}} .xpro-creative-btn-layout-12 .xpro-creative-btn:before,
				{{WRAPPER}} .xpro-creative-btn-layout-13 .xpro-creative-btn:hover:before,
				{{WRAPPER}} .xpro-creative-btn-layout-13 .xpro-creative-btn:hover:after,
				{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn:hover:after,
				{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn:hover .box,
				{{WRAPPER}} .xpro-creative-btn-layout-16 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-17 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-18 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-19 .xpro-creative-btn:hover:after,
				{{WRAPPER}} .xpro-creative-btn-layout-20 .xpro-creative-btn:hover:after',
				'condition' => array(
					'layout!' => array( '2', '5' ),
				),
			)
		);

		$this->add_control(
			'btn_hv_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn:hover .xpro-creative-btn-line' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '13' ),
				),
			)
		);

		$this->add_control(
			'btn_hv_outline_color',
			array(
				'label'     => __( 'Outline Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-1 .xpro-creative-btn:hover::after' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '1' ),
				),
			)
		);

		$this->add_control(
			'btn_hv_stroke_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-2 .xpro-creative-btn-svg-path' => 'stroke: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '2' ),
				),
			)
		);

		$this->add_control(
			'btn_hv_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-3 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-6 .xpro-creative-btn:hover::before,
					{{WRAPPER}} .xpro-creative-btn-layout-7 .xpro-creative-btn:hover::before,
					{{WRAPPER}} .xpro-creative-btn-layout-8 .xpro-creative-btn:hover::before,
					{{WRAPPER}} .xpro-creative-btn-layout-9 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-10 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-10 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-11 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn:hover,
					{{WRAPPER}} .xpro-creative-btn-layout-19 .xpro-creative-btn:before,
					{{WRAPPER}} .xpro-creative-btn-layout-20 .xpro-creative-btn:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn:hover' => 'box-shadow: 15px 11px 0 white, 18px 14px 0 {{VALUE}};',

				),
				'condition' => array(
					'layout!' => array( '1', '2', '5', '12', '13' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btn_border',
				'selector'  => '{{WRAPPER}} .xpro-creative-btn-layout-3 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-9 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-10 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-11 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-16 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-17 .xpro-creative-btn,
				{{WRAPPER}} .xpro-creative-btn-layout-18 .xpro-creative-btn',
				'separator' => 'before',
				'condition' => array(
					'layout' => array( '3', '4', '9', '10', '11', '15', '16', '17', '18' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-3 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-9 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-10 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-11 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-15 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-16 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-17 .xpro-creative-btn,
					{{WRAPPER}} .xpro-creative-btn-layout-18 .xpro-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '3', '4', '9', '10', '11', '15', '16', '17', '18' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn,{{WRAPPER}} .xpro-creative-btn-layout-4 .xpro-creative-btn-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '1', '2', '5', '13', '14', '15', '16', '17', '18' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'btn_icon_options',
			array(
				'label'     => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'icon[value]!' => '',
					'layout!'      => array( '12', '14' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-creative-btn-media > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				),
				'condition'  => array(
					'icon[value]!' => '',
					'layout!'      => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 5,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-align-icon-right .xpro-creative-btn-media > i,
					{{WRAPPER}} .xpro-align-icon-right .xpro-creative-btn-media > svg'                    => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-align-icon-left .xpro-creative-btn-media > i,
					{{WRAPPER}} .xpro-align-icon-left .xpro-creative-btn-media > svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'icon[value]!' => '',
					'layout!'      => array( '12', '14' ),
				),
			)
		);

		$this->add_control(
			'btn_icons_options',
			array(
				'label'     => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => array( '12', '14' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_icons_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-creative-btn-layout-12 .icon-right:after,
					{{WRAPPER}} .xpro-creative-btn-layout-14 .xpro-creative-btn:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '12', '14' ),
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'creative-button/layout/frontend.php';

	}

}
