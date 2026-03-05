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
class Vertical_Menu extends Widget_Base {

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
		return 'xpro-vertical-menu';
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
		return __( 'Vertical Menu', 'xpro-elementor-addons-pro' );
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
		return 'xi-verticle-menu xpro-widget-pro-label';
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
		return array( 'xpro-themer' );
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
		return array( 'menu', 'vertical', 'slide', 'sliding', 'nav', 'navigation' );
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
		return array( 'sliding-menu' );
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
					/* translators: 1$s: Title */
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
						/* translators: 1$s: Title */
						__( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'xpro-elementor-addons-pro' ),
						admin_url( 'nav-menus.php?action=edit&menu=0' )
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				)
			);
		}

		$this->add_control(
			'layout',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'accordion',
				'options'            => array(
					'accordion' => __( 'Accordion', 'xpro-elementor-addons-pro' ),
					'sliding'   => __( 'Sliding', 'xpro-elementor-addons-pro' ),
					'default'   => __( 'Dropdown', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'scroll_offset',
			array(
				'label'              => __( 'Scroll Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'size_units'         => array( 'px' ),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 5,
					),
				),
				'default'            => array(
					'size' => 100,
				),
			)
		);

		$this->add_control(
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
				'prefix_class' => 'elementor-align-',
				'default'      => 'center',
				'condition'    => array(
					'layout!' => 'accordion',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_align',
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
				'condition'    => array(
					'layout' => 'accordion',
				),
			)
		);

		$this->end_controls_section();

		//Style Menu
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'size' => 350,
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper,{{WRAPPER}} .xpro-elementor-vertical-menu-layout-default li .xpro-elementor-dropdown-menu',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wrapper_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper',
			)
		);

		$this->add_responsive_control(
			'wrapper_border_radius',
			array(
				'label'       => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_padding',
			array(
				'label'       => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', 'em', '%' ),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Style Menu
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
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li > a',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li:hover > a' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li:hover',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li.current_page_item > a,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li.current-menu-ancestor > a' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li.current_page_item,
					            {{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li.current-menu-ancestor',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'menu_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-layout-default li,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-layout-accordion .xpro-elementor-vertical-navbar li > a,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-layout-sliding li' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'menu_separator_size',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-layout-default li,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-layout-sliding li,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-layout-sliding li > a' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-layout-default li,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-layout-sliding li,
					 {{WRAPPER}} .xpro-elementor-vertical-menu-layout-accordion li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Close Button
		$this->start_controls_section(
			'section_toggle_style',
			array(
				'label'     => __( 'Back Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'sliding',
				),
			)
		);

		$this->add_control(
			'back_btn_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back_btn_background_size',
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
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back_btn_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'back_btn_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'back_btn_border',
				'selector' => '{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back',
			)
		);

		$this->add_control(
			'back_btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back_btn_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-vertical-menu-wrapper .back' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

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
	 * @since 0.1.8
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'vertical-menu/layout/frontend.php';

	}

}
