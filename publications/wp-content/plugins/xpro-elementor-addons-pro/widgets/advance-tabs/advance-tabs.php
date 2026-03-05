<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
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
class Advance_Tabs extends Widget_Base {

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
		return 'xpro-advance-tabs';
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
		return __( 'Advanced Tabs', 'xpro-elementor-addons-pro' );
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
		return 'xi-advance-tabs xpro-widget-pro-label';
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
		return array( 'tabs', 'advanced', 'content', 'template' );
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
			'section_tabs',
			array(
				'label' => __( 'Tabs', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_position',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => __( 'Horizontal', 'xpro-elementor-addons-pro' ),
					'vertical'   => __( 'Vertical', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'tabs_horizontal_layout',
			array(
				'label'     => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1'  => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2'  => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'3'  => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'4'  => __( 'Style 4', 'xpro-elementor-addons-pro' ),
					'5'  => __( 'Style 5', 'xpro-elementor-addons-pro' ),
					'6'  => __( 'Style 6', 'xpro-elementor-addons-pro' ),
					'7'  => __( 'Style 7', 'xpro-elementor-addons-pro' ),
					'8'  => __( 'Style 8', 'xpro-elementor-addons-pro' ),
					'9'  => __( 'Style 9', 'xpro-elementor-addons-pro' ),
					'10' => __( 'Style 10', 'xpro-elementor-addons-pro' ),
					'11' => __( 'Style 11', 'xpro-elementor-addons-pro' ),
					'12' => __( 'Style 12', 'xpro-elementor-addons-pro' ),
					'13' => __( 'Style 13', 'xpro-elementor-addons-pro' ),
					'14' => __( 'Style 14', 'xpro-elementor-addons-pro' ),
					'15' => __( 'Style 15', 'xpro-elementor-addons-pro' ),
					'16' => __( 'Style 16', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'tabs_position' => 'horizontal',
				),
			)
		);

		$this->add_control(
			'tabs_vertical_layout',
			array(
				'label'     => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'4' => __( 'Style 4', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'tabs_position' => 'vertical',
				),
			)
		);

		$this->add_control(
			'tab_animation',
			array(
				'label'              => __( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'fadeIn',
				'options'            => array(
					'none'            => __( 'None', 'xpro-elementor-addons-pro' ),
					'fadeIn'          => __( 'FadeIn', 'xpro-elementor-addons-pro' ),
					'fadeInUp'        => __( 'Fade In Up', 'xpro-elementor-addons-pro' ),
					'fadeInDown'      => __( 'Fade In Down', 'xpro-elementor-addons-pro' ),
					'fadeInLeft'      => __( 'Fade In Left', 'xpro-elementor-addons-pro' ),
					'fadeInRight'     => __( 'Fade In Right', 'xpro-elementor-addons-pro' ),
					'bounceIn'        => __( 'BounceIn', 'xpro-elementor-addons-pro' ),
					'bounce'          => __( 'Bounce', 'xpro-elementor-addons-pro' ),
					'flash'           => __( 'Flash', 'xpro-elementor-addons-pro' ),
					'pulse'           => __( 'Pulse', 'xpro-elementor-addons-pro' ),
					'rubberBand'      => __( 'Rubber', 'xpro-elementor-addons-pro' ),
					'shake'           => __( 'Shake', 'xpro-elementor-addons-pro' ),
					'swing'           => __( 'Swing', 'xpro-elementor-addons-pro' ),
					'tada'            => __( 'Tada', 'xpro-elementor-addons-pro' ),
					'wobble'          => __( 'Wobble', 'xpro-elementor-addons-pro' ),
					'flipInX'         => __( 'Flip X', 'xpro-elementor-addons-pro' ),
					'flipInY'         => __( 'Flip Y', 'xpro-elementor-addons-pro' ),
					'rotateInX'       => __( 'Rotate In', 'xpro-elementor-addons-pro' ),
					'rotateInUpLeft'  => __( 'Rotate Up Left', 'xpro-elementor-addons-pro' ),
					'rotateInUpRight' => __( 'Rotate Up Right', 'xpro-elementor-addons-pro' ),
					'zoomIn'          => __( 'Zoom In', 'xpro-elementor-addons-pro' ),
					'lightSpeedIn'    => __( 'Light Speed', 'xpro-elementor-addons-pro' ),
					'rollIn'          => __( 'Roll In', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$repeater = new Repeater();

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
			'tab_content',
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
			'tab_template',
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

		$repeater->add_control(
			'item_media_inline_style',
			array(
				'label'        => __( 'Inline Style', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$repeater->start_controls_tabs(
			'tabs_item',
			array(
				'separator' => 'before',
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->start_controls_tab(
			'tabs_item_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'tabs_item_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a'                                        => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-8 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a:before' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tabs_item_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tabs_item_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tabs_item_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a,
						 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
						 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
						 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
						 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper,
						 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a > .xpro-tab-media-wrapper::after' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tabs_item_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'tabs_item_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a'                                 => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper svg'   => 'fill: {{VALUE}};',
					'{{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-8 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a:before' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tabs_item_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tabs_item_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-3 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a:before' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tabs_item_active_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a > .xpro-tab-media-wrapper,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-3 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a:before,
					 {{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-7 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a:before' => 'border-color: {{VALUE}};',

					'{{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}} > a::after'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > {{CURRENT_ITEM}}.active > a::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'item_media_inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'tab_items',
			array(
				'label'       => __( 'Tab Items', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
				/* translators: 1$s: Title */
					__( '%1$s', 'xpro-elementor-addons-pro' ), //phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
					'{{title}}'
				),
				'render_type' => 'template',
				'separator'   => 'before',
				'default'     => array(
					array(
						'title'  => __( 'Tab #1', 'xpro-elementor-addons-pro' ),
						'icon'   => array(
							'value'   => 'fas fa-home',
							'library' => 'solid',
						),
						'source' => 'editor',
						'editor' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry, Lorem Ipsum has been the industry standard dummy text ever.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title'  => __( 'Tab #2', 'xpro-elementor-addons-pro' ),
						'icon'   => array(
							'value'   => 'fas fa-user',
							'library' => 'solid',
						),
						'source' => 'editor',
						'editor' => __( 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'xpro-elementor-addons-pro' ),
					),
					array(
						'title'  => __( 'Tab #3', 'xpro-elementor-addons-pro' ),
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
			'tabs_responsive_type',
			array(
				'label'     => __( 'Responsive Layout', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'accordion',
				'options'   => array(
					'dropdown'  => __( 'Dropdown', 'xpro-elementor-addons-pro' ),
					'accordion' => __( 'Accordion', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'tabs_responsive_show',
			array(
				'label'   => __( 'Responsive Show On', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'mobile',
				'options' => array(
					'tablet' => __( 'Tablet & Mobile', 'xpro-elementor-addons-pro' ),
					'mobile' => __( 'Mobile Only', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->end_controls_section();

		//Tab List Style
		$this->start_controls_section(
			'section_style_tabs',
			array(
				'label' => __( 'Tab List', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list > li > a,
				#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper > .xpro-tab-list > li > a,
				#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .tab-accordion-label,
				#xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-select-option',
			)
		);

		$this->add_responsive_control(
			'tab_title_icon',
			array(
				'label'      => __( 'Media Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper > .xpro-tab-icon > i,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper > .xpro-tab-list > li > a .xpro-tab-media-wrapper > .xpro-tab-icon > i,
					#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .tab-accordion-label .xpro-tab-media-wrapper > .xpro-tab-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',

					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper > .xpro-tab-icon > svg,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper > .xpro-tab-icon > svg,
					#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .tab-accordion-label .xpro-tab-media-wrapper > .xpro-tab-icon > svg' => 'width: {{SIZE}}{{UNIT}};',

					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper > .xpro-tab-media-image > img,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper > .xpro-tab-media-image > img,
					#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .tab-accordion-label .xpro-tab-media-wrapper > .xpro-tab-media-image > img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_title_bg_icon',
			array(
				'label'      => __( 'Media Background', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal:not(.xpro-tab-layout-16) > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-16 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tabs_horizontal_layout' => array( '12', '13', '14', '15', '16' ),
				),
			)
		);

		$this->add_responsive_control(
			'tab_title_icon_margin',
			array(
				'label'      => __( 'Media Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .tab-accordion-label > .xpro-tab-media-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'tab_list_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a,
								#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
								#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
								#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
								#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
								#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper::after',
				'condition' => array(
					'tabs_horizontal_layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'tab_list_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a'                                                                        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-select-option'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-list'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-select-option'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-list'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_list_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a'                                                                        => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-select-option'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-select-option'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_list_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => - 50,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list'                                                              => 'grid-gap: {{SIZE}}{{UNIT}};',
					'#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper > .xpro-tab-list > li:not(:nth-last-child(1))'                                   => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper::after' => 'width: calc({{SIZE}}{{UNIT}} + 4px);',
				),
				'condition'  => array(
					'tabs_horizontal_layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_control(
			'tabs_list_outline_color',
			array(
				'label'     => __( 'Outline Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-9 > .xpro-tab-list-wrapper > .xpro-tab-list > li:before,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-9 > .xpro-tab-list-wrapper > .xpro-tab-list > li:after,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-10 > .xpro-tab-list-wrapper > .xpro-tab-list > li:before,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-10 > .xpro-tab-list-wrapper > .xpro-tab-list > li:after'                                  => 'background-color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-9 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a::before,
					#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-10 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a::before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tabs_position'          => 'horizontal',
					'tabs_horizontal_layout' => array( '9', '10' ),
				),
			)
		);

		$this->start_controls_tabs( 'tabs_list' );

		$this->start_controls_tab(
			'tabs_list_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_list_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a'             => 'color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-8 .xpro-tab-list > li.active > a:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_list_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper'     => 'color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_list_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li > a,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a > .xpro-tab-media-wrapper' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'tabs_horizontal_layout!' => array( '9', '10' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_list_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a'                                 => 'color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-8 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_list_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper'     => 'color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_list_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'tabs_horizontal_layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_control(
			'tabs_list_active_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-12 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper >.xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-15 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a > .xpro-tab-media-wrapper,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-3 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a:before,
					 #xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-7 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a:before'         => 'border-color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-13 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a::after'        => 'color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tabs-vertical.xpro-tab-layout-3 > .xpro-tab-list-wrapper > .xpro-tab-list > li > a::after'           => 'color: {{VALUE}};',
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal.xpro-tab-layout-14 > .xpro-tab-list-wrapper > .xpro-tab-list > li.active > a::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'tabs_horizontal_layout!' => array( '9', '10' ),
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'tab_style_overall_heading',
			array(
				'label'     => __( 'Overall Wrapper', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'tab_horizontal_display',
			array(
				'label'     => __( 'Display', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'inline-flex' => __( 'Inline', 'xpro-elementor-addons-pro' ),
					'flex'        => __( 'Block', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'inline-flex',
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list' => 'display: {{VALUE}};',
				),
				'condition' => array(
					'tabs_position'           => 'horizontal',
					'tabs_horizontal_layout!' => array( '15' ),
				),
			)
		);

		$this->add_control(
			'tab_horizontal_alignment',
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
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'tabs_position'          => 'horizontal',
					'tab_horizontal_display' => 'inline-flex',
				),
			)
		);

		$this->add_control(
			'tab_vertical_alignment',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => __( 'Middle', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors' => array(
					'#xpro-tab-{{ID}}.xpro-tabs-vertical' => 'align-items: {{VALUE}};',
				),
				'condition' => array(
					'tabs_position' => 'vertical',
				),
			)
		);

		$this->add_control(
			'tab_vertical_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
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
				),
				'default'    => array(
					'unit' => '%',
					'size' => 30,
				),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tabs_position'         => 'vertical',
					'tabs_vertical_layout!' => '3',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list,
								#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list,
								#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list,
								#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper',
			)
		);

		$this->add_responsive_control(
			'tab_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper > .xpro-tab-list,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'#xpro-tab-{{ID}}.xpro-tabs-horizontal > .xpro-tab-list-wrapper,
					#xpro-tab-{{ID}}.xpro-tabs-vertical > .xpro-tab-list-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_content_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content,{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content > *',
			)
		);

		$this->add_control(
			'tab_content_alignment',
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
					'{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tab_content_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content' => 'color: {{VALUE}};',
					'{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content > *' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_content_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_content_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_content_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content',
			)
		);

		$this->add_responsive_control(
			'tab_content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_content_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_content_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} #xpro-tab-{{ID}}.xpro-tab-main > .xpro-tab-content-wrapper > .xpro-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_accordion',
			array(
				'label'     => __( 'Accordion', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tabs_responsive_type' => 'accordion',
				),
			)
		);

		$this->start_controls_tabs( 'tab_accordion_list' );

		$this->start_controls_tab(
			'tabs_accordion_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_accordion_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label'       => 'color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label'       => 'color: {{VALUE}};',
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label > svg' => 'fill: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_accordion_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label' => 'background-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_accordion_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label' => 'border-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_accordion_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_accordion_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label.active'       => 'color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label.active'       => 'color: {{VALUE}};',
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label.active > svg' => 'fill: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label.active > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_accordion_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label.active' => 'background-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label.active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_accordion_active_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-accordion-tablet > .xpro-tab-content-wrapper > .tab-accordion-label.active' => 'border-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-accordion-mobile > .xpro-tab-content-wrapper > .tab-accordion-label.active' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dropdown',
			array(
				'label'     => __( 'Dropdown', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tabs_responsive_type' => 'dropdown',
				),
			)
		);

		$this->start_controls_tabs( 'tab_dropdown_list' );

		$this->start_controls_tab(
			'tabs_dropdown_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_dropdown_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_dropdown_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'background-color: {{VALUE}}; background-image:none;',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'background-color: {{VALUE}};  background-image:none;',
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-list'          => 'background-color: {{VALUE}}; background-image:none;',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-list'          => 'background-color: {{VALUE}}; background-image:none;',
				),
			)
		);

		$this->add_control(
			'tabs_dropdown_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'border-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-list > li > a' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_dropdown_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'tabs_dropdown_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-select-option' => 'color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-select-option' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_dropdown_active_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-select-option' => 'background-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-select-option' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_dropdown_active_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet) #xpro-tab-{{ID}}.xpro-tab-dropdown-tablet > .xpro-tab-list-wrapper > .xpro-tab-select-option' => 'border-color: {{VALUE}};',
					'(mobile) #xpro-tab-{{ID}}.xpro-tab-dropdown-mobile > .xpro-tab-list-wrapper > .xpro-tab-select-option' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

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
		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-tabs/layout/frontend.php';
	}
}
