<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
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
class Advance_Heading extends Widget_Base {

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
		return 'xpro-advance-heading';
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
		return __( 'Advanced Heading', 'xpro-elementor-addons-pro' );
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
		return 'xi-advance-heading xpro-widget-pro-label';
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
		return array( 'advanced', 'heading', 'gradient', 'masking' );
	}

	public function render_title() {

		$settings = $this->get_settings_for_display();

		$target   = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';

		$title = $settings['title_before'] . ( ( ! empty( $settings['title_center'] ) ) ? ' <span class="xpro-title-focus">' . $settings['title_center'] . '</span>' : '' ) . ' ' . $settings['title_after'];

		$html = '';

		if ( ! empty( $settings['title_link']['url'] ) ) {
			$html .= '<a href="' . esc_url( $settings['title_link']['url'] ) . '"' . $target . $nofollow . '>';
		}

		$html .= '<' . esc_attr( $settings['title_tag'] ) . ' class="xpro-heading-title">';
		$html .= $title;
		$html .= '</' . esc_attr( $settings['title_tag'] ) . '>';

		if ( ! empty( $settings['title_link']['url'] ) ) {
			$html .= '</a>';
		}

		return $html;
	}

	public function render_subtitle() {

		$settings = $this->get_settings_for_display();

		$html = '';

		if ( 'yes' === $settings['show_subtitle'] && ! empty( $settings['subtitle'] ) ) {
			$html .= '<' . esc_attr( $settings['subtitle_tag'] ) . ' class="xpro-heading-subtitle">';
			$html .= $settings['subtitle'];
			$html .= '</' . esc_attr( $settings['subtitle_tag'] ) . '>';
		}

		return $html;
	}

	public function render_shadowText() {

		$settings = $this->get_settings_for_display();

		$class = 'xpro-shadow-text';

		$html = '';

		if ( 'yes' === $settings['show_shadowText'] && ! empty( $settings['shadowText'] ) ) {
			$html .= '<' . esc_attr( $settings['shadowText_tag'] ) . ' class="' . $class . '">';
			$html .= $settings['shadowText'];
			$html .= '</' . esc_attr( $settings['shadowText_tag'] ) . '>';
		}

		return $html;
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
			'section_title',
			array(
				'label' => __( 'Title', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'title_before',
			array(
				'label'       => __( 'Title Before', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Your',
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'title_center',
			array(
				'label'       => __( 'Title Center', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Main',
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'title_after',
			array(
				'label'       => __( 'Title After', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Heading',
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
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

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'HTML Tag', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'h1' => array(
						'title' => __( 'H1', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h1',
					),
					'h2' => array(
						'title' => __( 'H2', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h2',
					),
					'h3' => array(
						'title' => __( 'H3', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h3',
					),
					'h4' => array(
						'title' => __( 'H4', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h4',
					),
					'h5' => array(
						'title' => __( 'H5', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h5',
					),
					'h6' => array(
						'title' => __( 'H6', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h6',
					),
				),
				'default' => 'h2',
				'toggle'  => false,
			)
		);

		$this->end_controls_section();

		//Subtitle
		$this->start_controls_section(
			'section_subtitle',
			array(
				'label' => __( 'Subtitle', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_subtitle',
			array(
				'label'        => __( 'Show Subtitle', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Sub Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Sub Heading Here',
				'placeholder' => __( 'Sub Title Text Here', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_subtitle' => 'yes',
				),
			)
		);

		$this->add_control(
			'subtitle_tag',
			array(
				'label'     => __( 'HTML Tag', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'h1' => array(
						'title' => __( 'H1', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h1',
					),
					'h2' => array(
						'title' => __( 'H2', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h2',
					),
					'h3' => array(
						'title' => __( 'H3', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h3',
					),
					'h4' => array(
						'title' => __( 'H4', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h4',
					),
					'h5' => array(
						'title' => __( 'H5', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h5',
					),
					'h6' => array(
						'title' => __( 'H6', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h6',
					),
				),
				'default'   => 'h5',
				'toggle'    => false,
				'condition' => array(
					'show_subtitle' => 'yes',
				),
			)
		);

		$this->add_control(
			'subtitle_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'before_title',
				'options'   => array(
					'before_title' => __( 'Before Title', 'xpro-elementor-addons-pro' ),
					'after_title'  => __( 'After Title', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'show_subtitle' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Subtitle
		$this->start_controls_section(
			'section_description',
			array(
				'label' => __( 'Description', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_description',
			array(
				'label'        => __( 'Show Description', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout normal distribution of letters.', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Icon
		$this->start_controls_section(
			'section_icon',
			array(
				'label' => __( 'Icon', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_icon',
			array(
				'label'        => __( 'Show Icon', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'icon_name',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-lightbulb',
					'library' => 'solid',
				),
				'condition' => array(
					'show_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => __( 'Top', 'xpro-elementor-addons-pro' ),
					'float'  => __( 'Float', 'xpro-elementor-addons-pro' ),
					'inside' => __( 'Inside', 'xpro-elementor-addons-pro' ),
					'behind' => __( 'Behind', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'show_icon' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Separator
		$this->start_controls_section(
			'section_separator',
			array(
				'label' => __( 'Separator', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_separator',
			array(
				'label'        => __( 'Show Separator', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'separator_style',
			array(
				'label'     => __( 'Style', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text',
				'options'   => array(
					'text'    => __( 'Text', 'xpro-elementor-addons-pro' ),
					'icon'    => __( 'Icon', 'xpro-elementor-addons-pro' ),
					'simple'  => __( 'Simple', 'xpro-elementor-addons-pro' ),
					'double'  => __( 'Double', 'xpro-elementor-addons-pro' ),
					'shape-1' => __( 'Shape 1', 'xpro-elementor-addons-pro' ),
					'shape-2' => __( 'Shape 2', 'xpro-elementor-addons-pro' ),
					'shape-3' => __( 'Shape 3', 'xpro-elementor-addons-pro' ),
					'shape-4' => __( 'Shape 4', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-gem',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'separator_style' => 'icon',
					'show_separator'  => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_text',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Separator Text Here', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Separator Text', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'separator_style' => 'text',
					'show_separator'  => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after_title',
				'options'   => array(
					'before_title' => __( 'Before Title', 'xpro-elementor-addons-pro' ),
					'after_title'  => __( 'After Title', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//ShadowText
		$this->start_controls_section(
			'section_shadowText',
			array(
				'label' => __( 'Shadow Text', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_shadowText',
			array(
				'label'        => __( 'Show Shadow Text', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'shadowText',
			array(
				'label'       => __( 'Shadow Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Shadow Text Here',
				'placeholder' => __( 'Shadow Text Here', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_shadowText' => 'yes',
				),
			)
		);

		$this->add_control(
			'shadowText_tag',
			array(
				'label'     => __( 'HTML Tag', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'h1' => array(
						'title' => __( 'H1', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h1',
					),
					'h2' => array(
						'title' => __( 'H2', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h2',
					),
					'h3' => array(
						'title' => __( 'H3', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h3',
					),
					'h4' => array(
						'title' => __( 'H4', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h4',
					),
					'h5' => array(
						'title' => __( 'H5', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h5',
					),
					'h6' => array(
						'title' => __( 'H6', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-h6',
					),
				),
				'default'   => 'h3',
				'toggle'    => false,
				'condition' => array(
					'show_shadowText' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//General Style
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'box_width',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
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
					'unit' => 'px',
					'size' => 600,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-wrapper-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_align',
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
				'prefix_class' => 'xpro-content-align%s',
				'toggle'       => true,
			)
		);

		$this->add_control(
			'box_valign',
			array(
				'label'     => __( 'Vertical Align', 'xpro-elementor-addons-pro' ),
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
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-icon-position-float .xpro-heading-wrapper-inner,{{WRAPPER}} .xpro-heading-wrapper .xpro-heading-top' => 'align-items: {{VALUE}};',
				),
				'condition' => array(
					'icon_position' => array( 'float', 'inside' ),
				),
			)
		);

		$this->end_controls_section();

		//Title Style
		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => __( 'Title', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-title',
			)
		);

		$this->add_control(
			'title_stroke',
			array(
				'label'        => __( 'Text Stroke', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_control(
			'stroke_width',
			array(
				'label'      => __( 'Stroke Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'title_stroke' => 'yes',
				),
			)
		);

		$this->add_control(
			'stroke_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-title' => '-webkit-text-stroke-color: {{VALUE}};',
				),
				'condition' => array(
					'title_stroke' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-title',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'title_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-heading-title',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'title_background',
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'title_gradient_color_type!' => 'gradient',
				),
				'selector'  => '{{WRAPPER}} .xpro-heading-title',
			)
		);

		$this->add_control(
			'title_masking_show',
			array(
				'label'        => __( 'Masking', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => array(
					'title_gradient_color_type!'   => 'gradient',
					'title_background_background'  => 'classic',
					'title_background_image[url]!' => '',
				),
				'selectors'    => array(
					'{{WRAPPER}} .xpro-heading-title' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'title_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-title',
			)
		);

		$this->add_responsive_control(
			'title_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Center Title Style
		$this->start_controls_section(
			'section_style_center_title',
			array(
				'label' => __( 'Center Title', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'center_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-title-focus',
			)
		);

		$this->add_control(
			'center_title_stroke',
			array(
				'label'        => __( 'Text Stroke', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_control(
			'center_stroke_width',
			array(
				'label'      => __( 'Stroke Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-title-focus' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'center_title_stroke' => 'yes',
				),
			)
		);

		$this->add_control(
			'center_stroke_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-title-focus' => '-webkit-text-stroke-color: {{VALUE}};',
				),
				'condition' => array(
					'center_title_stroke' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'center_title_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-title-focus',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'center_title_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-title-focus',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'center_title_background',
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'center_title_gradient_color_type!' => 'gradient',
				),
				'selector'  => '{{WRAPPER}} .xpro-title-focus',
			)
		);

		$this->add_control(
			'center_title_masking_show',
			array(
				'label'        => __( 'Masking', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => array(
					'center_title_gradient_color_type!'   => 'gradient',
					'center_title_background_background'  => 'classic',
					'center_title_background_image[url]!' => '',
				),
				'selectors'    => array(
					'{{WRAPPER}} .xpro-title-focus' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'center_title_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-title-focus',
			)
		);

		$this->add_responsive_control(
			'center_title_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-title-focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'center_title_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-title-focus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Sub Title Style
		$this->start_controls_section(
			'section_style_subtitle',
			array(
				'label'     => __( 'Subtitle', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_subtitle' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-subtitle',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'subtitle_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-subtitle',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'subtitle_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-heading-subtitle',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'subtitle_background',
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'condition' => array(
					'subtitle_gradient_color_type!' => 'gradient',
				),
				'selector'  => '{{WRAPPER}} .xpro-heading-subtitle',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'subtitle_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-subtitle',
			)
		);

		$this->add_responsive_control(
			'subtitle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-subtitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'subtitle_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'subtitle_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Description Style
		$this->start_controls_section(
			'section_style_description',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-description, {{WRAPPER}} .xpro-heading-description > *',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-description, {{WRAPPER}} .xpro-heading-description > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Icon Styling
		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_icon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 25,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-heading-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 600,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon .xpro-heading-icon-media' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-icon i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-heading-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-heading-icon .xpro-heading-icon-media',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-heading-icon .xpro-heading-icon-media',
			)
		);

		$this->add_control(
			'icon_transform_toggle',
			array(
				'label'        => __( 'Transform', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => array(
					'icon_position' => 'behind',
				),
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'icon_horizontal_offset',
			array(
				'label'      => __( 'Horizontal Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'condition'  => array(
					'icon_position'         => 'behind',
					'icon_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon' => 'left: {{SIZE}}{{UNIT}}; width: max-content;',
				),
			)
		);

		$this->add_responsive_control(
			'icon_vertical_offset',
			array(
				'label'      => __( 'Vertical Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => - 100,
						'max' => 200,
					),
				),
				'condition'  => array(
					'icon_position'         => 'behind',
					'icon_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_rotate',
			array(
				'label'      => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'condition'  => array(
					'icon_position'         => 'behind',
					'icon_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon' => 'transform: rotate({{SIZE}}deg);',
				),
			)
		);

		$this->add_control(
			'icon_transform_origin',
			array(
				'label'       => __( 'Transform Origin', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'center center' => _x( 'Center Center', 'Background Control', 'xpro-elementor-addons-pro' ),
					'center left'   => _x( 'Center Left', 'Background Control', 'xpro-elementor-addons-pro' ),
					'center right'  => _x( 'Center Right', 'Background Control', 'xpro-elementor-addons-pro' ),
					'top center'    => _x( 'Top Center', 'Background Control', 'xpro-elementor-addons-pro' ),
					'top left'      => _x( 'Top Left', 'Background Control', 'xpro-elementor-addons-pro' ),
					'top right'     => _x( 'Top Right', 'Background Control', 'xpro-elementor-addons-pro' ),
					'bottom center' => _x( 'Bottom Center', 'Background Control', 'xpro-elementor-addons-pro' ),
					'bottom left'   => _x( 'Bottom Left', 'Background Control', 'xpro-elementor-addons-pro' ),
					'bottom right'  => _x( 'Bottom Right', 'Background Control', 'xpro-elementor-addons-pro' ),
				),
				'default'     => 'center center',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-heading-icon' => 'transform-origin: {{VALUE}};',
				),
				'condition'   => array(
					'icon_position'         => 'behind',
					'icon_transform_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-heading-icon .xpro-heading-icon-media',
			)
		);

		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon .xpro-heading-icon-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Separator Styling
		$this->start_controls_section(
			'section_separator_style',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'separator_text_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-heading-separator-text',
				'condition' => array(
					'separator_style' => 'text',
				),
			)
		);

		$this->add_control(
			'separator_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-separator-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'text',
				),
			)
		);

		$this->add_responsive_control(
			'separator_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 18,
				),
				'condition'  => array(
					'separator_style' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-separator-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'separator_icon_bg_size',
			array(
				'label'      => __( 'Icon Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 30,
				),
				'condition'  => array(
					'separator_style' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-separator-icon > i'   => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-heading-separator-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-separator-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-heading-separator-icon > svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_control(
			'separator_icon_bg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-separator-icon > i' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'separator_icon_border',
				'label'     => __( 'Icon Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-heading-separator-icon > i',
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_control(
			'separator_icon_border_radius',
			array(
				'label'      => __( 'Icon Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-separator-icon > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_control(
			'separator_line_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-separator-simple::before,{{WRAPPER}}  .xpro-heading-separator-double:before,{{WRAPPER}} .xpro-heading-separator-double:after,{{WRAPPER}} .xpro-heading-separator-text::before,{{WRAPPER}} .xpro-heading-separator-text::after,{{WRAPPER}} .xpro-heading-separator-icon::before,{{WRAPPER}} .xpro-heading-separator-icon::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} [class*=xpro-heading-separator-shape] > svg'                                                                                                                                                                                                                                                                                                  => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'separator_shape_width',
			array(
				'label'      => __( 'Shape Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 250,
				),
				'selectors'  => array(
					'{{WRAPPER}} [class*=xpro-heading-separator-shape] > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => array( 'shape-1', 'shape-2', 'shape-3', 'shape-4' ),
				),
			)
		);

		$this->add_responsive_control(
			'separator_align',
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
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-separator-simple' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'separator_style' => array( 'simple' ),
				),
			)
		);

		$this->add_responsive_control(
			'separator_width',
			array(
				'label'      => __( 'Separator Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 60,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-separator-simple::before,{{WRAPPER}}  .xpro-heading-separator-double:before,{{WRAPPER}} .xpro-heading-separator-double:after,{{WRAPPER}} .xpro-heading-separator-text::before,{{WRAPPER}} .xpro-heading-separator-text::after,{{WRAPPER}} .xpro-heading-separator-icon::before,{{WRAPPER}} .xpro-heading-separator-icon::after' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-heading-separator-text,{{WRAPPER}} .xpro-heading-separator-icon'                                                                                                                                                                                                                                                                        => 'padding:0 {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => array( 'text', 'icon', 'simple', 'double' ),
				),
			)
		);

		$this->add_responsive_control(
			'separator_height',
			array(
				'label'      => __( 'Separator Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-separator-simple::before,{{WRAPPER}}  .xpro-heading-separator-double:before,{{WRAPPER}} .xpro-heading-separator-double:after,{{WRAPPER}} .xpro-heading-separator-text::before,{{WRAPPER}} .xpro-heading-separator-text::after,{{WRAPPER}} .xpro-heading-separator-icon::before,{{WRAPPER}} .xpro-heading-separator-icon::after' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => array( 'text', 'icon', 'simple', 'double' ),
				),
			)
		);

		$this->add_control(
			'separator_border_style',
			array(
				'label'     => __( 'Separator Style', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-separator-simple::before,{{WRAPPER}}  .xpro-heading-separator-double:before,{{WRAPPER}} .xpro-heading-separator-double:after,{{WRAPPER}} .xpro-heading-separator-text::before,{{WRAPPER}} .xpro-heading-separator-text::after,{{WRAPPER}} .xpro-heading-separator-icon::before,{{WRAPPER}} .xpro-heading-separator-icon::after' => 'border-top-style: {{VALUE}};',
				),
				'condition' => array(
					'separator_style' => array( 'text', 'icon', 'simple', 'double' ),
				),
			)
		);

		$this->add_responsive_control(
			'separator_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-separator-simple::before,{{WRAPPER}}  .xpro-heading-separator-double:before,{{WRAPPER}} .xpro-heading-separator-double:after,{{WRAPPER}} .xpro-heading-separator-text::before,{{WRAPPER}} .xpro-heading-separator-text::after,{{WRAPPER}} .xpro-heading-separator-icon::before,{{WRAPPER}} .xpro-heading-separator-icon::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => array( 'text', 'icon', 'simple', 'double' ),
				),
			)
		);

		$this->add_responsive_control(
			'separator_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} [class*=xpro-heading-separator]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Shadow Text Style
		$this->start_controls_section(
			'section_style_shadow',
			array(
				'label'     => __( 'Shadow Text', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_shadowText' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'shadow_text_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-shadow-text',
			)
		);

		$this->add_control(
			'shadow_text_outline',
			array(
				'label'        => __( 'Outline Text', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'shadow_text_outline_color',
			array(
				'label'     => __( 'Stroke Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E9E9E9',
				'selectors' => array(
					'{{WRAPPER}} .xpro-heading-wrapper .xpro-shadow-text' => '-webkit-text-fill-color: transparent; -webkit-text-stroke-width: 1px; -webkit-text-stroke-color: {{VALUE}}; color: {{VALUE}}',
				),
				'condition' => array(
					'shadow_text_outline' => 'yes',
				),
			)
		);

		$this->add_control(
			'shadow_text_outline_width',
			array(
				'label'      => __( 'Stroke Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-heading-wrapper .xpro-shadow-text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'shadow_text_outline' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'      => 'shadow_text_gradient',
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .xpro-shadow-text',
				'condition' => array(
					'shadow_text_outline!' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'shadow_text_background',
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'condition' => array(
					'shadow_text_outline!'       => 'yes',
					'title_gradient_color_type!' => 'gradient',
				),
				'selector'  => '{{WRAPPER}} .xpro-shadow-text',
			)
		);

		$this->add_control(
			'shadow_text_transform_toggle',
			array(
				'label'        => __( 'Transform', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'shadow_text_horizontal_offset',
			array(
				'label'      => __( 'Horizontal Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'shadow_text_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-shadow-text' => 'left: {{SIZE}}{{UNIT}}; --xpro-shadow-text-transformX: -50%; width: max-content;',
				),
			)
		);

		$this->add_responsive_control(
			'shadow_text_vertical_offset',
			array(
				'label'      => __( 'Vertical Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'shadow_text_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-shadow-text' => 'top: {{SIZE}}{{UNIT}}; --xpro-shadow-text-transformY: -50%;',
				),
			)
		);

		$this->add_responsive_control(
			'shadow_text_rotate',
			array(
				'label'      => __( 'Rotate', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'condition'  => array(
					'shadow_text_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-shadow-text' => '--xpro-shadow-text-rotateZ: {{SIZE}}deg;',
				),
			)
		);

		$this->add_control(
			'shadow_text_transform_origin',
			array(
				'label'       => __( 'Transform Origin', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'center center' => _x( 'Center Center', 'Background Control', 'xpro-elementor-addons-pro' ),
					'center left'   => _x( 'Center Left', 'Background Control', 'xpro-elementor-addons-pro' ),
					'center right'  => _x( 'Center Right', 'Background Control', 'xpro-elementor-addons-pro' ),
					'top center'    => _x( 'Top Center', 'Background Control', 'xpro-elementor-addons-pro' ),
					'top left'      => _x( 'Top Left', 'Background Control', 'xpro-elementor-addons-pro' ),
					'top right'     => _x( 'Top Right', 'Background Control', 'xpro-elementor-addons-pro' ),
					'bottom center' => _x( 'Bottom Center', 'Background Control', 'xpro-elementor-addons-pro' ),
					'bottom left'   => _x( 'Bottom Left', 'Background Control', 'xpro-elementor-addons-pro' ),
					'bottom right'  => _x( 'Bottom Right', 'Background Control', 'xpro-elementor-addons-pro' ),
				),
				'default'     => 'center center',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-shadow-text' => 'transform-origin: {{VALUE}};',
				),
				'condition'   => array(
					'shadow_text_transform_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .xpro-shadow-text',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'shadow_text_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-shadow-text',
			)
		);

		$this->add_responsive_control(
			'shadow_text_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-shadow-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-heading/layout/frontend.php';
	}

}
