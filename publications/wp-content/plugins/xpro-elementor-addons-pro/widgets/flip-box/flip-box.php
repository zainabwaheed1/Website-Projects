<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
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
class Flip_Box extends Widget_Base {

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
		return 'xpro-flip-box';
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
		return __( 'Flip Box', 'xpro-elementor-addons-pro' );
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
		return 'xi-flip-box xpro-widget-pro-label';
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
		return array( 'flip', 'box' );
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

		//General
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'flip_animation_style',
			array(
				'label'   => __( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'up',
				'options' => array(
					'up'       => __( 'Flip Up', 'xpro-elementor-addons-pro' ),
					'down'     => __( 'Flip Down', 'xpro-elementor-addons-pro' ),
					'left'     => __( 'Flip Left', 'xpro-elementor-addons-pro' ),
					'right'    => __( 'Flip Right', 'xpro-elementor-addons-pro' ),
					'zoom-in'  => __( 'Zoom In', 'xpro-elementor-addons-pro' ),
					'zoom-out' => __( 'Zoom Out', 'xpro-elementor-addons-pro' ),
					'skewUp'   => __( 'Skew Up', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'3d_depth',
			array(
				'label'        => __( '3d Depth', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => array(
					'flip_animation_style' => array( 'left', 'right', 'up', 'down' ),
				),
			)
		);

		$this->add_responsive_control(
			'height',
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
				'default'    => array(
					'unit' => 'px',
					'size' => 300,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Front Side
		$this->start_controls_section(
			'section_front_side',
			array(
				'label' => __( 'Front Side', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'front_media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'icon'  => array(
						'title' => __( 'Icon', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-star',
					),
					'image' => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$this->add_control(
			'front_icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-home',
					'library' => 'solid',
				),
				'condition' => array(
					'front_media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'front_image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'front_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'front_media_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'front_media_type' => 'image',
				),
			)
		);

		$this->add_control(
			'front_title',
			array(
				'label'   => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Flip Front', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'front_badge_text',
			array(
				'label'       => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '01', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'front_description',
			array(
				'label'       => esc_html__( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'Front Side Content', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'front_separator',
			array(
				'label'        => __( 'Show Separator', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		// Back Side
		$this->start_controls_section(
			'section_back_slide',
			array(
				'label' => __( 'Back Slide', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'back_media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'icon'  => array(
						'title' => __( 'Icon', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-star',
					),
					'image' => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$this->add_control(
			'back_icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-shield-alt',
					'library' => 'solid',
				),
				'condition' => array(
					'back_media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'back_image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'back_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'back_media_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'back_media_type' => 'image',
				),
			)
		);

		$this->add_control(
			'back_title',
			array(
				'label'   => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Flip Back', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'back_btn',
			array(
				'label'        => __( 'Show Button', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'back_btn_text',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Get Started', 'xpro-elementor-addons-pro' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'back_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			'back_btn_link',
			array(
				'label'         => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://wpxpro.com', 'xpro-elementor-addons-pro' ),
				'show_external' => true,
				'separator'     => 'after',
				'default'       => array(
					'url'         => '#.',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'back_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			'back_description',
			array(
				'label'       => esc_html__( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'Back Side Content', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'back_separator',
			array(
				'label'        => __( 'Show Separator', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_front_side_style',
			array(
				'label' => __( 'Front Side', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'front_align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'options'      => array(
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
				'prefix_class' => 'xpro-content-align%s',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-wrap-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'front_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-front',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'front_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-front',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'front_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-front',
			)
		);

		$this->add_responsive_control(
			'front_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'front_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-wrap-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'front_title_line',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'front_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-front .xpro-flip-title',
			)
		);

		$this->add_control(
			'front_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'front_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'front_description_line',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'front_description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-front .xpro-flip-text, {{WRAPPER}} .xpro-flip-box-front .xpro-flip-text > *',
			)
		);

		$this->add_control(
			'front_description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-text, {{WRAPPER}} .xpro-flip-box-front .xpro-flip-text > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'front_description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'front_separator_line',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'front_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'front_separator_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'before' => __( 'Before Title', 'xpro-elementor-addons-pro' ),
					'after'  => __( 'After Title', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'front_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'front_separator_width_size',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-separator' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'front_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'front_separator_height_size',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
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
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-separator' => 'Height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'front_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'front_separator_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-separator' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'front_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'front_separator_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'front_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'front_badge_line',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_control(
			'front_badge_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'top-left'      => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center'    => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'     => __( 'Top Right', 'xpro-elementor-addons-pro' ),
					'middle-left'   => __( 'Middle Left', 'xpro-elementor-addons-pro' ),
					'middle-center' => __( 'Middle Center', 'xpro-elementor-addons-pro' ),
					'middle-right'  => __( 'Middle Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => __( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-center' => __( 'Bottom Center', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => __( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'front_badge_text!' => '',
				),
				'default'   => 'top-left',
			)
		);

		$this->add_control(
			'front_badge_offset_toggle',
			array(
				'label'        => __( 'Offset', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'front_badge_offset_x',
			array(
				'label'      => __( 'Offset Left', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-badge' => '--xpro-badge-translate-x: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'front_badge_text!'         => '',
					'front_badge_offset_toggle' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'front_badge_offset_y',
			array(
				'label'      => __( 'Offset Top', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-badge' => '--xpro-badge-translate-y: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'front_badge_text!'         => '',
					'front_badge_offset_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'front_badge_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge',
				'condition' => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_control(
			'front_badge_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_control(
			'front_badge_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'front_badge_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge',
				'condition' => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_control(
			'front_badge_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'front_badge_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'front_badge_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-box-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'front_badge_text!' => '',
				),
			)
		);

		$this->add_control(
			'front_media_line',
			array(
				'label'     => __( 'Media', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'front_media_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => '80',
                ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
				),
			)
		);

		$this->add_responsive_control(
			'front_media_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'front_media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'front_media_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image > svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'front_media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'front_media_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'front_media_type' => 'icon',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'front_media_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image > i',
				'condition' => array(
					'front_media_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'front_media_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'front_media_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'front_media_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-front .xpro-flip-icon-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_back_side_style',
			array(
				'label' => __( 'Back Side', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'back_align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'options'      => array(
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
				'prefix_class' => 'xpro-content-align%s',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-box-wrap-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'back_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-back',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'back_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-back',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'back_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-back',
			)
		);

		$this->add_responsive_control(
			'back_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'back_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-box-wrap-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back_title_line',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'back_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-back .xpro-flip-title',
			)
		);

		$this->add_control(
			'back_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'back_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back_description_line',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'back_description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-back .xpro-flip-text, {{WRAPPER}} .xpro-flip-box-back .xpro-flip-text > *',
			)
		);

		$this->add_control(
			'back_description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-text, {{WRAPPER}} .xpro-flip-box-back .xpro-flip-text > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'back_description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back_separator_line',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'back_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'back_separator_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'before' => __( 'Before Title', 'xpro-elementor-addons-pro' ),
					'after'  => __( 'After Title', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'back_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'back_separator_width_size',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-box-separator' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'back_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'back_separator_height_size',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
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
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-box-separator' => 'Height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'back_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'back_separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-box-separator' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'back_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'back_separator_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-box-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'back_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'back_media_line',
			array(
				'label'     => __( 'Media', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'back_media_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => '80',
                ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
				),
			)
		);

		$this->add_responsive_control(
			'back_media_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'back_media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'back_media_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image > svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'back_media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'back_media_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'back_media_type' => 'icon',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'back_media_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image > i',
				'condition' => array(
					'back_media_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'back_media_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'back_media_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'back_media_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-back .xpro-flip-icon-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'back_btn' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-btn',
			)
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-btn:hover,{{WRAPPER}} .xpro-flip-box-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-flip-box-btn:hover,{{WRAPPER}} .xpro-flip-box-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-flip-box-btn:hover,{{WRAPPER}} .xpro-flip-box-btn:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-box-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'flip-box/layout/frontend.php';

	}

}
