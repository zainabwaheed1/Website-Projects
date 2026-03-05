<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
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
class Restaurant_Menu extends Widget_Base {

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
		return 'xpro-restaurant-menu';
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
		return __( 'Restaurant Menu', 'xpro-elementor-addons-pro' );
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
		return 'xi-restaurant-menu xpro-widget-pro-label';
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
		return array( 'restaurant', 'price', 'menu', 'list' );
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

		//Menu
		$this->start_controls_section(
			'section_menu',
			array(
				'label' => __( 'Menu', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'          => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'vertical',
				'options'        => array(
					'vertical'   => array(
						'title' => __( 'Vertical', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'horizontal' => array(
						'title' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'style_transfer' => true,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'   => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'icon'   => array(
						'title' => __( 'Icon', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-star-o',
					),
					'image'  => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
					'custom' => array(
						'title' => __( 'Custom', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-font',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'show_label'  => false,
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'media_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'     => __( 'Choose Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'media_type' => 'image',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'thumbnail',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'custom',
			array(
				'label'       => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '01', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'media_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
					'custom'  => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'media_type' => array( 'icon', 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_content_color',
			array(
				'label'     => __( 'Content Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > i,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} span.xpro-rest-menu-media svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_type_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > i,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > svg,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > i,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Menu Item', 'xpro-elementor-addons-pro' ),
				'separator'   => 'before',
				'placeholder' => __( 'title here', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'title_link',
			array(
				'label'       => __( 'Title Link', 'xpro-elementor-addons-pro' ),
				'separator'   => 'after',
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Tender cauliflower, buffalo sauce, creamy ranch dip.', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'       => __( 'Price', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$15.50', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Price here', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'show_btn',
			array(
				'label'        => esc_html__( 'Show Button', 'xpro-elementor-addons-pro' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$repeater->add_control(
			'rest_btn',
			array(
				'label'     => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Read More', 'xpro-elementor-addons-pro' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_btn' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'rest_btn_link',
			array(
				'label'       => __( 'Button Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_btn' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'button_icon',
			array(
				'label'                  => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'                   => Controls_Manager::ICONS,
				'skin'                   => 'inline',
				'exclude_inline_options' => 'svg',
				'label_block'            => false,
				'condition'              => array(
					'show_btn' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'rest_btn_icon_position',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'before',
				'options'   => array(
					'before' => __( 'Before', 'xpro-elementor-addons-pro' ),
					'after'  => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_icon[value]!' => '',
					'show_btn'            => 'yes',
				),
			)
		);

		$this->add_control(
			'menu_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{title}}'
				),
				'default'     => array(
					array(
						'title'       => __( 'Menu Item 1', 'xpro-elementor-addons-pro' ),
						'price'       => __( '$15.50', 'xpro-elementor-addons-pro' ),
						'description' => __( 'Tender cauliflower, buffalo sauce, creamy ranch dip.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title'       => __( 'Menu Item 2', 'xpro-elementor-addons-pro' ),
						'price'       => __( '$15.50', 'xpro-elementor-addons-pro' ),
						'description' => __( 'Tender cauliflower, buffalo sauce, creamy ranch dip.', 'xpro-elementor-addons-pro' ),
					),
				),

			)
		);

		$this->add_control(
			'show_sep',
			array(
				'label'        => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'separator'    => 'before',
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'price_position',
			array(
				'label'   => __( 'Price Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => array(
					'before' => __( 'Right', 'xpro-elementor-addons-pro' ),
					'after'  => __( 'Bottom', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->end_controls_section();

		//General Style
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'general_alignment',
			array(
				'label'          => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::CHOOSE,
				'options'        => array(
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
				'toggle'         => false,
				'default'        => 'left',
				'tablet_default' => 'left',
				'mobile_default' => 'center',
				'prefix_class'   => 'elementor%s-align-',
			)
		);

		$this->add_responsive_control(
			'list_item_per_row',
			array(
				'label'          => __( 'Item Per Row', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'render_type'    => 'template',
				'range'          => array(
					'px' => array(
						'min'  => 2,
						'max'  => 6,
						'step' => 1,
					),
				),
				'default'        => array(
					'size' => 2,
				),
				'tablet_default' => array(
					'size' => 2,
				),
				'mobile_default' => array(
					'size' => 1,
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-rest-menu-horizontal .xpro-rest-menu-inner' => 'grid-template-columns:repeat({{SIZE}}, auto)',
				),
				'condition'      => array(
					'layout' => 'horizontal',
				),
			)
		);

		$this->add_responsive_control(
			'list_item_space',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-inner' => ' grid-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'general_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'general_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-item',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'general_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-item',
			)
		);

		$this->add_responsive_control(
			'general_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'general_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//General Style
		$this->start_controls_section(
			'section_style_media',
			array(
				'label' => __( 'Media', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'media_image_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i,
					{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'media_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i,
					{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'media_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i,
				{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'media_icon_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i,
				{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom',
			)
		);

		$this->add_responsive_control(
			'media_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i,
					{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_image_options',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_image_size',
			array(
				'label'      => __( 'width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > img' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_icon_options',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_icon_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_custom_options',
			array(
				'label'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'media_custom_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom',
			)
		);

		$this->add_responsive_control(
			'media_custom_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 60,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_custom_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-item .xpro-rest-menu-media > .xpro-rest-menu-media-custom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => __( 'Title', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'title_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-info',
			)
		);

		$this->add_responsive_control(
			'title_box_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_options',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-info-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-info-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hcolor',
			array(
				'label'     => __( 'Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-info-title:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Price
		$this->start_controls_section(
			'section_style_price',
			array(
				'label' => __( 'Price', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-info-price',
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-info-price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'price_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'price_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Separator
		$this->start_controls_section(
			'section_style_sep',
			array(
				'label' => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'sep_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info-separator' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'sep_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-info-separator > span' => 'border-bottom-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'step_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-info-separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Description
		$this->start_controls_section(
			'section_style_desc',
			array(
				'label' => __( 'Description', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-text',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'desc_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-btn',
			)
		);

		$this->add_responsive_control(
			'button_icon_space',
			array(
				'label'      => __( 'Icon Space', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-btn' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
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
			'button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-btn > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-btn' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .xpro-rest-menu-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-rest-menu-btn',
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
			'button_icon_hcolor',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-btn:hover > i,
					{{WRAPPER}} .xpro-rest-menu-btn:focus > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-btn:hover,
					{{WRAPPER}} .xpro-rest-menu-btn:focus' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .xpro-rest-menu-btn:hover,{{WRAPPER}} .xpro-rest-menu-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rest-menu-btn:hover,
					{{WRAPPER}} .xpro-rest-menu-btn:focus' => 'border-color: {{VALUE}}',
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
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rest-menu-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-rest-menu-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'restaurant-menu/layout/frontend.php';

	}

}
