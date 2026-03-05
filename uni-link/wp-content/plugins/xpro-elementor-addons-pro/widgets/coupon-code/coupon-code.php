<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
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
class Coupon_Code extends Widget_Base {

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
		return 'xpro-coupon-code';
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
		return __( 'Coupon Code', 'xpro-elementor-addons-pro' );
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
		return 'xi-copy-page xpro-widget-pro-label';
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
		return array( 'xpro', 'coupon', 'code' );
	}

	/**
	 * Retrieve the list of style the widget depended on.
	 *
	 * Used to set style dependencies required to run the widget.
	 *
	 * @return array Widget style dependencies.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_script_depends() {
		return array( 'clipboard' );
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
			'coupon_layout',
			array(
				'label'        => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'style-1',
				'options'      => array(
					'style-1' => esc_html__( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => esc_html__( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => esc_html__( 'Style 3', 'xpro-elementor-addons-pro' ),
				),
				'prefix_class' => 'xpro-coupon-code-style-',
			)
		);

		$this->add_control(
			'coupon_text',
			array(
				'label'   => esc_html__( 'Text', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => esc_html__( 'Get 50% Discount', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'coupon_text_icon',
			array(
				'label'       => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'skin'        => 'inline',
			)
		);

		$this->add_control(
			'coupon_code',
			array(
				'label'   => esc_html__( 'Code', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => esc_html__( 'XPRODEAL2022', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'coupon_placeholder',
			array(
				'label'     => esc_html__( 'Placeholder', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'XX-XX-XX', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'trigger_by_action' => 'yes',
				),
			)
		);

		$this->add_control(
			'trigger_link',
			array(
				'label' => esc_html__( 'Trigger Link', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'link',
			array(
				'label'     => esc_html__( 'Link', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => '#',
				),
				'condition' => array(
					'trigger_link' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'coupon_reveal_align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .xpro-coupon-code-wrapper' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'coupon_wrapper_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 400,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-coupon-code-wrapper .xpro-coupon-code' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'coupon_reveal_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-coupon-code > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_coupon_msg',
			array(
				'label' => __( 'Message', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'coupon_msg_align',
			array(
				'label'                => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
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
				'selectors'            => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg' => '{{VALUE}};',
				),
				'selectors_dictionary' => array(
					'left'   => 'text-align: left; justify-content: flex-start;',
					'center' => 'text-align: center; justify-content: center;',
					'right'  => 'text-align: right; justify-content: flex-end;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'msg_typography',
				'selector' => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg',
			)
		);

		$this->start_controls_tabs(
			'coupon_msg_tabs'
		);

		$this->start_controls_tab(
			'coupon_msg_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'msg_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'msg_background',
				'selector' => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'coupon_msg_hover_tab',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'msg_color_hover',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg:hover'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'msg_background_hover',
				'selector' => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg:hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
			)
		);

		$this->add_control(
			'msg_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'msg_border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'msg_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'msg_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-msg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_coupon_code',
			array(
				'label' => __( 'Code', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'coupon_code_align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'coupon_code_typography',
				'selector' => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final',
			)
		);

		$this->start_controls_tabs(
			'coupon_code_tabs'
		);

		$this->start_controls_tab(
			'coupon_code_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'coupon_code_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'coupon_code_background',
				'selector' => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'coupon_code_hover_tab',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'coupon_code_color_hover',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'coupon_code_background_hover',
				'selector' => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final:hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
			)
		);

		$this->add_control(
			'coupon_code_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'coupon_border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'coupon_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'coupon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-coupon-code .xpro-coupon-code-final' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_render_attribute(
			array(
				'coupon-data' => array(
					'class'         => 'xpro-coupon-code',
					'data-settings' => array(
						wp_json_encode(
							array(
								'couponLayout'  => $settings['coupon_layout'],
								'couponId'      => '#xpro-coupon-code-final-' . $this->get_id(),
								'couponMsgId'   => '#xpro-coupon-code-msg-' . $this->get_id(),
								'triggerURL'    => ( 'yes' === $settings['trigger_link'] ) && ( ! empty( $settings['link']['url'] ) ) ? $settings['link']['url'] : false,
								'triggerTarget' => ( 'yes' === $settings['trigger_link'] ) && ( ! empty( $settings['link']['is_external'] ) ),
								'couponCode'    => $settings['coupon_code'],
							)
						),
					),
				),
			)
		);

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'coupon-code/layout/frontend.php';

	}

}
