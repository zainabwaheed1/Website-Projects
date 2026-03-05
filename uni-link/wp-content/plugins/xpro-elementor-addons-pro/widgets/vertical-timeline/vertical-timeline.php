<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
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
class Vertical_Timeline extends Widget_Base {

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
		return 'xpro-vertical-timeline';
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
		return __( 'Vertical Timeline', 'xpro-elementor-addons-pro' );
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
		return 'xi-verticle-timeline xpro-widget-pro-label';
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
		return array( 'vertical', 'timeline' );
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
			'section_ver_timeline_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'date_media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'image'  => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
					'custom' => array(
						'title' => __( 'Custom', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-font',
					),
				),
				'default'     => 'custom',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'date_image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'date_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'date_image_thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => array(
					'date_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Project Tagline', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'date_media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'date_custom',
			array(
				'label'       => __( 'Date', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( '18-01-22 12:00', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'date_media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'content_media_type',
			array(
				'label'       => __( 'Content Media', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'separator'   => 'before',
				'options'     => array(
					'none'  => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'image' => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'image',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'content_image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'content_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'content_image_thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => array(
					'content_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'sub_title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Project Title', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'Vertical Timeline Content', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'bullet_media_type',
			array(
				'label'       => __( ' Bullet Media', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'separator'   => 'before',
				'options'     => array(
					'icon'   => array(
						'title' => __( 'Icon', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-star-o',
					),
					'image'  => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
					'custom' => array(
						'title' => __( 'Custom', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-font',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-calendar-alt',
					'library' => 'solid',
				),
				'condition' => array(
					'bullet_media_type' => 'icon',
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
					'bullet_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'bullet_image_thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => array(
					'bullet_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'custom',
			array(
				'label'       => __( 'Custom Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '1',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'bullet_media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'inline_style',
			array(
				'label'        => esc_html__( 'Inline Style', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$repeater->start_controls_tabs( 'inline_bullet_media_icon' );

		$repeater->start_controls_tab(
			'inline_bullet_media_normal',
			array(
				'label'     => __( 'Normal', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_date_bg',
			array(
				'label'     => __( 'Date Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-dates' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_normal_color',
			array(
				'label'     => __( 'Bullet Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-media > i'                                    => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-media > svg'                                    => 'fill: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-media > .xpro-vertical-timeline-media-custom' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_normal_bg_color',
			array(
				'label'     => __( 'Bullet Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-media' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-dates:before,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-content-inner:after,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-media:before,
					{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-media:after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_content_bg',
			array(
				'label'     => __( 'Content Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-vertical-timeline-content-inner' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'inline_bullet_media_hover',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_hdate_bg',
			array(
				'label'     => __( 'Date Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-dates' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_hover_color',
			array(
				'label'     => __( 'Bullet Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-media > i,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-media > svg,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-media > .xpro-vertical-timeline-media-custom' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_hover_bg_color',
			array(
				'label'     => __( 'Bullet Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-media' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_separator_hcolor',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-dates:before,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-content-inner:after,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-media:before,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-media:after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_hcontent_bg',
			array(
				'label'     => __( 'Content Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .xpro-vertical-timeline-content-inner' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'vertical_timeline_item',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ sub_title }}}',
				'default'     => array(
					array(
						'sub_title'   => __( 'Step 1', 'xpro-elementor-addons-pro' ),
						'description' => __( 'It is a long established fact that a reader will be distracted by the readable content.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'sub_title'   => __( 'Step 2', 'xpro-elementor-addons-pro' ),
						'description' => __( 'It is a long established fact that a reader will be distracted by the readable content.', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_responsive_control(
			'direction',
			array(
				'label'          => __( 'Direction', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::CHOOSE,
				'separator'      => 'before',
				'options'        => array(
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
				'toggle'         => false,
				'default'        => 'center',
				'tablet_default' => 'left',
				'mobile_default' => 'left',
				'prefix_class'   => 'elementor%s-align-',
			)
		);

		$this->add_responsive_control(
			'aligns_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 60,
						'max' => 200,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 60,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-inner' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-vertical-timeline-media::before,
					{{WRAPPER}} .xpro-vertical-timeline-media::after'    => 'width:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-vertical-timeline-media-box:before,
					{{WRAPPER}} .xpro-vertical-timeline-media-box:after' => 'height: calc({{SIZE}}{{UNIT}} + 750px);',
				),
			)
		);

		$this->add_responsive_control(
			'aligns_space_bottom',
			array(
				'label'      => __( 'Space Bottom', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Date & Time
		$this->start_controls_section(
			'section_media_type_style',
			array(
				'label' => __( 'Date', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'date_style_hover' );

		$this->start_controls_tab(
			'date_normal_general',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'media_type_date_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-dates',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'media_type_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-dates',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'date_hover_general',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'media_type_date_hv_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-dates',
			)
		);

		$this->add_control(
			'media_border_hv_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-dates' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'media_type_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-vertical-timeline-dates',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_type_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-dates' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_type_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-dates' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_type_title_options',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'media_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-title',
			)
		);

		$this->add_control(
			'media_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'media_title_hv_color',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'media_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_date_options',
			array(
				'label'     => __( 'Date', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'media_date_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-time,{{WRAPPER}} .xpro-vertical-timeline-content-time',
			)
		);

		$this->add_control(
			'media_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-time,{{WRAPPER}} .xpro-vertical-timeline-content-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'media_hv_color',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-time,
					{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-content-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'media_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-time,{{WRAPPER}} .xpro-vertical-timeline-content-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_image_options',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_image_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-inner .xpro-vertical-timeline-dates > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_type_image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-inner .xpro-vertical-timeline-dates > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Bullet Media
		$this->start_controls_section(
			'section_bullet_media_style',
			array(
				'label' => __( 'Bullet', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-inner' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'bullet_media_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-vertical-timeline-media > svg'   => 'width: {{SIZE}}{{UNIT}}; height: auto;',
					'{{WRAPPER}} .xpro-vertical-timeline-media > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'bullet_media_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'bullet_media_icon' );

		$this->start_controls_tab(
			'bullet_media_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'bullet_media_normal_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media > i'                                    => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-vertical-timeline-media > svg'                                    => 'fill: {{VALUE}};',
					'{{WRAPPER}} .xpro-vertical-timeline-media > .xpro-vertical-timeline-media-custom' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_normal_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_normal_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media:after,
					{{WRAPPER}} .xpro-vertical-timeline-media:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_normal_divider_color',
			array(
				'label'     => __( 'Divider Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media-box:before,
					{{WRAPPER}} .xpro-vertical-timeline-media-box:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'bullet_media_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'bullet_media_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media > i,
					{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media > svg,
					{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media > .xpro-vertical-timeline-media-custom' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_hover_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_hv_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media:after,
					{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-media' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bullet_media_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-media',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bullet_media_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-media',
			)
		);

		$this->add_responsive_control(
			'bullet_media_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_custom_options',
			array(
				'label'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bullet_media_custom_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-media > .xpro-vertical-timeline-media-custom',
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_general_style_content',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_direction',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
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
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner' => 'width: {{SIZE}}{{UNIT}};',
				),

			)
		);

		$this->start_controls_tabs( 'content_style_hover' );

		$this->start_controls_tab(
			'content_normal_general',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_normal_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-content-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-content-inner',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_hover_general',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_hv_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-content-inner',
			)
		);

		$this->add_control(
			'content_hv_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-content-inner' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'content_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-content-inner',
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_image_options',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'inline',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'inline-flex'  => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'inline-block' => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'default'     => 'inline-block',
				'toggle'      => true,
				'selectors'   => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_media_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner .xpro-vertical-timeline-content-media > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_media_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner'                                             => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner .xpro-vertical-timeline-content-media > img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_media_border-radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-inner .xpro-vertical-timeline-content-media > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_title_options',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-sub-title',
			)
		);

		$this->add_control(
			'content_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-sub-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_title_hv_color',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-sub-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_text_options',
			array(
				'label'     => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_text_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-text',
			)
		);

		$this->add_control(
			'content_text_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_text_hv_color',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_text_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_time_options',
			array(
				'label'     => __( 'Date', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_time_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-vertical-timeline-content-time',
			)
		);

		$this->add_control(
			'content_time_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_time_hv_color',
			array(
				'label'     => __( 'Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-vertical-timeline-item:hover .xpro-vertical-timeline-content-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_time_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-vertical-timeline-content-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'vertical-timeline/layout/frontend.php';

	}

}
