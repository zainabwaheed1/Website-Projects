<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
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
class Lightbox extends Widget_Base {

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
		return 'xpro-lightbox';
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
		return __( 'Lightbox', 'xpro-elementor-addons-pro' );
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
		return 'xi-focus-2 xpro-widget-pro-label';
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
		return array( 'lightbox', 'modal', 'popup', 'fullscreen' );
	}

	/**
	 * Retrieve the list of style the widget depended on.
	 *
	 * Used to set style dependencies required to run the widget.
	 *
	 * @return array Widget style dependencies.
	 *
	 *
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */

	public function get_style_depends() {

		return array( 'fancybox' );

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

		return array( 'fancybox' );

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
			'lightbox_toggler',
			array(
				'label'   => esc_html__( 'Lightbox Toggle', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn',
				'options' => array(
					'btn'   => esc_html__( 'Button', 'xpro-elementor-addons-pro' ),
					'image' => esc_html__( 'Poster', 'xpro-elementor-addons-pro' ),
					'icon'  => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
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
					'lightbox_toggler' => 'image',
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
					'lightbox_toggler' => 'image',
				),
			)
		);

		$this->add_control(
			'toggler_txt_btn',
			array(
				'label'       => esc_html__( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Toggler Text', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your Button Text here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'lightbox_toggler' => 'btn',
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
					'lightbox_toggler' => 'btn',
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
					'lightbox_toggler' => 'btn',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-play',
					'library' => 'regular',
				),
				'condition' => array(
					'lightbox_toggler' => 'icon',
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
					'lightbox_toggler' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'btn_alignment',
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
				'separator' => 'before',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-wrapper' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_content_lightbox',
			array(
				'label' => __( 'Lightbox', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'lightbox_content_type',
			array(
				'label'       => esc_html__( 'Lightbox Content', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'video',
				'label_block' => true,
				'options'     => array(
					'image'      => esc_html__( 'Image', 'xpro-elementor-addons-pro' ),
					'video'      => esc_html__( 'URL', 'xpro-elementor-addons-pro' ),
					'youtube'    => esc_html__( 'Youtube', 'xpro-elementor-addons-pro' ),
					'vimeo'      => esc_html__( 'Vimeo', 'xpro-elementor-addons-pro' ),
					'google-map' => esc_html__( 'Google Map', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'content_image',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'lightbox_content_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'video_link',
			array(
				'label'       => __( 'Video Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => array(
					'url' => 'https://test-videos.co.uk/vids/bigbuckbunny/mp4/h264/1080/Big_Buck_Bunny_1080_10s_1MB.mp4',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'lightbox_content_type' => 'video',
				),
			)
		);

		$this->add_control(
			'vimeo_link',
			array(
				'label'       => __( 'Vimeo Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://vimeo.com/123123', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'default'     => array(
					'url' => 'https://vimeo.com/95673122?color=ff0000',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'lightbox_content_type' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'youtube_link',
			array(
				'label'       => __( 'Youtube Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => array(
					'url' => 'https://www.youtube.com/watch?v=-TPpwuB6dnI&t=11s',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'lightbox_content_type' => 'youtube',
				),
			)
		);

		$this->add_control(
			'content_google_map',
			array(
				'label'         => __( 'Goggle Map Embed URL', 'xpro-elementor-addons-pro' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'placeholder'   => 'https://google.com/maps/embed?pb',
				'label_block'   => true,
				'default'       => array(
					'url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4740.819266853735!2d9.99008871708242!3d53.550454675412404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3f9d24afe84a0263!2sRathaus!5e0!3m2!1sde!2sde!4v1499675200938',
				),
				'dynamic'       => array(
					'active' => true,
				),
				'condition'     => array(
					'lightbox_content_type' => 'google-map',
				),
			)
		);

		$this->add_control(
			'content_caption',
			array(
				'label'       => esc_html__( 'Lightbox Caption', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Content Caption', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'lightbox_group',
			array(
				'label'     => esc_html__( 'Lightbox Group', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'separator' => 'before',
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'lightbox_slug',
			array(
				'label'   => esc_html__( 'Lightbox Slug', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
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
					'lightbox_toggler' => 'image',
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
					'lightbox_toggler' => 'btn',
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
				'name'     => 'lightbox_toggler_btn_typography',
				'selector' => '{{WRAPPER}} .xpro-lightbox-btn > .xpro-lightbox-btn-txt',
			)
		);

		$this->start_controls_tabs( 'lightbox_toggler_btn_style' );

		$this->start_controls_tab(
			'lightbox_toggler_btn_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'lightbox_toggler_icon_color',
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
			'lightbox_toggler_txt_color',
			array(
				'label'     => esc_html__( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn > .xpro-lightbox-btn-txt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'lightbox_toggler_bg_color',
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
			'lightbox_toggler_btn_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'lightbox_toggler_hv_icon_color',
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
			'lightbox_toggler_hv_txt_color',
			array(
				'label'     => esc_html__( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn:hover > .xpro-lightbox-btn-txt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'lightbox_toggler_hv_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-lightbox-btn:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'lightbox_toggler_hv_border_color',
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
				'name'     => 'lightbox_toggler_btn_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-lightbox-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'lightbox_toggler_btn_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-lightbox-btn',
			)
		);

		$this->add_responsive_control(
			'lightbox_toggler_btn_border_radius',
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
			'lightbox_toggler_btn_padding',
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
			'lightbox_toggler_btn_margin',
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
					'lightbox_toggler' => 'btn',
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
					'lightbox_toggler' => 'btn',
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
					'lightbox_toggler' => 'icon',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'lightbox/layout/frontend.php';

	}

}
