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
class Instagram_Feed extends Widget_Base {

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
		return 'xpro-instagram-feed';
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
		return __( 'Instagram Feed', 'xpro-elementor-addons-pro' );
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
		return 'xi-instagram-feed xpro-widget-pro-label';
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
		return array( 'xpro', 'instagram', 'feed' );
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

		return array( 'cubeportfolio', 'lightgallery' );

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
		return array( 'cubeportfolio', 'lightgallery' );
	}


	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'gallery_style',
			array(
				'label'              => __( 'Gallery Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'masonry',
				'options'            => array(
					'grid'    => __( 'Grid', 'xpro-elementor-addons-pro' ),
					'masonry' => __( 'Masonry', 'xpro-elementor-addons-pro' ),
					'mosaic'  => __( 'Mosaic', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'sort_by_dimension',
			array(
				'label'              => __( 'Sort By Dimension', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'gallery_style' => 'mosaic',
				),
			)
		);

		$this->add_responsive_control(
			'item_per_row',
			array(
				'label'              => __( 'Items Per Row', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust items to show in a row.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 4,
				'desktop_default'    => 4,
				'tablet_default'     => 2,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label'              => __( 'Height', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the height of gallery items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 300,
				),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'          => array(
					'gallery_style' => 'grid',
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-elementor-gallery-layout-grid .xpro-elementor-gallery-item' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'              => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the space between items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 15,
				),
				'tablet_default'     => array(
					'size' => 15,
				),
				'mobile_default'     => array(
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

		$this->add_control(
			'icon',
			array(
				'label'        => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show item icon.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'caption',
			array(
				'label'        => __( 'Caption', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show image caption.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'remove_cache',
			array(
				'label'        => __( 'Remove Cache', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->end_controls_section();

		//Load More
		$this->start_controls_section(
			'section_loadmore',
			array(
				'label' => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'load_more',
			array(
				'label'              => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'click'  => __( 'Click', 'xpro-elementor-addons-pro' ),
					'auto'   => __( 'Scroll', 'xpro-elementor-addons-pro' ),
					'custom' => __( 'Custom', 'xpro-elementor-addons-pro' ),
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'item_per_page',
			array(
				'label'       => __( 'Items Per Page', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Set items that show initially.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 8,
				'min'         => 1,
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'load_more_text',
			array(
				'label'       => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'load_more!' => 'none',
				),
			)
		);

		$this->add_control(
			'load_more_count',
			array(
				'label'        => __( 'Button Count', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'load_more_loading_text',
			array(
				'label'       => __( 'On Loading', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Loading...', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Loading...', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'load_more_no_left',
			array(
				'label'       => __( 'No More', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'No More Works', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'No More Works.', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'custom_link',
			array(
				'label'         => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://www.wpxpro.com/', 'xpro-elementor-addons-pro' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'load_more' => 'custom',
				),
			)
		);

		$this->end_controls_section();

		//Popup Tab
		$this->start_controls_section(
			'section_popup',
			array(
				'label' => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'popup',
			array(
				'label'              => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1'    => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'2'    => __( 'Minimal', 'xpro-elementor-addons-pro' ),
					'3'    => __( 'Creative', 'xpro-elementor-addons-pro' ),
					'4'    => __( 'Innovative', 'xpro-elementor-addons-pro' ),
					'none' => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'thumbnail',
			array(
				'label'              => __( 'Thumbnail', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Enable thumbnails for the gallery.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!' => 'none',
				),
			)
		);

		$this->add_control(
			'thumbnail_by_default',
			array(
				'label'              => __( 'Thumb By Default', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show/Hide thumbnails by default.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!'    => array( 'none', '2', '4' ),
					'thumbnail' => 'yes',
				),
			)
		);

		$this->add_control(
			'share',
			array(
				'label'              => __( 'Social Share', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To show share buttons on popup.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!' => 'none',
				),
			)
		);

		$this->add_control(
			'download',
			array(
				'label'              => __( 'Download', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To show download button on popup.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!' => 'none',
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_overlay_style',
			array(
				'label' => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'hover_effect',
			array(
				'label'              => __( 'Hover Effect', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'fadeIn',
				'options'            => array(
					'zoom'               => __( 'Zoom', 'xpro-elementor-addons-pro' ),
					'fadeIn'             => __( 'Fade In', 'xpro-elementor-addons-pro' ),
					'classic'            => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'zoom-top-bottom'    => __( 'Zoom Top Bottom', 'xpro-elementor-addons-pro' ),
					'zoom-center-bottom' => __( 'Zoom Center Bottom', 'xpro-elementor-addons-pro' ),
					'zoom-box'           => __( 'Zoom Box', 'xpro-elementor-addons-pro' ),
					'zoom-box-out'       => __( 'Zoom Box Out', 'xpro-elementor-addons-pro' ),
					'moveRight'          => __( 'Move Right', 'xpro-elementor-addons-pro' ),
					'revealLeft'         => __( 'Move Left', 'xpro-elementor-addons-pro' ),
					'rotate'             => __( 'Rotate', 'xpro-elementor-addons-pro' ),
					'pushTop'            => __( 'Push Top', 'xpro-elementor-addons-pro' ),
					'pushDown'           => __( 'Push Down', 'xpro-elementor-addons-pro' ),
					'revealTop'          => __( 'Reveal Top', 'xpro-elementor-addons-pro' ),
					'revealBottom'       => __( 'Reveal Bottom', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hover_color',
				'label'    => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .cbp-caption-active .cbp-caption-activeWrap',
			)
		);

		$this->add_control(
			'outline_color',
			array(
				'label'     => __( 'Outline Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cbp-caption-zoom-box .cbp-caption-activeWrap:before,{{WRAPPER}} .cbp-caption-zoom-box .cbp-caption-activeWrap:after,{{WRAPPER}} .cbp-caption-zoom-box-out .cbp-caption-activeWrap:before,{{WRAPPER}} .cbp-caption-zoom-box-out .cbp-caption-activeWrap:after' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'hover_effect' => array( 'zoom-box', 'zoom-box-out' ),
				),
			)
		);

		$this->add_control(
			'overlay_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .cbp-caption-active .cbp-caption-activeWrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_name',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fab fa-instagram',
					'library' => 'fa-brand',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_bg_size',
			array(
				'label'      => __( 'Backgound Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'icon_hcolor',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hbg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hborder',
			array(
				'label'     => __( 'Icon Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption_style',
			array(
				'label'     => __( 'Caption', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'caption' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_color',
			array(
				'label'     => __( 'Caption Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'caption_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-title',
			)
		);

		$this->add_control(
			'caption_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_loadmore_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'load_more!' => 'none',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'loadmore_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a',
			)
		);

		$this->add_responsive_control(
			'loadmore_align',
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore, {{WRAPPER}} .xpro-gallery-elementor-custom-link' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs(
			'loadmore_style_tabs'
		);

		$this->start_controls_tab(
			'loadmore_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'loadmore_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loadmore_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'loadmore_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'loadmore_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'loadmore_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a:hover, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loadmore_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a:hover, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a:hover',
			)
		);

		$this->add_control(
			'loadmore_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a:hover, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'loadmore_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'loadmore_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'loadmore_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore, {{WRAPPER}} .xpro-gallery-elementor-custom-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_misc',
			array(
				'label' => __( 'Misc', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'misc_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-elementor-gallery-item .cbp-caption',
			)
		);

		$this->add_control(
			'misc_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-elementor-gallery-item .cbp-caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'instagram-feed/layout/frontend.php';

	}

}
