<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
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
class Remote_Arrows extends Widget_Base {

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
		return 'xpro-remote-arrows';
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
		return __( 'Remote Arrows', 'xpro-elementor-addons-pro' );
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
		return 'xi-move-outside xpro-widget-pro-label';
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
		return array( 'xpro', 'remote', 'arrow', 'arrows', 'carousel' );
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
	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'remote_selector',
			array(
				'label'              => esc_html__( 'Remote Selector', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'dynamic'            => array( 'active' => true ),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'remote_selector_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note: If you place both elements in the same section/container, the system will automatically detect the element.', 'xpro-elementor-addons-pro' ),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$this->add_control(
			'orientation',
			array(
				'label'     => __( 'Orientation', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'row'    => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'column' => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'row',
				'selectors' => array(
					'{{WRAPPER}} .xpro-remote-arrows' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'left',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-xpro-remote-arrows' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'next_btn_icon',
			array(
				'label'                  => __( 'Next Button Icon', 'xpro-elementor-addons-pro' ),
				'label_block'            => false,
				'type'                   => Controls_Manager::ICONS,
				'skin'                   => 'inline',
				'exclude_inline_options' => array( 'svg', 'gif' ),
				'frontend_available'     => true,
				'default'                => array(
					'value'   => 'fa fa-chevron-right',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'next_btn_text',
			array(
				'label'       => __( 'Next Button Text', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Next', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'prev_btn_icon',
			array(
				'label'                  => __( 'Prev Button Icon', 'xpro-elementor-addons-pro' ),
				'label_block'            => false,
				'type'                   => Controls_Manager::ICONS,
				'skin'                   => 'inline',
				'exclude_inline_options' => array( 'svg', 'gif' ),
				'frontend_available'     => true,
				'default'                => array(
					'value'   => 'fa fa-chevron-left',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'prev_btn_text',
			array(
				'label'       => __( 'Prev Button Text', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Prev', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'render_type' => 'template',
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .xpro-remote-arrow-text',
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-remote-arrows' => 'gap: {{SIZE}}{{UNIT}};',
				),
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
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button > i'   => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'      => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button' => 'gap: {{SIZE}}{{UNIT}};',
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
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button > i' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .xpro-elementor-button,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill:before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide::before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-button',
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
			'hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button:hover'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-button:hover > i'         => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button:hover,{{WRAPPER}} .xpro-button-bg-animation::before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_hshadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-button:hover',
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'border_border!'          => '',
					'hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-button:hover' => 'border-color: {{VALUE}};',
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
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
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

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-button',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings        = $this->get_settings_for_display();
		$hover_animation = ( '2d-transition' === $settings['hover_animation'] ) ? 'xpro-button-2d-animation ' . $settings['hover_2d_css_animation'] : ( ( 'background-transition' === $settings['hover_animation'] ) ? 'xpro-button-bg-animation ' . $settings['hover_background_css_animation'] : '' );
		?>
		<div id="xpro-remote-arrows-<?php echo esc_attr( $this->get_id() ); ?>" class="xpro-remote-arrows">
			<button type="button" role="presentation" class="xpro-elementor-button xpro-remote-arrow-prev <?php echo esc_attr( $hover_animation ); ?>">
				<?php
				Icons_Manager::render_icon( $settings['prev_btn_icon'], array( 'aria-hidden' => 'true' ) );
				if ( $settings['prev_btn_text'] ) {
					?>
					<span class="xpro-remote-arrow-text">
					<?php echo wp_kses_post( $settings['prev_btn_text'] ); ?>
					</span>
					<?php
				}
				?>
			</button>
			<button type="button" role="presentation" class="xpro-elementor-button xpro-remote-arrow-next <?php echo esc_attr( $hover_animation ); ?>">
				<?php
				if ( $settings['next_btn_text'] ) {
					?>
					<span class="xpro-remote-arrow-text">
					<?php echo wp_kses_post( $settings['next_btn_text'] ); ?>
					</span>
					<?php
				}
				Icons_Manager::render_icon( $settings['next_btn_icon'], array( 'aria-hidden' => 'true' ) );
				?>
			</button>
		</div>
		<?php

	}

}
