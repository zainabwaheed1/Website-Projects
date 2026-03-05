<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
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
class Textual_Showcase extends Widget_Base {

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
		return 'xpro-textual-showcase';
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
		return __( 'Textual Showcase', 'xpro-elementor-addons-pro' );
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
		return 'xi-filter-2 xpro-widget-pro-label';
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
		return array( 'textual-showcase', 'text', 'image' );
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
			'section_general_image_marquee',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => esc_html__( 'Text', 'xpro-elementor-addons-pro' ),
					'image' => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'textual_text',
			array(
				'label'       => esc_html__( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Title Text', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your title here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'layout' => 'text',
				),
			)
		);

		$repeater->start_controls_tabs( 'textual_tab_style' );

		$repeater->start_controls_tab(
			'textual_tab_normal',
			array(
				'label'     => __( 'Normal', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_control(
			'textual_normal_image',
			array(
				'label'     => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_responsive_control(
			'text_textual_custom_image_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-item {{CURRENT_ITEM}}.xpro-textual-showcase-img' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_responsive_control(
			'text_textual_custom_image_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-item {{CURRENT_ITEM}}.xpro-textual-showcase-img' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_responsive_control(
			'text_textual_custom_image_rotate',
			array(
				'label'      => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-textual-showcase-img-normal > img' => 'transform: rotate({{SIZE}}deg);',
				),
				'condition'  => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_control(
			'text_textual_custom_image_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-textual-showcase-img-normal > img' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'text_textual_custom_css_filters',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .xpro-textual-showcase-img-normal > img',
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'textual_tab_hover',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_control(
			'textual_hover_image',
			array(
				'label'     => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_responsive_control(
			'text_textual_custom_hover_image_rotate',
			array(
				'label'      => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-textual-showcase-img-hover > img' => 'transform: rotate({{SIZE}}deg);',
				),
				'condition'  => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_control(
			'text_textual_custom_hover_image_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-textual-showcase-img-hover > img' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'text_textual_custom_hover_css_filters',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .xpro-textual-showcase-img-hover > img',
				'condition' => array(
					'layout' => 'image',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$repeater->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'      => 'text_textual_shadow_custom_text_gradient',
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .xpro-textual-showcase-item {{CURRENT_ITEM}}',
				'condition' => array(
					'layout' => 'text',
				),
			)
		);

		$this->add_control(
			'textual_item',
			array(
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'show_label'         => false,
				'title_field'        => __( 'Item', 'xpro-elementor-addons-pro' ),
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => array(
					array(
						'layout'       => 'text',
						'textual_text' => __( 'Create', 'xpro-elementor-addons-pro' ),
					),
					array(
						'layout' => 'image',
					),
					array(
						'layout'       => 'text',
						'textual_text' => __( 'Your on', 'xpro-elementor-addons-pro' ),
					),
					array(
						'layout' => 'image',
					),
					array(
						'layout'       => 'text',
						'textual_text' => __( 'Text', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'textual_media_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
			)
		);

		$this->add_responsive_control(
			'textual_alignment',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'separator' => 'before',
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-textual-showcase-item' => 'justify-content: {{VALUE}};',
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
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-item' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text_textual',
			array(
				'label' => __( 'Text', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_textual_typography',
				'selector' => '{{WRAPPER}} .xpro-textual-showcase-txt',
			)
		);

		$this->add_control(
			'text_textual_outline',
			array(
				'label'        => __( 'Outline Text', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'text_textual_outline_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E9E9E9',
				'selectors' => array(
					'{{WRAPPER}} .xpro-textual-showcase-txt' => '-webkit-text-fill-color: transparent; -webkit-text-stroke-width: 1px; -webkit-text-stroke-color: {{VALUE}}; color: {{VALUE}}',
				),
				'condition' => array(
					'text_textual_outline' => 'yes',
				),
			)
		);

		$this->add_control(
			'text_textual_outline_width',
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
					'{{WRAPPER}} .xpro-textual-showcase-txt' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'text_textual_outline' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'      => 'text_textual_shadow_text_gradient',
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .xpro-textual-showcase-txt',
				'condition' => array(
					'text_textual_outline!' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image_textual',
			array(
				'label' => __( 'Image', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'text_textual_image_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_textual_image_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_textual_image_object_fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => array(
					'none'    => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
					'fill'    => esc_html__( 'Fill', 'xpro-elementor-addons-pro' ),
					'contain' => esc_html__( 'Contain', 'xpro-elementor-addons-pro' ),
					'cover'   => esc_html__( 'Cover', 'xpro-elementor-addons-pro' ),

				),
				'condition' => array(
					'text_textual_image_height[size]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img,
					{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'textual_image_tab_style' );

		$this->start_controls_tab(
			'textual_image_tab_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_responsive_control(
			'text_textual_image_rotate',
			array(
				'label'      => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img' => 'transform: rotate({{SIZE}}deg);',
				),
			)
		);

		$this->add_control(
			'text_textual_image_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'text_textual_css_filters',
				'selector' => '{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'textual_image_tab_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_responsive_control(
			'text_textual_hover_image_rotate',
			array(
				'label'      => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img' => 'transform: rotate({{SIZE}}deg);',
				),
			)
		);

		$this->add_control(
			'text_textual_hover_image_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'text_textual_hover_css_filters',
				'selector' => '{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img > img',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ext_textual_border',
				'separator' => 'before',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img, {{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img',
			)
		);

		$this->add_responsive_control(
			'text_textual_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img,
					{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'text_textual_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-normal > img, {{WRAPPER}} .xpro-textual-showcase-img .xpro-textual-showcase-img-hover > img',
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
		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'textual-showcase/layout/frontend.php';

	}

}
