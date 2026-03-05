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
class Woo_My_Account extends Widget_Base {

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
		return 'xpro-woo-my-account';
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
		return __( 'Woo My Account', 'xpro-elementor-addons-pro' );
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
		return 'xi-accounts xpro-widget-pro-label';
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
		return array( 'my-account', 'woo my account', 'woo', 'my account', 'registration', 'my account', 'login' );
	}

	public function customize_my_account_tabs( $menu_links ) {

		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_dashboard'] ) {
			unset( $menu_links['dashboard'] );
		}
		if ( 'yes' !== $settings['show_orders'] ) {
			unset( $menu_links['orders'] );
		}
		if ( 'yes' !== $settings['show_downloads'] ) {
			unset( $menu_links['downloads'] );
		}
		if ( 'yes' !== $settings['show_addresses'] ) {
			unset( $menu_links['edit-address'] );
		}
		if ( 'yes' !== $settings['show_account_details'] ) {
			unset( $menu_links['edit-account'] );
		}
		if ( 'yes' !== $settings['show_logout_link'] ) {
			unset( $menu_links['customer-logout'] );
		}

		return $menu_links;
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

		//notice
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
			'endpoint',
			array(
				'label'              => __( 'Preview Endpoint', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '',
				'options'            => self::get_endpoints(),
				'frontend_available' => true,
				'description'        => __( 'Select Live Preview Endpoint for my account', 'xpro-elementor-addons-pro' ),
			)
		);

		//tabs position
		$this->add_control(
			'tabs_position',
			array(
				'label'              => __( 'Tabs Position', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'left',
				'options'            => array(
					'left'  => __( 'Left', 'xpro-elementor-addons-pro' ),
					'right' => __( 'Right', 'xpro-elementor-addons-pro' ),
					'top'   => __( 'Top', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		//show dashboard
		$this->add_control(
			'show_dashboard',
			array(
				'label'              => __( 'Show Dashboard?', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		//show orders
		$this->add_control(
			'show_orders',
			array(
				'label'              => __( 'Show Orders?', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		//show downloads
		$this->add_control(
			'show_downloads',
			array(
				'label'              => __( 'Show Downloads?', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		//show addresses
		$this->add_control(
			'show_addresses',
			array(
				'label'              => __( 'Show Addresses?', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		//show account details
		$this->add_control(
			'show_account_details',
			array(
				'label'              => __( 'Show Account Details?', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'show_logout_link',
			array(
				'label'              => __( 'Show Logout Link?', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper',
			)
		);

		$this->add_responsive_control(
			'wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_nav_styling',
			array(
				'label' => __( 'Tab List', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nav_typography',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li a',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_main_bg_color',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nav_list_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation',
			)
		);

		$this->add_responsive_control(
			'outer_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'outer_spacing',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'nav_heading',
			array(
				'label'     => __( 'Nav', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'nav_tabs' );

		$this->start_controls_tab(
			'normal_nav_tabs',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'main_nav_txt_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_nav_bg_color',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'main_nav_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'active_nav_tabs',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'active_nav_txt_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul .is-active a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'active_nav_bg_color',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul .is-active',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'active_border_color',
				'label'    => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul .is-active',
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
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'inner_spacing',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-navigation ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		-

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content, {{WRAPPER}} .woocommerce-form',
			)
		);

		$this->add_control(
			'content_txt_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_link_color',
			array(
				'label'     => __( 'Link Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content, {{WRAPPER}} .woocommerce-form',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'content_border',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content, {{WRAPPER}} .woocommerce-form',
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content, {{WRAPPER}} .woocommerce-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content, {{WRAPPER}} .woocommerce-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content, {{WRAPPER}} .woocommerce-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_acc_style',
			array(
				'label' => __( 'Form', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		//tabs
		//login/signup
		$this->add_control(
			'form_heading',
			array(
				'label'     => __( 'Form Heading ', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_head_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content legend, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content h3',
			)
		);

		$this->add_control(
			'form_head_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content legend, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content h3' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'form_head_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content legend, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce-MyAccount-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//labels
		$this->add_control(
			'my_acc_label',
			array(
				'label'     => __( 'Labels', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .form-row label',
			)
		);

		$this->add_control(
			'tabs_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .form-row label' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'tabs_label_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields_style',
			array(
				'label' => __( 'Form Fields', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'field_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection',
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
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection__placeholder' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'field_border',
				'selector'  => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce  .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'field_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection',
			)
		);

		$this->add_responsive_control(
			'field_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .form-row .input-text, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .select2.select2-container .select2-selection' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_button_style',
			array(
				'label' => __( 'Form Buttons', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button',
			)
		);

		$this->add_responsive_control(
			'form_button_width',
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
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_form_button_style' );

		$this->start_controls_tab(
			'tab_form_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'form_button_bg_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button',
			)
		);

		$this->add_control(
			'form_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'form_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'form_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button',
			)
		);

		$this->add_control(
			'form_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'form_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'form_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'form_button_bg_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button:hover',
			)
		);

		$this->add_control(
			'form_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'form_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'form_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .button:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_notices_style',
			array(
				'label' => __( 'Notices', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'notice_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message',
			)
		);

		/** Form Errors */
		$this->add_control(
			'form_errors',
			array(
				'label'     => __( 'Errors', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'error_message_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error',
			)
		);

		$this->add_control(
			'error_message_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'error_message_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error:before' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'error_message_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error',
			)
		);

		$this->add_responsive_control(
			'error_message_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'error_message_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'error_message_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-error',
			)
		);

		/** Notices */
		$this->add_control(
			'form_notices',
			array(
				'label'     => __( 'Notices', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'notice_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message',
			)
		);

		$this->add_control(
			'notice_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'notice_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info:before, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message:before' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'notice_border',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message',
			)
		);

		$this->add_responsive_control(
			'notice_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'notice_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'notice_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-info, {{WRAPPER}} .xpro-woocommerce-my-account-wrapper .woocommerce .woocommerce-message',
			)
		);

		$this->end_controls_section();

	}

	public static function get_endpoints() {
		$endpoints = array(
			''             => __( 'Dashboard', 'xpro-elementor-addons-pro' ),
			'orders'       => __( 'Orders', 'xpro-elementor-addons-pro' ),
			'downloads'    => __( 'Downloads', 'xpro-elementor-addons-pro' ),
			'edit-address' => __( 'Addresses', 'xpro-elementor-addons-pro' ),
			'edit-account' => __( 'Account Details', 'xpro-elementor-addons-pro' )
		);

		return $endpoints;
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

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-my-account/layout/frontend.php';
	}
}
