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
class Woo_Checkout extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-woo-checkout';
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
	 * Retrieve widget title.
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Woo Checkout', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @return string Widget icon.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-credit-card xpro-widget-pro-label';
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
		return array( 'woo', 'woocommerce', 'checkout', 'payment' );
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
			'section_general_fields',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		if ( ! class_exists( '\WooCommerce' ) ) {
			$this->add_control(
				'woo_missing_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: 1$s: Title */
						__( 'Looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'xpro-elementor-addons-pro' ),
						'<a href="' . esc_url( admin_url( 'plugin-install.php?s=woocommerce&tab=search&type=term' ) )
						. '" target="_blank" rel="noopener">Woocommerce Plugin</a>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				)
			);

			$this->add_control(
				'woo_install',
				array(
					'type' => Controls_Manager::RAW_HTML,
					'raw'  => '<a href="' . esc_url( admin_url( 'plugin-install.php?s=woocommerce&tab=search&type=term' ) ) . '" target="_blank" rel="noopener">Click to install or activate Woocommerce Plugin</a>',
				)
			);
			$this->end_controls_section();

			return;
		}

		$this->add_control(
			'layout',
			array(
				'label'        => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => '1',
				'options'      => array(
					'1' => __( 'One Column', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Two Columns', 'xpro-elementor-addons-pro' ),
				),
				'prefix_class' => 'xpro-wc-checkout-col-',
			)
		);

		$this->add_responsive_control(
			'column_gap',
			array(
				'label'     => __( 'Columns Gap', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'devices'   => array( 'desktop', 'tablet' ),
				'default'   => array(
					'size' => 35,
				),
				'selectors' => array(
					'{{WRAPPER}}.xpro-wc-checkout-col-2 .woocommerce .col2-set' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'layout' => '2',
				),
			)
		);

		$this->add_responsive_control(
			'first_column_width',
			array(
				'label'      => __( 'First Column Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'devices'    => array( 'desktop', 'tablet' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}}.xpro-wc-checkout-col-2 .woocommerce .col2-set'                                                  => 'width: calc({{SIZE}}% - ({{column_gap.size}}px / 2));',
					'{{WRAPPER}}.xpro-wc-checkout-col-2 #order_review_heading, {{WRAPPER}}.xpro-wc-checkout-col-2 #order_review' => 'width: calc((100% - {{SIZE}}%) - ({{column_gap.size}}px / 2));',
				),
				'condition'  => array(
					'layout' => '2',
				),
			)
		);

		$this->add_control(
			'columns_stack',
			array(
				'label'        => __( 'Stack On', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'separator'    => 'before',
				'options'      => array(
					'tablet' => __( 'Stack On Tablet', 'xpro-elementor-addons-pro' ),
					'mobile' => __( 'Stack On Mobile', 'xpro-elementor-addons-pro' ),
				),
				'prefix_class' => 'xpro-wc-checkout-stack-',
				'condition'    => array(
					'layout' => '2',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sections',
			array(
				'label' => __( 'Sections', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'sections_space_between',
			array(
				'label'     => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 35,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}.xpro-wc-checkout-col-2 .woocommerce .col2-set .col-1,
					{{WRAPPER}}.xpro-wc-checkout-col-2 .woocommerce-checkout-review-order-table' => 'margin-bottom: {{SIZE}}{{UNIT}};',

					'(desktop){{WRAPPER}}.xpro-wc-checkout-col-2.xpro-wc-checkout--stack-tablet .woocommerce .col2-set .col-2 .woocommerce-additional-fields' => 'margin-bottom: 0;',
					'(tablet){{WRAPPER}}.xpro-wc-checkout-col-2.xpro-wc-checkout--stack-tablet .woocommerce .col2-set .col-2 .woocommerce-additional-fields'  => 'margin-bottom: {{sections_gap_tablet.SIZE}}{{sections_gap_tablet.UNIT}};',
					'(mobile){{WRAPPER}}.xpro-wc-checkout-col-2.xpro-wc-checkout--stack-tablet .woocommerce .col2-set .col-2 .woocommerce-additional-fields'  => 'margin-bottom: {{sections_gap_mobile.SIZE}}{{sections_gap_mobile.UNIT}};',

					'(mobile){{WRAPPER}}.xpro-wc-checkout-col-2.xpro-wc-checkout--stack-mobile .woocommerce .col2-set .col-2 .woocommerce-additional-fields' => 'margin-bottom: {{sections_gap_mobile.SIZE}}{{sections_gap_mobile.UNIT}};',
				),
				'condition' => array(
					'layout' => '2',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sections_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table, {{WRAPPER}} .woocommerce .woocommerce-checkout-payment,{{WRAPPER}} .woocommerce .woocommerce-checkout #payment',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sections_border',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table, {{WRAPPER}} .woocommerce .woocommerce-checkout-payment',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'sections_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table, {{WRAPPER}} .woocommerce .woocommerce-checkout-payment',
			)
		);

		$this->add_control(
			'sections_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table, {{WRAPPER}} .woocommerce .woocommerce-checkout-payment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_inputs',
			array(
				'label' => __( 'Inputs', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'inputs_text_align',
			array(
				'label'       => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'left',
				'selectors'   => array(
					'{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'inputs_typography',
				'selector' => '{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select',
			)
		);

		$this->add_responsive_control(
			'inputs_height',
			array(
				'label'     => __( 'Input Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .form-row input.input-text, {{WRAPPER}} .woocommerce .form-row select' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'textarea_height',
			array(
				'label'     => __( 'Textarea Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form .form-row textarea' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'inputs_gap',
			array(
				'label'     => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'input_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inputs_border',
				'selector' => '{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inputs_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce form .input-text, {{WRAPPER}} .woocommerce form select',
			)
		);

		$this->add_control(
			'inputs_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_coupon_bar',
			array(
				'label' => __( 'Coupon Bar', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'coupon_bar_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);

		$this->add_control(
			'coupon_bar_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'coupon_bar_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'coupon_bar_links_color',
			array(
				'label'     => __( 'Links Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'coupon_bar_links_color_hover',
			array(
				'label'     => __( 'Links Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'coupon_bar_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'coupon_bar_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);

		$this->add_control(
			'coupon_bar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'coupon_bar_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_coupon_style',
			array(
				'label' => __( 'Coupon Box', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_coupon_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon, {{WRAPPER}} .woocommerce form.checkout_coupon .input-text',
			)
		);

		$this->add_control(
			'form_coupon_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'form_coupon_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'form_coupon_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .woocommerce form.checkout_coupon',
			)
		);

		$this->add_control(
			'form_coupon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_heading',
			array(
				'label'     => __( 'Input', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'form_coupon_input_width',
			array(
				'label'     => __( 'Input Width', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'form_coupon_input_height',
			array(
				'label'     => __( 'Input Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'form_coupon_input_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce form.checkout_coupon .input-text',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'form_coupon_input_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon .input-text',
			)
		);

		$this->add_control(
			'form_coupon_input_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_form_coupon_input_style' );

		$this->start_controls_tab(
			'tab_form_coupon_input_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'form_coupon_input_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_coupon_input_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'form_coupon_input_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_coupon_input_focus',
			array(
				'label' => __( 'Focus', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'form_coupon_input_text_color_focus',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_background_color_focus',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_border_color_focus',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .input-text:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'form_coupon_button_label_heading',
			array(
				'label'     => __( 'Coupon Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_coupon_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon .button',
			)
		);

		$this->add_responsive_control(
			'form_coupon_button_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'form_coupon_button_border_normal',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon .button',
			)
		);

		$this->add_control(
			'form_coupon_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'form_coupon_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_form_coupon_button_style' );

		$this->start_controls_tab(
			'tab_form_coupon_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'form_coupon_button_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'form_coupon_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'form_coupon_button_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon .button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_coupon_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'form_coupon_button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'form_coupon_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'form_coupon_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce form.checkout_coupon .button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'form_coupon_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .woocommerce form.checkout_coupon .button:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_headings',
			array(
				'label' => __( 'Headings', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'headings_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields > h3, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields > h3, {{WRAPPER}} .woocommerce .woocommerce-additional-fields > h3, {{WRAPPER}} .woocommerce #order_review_heading',
			)
		);

		$this->add_control(
			'headings_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields > h3, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields > h3, {{WRAPPER}} .woocommerce .woocommerce-additional-fields > h3, {{WRAPPER}} .woocommerce #order_review_heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'headings_spacing',
			array(
				'label'     => __( 'Space Bottom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields > h3, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields > h3, {{WRAPPER}} .woocommerce .woocommerce-additional-fields > h3, {{WRAPPER}} .woocommerce #order_review_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_billing_details',
			array(
				'label' => __( 'Billing Details', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_billing_details_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'section_billing_details_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'section_billing_details_border',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper',
			)
		);

		$this->add_control(
			'section_billing_details_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'_heading_billing_details_inputs',
			array(
				'label'     => __( 'Inputs', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_billing_details_inputs_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select',
			)
		);

		$this->add_responsive_control(
			'section_billing_details_inputs_height',
			array(
				'label'     => __( 'Input Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'section_billing_details_inputs_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'section_billing_details_inputs_border',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select',
			)
		);

		$this->add_control(
			'section_billing_details_inputs_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_billing_details_inputs_style' );

		$this->start_controls_tab(
			'tab_billing_details_inputs_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_billing_details_inputs_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'section_billing_details_inputs_box_shadow_hover',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:hover',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_billing_details_inputs_focus',
			array(
				'label' => __( 'Focus', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_text_color_focus',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_background_color_focus',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_billing_details_inputs_border_color_focus',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'section_billing_details_inputs_box_shadow_focus',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper select:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper input.input-text:focus, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper select:focus',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'section_billing_details_inputs_label_heading',
			array(
				'label'     => __( 'Input Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'section_billing_details_inputs_label_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper label, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_billing_details_inputs_label_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper label, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper label',
			)
		);

		$this->add_responsive_control(
			'section_billing_details_inputs_label_spacing',
			array(
				'label'     => __( 'Space Bottom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-billing-fields__field-wrapper label, {{WRAPPER}} .woocommerce .woocommerce-shipping-fields__field-wrapper label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_fields_style',
			array(
				'label' => __( 'Additional Information', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'section_additional_fields_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'section_additional_fields_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'section_additional_fields_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper',
			)
		);

		$this->add_control(
			'section_additional_fields_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_heading',
			array(
				'label'     => __( 'Textarea', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_additional_fields_textarea_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea',
			)
		);

		$this->start_controls_tabs( 'tabs_additional_fields_textarea_style' );

		$this->start_controls_tab(
			'tab_additional_fields_textarea_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'section_additional_fields_textarea_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'section_additional_fields_textarea_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea',
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_additional_fields_textarea_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'section_additional_fields_textarea_box_shadow_hover',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:hover',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_additional_fields_textarea_focus',
			array(
				'label' => __( 'Focus', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_text_color_focus',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_background_color_focus',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_border_color_focus',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'section_additional_fields_textarea_box_shadow_focus',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper textarea:focus',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'section_additional_fields_textarea_label_heading',
			array(
				'label'     => __( 'Textarea Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'section_additional_fields_textarea_label_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_additional_fields_textarea_label_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper label',
			)
		);

		$this->add_responsive_control(
			'section_additional_fields_textarea_label_spacing',
			array(
				'label'     => __( 'Space Bottom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-additional-fields__field-wrapper label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Review order
		 */
		$this->start_controls_section(
			'section_review_order_style',
			array(
				'label' => __( 'Review Order', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_review_order_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_review_order_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'section_review_order_border',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'section_review_order_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table',
			)
		);

		$this->add_control(
			'section_review_order_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_review_order_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_review_order_table_head_heading',
			array(
				'label'     => __( 'Table Head', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'section_review_order_table_head_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table thead th' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_review_order_table_head_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table thead th' => 'background-color: {{VALUE}};',
				),
			)
		);

		//Table Body
		$this->add_control(
			'section_review_order_table_body_heading',
			array(
				'label'     => __( 'Table Body', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'section_review_order_tbody_rows_tabs_style' );

		$this->start_controls_tab(
			'tab_section_review_order_even_row',
			array(
				'label' => __( 'Even Row', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_review_order_even_row_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table .cart_item:nth-child(2n)' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_review_order_even_row_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table .cart_item:nth-child(2n) > td' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_section_review_order_odd_row',
			array(
				'label' => __( 'Odd Row', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'section_review_order_odd_row_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table .cart_item:nth-child(2n+1)' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_review_order_odd_row_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table .cart_item:nth-child(2n+1) > td' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		//Table Footer
		$this->add_control(
			'section_review_order_table_foot_heading',
			array(
				'label'     => __( 'Table Footer', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'section_review_order_table_foot_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table tfoot tr' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_review_order_table_foot_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout-review-order-table tfoot tr' => 'background-color: {{VALUE}};',
				),
			)
		);

		//Table Border
		$this->add_control(
			'section_review_order_row_separator_heading',
			array(
				'label'     => __( 'Table Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'section_review_order_row_separator_type',
			array(
				'label'     => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
					'double' => __( 'Double', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table thead th,
					{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table td,
					{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table tfoot th' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_review_order_row_separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table thead th,
					{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table td,
					{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table tfoot th' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'section_review_order_row_separator_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'section_review_order_row_separator_size',
			array(
				'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table thead th,
					{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table td,
					{{WRAPPER}} .woocommerce table.shop_table.woocommerce-checkout-review-order-table tfoot th' => 'border-width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'section_review_order_row_separator_type!' => 'none',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Payment method
		 */
		$this->start_controls_section(
			'section_payment_method_style',
			array(
				'label' => __( 'Payment Method', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_payment_method_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout #payment',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'section_payment_method_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout #payment',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'section_payment_method_border',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout #payment',
			)
		);

		$this->add_control(
			'section_payment_method_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout #payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_payment_method_label_heading',
			array(
				'label'     => __( 'Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'payment_method_label_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-checkout .payment_methods label',
			)
		);

		$this->add_control(
			'payment_method_label_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-checkout .payment_methods label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'section_payment_method_message_heading',
			array(
				'label'     => __( 'Message', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'payment_method_message_typography',
				'selector' => '{{WRAPPER}} .woocommerce-checkout #payment .payment_box',
			)
		);

		$this->add_control(
			'payment_method_message_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-checkout #payment .payment_box' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'payment_method_message_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-checkout #payment .payment_box'        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .woocommerce-checkout #payment .payment_box:before' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Privacy policy
		 */
		$this->start_controls_section(
			'section_privacy_policy_style',
			array(
				'label' => __( 'Privacy Policy', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'privacy_policy_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-terms-and-conditions-wrapper .woocommerce-privacy-policy-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'privacy_policy_link_color',
			array(
				'label'     => __( 'Link Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-terms-and-conditions-wrapper .woocommerce-privacy-policy-text .woocommerce-privacy-policy-link' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'privacy_policy_link_hover_color',
			array(
				'label'     => __( 'Link Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce .woocommerce-terms-and-conditions-wrapper .woocommerce-privacy-policy-text .woocommerce-privacy-policy-link:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'privacy_policy_typography',
				'selector' => '{{WRAPPER}} .woocommerce .woocommerce-terms-and-conditions-wrapper .woocommerce-privacy-policy-text',
			)
		);

		$this->end_controls_section();

		/**
		 * Button
		 */
		$this->start_controls_section(
			'section_checkout_button_style',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .woocommerce #payment #place_order',
			)
		);

		$this->add_control(
			'button_width',
			array(
				'label'        => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'auto',
				'options'      => array(
					'auto'   => __( 'Auto', 'xpro-elementor-addons-pro' ),
					'full'   => __( 'Full Width', 'xpro-elementor-addons-pro' ),
					'custom' => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'prefix_class' => 'xpro-wc-checkout--btn-',
			)
		);

		$this->add_responsive_control(
			'button_custom_width',
			array(
				'label'      => __( 'Custom Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 100,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce #payment #place_order' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_width' => 'custom',
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
			'button_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce #payment #place_order' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce #payment #place_order' => 'color: {{VALUE}}',
				),
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
			'button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce #payment #place_order:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce #payment #place_order:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce #payment #place_order:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .woocommerce #payment #place_order:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border_normal',
				'selector' => '{{WRAPPER}} .woocommerce #payment #place_order',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce #payment #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce #payment #place_order',
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce #payment #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'       => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', 'em', '%' ),
				'placeholder' => array(
					'top'    => '',
					'right'  => 'auto',
					'bottom' => '',
					'left'   => 'auto',
				),
				'selectors'   => array(
					'{{WRAPPER}} .woocommerce #payment #place_order' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-checkout/layout/frontend.php';
	}
}
