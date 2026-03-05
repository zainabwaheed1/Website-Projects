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
class Team_Carousel extends Widget_Base {

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
		return 'xpro-team-carousel';
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
		return __( 'Team Carousel', 'xpro-elementor-addons-pro' );
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
		return array( 'team', 'carousel', 'slider' );
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
		return array( 'owl-carousel' );
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
		return array( 'owl-carousel' );
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
					'13' => esc_html__( 'Style 13', 'xpro-elementor-addons-pro' ),
					'14' => esc_html__( 'Style 14', 'xpro-elementor-addons-pro' ),
					'15' => esc_html__( 'Style 15', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
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
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'title_link',
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
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'social_icon_item_1',
			array(
				'label'        => __( 'Social Icon 1', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater->start_popover();

		$repeater->add_control(
			'social_icon_1',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-facebook',
					'library' => 'fa-brands',
				),
				'condition' => array(
					'social_icon_item_1' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'social_icon_link_1',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'is_external' => 'true',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'social_icon_item_1' => 'yes',
				),
			)
		);

		$repeater->end_popover();

		$repeater->add_control(
			'social_icon_item_2',
			array(
				'label'        => __( 'Social Icon 2', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater->start_popover();

		$repeater->add_control(
			'social_icon_2',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-twitter',
					'library' => 'fa-brands',
				),
				'condition' => array(
					'social_icon_item_2' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'social_icon_link_2',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'is_external' => 'true',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'social_icon_item_2' => 'yes',
				),
			)
		);

		$repeater->end_popover();

		$repeater->add_control(
			'social_icon_item_3',
			array(
				'label'        => __( 'Social Icon 3', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater->start_popover();

		$repeater->add_control(
			'social_icon_3',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-instagram',
					'library' => 'fa-brands',
				),
				'condition' => array(
					'social_icon_item_3' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'social_icon_link_3',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'is_external' => 'true',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'social_icon_item_3' => 'yes',
				),
			)
		);

		$repeater->end_popover();

		$repeater->add_control(
			'social_icon_item_4',
			array(
				'label'        => __( 'Social Icon 4', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			)
		);

		$repeater->start_popover();

		$repeater->add_control(
			'social_icon_4',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-youtube',
					'library' => 'fa-brands',
				),
				'condition' => array(
					'social_icon_item_4' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'social_icon_link_4',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'is_external' => 'true',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'social_icon_item_4' => 'yes',
				),
			)
		);

		$repeater->end_popover();

		$this->add_control(
			'item',
			array(
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title'       => __( 'Jhon Walker', 'xpro-elementor-addons-pro' ),
						'designation' => __( 'Managing Director', 'xpro-elementor-addons-pro' ),
						'description' => __( 'It is a long established fact that a reader will be distracted by the content.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title'       => __( 'Sara Anderson', 'xpro-elementor-addons-pro' ),
						'designation' => __( 'Web Developer', 'xpro-elementor-addons-pro' ),
						'description' => __( 'It is a long established fact that a reader will be distracted by the content.', 'xpro-elementor-addons-pro' ),
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
				'default'            => 'yes',
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

		$this->add_control(
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
					'{{WRAPPER}} .xpro-team-layout-inner' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'layout!' => array( '8', '9' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-team-layout-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-team-layout-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-team-layout-inner',
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-layout-inner' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-team-layout-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => __( 'Image', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
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
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image > img' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image > img' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image > img' => 'object-fit: {{VALUE}};',
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
					'{{WRAPPER}} .xpro-team-image > img' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
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
					__( 'Note: Make sure svg support is enable to upload svg file. %1$sRead More%2$s', 'xpro-elementor-addons-pro' ),
					'<a href="https://elementor.com/help/enable-svg-support-in-elementor/" target="_blank">',
					'</a>'
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-team-image > img' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
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
					'{{WRAPPER}} .xpro-team-image > img' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
				),
				'condition'            => array(
					'mask_image' => 'yes',
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
					'{{WRAPPER}} .xpro-team-image > img' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
				),
				'condition' => array(
					'mask_image' => 'yes',
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
					'{{WRAPPER}} .xpro-team-image > img' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mask_image' => 'yes',
					'mask_size'  => 'initial',
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
				'condition'            => array(
					'mask_image' => 'yes',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-team-image > img' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
				),
			)
		);

		$this->end_popover();

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'shape_color',
			array(
				'label'     => __( 'Shape Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-layout-13::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '13' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-image img',
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
			'image_overlay',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-layout-5 .xpro-team-image::before, {{WRAPPER}} .xpro-team-layout-12 .xpro-team-image::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '5', '12' ),
				),
			)
		);

		$this->add_control(
			'shape_hcolor',
			array(
				'label'     => __( 'Shape Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-layout-13:hover::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '13' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .xpro-team-layout-inner:hover .xpro-team-image img',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image img' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-image > img',
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
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-image > img',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image,{{WRAPPER}} .xpro-team-wrapper .xpro-team-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '9',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_responsive_control(
			'content_height',
			array(
				'label'      => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-layout-6 .xpro-team-content' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '6',
				),
			)
		);

		$this->add_control(
			'content_backdrop_blur',
			array(
				'label'     => esc_html__( 'Backdrop Blur', 'xpro-elementor-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 3,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-layout-6 .xpro-team-content:before' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				),
				'condition' => array(
					'layout' => '6',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-content,{{WRAPPER}} .xpro-team-layout-9 .xpro-team-inner-content',
				'condition' => array(
					'layout!' => array( '15' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'content_border',
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-content',
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-layout-9 .xpro-team-description::before' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => '9',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-content,{{WRAPPER}} .xpro-team-layout-9 .xpro-team-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'title_color',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-designation' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-designation',
			)
		);

		$this->add_responsive_control(
			'designation_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-team-wrapper .xpro-team-description',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Social Icon
		$this->start_controls_section(
			'section_social_icon_style',
			array(
				'label' => __( 'Social', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 50,
					),
				),
				'default'    => array(
					'size' => 16,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_space',
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
					'{{WRAPPER}} .xpro-team-wrapper .xpro-team-social-list > li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-team-layout-9 .xpro-team-social-list > li,
					 {{WRAPPER}} .xpro-team-layout-13 .xpro-team-social-list > li,
					 {{WRAPPER}} .xpro-team-layout-15 .xpro-team-social-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'social_icon_style' );

		$this->start_controls_tab(
			'icon_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon > i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_wrapper_bg',
			array(
				'label'     => __( 'Wrapper Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-layout-15 .xpro-team-social-list' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '15' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:hover > i, {{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:focus > i'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:hover > svg, {{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:focus  svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_hbg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:hover,{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:hover, {{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border',
				'selector'  => '{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-social-list .xpro-team-social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '13' ),
				),
			)
		);

		$this->add_control(
			'heading_social_wrapper',
			array(
				'label'     => __( 'Wrapper', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => array( '8', '9' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_wrapper_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-team-layout-8 .xpro-team-social-list,{{WRAPPER}} .xpro-team-layout-9 .xpro-team-social-list',
				'condition' => array(
					'layout' => array( '8', '9' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_wrapper_border',
				'selector'  => '{{WRAPPER}} .xpro-team-layout-8 .xpro-team-social-list,{{WRAPPER}} .xpro-team-layout-9 .xpro-team-social-list',
				'condition' => array(
					'layout' => array( '8', '9' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-layout-8 .xpro-team-social-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '8' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_wrapper_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-layout-8 .xpro-team-social-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .xpro-team-layout-9 .xpro-team-social-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '8', '9' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_wrapper_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-team-layout-8 .xpro-team-social-list'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .xpro-team-layout-15 .xpro-team-social-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '8', '15' ),
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
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nav_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next:hover' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-owl-theme .owl-nav > button.owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-dots-horizontal-style-2.owl-carousel .owl-dots > .owl-dot.active' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_control(
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
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
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
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-dots' => 'bottom: -{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'dots_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot.active' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-owl-theme .owl-dots > button.owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'team-carousel/layout/frontend.php';

	}

}
