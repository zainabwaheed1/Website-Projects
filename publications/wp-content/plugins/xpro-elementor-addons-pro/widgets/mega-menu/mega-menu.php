<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Xpro Elementor Addons
 *
 * Elementor widget.
 *
 * @since 1.0.0
 */
class Mega_Menu extends Widget_Base {


	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-mega-menu';
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
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Mega Menu', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-restaurant-menu xpro-widget-pro-label';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
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
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return array( 'mega', 'menu', 'mega', 'megamenu' );
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$menus = $this->get_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'nav_menu',
				array(
					'label'        => __( 'Menu', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					'description'  => sprintf(
						/* translators: %s: Title */
						__( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'xpro-elementor-addons-pro' ),
						admin_url( 'nav-menus.php' )
					),
				)
			);
		} else {
			$this->add_control(
				'nav_menu',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => '<strong>' . __( 'There are no menus in your site.', 'xpro-elementor-addons-pro' ) . '</strong><br>' . sprintf(
						/* translators: %s: Title */
						__( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'xpro-elementor-addons-pro' ),
						admin_url( 'nav-menus.php?action=edit&menu=0' )
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				)
			);
		}

		$this->add_responsive_control(
			'align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'          => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'        => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'         => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
					'space-between' => array(
						'title' => __( 'Justified', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'prefix_class' => 'xpro-mega-menu-align%s-',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-mega-menu-toggle-wrapper, {{WRAPPER}} .xpro-mega-menu-wrapper .xpro-mega-menu-navbar' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .xpro-mega-menu-layout-horizontal .xpro-mega-menu-navbar-nav' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'     => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'horizontal',
				'separator' => 'before',
				'options'   => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'submenu_icon',
			array(
				'label'   => __( 'Submenu Indicator', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fas fa-chevron-down',
				'options' => array(
					'fas fa-chevron-down' => __( 'Chevron', 'xpro-elementor-addons-pro' ),
					'fas fa-angle-down'   => __( 'Angle', 'xpro-elementor-addons-pro' ),
					'fas fa-plus'         => __( 'Plus', 'xpro-elementor-addons-pro' ),
					'fas fa-sort-down'    => __( 'Sort', 'xpro-elementor-addons-pro' ),
					'xi xi-chevron-down'  => __( 'Chevron Light', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_responsive_menu',
			array(
				'label' => __( 'Responsive Menu', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'logo',
			array(
				'label'     => __( 'Logo', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->add_control(
			'logo_link_type',
			array(
				'label'     => __( 'Logo Link', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
					'custom'  => __( 'Custom URL', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'default',
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->add_control(
			'logo_link',
			array(
				'label'       => __( 'Custom Link', 'xpro-elementor-addons-pro' ),
				'show_label'  => false,
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => array(
					'url' => get_home_url(),
				),
				'condition'   => array(
					'responsive_breakpoint!' => array( 'none' ),
					'logo_link_type'         => 'custom',
				),
			)
		);

		$this->add_control(
			'hamburger_toggle_icon',
			array(
				'label'     => __( 'Toggle Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'separator' => 'before',
				'default'   => array(
					'value'   => 'fas fa-bars',
					'library' => 'solid',
				),
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->add_control(
			'hamburger_toggle_text',
			array(
				'label'   => __( 'Toggle Text', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Menu', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'hamburger_close_icon',
			array(
				'label'     => __( 'Close Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'separator' => 'before',
				'default'   => array(
					'value'   => 'fas fa-times',
					'library' => 'solid',
				),
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->add_control(
			'action_on_click',
			array(
				'label'              => __( 'Submenu Click', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'link',
				'separator'          => 'before',
				'options'            => array(
					'submenu' => __( 'Open Submenu', 'xpro-elementor-addons-pro' ),
					'link'    => __( 'Redirect To Self Link', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'responsive_breakpoint',
			array(
				'label'              => __( 'Breakpoint', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'tablet',
				'options'            => array(
					'mobile' => __( 'Mobile (767px >)', 'xpro-elementor-addons-pro' ),
					'tablet' => __( 'Tablet (1024px >)', 'xpro-elementor-addons-pro' ),
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'responsive_entrance_animation',
			array(
				'label'     => __( 'Entrance', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'  => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'toggle'    => false,
				'default'   => 'right',
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->end_controls_section();

		//Style General
		$this->start_controls_section(
			'section_menu_style',
			array(
				'label' => __( 'Menu', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper li a',
			)
		);

		$this->add_responsive_control(
			'wrapper_width',
			array(
				'label'       => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', 'vw' ),
				'render_type' => 'template',
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-mega-menu-layout-vertical .xpro-mega-menu-navbar-nav' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'layout' => 'vertical',
				),
			)
		);

		$this->add_responsive_control(
			'menu_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a > .xpro-menu-icon'   => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_indicator_size',
			array(
				'label'      => __( 'Indicator Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 20,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a > .xpro-submenu-indicator-wrap > i'   => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_menu_style' );

		$this->start_controls_tab(
			'tab_menu_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'menu_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a:hover',
			)
		);

		$this->add_control(
			'menu_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'active_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_background_active',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-navbar-nav > li.current-menu-item > a',
			)
		);

		$this->add_control(
			'menu_active_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'menu_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li.current-menu-item > a' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'menu_border',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a',
			//              'separator' => 'before',
			)
		);

		$this->add_control(
			'menu_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
				),
			)
		);

		$this->add_responsive_control(
			'menu_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'badge_heading',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-badge',
			)
		);

		$this->add_responsive_control(
			'badge_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Style Sub Menu
		$this->start_controls_section(
			'section_submenu_style',
			array(
				'label' => __( 'Sub Menu', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'submenu_typography',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li > a',
			)
		);

		$this->add_control(
			'submenu_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'show_submenu_notch',
			array(
				'label'        => __( 'Show Notch', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-has-dropdown > .xpro-submenu-panel:after' => 'content: "";',
				),
				'condition'    => array(
					'layout' => 'horizontal',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_submenu_style' );

		$this->start_controls_tab(
			'tab_submenu_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'submenu_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submenu_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-has-dropdown > .xpro-submenu-panel:after, {{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li > a,{{WRAPPER}} .xpro-mega-menu-navbar-nav > li > .xpro-submenu-panel:after',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submenu_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'submenu_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li > a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submenu_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li > a:hover',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submenu_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'submenu_active_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li.current-menu-item > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submenu_background_active',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li.current-menu-item > a',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'submenu_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li:not(:nth-last-child(1)) > a' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'submenu_separator_size',
			array(
				'label'      => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li:not(:nth-last-child(1)) > a' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'submenu_shadow',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel',
			)
		);

		$this->add_responsive_control(
			'submenu_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-submenu-panel > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Style Mega Menu
		$this->start_controls_section(
			'section_megamenu_style',
			array(
				'label' => __( 'Mega Menu', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'megamenu_max_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-megamenu-panel' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'megamenu_max_width',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-megamenu-panel' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'show_megamenu_notch',
			array(
				'label'        => __( 'Show Notch', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-has-dropdown > .xpro-megamenu-panel:after' => 'content: "";',
				),
				'condition'    => array(
					'layout' => 'horizontal',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'megamenu_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-megamenu-panel,{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-menu-has-dropdown > .xpro-megamenu-panel:after',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'megamenu_shadow',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-megamenu-panel',
			)
		);

		$this->add_responsive_control(
			'megamenu_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-wrapper .xpro-megamenu-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Toggle Button
		$this->start_controls_section(
			'section_toggle_style',
			array(
				'label'     => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'toggle_typography',
				'selector' => '{{WRAPPER}} .xpro-mega-menu-toggle-btn-text',
			)
		);

		$this->add_responsive_control(
			'toggle_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn > i'       => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_space',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn'       => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'toggle_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'toggle_border',
				'selector' => '{{WRAPPER}} button.xpro-mega-menu-toggle-btn',
			)
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-toggle-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Style Responsive Menu
		$this->start_controls_section(
			'section_responsive_menu_style',
			array(
				'label'     => __( 'Responsive Menu', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'responsive_breakpoint!' => array( 'none' ),
				),
			)
		);

		$this->add_control(
			'responsive_menu_width',
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
					'size' => 400,
				),
				'selectors'  => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-inner' => 'width: {{SIZE}}{{UNIT}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-inner' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'hide_icon',
			array(
				'label'        => __( 'Hide Menu Icon', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Off', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'separator'    => 'before',
				'selectors'    => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-menu-icon' => 'display: none;',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-menu-icon' => 'display: none;',
				),
			)
		);

		$this->add_control(
			'hide_badge',
			array(
				'label'        => __( 'Hide Menu Badge', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Off', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'selectors'    => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-menu-badge' => 'display: none;',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-menu-badge' => 'display: none;',
				),
			)
		);

		$this->add_control(
			'responsive_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f5f5',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-inner' => 'background-color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#00000069',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-overlay' => 'background-color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'responsive_close_heading',
			array(
				'label'     => __( 'Close', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'close_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn'       => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'close_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'close_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'close_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'close_border',
				'selector' => '{{WRAPPER}} button.xpro-mega-menu-closed-btn',
			)
		);

		$this->add_control(
			'close_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'close_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} button.xpro-mega-menu-closed-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'responsive_logo',
			array(
				'label'     => __( 'Logo', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'logo_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( '%', 'px', 'vw' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-mega-menu-logo' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'responsive_menu_heading',
			array(
				'label'     => __( 'Menu', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_responsive_menu_style' );

		$this->start_controls_tab(
			'responsive_menu_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'responsive_menu_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a > .xpro-menu-icon' => 'color: {{VALUE}} !important;',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a > .xpro-menu-icon' => 'color: {{VALUE}} !important;',
				),
				'condition' => array(
					'hide_icon!' => 'yes',
				),
			)
		);

		$this->add_control(
			'responsive_menu_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#b5b5b5',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a' => 'color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_menu_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f5f5',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a' => 'background: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_menu_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e6e6e6',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a' => 'border-bottom-color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'responsive_menu_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'responsive_menu_hover_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a:hover > .xpro-menu-icon' => 'color: {{VALUE}} !important;',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a:hover > .xpro-menu-icon' => 'color: {{VALUE}} !important;',
				),
				'condition' => array(
					'hide_icon!' => 'yes',
				),
			)
		);

		$this->add_control(
			'responsive_menu_hover_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a:hover' => 'color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_menu_hover_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a:hover' => 'background: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a:hover' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'responsive_menu_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'responsive_menu_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li.current-menu-item > a > .xpro-menu-icon' => 'color: {{VALUE}} !important;',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li.current-menu-item > a > .xpro-menu-icon' => 'color: {{VALUE}} !important;',
				),
				'condition' => array(
					'hide_icon!' => 'yes',
				),
			)
		);

		$this->add_control(
			'responsive_menu_active_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2b2b2b',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_menu_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f5f5',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-mega-menu-navbar-nav > li > a.current-menu-item > a' => 'background: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-mega-menu-navbar-nav > li > a.current-menu-item > a' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'responsive_submenu_heading',
			array(
				'label'     => __( 'Sub Menu', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_responsive_submenu_style' );

		$this->start_controls_tab(
			'responsive_submenu_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'responsive_submenu_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a2a2a2',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-submenu-panel > li > a' => 'color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-submenu-panel > li > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_submenu_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#efefef',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-submenu-panel > li > a' => 'background: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-submenu-panel > li > a' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_submenu_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff69',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet.xpro-mega-menu-wrapper .xpro-submenu-panel > li > a' => 'border-bottom-width:1px; border-bottom-color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile.xpro-mega-menu-wrapper .xpro-submenu-panel > li > a' => 'border-bottom-width:1px; border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'responsive_submenu_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'responsive_submenu_hover_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-submenu-panel > li > a:hover' => 'color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-submenu-panel > li > a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_submenu_hover_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-submenu-panel > li > a:hover' => 'background: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-submenu-panel > li > a:hover' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'responsive_submenu_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'responsive_submenu_active_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2b2b2b',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-submenu-panel > li.current-menu-item > a' => 'color: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-submenu-panel > li.current-menu-item > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'responsive_submenu_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#efefef',
				'selectors' => array(
					'(tablet) {{WRAPPER}} .xpro-mega-menu-responsive-tablet .xpro-submenu-panel > li.current-menu-item > a' => 'background: {{VALUE}};',
					'(mobile) {{WRAPPER}} .xpro-mega-menu-responsive-mobile .xpro-submenu-panel > li.current-menu-item > a' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	public function get_menus() {
		$list  = array();
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu ) {
			$list[ $menu->slug ] = $menu->name;
		}

		return $list;
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( $settings['nav_menu'] ) {
			require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'mega-menu/layout/frontend.php';
		}
	}
}
