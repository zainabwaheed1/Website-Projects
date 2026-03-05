<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
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
class Preloader extends Widget_Base {

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
		return 'xpro-preloader';
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
		return __( 'Preloader', 'xpro-elementor-addons-pro' );
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
		return 'xi-image-slider xpro-widget-pro-label';
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
		return array( 'preloader', 'loader' );
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
			'preloader_layout',
			array(
				'label'   => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'      => esc_html__( 'Layout 1', 'xpro-elementor-addons-pro' ),
					'2'      => esc_html__( 'Layout 2', 'xpro-elementor-addons-pro' ),
					'3'      => esc_html__( 'Layout 3', 'xpro-elementor-addons-pro' ),
					'4'      => esc_html__( 'Layout 4', 'xpro-elementor-addons-pro' ),
					'5'      => esc_html__( 'Layout 5', 'xpro-elementor-addons-pro' ),
					'6'      => esc_html__( 'Layout 6', 'xpro-elementor-addons-pro' ),
					'7'      => esc_html__( 'Layout 7', 'xpro-elementor-addons-pro' ),
					'8'      => esc_html__( 'Layout 8', 'xpro-elementor-addons-pro' ),
					'9'      => esc_html__( 'Layout 9', 'xpro-elementor-addons-pro' ),
					'10'     => esc_html__( 'Layout 10', 'xpro-elementor-addons-pro' ),
					'custom' => esc_html__( 'Custom', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'preloader_content',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
				'condition'   => array(
					'preloader_layout' => 'custom',
				),
			)
		);

		$this->add_control(
			'ink_show',
			array(
				'label'        => esc_html__( 'Ink Effect', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'preloader_animate_timeout',
			array(
				'label'              => __( 'Timeout(s)', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'px'                 => array(
					'range' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 0.1,
					),
				),
				'default'            => array(
					'size' => 1,
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'show_editor',
			array(
				'label'              => esc_html__( 'Show In Editor', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'          => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
				'separator'          => 'before',
			)
		);

		$this->end_controls_section();

		//Styling
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
				'name'     => 'preloader_background',
				'label'    => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-preloader',
			)
		);

		$this->add_control(
			'preloader_heading_options',
			array(
				'label'     => esc_html__( 'Spin', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'preloader_Spin_color',
			array(
				'label'     => __( 'Spin Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preloader-layout-1 .xpro-preloader-box:after,
					{{WRAPPER}} .xpro-preloader-layout-3 .xpro-preloader-box > span,
					{{WRAPPER}} .xpro-preloader-layout-9 .xpro-loader-spinner span,
					{{WRAPPER}} .xpro-preloader-layout-8 .xpro-preloader span,
					{{WRAPPER}} .xpro-preloader-layout-9 .xpro-loader-spinner span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-6 #spinner'                 => 'stroke: {{VALUE}}',
				),
				'condition' => array(
					'preloader_layout!' => array( '2', '4', '5', '7', '10' ),
				),
			)
		);

		$this->add_control(
			'preloader_Spin_color-1',
			array(
				'label'     => __( 'Spin One Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preloader-layout-2 .dot-1,
					{{WRAPPER}} .xpro-preloader-layout-4 .xpro-loader .xpro-loader-ball'                           => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-5 .xpro-loader-spinner .blob.blob-top,
					{{WRAPPER}} .xpro-preloader-layout-5 .xpro-loader-spinner .blob.blob-bottom,
					{{WRAPPER}} .xpro-preloader-layout-5 .xpro-loader-spinner .blob.blob-left' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-7 .xpro-loader-box'                                        => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-10 .xpro-loader-spinner.spinner-1'                         => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'preloader_layout' => array( '2', '4', '5', '7', '10' ),
				),
			)
		);

		$this->add_control(
			'preloader_Spin_color-2',
			array(
				'label'     => __( 'Spin Two Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preloader-layout-2 .dot-2,
					{{WRAPPER}} .xpro-preloader-layout-4 .xpro-loader .xpro-loader-ball-wrapper:nth-child(2) .xpro-loader-ball' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-5 .xpro-loader-spinner .blob-move'                                      => 'border-color: {{VALUE}}; background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-7 .xpro-loader-box:before'                                              => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-10 .xpro-loader-spinner.spinner-2'                                      => 'border-right-color: {{VALUE}}',
				),
				'condition' => array(
					'preloader_layout' => array( '2', '4', '5', '7', '10' ),
				),
			)
		);

		$this->add_control(
			'preloader_Spin_color-3',
			array(
				'label'     => __( 'Spin Three Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preloader-layout-2 .dot-3,
					{{WRAPPER}} .xpro-preloader-layout-4 .xpro-loader .xpro-loader-ball-wrapper:nth-child(3) .xpro-loader-ball' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-7 .xpro-loader-box:after'                                               => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-preloader-layout-10 .xpro-loader-spinner.spinner-3'                                      => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'preloader_layout' => array( '2', '4', '7', '10' ),
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'preloader/layout/frontend.php';

	}

}
