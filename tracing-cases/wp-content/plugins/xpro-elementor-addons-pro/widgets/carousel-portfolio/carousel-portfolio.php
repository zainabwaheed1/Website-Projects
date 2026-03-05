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
use XproElementorAddons\Control\Xpro_Elementor_Image_Selector;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Xpro Elementor Addons
 *
 * Elementor widget for Carousel Gallery.
 *
 * @since 0.1.8
 */
class Carousel_Portfolio extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-carousel-portfolio';
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
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Carousel Portfolio', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-carousel-portfolio xpro-widget-pro-label';
	}

	/**
	 * Retrieve the widget keywords.
	 *
	 * @return string[] Widget keywords.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_keywords() {
		return array( 'carousel', 'gallery', 'lightbox', 'album' );
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_categories() {
		return array( 'xpro-widgets-pro' );
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

		return array( 'slick', 'owl-carousel' );

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
		return array( 'slick', 'owl-carousel', 'gsap' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 0.1.8
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_carousel_gallery',
			array(
				'label' => __( 'Portfolio', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'carousel_layout',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'simple',
				'options'            => array(
					'simple'   => __( 'Simple', 'xpro-elementor-addons-pro' ),
					'creative' => __( 'Creative', 'xpro-elementor-addons-pro' ),
					'unique'   => __( 'Unique', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Featured Image', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'title_text',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Type portfolio item title.', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'desc_text',
			array(
				'label'       => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => __( 'Type portfolio item description.', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'preview_link',
			array(
				'label'       => __( 'Preview Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'url',
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'gallery',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
				/* translators: %s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{title_text}}'
				),
				'render_type' => 'template',
				'default'     => array(
					array(
						'title_text' => __( 'Portfolio Title 1', 'xpro-elementor-addons-pro' ),
						'desc_text'  => __( 'Carousel Portfolio', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title_text' => __( 'Portfolio Title 2', 'xpro-elementor-addons-pro' ),
						'desc_text'  => __( 'Carousel Portfolio', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'medium_large',
				'separator' => 'before',
			)
		);

		$this->end_controls_section();

		//Carousel Tab
		$this->start_controls_section(
			'section_advance',
			array(
				'label' => __( 'Advanced', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'item_per_row',
			array(
				'label'              => __( 'Items To Show', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust items to show in a row.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 2,
				'desktop_default'    => 2,
				'tablet_default'     => 2,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
				'condition'          => array(
					'carousel_layout!' => 'unique',
				),
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label'              => __( 'Height', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the height of portfolio items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 400,
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
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-img > img' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'carousel_layout'    => 'simple',
				),
			)
		);

		$this->add_responsive_control(
			'creative_item_height',
			array(
				'label'              => __( 'Height', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the height of portfolio items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 400,
				),
				'range'              => array(
					'px' => array(
						'min' => 300,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-type-creative .xpro-item-img > img,{{WRAPPER}} .xpro-elementor-carousel-gallery-type-creative .xpro-elementor-carousel-content-area' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} xpro-elementor-carousel-content-right'                                                                                                                          => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'carousel_layout' => array( 'creative' ),
				),
			)
		);

		$this->add_responsive_control(
			'unqiue_item_height',
			array(
				'label'              => __( 'Height', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the height of portfolio items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 800,
				),
				'range'              => array(
					'px' => array(
						'min' => 300,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-slick-slider-full,{{WRAPPER}} .xpro-slick-slider-full .xpro-item-img' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'carousel_layout' => array( 'unique' ),
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
						'max' => 100,
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
				'condition'    => array(
					'carousel_layout!' => 'unique',
				),
			)
		);

		$this->add_control(
			'caption',
			array(
				'label'        => __( 'Title', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show item title.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'        => __( 'Description', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show item description.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'button',
			array(
				'label'        => __( 'Button', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show item button.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		//Popup Tab
		$this->start_controls_section(
			'section_preview',
			array(
				'label' => __( 'Preview', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'preview_type',
			array(
				'label'              => __( 'Preview Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'popup' => __( 'Popup', 'xpro-elementor-addons-pro' ),
					'link'  => __( 'External Link', 'xpro-elementor-addons-pro' ),
					'none'  => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'popup_layout',
			array(
				'label'              => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'layout-1',
				'options'            => array(
					'layout-1'  => __( 'Layout 1', 'xpro-elementor-addons-pro' ),
					'layout-2'  => __( 'Layout 2', 'xpro-elementor-addons-pro' ),
					'layout-3'  => __( 'Layout 3', 'xpro-elementor-addons-pro' ),
					'layout-4'  => __( 'Layout 4', 'xpro-elementor-addons-pro' ),
					'layout-5'  => __( 'Layout 5', 'xpro-elementor-addons-pro' ),
					'layout-6'  => __( 'Layout 6', 'xpro-elementor-addons-pro' ),
					'layout-7'  => __( 'Layout 7', 'xpro-elementor-addons-pro' ),
					'layout-8'  => __( 'Layout 8', 'xpro-elementor-addons-pro' ),
					'layout-9'  => __( 'Layout 9', 'xpro-elementor-addons-pro' ),
					'layout-10' => __( 'Layout 10', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'preview_type' => 'popup',
				),
			)
		);

		$this->add_control(
			'popup_animation',
			array(
				'label'              => __( 'Popup Animation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1' => __( 'Slice Left', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Slice Right', 'xpro-elementor-addons-pro' ),
					'3' => __( 'Slot Top', 'xpro-elementor-addons-pro' ),
					'4' => __( 'Slot Bottom', 'xpro-elementor-addons-pro' ),
					'5' => __( 'Reveal Left', 'xpro-elementor-addons-pro' ),
					'6' => __( 'Reveal Right', 'xpro-elementor-addons-pro' ),
					'7' => __( 'Reveal Top', 'xpro-elementor-addons-pro' ),
					'8' => __( 'Reveal Bottom', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'preview_type' => 'popup',
				),
			)
		);

		$this->add_control(
			'preview_target',
			array(
				'label'              => __( 'Preview Type', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Specifies where to open the linked document.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '_blank',
				'options'            => array(
					'_blank' => __( 'Blank', 'xpro-elementor-addons-pro' ),
					'_self'  => __( 'Self', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'preview_type' => 'link',
				),
			)
		);

		$this->end_controls_section();

		//Carousel Settings Tab
		$this->start_controls_section(
			'section_carousel',
			array(
				'label' => __( 'Settings', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'              => __( 'Loop', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Duplicate last and first items to get loop illusion.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'lazyload',
			array(
				'label'              => __( 'Lazy Load', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Lazy load images for fast load.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'mouse_drag',
			array(
				'label'              => __( 'Mouse Drag', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Mouse drag enabled.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'center',
			array(
				'label'              => __( 'Center Item', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Works well with even an odd number of items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'text_outside!'    => 'yes',
					'carousel_layout!' => 'unique',
				),
			)
		);

		$this->add_control(
			'center_item_bg',
			array(
				'label'       => __( 'Center Before', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Center item shape color.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .owl-item::before' => 'background-color: {{VALUE}}',
				),
				'condition'   => array(
					'center' => 'yes',
				),
			)
		);

		$this->add_control(
			'custom_width',
			array(
				'label'              => __( 'Custom Width', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To set custom with to item.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'center' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'item_width',
			array(
				'label'              => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vw' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 500,
				),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'center'       => 'yes',
					'custom_width' => 'yes',
				),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'rtl',
			array(
				'label'              => __( 'RTL', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Change direction from Right to left.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel' => 'direction: rtl;',
				),
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => __( 'Autoplay', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To enable autoplay behaviour.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'autoplay_timeout',
			array(
				'label'              => __( 'Autoplay Timeout', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Autoplay interval timeout in seconds(s).', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 3,
				),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'nav',
			array(
				'label'              => __( 'Show Nav', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show next/prev buttons.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'              => __( 'Show Dots', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show dots navigation.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'carousel_layout!' => 'unique',
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_overlay_style',
			array(
				'label'     => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'carousel_layout!' => 'unique',
				),
			)
		);

		$this->add_control(
			'hover_effect',
			array(
				'label'              => __( 'Hover Effect', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'zoom-box-out',
				'options'            => array(
					'zoom'               => __( 'Zoom', 'xpro-elementor-addons-pro' ),
					'fadeIn'             => __( 'Fade In', 'xpro-elementor-addons-pro' ),
					'classic'            => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'zoom-top-bottom'    => __( 'Zoom Top', 'xpro-elementor-addons-pro' ),
					'zoom-center-bottom' => __( 'Zoom Center', 'xpro-elementor-addons-pro' ),
					'zoom-box'           => __( 'Zoom Box', 'xpro-elementor-addons-pro' ),
					'zoom-box-out'       => __( 'Zoom Box Out', 'xpro-elementor-addons-pro' ),
					'moveRight'          => __( 'Move Right', 'xpro-elementor-addons-pro' ),
					'moveLeft'           => __( 'Move Left', 'xpro-elementor-addons-pro' ),
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
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-slide-caption',
			)
		);

		$this->add_control(
			'outline_color',
			array(
				'label'     => __( 'Outline Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-carousel-hover-style-zoom-box .xpro-elementor-carousel-gallery-item-inner:before, {{WRAPPER}} .xpro-carousel-hover-style-zoom-box .xpro-elementor-carousel-gallery-item-inner:after, {{WRAPPER}} .xpro-carousel-hover-style-zoom-box-out .xpro-elementor-carousel-gallery-item-inner:before,{{WRAPPER}} .xpro-carousel-hover-style-zoom-box-out .xpro-elementor-carousel-gallery-item-inner:after' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'hover_effect' => array( 'zoom-box', 'zoom-box-out' ),
				),
			)
		);

		$this->add_control(
			'mask_image',
			array(
				'label'        => __( 'Mask', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-item' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-item' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-item' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-item' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-item' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery-item' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
				),
			)
		);

		$this->end_popover();

		$this->add_control(
			'overlay_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-slide-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'icon'             => 'yes',
					'carousel_layout!' => 'unique',
				),
			)
		);

		$this->add_control(
			'icon_name',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-expand-arrows-alt',
					'library' => 'fa-solid',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon:hover > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon:hover > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hbg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hborder',
			array(
				'label'     => __( 'Icon Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon:hover' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-overlay-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption_style',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'caption' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-title,{{WRAPPER}} .xpro-slick-slider-full .xpro-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'caption_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-title,{{WRAPPER}} .xpro-slick-slider-full .xpro-title',
			)
		);

		$this->add_responsive_control(
			'caption_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-title,{{WRAPPER}} .xpro-slick-slider-full .xpro-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'description' => 'yes',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-desc,{{WRAPPER}} .xpro-slick-slider-full .xpro-desc' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-desc,{{WRAPPER}} .xpro-slick-slider-full .xpro-desc',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-desc,{{WRAPPER}} .xpro-slick-slider-full .xpro-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'button' => 'yes',

				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Read More', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'Read More', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn',
			)
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn:hover, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_hbg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn:hover, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn:hover, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-item-btn, {{WRAPPER}} .xpro-slick-slider-full .xpro-item-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_preview_style',
			array(
				'label'     => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'preview_type' => 'popup',
				),
			)
		);

		$this->add_control(
			'preview_overlay',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-portfolio-loader li' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_background',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_background_separator',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview .xpro-preview-header, .xpro-preview-arrow,{{WRAPPER}} .xpro-preview-demo-name,{{WRAPPER}} .xpro-preview-close' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_heading',
			array(
				'label'     => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'preview_close_style_tabs'
		);

		$this->start_controls_tab(
			'preview_close_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_close_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_border',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'preview_close_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_close_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_close_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-close:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'preview_nav_heading',
			array(
				'label'     => __( 'Next/Prev Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'preview_nav_style_tabs'
		);

		$this->start_controls_tab(
			'preview_nav_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_nav_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_border',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'preview_nav_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'preview_nav_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo:hover,{{WRAPPER}} .xpro-preview-next-demo:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo:hover,{{WRAPPER}} .xpro-preview-next-demo:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'preview_nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-prev-demo:hover,{{WRAPPER}} .xpro-preview-next-demo:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'preview_nav_typography',
				'label'    => __( 'Next/Prev Typo', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-preview-prev-demo,{{WRAPPER}} .xpro-preview-next-demo',
			)
		);

		$this->add_control(
			'preview_title_heading',
			array(
				'label'     => __( 'Preview Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'preview_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-preview-demo-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'preview_title_typography',
				'label'    => __( 'Title Typo', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-preview-demo-name',
			)
		);

		$this->end_controls_section();

		//Nav Style
		$this->start_controls_section(
			'section_nav_style',
			array(
				'label'     => __( 'Nav', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'nav' => 'yes',
				),
			)
		);

		$this->add_control(
			'nav_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'style-4' => __( 'Style 4', 'xpro-elementor-addons-pro' ),
					'style-5' => __( 'Style 5', 'xpro-elementor-addons-pro' ),
					'style-6' => __( 'Style 6', 'xpro-elementor-addons-pro' ),
					'style-7' => __( 'Style 7', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_responsive_control(
			'nav_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev,
					 {{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev,
					 {{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_position',
			array(
				'label'       => __( 'Position', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Next/Prev buttons horizontal position.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'default'     => array(
					'size' => - 20,
				),
				'range'       => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'condition'   => array(
					'carousel_layout!' => 'unique',
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'news_ticker_nav_style_tabs'
		);

		$this->start_controls_tab(
			'nav_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev,
					{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg_color',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev,
					{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'news_ticker_nav_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev:hover,
					{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hover_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev:hover,
					 {{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next:hover,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hover_border',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev:hover,
					{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next:hover,,
					 {{WRAPPER}} .xpro-slider-slick-arrows > button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'nav_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev,{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,{{WRAPPER}} .xpro-slider-slick-arrows > button',
			)
		);

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-prev, 
					{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-nav button.owl-next,
					{{WRAPPER}} .xpro-slider-slick-arrows > button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Dots Styling
		$this->start_controls_section(
			'dots_styling',
			array(
				'label'     => __( 'Dots', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dots' => 'yes',
				),
			)
		);

		$this->add_control(
			'dots_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_responsive_control(
			'dots_bg_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_bg_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-dots-horizontal-style-2.owl-carousel .owl-dot.active' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_responsive_control(
			'dots_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot' => 'margin: 0 {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'dots_space',
			array(
				'label'      => __( 'Spacing', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dots' => 'bottom: -{{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->start_controls_tabs(
			'dots_style_tabs'
		);

		$this->start_controls_tab(
			'dots_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'dots_bg_color',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dots_active_tab_style',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'dots_hover_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_hover_border',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot.active' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'dots_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot',
			)
		);

		$this->add_responsive_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_responsive_control(
			'slick_slider_image',
			array(
				'label'       => __( 'Image Width', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%', 'vw' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
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
				'default'     => array(
					'unit' => '%',
					'size' => 75,
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-slick-right-content' => 'width: {{SIZE}}{{UNIT}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'carousel_layout' => 'unique',
				),
			)
		);

		$this->add_responsive_control(
			'slick_slider_content',
			array(
				'label'       => __( 'Content Width', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%', 'vw' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
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
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-slick-left-content' => 'width: {{SIZE}}{{UNIT}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'carousel_layout' => 'unique',
				),
			)
		);

		$this->add_responsive_control(
			'slick_content_position',
			array(
				'label'      => __( 'Content Position', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
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
					'unit' => '%',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-slick-left-content' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'carousel_layout' => 'unique',
				),
			)
		);

		$this->add_control(
			'text_outside',
			array(
				'label'        => __( 'Content Outside', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'carousel_layout' => 'simple',
				),

			)
		);

		$this->add_responsive_control(
			'text_outside_align',
			array(
				'label'      => __( 'Content Alignment', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => array(
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
				'default'    => 'left',
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-content-right, {{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-outside-content' => 'text-align: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '===',
							'value'    => 'creative',
						),
						array(
							'name'     => 'text_outside',
							'operator' => '===',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$this->add_control(
			'misc_background',
			array(
				'label'      => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-gallery-item-wrapper,{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-content-area, {{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-outside-content, {{WRAPPER}} .xpro-slick-slider-full' => 'background-color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '===',
							'value'    => 'creative',
						),
						array(
							'name'     => 'carousel_layout',
							'operator' => '===',
							'value'    => 'unique',
						),
						array(
							'name'     => 'text_outside',
							'operator' => '===',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$this->add_control(
			'misc_content_padding',
			array(
				'label'      => __( 'Content Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-content-right, {{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-outside-content, {{WRAPPER}} .xpro-slick-left-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '===',
							'value'    => 'creative',
						),
						array(
							'name'     => 'carousel_layout',
							'operator' => '===',
							'value'    => 'unique',
						),
						array(
							'name'     => 'text_outside',
							'operator' => '===',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'misc_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-gallery-item-wrapper,{{WRAPPER}} .xpro-slick-slider-full',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mis_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-gallery-item-wrapper,{{WRAPPER}} .xpro-slick-slider-full',
			)
		);

		$this->add_control(
			'misc_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery .xpro-elementor-carousel-gallery-item-wrapper, {{WRAPPER}}  .xpro-elementor-carousel-gallery .owl-item::before,{{WRAPPER}} .xpro-slick-slider-full' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 *
	 * @access protected
	 */
	protected function render() {

		$settings      = $this->get_settings_for_display();
		$album_gallery = $this->get_settings_for_display( 'gallery' );

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'carousel-portfolio/layout/frontend.php';

	}

}
