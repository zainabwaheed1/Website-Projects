<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
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
class Dual_Button extends Widget_Base {

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
		return 'xpro-dual-button';
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
		return __( 'Dual Button', 'xpro-elementor-addons-pro' );
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
		return 'xi-dual-button xpro-widget-pro-label';
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
		return array( 'button', 'dual', 'link', 'cta' );
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

		//Button Primary
		$this->start_controls_section(
			'section_button_primary_primary',
			array(
				'label' => __( 'Button 1', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_primary_text',
			array(
				'label'   => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'View Demo', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_primary_link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'button_primary_icon',
			array(
				'label'       => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->add_control(
			'button_primary_icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_primary_icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary.xpro-align-icon-right .xpro-elementor-button-media' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-primary.xpro-align-icon-left .xpro-elementor-button-media'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'button_primary_css_id',
			array(
				'label'       => __( 'Button ID', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Please make sure the ID is unique, This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'xpro-elementor-addons-pro' ),
				'separator'   => 'before',

			)
		);

		$this->add_control(
			'button_primary_onclick_event',
			array(
				'label'       => esc_html__( 'onClick Event', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'myFunction()',
			)
		);

		$this->end_controls_section();

		//Button Secondary
		$this->start_controls_section(
			'section_button_secondary_secondary',
			array(
				'label' => __( 'Button 2', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_secondary_text',
			array(
				'label'   => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Read More', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_secondary_link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'button_secondary_icon',
			array(
				'label'       => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->add_control(
			'button_secondary_icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_secondary_icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary.xpro-align-icon-right .xpro-elementor-button-media' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-secondary.xpro-align-icon-left .xpro-elementor-button-media'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'button_secondary_css_id',
			array(
				'label'       => __( 'Button ID', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Please make sure the ID is unique, This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'xpro-elementor-addons-pro' ),
				'separator'   => 'before',

			)
		);

		$this->add_control(
			'button_secondary_onclick_event',
			array(
				'label'       => esc_html__( 'onClick Event', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'myFunction()',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'stack',
			array(
				'label'   => __( 'Stack On', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
					'tablet' => __( 'Tablet', 'xpro-elementor-addons-pro' ),
					'mobile' => __( 'Mobile', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_responsive_control(
			'align',
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
				'prefix_class' => 'elementor%s-align-',
				'default'      => 'center',
			)
		);

		$this->add_responsive_control(
			'width',
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
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 500,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-dual-button-wrapper' => 'width: {{SIZE}}{{UNIT}};',
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
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-primary'                                        => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-secondary'                                      => 'margin-left: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}} .xpro-dual-button-stack-tablet .xpro-elementor-button-primary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .xpro-dual-button-stack-mobile .xpro-elementor-button-primary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_heading',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'        => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'separator_text',
			array(
				'label'     => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'OR', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'separator_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-dual-button-separator',
				'condition' => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-dual-button-separator' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'separator_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-dual-button-separator',
				'condition' => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_background_width',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-dual-button-separator' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'separator_box_shadow',
				'selector'  => '{{WRAPPER}} .xpro-dual-button-separator',
				'condition' => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'separator_border',
				'selector'  => '{{WRAPPER}} .xpro-dual-button-separator',
				'condition' => array(
					'separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-dual-button-separator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'separator' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Primary
		$this->start_controls_section(
			'section_button_primary_style',
			array(
				'label' => __( 'Button 1', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_primary_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-primary',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'button_primary_text_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-button-primary',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_primary_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-primary',
				'condition' => array(
					'button_primary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->add_control(
			'button_primary_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_primary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->add_responsive_control(
			'button_primary_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'button_primary_tabs_style' );

		$this->start_controls_tab(
			'button_primary_tab_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_primary_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_primary_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button,{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-skewFill:before,
								{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-flipSlide::before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_primary_box_shadow',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-primary',
				'condition' => array(
					'button_primary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_primary_tab_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_primary_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary:hover, {{WRAPPER}} .xpro-elementor-button-primary:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-primary:hover svg, {{WRAPPER}} .xpro-elementor-button-primary:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_primary_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-animation-none:hover,{{WRAPPER}} .xpro-elementor-button-primary.xpro-button-2d-animation:hover,
								{{WRAPPER}} .xpro-elementor-button-primary.xpro-button-bg-animation::before,{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-bubbleFromDown::before,
								{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-bubbleFromDown::after,{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-bubbleFromCenter::before,
								{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-bubbleFromCenter::after,{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-flipSlide,
								{{WRAPPER}} .xpro-elementor-button-primary[class*=xpro-elementor-button-hover-style-underline]:hover,{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-skewFill,
								
								{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-animation-none:focus,{{WRAPPER}} .xpro-elementor-button-primary.xpro-button-2d-animation:focus,
								{{WRAPPER}} .xpro-elementor-button-primary[class*=xpro-elementor-button-hover-style-underline]:focus',
			)
		);

		$this->add_control(
			'button_primary_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_primary_border_border!' => '',
					'button_primary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-bounceToTop:hover,{{WRAPPER}} .xpro-elementor-button-primary.xpro-elementor-button-hover-style-bounceToTop:focus,{{WRAPPER}} .xpro-elementor-button-primary:hover, {{WRAPPER}} .xpro-elementor-button-primary:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_primary_hbox_shadow',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-primary:hover',
				'condition' => array(
					'button_primary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->add_control(
			'button_primary_hover_underline',
			array(
				'label'     => __( 'Line Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_primary_hover_animation' => 'unique',
					'button_primary_hover_unique_animation' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary[class*=xpro-elementor-button-hover-style-underline]:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_primary_hover_animation',
			array(
				'label'   => __( 'Hover Animation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'                  => __( 'None', 'xpro-elementor-addons-pro' ),
					'2d-transition'         => __( '2D', 'xpro-elementor-addons-pro' ),
					'background-transition' => __( 'Background', 'xpro-elementor-addons-pro' ),
					'unique'                => __( 'Unique', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'button_primary_hover_2d_css_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-grow',
				'options'   => array(
					'hvr-grow'                   => __( 'Grow', 'xpro-elementor-addons-pro' ),
					'hvr-shrink'                 => __( 'Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-pulse'                  => __( 'Pulse', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-grow'             => __( 'Pulse Grow', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-shrink'           => __( 'Pulse Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-push'                   => __( 'Push', 'xpro-elementor-addons-pro' ),
					'hvr-pop'                    => __( 'Pop', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-in'              => __( 'Bounce In', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-out'             => __( 'Bounce Out', 'xpro-elementor-addons-pro' ),
					'hvr-rotate'                 => __( 'Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-grow-rotate'            => __( 'Grow Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-float'                  => __( 'Float', 'xpro-elementor-addons-pro' ),
					'hvr-sink'                   => __( 'Sink', 'xpro-elementor-addons-pro' ),
					'hvr-bob'                    => __( 'Bob', 'xpro-elementor-addons-pro' ),
					'hvr-hang'                   => __( 'Hang', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-vertical'        => __( 'Wobble Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-horizontal'      => __( 'Wobble Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-bottom-right' => __( 'Wobble To Bottom Right', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-top-right'    => __( 'Wobble To Top Right', 'xpro-elementor-addons-pro' ),
					'hvr-buzz'                   => __( 'Buzz', 'xpro-elementor-addons-pro' ),
					'hvr-buzz-out'               => __( 'Buzz Out', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_primary_hover_animation' => '2d-transition',
				),
			)
		);

		$this->add_control(
			'button_primary_hover_background_css_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-sweep-to-right',
				'options'   => array(
					'hvr-sweep-to-right'         => __( 'Sweep To Right', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-left'          => __( 'Sweep To Left', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-bottom'        => __( 'Sweep To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-top'           => __( 'Sweep To Top', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-right'        => __( 'Bounce To Right', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-left'         => __( 'Bounce To Left', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-bottom'       => __( 'Bounce To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-top'          => __( 'Bounce To Top', 'xpro-elementor-addons-pro' ),
					'hvr-radial-out'             => __( 'Radial Out', 'xpro-elementor-addons-pro' ),
					'hvr-radial-in'              => __( 'Radial In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-in'           => __( 'Rectangle In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-out'          => __( 'Rectangle Out', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-horizontal'  => __( 'Shutter In Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-horizontal' => __( 'Shutter Out Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-vertical'    => __( 'Shutter In Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-vertical'   => __( 'Shutter Out Vertical', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_primary_hover_animation' => 'background-transition',
				),
			)
		);

		$this->add_control(
			'button_primary_hover_unique_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'skewFill',
				'options'   => array(
					'underlineFromLeft'   => __( 'Underline From Left', 'xpro-elementor-addons-pro' ),
					'underlineFromRight'  => __( 'Underline From Right', 'xpro-elementor-addons-pro' ),
					'underlineFromCenter' => __( 'Underline From Center', 'xpro-elementor-addons-pro' ),
					'skewFill'            => __( 'Skew Fill', 'xpro-elementor-addons-pro' ),
					'flipSlide'           => __( 'Flip Slide', 'xpro-elementor-addons-pro' ),
					'bubbleFromDown'      => __( 'Bubble From Down', 'xpro-elementor-addons-pro' ),
					'bubbleFromCenter'    => __( 'Bubble From Center', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_primary_hover_animation' => 'unique',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_primary_icon_style',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_primary_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_primary_icon_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_primary_icon_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media',
				'condition' => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'button_primary_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tabs(
			'button_primary_icon_tab',
			array(
				'condition' => array(
					'button_primary_icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tab(
			'button_primary_icon_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_primary_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_primary_icon_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-primary .xpro-elementor-button-media',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_primary_icon_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_primary_icon_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary:hover .xpro-elementor-button-media i, {{WRAPPER}} .xpro-elementor-button-primary:focus .xpro-elementor-button-media i'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-primary:hover .xpro-elementor-button-media svg, {{WRAPPER}} .xpro-elementor-button-primary:focus .xpro-elementor-button-media svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_primary_icon_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-primary:hover .xpro-elementor-button-media, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media',
			)
		);

		$this->add_control(
			'button_primary_icon_border_hover_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-primary:hover .xpro-elementor-button-media, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Secondary
		$this->start_controls_section(
			'section_button_secondary_style',
			array(
				'label' => __( 'Button 2', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_secondary_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-secondary',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'button_secondary_text_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-button-secondary',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_secondary_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-secondary',
				'condition' => array(
					'button_secondary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->add_control(
			'button_secondary_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_secondary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->add_responsive_control(
			'button_secondary_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'button_secondary_tabs_style' );

		$this->start_controls_tab(
			'button_secondary_tab_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_secondary_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_secondary_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-skewFill:before,
								{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-flipSlide::before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_secondary_box_shadow',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-secondary',
				'condition' => array(
					'button_secondary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_secondary_tab_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_secondary_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary:hover, {{WRAPPER}} .xpro-elementor-button-secondary:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-secondary:hover svg, {{WRAPPER}} .xpro-elementor-button-secondary:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_secondary_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-animation-none:hover,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-button-2d-animation:hover,
								{{WRAPPER}} .xpro-elementor-button-secondary.xpro-button-bg-animation::before,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-bubbleFromDown::before,
								{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-bubbleFromDown::after,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-bubbleFromCenter::before,
								{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-bubbleFromCenter::after,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-flipSlide,
								{{WRAPPER}} .xpro-elementor-button-secondary[class*=xpro-elementor-button-hover-style-underline]:hover,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-skewFill,
								
								{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-animation-none:focus,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-button-2d-animation:focus,
								{{WRAPPER}} .xpro-elementor-button-secondary[class*=xpro-elementor-button-hover-style-underline]:focus',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_secondary_hbox_shadow',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-secondary:hover',
				'condition' => array(
					'button_secondary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
			)
		);

		$this->add_control(
			'button_secondary_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_secondary_border_border!' => '',
					'button_secondary_hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-bounceToTop:hover,{{WRAPPER}} .xpro-elementor-button-secondary.xpro-elementor-button-hover-style-bounceToTop:focus, {{WRAPPER}} .xpro-elementor-button-secondary:hover,{{WRAPPER}} .xpro-elementor-button-secondary:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_secondary_hover_underline',
			array(
				'label'     => __( 'Line Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_secondary_hover_animation' => 'unique',
					'button_secondary_hover_unique_animation' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary[class*=xpro-elementor-button-hover-style-underline]:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_secondary_hover_animation',
			array(
				'label'   => __( 'Hover Animation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'                  => __( 'None', 'xpro-elementor-addons-pro' ),
					'2d-transition'         => __( '2D', 'xpro-elementor-addons-pro' ),
					'background-transition' => __( 'Background', 'xpro-elementor-addons-pro' ),
					'unique'                => __( 'Unique', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'button_secondary_hover_2d_css_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-grow',
				'options'   => array(
					'hvr-grow'                   => __( 'Grow', 'xpro-elementor-addons-pro' ),
					'hvr-shrink'                 => __( 'Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-pulse'                  => __( 'Pulse', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-grow'             => __( 'Pulse Grow', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-shrink'           => __( 'Pulse Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-push'                   => __( 'Push', 'xpro-elementor-addons-pro' ),
					'hvr-pop'                    => __( 'Pop', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-in'              => __( 'Bounce In', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-out'             => __( 'Bounce Out', 'xpro-elementor-addons-pro' ),
					'hvr-rotate'                 => __( 'Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-grow-rotate'            => __( 'Grow Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-float'                  => __( 'Float', 'xpro-elementor-addons-pro' ),
					'hvr-sink'                   => __( 'Sink', 'xpro-elementor-addons-pro' ),
					'hvr-bob'                    => __( 'Bob', 'xpro-elementor-addons-pro' ),
					'hvr-hang'                   => __( 'Hang', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-vertical'        => __( 'Wobble Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-horizontal'      => __( 'Wobble Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-bottom-right' => __( 'Wobble To Bottom Right', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-top-right'    => __( 'Wobble To Top Right', 'xpro-elementor-addons-pro' ),
					'hvr-buzz'                   => __( 'Buzz', 'xpro-elementor-addons-pro' ),
					'hvr-buzz-out'               => __( 'Buzz Out', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_secondary_hover_animation' => '2d-transition',
				),
			)
		);

		$this->add_control(
			'button_secondary_hover_background_css_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-sweep-to-right',
				'options'   => array(
					'hvr-sweep-to-right'         => __( 'Sweep To Right', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-left'          => __( 'Sweep To Left', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-bottom'        => __( 'Sweep To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-top'           => __( 'Sweep To Top', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-right'        => __( 'Bounce To Right', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-left'         => __( 'Bounce To Left', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-bottom'       => __( 'Bounce To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-top'          => __( 'Bounce To Top', 'xpro-elementor-addons-pro' ),
					'hvr-radial-out'             => __( 'Radial Out', 'xpro-elementor-addons-pro' ),
					'hvr-radial-in'              => __( 'Radial In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-in'           => __( 'Rectangle In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-out'          => __( 'Rectangle Out', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-horizontal'  => __( 'Shutter In Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-horizontal' => __( 'Shutter Out Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-vertical'    => __( 'Shutter In Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-vertical'   => __( 'Shutter Out Vertical', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_secondary_hover_animation' => 'background-transition',
				),
			)
		);

		$this->add_control(
			'button_secondary_hover_unique_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'skewFill',
				'options'   => array(
					'underlineFromLeft'   => __( 'Underline From Left', 'xpro-elementor-addons-pro' ),
					'underlineFromRight'  => __( 'Underline From Right', 'xpro-elementor-addons-pro' ),
					'underlineFromCenter' => __( 'Underline From Center', 'xpro-elementor-addons-pro' ),
					'skewFill'            => __( 'Skew Fill', 'xpro-elementor-addons-pro' ),
					'flipSlide'           => __( 'Flip Slide', 'xpro-elementor-addons-pro' ),
					'bubbleFromDown'      => __( 'Bubble From Down', 'xpro-elementor-addons-pro' ),
					'bubbleFromCenter'    => __( 'Bubble From Center', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_secondary_hover_animation' => 'unique',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_secondary_icon_style',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_secondary_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_secondary_icon_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_secondary_icon_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media',
				'condition' => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'button_secondary_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tabs(
			'button_secondary_icon_tab',
			array(
				'condition' => array(
					'button_secondary_icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tab(
			'button_secondary_icon_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_secondary_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_secondary_icon_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-secondary .xpro-elementor-button-media',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_secondary_icon_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_secondary_icon_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary:hover .xpro-elementor-button-media i, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media i'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button-secondary:hover .xpro-elementor-button-media svg, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_secondary_icon_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-secondary:hover .xpro-elementor-button-media, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media',
			)
		);

		$this->add_control(
			'button_secondary_icon_border_hover_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button-secondary:hover .xpro-elementor-button-media, {{WRAPPER}} .xpro-elementor-button:focus .xpro-elementor-button-media' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'dual-button/layout/frontend.php';

	}

}
