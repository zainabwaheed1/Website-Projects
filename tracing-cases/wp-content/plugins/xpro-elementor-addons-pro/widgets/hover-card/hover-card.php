<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Group_Control_Foreground;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Box_Shadow;
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
class Hover_Card extends Widget_Base {

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
		return 'xpro-hover-card';
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
		return __( 'Hover Card', 'xpro-elementor-addons-pro' );
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
		return 'xi-hover-card xpro-widget-pro-label';
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
		return array( 'hover', 'box', 'animate', 'card' );
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
				),
				'frontend_available' => true,
				'prefix_class'       => 'xpro-hover-card-layout-',
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
			)
		);

		$this->add_control(
			'sub_title',
			array(
				'label'       => __( 'Sub Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Sub Heading', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Sub title here', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'sub_title_tag',
			array(
				'label'     => esc_html__( 'Sub Title HTML Tag', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'default'   => 'h4',
				'condition' => array(
					'sub_title!' => '',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Hover Card Module', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Title here', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'     => esc_html__( 'Title HTML Tag', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'default'   => 'h2',
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'separator'   => 'before',
				'default'     => __( 'It is a long established fact that a reader will be distracted.', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'counter',
			array(
				'label'     => __( 'Counter', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( '01', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'layout' => array( '1', '2', '3', '14' ),
				),
			)
		);

		$this->end_controls_section();

		//Button
		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_button',
			array(
				'label'        => __( 'Show', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		// Update for button_title control
		$this->add_control(
			'button_title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => __( 'Get Started', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Get Started', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		// Update for link control
		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		// Update for align control
		$this->add_responsive_control(
			'align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => __( 'Left', 'xpro-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'xpro-elementor-addons' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'xpro-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'xpro-elementor-addons' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'condition'    => array(
					'show_button' => 'yes',
				),
			)
		);

		// Update for icon control
		$this->add_control(
			'icon',
			array(
				'label'       => __( 'Icon', 'xpro-elementor-addons' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		// Update for icon_align control
		$this->add_control(
			'icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons' ),
					'right' => __( 'After', 'xpro-elementor-addons' ),
				),
				'condition' => array(
					'show_button' => 'yes',
					'icon[value]!' => '',
				),
			)
		);

		// Update for icon_indent control
		$this->add_responsive_control(
			'icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-align-icon-right .xpro-elementor-button-media' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-align-icon-left .xpro-elementor-button-media'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'show_button' => 'yes',
					'icon[value]!' => '',
				),
			)
		);

		// Update for button_css_id control
		$this->add_control(
			'button_css_id',
			array(
				'label'       => __( 'Button ID', 'xpro-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'xpro-elementor-addons' ),
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'xpro-elementor-addons' ),
				'separator'   => 'before',
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		// Update for onclick_event control
		$this->add_control(
			'onclick_event',
			array(
				'label'       => esc_html__( 'onClick Event', 'xpro-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'myFunction()',
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		
		$this->end_controls_section();

		//General Style
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'box_align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
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
				'prefix_class' => 'xpro-content-align-',
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'default'    => array(
					'size' => 700,
				),
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-wrapper .xpro-hover-card-image' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'overlay_style_tabs'
		);

		$this->start_controls_tab(
			'overlay_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'overlay_bg',
			array(
				'label'     => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-hover-card-content-wrapper' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout!' => array( '11', '12', '13', '14' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .xpro-hover-card-wrapper .xpro-hover-card-image > img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'overlay_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'overlay_hbg',
			array(
				'label'     => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-hover-card-content-wrapper' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout!' => array( '11', '12', '13', '14' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_on_hover',
				'selector' => '{{WRAPPER}}:hover .xpro-hover-card-wrapper .xpro-hover-card-image > img',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'content_bg',
			array(
				'label'     => __( 'Content Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .xpro-hover-card-content' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-hover-card-layout-5 .xpro-hover-card-content:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.xpro-hover-card-layout-11 .xpro-hover-card-content-wrapper,
					 {{WRAPPER}}.xpro-hover-card-layout-12 .xpro-hover-card-content-wrapper,
					 {{WRAPPER}}.xpro-hover-card-layout-13 .xpro-hover-card-content-wrapper,
					 {{WRAPPER}}.xpro-hover-card-layout-14 .xpro-hover-card-content-wrapper' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}.xpro-hover-card-layout-11 .xpro-hover-card-content-wrapper,
					 {{WRAPPER}}.xpro-hover-card-layout-12 .xpro-hover-card-content-wrapper,
					 {{WRAPPER}}.xpro-hover-card-layout-13 .xpro-hover-card-content-wrapper,
					 {{WRAPPER}}.xpro-hover-card-layout-14 .xpro-hover-card-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '11', '12', '13', '14' ),
				),
			)
		);

		$this->end_controls_section();

		//Counter
		$this->start_controls_section(
			'section_style_counter',
			array(
				'label'     => __( 'Counter', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout'   => array( '1', '2', '3', '14' ),
					'counter!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'counter_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-counter',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'counter_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-counter',
			)
		);

		$this->add_control(
			'counter_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-hover-card-counter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'counter_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//SubTitle
		$this->start_controls_section(
			'section_style_subtitle',
			array(
				'label'     => __( 'Sub Title', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sub_title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-sub-title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'subtitle_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-sub-title',
			)
		);

		$this->add_control(
			'subtitle_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-hover-card-sub-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'subtitle_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Title Style
		$this->start_controls_section(
			'section_style_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-title',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'title_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Description
		$this->start_controls_section(
			'section_style_description',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-description,{{WRAPPER}} .xpro-hover-card-description > *',
			)
		);

		$this->add_responsive_control(
			'description_width',
			array(
				'label'      => esc_html__( ' Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 500,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-description' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'description_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-hover-card-description',
			)
		);

		$this->add_control(
			'description_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-hover-card-description,{{WRAPPER}} .xpro-hover-card-description > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-hover-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// start button control for style
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'button_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 800,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card' => 'width: {{SIZE}}{{UNIT}}; max-width:100%;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-w-hover-card .xpro-button-text',
			)
		);

		// $this->add_group_control(
		// 	Group_Control_Text_Shadow::get_type(),
		// 	array(
		// 		'name'     => 'text_shadow',
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button-w-hover-card .xpro-button-text',
		// 	)
		// );

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons' ),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card svg' => 'color: {{VALUE}};',
				),
			)
		);

		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	array(
		// 		'name'     => 'background',
		// 		'label'    => __( 'Background', 'xpro-elementor-addons' ),
		// 		'types'    => array( 'classic', 'gradient' ),
		// 		'exclude'  => array( 'image' ),
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button-w-hover-card,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill:before,
		// 						{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide::before',
		// 	)
		// );

		// $this->add_group_control(
		// 	Group_Control_Box_Shadow::get_type(),
		// 	array(
		// 		'name'     => 'button_box_shadow',
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button',
		// 	)
		// );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card:hover, {{WRAPPER}} .xpro-elementor-button:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card:hover svg, {{WRAPPER}} .xpro-elementor-button:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	array(
		// 		'name'     => 'button_background_hover',
		// 		'label'    => __( 'Background', 'xpro-elementor-addons' ),
		// 		'types'    => array( 'classic', 'gradient' ),
		// 		'exclude'  => array( 'image' ),
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button-animation-none:hover,{{WRAPPER}} .xpro-button-2d-animation:hover,
		// 						{{WRAPPER}} .xpro-button-bg-animation::before,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::before,
		// 						{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::after,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::before,
		// 						{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::after,{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide,
		// 						{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:hover,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill,
								
		// 						{{WRAPPER}} .xpro-elementor-button-animation-none:focus,{{WRAPPER}} .xpro-button-2d-animation:focus,
		// 						{{WRAPPER}} [class*=xpro-elementor-button-focus-style-underline]:focus',
		// 	)
		// );

		// $this->add_group_control(
		// 	Group_Control_Box_Shadow::get_type(),
		// 	array(
		// 		'name'     => 'button_box_hshadow',
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button:hover',
		// 	)
		// );

		// $this->add_control(
		// 	'button_hover_border_color',
		// 	array(
		// 		'label'     => __( 'Border Color', 'xpro-elementor-addons' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'condition' => array(
		// 			'border_border!'          => '',
		// 			'hover_unique_animation!' => array(
		// 				'underlineFromLeft',
		// 				'underlineFromRight',
		// 				'underlineFromCenter',
		// 				'underlineReveal',
		// 			),
		// 		),
		// 		'selectors' => array(
		// 			'{{WRAPPER}} .xpro-elementor-button:hover, {{WRAPPER}} .xpro-elementor-button:focus' => 'border-color: {{VALUE}};',
		// 		),
		// 	)
		// );

		// $this->add_control(
		// 	'button_hover_underline',
		// 	array(
		// 		'label'     => __( 'Line Color', 'xpro-elementor-addons' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'condition' => array(
		// 			'hover_animation'        => 'unique',
		// 			'hover_unique_animation' => array(
		// 				'underlineFromLeft',
		// 				'underlineFromRight',
		// 				'underlineFromCenter',
		// 				'underlineReveal',
		// 			),
		// 		),
		// 		'selectors' => array(
		// 			'{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:before' => 'background-color: {{VALUE}};',
		// 		),
		// 	)
		// );

		// $this->add_control(
		// 	'hover_animation',
		// 	array(
		// 		'label'   => __( 'Hover Animation', 'xpro-elementor-addons' ),
		// 		'type'    => Controls_Manager::SELECT,
		// 		'default' => 'none',
		// 		'options' => array(
		// 			'none'                  => __( 'None', 'xpro-elementor-addons' ),
		// 			'2d-transition'         => __( '2D', 'xpro-elementor-addons' ),
		// 			'background-transition' => __( 'Background', 'xpro-elementor-addons' ),
		// 			'unique'                => __( 'Unique', 'xpro-elementor-addons' ),
		// 		),
		// 	)
		// );

		// $this->add_control(
		// 	'hover_2d_css_animation',
		// 	array(
		// 		'label'     => __( 'Animation Type', 'xpro-elementor-addons' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => 'hvr-grow',
		// 		'options'   => array(
		// 			'hvr-grow'                   => __( 'Grow', 'xpro-elementor-addons' ),
		// 			'hvr-shrink'                 => __( 'Shrink', 'xpro-elementor-addons' ),
		// 			'hvr-pulse'                  => __( 'Pulse', 'xpro-elementor-addons' ),
		// 			'hvr-pulse-grow'             => __( 'Pulse Grow', 'xpro-elementor-addons' ),
		// 			'hvr-pulse-shrink'           => __( 'Pulse Shrink', 'xpro-elementor-addons' ),
		// 			'hvr-push'                   => __( 'Push', 'xpro-elementor-addons' ),
		// 			'hvr-pop'                    => __( 'Pop', 'xpro-elementor-addons' ),
		// 			'hvr-bounce-in'              => __( 'Bounce In', 'xpro-elementor-addons' ),
		// 			'hvr-bounce-out'             => __( 'Bounce Out', 'xpro-elementor-addons' ),
		// 			'hvr-rotate'                 => __( 'Rotate', 'xpro-elementor-addons' ),
		// 			'hvr-grow-rotate'            => __( 'Grow Rotate', 'xpro-elementor-addons' ),
		// 			'hvr-float'                  => __( 'Float', 'xpro-elementor-addons' ),
		// 			'hvr-sink'                   => __( 'Sink', 'xpro-elementor-addons' ),
		// 			'hvr-bob'                    => __( 'Bob', 'xpro-elementor-addons' ),
		// 			'hvr-hang'                   => __( 'Hang', 'xpro-elementor-addons' ),
		// 			'hvr-wobble-vertical'        => __( 'Wobble Vertical', 'xpro-elementor-addons' ),
		// 			'hvr-wobble-horizontal'      => __( 'Wobble Horizontal', 'xpro-elementor-addons' ),
		// 			'hvr-wobble-to-bottom-right' => __( 'Wobble To Bottom Right', 'xpro-elementor-addons' ),
		// 			'hvr-wobble-to-top-right'    => __( 'Wobble To Top Right', 'xpro-elementor-addons' ),
		// 			'hvr-buzz'                   => __( 'Buzz', 'xpro-elementor-addons' ),
		// 			'hvr-buzz-out'               => __( 'Buzz Out', 'xpro-elementor-addons' ),
		// 		),
		// 		'condition' => array(
		// 			'hover_animation' => '2d-transition',
		// 		),
		// 	)
		// );

		// $this->add_control(
		// 	'hover_background_css_animation',
		// 	array(
		// 		'label'     => __( 'Animation Type', 'xpro-elementor-addons' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => 'hvr-sweep-to-right',
		// 		'options'   => array(
		// 			'hvr-sweep-to-right'         => __( 'Sweep To Right', 'xpro-elementor-addons' ),
		// 			'hvr-sweep-to-left'          => __( 'Sweep To Left', 'xpro-elementor-addons' ),
		// 			'hvr-sweep-to-bottom'        => __( 'Sweep To Bottom', 'xpro-elementor-addons' ),
		// 			'hvr-sweep-to-top'           => __( 'Sweep To Top', 'xpro-elementor-addons' ),
		// 			'hvr-bounce-to-right'        => __( 'Bounce To Right', 'xpro-elementor-addons' ),
		// 			'hvr-bounce-to-left'         => __( 'Bounce To Left', 'xpro-elementor-addons' ),
		// 			'hvr-bounce-to-bottom'       => __( 'Bounce To Bottom', 'xpro-elementor-addons' ),
		// 			'hvr-bounce-to-top'          => __( 'Bounce To Top', 'xpro-elementor-addons' ),
		// 			'hvr-radial-out'             => __( 'Radial Out', 'xpro-elementor-addons' ),
		// 			'hvr-radial-in'              => __( 'Radial In', 'xpro-elementor-addons' ),
		// 			'hvr-rectangle-in'           => __( 'Rectangle In', 'xpro-elementor-addons' ),
		// 			'hvr-rectangle-out'          => __( 'Rectangle Out', 'xpro-elementor-addons' ),
		// 			'hvr-shutter-in-horizontal'  => __( 'Shutter In Horizontal', 'xpro-elementor-addons' ),
		// 			'hvr-shutter-out-horizontal' => __( 'Shutter Out Horizontal', 'xpro-elementor-addons' ),
		// 			'hvr-shutter-in-vertical'    => __( 'Shutter In Vertical', 'xpro-elementor-addons' ),
		// 			'hvr-shutter-out-vertical'   => __( 'Shutter Out Vertical', 'xpro-elementor-addons' ),
		// 		),
		// 		'condition' => array(
		// 			'hover_animation' => 'background-transition',
		// 		),
		// 	)
		// );

		// $this->add_control(
		// 	'hover_unique_animation',
		// 	array(
		// 		'label'     => __( 'Animation Type', 'xpro-elementor-addons' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => 'skewFill',
		// 		'options'   => array(
		// 			'underlineFromLeft'   => __( 'Underline From Left', 'xpro-elementor-addons' ),
		// 			'underlineFromRight'  => __( 'Underline From Right', 'xpro-elementor-addons' ),
		// 			'underlineFromCenter' => __( 'Underline From Center', 'xpro-elementor-addons' ),
		// 			'skewFill'            => __( 'Skew Fill', 'xpro-elementor-addons' ),
		// 			'flipSlide'           => __( 'Flip Slide', 'xpro-elementor-addons' ),
		// 			'bubbleFromDown'      => __( 'Bubble From Down', 'xpro-elementor-addons' ),
		// 			'bubbleFromCenter'    => __( 'Bubble From Center', 'xpro-elementor-addons' ),
		// 		),
		// 		'condition' => array(
		// 			'hover_animation' => 'unique',
		// 		),
		// 	)
		// );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// $this->add_group_control(
		// 	Group_Control_Border::get_type(),
		// 	array(
		// 		'name'      => 'border',
		// 		'selector'  => '{{WRAPPER}} .xpro-elementor-button',
		// 		'separator' => 'before',
		// 	)
		// );

		// $this->add_responsive_control(
		// 	'border_radius',
		// 	array(
		// 		'label'      => __( 'Border Radius', 'xpro-elementor-addons' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => array( 'px', '%', 'em' ),
		// 		'selectors'  => array(
		// 			'{{WRAPPER}} .xpro-elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		),
		// 	)
		// );

		// $this->add_responsive_control(
		// 	'button_padding',
		// 	array(
		// 		'label'      => __( 'Padding', 'xpro-elementor-addons' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => array( 'px', 'em', '%' ),
		// 		'selectors'  => array(
		// 			'{{WRAPPER}} .xpro-elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		),
		// 	)
		// );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-media > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-media'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// $this->add_responsive_control(
		// 	'icon_bg_size',
		// 	array(
		// 		'label'      => __( 'Background Size', 'xpro-elementor-addons' ),
		// 		'type'       => Controls_Manager::SLIDER,
		// 		'size_units' => array( 'px' ),
		// 		'range'      => array(
		// 			'px' => array(
		// 				'min' => 5,
		// 				'max' => 500,
		// 			),
		// 		),
		// 		'selectors'  => array(
		// 			'{{WRAPPER}} .xpro-elementor-button-media' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
		// 		),
		// 	)
		// );

		$this->start_controls_tabs( 'button_icon_style' );

		$this->start_controls_tab(
			'icon_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-media > i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-media > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	array(
		// 		'name'     => 'icon_background',
		// 		'label'    => __( 'Background', 'xpro-elementor-addons' ),
		// 		'types'    => array( 'classic', 'gradient' ),
		// 		'exclude'  => array( 'image' ),
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button-media',
		// 	)
		// );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons' ),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card:hover .xpro-elementor-button-media > i, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media > i'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-w-hover-card:hover .xpro-elementor-button-media > svg, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	array(
		// 		'name'     => 'icon_background_hover',
		// 		'label'    => __( 'Background', 'xpro-elementor-addons' ),
		// 		'types'    => array( 'classic', 'gradient' ),
		// 		'exclude'  => array( 'image' ),
		// 		'selector' => '{{WRAPPER}} .xpro-elementor-button:hover .xpro-elementor-button-media, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media',
		// 	)
		// );

		// $this->add_control(
		// 	'icon_border_hover_color',
		// 	array(
		// 		'label'     => __( 'Border Color', 'xpro-elementor-addons' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'condition' => array(
		// 			'icon_border!' => '',
		// 		),
		// 		'selectors' => array(
		// 			'{{WRAPPER}} .xpro-elementor-button:hover .xpro-elementor-button-media, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media' => 'border-color: {{VALUE}};',
		// 		),
		// 	)
		// );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// $this->add_group_control(
		// 	Group_Control_Border::get_type(),
		// 	array(
		// 		'name'      => 'icon_border',
		// 		'selector'  => '{{WRAPPER}} .xpro-elementor-button-media',
		// 		'separator' => 'before',
		// 	)
		// );

		// $this->add_responsive_control(
		// 	'icon_border_radius',
		// 	array(
		// 		'label'      => __( 'Border Radius', 'xpro-elementor-addons' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => array( 'px', '%', 'em' ),
		// 		'selectors'  => array(
		// 			'{{WRAPPER}} .xpro-elementor-button-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		),
		// 	)
		// );

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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'hover-card/layout/frontend.php';

	}

}
