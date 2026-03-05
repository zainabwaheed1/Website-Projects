<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
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
class Countdown extends Widget_Base {

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
		return 'xpro-countdown';
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
		return __( 'Countdown', 'xpro-elementor-addons-pro' );
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
		return 'xi-countdown xpro-widget-pro-label';
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
		return array( 'countdown', 'count', 'timer', 'coming soon' );
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
		return array( 'countdown' );
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

		//Media
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'due_date',
			array(
				'label'       => __( 'Time', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => gmdate( 'Y-m-d', strtotime( '+ 1 day' ) ),
				'description' => esc_html__( 'Set the due date and time', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'label_days',
			array(
				'label'       => esc_html__( 'Label Days', 'xpro-elementor-addons-pro' ),
				'description' => esc_html__( 'Set the label for days.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Days', 'xpro-elementor-addons-pro' ),
				'default'     => 'Days',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'label_hours',
			array(
				'label'       => esc_html__( 'Label Hours', 'xpro-elementor-addons-pro' ),
				'description' => esc_html__( 'Set the label for hours.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Hours', 'xpro-elementor-addons-pro' ),
				'default'     => 'Hours',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'label_minutes',
			array(
				'label'       => esc_html__( 'Label Minutes', 'xpro-elementor-addons-pro' ),
				'description' => esc_html__( 'Set the label for minutes.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Minutes', 'xpro-elementor-addons-pro' ),
				'default'     => 'Minutes',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'label_seconds',
			array(
				'label'       => esc_html__( 'Label Seconds', 'xpro-elementor-addons-pro' ),
				'description' => esc_html__( 'Set the label for seconds.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Seconds', 'xpro-elementor-addons-pro' ),
				'default'     => 'Seconds',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'separator' => 'before',
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-xpro-countdown' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'social_icon_column_grid',
			array(
				'label'          => __( 'Columns', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options'        => array(
					'1' => __( '1', 'xpro-elementor-addons-pro' ),
					'2' => __( '2', 'xpro-elementor-addons-pro' ),
					'3' => __( '3', 'xpro-elementor-addons-pro' ),
					'4' => __( '4', 'xpro-elementor-addons-pro' ),
				),
				'prefix_class'   => 'xpro-countdown%s-grid-',
				'selectors'      => array(
					'{{WRAPPER}} .xpro-countdown' => 'grid-template-columns:repeat({{VALUE}}, auto);',
				),
			)
		);

		$this->add_control(
			'separator',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'default' => 'none',
				'options' => array(
					'none'    => __( 'None', 'xpro-elementor-addons-pro' ),
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'style-4' => __( 'Style 4', 'xpro-elementor-addons-pro' ),
					'style-5' => __( 'Style 5', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->end_controls_section();

		// End Action Section Start
		$this->start_controls_section(
			'_section_end_action',
			array(
				'label' => __( 'Expire Action', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'end_action_type',
			array(
				'label'              => esc_html__( 'Action Type', 'xpro-elementor-addons-pro' ),
				'label_block'        => false,
				'frontend_available' => true,
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Choose which action perform when countdown end.', 'xpro-elementor-addons-pro' ),
				'options'            => array(
					'none'     => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
					'message'  => esc_html__( 'Message', 'xpro-elementor-addons-pro' ),
					'url'      => esc_html__( 'Redirection Link', 'xpro-elementor-addons-pro' ),
					'template' => esc_html__( 'Template', 'xpro-elementor-addons-pro' ),
				),
				'dynamic'     => array(
					'active' => true,
				),
				'default'            => 'none',
			)
		);
		$this->add_control(
			'end_message',
			array(
				'label'       => __( 'Countdown End Message', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'Countdown End!', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type your message here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'end_action_type' => 'message',
				),
			)
		);
		$this->add_control(
			'end_redirect_link',
			array(
				'label'              => __( 'Redirection Link', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'frontend_available' => true,
				'placeholder'        => __( 'https://abc.com/', 'xpro-elementor-addons-pro' ),
				'condition'          => array(
					'end_action_type' => 'url',
				),
			)
		);

		$this->add_control(
			'template',
			array(
				'label'       => __( 'Section Template', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Select a section template for as tab content', 'xpro-elementor-addons-pro' ),
				'description' => sprintf(
					/* translators: 1$s: Title */
					__( 'Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'xpro-elementor-addons-pro' ),
					'<a target="_blank" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ) ) . '">',
					'</a>'
				),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => xpro_elementor_get_section_templates(),
				'condition'   => array(
					'end_action_type' => 'template',
				),
			)
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'display',
			array(
				'label'     => __( 'Label Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'column',
				'options'   => array(
					'column' => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-menu-bar',
					),
					'row'    => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-item' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'          => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'default'        => array(
					'size' => 30,
				),
				'tablet_default' => array(
					'size' => 15,
				),
				'mobile_default' => array(
					'size' => 15,
				),
				'range'          => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-countdown' => 'grid-column-gap: {{SIZE}}{{UNIT}}; grid-row-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} [class*=xpro-countdown-separator-style] .xpro-countdown-item:before' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'time_heading',
			array(
				'label'     => __( 'Time', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'time_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-time',
			)
		);

		$this->add_control(
			'time_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-time' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'time_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'label_heading',
			array(
				'label'     => __( 'Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-label',
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'label_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'separator'  => 'before',
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-item' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-item' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'box_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item',
			)
		);

		$this->add_control(
			'box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'box_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Separator
		$this->start_controls_section(
			'section_separator_style',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'separator!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'separator_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} [class*=xpro-countdown-separator-style] .xpro-countdown-item:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} [class*=xpro-countdown-separator-style] .xpro-countdown-item:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		//Days
		$this->start_controls_section(
			'section_days_style',
			array(
				'label' => __( 'Days', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'days_time_color',
			array(
				'label'     => __( 'Time Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-days' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'days_label_color',
			array(
				'label'     => __( 'Label Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-label-days' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'days_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-days',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'days_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-days',
			)
		);

		$this->end_controls_section();

		//Hours
		$this->start_controls_section(
			'section_hours_style',
			array(
				'label' => __( 'Hours', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'hours_time_color',
			array(
				'label'     => __( 'Time Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-hours' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hours_label_color',
			array(
				'label'     => __( 'Label Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-label-hours' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hours_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-hours',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hours_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-hours',
			)
		);

		$this->end_controls_section();

		//Minutes
		$this->start_controls_section(
			'section_minutes_style',
			array(
				'label' => __( 'Minutes', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'minutes_time_color',
			array(
				'label'     => __( 'Time Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-minutes' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'minutes_label_color',
			array(
				'label'     => __( 'Label Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-label-minutes' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'minutes_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-minutes',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'minutes_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-minutes',
			)
		);

		$this->end_controls_section();

		//Seconds
		$this->start_controls_section(
			'section_seconds_style',
			array(
				'label' => __( 'Seconds', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'seconds_time_color',
			array(
				'label'     => __( 'Time Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-seconds' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'seconds_label_color',
			array(
				'label'     => __( 'Label Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-label-seconds' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'seconds_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-seconds',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'seconds_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-item-seconds',
			)
		);

		$this->end_controls_section();

		//Expire Message
		$this->start_controls_section(
			'section_message_style',
			array(
				'label'     => __( 'Expire Message', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'separator!' => 'none',
				),
			)
		);

		$this->add_control(
			'message_alignment',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-content-type-message' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'message_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-content-type-message, {{WRAPPER}} .xpro-countdown-content-type-message > *',
			)
		);

		$this->add_control(
			'message_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-content-type-message, {{WRAPPER}} .xpro-countdown-content-type-message > *' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'message_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-countdown-content-type-message' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'message_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-countdown-content-type-message',
			)
		);

		$this->add_responsive_control(
			'message_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-content-type-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'message_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-content-type-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'message_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-countdown-content-type-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'countdown/layout/frontend.php';

	}

}
