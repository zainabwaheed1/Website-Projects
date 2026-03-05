<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

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
class Woo_Category extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-woo-category';
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
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Woo Category Grid', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
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
		return array( 'woo', 'products category', 'woo products category' );
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
	public function get_style_depends() {

		return array( 'cubeportfolio', 'animate' );
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
		return array( 'cubeportfolio' );
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
			'layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'  => __( 'Layout 1', 'xpro-elementor-addons-pro' ),
					'2'  => __( 'Layout 2', 'xpro-elementor-addons-pro' ),
					'3'  => __( 'Layout 3', 'xpro-elementor-addons-pro' ),
					'4'  => __( 'Layout 4', 'xpro-elementor-addons-pro' ),
					'5'  => __( 'Layout 5', 'xpro-elementor-addons-pro' ),
					'6'  => __( 'Layout 6', 'xpro-elementor-addons-pro' ),
					'7'  => __( 'Layout 7', 'xpro-elementor-addons-pro' ),
					'8'  => __( 'Layout 8', 'xpro-elementor-addons-pro' ),
					'9'  => __( 'Layout 9', 'xpro-elementor-addons-pro' ),
					'10' => __( 'Layout 10', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_responsive_control(
			'column_grid',
			array(
				'label'              => __( 'Columns', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'desktop_default'    => '3',
				'tablet_default'     => '2',
				'mobile_default'     => '1',
				'options'            => array(
					'1' => __( '1', 'xpro-elementor-addons-pro' ),
					'2' => __( '2', 'xpro-elementor-addons-pro' ),
					'3' => __( '3', 'xpro-elementor-addons-pro' ),
					'4' => __( '4', 'xpro-elementor-addons-pro' ),
					'5' => __( '5', 'xpro-elementor-addons-pro' ),
					'6' => __( '6', 'xpro-elementor-addons-pro' ),
				),
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail',
				'exclude' => array( 'custom' ),
				'default' => 'medium',
			)
		);

		//show title
		$this->add_control(
			'show_title',
			array(
				'label'        => __( 'Show Title', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		//show count
		$this->add_control(
			'show_count',
			array(
				'label'        => __( 'Show Count', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		//show content
		$this->add_control(
			'show_content',
			array(
				'label'        => __( 'Show Description', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		//content length
		$this->add_control(
			'content_length',
			array(
				'label'     => __( 'Description Length', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 500,
				'step'      => 5,
				'default'   => 10,
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		//show cta button
		$this->add_control(
			'show_cta',
			array(
				'label'        => __( 'Show Shop Button', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'btn_txt',
			array(
				'label'     => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'View All', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition' => array(
					'show_cta' => 'yes',
				),
			)
		);

		$this->add_control(
			'clickable_div',
			array(
				'label'        => __( 'Make Full Div Clickable', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator'    => 'before',
				'default'      => 'no',
			)
		);

		$this->end_controls_section();

		//query
		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'exclude',
			array(
				'label'       => __( 'Exclude', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => $this->taxonomies_exclude(),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => xpro_elementor_get_post_orderby_options(),
				'default' => 'date',

			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				),
				'default' => 'desc',

			)
		);

		//category with image
		$this->add_control(
			'cat_only_image',
			array(
				'label'        => __( 'Category With Image', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		//term per page
		$this->add_control(
			'term_per_page',
			array(
				'label'   => __( 'Items Per Page', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
			)
		);

		$this->add_control(
			'hide_empty',
			array(
				'label'        => __( 'Hide Empty', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'              => __( 'Image Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh', '%' ),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-img' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'              => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 15,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'item_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-item',
				'condition' => array(
					'layout' => array( '1' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-item',
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-item' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'overlay_title',
			array(
				'label'     => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		//border color
		$this->add_control(
			'border_overlay_color',
			array(
				'label'     => __( 'Border Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec::before, {{WRAPPER}} .xpro-woo-product-cat-layout-10 .xpro-woo-product-grid-item:hover .xpro-woo-product-grid-content-sec::after, {{WRAPPER}} .xpro-woo-product-cat-layout-10 .xpro-woo-product-grid-item:hover .xpro-woo-product-grid-inner-content-sec' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '5', '9', '10' ),
				),
			)
		);

		$this->start_controls_tabs(
			'overlay_style_tabs'
		);

		$this->start_controls_tab(
			'overlay_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_color',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-img-section::after',
			)
		);

		//border color

		$this->end_controls_tab();

		$this->start_controls_tab(
			'overlay_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_hover_color',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-img:hover .xpro-woo-product-img-section::after, {{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-item:hover .xpro-woo-product-img-section::after',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		//horizontal alignments
		$this->add_responsive_control(
			'horizontal_alignment',
			array(
				'label'        => __( 'Horizontal Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'flex-start'   => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'  => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors_dictionary' => array(
					'flex-start' => 'text-align: left; align-items: flex-start;',
					'center' => 'text-align: center; align-items: center;',
					'flex-end' => 'text-align: right; align-items: flex-end;',
				),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec,
                    {{WRAPPER}} .xpro-woo-product-grid-inner-content-sec' => '{{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'vertical_alignment',
			array(
				'label'        => __( 'Vertical Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'flex-start'   => array(
						'title' => __( 'Top', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end'  => array(
						'title' => __( 'Bottom', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec,
                    {{WRAPPER}} .xpro-woo-product-grid-inner-content-sec' => 'justify-content: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_height',
			array(
				'label'              => __( 'Content Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh', '%' ),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition' => [
					'layout' => ['1', '3'],
				]
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-woo-product-grid-content-sec',
			)
		);

		$this->add_control(
			'content_border_bg',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-cat-layout-4 .xpro-woo-product-grid-content-sec::before,
                    .xpro-woo-product-cat-layout-6 .xpro-woo-product-grid-content-sec::before' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-woo-product-cat-layout-4 .xpro-woo-product-grid-content-sec::after,
                    .xpro-woo-product-cat-layout-6 .xpro-woo-product-grid-content-sec::after' => 'border-right-color: {{VALUE}}; border-left-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-woo-product-cat-layout-7 .xpro-woo-product-grid-content-sec::before' => 'background-color: {{VALUE}};',
				),
				'condition' => [
					'layout' => ['4', '6', '7'],
				]
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'content_box_shadow',
				'label'     => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec',
				'condition' => [
					'layout!' => ['4', '6'],
				]
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'selector'  => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec',
				'condition' => [
					'layout!' => ['4', '6'],
				]
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => [
					'layout!' => ['4', '6'],
				]
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec,
                    {{WRAPPER}} .xpro-woo-product-grid-inner-content-sec' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-content-sec' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ---
		$this->add_control(
			'heading_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-title',
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-title:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_title' => array( 'yes' ),
				),
			)
		);
		// ---

		$this->add_control(
			'desc_excerpt',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-excerpt',
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-excerpt' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'excerpt_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-grid-wrapper .xpro-woo-product-grid-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//button
		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_cta' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn',
			)
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn:hover,{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn:hover,{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn:hover,{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-product-grid-shop-btn .xpro-woo-cart-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Exclude Taxonomy
	 *
	 * @return array
	 */

	public static function taxonomies_exclude() {

		$list             = array();
		$terms            = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'order'      => 'asc',
				'hide_empty' => false,
			)
		);

		foreach ( $terms as $value ) {
			$list[ $value->term_id ] = $value->name;
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

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		global $product, $post;
		$post_type = $post->post_type;

		$get_all_product = array(
			'orderby'     => 'date',
			'numberposts' => - 1,
			'order'       => 'ASC',
			'return'      => 'ids',
			'status'      => 'publish'
		);

		$get_all_product_ids = wc_get_products( $get_all_product );

		if ( empty( $product ) && Plugin::$instance->editor->is_edit_mode() && ( empty( $get_all_product_ids ) ) ) {
			?>
			<div class="xpro-alert xpro-alert-warning" role="alert">
				<span class="xpro-alert-title">
					<?php esc_html_e( 'Products Not Found', 'xpro-elementor-addons-pro' ); ?>
				</span>
				<span class="xpro-alert-description">
					<?php esc_html_e( 'You dont have any product please add some products first. This text will disappear after closing the editor mode.', 'xpro-elementor-addons-pro' ); ?>
				</span>
			</div>
			<?php
			return;
		}
		?>

		<div class="xpro-product-grid-wrapper xpro-woo-product-cat-wrapper xpro-woo-product-cat-layout-<?php echo esc_attr( $settings['layout'] ); ?>">

			<div class="xpro-woo-product-grid-main xpro-woo-product-cat-inner cbp">
				<?php
				require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-category/layout/frontend.php';
				?>
			</div>
		</div>

		<?php

	}
}
