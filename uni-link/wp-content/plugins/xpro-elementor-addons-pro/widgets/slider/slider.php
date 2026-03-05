<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
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
class Slider extends Widget_Base {

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
		return 'xpro-slider';
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
		return __( 'Multi Layer Slider', 'xpro-elementor-addons-pro' );
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
		return array( 'slide', 'slider', 'layers' );
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
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title_text',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Slide title.', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'item_source',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Source', 'xpro-elementor-addons-pro' ),
				'default' => 'dynamic',
				'options' => array(
					'dynamic'  => __( 'Dynamic', 'xpro-elementor-addons-pro' ),
					'template' => __( 'Template', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'item_content',
			array(
				'label'     => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'      => Xpro_Elementor_Widget_Area::TYPE,
				'condition' => array(
					'item_source' => 'dynamic',
				),
			)
		);

		$repeater->add_control(
			'item_template',
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
					'item_source' => 'template',
				),
			)
		);

		$repeater->add_control(
			'thumbnail',
			array(
				'label'   => __( 'Thumbnail', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'slider_item',
			array(
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'show_label'         => false,
				'title_field'        => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{title_text}}'
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => array(
					array(
						'title_text' => __( 'Slide 1', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title_text' => __( 'Slide 2', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title_text' => __( 'Slide 3', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_control(
			'orientation',
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

		$this->add_responsive_control(
			'height',
			array(
				'label'       => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-slider' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-slide'  => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .widgetarea_wrapper_editable' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'orientation' => 'vertical',
				),
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'slide_animation',
			array(
				'label'              => __( 'Slide Animation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'slide',
				'options'            => array(
					'fade'  => __( 'Fade', 'xpro-elementor-addons-pro' ),
					'slide' => __( 'Slide', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'orientation!' => 'vertical',
				),
			)
		);

		$this->add_control(
			'duration',
			array(
				'label'              => esc_html__( 'Slide Duration(ms)', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'range'              => array(
					'px' => array(
						'min'  => 100,
						'max'  => 1000,
						'step' => 100,
					),

				),
				'default'            => array(
					'size' => 400,
				),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-slider .xpro-slide.slick-current' => 'animation-duration: {{SIZE}}s;',
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

		$this->add_control(
			'loop',
			array(
				'label'              => __( 'Loop', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Duplicate last and first items to get loop illusion.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
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
			'rtl',
			array(
				'label'              => __( 'RTL', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Change direction from right to left.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .slick-slider .slick-track,{{WRAPPER}} .slick-slider .slick-list' => 'direction: rtl;',
				),
				'condition'          => array(
					'orientation!' => 'vertical',
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

		$this->add_control(
			'thumbs',
			array(
				'label'              => __( 'Show Thumbs', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show thumbs navigation.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
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

		$this->add_responsive_control(
			'nav_positions',
			array(
				'label'                => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
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
				'selectors_dictionary' => array(
					'default'       => '',
					'top-left'      => 'top:0; bottom:auto; left:0; right:auto; transform:none;',
					'top-center'    => 'top:0; bottom:auto; left:50%; right:auto; transform:translateX(-50%);',
					'top-right'     => 'top:0; bottom:auto; left:auto; right:0; transform:none;',
					'middle-left'   => 'top:50%; bottom:auto; left:0; right:auto; transform:translateY(-50%);',
					'middle-center' => 'top:50%; bottom:auto; left:50%; right:auto; transform:translate(-50%,-50%);',
					'middle-right'  => 'top:50%; bottom:auto; left:auto; right:0; transform:translateY(-50%);',
					'bottom-left'   => 'bottom:0; top:auto; left: 0; right:auto; transform:none;',
					'bottom-center' => 'top:auto; bottom:0; left:50%; right:auto; transform:translateX(-50%);',
					'bottom-right'  => 'top:auto; bottom:0; left:auto; right: 0; transform:none;',
				),
				'default'              => 'default',
				'render_type'          => 'template',
				'selectors'            => array(
					'{{WRAPPER}} .xpro-slider-navigation' => '{{VALUE}};',
				),
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
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
					'size' => 10,
				),
				'range'      => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} [class*=xpro-slider-navigation-horizontal] .slick-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-slider-navigation-horizontal] .slick-nav-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-slider-navigation-vertical] .slick-nav-prev' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-slider-navigation-vertical] .slick-nav-next' => 'bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:hover,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:hover,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev:hover,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next:hover' => 'border-color: {{VALUE}}',
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
				'selector'  => '{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next',
			)
		);

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-navigation .slick-nav-prev,{{WRAPPER}} .xpro-slider-navigation .slick-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-slider .slick-dots' => '{{VALUE}};',
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
					'{{WRAPPER}} .xpro-slider  .slick-dots > li > .slick-dot'                                  => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-slider .slick-dots > li > .slick-dot'                                     => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-slider .slick-dots > li > .slick-dot' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-slider .slick-dots > li.slick-active > .slick-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_aborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider .slick-dots > li.slick-active > .slick-dot' => 'border-color: {{VALUE}}',
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
				'selector'  => '{{WRAPPER}} .xpro-slider .slick-dots > li > .slick-dot',
			)
		);

		$this->add_responsive_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider .slick-dots > li > .slick-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-slider .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Thumbs
		$this->start_controls_section(
			'section_thumbs_style',
			array(
				'label'     => __( 'Thumbs', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'thumbs' => 'yes',
				),
			)
		);

		$this->add_control(
			'thumbs_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Modern', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_control(
			'thumbs_orientation',
			array(
				'label'              => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'default'            => 'horizontal',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'thumbs_positions',
			array(
				'label'                => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
					'top-left'      => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center'    => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'     => __( 'Top Right', 'xpro-elementor-addons-pro' ),
					'middle-left'   => __( 'Middle Left', 'xpro-elementor-addons-pro' ),
					'middle-right'  => __( 'Middle Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => __( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-center' => __( 'Bottom Center', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => __( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'top-left'      => 'top:0; left:0;',
					'top-center'    => 'top:0; left:50%; transform:translateX(-50%);',
					'top-right'     => 'top:0; right:0;',
					'middle-left'   => 'top:50%; left:0; transform:translateY(-50%);',
					'middle-right'  => 'top:50%; right:0;  transform:translateY(-50%);',
					'bottom-left'   => 'bottom:0; left:0;',
					'bottom-center' => 'bottom:0; left:50%; transform:translateX(-50%);',
					'bottom-right'  => 'bottom:0; right:0;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-slider-thumbs-wrapper' => '{{VALUE}};',
				),
				'default'              => 'bottom-center',
			)
		);

		$this->add_control(
			'thumbs_per_row',
			array(
				'label'              => __( 'Items', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 2,
				),
				'range'              => array(
					'px' => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				),
				'separator'          => 'before',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'thumbs_bg_height',
			array(
				'label'       => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
				),
				'render_type' => 'template',
				'selectors'   => array(
					'.xpro-slider-thumbs .xpro-slider-thumb-image > img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'thumbs_bg_width',
			array(
				'label'       => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
				),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-thumbs-orientation-horizontal' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-thumbs-orientation-vertical'   => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'thumbs_space_between',
			array(
				'label'       => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'render_type' => 'template',
				'default'     => array(
					'size' => 5,
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-thumbs-orientation-horizontal .slick-slide' => 'margin: 0 {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .xpro-thumbs-orientation-vertical .slick-slide'   => 'margin:{{SIZE}}{{UNIT}} 0',
				),
			)
		);

		$this->start_controls_tabs(
			'thumbs_style_tabs'
		);

		$this->start_controls_tab(
			'thumbs_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'thumbs_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-thumbs' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'thumbs_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-slider-thumbs .xpro-slider-thumb-image',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumbs_active_tab_style',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'thumbs_aborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-slider-thumbs .slick-current .xpro-slider-thumb-image' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'thumbs_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-thumbs .xpro-slider-thumb-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'thumbs_padding',
			array(
				'label'       => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-slider-thumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'thumbs_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slider-thumbs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'slider/layout/frontend.php';

	}

}
