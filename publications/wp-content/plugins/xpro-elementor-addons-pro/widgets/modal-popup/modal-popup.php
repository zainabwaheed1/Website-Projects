<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
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
class Modal_Popup extends Widget_Base {

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
		return 'xpro-modal-popup';
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
		return __( 'Modal Popup', 'xpro-elementor-addons-pro' );
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
		return 'xi-brightness-2 xpro-widget-pro-label';
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
		return array( 'modal', 'popup', 'content', 'custom' );
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

		return array( 'animate' );

	}

	public function get_script_depends() {

		return array( 'jquery-cookie' );

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
				'label'              => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'default',
				'options'            => array(
					'default'           => __( 'Default', 'xpro-elementor-addons-pro' ),
					'splash'            => __( 'Splash Screen', 'xpro-elementor-addons-pro' ),
					'intent'            => __( 'Exit Intent', 'xpro-elementor-addons-pro' ),
					'on_scroll'         => __( 'On Scroll', 'xpro-elementor-addons-pro' ),
					'scroll_to_element' => __( 'Scroll To Element', 'xpro-elementor-addons-pro' ),
					'user_inactive'     => __( 'User Inactive', 'xpro-elementor-addons-pro' ),
					'inline'            => __( 'Inline', 'xpro-elementor-addons-pro' ),
					'on_date'           => __( 'On Date', 'xpro-elementor-addons-pro' ),
					'custom'            => __( 'Custom Trigger', 'xpro-elementor-addons-pro' ),
				),
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'source',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Source', 'xpro-elementor-addons-pro' ),
				'default' => 'dynamic',
				'options' => array(
					'dynamic'  => __( 'Dynamic', 'xpro-elementor-addons-pro' ),
					'template' => __( 'Template', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'xpro_elementor_modal_popup_content',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
				'condition'   => array(
					'source' => 'dynamic',
				),
			)
		);

		$this->add_control(
			'xpro_elementor_modal_popup_template',
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

		$this->add_control(
			'modal_custom_class',
			array(
				'label'              => esc_html__( 'Modal Selector', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Set your modal selector here. For example: <b>custom-popup-link</b>. Set this selector ID/Class where you want to link this modal.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => 'custom-modal-popup',
				'condition'          => array(
					'layout' => 'custom',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'modal_scroll_selector',
			array(
				'label'              => esc_html__( 'Scroll To Selector', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Set your modal selector here. For example: <b>section</b>. Show modal when reach to selector ID/Class', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => 'about-section',
				'condition'          => array(
					'layout' => 'scroll_to_element',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'date',
			array(
				'label'              => __( 'Show on Date', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::DATE_TIME,
				'default'            => gmdate( 'Y-m-d', strtotime( '+ 1 day' ) ),
				'description'        => esc_html__( 'Set the date when popup show', 'xpro-elementor-addons-pro' ),
				'picker_options'     => array(
					'enableTime' => false,
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'layout' => 'on_date',
				),
			)
		);

		$this->add_control(
			'splash_after',
			array(
				'label'              => esc_html__( 'Splash After (s)', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 5,
				),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 60,
					),
				),
				'condition'          => array(
					'layout' => array( 'splash', 'on_date' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'scroll_offset',
			array(
				'label'              => __( 'Scroll Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'range'              => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
				),
				'default'            => array(
					'size' => 150,
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'layout' => 'on_scroll',
				),
			)
		);

		$this->add_control(
			'user_inactive_duration',
			array(
				'label'              => __( 'Inactive Duration (s)', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'default'            => array(
					'size' => 3,
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'layout' => 'user_inactive',
				),
			)
		);

		$this->add_control(
			'overlay',
			array(
				'label'        => esc_html__( 'Overlay', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'layout!' => 'inline',
				),
			)
		);

		$this->add_control(
			'esc_exit',
			array(
				'label'              => esc_html__( 'Esc Close', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'layout!' => 'inline',
				),
			)
		);

		$this->add_control(
			'overlay_exit',
			array(
				'label'              => esc_html__( 'Overlay Close', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'condition'          => array(
					'overlay' => 'yes',
					'layout!' => 'inline',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'due_date',
			array(
				'label'              => __( 'Show After', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'description'        => esc_html__( 'Display again after a day(s) when visitor closes it.', 'xpro-elementor-addons-pro' ),
				'frontend_available' => true,
				'min'                => 0,
			)
		);

		$this->add_control(
			'toggle_heading',
			array(
				'label'     => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => 'default',
				),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => __( 'Click here', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Button Text Here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'layout' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'condition'    => array(
					'layout' => 'default',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-bars',
					'library' => 'solid',
				),
				'condition' => array(
					'layout' => 'default',
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'layout'       => 'default',
					'icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'   => array(
					'size' => 10,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-align-icon-right .xpro-elementor-modal-popup-toggle-media' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-align-icon-left .xpro-elementor-modal-popup-toggle-media'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'layout'       => 'default',
					'icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'close_heading',
			array(
				'label'     => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'close_icon',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-times',
					'library' => 'solid',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'modal_position',
			array(
				'label'                => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
					'top-left'      => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center'    => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'     => __( 'Top Right', 'xpro-elementor-addons-pro' ),
					'middle-left'   => __( 'Middle Left', 'xpro-elementor-addons-pro' ),
					'middle-center' => __( 'Middle Center', 'xpro-elementor-addons-pro' ),
					'middle-right'  => __( 'Middle Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => __( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-center' => __( 'Bottom Center', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => __( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'top-left'      => 'top:0; left:0;',
					'top-center'    => 'top:0; left:50%; transform:translateX(-50%);',
					'top-right'     => 'top:0; right:0;',
					'middle-left'   => 'top:50%; left:0; transform:translateY(-50%);',
					'middle-center' => 'top:50%; left:50%; transform:translate(-50%,-50%);',
					'middle-right'  => 'top:50%; right:0;  transform:translateY(-50%);',
					'bottom-left'   => 'bottom:0; left:0;',
					'bottom-center' => 'bottom:0; left:50%; transform:translateX(-50%);',
					'bottom-right'  => 'bottom:0; right:0;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-inner' => '{{VALUE}};',
				),
				'default'              => 'middle-center',
				'condition'            => array(
					'layout!' => 'inline',
				),
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'layout!' => 'inline',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'layout!' => 'inline',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup',
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-overlay' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout!' => 'inline',
					'overlay' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup',
			)
		);

		$this->add_control(
			'modal_animation',
			array(
				'label'              => esc_html__( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::ANIMATION,
				'render_type'        => 'template',
				'frontend_available' => true,
				'condition'          => array(
					'layout!' => 'inline',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_toggle',
			array(
				'label'     => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'default',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'toggle_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup-toggle',
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
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle' => 'width: {{SIZE}}{{UNIT}}; max-width:100%;',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle-media > svg' => 'width: {{SIZE}}{{UNIT}}; height:auto',
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle-media'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'toggle_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup-toggle,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill:before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide::before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'toggle_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle:hover, {{WRAPPER}} .xpro-elementor-modal-popup-toggle:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle:hover svg, {{WRAPPER}} .xpro-elementor-modal-popup-toggle:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-animation-none:hover,{{WRAPPER}} .xpro-button-2d-animation:hover,
								{{WRAPPER}} .xpro-elementor-button-animation-none:focus,{{WRAPPER}} .xpro-button-2d-animation:focus,
								{{WRAPPER}} .xpro-button-bg-animation::before,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::after,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::after,{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide,
								{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:hover,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill',
			)
		);

		$this->add_control(
			'toggle_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'toggle_border!'          => '',
					'hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle:hover, {{WRAPPER}} .xpro-elementor-modal-popup-toggle:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_hover_underline',
			array(
				'label'     => __( 'Line Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'hover_animation'        => 'unique',
					'hover_unique_animation' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hover_animation',
			array(
				'label'   => __( 'Hover Animation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'                  => __( 'None', 'xpro-elementor-addons-pro' ),
					'2d-transition'         => __( '2D', 'xpro-elementor-addons-pro' ),
					'background-transition' => __( 'Background', 'xpro-elementor-addons-pro' ),
					'unique'                => __( 'Unique', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'hover_2d_css_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-grow',
				'options'   => array(
					'hvr-grow'                   => __( 'Grow', 'xpro-elementor-addons-pro' ),
					'hvr-shrink'                 => __( 'Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-pulse'                  => __( 'Pulse', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-grow'             => __( 'Pulse Grow', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-shrink'           => __( 'Pulse Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-push'                   => __( 'Push', 'xpro-elementor-addons-pro' ),
					'hvr-pop'                    => __( 'Pop', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-in'              => __( 'Bounce In', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-out'             => __( 'Bounce Out', 'xpro-elementor-addons-pro' ),
					'hvr-rotate'                 => __( 'Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-grow-rotate'            => __( 'Grow Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-float'                  => __( 'Float', 'xpro-elementor-addons-pro' ),
					'hvr-sink'                   => __( 'Sink', 'xpro-elementor-addons-pro' ),
					'hvr-bob'                    => __( 'Bob', 'xpro-elementor-addons-pro' ),
					'hvr-hang'                   => __( 'Hang', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-vertical'        => __( 'Wobble Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-horizontal'      => __( 'Wobble Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-bottom-right' => __( 'Wobble To Bottom Right', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-top-right'    => __( 'Wobble To Top Right', 'xpro-elementor-addons-pro' ),
					'hvr-buzz'                   => __( 'Buzz', 'xpro-elementor-addons-pro' ),
					'hvr-buzz-out'               => __( 'Buzz Out', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'hover_animation' => '2d-transition',
				),
			)
		);

		$this->add_control(
			'hover_background_css_animation',
			array(
				'label'     => __( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-sweep-to-right',
				'options'   => array(
					'hvr-sweep-to-right'         => __( 'Sweep To Right', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-left'          => __( 'Sweep To Left', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-bottom'        => __( 'Sweep To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-top'           => __( 'Sweep To Top', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-right'        => __( 'Bounce To Right', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-left'         => __( 'Bounce To Left', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-bottom'       => __( 'Bounce To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-top'          => __( 'Bounce To Top', 'xpro-elementor-addons-pro' ),
					'hvr-radial-out'             => __( 'Radial Out', 'xpro-elementor-addons-pro' ),
					'hvr-radial-in'              => __( 'Radial In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-in'           => __( 'Rectangle In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-out'          => __( 'Rectangle Out', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-horizontal'  => __( 'Shutter In Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-horizontal' => __( 'Shutter Out Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-vertical'    => __( 'Shutter In Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-vertical'   => __( 'Shutter Out Vertical', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'hover_animation' => 'background-transition',
				),
			)
		);

		$this->add_control(
			'hover_unique_animation',
			array(
				'label'     => __( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'skewFill',
				'options'   => array(
					'underlineFromLeft'   => __( 'Underline From Left', 'xpro-elementor-addons-pro' ),
					'underlineFromRight'  => __( 'Underline From Right', 'xpro-elementor-addons-pro' ),
					'underlineFromCenter' => __( 'Underline From Center', 'xpro-elementor-addons-pro' ),
					'skewFill'            => __( 'Skew Fill', 'xpro-elementor-addons-pro' ),
					'flipSlide'           => __( 'Flip Slide', 'xpro-elementor-addons-pro' ),
					'bubbleFromDown'      => __( 'Bubble From Down', 'xpro-elementor-addons-pro' ),
					'bubbleFromCenter'    => __( 'Bubble From Center', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'hover_animation' => 'unique',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'toggle_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-modal-popup-toggle',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'toggle_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup-toggle',
			)
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_close',
			array(
				'label' => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'close_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_close_style' );

		$this->start_controls_tab(
			'close_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'close_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'close_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup-close-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'close_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'close_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn:hover, {{WRAPPER}} .xpro-elementor-modal-popup-close-btn:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn:hover svg, {{WRAPPER}} .xpro-elementor-modal-popup-close-btn:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'close_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup-close-btn:hover, {{WRAPPER}} .xpro-elementor-modal-popup-close-btn:focus',
			)
		);

		$this->add_control(
			'close_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn:hover, {{WRAPPER}} .xpro-elementor-modal-popup-close-btn:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'close_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-modal-popup-close-btn',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'close_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-modal-popup-close-btn',
			)
		);

		$this->add_responsive_control(
			'close_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-modal-popup-close-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'modal-popup/layout/frontend.php';

	}

}
