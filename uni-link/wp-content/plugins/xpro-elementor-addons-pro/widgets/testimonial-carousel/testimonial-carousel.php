<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Group_Control_Foreground;
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
class Testimonial_Carousel extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

			wp_register_style( 'swiper', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/css/swiper.min.css', null, '8.4.5' );
			wp_register_script( 'swiper', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/js/swiper.min.js', array( 'jquery' ), '8.4.5', true );
	}

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
		return 'xpro-testimonial-carousel';
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
		return __( 'Testimonial Carousel', 'xpro-elementor-addons-pro' );
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
		return 'xi-team-carousel xpro-widget-pro-label';
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
		return array( 'testimonial', 'rating', 'review', 'feedback', 'slider', 'carousel' );
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

		return array( 'swiper' );

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
		return array( 'swiper' );
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
			'layout',
			array(
				'label'              => esc_html__( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1'  => esc_html__( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2'  => esc_html__( 'Style 2', 'xpro-elementor-addons-pro' ),
					'3'  => esc_html__( 'Style 3', 'xpro-elementor-addons-pro' ),
					'4'  => esc_html__( 'Style 4', 'xpro-elementor-addons-pro' ),
					'5'  => esc_html__( 'Style 5', 'xpro-elementor-addons-pro' ),
					'6'  => esc_html__( 'Style 6', 'xpro-elementor-addons-pro' ),
					'7'  => esc_html__( 'Style 7', 'xpro-elementor-addons-pro' ),
					'8'  => esc_html__( 'Style 8', 'xpro-elementor-addons-pro' ),
					'9'  => esc_html__( 'Style 9', 'xpro-elementor-addons-pro' ),
					'10' => esc_html__( 'Style 10', 'xpro-elementor-addons-pro' ),
					'11' => esc_html__( 'Style 11', 'xpro-elementor-addons-pro' ),
					'12' => esc_html__( 'Style 12', 'xpro-elementor-addons-pro' ),
				),
				'render_type'        => 'template',
				'style_transfer'     => true,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'ratting_style',
			array(
				'label'          => __( 'Rating Layout', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => array(
					'none' => __( 'None', 'xpro-elementor-addons-pro' ),
					'star' => __( 'Star', 'xpro-elementor-addons-pro' ),
					'num'  => __( 'Number', 'xpro-elementor-addons-pro' ),
				),
				'default'        => 'star',
				'style_transfer' => true,
			)
		);

		$this->add_control(
			'show_quote',
			array(
				'label'       => __( 'Show Quote', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'   => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'default'     => 'yes',
				'condition'   => array(
					'layout!' => array( '6', '9', '10' ),
				),
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'quote_icon',
			array(
				'label'     => esc_html__( 'Icons', 'xpro-elementor-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-quote-left',
					'library' => 'solid',
				),
				'condition' => array(
					'show_quote' => 'yes',
					'layout!'    => array( '6', '9', '10' ),
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
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

		$repeater->add_control(
			'name',
			array(
				'label'       => __( 'Name', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Jhon Walker', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'name_link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'designation',
			array(
				'label'       => __( 'Designation', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Managing Director', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'separator'   => 'before',
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
				'default'     => __( 'It is a long established fact that a reader will be distracted by the readable content.', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'ratting',
			array(
				'label'      => __( 'Rating', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'separator'  => 'before',
				'default'    => array(
					'unit' => 'px',
					'size' => 4,
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				),
				'dynamic'    => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'item',
			array(
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'name'        => __( 'Jhon Walker', 'xpro-elementor-addons-pro' ),
						'designation' => __( 'Managing Director', 'xpro-elementor-addons-pro' ),
						'description' => __( 'It is a long established fact that a reader will be distracted by the readable content.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'name'        => __( 'Sara Anderson', 'xpro-elementor-addons-pro' ),
						'designation' => __( 'Web Developer', 'xpro-elementor-addons-pro' ),
						'description' => __( 'It is a long established fact that a reader will be distracted by the readable content.', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'before',
				'exclude'   => array( 'image' ),
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

		$this->add_responsive_control(
			'item_per_row',
			array(
				'label'              => __( 'Items To Show', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust items to show in a row.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 2,
				'desktop_default'    => 2,
				'tablet_default'     => 1,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
				'condition'          => array(
					'layout!' => array( '11', '12' ),
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
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-testimonial-slider' => 'padding: {{SIZE}}{{UNIT}};',
				),
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
			'auto_height',
			array(
				'label'              => __( 'Auto Height', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adaptive its height of the currently active item.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
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
				'label'          => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::CHOOSE,
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
				'mobile_default' => 'center',
				'prefix_class'   => 'xpro-testimonial-align-%s',
				'selectors'      => array(
					'{{WRAPPER}} .swiper-slide .elementor-widget-container' => 'text-align: {{VALUE}};',
				),
				'condition'      => array(
					'layout!' => array( '11', '12' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
//				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-layout-1 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-2 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-3 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-4 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-5 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-6 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-7 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-8 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-9 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-10 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-11 > .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-12 > .elementor-widget-container',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-layout-1 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-2 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-3 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-4 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-5 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-6 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-7 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-8 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-9 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-10 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-11 > .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-12 > .elementor-widget-container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-layout-1 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-2 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-3 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-4 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-5 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-6 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-7 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-8 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-9 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-10 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-11 > .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-12 > .elementor-widget-container',
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-layout-1 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-2 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-3 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-4 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-5 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-6 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-7 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-8 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-9 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-10 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-11 > .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-12 > .elementor-widget-container' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-layout-1 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-2 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-3 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-4 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-5 .xpro-testimonial-inner-wrapper,{{WRAPPER}} .xpro-testimonial-layout-6 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-7 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-8 .xpro-testimonial-content,{{WRAPPER}} .xpro-testimonial-layout-9 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-10 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-11 > .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-12 > .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_margin',
			array(
				'label'              => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'allowed_dimensions' => 'vertical',
				'placeholder'        => array(
					'top'    => '',
					'right'  => 'auto',
					'bottom' => '',
					'left'   => 'auto',
				),
				'size_units'         => array( 'px', '%', 'em' ),
				'selectors'          => array(
					'{{WRAPPER}} .xpro-testimonial-layout-9 .elementor-widget-container,{{WRAPPER}} .xpro-testimonial-layout-10 .elementor-widget-container' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
				),
				'condition'          => array(
					'layout' => array( '10', '9' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout!' => array( '11', '12' ),
				),
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
					'{{WRAPPER}} .xpro-testimonial-image > img' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-testimonial-image > img' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-testimonial-image > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .xpro-testimonial-image > img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .swiper-slide .elementor-widget-container:hover .xpro-testimonial-image > img',
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
					'{{WRAPPER}} .xpro-testimonial-image > img' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .xpro-testimonial-image > img',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .xpro-testimonial-image > img',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-image > img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_name',
			array(
				'label' => __( 'Name', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-title',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'name_color',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-title',
			)
		);

		$this->add_responsive_control(
			'name_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_designation',
			array(
				'label'     => __( 'Designation', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'designation_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-testimonial-designation' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-designation',
			)
		);

		$this->add_responsive_control(
			'designation_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_description',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-testimonial-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-testimonial-description',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Rating
		$this->start_controls_section(
			'section_rating_style',
			array(
				'label'     => __( 'Rating', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ratting_style!' => 'none',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'rating_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-rating-layout-num',
				'condition' => array(
					'ratting_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'ratting_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array(
					'ratting_style' => 'star',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-rating' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'ratting_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'condition'  => array(
					'ratting_style' => 'star',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-rating > i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'rating_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-testimonial-rating, {{WRAPPER}} .xpro-rating-layout-star > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'rating_fill',
			array(
				'label'     => __( 'Filled', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-rating-layout-star > .xpro-rating-filled' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ratting_style' => 'star',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'rating_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-rating-layout-num',
				'condition' => array(
					'ratting_style' => 'num',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'rating_border',
				'selector'  => '{{WRAPPER}} .xpro-rating-layout-num',
				'separator' => 'before',
				'condition' => array(
					'ratting_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'rating_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rating-layout-num' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ratting_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'rating_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-rating-layout-num' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ratting_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'rating_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Quote
		$this->start_controls_section(
			'section_quote_style',
			array(
				'label'     => __( 'Quote', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_quote' => 'yes',
					'layout!'    => array( '6', '9', '10' ),
				),
			)
		);

		$this->add_control(
			'quote_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-testimonial-quote > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-testimonial-quote > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'quote_sizes',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-quote > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-testimonial-quote > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '6', '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'quote_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '6', '9', '10' ),
				),
			)
		);

		$this->end_controls_section();

		//Nav
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
				'default'    => array(
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_position',
			array(
				'label'       => __( 'Position', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Next/Prev buttons horziontal position.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'default'     => array(
					'size' => - 25,
				),
				'range'       => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'nav_style_tabs'
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
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nav_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-button-prev:hover,{{WRAPPER}} .swiper-button-next:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-button-prev:hover,{{WRAPPER}} .swiper-button-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-button-prev:hover,{{WRAPPER}} .swiper-button-next:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-button-prev,{{WRAPPER}} .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Dots
		$this->start_controls_section(
			'section_dots_style',
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

		$this->add_control(
			'dots_bg_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_bg_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-swiper-dots-horizontal-style-2 .swiper-pagination .swiper-pagination-bullet-active' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_control(
			'dots_space_between',
			array(
				'label'       => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'default'     => array(
					'size' => 3,
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_spacing',
			array(
				'label'      => __( 'Spacing', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-swiper-slider-theme .swiper-pagination.swiper-pagination-horizontal ' => 'bottom: -{{SIZE}}{{UNIT}};',
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
			'dots_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'dots_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet',
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
			'dots_abg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_aborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_thumb_style',
			array(
				'label'     => __( 'Thumbs', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => array( '11', '12' ),
				),
			)
		);

		$this->add_responsive_control(
			'thumb_size',
			array(
				'label'       => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-testimonial-thumbs .xpro-testimonial-image'                                   => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-testimonial-thumbs-layout-11, {{WRAPPER}} .xpro-testimonial-thumbs-layout-12' => 'width: calc({{SIZE}}{{UNIT}} * 3.5);',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'thumb_border',
				'selector' => '{{WRAPPER}} .xpro-testimonial-thumbs .xpro-testimonial-image',
			)
		);

		$this->add_responsive_control(
			'thumb_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-testimonial-thumbs .xpro-testimonial-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'testimonial-carousel/layout/frontend.php';

	}

}
