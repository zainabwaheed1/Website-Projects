<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;
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
class Breadcrumb extends Widget_Base {

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
		return 'xpro-elementor-breadcrumb';
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
		return __( 'Breadcrumb', 'xpro-elementor-addons-pro' );
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
		return 'xi-breadcrumbs xpro-widget-pro-label';
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
		return array( 'breadcrumb', 'breadcrumbs', 'crumb', 'crumbs' );
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
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'home',
			array(
				'label'   => __( 'Home', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Home', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active'     => true,
					'categories' => array( TagsModule::POST_META_CATEGORY ),
				),
			)
		);

		$this->add_control(
			'blog',
			array(
				'label'   => __( 'Blog', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Blog', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active'     => true,
					'categories' => array( TagsModule::POST_META_CATEGORY ),
				),
			)
		);

		$this->add_control(
			'search',
			array(
				'label'   => __( 'Search', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Search ', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active'     => true,
					'categories' => array( TagsModule::POST_META_CATEGORY ),
				),
			)
		);

		$this->add_control(
			'date',
			array(
				'label'   => __( 'Date', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Blogs For', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active'     => true,
					'categories' => array( TagsModule::POST_META_CATEGORY ),
				),
			)
		);

		$this->add_control(
			'error_404',
			array(
				'label'   => __( 'Error 404', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Not Found', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active'     => true,
					'categories' => array( TagsModule::POST_META_CATEGORY ),
				),
			)
		);

		$this->add_control(
			'home_icon',
			array(
				'label'                  => __( 'Home Icon', 'xpro-elementor-addons-pro' ),
				'label_block'            => false,
				'type'                   => Controls_Manager::ICONS,
				'separator'              => 'before',
				'default'                => array(
					'value'   => 'fas fa-home',
					'library' => 'fa-solid',
				),
				'skin'                   => 'inline',
				'exclude_inline_options' => array( 'svg' ),
			)
		);

		$this->add_control(
			'max_word_length',
			array(
				'label'   => __( 'Title Length', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 5,
				'max'     => 100,
				'step'    => 1,
				'default' => 15,
			)
		);

		$this->add_control(
			'separator_icon',
			array(
				'label'                  => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'label_block'            => false,
				'type'                   => Controls_Manager::ICONS,
				'default'                => array(
					'value'   => 'fas fa-angle-right',
					'library' => 'fa-solid',
				),
				'skin'                   => 'inline',
				'exclude_inline_options' => array( 'svg' ),
			)
		);

		$this->add_control(
			'show_trail',
			array(
				'label'        => __( 'Show Category Trail', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'hide_on_front_page',
			array(
				'label'        => __( 'Hide On Front Page', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-breadcrumb-wrapper' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a',
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'item_style_tabs'
		);

		$this->start_controls_tab(
			'item_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'item_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'item_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'item_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li:hover > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li:hover > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li:hover > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li:hover > a',
			)
		);

		$this->add_control(
			'item_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li:hover > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li:hover > a' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a',
			)
		);

		$this->add_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li > span,{{WRAPPER}} .xpro-elementor-breadcrumb > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Home
		$this->start_controls_section(
			'section_home_style',
			array(
				'label' => __( 'Previous', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'home_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a',
			)
		);

		$this->add_responsive_control(
			'home_space_between',
			array(
				'label'      => __( 'Icon Space', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'home_style_tabs'
		);

		$this->start_controls_tab(
			'home_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'home_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'home_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'home_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'home_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home:hover > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'home_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home:hover > a',
			)
		);

		$this->add_control(
			'home_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home:hover > a' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'home_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'home_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a',
			)
		);

		$this->add_control(
			'home_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'home_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-home > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Current
		$this->start_controls_section(
			'section_current_style',
			array(
				'label' => __( 'Current', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'current_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-breadcrumb-wrapper .xpro-elementor-breadcrumb > li > span',
			)
		);

		$this->add_control(
			'current_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-breadcrumb-wrapper .xpro-elementor-breadcrumb > li > span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'current_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-breadcrumb-wrapper .xpro-elementor-breadcrumb > li > span',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'current_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-breadcrumb-wrapper .xpro-elementor-breadcrumb > li > span',
			)
		);

		$this->add_control(
			'current_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-breadcrumb-wrapper .xpro-elementor-breadcrumb > li > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'current_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-breadcrumb-wrapper .xpro-elementor-breadcrumb > li > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Separator
		$this->start_controls_section(
			'section_separator_style',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'separator_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'separator_space_between',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'separator_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'separator_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'separator_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator',
			)
		);

		$this->add_control(
			'separator_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-breadcrumb > li.xpro-elementor-breadcrumb-separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		if ( 'yes' === $settings['hide_on_front_page'] && is_front_page() ) {
			return;
		}

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'breadcrumb/layout/frontend.php';

	}

	/**
	 * get breadcrumb widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 * @access protected
	 */

	private function get_breadcrumb_markup( $post_id, $max_len = 15, $trail = false ) {

		$settings = $this->get_settings_for_display();

		$list = '<ul class="xpro-elementor-breadcrumb">';

		$sep = ( $settings['separator_icon']['value'] ) ? '<li class="xpro-elementor-breadcrumb-separator"><i class="' . $settings['separator_icon']['value'] . '" aria-hidden="true"></i></li>' : '';

		if ( ! is_home() || ! is_front_page() ) {

			$list .= '<li class="xpro-elementor-breadcrumb-home"><a href="' . get_home_url( '/' ) . '">' . ( ( $settings['separator_icon']['value'] ) ? '<i class="' . $settings['home_icon']['value'] . '" aria-hidden="true"></i>' : '' ) . $settings['home'] . '</a></li>';

			if ( is_single() ) {

				$category = get_the_category();

				if ( ! empty( $category ) ) {

					$cat         = $category[0];
					$term_parent = $cat->parent;
					$taxonomy    = $cat->taxonomy;
					$p_trail     = '';

					if ( true === $trail ) {

						if ( 0 !== $term_parent ) {

							while ( $term_parent ) {

								$term        = get_term( $term_parent, $taxonomy );
								$term_parent = $term->parent;

								$p_trail = $sep . '<li class="xpro-elementor-breadcrumb-item-parent"><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>' . $p_trail;
							}
						}

						$list .= $p_trail . $sep . '<li class="xpro-elementor-breadcrumb-item-category"><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a></li>';
					}
				} else {

					$p_type    = get_post_type( $post_id );
					$post_type = get_post_type_object( $p_type );

					if ( ! empty( $post_type->labels->singular_name ) && ! in_array(
						$post_type->name,
						array( 'post', 'page' ),
						true
					) ) {

						$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-archive"><a href="' . get_post_type_archive_link( $p_type ) . '">' . $post_type->labels->singular_name . '</a></li>';

					}
				}

				if ( is_single() ) {

					$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-single"><span class="xpro-elementor-breadcrumb-text">' . wp_trim_words( get_the_title(), $max_len ) . '</span></li>';
				}
			} elseif ( is_page() ) {

				$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-page"><span class="xpro-elementor-breadcrumb-text">' . wp_trim_words( get_the_title(), $max_len ) . '</span></li>';
			}
		}

		if ( is_tag() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-tag"><span class="xpro-elementor-breadcrumb-text">' . single_tag_title( '', false ) . '</span></li>';

		} elseif ( is_category() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-category"><span class="xpro-elementor-breadcrumb-text">' . single_tag_title( '', false ) . '</span></li>';

		} elseif ( is_day() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-day"><span class="xpro-elementor-breadcrumb-text">' . $settings['date'] . ' ' . get_the_time( 'F jS, Y', $post_id ) . '</span></li>';

		} elseif ( is_month() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-month"><span class="xpro-elementor-breadcrumb-text">' . $settings['date'] . ' ' . get_the_time( 'F, Y', $post_id ) . '</span></li>';

		} elseif ( is_year() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-year"><span class="xpro-elementor-breadcrumb-text">' . $settings['date'] . ' ' . get_the_time( 'Y', $post_id ) . '</span></li>';

		} elseif ( is_author() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-author"><span class="xpro-elementor-breadcrumb-text">' . get_the_author() . '</span></li>';

		} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-blog"><span class="xpro-elementor-breadcrumb-text">' . $settings['blog'] . '</span></li>';

		} elseif ( is_search() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-search"><span class="xpro-elementor-breadcrumb-text">' . $settings['search'] . get_search_query() . '</span></li>';

		} elseif ( is_404() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-404"><span class="xpro-elementor-breadcrumb-text">' . $settings['error_404'] . '</span></li>';
		} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-woo"><span class="xpro-elementor-breadcrumb-text">' . woocommerce_page_title( false ) . '</span></li>';
		} elseif ( is_home() ) {

			$list .= $sep . '<li class="xpro-elementor-breadcrumb-item-home"><span class="xpro-elementor-breadcrumb-text">' . $settings['blog'] . '</span></li>';
		}

		$list .= '</ul>';

		return $list;
	}
}
