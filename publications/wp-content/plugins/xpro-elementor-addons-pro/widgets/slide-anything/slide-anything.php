<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
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
class Slide_Anything extends Widget_Base {

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
		return 'xpro-slide-anything';
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
		return __( 'Slide Anything', 'xpro-elementor-addons-pro' );
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
		return 'xi-image-slider xpro-widget-pro-label';
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
		return array( 'slide', 'slider', 'carousel', 'anything' );
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

		return array( 'owl-carousel' );

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

		return array( 'owl-carousel' );

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
				'default'     => __( 'New', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'source',
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
					'source' => 'dynamic',
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
					'source' => 'template',
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
					__( 'Slide: %1$s', 'xpro-elementor-addons-pro' ),
					'{{title_text}}'
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => array(
					array(
						'title_text' => __( 'First', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title_text' => __( 'Second', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title_text' => __( 'Third', 'xpro-elementor-addons-pro' ),
					),
				),
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
			'item_per_row',
			array(
				'label'              => __( 'Items To Show', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust items to show in a row.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 2,
				'desktop_default'    => 2,
				'tablet_default'     => 1,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'              => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the space between items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 15,
				),
				'tablet_default'     => array(
					'size' => 15,
				),
				'mobile_default'     => array(
					'size' => 15,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
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
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'custom_width',
			array(
				'label'              => __( 'Custom Width', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To set custom width to item.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_responsive_control(
			'item_width',
			array(
				'label'              => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vw' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 500,
				),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'custom_width' => 'yes',
				),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-slide-item-inner' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'rtl',
			array(
				'label'              => __( 'RTL', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Change direction from Right to left.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel' => 'direction: rtl;',
				),
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
			'center',
			array(
				'label'              => __( 'Center', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Works well with even an odd number of items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'start_position',
			array(
				'label'              => esc_html__( 'Start From', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To enable change slider starting position.', 'xpro-elementor-addons-pro' ),
				'type'               => \Elementor\Controls_Manager::NUMBER,
				'min'                => 0,
				'step'               => 1,
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'center' => 'yes',
				),
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

		//Nav
		$this->start_controls_section(
			'section_nav_style',
			array(
				'label'     => __( 'Nav', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_position',
			array(
				'label'       => __( 'Position', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Next/Prev buttons horziontal position.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'default'     => array(
					'size' => - 25,
				),
				'range'       => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nav_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next',
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
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav > button.owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'dots_bg_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_bg_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-dots-horizontal-style-2.owl-carousel .owl-dots > .owl-dot.active' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_control(
			'dots_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 3,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_spacing',
			array(
				'label'      => __( 'Spacing', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots' => 'bottom: -{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'dots_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot',
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
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot.active' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots > button.owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'slide-anything/layout/frontend.php';

	}

}
