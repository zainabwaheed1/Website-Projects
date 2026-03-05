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
class Mailchimp extends Widget_Base {

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
		return 'xpro-mailchimp';
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
		return __( 'MailChimp', 'xpro-elementor-addons-pro' );
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
		return 'xi-email xpro-widget-pro-label';
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
		return array( 'xpro', 'mail', 'chimp', 'subscribe', 'form' );
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
	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'mailchimp_audience',
			array(
				'label'   => esc_html__( 'Audience', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => xpro_get_mailchimp_lists(),
			)
		);

		$this->add_control(
			'mailchimp_layout',
			array(
				'label'   => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'email_label',
			array(
				'label'     => esc_html__( 'Email Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Email', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'email_placeholder',
			array(
				'label'   => esc_html__( 'Email Placeholder', 'xpro-elementor-addons-pro' ),
				'default' => esc_html__( 'Your Email', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'xpro-elementor-addons-pro' ),
				'default' => esc_html__( 'Subscribe', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'firstname_enable',
			array(
				'label'        => __( 'First Name', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'firstname_label',
			array(
				'label'     => esc_html__( 'Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'First Name', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'firstname_enable' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'firstname_placeholder',
			array(
				'label'     => esc_html__( 'Placeholder', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Your Name', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'firstname_enable' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'lastname_enable',
			array(
				'label'        => __( 'Last Name', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator'    => 'before',
				'condition'    => array(
					'firstname_enable' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'lastname_label',
			array(
				'label'     => esc_html__( 'Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Last Name', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'firstname_enable' => array( 'yes' ),
					'lastname_enable'  => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'lastname_placeholder',
			array(
				'label'     => esc_html__( 'Placeholder', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Your Last Name', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'firstname_enable' => array( 'yes' ),
					'lastname_enable'  => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'              => __( 'Success Message', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => __( 'Form submit successfully!', 'xpro-elementor-addons-pro' ),
				'frontend_available' => true,
				'separator'          => 'before',
			)
		);

		$this->add_control(
			'error_message',
			array(
				'label'              => __( 'Error Message', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => __( 'Something went wrong please check!', 'xpro-elementor-addons-pro' ),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'required_field_message',
			array(
				'label'              => __( 'Required Message', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => __( 'Please provide the missing fields!', 'xpro-elementor-addons-pro' ),
				'frontend_available' => true,
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

		$this->add_responsive_control(
			'space_between',
			array(
				'label'     => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields' => 'grid-gap:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mailchimp-fields',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'box_border',
				'selector' => '{{WRAPPER}} .xpro-mailchimp-fields',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .xpro-mailchimp-fields',
			)
		);

		$this->add_responsive_control(
			'box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-fields' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-fields' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			array(
				'label' => __( 'Label', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// label alignment
		$this->add_responsive_control(
			'label_alignment',
			array(
				'label' => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-email' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .xpro-mailchimp-fields > div > label',
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'mark_required_color',
			array(
				'label'     => __( 'Mark Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-contact-form-require > label:after' => 'color: {{COLOR}};',
				),
				'condition' => array(
					'mark_required' => 'true',
				),
			)
		);

		$this->add_control(
			'label_spacing',
			array(
				'label'     => __( 'Spacing Bottom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields_style',
			array(
				'label' => __( 'Fields', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'field_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-mailchimp-fields > div > input',
			)
		);

		$this->add_control(
			'field_placeholder_color',
			array(
				'label'     => __( 'Placeholder Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} ::-moz-placeholder'      => 'color: {{VALUE}};',
					'{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_field_state' );

		$this->start_controls_tab(
			'tab_field_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'field_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_focus',
			array(
				'label' => __( 'Focus', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'field_focus_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input:focus' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'field_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'field_border',
				'selector'  => '{{WRAPPER}} .xpro-mailchimp-fields > div > input',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'field_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-mailchimp-fields > div > input',
			)
		);

		$this->add_responsive_control(
			'field_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'field_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-fields > div > input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'message_style',
			array(
				'label' => __( 'Message', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
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
						'title' => __( 'Above', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-alert' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'message_typography',
				'selector' => '{{WRAPPER}} .xpro-alert',
			)
		);

		$this->add_control(
			'message_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-alert' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'message_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'message_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-alert' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .xpro-mailchimp-subscribe-btn',
			)
		);

		$this->add_responsive_control(
			'button_width',
			array(
				'label'      => __( 'Button Width', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn' => 'width: {{SIZE}}{{UNIT}}; min-width:max-content;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'submit_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submit_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mailchimp-subscribe-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'submit_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn:hover, {{WRAPPER}} .xpro-mailchimp-subscribe-btn:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submit_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mailchimp-subscribe-btn:hover, {{WRAPPER}} .xpro-mailchimp-subscribe-btn:focus',
			)
		);

		$this->add_control(
			'submit_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn:hover, {{WRAPPER}} .xpro-mailchimp-subscribe-btn:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'submit_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'submit_border',
				'selector'  => '{{WRAPPER}} .xpro-mailchimp-subscribe-btn',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'submit_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-mailchimp-subscribe-btn',
			)
		);

		$this->add_control(
			'submit_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'submit_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'submit_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mailchimp-subscribe-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'mailchimp/layout/frontend.php';

	}

}
