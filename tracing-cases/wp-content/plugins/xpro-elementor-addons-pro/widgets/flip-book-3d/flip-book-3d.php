<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
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
class Flip_Book_3d extends Widget_Base {

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
		return 'xpro-flip-book-3d';
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
		return __( '3D Flip Book', 'xpro-elementor-addons-pro' );
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
		return 'xi-book xpro-widget-pro-label';
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
		return array( 'xpro', '3d', 'flip', 'book' );
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
		return array( '3dflipbook' );
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
			'layout_type',
			array(
				'label'   => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => array(
					'inline' => esc_html__( 'Inline', 'xpro-elementor-addons-pro' ),
					'btn'    => esc_html__( 'Button', 'xpro-elementor-addons-pro' ),
					'image'  => esc_html__( 'Poster', 'xpro-elementor-addons-pro' ),
					'icon'   => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'book_skin',
			array(
				'label'              => __( 'Controls', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'white',
				'options'            => array(
					'white' => __( 'Light', 'xpro-elementor-addons-pro' ),
					'black' => __( 'Dark', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'file_type',
			array(
				'label'   => __( 'Source', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'file',
				'options' => array(
					'file' => __( 'Media File', 'xpro-elementor-addons-pro' ),
					'url'  => __( 'External URL', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'file_src',
			array(
				'label'      => __( 'Upload PDF File', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'application/pdf',
				'separator'  => 'after',
				'condition'  => array(
					'file_type' => 'file',
				),
			)
		);

		$this->add_control(
			'file_url',
			array(
				'label'         => __( 'External URL', 'xpro-elementor-addons-pro' ),
				'label_block'   => true,
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => esc_html__( 'https://example.com/file.pdf', 'xpro-elementor-addons-pro' ),
				'show_external' => false,
				'condition'     => array(
					'file_type' => 'url',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'layout_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'media_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'layout_type' => 'image',
				),
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'       => esc_html__( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read Book', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your Button Text here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'layout_type' => 'btn',
				),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'btn_icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'layout_type' => 'btn',
				),
			)
		);

		$this->add_control(
			'btn_icon_align',
			array(
				'label'     => esc_html__( 'Icon Align', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => esc_html__( 'Left', 'xpro-elementor-addons-pro' ),
					'right' => esc_html__( 'Right', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'layout_type' => 'btn',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-search',
					'library' => 'regular',
				),
				'condition' => array(
					'layout_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'icon_effect',
			array(
				'label'     => esc_html__( 'Icon layout', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2' => esc_html__( 'Style 2', 'xpro-elementor-addons-pro' ),
					'3' => esc_html__( 'Style 3', 'xpro-elementor-addons-pro' ),
					'4' => esc_html__( 'Style 4', 'xpro-elementor-addons-pro' ),
					'5' => esc_html__( 'Style 5', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'layout_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
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
				'default'   => 'left',
				'toggle'    => true,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-xpro-flip-book-3d' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style',
			array(
				'label'     => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'inline',
				),
			)
		);

		$this->add_responsive_control(
			'book_width',
			array(
				'label'      => esc_html__( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-book-layout-inline' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'book_max_width',
			array(
				'label'      => esc_html__( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-book-layout-inline' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'book_height',
			array(
				'label'      => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-flip-book-3d' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_general_toggle_poster_style',
			array(
				'label'     => __( 'Poster', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'image',
				),
			)
		);

		$this->add_responsive_control(
			'toggler_poster_width',
			array(
				'label'      => esc_html__( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-poster' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggler_poster_max_width',
			array(
				'label'      => esc_html__( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-poster' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggler_poster_height',
			array(
				'label'      => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-poster' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'poster_object_fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => array(
					'none'    => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
					'fill'    => esc_html__( 'Fill', 'xpro-elementor-addons-pro' ),
					'contain' => esc_html__( 'Contain', 'xpro-elementor-addons-pro' ),
					'cover'   => esc_html__( 'Cover', 'xpro-elementor-addons-pro' ),

				),
				'condition' => array(
					'toggler_poster_height[size]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-poster > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'toggler_poster_style' );

		$this->start_controls_tab(
			'toggler_poster_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'poster_normal_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-poster > img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'poster_normal_custom_css_filters',
				'selector' => '{{WRAPPER}} .xpro-lightbox-poster > img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggler_poster_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'poster_hv_opacity',
			array(
				'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-poster:hover > img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'poster_hv_custom_css_filters',
				'selector' => '{{WRAPPER}} .xpro-lightbox-poster:hover > img',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'toggler_poster_border',
				'label'     => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-lightbox-poster',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'toggler_poster_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-lightbox-poster',
			)
		);

		$this->add_control(
			'toggler_poster_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-poster' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_toggle_btn_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'btn',
				),
			)
		);

		$this->add_responsive_control(
			'button_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 800,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-btn' => 'width: {{SIZE}}{{UNIT}}; max-width:100%;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'layout_type_btn_typography',
				'selector' => '{{WRAPPER}} .xpro-lightbox-btn > .xpro-lightbox-btn-txt',
			)
		);

		$this->start_controls_tabs( 'layout_type_btn_style' );

		$this->start_controls_tab(
			'layout_type_btn_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout_type_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-lightbox-btn > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'layout_type_txt_color',
			array(
				'label'     => esc_html__( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn > .xpro-lightbox-btn-txt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'layout_type_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'layout_type_btn_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout_type_hv_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn:hover > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-lightbox-btn:hover > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'layout_type_hv_txt_color',
			array(
				'label'     => esc_html__( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn:hover > .xpro-lightbox-btn-txt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'layout_type_hv_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'layout_type_hv_border_color',
			array(
				'label'     => esc_html__( 'border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'layout_type_btn_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-lightbox-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'layout_type_btn_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-lightbox-btn',
			)
		);

		$this->add_responsive_control(
			'layout_type_btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'layout_type_btn_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'layout_type_btn_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'toggler_icon_options',
			array(
				'label'     => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'toggler_icon_font-size',
			array(
				'label'      => esc_html__( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'condition'  => array(
					'layout_type' => 'btn',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-btn > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-lightbox-btn > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'toggler_icon_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'condition'  => array(
					'layout_type' => 'btn',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-btn.xpro-lightbox-btn-align-left > i'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-lightbox-btn.xpro-lightbox-btn-align-right > i' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_toggle_icon_style',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'toggler_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-lightbox-icon > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				),
			)
		);

		$this->add_responsive_control(
			'toggler_icon_bg_size',
			array(
				'label'      => esc_html__( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'lightbox_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-lightbox-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'lightbox_icon_bg_color',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-lightbox-icon',
			)
		);

		$this->add_control(
			'lightbox_icons_effect_color',
			array(
				'label'     => esc_html__( 'Effect Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-icon.xpro-lightbox-icon-effect-2::before,
					{{WRAPPER}} .xpro-lightbox-icon.xpro-lightbox-icon-effect-3::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-lightbox-icon.xpro-lightbox-icon-effect-4'        => '--box-shadow-effect-1: {{VALUE}}',
					'{{WRAPPER}} .xpro-lightbox-icon.xpro-lightbox-icon-effect-5'        => '--box-shadow-effect-2: {{VALUE}};',
				),
				'condition' => array(
					'icon_effect!' => '1',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'lightbox_icon_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-lightbox-icon',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'lightbox_icon_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-lightbox-icon',
			)
		);

		$this->add_responsive_control(
			'lightbox_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-lightbox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$data_src = 'file' === $settings['file_type'] ? $settings['file_src']['url'] : $settings['file_url'];

		if ( ! $data_src ) {
			return;
		}

		$this->add_render_attribute(
			'flip-book-3d',
			array(
				'id'               => 'xpro-flip-book-3d-' . $this->get_id(),
				'class'            => 'xpro-flip-book-3d',
				'data-file'        => 'file' === $settings['file_type'] ? $settings['file_src']['url'] : $settings['file_url'],
				'data-widget'      => XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'widgets/flip-book-3d/',
				'data-fontawesome' => ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css',
			)
		);
		?>

		<?php if ( 'btn' === $settings['layout_type'] ) : ?>
			<button type="button" class="xpro-flip-book-3d-toggle xpro-lightbox-btn xpro-lightbox-btn-align-<?php echo esc_attr( ( 'left' === $settings['btn_icon_align'] ) ? 'left' : 'right' ); ?>">
				<?php Icons_Manager::render_icon( $settings['btn_icon'], array( 'aria-hidden' => 'true' ) ); ?>

				<?php if ( $settings['btn_text'] ) : ?>
					<span class="xpro-lightbox-btn-txt"><?php echo esc_html( $settings['btn_text'] ); ?></span>
				<?php endif; ?>
			</button>
		<?php endif; ?>

		<?php if ( 'image' === $settings['layout_type'] ) : ?>
			<div class="xpro-flip-book-3d-toggle xpro-lightbox-poster">
				<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_thumbnail', 'image' ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( 'icon' === $settings['layout_type'] ) : ?>
			<div class="xpro-flip-book-3d-toggle xpro-lightbox-icon xpro-lightbox-icon-effect-<?php echo esc_attr( $settings['icon_effect'] ); ?>">
				<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</div>
		<?php endif; ?>

		<div class="xpro-flip-book-wrapper xpro-flip-book-skin-<?php echo esc_attr( $settings['book_skin'] ); ?> xpro-flip-book-layout-<?php echo esc_attr( 'inline' === $settings['layout_type'] ? 'inline' : 'popup' ); ?>">
			<?php if ( 'inline' !== $settings['layout_type'] ) : ?>
			<button class="xpro-flip-book-poupup-close-btn" title="Close" tabindex="0">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M20 20L4 4m16 0L4 20"></path></svg>
			</button>
			<?php endif; ?>
			<div <?php $this->print_render_attribute_string( 'flip-book-3d' ); ?>></div>
		</div>
		<?php
	}

}
