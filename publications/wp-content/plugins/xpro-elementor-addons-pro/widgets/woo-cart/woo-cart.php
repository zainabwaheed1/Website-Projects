<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Xpro Elementor Addons
 *
 * Elementor widget.
 *
 * @since 0.1.8
 */
class Woo_Cart extends Widget_Base {

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
		return 'xpro-woo-cart';
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
		return __( 'Woo Cart', 'xpro-elementor-addons-pro' );
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
		return 'xi-cart xpro-widget-pro-label';
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
		return array( 'woocommerce', 'woo', 'cart' );
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
		return array( 'wc-cart' );
	}

	/**
	 * Register toggle widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_general_fields',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		//notice
		if ( ! class_exists( '\WooCommerce' ) ) {
			$this->add_control(
				'woo_missing_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
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
			'layout_type',
			array(
				'label'              => __( 'Display', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => array(
					'block'  => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'inline' => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'default'            => 'block',
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'cart_total_width',
			array(
				'label'      => __( 'Cart Total Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart-collaterals' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout_type' => 'block',
				),
			)
		);

		//coupon
		$this->add_control(
			'show_coupon',
			array(
				'label'        => __( 'Show Coupon Field', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		// cart table style

		$this->start_controls_section(
			'section_cart_table_style',
			array(
				'label' => __( 'Table', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'section_cart_table_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart, {{WRAPPER}} .xpro-woo-cart .cart th, {{WRAPPER}} .xpro-woo-cart .cart td',
			)
		);

		$this->add_control(
			'section_cart_table_border_collapse',
			array(
				'label'     => __( 'Border Collapse', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'collapse',
				'options'   => array(
					'inherit'  => __( 'Default', 'xpro-elementor-addons-pro' ),
					'collapse' => __( 'Collapse', 'xpro-elementor-addons-pro' ),
					'separate' => __( 'Separate', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart' => 'border-collapse: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'section_cart_table_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart',
			)
		);

		$this->add_control(
			'section_cart_table_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
				),
				'condition'  => array(
					'section_cart_table_border_collapse' => 'separate',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_cart_table_head_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart table.cart thead th',
			)
		);

		$this->add_control(
			'section_review_order_table_head_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart thead th' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_review_order_table_head_background_type',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart table.cart thead th',
			)
		);

		$this->add_control(
			'section_cart_table_cart_items_heading',
			array(
				'label'     => __( 'Cart Items', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'cart_items_row_separator_type',
			array(
				'label'     => __( 'Separator Type', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-cart-form__cart-item:not(:first-child) td' => 'border-top-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_items_row_separator_size',
			array(
				'label'     => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '1',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-cart-form__cart-item:not(:first-child) td' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'cart_items_row_separator_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'cart_items_row_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-cart-form__cart-item:not(:first-child) td' => 'border-top-color: {{VALUE}};',
				),
				'condition' => array(
					'cart_items_row_separator_type!' => 'none',
				),
			)
		);

		$this->start_controls_tabs( 'cart_items_rows_tabs_style' );

		$this->start_controls_tab(
			'cart_items_even_row',
			array(
				'label' => __( 'Even Row', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'cart_items_even_row_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .cart_item:nth-child(2n) td' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_items_even_row_links_color',
			array(
				'label'     => __( 'Links Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .cart_item:nth-child(2n) a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_items_even_row_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .cart_item:nth-child(2n) td' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cart_items_odd_row',
			array(
				'label' => __( 'Odd Row', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'cart_items_odd_row_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .cart_item:nth-child(2n+1) td' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_items_odd_row_links_color',
			array(
				'label'     => __( 'Links Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .cart_item:nth-child(2n+1) a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_items_odd_row_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .cart_item:nth-child(2n+1) td' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'cart_items_image_heading',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'cart_items_image_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 80,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .product-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'cart_items_image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .product-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'cart_items_quantity_input_heading',
			array(
				'label'     => __( 'Quantity Input', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'cart_items_quantity_input_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 20,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_items_quantity_input_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 20,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		//color
		$this->add_control(
			'cart_items_quantity_input_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text' => 'color: {{VALUE}} !important;',
				),
			)
		);

		//bg color
		$this->add_control(
			'cart_items_quantity_input_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		//border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'cart_items_quantity_input_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text',
			)
		);

		//border radius
		$this->add_control(
			'cart_items_quantity_input_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_items_quantity_input_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .quantity .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'cart_items_remove_icon_heading',
			array(
				'label'     => __( 'Remove Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'cart_items_remove_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_cart_items_remove_icon_style' );

		$this->start_controls_tab(
			'tab_cart_items_remove_icon_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'cart_items_remove_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'cart_items_remove_icon_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'cart_items_remove_icon_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart table.cart .remove',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cart_items_remove_icon_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'cart_items_remove_icon_color_hover',
			array(
				'label'     => __( 'Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'cart_items_remove_icon_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_items_remove_icon_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->add_control(
			'cart_items_remove_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_items_remove_icon_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart table.cart .remove' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tabs();

		$this->end_controls_section();

		// -------------------------------------------------
		// coupon

		$this->start_controls_section(
			'form_coupon_style',
			array(
				'label'     => __( 'Coupon', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'form_coupon_input_width',
			array(
				'label'      => __( 'Input Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text' => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'form_coupon_input_height',
			array(
				'label'      => __( 'Input Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'form_coupon_input_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text',
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_form_coupon_input_style' );

		$this->start_controls_tab(
			'tab_form_coupon_input_normal',
			array(
				'label'     => __( 'Normal', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text::placeholder' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'form_coupon_input_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text',
				'condition'   => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'form_coupon_input_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text',
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
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
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_coupon_input_hover',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_coupon_input_focus',
			array(
				'label'     => __( 'Focus', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_text_color_focus',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text:focus' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_background_color_focus',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text:focus' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_input_border_color_focus',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .input-text:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'show_coupon' => 'yes',
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
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'form_coupon_button_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .button',
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'form_coupon_button_spacing',
			array(
				'label'      => __( 'Spacing', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'form_coupon_button_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_form_coupon_button_style' );

		$this->start_controls_tab(
			'tab_form_coupon_button_normal',
			array(
				'label'     => __( 'Normal', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'form_coupon_button_bg_color_type_normal',
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .button',
				'condition' => array(
					'show_coupon' => 'yes',
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
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'form_coupon_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .button',
				'condition'   => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'form_coupon_button_box_shadow',
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .button',
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_control(
			'form_coupon_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
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
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_coupon_button_hover',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'form_coupon_button_bg_color_type_hover',
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .button:hover',
				'condition' => array(
					'show_coupon' => 'yes',
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
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_coupon' => 'yes',
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
					'{{WRAPPER}} .xpro-woo-cart .cart .coupon .button:hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'form_coupon_button_box_shadow_hover',
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart .coupon .button:hover',
				'condition' => array(
					'show_coupon' => 'yes',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		//Update Button
		$this->start_controls_section(
			'section_update_cart_button_style',
			array(
				'label' => __( 'Update Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'update_cart_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]',
			)
		);

		$this->add_responsive_control(
			'update_cart_button_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_update_cart_button_style' );

		$this->start_controls_tab(
			'tab_update_cart_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'update_cart_button_bg_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]',
			)
		);

		$this->add_control(
			'update_cart_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'update_cart_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'update_cart_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]',
			)
		);

		$this->add_control(
			'update_cart_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'update_cart_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'update_cart_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_update_cart_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'update_cart_button_bg_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]:hover',
			)
		);

		$this->add_control(
			'update_cart_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'update_cart_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'update_cart_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart .button[name="update_cart"]:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		//Cart Total
		$this->start_controls_section(
			'section_cart_totals_style',
			array(
				'label' => __( 'Total', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cart_totals_table_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart-collaterals .cart_totals',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'cart_totals_bg_box_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart-collaterals .cart_totals',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cart_totals_bg_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .cart-collaterals .cart_totals',
			)
		);

		$this->add_control(
			'cart_totals_box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart-collaterals .cart_totals' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_totals_box_background_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart-collaterals .cart_totals' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_total_top_spacing',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 400,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart-collaterals' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'cart_totals_box_heading_style',
			array(
				'label'     => __( 'Heading', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'sections_headings_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals > h2' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sections_headings_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals > h2',
			)
		);

		$this->add_responsive_control(
			'sections_headings_spacing',
			array(
				'label'     => __( 'Bottom Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals > h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'cart_totals_text_heading',
			array(
				'label'     => __( 'Table Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_totals_text_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table',
			)
		);

		$this->add_control(
			'cart_totals_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_totals_headings_heading',
			array(
				'label'     => __( 'Table Heading', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_totals_headings_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table th',
			)
		);

		$this->add_control(
			'cart_totals_headings_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table th' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_totals_table_heading',
			array(
				'label'     => __( 'Table', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'cart_totals_items_row_separator_type',
			array(
				'label'     => __( 'Separator Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
					'double' => __( 'Double', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table th, {{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table tr td' => 'border-bottom-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_totals_items_row_separator_size',
			array(
				'label'     => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table tr th, {{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table tr td' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'cart_totals_items_row_separator_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'cart_totals_items_row_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table tr th, {{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table tr td' => 'border-bottom-color: {{VALUE}};',
				),
				'condition' => array(
					'cart_totals_items_row_separator_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'cart_totals_box_inner_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table th, {{WRAPPER}} .xpro-woo-cart .cart_totals .shop_table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Checkout Button
		$this->start_controls_section(
			'section_checkout_button_style',
			array(
				'label' => __( 'Checkout Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'checkout_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button',
			)
		);

		$this->start_controls_tabs( 'tabs_checkout_button_style' );

		$this->start_controls_tab(
			'tab_checkout_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'checkout_button_bg_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button',
			)
		);

		$this->add_control(
			'checkout_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'checkout_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'checkout_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button',
			)
		);

		$this->add_control(
			'checkout_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'checkout_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'checkout_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_checkout_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'checkout_button_bg_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button:hover',
			)
		);

		$this->add_control(
			'checkout_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'checkout_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'checkout_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-woo-cart .cart_totals .checkout-button:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// Notices
		$this->start_controls_section(
			'notice_section_style',
			array(
				'label' => __( 'Notice', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'notices_txt_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .woocommerce-error li, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div',
			)
		);

		$this->add_control(
			'notices_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-info::before, .woocommerce-message::before, {{WRAPPER}} .xpro-woo-cart .woocommerce-error::before' => 'color: {{VALUE}}',
				),
			)
		);

		//color
		$this->add_control(
			'notices_txt_typography_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-error li, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-info' => 'color: {{VALUE}}',
				),
			)
		);

		//bg color
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'notices_bg_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .woocommerce-error, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper ul, {{WRAPPER}} .xpro-woo-cart .woocommerce-info',
			)
		);

		//border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'notices_box_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .woocommerce-error, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper ul, {{WRAPPER}} .xpro-woo-cart .woocommerce-info',
			)
		);

		//shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'notices_box_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-woo-cart .woocommerce-error, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper ul, {{WRAPPER}} .xpro-woo-cart .woocommerce-info',
			)
		);

		//border radius
		$this->add_control(
			'notices_box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-error, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper ul, {{WRAPPER}} .xpro-woo-cart .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//padding
		$this->add_responsive_control(
			'notices_box_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-error, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper ul, {{WRAPPER}} .xpro-woo-cart .woocommerce-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'notices_box_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .woocommerce-error, {{WRAPPER}} .xpro-woo-cart .woocommerce-info, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper div, {{WRAPPER}} .xpro-woo-cart .woocommerce-notices-wrapper ul, {{WRAPPER}} .xpro-woo-cart .woocommerce-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'return_to_shop_button_heading',
			array(
				'label'     => __( 'Return to Shop', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'return_to_shop_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward',
			)
		);

		$this->start_controls_tabs( 'tabs_return_to_shop_button_style' );

		$this->start_controls_tab(
			'tab_return_to_shop_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'return_to_shop_button_bg_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward',
			)
		);

		$this->add_control(
			'return_to_shop_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'return_to_shop_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'return_to_shop_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward',
			)
		);

		$this->add_control(
			'return_to_shop_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'return_to_shop_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'return_to_shop_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_return_to_shop_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'return_to_shop_button_bg_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward:hover',
			)
		);

		$this->add_control(
			'return_to_shop_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'return_to_shop_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'return_to_shop_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-woo-cart .return-to-shop .wc-backward:hover',
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

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		if ( ! function_exists( 'WC' ) || empty( WC()->cart ) ) {
			return;
		}

		if ( Plugin::$instance->editor->is_edit_mode() && WC()->cart->get_cart_contents_count() < 1 ) {
			$products = wc_get_products(
				array(
					'status' => array( 'publish' ),
					'type'   => array( 'simple' ),
					'return' => 'ids',
					'limit'  => 1,
				)
			);

		}

		?>
		<div class="xpro-woo-cart xpro-woo-cart-layout-<?php echo esc_attr( $settings['layout_type'] ); ?>">
		<?php
		do_action( 'woocommerce_before_cart' );

		?>

		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
				<tr>
					<th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'xpro-elementor-addons-pro' ); ?></span></th>
					<th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'xpro-elementor-addons-pro' ); ?></span></th>
					<th class="product-name"><?php esc_html_e( 'Product', 'xpro-elementor-addons-pro' ); ?></th>
					<th class="product-price"><?php esc_html_e( 'Price', 'xpro-elementor-addons-pro' ); ?></th>
					<th class="product-quantity"><?php esc_html_e( 'Quantity', 'xpro-elementor-addons-pro' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'xpro-elementor-addons-pro' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-remove">
								<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'xpro-elementor-addons-pro' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
							</td>

							<td class="product-thumbnail">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
								}
								?>
							</td>

							<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'xpro-elementor-addons-pro' ); ?>">
								<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
								} else {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
								}

								do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

								// Meta data.
								echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

								// Backorder notification.
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'xpro-elementor-addons-pro' ) . '</p>', $product_id ) );
								}
								?>
							</td>

							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'xpro-elementor-addons-pro' ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'xpro-elementor-addons-pro' ); ?>">
								<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $_product->get_max_purchase_quantity(),
											'min_value'    => '0',
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'xpro-elementor-addons-pro' ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr>
					<td colspan="6" class="actions">

						<?php if ( wc_coupons_enabled() && 'yes' === $settings['show_coupon'] ) { ?>
							<div class="coupon">
								<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'xpro-elementor-addons-pro' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'xpro-elementor-addons-pro' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'xpro-elementor-addons-pro' ); ?>"><?php esc_attr_e( 'Apply coupon', 'xpro-elementor-addons-pro' ); ?></button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>

						<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'xpro-elementor-addons-pro' ); ?>"><?php esc_html_e( 'Update cart', 'xpro-elementor-addons-pro' ); ?></button>

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>

		<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

		<div class="cart-collaterals">
			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_cart' ); ?>

		</div>

		<?php

	}
}
