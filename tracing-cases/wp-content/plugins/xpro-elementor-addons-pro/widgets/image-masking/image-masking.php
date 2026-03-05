<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Image_Selector;
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
class Image_Masking extends Widget_Base {

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
		return 'xpro-image-masking';
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
		return __( 'Image Masking', 'xpro-elementor-addons-pro' );
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
		return 'xi-image-masking xpro-widget-pro-label';
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
		return array( 'image', 'photo', 'visual', 'masking' );
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
			'section_image',
			array(
				'label' => __( 'Image', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'mask_image',
			array(
				'label'        => __( 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_control(
			'mask_shape',
			array(
				'label'   => __( 'Mask Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'default',
				'options' => array(
					'default' => array(
						'title' => _x( 'Default Shapes', 'Mask Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image-bold',
					),
					'custom'  => array(
						'title' => _x( 'Custom Shape', 'Mask Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-upload',
					),
				),
				'toggle'  => false,
			)
		);

		$this->add_control(
			'mask_shape_default',
			array(
				'label'                => _x( 'Default', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'label_block'          => true,
				'show_label'           => false,
				'type'                 => Xpro_Elementor_Image_Selector::TYPE,
				'default'              => 'shape1',
				'options'              => xpro_elementor_masking_shape_list( 'list' ),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
				),
				'selectors_dictionary' => xpro_elementor_masking_shape_list( 'url' ),
				'condition'            => array(
					'mask_image' => 'yes',
					'mask_shape' => 'default',
				),
			)
		);

		$this->add_control(
			'mask_custom_shape',
			array(
				'label'       => _x( 'Custom Shape', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::MEDIA,
				'show_label'  => false,
				'description' => sprintf(
				/* translators: %s: Title */
					__( 'Note: Make sure svg support is enable to upload svg file. %1$sRead More%2$s', 'xpro-elementor-addons-pro' ),
					'<a href="https://elementor.com/help/enable-svg-support-in-elementor/" target="_blank">',
					'</a>'
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
				),
				'condition'   => array(
					'mask_image' => 'yes',
					'mask_shape' => 'custom',
				),
			)
		);

		$this->add_control(
			'mask_position',
			array(
				'label'                => _x( 'Position', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'center-center',
				'options'              => array(
					'center-center' => _x( 'Center Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'center-left'   => _x( 'Center Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'center-right'  => _x( 'Center Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-center'    => _x( 'Top Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-left'      => _x( 'Top Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-right'     => _x( 'Top Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-center' => _x( 'Bottom Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => _x( 'Bottom Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => _x( 'Bottom Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'center-center' => 'center center',
					'center-left'   => 'center left',
					'center-right'  => 'center right',
					'top-center'    => 'top center',
					'top-left'      => 'top left',
					'top-right'     => 'top right',
					'bottom-center' => 'bottom center',
					'bottom-left'   => 'bottom left',
					'bottom-right'  => 'bottom right',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'mask_size',
			array(
				'label'     => _x( 'Size', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'contain',
				'options'   => array(
					'auto'    => _x( 'Auto', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'cover'   => _x( 'Cover', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'contain' => _x( 'Contain', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'initial' => _x( 'Custom', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'mask_custom_size',
			array(
				'label'      => _x( 'Custom Size', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'em' => array(
						'min' => 0,
						'max' => 100,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 100,
					'unit' => '%',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mask_size' => 'initial',
				),
			)
		);

		$this->add_control(
			'mask_repeat',
			array(
				'label'                => _x( 'Repeat', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'no-repeat',
				'options'              => array(
					'repeat'          => _x( 'Repeat', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'repeat-x'        => _x( 'Repeat-x', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'repeat-y'        => _x( 'Repeat-y', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'space'           => _x( 'Space', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'round'           => _x( 'Round', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'no-repeat'       => _x( 'No-repeat', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'repeat-space'    => _x( 'Repeat Space', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'round-space'     => _x( 'Round Space', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'no-repeat-round' => _x( 'No-repeat Round', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'repeat'          => 'repeat',
					'repeat-x'        => 'repeat-x',
					'repeat-y'        => 'repeat-y',
					'space'           => 'space',
					'round'           => 'round',
					'no-repeat'       => 'no-repeat',
					'repeat-space'    => 'repeat space',
					'round-space'     => 'round space',
					'no-repeat-round' => 'no-repeat round',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
			)
		);

		$this->add_control(
			'link_to',
			array(
				'label'   => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
					'file'   => __( 'Media File', 'xpro-elementor-addons-pro' ),
					'custom' => __( 'Custom URL', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'link_to' => 'custom',
				),
				'show_label'  => false,
			)
		);

		$this->add_control(
			'open_lightbox',
			array(
				'label'     => __( 'Lightbox', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
					'yes'     => __( 'Yes', 'xpro-elementor-addons-pro' ),
					'no'      => __( 'No', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'link_to' => 'file',
				),
			)
		);

		$this->add_control(
			'view',
			array(
				'label'   => __( 'View', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => __( 'Image', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'          => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%', 'px', 'vw' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-image img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'space',
			array(
				'label'          => __( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%', 'px', 'vw' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'          => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => 'px',
				),
				'tablet_default' => array(
					'unit' => 'px',
				),
				'mobile_default' => array(
					'unit' => 'px',
				),
				'size_units'     => array( 'px', 'vh' ),
				'range'          => array(
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
					'vh' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-image img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-fit',
			array(
				'label'     => __( 'Object Fit', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array(
					'height[size]!' => '',
				),
				'options'   => array(
					''        => __( 'Default', 'xpro-elementor-addons-pro' ),
					'fill'    => __( 'Fill', 'xpro-elementor-addons-pro' ),
					'cover'   => __( 'Cover', 'xpro-elementor-addons-pro' ),
					'contain' => __( 'Contain', 'xpro-elementor-addons-pro' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-image img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'object_position',
			array(
				'label'                => __( 'Object Position', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => '',
				'condition'            => array(
					'height[size]!' => '',
				),
				'options'              => array(
					''              => __( 'Default', 'xpro-elementor-addons-pro' ),
					'center-center' => _x( 'Center Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'center-left'   => _x( 'Center Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'center-right'  => _x( 'Center Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-center'    => _x( 'Top Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-left'      => _x( 'Top Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-right'     => _x( 'Top Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-center' => _x( 'Bottom Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => _x( 'Bottom Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => _x( 'Bottom Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'center-center' => 'center center',
					'center-left'   => 'center left',
					'center-right'  => 'center right',
					'top-center'    => 'top center',
					'top-left'      => 'top left',
					'top-right'     => 'top right',
					'bottom-center' => 'bottom center',
					'bottom-left'   => 'bottom left',
					'bottom-right'  => 'bottom right',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image img' => 'object-position: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'separator_panel_style',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			)
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'opacity',
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
					'{{WRAPPER}} .xpro-image img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .xpro-image img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'opacity_hover',
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
					'{{WRAPPER}} .xpro-image:hover img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .xpro-image:hover img',
			)
		);

		$this->add_control(
			'background_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-image img' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->add_control(
			'image_hover_animation',
			array(
				'label' => __( 'Hover Animation', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .xpro-image img',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .xpro-image img',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			array(
				'label'     => __( 'Caption', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'caption_source!' => 'none',
				),
			)
		);

		$this->add_control(
			'caption_align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
				),
				'global'    => array(
					'default' => Global_Colors::COLOR_TEXT,
				),
			)
		);

		$this->add_control(
			'caption_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .widget-image-caption',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .widget-image-caption',
			)
		);

		$this->add_responsive_control(
			'caption_space',
			array(
				'label'     => __( 'Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
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

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'image-masking/layout/frontend.php';

	}

	/**
	 * Render image widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 0.1.8
	 * @access protected
	 */
	protected function content_template() {
	}

	/**
	 * Retrieve image widget link URL.
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 * @since 0.1.8
	 * @access private
	 *
	 */
	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return array(
			'url' => $settings['image']['url']
		);
	}

}
