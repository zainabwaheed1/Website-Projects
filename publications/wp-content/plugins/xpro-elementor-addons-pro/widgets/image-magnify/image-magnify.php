<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Utils;
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
class Image_Magnify extends Widget_Base {

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
		return 'xpro-image-magnify';
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
		return __( 'Image Magnify', 'xpro-elementor-addons-pro' );
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
		return 'xi-add-new-item xpro-widget-pro-label';
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
		return array( 'image', 'magnify', 'image-magnify' );
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
		return array( 'elevatezoom' );
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

		$this->add_control(
			'zoomType',
			array(
				'label'              => esc_html__( 'Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'inner',
				'frontend_available' => true,
				'render_type'        => 'template',
				'options'            => array(
					'inner'   => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
					'default' => esc_html__( 'Outside', 'xpro-elementor-addons-pro' ),
					'lens'    => esc_html__( 'Lens', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'magnify_image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'separator' => 'after',
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'zoomWindowPosition',
			array(
				'label'              => esc_html__( 'Position', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => '1',
				'options'            => array(
					'1'  => esc_html__( 'Right Top', 'xpro-elementor-addons-pro' ),
					'3'  => esc_html__( 'Right Bottom', 'xpro-elementor-addons-pro' ),
					'11' => esc_html__( 'Left Top', 'xpro-elementor-addons-pro' ),
					'9'  => esc_html__( 'Left Right', 'xpro-elementor-addons-pro' ),
					'13' => esc_html__( 'Top Left', 'xpro-elementor-addons-pro' ),
					'15' => esc_html__( 'Top Right', 'xpro-elementor-addons-pro' ),
					'7'  => esc_html__( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'5'  => esc_html__( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'zoomType' => 'default',
				),
			)
		);

		$this->add_control(
			'scrollZoom',
			array(
				'label'              => esc_html__( 'Scroll Zoom', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'zoomType' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'zoomWindowSize',
			array(
				'label'              => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'render_type'        => 'template',
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'            => array(
					'size' => 200,
				),
				'condition'          => array(
					'zoomType' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'zoomWindowOffetx',
			array(
				'label'              => __( 'OffsetX', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'render_type'        => 'template',
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'            => array(
					'size' => 0,
				),
				'condition'          => array(
					'zoomType' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'zoomWindowOffety',
			array(
				'label'              => __( 'OffsetY', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'render_type'        => 'template',
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'            => array(
					'size' => 0,
				),
				'condition'          => array(
					'zoomType' => 'default',
				),
			)
		);

		$this->add_control(
			'lensShape',
			array(
				'label'              => esc_html__( 'Lens Shape', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => 'square',
				'options'            => array(
					'square' => esc_html__( 'Square', 'xpro-elementor-addons-pro' ),
					'round'  => esc_html__( 'Round', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'zoomType' => 'lens',
				),
			)
		);

		$this->add_responsive_control(
			'lensSize',
			array(
				'label'              => __( 'Lens Size', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'render_type'        => 'template',
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
				),
				'default'            => array(
					'size' => 200,
				),
				'condition'          => array(
					'zoomType' => 'lens',
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
			'max-width',
			array(
				'label'      => esc_html__( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-image-magnify' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'Image_magnify_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-image-magnify-img' => ' opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Image_magnify_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-image-magnify-img',
			)
		);

		$this->add_control(
			'Image_magnify_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-image-magnify-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'Image_magnify_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-image-magnify-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'image-magnify/layout/frontend.php';

	}

}
