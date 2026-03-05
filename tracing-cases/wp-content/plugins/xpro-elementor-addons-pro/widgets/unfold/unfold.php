<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
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
class Unfold extends Widget_Base {

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
		return 'xpro-unfold';
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
		return __( 'Unfold', 'xpro-elementor-addons-pro' );
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
		return array( 'unfold' );
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
			)
		);

		$this->add_control(
			'trigger',
			array(
				'label'   => esc_html__( 'Trigger', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'click',
				'options' => array(
					'hover' => esc_html__( 'Hover', 'xpro-elementor-addons-pro' ),
					'click' => esc_html__( 'Click', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Add Your Heading Text Here', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'source',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => __( 'Source', 'xpro-elementor-addons-pro' ),
				'default'   => 'editor',
				'separator' => 'before',
				'options'   => array(
					'editor'   => __( 'Editor', 'xpro-elementor-addons-pro' ),
					'template' => __( 'Template', 'xpro-elementor-addons-pro' ),
					'dynamic'  => __( 'Dynamic', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'editor',
			array(
				'label'      => __( 'Content Editor', 'xpro-elementor-addons-pro' ),
				'show_label' => false,
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. <br/><br/> Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.', 'xpro-elementor-addons-pro' ),
				'condition'  => array(
					'source' => 'editor',
				),
				'dynamic'    => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'unfold_content',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
				'condition'   => array(
					'source' => 'dynamic',
				),
			)
		);

		$this->add_control(
			'unfold_template',
			array(
				'label'         => __( 'Template', 'xpro-elementor-addons-pro' ),
				'placeholder'   => __( 'Select a section template for as tab content', 'xpro-elementor-addons-pro' ),
				'description'   => sprintf(
				/* translators: %s: HTML */
					__( 'Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'xpro-elementor-addons-pro' ),
					'<a target="_blank" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ) ) . '">',
					'</a>'
				),
				'type'          => Controls_Manager::SELECT2,
				'label_block'   => false,
				'display_label' => false,
				'options'       => xpro_elementor_get_section_templates(),
				'condition'     => array(
					'source' => 'template',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_button',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_unfold_text',
			array(
				'label'       => esc_html__( 'Button Unfold Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your text here', 'xpro-elementor-addons-pro' ),
				'frontend'    => 'true',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'unfold_icon',
			array(
				'label'       => __( 'Unfold Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->add_control(
			'button_fold_text',
			array(
				'label'       => esc_html__( 'Button fold Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read Less', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your text here', 'xpro-elementor-addons-pro' ),
				'frontend'    => 'true',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'fold_icon',
			array(
				'label'       => __( 'Fold Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->add_control(
			'icon_position',
			array(
				'label'   => esc_html__( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => esc_html__( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => esc_html__( 'After', 'xpro-elementor-addons-pro' ),
				),
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

		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'separator' => 'before',
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-wrapper' => 'text-align: {{VALUE}};',
				),
				'default'   => 'left',
				'toggle'    => true,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'unfold_fade_background',
				'label'    => esc_html__( 'Fade Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-unfold-content:after',
			)
		);

		$this->add_responsive_control(
			'unfold_height',
			array(
				'label'              => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'            => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-unfold-content' => 'height: {{SIZE}}{{UNIT}};',
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'unfold_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 10,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.5,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-content' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->add_responsive_control(
			'unfold_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .xpro-unfold-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .xpro-unfold-content-txt, {{WRAPPER}} .xpro-unfold-content-txt > *',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-content-txt, {{WRAPPER}} .xpro-unfold-content-txt > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-content-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_btn_style',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .xpro-unfold-btn-text',
			)
		);

		$this->start_controls_tabs( 'unfold_style' );

		$this->start_controls_tab(
			'unfold_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'btn_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-media > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-unfold-media > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'btn_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-btn-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-unfold-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'unfold_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'btn_hv_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-btn:hover .xpro-unfold-media > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-unfold-btn:hover .xpro-unfold-media > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'btn_hv_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-btn:hover .xpro-unfold-btn-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_hv_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-unfold-btn:hover',
			)
		);

		$this->add_control(
			'btn_hv_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-unfold-btn:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btn_border',
				'label'     => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-unfold-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btn_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-unfold-btn',
			)
		);

		$this->add_responsive_control(
			'btn_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'btn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_options',
			array(
				'label'     => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-unfold-media > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				),
			)
		);

		$this->add_responsive_control(
			'icon_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-unfold-btn.xpro-unfold-align-icon-left .xpro-unfold-media > i,
					{{WRAPPER}} .xpro-unfold-btn.xpro-unfold-align-icon-left .xpro-unfold-media > svg'                      => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-unfold-btn.xpro-unfold-align-icon-right .xpro-unfold-media > i,
					{{WRAPPER}} .xpro-unfold-btn.xpro-unfold-align-icon-right .xpro-unfold-media > svg' => 'margin-left: {{SIZE}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'unfold/layout/frontend.php';

	}

}
