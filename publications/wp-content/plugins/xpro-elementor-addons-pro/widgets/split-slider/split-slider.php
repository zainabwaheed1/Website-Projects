<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area;
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
class Split_Slider extends Widget_Base {

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
		return 'xpro-split-slider';
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
		return __( 'Split Slider', 'xpro-elementor-addons-pro' );
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
		return 'xi-multi-layer-slider xpro-widget-pro-label';
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
		return array( 'split-slide', 'split', 'slider' );
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
	public function get_style_depends() {

		return array( 'slick' );

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
		return array( 'slick' );
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
			'section_general_split_slider_1',
			array(
				'label' => __( 'Left Slides', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'split_slider_layout_1',
			array(
				'label'   => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => array(
					'image'    => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
					'content'  => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
					'template' => __( 'Template', 'xpro-elementor-addons-pro' ),
					'dynamic'  => esc_html__( 'Dynamic', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'split_slider_image_1',
			array(
				'label'     => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'split_slider_layout_1' => 'image',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'split_slider_media_thumbnail_1',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'split_slider_layout_1' => 'image',
				),
			)
		);

		$repeater->add_control(
			'split_slider_title_1',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type Your Title Here.', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'split_slider_layout_1' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_description_1',
			array(
				'label'       => esc_html__( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'split_slider_layout_1' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_btn_1',
			array(
				'label'       => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Learn More.', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type Your Button Here.', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'split_slider_layout_1' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_btn_link_1',
			array(
				'label'       => __( 'Button Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'split_slider_layout_1' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_content_1',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
				'condition'   => array(
					'split_slider_layout_1' => 'dynamic',
				),
			)
		);

		$repeater->add_control(
			'split_slider_template_1',
			array(
				'label'         => __( 'Template', 'xpro-elementor-addons-pro' ),
				'placeholder'   => __( 'Select a section template for as tab content', 'xpro-elementor-addons-pro' ),
				'description'   => sprintf(
				/* translators: %s: HTML */
					__( 'Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'xpro-elementor-addons-pro' ),
					'<a target="_blank" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ) ) . '">',
					'</a>'
				),
				'type'          => Controls_Manager::SELECT2,
				'label_block'   => false,
				'display_label' => false,
				'options'       => xpro_elementor_get_section_templates(),
				'condition'     => array(
					'split_slider_layout_1' => 'template',
				),
			)
		);

		$this->add_control(
			'split_slider_item_1',
			array(
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'show_label'         => false,
				'title_field'        => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{split_slider_title_1}}'
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => array(
					array(
						'split_slider_title_1' => __( 'Your Title Here', 'xpro-elementor-addons-pro' ),
					),
					array(
						'split_slider_title_1' => __( 'Your Title Here', 'xpro-elementor-addons-pro' ),
					),
					array(
						'split_slider_title_1' => __( 'Your Title Here', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_control(
			'slider_orientation_1',
			array(
				'label'              => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'horizontal',
				'separator'          => 'before',
				'options'            => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_split_slider_2',
			array(
				'label' => __( 'Right Slides', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'split_slider_layout_2',
			array(
				'label'   => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => array(
					'image'    => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
					'content'  => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
					'template' => esc_html__( 'Template', 'xpro-elementor-addons-pro' ),
					'dynamic'  => esc_html__( 'Dynamic', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'split_slider_image_2',
			array(
				'label'     => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'split_slider_layout_2' => 'image',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'split_slider_media_thumbnail_2',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'split_slider_layout_2' => 'image',
				),
			)
		);

		$repeater->add_control(
			'split_slider_title_2',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type Your Title Here.', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'split_slider_layout_2' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_description_2',
			array(
				'label'       => esc_html__( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'split_slider_layout_2' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_btn_2',
			array(
				'label'       => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Learn More', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type Your Button Here.', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'split_slider_layout_2' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_btn_link_2',
			array(
				'label'       => __( 'Button Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'split_slider_layout_2' => 'content',
				),
			)
		);

		$repeater->add_control(
			'split_slider_content_2',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
				'condition'   => array(
					'split_slider_layout_2' => 'dynamic',
				),
			)
		);

		$repeater->add_control(
			'split_slider_template_2',
			array(
				'label'         => __( 'Template', 'xpro-elementor-addons-pro' ),
				'placeholder'   => __( 'Select a section template for as tab content', 'xpro-elementor-addons-pro' ),
				'description'   => sprintf(
				/* translators: %s: HTML */
					__( 'Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'xpro-elementor-addons-pro' ),
					'<a target="_blank" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ) ) . '">',
					'</a>'
				),
				'type'          => Controls_Manager::SELECT2,
				'label_block'   => false,
				'display_label' => false,
				'options'       => xpro_elementor_get_section_templates(),
				'condition'     => array(
					'split_slider_layout_2' => 'template',
				),
			)
		);

		$this->add_control(
			'split_slider_item_2',
			array(
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'show_label'         => false,
				'title_field'        => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{split_slider_title_2}}'
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => array(
					array(
						'split_slider_title_2' => __( 'Title Here', 'xpro-elementor-addons-pro' ),
					),
					array(
						'split_slider_title_2' => __( 'Title Here', 'xpro-elementor-addons-pro' ),
					),
					array(
						'split_slider_title_2' => __( 'Title Here', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_control(
			'slider_orientation_2',
			array(
				'label'              => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'vertical',
				'separator'          => 'before',
				'options'            => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->end_controls_section();

		//Advance Settings
		$this->start_controls_section(
			'section_advance_settings',
			array(
				'label' => __( 'Settings', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_responsive_control(
			'split_slider_height',
			array(
				'label'       => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 450,
				),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-split-slider-1.xpro-split-slider-inner,
					{{WRAPPER}} .xpro-split-slider-1.slick-vertical .slick-slide,
					{{WRAPPER}} .xpro-split-slider-2.xpro-split-slider-inner,
					{{WRAPPER}} .xpro-split-slider-2.slick-vertical .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'mouse_drag',
			array(
				'label'              => __( 'Mouse Drag', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Mouse drag enabled.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'mouse_wheel',
			array(
				'label'              => __( 'Mouse Wheel', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Navigate slides using mouse wheel.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'              => __( 'Speed', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Slide animation speed in seconds(s).', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 6,
				),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => __( 'Autoplay', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To enable autoplay behaviour.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'autoplay_timeout',
			array(
				'label'              => __( 'Autoplay Timeout', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Autoplay interval timeout in seconds(s).', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 3,
				),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'nav',
			array(
				'label'              => __( 'Show Nav', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show next/prev buttons.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'              => __( 'Show Dots', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show dots navigation.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_nav_style_split_slider_left',
			array(
				'label' => __( 'Left Slides', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'split_slider_content_align_1',
			array(
				'label'                => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'left',
				'options'              => array(
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
				'selectors_dictionary' => array(
					'left'   => 'align-items: flex-start; justify-content: center; text-align: left;',
					'center' => 'align-items: center; justify-content: center; text-align: center',
					'right'  => 'align-items: flex-end; justify-content: center; text-align: right;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-content' => '{{VALUE}};',
				),

			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'split_slider_background_1',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-1',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'split_slider_border_1',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-1',
			)
		);

		$this->add_responsive_control(
			'split_slider_border_radius_1',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_padding_1',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'split_slider_title_options_1',
			array(
				'label'     => esc_html__( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'split_slider_title_typography_1',
				'selector' => '{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-title',
			)
		);

		$this->add_control(
			'split_slider_title_color_1',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_title_margin_1',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'split_slider_desc_options_1',
			array(
				'label'     => esc_html__( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'split_slider_desc_max_width_1',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-text' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'split_slider_desc_typography_1',
				'selector' => '{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-text',
			)
		);

		$this->add_control(
			'split_slider_desc_color_1',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_desc_margin_1',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_options_1',
			array(
				'label'     => esc_html__( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'split_slider_btn_typography_1',
				'selector' => '{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn',
			)
		);

		$this->start_controls_tabs(
			'split_slider_btn_style_tabs_1'
		);

		$this->start_controls_tab(
			'split_slider_btn_normal_tab_1',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'split_slider_btn_color_1',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_bg_1',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'split_slider_btn_hover_tab_style_1',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'split_slider_btn_hcolor_1',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_hbg_1',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_hborder_1',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'split_slider_btn_border_1',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn',
			)
		);

		$this->add_responsive_control(
			'split_slider_btn_border_radius_1',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_btn_padding_1',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_btn_marin_1',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-1 .xpro-split-slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_nav_style_slide_right',
			array(
				'label' => __( 'Right Slides', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'split_slider_content_align_2',
			array(
				'label'                => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'left',
				'options'              => array(
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
				'selectors_dictionary' => array(
					'left'   => 'align-items: flex-start; justify-content: center; text-align: left;',
					'center' => 'align-items: center; justify-content: center; text-align: center',
					'right'  => 'align-items: flex-end; justify-content: center; text-align: right;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-content' => '{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'split_slider_background_2',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-2',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'split_slider_border_2',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-2',
			)
		);

		$this->add_responsive_control(
			'split_slider_border_radius_2',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_padding_2',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-inner.xpro-split-slider-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'split_slider_title_options_2',
			array(
				'label'     => esc_html__( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'split_slider_title_typography_2',
				'selector' => '{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-title',
			)
		);

		$this->add_control(
			'split_slider_title_color_2',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_title_margin_2',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'split_slider_desc_options_2',
			array(
				'label'     => esc_html__( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'split_slider_desc_max_width_2',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-text' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'split_slider_desc_typography_2',
				'selector' => '{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-text',
			)
		);

		$this->add_control(
			'split_slider_desc_color_2',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_desc_margin_2',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_options_2',
			array(
				'label'     => esc_html__( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'split_slider_btn_typography_2',
				'selector' => '{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn',
			)
		);

		$this->start_controls_tabs(
			'split_slider_btn_style_tabs_2'
		);

		$this->start_controls_tab(
			'split_slider_btn_normal_tab_2',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'split_slider_btn_color_2',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_bg_2',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'split_slider_btn_hover_tab_style_2',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'split_slider_btn_hcolor_2',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_hbg_2',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'split_slider_btn_hborder_2',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'split_slider_btn_border_2',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn',
			)
		);

		$this->add_responsive_control(
			'split_slider_btn_border_radius_2',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_btn_padding_2',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'split_slider_btn_marin_2',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-split-slider-2 .xpro-split-slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Nav Styling
		$this->start_controls_section(
			'section_nav_style',
			array(
				'label'     => __( 'Navigation', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'nav' => 'yes',
				),
			)
		);

		$this->add_control(
			'nav_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'style-4' => __( 'Style 4', 'xpro-elementor-addons-pro' ),
					'style-5' => __( 'Style 5', 'xpro-elementor-addons-pro' ),
					'style-6' => __( 'Style 6', 'xpro-elementor-addons-pro' ),
					'style-7' => __( 'Style 7', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_control(
			'nav_orientation',
			array(
				'label'   => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'horizontal',
			)
		);

		$this->add_control(
			'nav_positions',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'       => __( 'Default', 'xpro-elementor-addons-pro' ),
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
				'default' => 'default',
			)
		);

		$this->add_responsive_control(
			'nav_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_offset',
			array(
				'label'      => __( 'Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => -25,
				),
				'range'      => array(
					'px' => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} [class*=xpro-slider-navigation-horizontal] .slick-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-slider-navigation-horizontal] .slick-nav-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-slider-navigation-vertical] .slick-nav-prev'   => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-slider-navigation-vertical] .slick-nav-next'   => 'bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_positions' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-navigation' => 'grid-gap: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_positions!' => 'default',
				),
			)
		);

		$this->start_controls_tabs(
			'nav_style_tabs'
		);

		$this->start_controls_tab(
			'nav_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:hover,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:hover'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:focus,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:hover,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:hover'                     => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:focus,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:hover,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:hover' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:focus,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'nav_border',
				'separator' => 'before',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,
				{{WRAPPER}} .xpro-slider-navigation .slick-nav-next',
			)
		);

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,
					{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_marin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_positions!' => 'default',
				),
			)
		);

		$this->end_controls_section();

		//Dots
		$this->start_controls_section(
			'section_dots_style',
			array(
				'label'     => __( 'Dots', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dots' => 'yes',
				),
			)
		);

		$this->add_control(
			'dots_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_control(
			'dots_orientation',
			array(
				'label'   => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'horizontal',
			)
		);

		$this->add_responsive_control(
			'dots_positions',
			array(
				'label'                => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
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
				'selectors_dictionary' => array(
					'top-left'      => 'top:0; bottom:auto; left:0; right:auto; transform:none;',
					'top-center'    => 'top:0; bottom:auto; left:50%; right:auto; transform:translateX(-50%);',
					'top-right'     => 'top:0; bottom:auto; left:auto; right:0; transform:none;',
					'middle-left'   => 'top:50%; bottom:auto; left:0; right:auto; transform:translateY(-50%);',
					'middle-center' => 'top:50%; bottom:auto; left:50%; right:auto; transform:translate(-50%,-50%);',
					'middle-right'  => 'top:50%; bottom:auto; left:auto; right:0; transform:translateY(-50%);',
					'bottom-left'   => 'top:auto; bottom:0; left:0; right:auto; transform:none;',
					'bottom-center' => 'top:auto; bottom:0; left:50%; right:auto; transform:translateX(-50%);',
					'bottom-right'  => 'top:auto; bottom:0; left:auto; right:0; transform:none;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots' => '{{VALUE}};',
				),
				'default'              => 'bottom-center',
			)
		);

		$this->add_responsive_control(
			'dots_bg_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'separator'  => 'before',
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .slider-dots-box  .slick-dots > li > .slick-dot'                                  => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-slider-dots-vertical-style-2 .slick-dots > li.slick-active > .slick-dot' => 'height: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_responsive_control(
			'dots_bg_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots > li > .slick-dot'                                     => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-slider-dots-horizontal-style-2 .slick-dots > li.slick-active > .slick-dot' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_responsive_control(
			'dots_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} [class*=xpro-slider-dots-horizontal] .slick-dots > li' => 'margin: 0 {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} [class*=xpro-slider-dots-vertical] .slick-dots > li'     => 'margin: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->start_controls_tabs(
			'dots_style_tabs'
		);

		$this->start_controls_tab(
			'dots_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'dots_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots > li > .slick-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dots_active_tab_style',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'dots_abg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots > li.slick-active > .slick-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_aborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots > li.slick-active > .slick-dot' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'dots_border',
				'separator' => 'before',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .slider-dots-box .slick-dots > li > .slick-dot',
			)
		);

		$this->add_responsive_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots > li > .slick-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .slider-dots-box .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'split-slider/layout/frontend.php';

	}

}
