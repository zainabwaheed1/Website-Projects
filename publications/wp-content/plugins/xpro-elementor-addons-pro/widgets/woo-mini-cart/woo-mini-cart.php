<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
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
class Woo_Mini_Cart extends Widget_Base {

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
		return 'xpro-woo-mini-cart';
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
		return __( 'Woo Mini Cart', 'xpro-elementor-addons-pro' );
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
		return array( 'off-canvas', 'cart', 'mini cart', 'off canvas', 'menu' );
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

		//cart style
		$this->add_control(
			'cart_style',
			array(
				'label'              => __( 'Style', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'light',
				'options'            => array(
					'light' => __( 'Light', 'xpro-elementor-addons-pro' ),
					'dark'  => __( 'Dark', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		//cart_type
		$this->add_control(
			'cart_layout',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'dropdown',
				'options'            => array(
					'dropdown'   => __( 'Dropdown', 'xpro-elementor-addons-pro' ),
					'modal'      => __( 'Modal', 'xpro-elementor-addons-pro' ),
					'off_canvas' => __( 'Off Canvas', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'              => __( 'Off-Canvas Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'slideRight',
				'options'            => array(
					'slideRight' => __( 'Slide Right', 'xpro-elementor-addons-pro' ),
					'slideLeft'  => __( 'Slide Left', 'xpro-elementor-addons-pro' ),
					'pushRight'  => __( 'Push Right', 'xpro-elementor-addons-pro' ),
					'pushLeft'   => __( 'Push Left', 'xpro-elementor-addons-pro' ),
			//                  'fullFadeIn'     => __( 'Fullscreen FadeIn', 'xpro-elementor-addons-pro' ),
			//                  'fullFromTop'    => __( 'From Top', 'xpro-elementor-addons-pro' ),
			//                  'fullFromBottom' => __( 'From Bottom', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'cart_layout' => array( 'off_canvas' ),
				),
				'frontend_available' => true,
			)
		);

		//show cart on
		$this->add_control(
			'show_cart_on',
			array(
				'label'              => __( 'Show Cart On', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'click',
				'options'            => array(
					'click' => __( 'Click', 'xpro-elementor-addons-pro' ),
					'hover' => __( 'Hover', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'cart_layout' => array( 'dropdown' ),
				),
				'frontend_available' => true,
			)
		);

		//automatically open cart
		$this->add_control(
			'automatically_open_cart',
			array(
				'label'              => __( 'Automatically Open Cart', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Open cart every time an item is added.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'no',
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'toggle_heading',
			array(
				'label'     => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		//select text type
		$this->add_control(
			'select_txt_type',
			array(
				'label'              => __( 'Text Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'subtotal',
				'options'            => array(
					'none'     => __( 'None', 'xpro-elementor-addons-pro' ),
					'text'     => __( 'Custom Text', 'xpro-elementor-addons-pro' ),
					'subtotal' => __( 'Sub total', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		//text
		$this->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => __( 'My Cart', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Cart Text Here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'select_txt_type' => array( 'text' ),
				),
			)
		);

		//show badge
		$this->add_control(
			'show_badge',
			array(
				'label'              => __( 'Show Badge', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
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
				'prefix_class' => 'xpro-mini-cart%s-align-',
				'default'      => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-wrapper' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-shopping-bag',
					'library' => 'solid',
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'   => array(
					'size' => 10,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-align-icon-right .xpro-elementor-hamburger-toggle-media' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-align-icon-left .xpro-elementor-hamburger-toggle-media'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'xpro_elementor_hamburger_content',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
			)
		);

		$this->add_control(
			'close_heading',
			array(
				'label'     => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'close_icon',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-times',
					'library' => 'solid',
				),
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

		$this->add_responsive_control(
			'width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'max_width',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'offset_x',
			array(
				'label'      => __( 'Offset-X', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'condition'          => array(
					'cart_layout' => array( 'dropdown' ),
					'show_cart_on' => array( 'click' ),

				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner.xpro-mini-cart-content-inner ' => 'transform:translateX({{SIZE}}{{UNIT}})',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-inner',
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-overlay' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'cart_layout!' => 'dropdown',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-inner',
			)
		);

		$this->add_responsive_control(
			'wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'cart_layout' => array( 'dropdown', 'modal' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		//seprator border width
		$this->add_responsive_control(
			'seprator_border_width',
			array(
				'label'      => __( 'Seprator Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
					'%'  => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-items .woocommerce-mini-cart-item' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		//border color
		$this->add_control(
			'seprator_border_color',
			array(
				'label'     => __( 'Seprator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-items .woocommerce-mini-cart-item' => 'border-color: {{VALUE}};',
				),
			)
		);

		//----
		//heading

		$this->add_control(
			'cart_content_heading',
			array(
				'label'     => __( 'Heading', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_heading_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cart_content_heading_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading',
			)
		);

		$this->add_control(
			'cart_content_heading_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cart_content_heading_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cart_content_heading_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading',
			)
		);

		$this->add_responsive_control(
			'cart_content_heading_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_content_heading_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----
		//img

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
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-left-item-sec' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----

		//title

		$this->add_control(
			'cart_content_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-title',
			)
		);

		$this->add_control(
			'cart_content_title_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_content_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mini-cart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----
		//qty

		$this->add_control(
			'cart_content_qty',
			array(
				'label'     => __( 'Quantity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_qty_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mc-quantity',
			)
		);

		$this->add_control(
			'cart_content_qty_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mc-quantity' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_content_qty_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-mc-quantity' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		// ----

		//remove btn

		$this->add_control(
			'cart_content_remove_btn',
			array(
				'label'     => __( 'Remove Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_remove_btn_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .remove_from_cart_button',
			)
		);

		$this->add_control(
			'cart_content_remove_btn_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .remove_from_cart_button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_content_remove_btn_hv_color',
			array(
				'label'     => __( 'Text Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .remove_from_cart_button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'cart_content_remove_btn_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .remove_from_cart_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----

		//subtotal
		$this->add_control(
			'cart_content_subtotal',
			array(
				'label'     => __( 'Subtotal', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cart_content_subtotal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_subtotal_typography',
				'label'    => __( 'Heading Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total strong',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_subtotal_price_typography',
				'label'    => __( 'Price Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total .woocommerce-Price-amount > bdi',
			)
		);

		$this->add_control(
			'cart_content_subtotal_color',
			array(
				'label'     => __( 'Heading Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cart_content_subtotal_price_color',
			array(
				'label'     => __( 'Price Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total .woocommerce-Price-amount' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cart_content_subtotal_color_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total',
			)
		);

		//border radius
		$this->add_control(
			'cart_content_subtotal_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//padding
		$this->add_responsive_control(
			'cart_content_subtotal_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'cart_content_subtotal_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----

		$this->add_control(
			'cart_content_empty_msg',
			array(
				'label'     => __( 'Empty Message', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_content_empty_msg_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__empty-message',
			)
		);

		$this->add_control(
			'cart_content_empty_msg_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__empty-message' => 'color: {{VALUE}};',
				),
			)
		);

		//padding
		$this->add_responsive_control(
			'cart_content_empty_msg_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__empty-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'cart_content_empty_msg_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__empty-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//cart btns
		// -------------------------------------------------

		$this->start_controls_section(
			'section_view_cart_button_style',
			array(
				'label' => __( 'View Cart Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'view_cart_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart',
			)
		);

		$this->add_responsive_control(
			'view_cart_button_width',
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
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_view_cart_button_style' );

		$this->start_controls_tab(
			'tab_view_cart_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'view_cart_button_bg_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart',
			)
		);

		$this->add_control(
			'view_cart_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'view_cart_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'view_cart_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart',
			)
		);

		$this->add_control(
			'view_cart_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'view_cart_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'view_cart_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_view_cart_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'view_cart_button_bg_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart:hover',
			)
		);

		$this->add_control(
			'view_cart_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'view_cart_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'view_cart_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-view-cart:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// -------------------------------------------------

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
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout',
			)
		);

		$this->add_responsive_control(
			'checkout_button_custom_width',
			array(
				'label'      => __( 'Custom Width', 'xpro-elementor-addons-pro' ),
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
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout' => 'width: {{SIZE}}{{UNIT}};',
				),
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
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout',
			)
		);

		$this->add_control(
			'checkout_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout' => 'color: {{VALUE}}',
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
				'selector'    => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'checkout_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout',
			)
		);

		$this->add_control(
			'checkout_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout:hover',
			)
		);

		$this->add_control(
			'checkout_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'checkout_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .woocommerce-mini-cart__buttons .xpro-mc-checkout:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_toggle',
			array(
				'label' => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'toggle_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-toggle',
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle-media > svg' => 'width: {{SIZE}}{{UNIT}}; height:auto',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle-media'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'toggle_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle svg' => 'fill: {{VALUE}};',
				),
			)
		);

		//icon color
		$this->add_control(
			'toggle_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-minicart-icon'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-minicart-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-toggle,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill:before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide::before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'toggle_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle:hover, {{WRAPPER}} .xpro-elementor-hamburger-toggle:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle:hover svg, {{WRAPPER}} .xpro-elementor-hamburger-toggle:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		//toggle hover icon color
		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Icon Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-minicart-icon:hover'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-minicart-icon svg:hover' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-animation-none:hover,{{WRAPPER}} .xpro-button-2d-animation:hover,
								{{WRAPPER}} .xpro-elementor-button-animation-none:focus,{{WRAPPER}} .xpro-button-2d-animation:focus,
								{{WRAPPER}} .xpro-button-bg-animation::before,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::after,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::after,{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide,
								{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:hover,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill',
			)
		);

		$this->add_control(
			'toggle_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'toggle_border!'          => '',
					'hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle:hover, {{WRAPPER}} .xpro-elementor-hamburger-toggle:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_hover_underline',
			array(
				'label'     => __( 'Line Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'hover_animation'        => 'unique',
					'hover_unique_animation' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hover_animation',
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
			'hover_2d_css_animation',
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
					'hover_animation' => '2d-transition',
				),
			)
		);

		$this->add_control(
			'hover_background_css_animation',
			array(
				'label'     => __( 'Animation', 'xpro-elementor-addons-pro' ),
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
					'hover_animation' => 'background-transition',
				),
			)
		);

		$this->add_control(
			'hover_unique_animation',
			array(
				'label'     => __( 'Animation', 'xpro-elementor-addons-pro' ),
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
					'hover_animation' => 'unique',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'toggle_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-hamburger-toggle',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'toggle_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-toggle',
			)
		);

		$this->add_responsive_control(
			'toggle_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----

		$this->add_control(
			'badge_style',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_btn_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-cart-btn-badge',
			)
		);

		$this->add_control(
			'badge_btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-cart-btn-badge' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'badge_btn_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-cart-btn-badge' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-cart-btn-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_btn_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-cart-btn-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_btn_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-mini-cart-wrapper .xpro-cart-btn-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_close',
			array(
				'label' => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'close_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_close_style' );

		$this->start_controls_tab(
			'close_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'close_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'close_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'close_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'close_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover svg, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'close_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus',
			)
		);

		$this->add_control(
			'close_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'close_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'close_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn',
			)
		);

		$this->add_responsive_control(
			'close_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-mini-cart/layout/frontend.php';
	}
}
