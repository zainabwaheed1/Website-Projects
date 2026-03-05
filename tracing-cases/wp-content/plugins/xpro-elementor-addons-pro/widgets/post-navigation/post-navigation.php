<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


class Post_Navigation extends Widget_Base {

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
		return 'xpro-post-navigation';
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
		return __( 'Post Navigation', 'xpro-elementor-addons-pro' );
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
		return array( 'xpro-themer' );
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
		return array( 'post', 'navigation', 'menu', 'links' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_post_navigation_content',
			array(
				'label' => __( 'Post Navigation', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_label',
			array(
				'label'     => __( 'Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off' => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'prev_label',
			array(
				'label'     => __( 'Previous Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Prev', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'next_label',
			array(
				'label'     => __( 'Next Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Next', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_arrow',
			array(
				'label'     => __( 'Arrows', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off' => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'arrow',
			array(
				'label'     => __( 'Arrows Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'fas fa-arrow-left'          => __( 'Arrow', 'xpro-elementor-addons-pro' ),
					'fas fa-angle-left'          => __( 'Angle', 'xpro-elementor-addons-pro' ),
					'fas fa-angle-double-left'   => __( 'Double Angle', 'xpro-elementor-addons-pro' ),
					'fas fa-chevron-left'        => __( 'Chevron', 'xpro-elementor-addons-pro' ),
					'fas fa-chevron-circle-left' => __( 'Chevron Circle', 'xpro-elementor-addons-pro' ),
					'fas fa-caret-left'          => __( 'Caret', 'xpro-elementor-addons-pro' ),
					'xi xi-long-arrow-left'      => __( 'Long Arrow', 'xpro-elementor-addons-pro' ),
					'fas fa-arrow-circle-left'   => __( 'Arrow Circle', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'fas fa-arrow-left',
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_title',
			array(
				'label'     => __( 'Post Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off' => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'show_separator',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off' => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'default'   => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'label_style',
			array(
				'label'     => __( 'Label', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} span.xpro-elementor-post-navigation-prev-label, {{WRAPPER}} span.xpro-elementor-post-navigation-next-label',
			)
		);

		$this->start_controls_tabs( 'tabs_label_style' );

		$this->start_controls_tab(
			'label_color_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-prev-label' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-post-navigation-next-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'label_color_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'label_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-link > a:hover .xpro-elementor-post-navigation-prev-label' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-post-navigation-link > a:hover .xpro-elementor-post-navigation-next-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_post_navigation_style' );

		$this->start_controls_tab(
			'tab_color_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.xpro-elementor-post-navigation-prev-title, {{WRAPPER}} span.xpro-elementor-post-navigation-next-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-link > a:hover .xpro-elementor-post-navigation-prev-title, {{WRAPPER}} .xpro-elementor-post-navigation-link > a:hover .xpro-elementor-post-navigation-next-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .xpro-elementor-post-navigation-prev-title, {{WRAPPER}} span.xpro-elementor-post-navigation-next-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_style',
			array(
				'label'     => __( 'Arrow', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_post_navigation_arrow_style' );

		$this->start_controls_tab(
			'arrow_color_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-arrow-wrapper' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_color_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-link > a:hover .xpro-elementor-post-navigation-arrow-wrapper' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-arrow-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrow_padding',
			array(
				'label'     => __( 'Gap', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .xpro-elementor-post-navigation-arrow-prev' => 'padding-right: {{SIZE}}{{UNIT}};',
					'body:not(.rtl) {{WRAPPER}} .xpro-elementor-post-navigation-arrow-next' => 'padding-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .xpro-elementor-post-navigation-arrow-prev'       => 'padding-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .xpro-elementor-post-navigation-arrow-next'       => 'padding-right: {{SIZE}}{{UNIT}};',
				),
				'range'     => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'separator_section_style',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_separator!' => '',
				),
			)
		);

		$this->add_control(
			'sep_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-separator' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-post-navigation'           => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'separator_width',
			array(
				'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-navigation-separator'                                => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .xpro-elementor-post-navigation'                                          => 'border-top-width: {{SIZE}}{{UNIT}}; border-bottom-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-post-navigation-next.xpro-elementor-post-navigation-link' => 'width: calc(50% - ({{SIZE}}{{UNIT}} / 2))',
					'{{WRAPPER}} .xpro-elementor-post-navigation-prev.xpro-elementor-post-navigation-link' => 'width: calc(50% - ({{SIZE}}{{UNIT}} / 2))',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'post-navigation/layout/frontend.php';

	}
}
