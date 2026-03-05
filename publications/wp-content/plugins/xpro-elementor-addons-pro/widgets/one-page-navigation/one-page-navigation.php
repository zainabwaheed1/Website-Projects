<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
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
class One_Page_Navigation extends Widget_Base {

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
		return 'xpro-one-page-navigation';
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
		return __( 'One Page Navigation', 'xpro-elementor-addons-pro' );
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
		return 'xi-link xpro-widget-pro-label';
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
		return array( 'navigation', 'one-page-navigation' );
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
			'section_general_mouse_cursor',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'Orientation',
			array(
				'label'   => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'vertical',
			)
		);

		$this->add_control(
			'vertical_positions',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'middle-right',
				'options'   => array(
					'top-left'     => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-right'    => __( 'Top Right', 'xpro-elementor-addons-pro' ),
					'middle-left'  => __( 'Middle Left', 'xpro-elementor-addons-pro' ),
					'middle-right' => __( 'Middle Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'  => __( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-right' => __( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'Orientation' => 'vertical',
				),
			)
		);

		$this->add_control(
			'horizontal_positions',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-right',
				'options'   => array(
					'top-left'      => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center'    => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'     => __( 'Top Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => __( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-center' => __( 'Bottom Center', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => __( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'Orientation' => 'horizontal',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'page_nav_section_id',
			array(
				'label'              => __( 'Section ID', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'placeholder'        => __( 'Add your section ID here', 'xpro-elementor-addons-pro' ),
				'label_block'        => false,
				'frontend_available' => true,
				'dynamic'            => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'enable_tooltip_text',
			array(
				'label'        => esc_html__( 'Enable Tooltip Text', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'separator'    => 'before',
				'default'      => 'yes',
			)
		);

		$repeater->add_control(
			'tooltip_text',
			array(
				'label'       => esc_html__( 'Tooltip Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Home', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'enable_tooltip_text' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-home',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'one_page_nav_inline_style',
			array(
				'label'        => esc_html__( 'Inline Style', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$repeater->start_controls_tabs(
			'one_pages_nav_item_inline',
			array(
				'separator' => 'before',
				'condition' => array(
					'one_page_nav_inline_style' => 'yes',
				),
			)
		);

		$repeater->start_controls_tab(
			'inline_pages_nav_item_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_item_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a > .xpro-one-page-nav-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a > .xpro-one-page-nav-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_normal_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_normal_tooltip_color',
			array(
				'label'     => esc_html__( 'Tooltip Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a > .xpro-one-page-nav-tooltip' => 'color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_normal_tooltip_bg_color',
			array(
				'label'     => esc_html__( 'Tooltip Bg Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a > .xpro-one-page-nav-tooltip,
					{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a > .xpro-one-page-nav-tooltip:after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'inline_pages_nav_item_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_item_hv_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a:hover .xpro-one-page-nav-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_item_hv_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'inline_pages_nav_item_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_item_active_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a.active .xpro-one-page-nav-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'inline_pages_nav_item_active_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > {{CURRENT_ITEM}} > a.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'one_page_nav_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'separator'   => 'before',
				'title_field' => '{{{ tooltip_text }}}',
				'default'     => array(
					array(
						'page_nav_section_id' => esc_html__( 'home', 'xpro-elementor-addons-pro' ),
						'tooltip_text'        => esc_html__( 'Home', 'xpro-elementor-addons-pro' ),
						'icon'                => array(
							'value'   => 'fas fa-home',
							'library' => 'solid',
						),
					),
					array(
						'page_nav_section_id' => esc_html__( 'download', 'xpro-elementor-addons-pro' ),
						'tooltip_text'        => esc_html__( 'Download', 'xpro-elementor-addons-pro' ),
						'icon'                => array(
							'value'   => 'fas fa-download',
							'library' => 'solid',
						),
					),
					array(
						'page_nav_section_id' => esc_html__( 'link', 'xpro-elementor-addons-pro' ),
						'tooltip_text'        => esc_html__( 'Link', 'xpro-elementor-addons-pro' ),
						'icon'                => array(
							'value'   => 'fas fa-link',
							'library' => 'solid',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'scroll_height_page_nav',
			array(
				'label'              => esc_html__( 'Scroll Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'px'                 => array(
					'range' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'            => array(
					'size' => 20,
				),
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'transition_duration_page_nav',
			array(
				'label'              => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'px'                 => array(
					'range' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 0.1,
					),
				),
				'default'            => array(
					'size' => 1,
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_general_pages_nav_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'page_nav_wrap_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'page_nav_wrap_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'page_nav_wrap_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav',
			)
		);

		$this->add_responsive_control(
			'page_nav_wrap_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'page_nav_wrap_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'page_nav_wrap_margin',
			array(
				'label'      => esc_html__( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_pages_nav_item_style',
			array(
				'label' => __( 'Item', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'pages_nav_item_size',
			array(
				'label'      => esc_html__( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-anchor' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pages_nav_item_gap',
			array(
				'label'      => esc_html__( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'one_pages_nav_item' );

		$this->start_controls_tab(
			'pages_nav_item_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pages_nav_item_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pages_nav_item_normal_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-anchor',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pages_nav_item_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pages_nav_item_hv_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav-anchor:hover .xpro-one-page-nav-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pages_nav_item_hv_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-anchor:hover',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pages_nav_item_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pages_nav_item_active_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav > li > .xpro-one-page-nav-anchor.active .xpro-one-page-nav-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pages_nav_item_active_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav > li > .xpro-one-page-nav-anchor.active',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pages_nav_item_border',
				'label'     => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-one-page-nav-anchor',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pages_nav_item_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-anchor',
			)
		);

		$this->add_control(
			'pages_nav_item_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-anchor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pages_nav_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-anchor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pages_nav_item_options',
			array(
				'label'     => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'pages_nav_item_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-one-page-nav-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_page_nav_tooltip_settings',
			array(
				'label' => __( 'Tooltip', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'pages_nav_item_tooltip_width',
			array(
				'label'      => esc_html__( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pages_nav_tooltip_typography',
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-tooltip',
			)
		);

		$this->add_control(
			'pages_nav_tooltip_color',
			array(
				'label'     => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-one-page-nav-tooltip' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pages_nav_tooltip_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-tooltip, {{WRAPPER}} .xpro-one-page-nav-tooltip:after',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pages_nav_tooltip_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-tooltip',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pages_nav_tooltip_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-one-page-nav-tooltip',
			)
		);

		$this->add_control(
			'pages_nav_tooltip_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pages_nav_tooltip_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-one-page-nav-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'one-page-navigation/layout/frontend.php';

	}

}
