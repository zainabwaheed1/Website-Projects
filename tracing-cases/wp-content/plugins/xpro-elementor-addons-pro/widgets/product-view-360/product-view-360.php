<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
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
class Product_View_360 extends Widget_Base {

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
		return 'xpro-product-view-360';
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
		return __( '360° Product View', 'xpro-elementor-addons-pro' );
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
		return 'xi-product-view xpro-widget-pro-label';
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
		return array( '360', 'product', 'view', 'scroll', 'rotation' );
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
		return array( 'spritespin', 'elementor-waypoints', 'waypoints' );
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

		//General
		$this->start_controls_section(
			'section_content_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'source_type',
			array(
				'label'              => __( 'Source Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'remote',
				'label_block'        => true,
				'options'            => array(
					'local'  => __( 'Local Images', 'xpro-elementor-addons-pro' ),
					'remote' => __( 'Remote Images', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'images',
			array(
				'label'     => __( 'Add Images', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::GALLERY,
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'source_type' => 'local',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'exclude'   => array( 'custom' ),
				'default'   => 'full',
				'condition' => array(
					'source_type' => 'local',
				),
			)
		);

		$this->add_control(
			'remote_images',
			array(
				'type'          => Controls_Manager::URL,
				'label'         => __( 'Images Source', 'xpro-elementor-addons-pro' ),
				'label_block'   => true,
				'description'   => __( 'You should named all files with same digit serial numeric number, e.g: image-01.jpg, image-35.jpg', 'xpro-elementor-addons-pro' ),
				'show_external' => false,
				'placeholder'   => __( 'https://example.com/image-{frame}.jpg', 'xpro-elementor-addons-pro' ),
				'default'       => array( 'url' => 'http://conti.derhuman.jus.gov.ar/areas/institucional/examples/images/rad_zoom_{frame}' ),
				'dynamic'       => array( 'active' => true ),
				'condition'     => array(
					'source_type' => 'remote',
				),
			)
		);

		$this->add_control(
			'digit_number',
			array(
				'label'       => esc_html__( 'File Name Digit', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Please select digit number of your file name. Such as if 001.jpg then you have to select 3', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 3,
				'options'     => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				),
				'condition'   => array(
					'source_type' => 'remote',
				),
			)
		);

		$this->add_control(
			'start_frame',
			array(
				'label'     => __( 'Start Frame', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 1,
				),
				'condition' => array(
					'source_type' => 'remote',
				),
			)
		);

		$this->add_control(
			'end_frame',
			array(
				'label'     => __( 'End Frame', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 2,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 34,
				),
				'condition' => array(
					'source_type' => 'remote',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_settings',
			array(
				'label' => __( 'Settings', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'animate',
			array(
				'label'       => __( 'Animate', 'xpro-elementor-addons-pro' ),
				'default'     => 'yes',
				'type'        => Controls_Manager::SWITCHER,
				'description' => __( 'Starts the animation automatically on load', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'frame_time',
			array(
				'label'       => __( 'Frame Time', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Time in ms between updates. e.g. 40 is exactly 25 FPS', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'condition'   => array(
					'animate' => 'yes',
				),
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'     => __( 'Loop', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'animate' => 'yes',
				),
			)
		);

		$this->add_control(
			'stop_frame',
			array(
				'label'       => __( 'Stop Frame', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Stops the animation on that frame if `loop` is false', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'condition'   => array(
					'loop!' => 'yes',
				),
			)
		);

		$this->add_control(
			'reverse',
			array(
				'label'       => __( 'Reverse', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => __( 'Animation playback is reversed', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'animate' => 'yes',
				),
			)
		);

		$this->add_control(
			'retain_animate',
			array(
				'label'       => __( 'Retain Animate', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Retains the animation after user interaction', 'xpro-elementor-addons-pro' ),
				'default'     => 'yes',
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => array(
					'animate' => 'yes',
				),
			)
		);

		$this->add_control(
			'ease',
			array(
				'label' => __( 'Easing', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'mouse_option',
			array(
				'label'     => esc_html__( 'Mouse Option', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'drag',
				'separator' => 'before',
				'options'   => array(
					''      => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
					'drag'  => esc_html__( 'Drag', 'xpro-elementor-addons-pro' ),
					'move'  => esc_html__( 'Move', 'xpro-elementor-addons-pro' ),
					'wheel' => esc_html__( 'Wheel', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'sense',
			array(
				'label'       => __( 'Reverse', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Sensitivity factor for user interaction', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => array(
					'mouse_option' => array( 'drag', 'move' ),
				),
			)
		);

		$this->add_control(
			'loader',
			array(
				'label'     => __( 'Hide Loader', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => array(
					'{{WRAPPER}} .spritespin-progress' => 'display: none !important;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => esc_html__( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Top', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Middle', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Bottom', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-h-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-xpro-product-view-360' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'       => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', 'vw' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-product-360-inner > canvas' => 'width: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .xpro-product-360-inner' => 'width: {{SIZE}}{{UNIT}};',
				),
				'render_type' => 'template',
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'       => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 50,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-product-360-inner > canvas' => 'height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .xpro-product-360-inner' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
				'render_type' => 'template',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_wrapper',
			array(
				'label' => esc_html__( 'Wrapper', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'object_position',
			array(
				'label'                => __( 'Object Position', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
					'top-left'      => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center'    => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'     => __( 'Top Right', 'xpro-elementor-addons-pro' ),
					'middle-left'   => __( 'Middle Left', 'xpro-elementor-addons-pro' ),
					'middle-center' => __( 'Middle Center', 'xpro-elementor-addons-pro' ),
					'middle-right'  => __( 'Middle Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => __( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-center' => __( 'Bottom Center', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => __( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'top-left'      => 'align-items:flex-start; justify-content:flex-start;',
					'top-center'    => 'align-items:flex-start; justify-content:center;',
					'top-right'     => 'align-items:flex-start; justify-content:flex-end;',
					'middle-left'   => 'align-items:center; justify-content:flex-start;',
					'middle-center' => 'align-items:center; justify-content:center;',
					'middle-right'  => 'align-items:center; justify-content:flex-end;',
					'bottom-left'   => 'align-items:flex-end; justify-content:flex-start;',
					'bottom-center' => 'align-items:flex-end; justify-content:center;',
					'bottom-right'  => 'align-items:flex-end; justify-content:flex-end;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-product-360-inner' => '{{VALUE}};',
				),
				'default'              => 'middle-center',
			)
		);

		$this->add_responsive_control(
			'wrapper_width',
			array(
				'label'       => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%', 'vw' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-product-360-inner' => 'width: {{SIZE}}{{UNIT}};',
				),
				'render_type' => 'template',
			)
		);

		$this->add_responsive_control(
			'wrapper_height',
			array(
				'label'       => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 50,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-product-360-inner' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
				'render_type' => 'template',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'wrapepr_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .xpro-product-360-inner',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'selector' => '{{WRAPPER}} .xpro-product-360-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wrapper_shadow',
				'selector' => '{{WRAPPER}} .xpro-product-360-inner',
			)
		);

		$this->add_responsive_control(
			'wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-product-360-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-product-360-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings   = $this->get_settings_for_display();
		$image_urls = array();
		$plugins    = array();

		if ( 'local' === $settings['source_type'] ) {
			foreach ( $settings['images'] as $index => $item ) : ?>
				<?php $image_urls[] = Group_Control_Image_Size::get_attachment_image_src( $item['id'], 'thumbnail', $settings ); ?>
				<?php
			endforeach;
		} elseif ( 'remote' === $settings['source_type'] ) {
			$image_urls = $settings['remote_images']['url'];
		}

		if ( ! empty( $image_urls ) ) {

			$plugins[] = '360';
			$plugins[] = 'progress';

			if ( $settings['mouse_option'] ) {
				$plugins[] = $settings['mouse_option'];
			}
			if ( $settings['ease'] ) {
				$plugins[] = 'ease';
			}

			$this->add_render_attribute(
				array(
					'xpor_360' => array(
						'data-settings' => array(
							wp_json_encode(
								array_filter(
									array(
										'source_type'   => $settings['source_type'],
										'frame_limit'   => ( 'remote' === $settings['source_type'] ) ? array(
											$settings['start_frame']['size'],
											$settings['end_frame']['size'],
										) : false,
										'image_digits'  => ( 'remote' === $settings['source_type'] ) ? $settings['digit_number'] : false,
										'source'        => $image_urls,
										'width'         => $settings['width']['size'],
										'height'        => $settings['height']['size'],
										'animate'       => $settings['animate'] ? true : false,
										'frameTime'     => $settings['frame_time'],
										'loop'          => $settings['loop'] ? true : false,
										'retainAnimate' => $settings['retain_animate'] ? true : false,
										'reverse'       => $settings['reverse'] ? true : false,
										'sense'         => ( $settings['sense'] ) ? - 1 : false,
										'stopFrame'     => $settings['stop_frame'],
										'responsive'    => true,
										'plugins'       => $plugins,
									)
								)
							),
						),
					),
				)
			);

			$this->add_render_attribute( 'xpor_360', 'class', 'xpro-porduct-view-360-wrapper' );

			?>
			<div <?php $this->print_render_attribute_string( 'xpor_360' ); ?>>

				<div class="xpro-product-360-inner"></div>

			</div>
			<?php
		}
	}

}
