<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
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
class List_Portfolio extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-list-portfolio';
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
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'List Portfolio', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-list-portfolio xpro-widget-pro-label';
	}

	/**
	 * Retrieve the widget keywords.
	 *
	 * @return string[] Widget keywords.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_keywords() {
		return array( 'list', 'portfolio', 'preview', 'popup' );
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_categories() {
		return array( 'xpro-widgets-pro' );
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_script_depends() {
		return array( 'gsap' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 0.1.8
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_carousel_gallery',
			array(
				'label' => __( 'Portfolio', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Featured Image', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'title_text',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Type portfolio item title.', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'preview_link',
			array(
				'label'       => __( 'Preview Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'url',
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'portfolio',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
				/* translators: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{title_text}}'
				),
				'default'     => array(
					array(
						'title_text' => __( 'Portfolio Title 1', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title_text' => __( 'Portfolio Title 2', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label'      => __( 'Item Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 300,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 800,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-list-portfolio-half,{{WRAPPER}} .xpro-list-portfolio-full' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Popup Tab
		$this->start_controls_section(
			'section_preview',
			array(
				'label' => __( 'Preview', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'preview_type',
			array(
				'label'              => __( 'Preview Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'popup' => __( 'Popup', 'xpro-elementor-addons-pro' ),
					'link'  => __( 'External Link', 'xpro-elementor-addons-pro' ),
					'none'  => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'popup_layout',
			array(
				'label'              => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'layout-1',
				'options'            => array(
					'layout-1'  => __( 'Layout 1', 'xpro-elementor-addons-pro' ),
					'layout-2'  => __( 'Layout 2', 'xpro-elementor-addons-pro' ),
					'layout-3'  => __( 'Layout 3', 'xpro-elementor-addons-pro' ),
					'layout-4'  => __( 'Layout 4', 'xpro-elementor-addons-pro' ),
					'layout-5'  => __( 'Layout 5', 'xpro-elementor-addons-pro' ),
					'layout-6'  => __( 'Layout 6', 'xpro-elementor-addons-pro' ),
					'layout-7'  => __( 'Layout 7', 'xpro-elementor-addons-pro' ),
					'layout-8'  => __( 'Layout 8', 'xpro-elementor-addons-pro' ),
					'layout-9'  => __( 'Layout 9', 'xpro-elementor-addons-pro' ),
					'layout-10' => __( 'Layout 10', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'preview_type' => 'popup',
				),
			)
		);

		$this->add_control(
			'popup_animation',
			array(
				'label'              => __( 'Popup Animation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1' => __( 'Slice Left', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Slice Right', 'xpro-elementor-addons-pro' ),
					'3' => __( 'Slot Top', 'xpro-elementor-addons-pro' ),
					'4' => __( 'Slot Bottom', 'xpro-elementor-addons-pro' ),
					'5' => __( 'Reveal Left', 'xpro-elementor-addons-pro' ),
					'6' => __( 'Reveal Right', 'xpro-elementor-addons-pro' ),
					'7' => __( 'Reveal Top', 'xpro-elementor-addons-pro' ),
					'8' => __( 'Reveal Bottom', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'preview_type' => 'popup',
				),
			)
		);

		$this->add_control(
			'preview_target',
			array(
				'label'              => __( 'Preview Type', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Specifies where to open the linked document.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '_blank',
				'options'            => array(
					'_blank' => __( 'Blank', 'xpro-elementor-addons-pro' ),
					'_self'  => __( 'Self', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'preview_type' => 'link',
				),
			)
		);

		$this->end_controls_section();

		//Style Tab
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-list-portfolio-items li,{{WRAPPER}} .xpro-list-portfolio-items li::before',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-list-portfolio-items li' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hcolor',
			array(
				'label'     => __( 'Hover/Active Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-list-portfolio-items li.active,{{WRAPPER}} .xpro-list-portfolio-items li:after' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'misc_overlay',
			array(
				'label'     => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-list-portfolio-full::after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => '2',
				),
			)
		);

		$this->add_responsive_control(
			'title_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-list-portfolio-items li, {{WRAPPER}} .xpro-list-portfolio-items li:after' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				),

			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Wrapper Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-list-portfolio-half .xpro-list-portfolio-menu-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_preview_style',
			array(
				'label'     => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'preview_type' => 'popup',
				),
			)
		);

		$this->add_control(
			'preview_overlay',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-portfolio-loader li' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_background',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_background_separator',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview .xpro-preview-header, .xpro-preview-arrow,{{WRAPPER}} .xpro-preview-demo-name,{{WRAPPER}} .xpro-preview-close' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_heading',
			array(
				'label'     => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'preview_close_style_tabs'
		);

		$this->start_controls_tab(
			'preview_close_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_close_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_border',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'preview_close_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_close_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'preview_nav_heading',
			array(
				'label'     => __( 'Next/Prev Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'preview_nav_style_tabs'
		);

		$this->start_controls_tab(
			'preview_nav_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_nav_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_border',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'preview_nav_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_nav_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo:hover,{{WRAPPER}} .xpro-preview-next-demo:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo:hover,{{WRAPPER}} .xpro-preview-next-demo:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo:hover,{{WRAPPER}} .xpro-preview-next-demo:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'preview_nav_typography',
				'label'    => __( 'Next/Prev Typo', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo',
			)
		);

		$this->add_control(
			'preview_title_heading',
			array(
				'label'     => __( 'Preview Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'preview_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-demo-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'preview_title_typography',
				'label'    => __( 'Title Typo', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-preview-demo-name',
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'list-portfolio/layout/frontend.php';

	}
}
