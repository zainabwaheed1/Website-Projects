<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
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
class Advance_Accordion extends Widget_Base {

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
		return 'xpro-advance-accordion';
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
		return __( 'Advanced Accordion', 'xpro-elementor-addons-pro' );
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
		return 'xi-advance-accordion xpro-widget-pro-label';
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
		return array( 'accordion', 'toggle', 'content', 'template' );
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
			'section_accordion',
			array(
				'label' => __( 'Accordion', 'xpro-elementor-addons-pro' )
			)
		);

		$this->add_control(
			'accordion_type',
			array(
				'label'              => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'toggle',
				'frontend_available' => true,
				'options'            => array(
					'accordion' => __( 'Accordion', 'xpro-elementor-addons-pro' ),
					'toggle'    => __( 'Toggle', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'default_active',
			array(
				'label'        => esc_html__( 'Active as Default', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Tab Title', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'icon'  => array(
						'title' => __( 'Icon', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-star',
					),
					'image' => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'icon',
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-tools',
					'library' => 'solid',
				),
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'source',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Source', 'xpro-elementor-addons-pro' ),
				'default' => 'editor',
				'options' => array(
					'editor'  => __( 'Editor', 'xpro-elementor-addons-pro' ),
					'template' => __( 'Template', 'xpro-elementor-addons-pro' ),
					'dynamic' => __( 'Dynamic', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'editor',
			array(
				'label'      => __( 'Content Editor', 'xpro-elementor-addons-pro' ),
				'show_label' => false,
				'type'       => Controls_Manager::WYSIWYG,
				'condition'  => array(
					'source' => 'editor',
				),
				'dynamic'    => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'accordion_content',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
				'condition'   => array(
					'source' => 'dynamic',
				),
			)
		);

		$repeater->add_control(
			'accordion_template',
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

		$this->add_control(
			'accordion_items',
			array(
				'label'       => __( 'Items', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
				/* translators: 1$s: Title */
					__( '%1$s', 'xpro-elementor-addons-pro' ), //phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
					'{{title}}'
				),
				'render_type' => 'template',
				'default'     => array(
					array(
						'title'          => __( 'Accordion #1', 'xpro-elementor-addons-pro' ),
						'default_active' => 'yes',
						'icon'           => array(
							'value'   => 'fas fa-home',
							'library' => 'solid',
						),
						'source'         => 'editor',
						'editor'         => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry, Lorem Ipsum has been the industry standard dummy text ever.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title'  => __( 'Accordion #2', 'xpro-elementor-addons-pro' ),
						'icon'   => array(
							'value'   => 'fas fa-user',
							'library' => 'solid',
						),
						'source' => 'editor',
						'editor' => __( 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title'  => __( 'Accordion #3', 'xpro-elementor-addons-pro' ),
						'icon'   => array(
							'value'   => 'fas fa-envelope',
							'library' => 'solid',
						),
						'source' => 'editor',
						'editor' => __( 'Contrary to popular belief, Lorem Ipsum is not simply random text, It has roots in a piece of classical Latin literature from 45 BC making it.', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_control(
			'toggle_icon',
			array(
				'label'     => __( 'Toggle Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'separator' => 'before',
				'default'   => array(
					'value'   => 'fas fa-angle-right',
					'library' => 'solid',
				),
			)
		);

		$this->add_control(
			'toggle_speed',
			array(
				'label'              => __( 'Toggle Speed(s)', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => array(
					'px' => array(
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'            => array(
					'size' => 3,
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		//Accordion List Style
		$this->start_controls_section(
			'section_style_accordion',
			array(
				'label' => __( 'Accordion List', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'   => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'accordion_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-accordion-title',
			)
		);

		$this->add_responsive_control(
			'accordion_title_icon',
			array(
				'label'      => __( 'Media Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => '16',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-icon'  => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-accordion-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-accordion-image' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_title_icon_margin',
			array(
				'label'      => __( 'Media Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-icon,{{WRAPPER}} .xpro-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_toggle_icon',
			array(
				'label'      => __( 'Toggle Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-toggle-icon'       => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-toggle-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_toggle_margin',
			array(
				'label'              => __( 'Toggle Margin', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'allowed_dimensions' => 'horizontal',
				'size_units'         => array( 'px', '%', 'em' ),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-toggle-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'accordion_list' );

		$this->start_controls_tab(
			'accordion_list_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'accordion_list_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-accordion-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_toggle_color',
			array(
				'label'     => __( 'Toggle Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-toggle-icon'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-toggle-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-header' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'accordion_list_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'accordion_list_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-header:hover .xpro-accordion-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_hover_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-header:hover .xpro-accordion-icon'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-accordion-header:hover .xpro-accordion-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_hover_toggle_color',
			array(
				'label'     => __( 'Toggle Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-header:hover .xpro-toggle-icon'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-accordion-header:hover .xpro-toggle-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_hover_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-header:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'accordion_list_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-header:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'accordion_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'accordion_list_active_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-accordion-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-accordion-icon'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-accordion-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_active_toggle_color',
			array(
				'label'     => __( 'Toggle Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-toggle-icon'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-toggle-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_list_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-accordion-header' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'accordion_list_active_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-list.active .xpro-accordion-header' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'accordion_list_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-accordion-header',
			)
		);

		$this->add_responsive_control(
			'accordion_list_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_list_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_list_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			array(
				'label' => __( 'Tab Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accordion_content_alignment',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-content' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'accordion_content_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-accordion-content, {{WRAPPER}} .xpro-accordion-content > *',
			)
		);

		$this->add_control(
			'accordion_content_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-content, {{WRAPPER}} .xpro-accordion-content > *' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accordion_content_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-accordion-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'accordion_content_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-accordion-content',
			)
		);

		$this->add_responsive_control(
			'accordion_content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_content_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_content_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-accordion/layout/frontend.php';

	}

}
