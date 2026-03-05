<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
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
class Ajax_Live_Search extends Widget_Base {

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
		return 'xpro-ajax-live-search';
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
		return __( 'Ajax Live Search', 'xpro-elementor-addons-pro' );
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
		return 'xi-search xpro-widget-pro-label';
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
		return array( 'ajax', 'live', 'ajax live search', 'search', 'bar', 'searching', 'find' );
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

		$post_types = xpro_elementor_get_post_types();

		//Button Primary
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1' => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Minimal', 'xpro-elementor-addons-pro' ),
					'3' => __( 'Creative', 'xpro-elementor-addons-pro' ),
					'4' => __( 'Full Screen', 'xpro-elementor-addons-pro' ),
					'5' => __( 'Half Screen', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'placeholder',
			array(
				'label'   => __( 'Placeholder', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Search', 'xpro-elementor-addons-pro' ) . '...',
				'dynamic' => array(
					'active' => true,
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'search_redirect',
			array(
				'label'              => __( 'Redirect to Search Template', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'no',
				'description'        => 'redirect to search template on action',
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'content_heading',
			array(
				'label'     => __( 'Content', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_img',
			array(
				'label'              => __( 'Show Image', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'show_title',
			array(
				'label'              => __( 'Show Title', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'show_desc',
			array(
				'label'              => __( 'Show Description', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'button_heading',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => array( '1' ),
				),
			)
		);

		$this->add_control(
			'button_type',
			array(
				'label'     => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => array(
					'icon' => __( 'Icon', 'xpro-elementor-addons-pro' ),
					'text' => __( 'Text', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'layout' => array( '1' ),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Search', 'xpro-elementor-addons-pro' ),
				'separator' => 'after',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'button_type' => 'text',
					'layout'      => array( '1' ),
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-search',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'button_type!' => 'text',
				),
			)
		);

		$this->end_controls_section();

		//Query
		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'xpro-elementor-addons-pro' ),
			)
		);

		//post type
		$this->add_control(
			'post_type',
			array(
				'label'              => __( 'Post Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => $post_types,
				'default'            => key( $post_types ),
				'frontend_available' => true,
			)
		);

		//posts per page
		$this->add_control(
			'posts_per_page',
			array(
				'label'              => __( 'Per Page', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 6,
				'condition'          => array(
					'post_type!' => array( 'source_dynamic' ),
				),
				'frontend_available' => true,
			)
		);

		//order
		$this->add_control(
			'order',
			array(
				'label'              => __( 'Order', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				),
				'default'            => 'desc',
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_input_style',
			array(
				'label' => __( 'Input', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_background_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-inner' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '4', '5' ),
				),
			)
		);

		$this->add_control(
			'close_btn_color',
			array(
				'label'     => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-button-close:before,{{WRAPPER}}  .xpro-elementor-search-button-close:after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '4', '5' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'input_typography',
				'selector' => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group > input',
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper:not(.xpro-elementor-search-layout-3) .xpro-elementor-search-input-group > input,
					{{WRAPPER}} .xpro-elementor-search-layout-3 .xpro-elementor-search-input-group:hover > input,{{WRAPPER}} .xpro-elementor-search-layout-3 .xpro-elementor-search-input-group:focus-within > input' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group > input,{{WRAPPER}} .xpro-elementor-search-button' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-search-button'                                                                                       => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-search-layout-3 .xpro-elementor-search-input-group > input'                                          => 'width: {{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'input_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-layout-2 .xpro-elementor-search-input-group i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-search-layout-2 svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '2',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_input_colors' );

		$this->start_controls_tab(
			'tab_input_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'input_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group input,{{WRAPPER}} .xpro-elementor-search-layout-2 .xpro-elementor-search-input-group i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group input::placeholder'                                                                  => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-search-button > svg'                                                                              => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'input_background_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group,{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group > input' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'input_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			array(
				'label' => __( 'Focus', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'input_text_color_focus',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group > input:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'input_background_color_focus',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group:focus-within,{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group > input:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'input_border_color_focus',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'input_border_radius',
			array(
				'label'     => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-input-group > input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//spinner
		$this->add_control(
			'spinner_section_style',
			array(
				'label'     => __( 'Spinner', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		//color
		$this->add_control(
			'spinner_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-loading-spinner::before' => 'color: {{VALUE}}',
				),
			)
		);

		//size
		$this->add_responsive_control(
			'spinner_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-loading-spinner::before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'spinner_magrin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-loading-spinner::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//search content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		//bg color
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper',
			)
		);

		//width
		$this->add_responsive_control(
			'content_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		//height
		$this->add_responsive_control(
			'content_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper' => 'max-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'content_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper',
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_magrin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'item_style',
			array(
				'label'     => __( 'Item', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		//seprator color
		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-item' => 'border-color: {{VALUE}}',
				),
			)
		);

		//seprator width
		$this->add_responsive_control(
			'separator_width',
			array(
				'label'      => __( 'Separator Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-item' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		//item padding
		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Item Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ---------

		//item style

		// ---
		//item image style

		$this->add_control(
			'img_title',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_img' => array( 'yes' ),
				),
			)
		);

		///img width
		$this->add_responsive_control(
			'img_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-item-img' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_img' => array( 'yes' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'img_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-item-img',
				'condition' => array(
					'show_img' => array( 'yes' ),
				),
			)
		);

		$this->add_responsive_control(
			'img_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-item-img' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_img' => array( 'yes' ),
				),
			)
		);

		// ---
		$this->add_control(
			'heading_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-title',
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-title:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_title' => array( 'yes' ),
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_title' => array( 'yes' ),
				),
			)
		);
		// ---

		//item content style

		// ---
		$this->add_control(
			'content_title',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_desc' => array( 'yes' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'content_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-content',
				'condition' => array(
					'show_desc' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-content' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_desc' => array( 'yes' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_desc' => array( 'yes' ),
				),
			)
		);
		// ---

		//no result found style

		// ---
		$this->add_control(
			'no_result_title',
			array(
				'label'     => __( 'No Result Found', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'no_result_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-no-result',
			)
		);

		$this->add_control(
			'no_result_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-no-result' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'no_result_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-ajax-data-fetch-wrapper .xpro-live-search-no-result' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		// ---

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout!' => array( '2' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'selector'  => '{{WRAPPER}} .xpro-elementor-search-button',
				'condition' => array(
					'layout'      => array( '1' ),
					'button_type' => 'text',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_colors' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-search-button > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			array(
				'name'     => 'button_background',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-button:hover,{{WRAPPER}} .xpro-elementor-search-button:focus' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-search-button:hover > svg,{{WRAPPER}} .xpro-elementor-search-button:focus > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbackground',
				'label'    => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-button:hover,{{WRAPPER}} .xpro-elementor-search-button:focus',
			)
		);

		$this->add_control(
			'button_text_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-button:hover,{{WRAPPER}} .xpro-elementor-search-button:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-button' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .xpro-elementor-search-button > svg' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition' => array(
					'button_type' => 'icon',
				),
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'button_bg_size',
			array(
				'label'     => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-wrapper .xpro-elementor-search-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'     => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-search-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-search-button',
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-search-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'ajax-live-search/layout/frontend.php';
	}


}
