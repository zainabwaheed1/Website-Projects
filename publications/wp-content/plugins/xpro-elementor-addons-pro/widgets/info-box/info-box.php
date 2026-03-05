<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
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
class Info_Box extends Widget_Base {

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
		return 'xpro-infobox';
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
		return __( 'Info Box', 'xpro-elementor-addons-pro' );
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
		return 'xi-info-box xpro-widget-pro-label';
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
		return array( 'content', 'box', 'info', 'card' );
	}

	public function render_title() {

		$settings = $this->get_settings_for_display();

		$target   = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';

		$title = $settings['title'];

		$html = '';

		if ( ! empty( $settings['title_link']['url'] ) ) {
			$html .= '<a href="' . esc_url( $settings['title_link']['url'] ) . '"' . $target . $nofollow . '>';
		}

		$html .= '<' . esc_attr( $settings['title_tag'] ) . ' class="xpro-infobox-title">';
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
			$html .= '<' . esc_attr( $settings['subtitle_tag'] ) . ' class="xpro-infobox-subtitle">';
			$html .= $settings['subtitle'];
			$html .= '</' . esc_attr( $settings['subtitle_tag'] ) . '>';
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

		//Media
		$this->start_controls_section(
			'section_media',
			array(
				'label' => __( 'Media', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
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
				'toggle'      => false,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-fingerprint',
					'library' => 'solid',
				),
				'condition' => array(
					'media_type' => 'icon',
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
					'media_type' => 'image',
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
					'media_type' => 'image',
				),
			)
		);

		$this->add_control(
			'media_position',
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
					'media_type!' => 'none',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			array(
				'label' => __( 'Title', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Your Main Title', 'xpro-elementor-addons-pro' ),
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
				'default'   => 'simple',
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

		//Description
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

		//General Style
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
				'toggle'       => false,
				'default'      => 'left',
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
					'{{WRAPPER}} .xpro-infobox-media-position-float .xpro-infobox-wrapper-inner, .xpro-infobox-wrapper .xpro-infobox-top' => 'align-items: {{VALUE}};',
				),
				'condition' => array(
					'media_position' => array( 'float', 'inside' ),
				),
			)
		);

		$this->add_control(
			'box_overflow',
			array(
				'label'     => __( 'Overflow', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => _x( 'Auto', 'Background Control', 'xpro-elementor-addons-pro' ),
					'hidden' => _x( 'Hidden', 'Background Control', 'xpro-elementor-addons-pro' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-xpro-infobox' => 'overflow: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_box_padding',
			array(
				'label'      => __( 'Content Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge',
			array(
				'label' => __( 'Badge', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Show', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'       => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Featured', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_badge' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_button',
			array(
				'label'        => __( 'Show', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'button_title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Get Started', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => 'https://yoursite.com/',
				'default'     => array(
					'url' => '#',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_icon',
			array(
				'label'                  => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'                   => Controls_Manager::ICONS,
				'skin'                   => 'inline',
				'exclude_inline_options' => 'svg',
				'label_block'            => false,
				'condition'              => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_icon_position',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'button_icon[value]!' => '',
					'show_button'         => 'yes',
				),
			)
		);

		$this->add_control(
			'button_icon_space',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-icon-right > svg' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-infobox-icon-left > svg'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'button_icon[value]!' => '',
					'show_button'         => 'yes',
				),
			)
		);

		// Add control for Icon Size
		$this->add_responsive_control(
			'button_icon_size',
			array(  'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-btn svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'button_icon[value]!' => '', 
					'show_button'         => 'yes',
				),
			)
		);

		// Add control for Button Icon Alignment
		$this->add_responsive_control(
			'button_icon_alignment',
			array(
				'label'     => __( 'Button Text Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Start', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end' => array(
						'title' => __( 'End', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-btn' => 'align-items: {{VALUE}};',
				),
				'condition' => array(
					'button_icon[value]!' => '', 
					'show_button'         => 'yes', 
				),
			)
		);

		$this->add_control(
			'button_css_id',
			array(
				'label'       => __( 'Button ID', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page', 'xpro-elementor-addons-pro' ),
				'separator'   => 'before',
				'condition'   => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Media Styling
		$this->start_controls_section(
			'section_media_style',
			array(
				'label'     => __( 'Media', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'media_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'media_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-infobox-media-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-infobox-media-img > img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'media_type' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_height',
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
				'condition'      => array(
					'media_type' => 'image',
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-infobox-media-img > img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-fit',
			array(
				'label'     => __( 'Object Fit', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''        => __( 'Default', 'xpro-elementor-addons-pro' ),
					'fill'    => __( 'Fill', 'xpro-elementor-addons-pro' ),
					'cover'   => __( 'Cover', 'xpro-elementor-addons-pro' ),
					'contain' => __( 'Contain', 'xpro-elementor-addons-pro' ),
				),
				'default'   => '',
				'condition' => array(
					'media_type'          => 'image',
					'image_height[size]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-media-img > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs(
			'_media_tab',
			array(
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->start_controls_tab(
			'_tab_media_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'media_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-media-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-infobox-media-icon > svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'media_icon_bg',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-infobox-media-icon',
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_media_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'media_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-media-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .xpro-infobox-media-icon > svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'media_icon_hbg',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}}:hover .xpro-infobox-media-icon',
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'media_border_hcolor',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-media-icon' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'icon_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-media-icon,{{WRAPPER}} .xpro-infobox-media-icon > i,{{WRAPPER}} .xpro-infobox-media-icon > svg' => 'transition-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'media_transform_toggle',
			array(
				'label'        => __( 'Transform', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'media_horizontal_offset',
			array(
				'label'      => __( 'Horizontal Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
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
					'media_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media' => 'left: {{SIZE}}{{UNIT}}; width: max-content;',
				),
			)
		);

		$this->add_responsive_control(
			'media_vertical_offset',
			array(
				'label'      => __( 'Vertical Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
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
					'media_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_rotate',
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
					'media_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media' => 'transform: rotate({{SIZE}}deg);',
				),
			)
		);

		$this->add_control(
			'media_transform_origin',
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
					'{{WRAPPER}} .xpro-infobox-media' => 'transform-origin: {{VALUE}};',
				),
				'condition'   => array(
					'media_transform_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'media_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-media > .xpro-infobox-media-icon,{{WRAPPER}} .xpro-infobox-media > .xpro-infobox-media-img',
			)
		);

		$this->add_responsive_control(
			'media_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media > .xpro-infobox-media-icon,{{WRAPPER}} .xpro-infobox-media .xpro-infobox-media-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .xpro-infobox-title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( '_tabs_title' );

		$this->start_controls_tab(
			'_tab_title_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'title_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-title',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_title_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'title_hover_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}}:hover .xpro-infobox-title',
			)
		);

		$this->add_control(
			'title_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-title' => 'transition-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

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
				'selector' => '{{WRAPPER}} .xpro-infobox-subtitle',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'subtitle_shadow',
				'label'    => __( 'Text Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-subtitle',
			)
		);

		$this->add_responsive_control(
			'subtitle_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( '_tabs_subtitle' );

		$this->start_controls_tab(
			'_tab_subtitle_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'subtitle_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-subtitle',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_subtitle_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'subtitle_hover_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}}:hover .xpro-infobox-subtitle',
			)
		);

		$this->add_control(
			'subtitle_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-subtitle' => 'transition-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

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
				'selector'  => '{{WRAPPER}} .xpro-infobox-separator-text',
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
					'{{WRAPPER}} .xpro-infobox-separator-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'separator_icon_bg_size',
			array(
				'label'      => __( 'Icon Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array(
					'separator_style' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-separator-icon > i'   => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-infobox-separator-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'separator_icon_border',
				'label'     => __( 'Icon Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-infobox-separator-icon > i',
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'separator_icon_border_radius',
			array(
				'label'      => __( 'Icon Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-separator-icon > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => 'icon',
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
					'{{WRAPPER}} [class*=xpro-infobox-separator-shape] > svg' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-infobox-separator-simple' => 'text-align: {{VALUE}};',
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
					'size' => 80,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-separator-simple::before,{{WRAPPER}}  .xpro-infobox-separator-double:before,{{WRAPPER}} .xpro-infobox-separator-double:after,{{WRAPPER}} .xpro-infobox-separator-text::before,{{WRAPPER}} .xpro-infobox-separator-text::after,{{WRAPPER}} .xpro-infobox-separator-icon::before,{{WRAPPER}} .xpro-infobox-separator-icon::after' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-infobox-separator-text,{{WRAPPER}} .xpro-infobox-separator-icon'                                                                                                                                                                                                                                                                        => 'padding:0 {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-infobox-separator-simple::before,{{WRAPPER}}  .xpro-infobox-separator-double:before,{{WRAPPER}} .xpro-infobox-separator-double:after,{{WRAPPER}} .xpro-infobox-separator-text::before,{{WRAPPER}} .xpro-infobox-separator-text::after,{{WRAPPER}} .xpro-infobox-separator-icon::before,{{WRAPPER}} .xpro-infobox-separator-icon::after' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_style' => array( 'text', 'icon', 'simple', 'double' ),
				),
			)
		);

		$this->start_controls_tabs( '_tabs_separator' );

		$this->start_controls_tab(
			'_tab_separator_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'separator_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-separator-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'text',
				),
			)
		);

		$this->add_control(
			'separator_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-separator-icon > i' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-infobox-separator-icon > i' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_control(
			'separator_line_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-separator-simple::before,{{WRAPPER}}  .xpro-infobox-separator-double:before,{{WRAPPER}} .xpro-infobox-separator-double:after,{{WRAPPER}} .xpro-infobox-separator-text::before,{{WRAPPER}} .xpro-infobox-separator-text::after,{{WRAPPER}} .xpro-infobox-separator-icon::before,{{WRAPPER}} .xpro-infobox-separator-icon::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} [class*=xpro-infobox-separator-shape] > svg'                                                                                                                                                                                                                                                                                                  => 'fill: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_separator_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'separator_text_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-separator-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'text',
				),
			)
		);

		$this->add_control(
			'separator_icon_hcolor',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-separator-icon > i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_control(
			'separator_icon_hbg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-separator-icon > i' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'separator_style' => 'icon',
				),
			)
		);

		$this->add_control(
			'separator_line_hcolor',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-separator-simple::before,{{WRAPPER}}:hover .xpro-infobox-separator-double:before,
					{{WRAPPER}}:hover .xpro-infobox-separator-double:after,{{WRAPPER}}:hover .xpro-infobox-separator-text::before,
					{{WRAPPER}}:hover .xpro-infobox-separator-text::after,{{WRAPPER}}:hover .xpro-infobox-separator-icon::before,
					{{WRAPPER}}:hover .xpro-infobox-separator-icon::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}}:hover [class*=xpro-infobox-separator-shape] > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'separator_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} [class*=xpro-infobox-separator],{{WRAPPER}} [class*=xpro-infobox-separator]::before,
					{{WRAPPER}} [class*=xpro-infobox-separator]::after,{{WRAPPER}} [class*=xpro-infobox-separator] > i' => 'transition-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'separator_border_style',
			array(
				'label'     => __( 'Separator Style', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'separator' => 'before',
				'options'   => array(
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-separator-simple::before,{{WRAPPER}}  .xpro-infobox-separator-double:before,{{WRAPPER}} .xpro-infobox-separator-double:after,{{WRAPPER}} .xpro-infobox-separator-text::before,{{WRAPPER}} .xpro-infobox-separator-text::after,{{WRAPPER}} .xpro-infobox-separator-icon::before,{{WRAPPER}} .xpro-infobox-separator-icon::after' => 'border-top-style: {{VALUE}};',
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
					'{{WRAPPER}} .xpro-infobox-separator-simple::before,{{WRAPPER}}  .xpro-infobox-separator-double:before,{{WRAPPER}} .xpro-infobox-separator-double:after,{{WRAPPER}} .xpro-infobox-separator-text::before,{{WRAPPER}} .xpro-infobox-separator-text::after,{{WRAPPER}} .xpro-infobox-separator-icon::before,{{WRAPPER}} .xpro-infobox-separator-icon::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} [class*=xpro-infobox-separator]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .xpro-infobox-description, {{WRAPPER}} .xpro-infobox-description > *',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( '_tabs_description' );

		$this->start_controls_tab(
			'_tab_description_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-description, {{WRAPPER}} .xpro-infobox-description > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_description_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'description_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-description, {{WRAPPER}}:hover .xpro-infobox-description > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-description' => 'transition-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge_style',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_badge' => 'yes',
				),
			)
		);

		$this->add_control(
			'badge_position',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'top-left'   => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center' => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'  => __( 'Top Right', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'top-right',
			)
		);

		$this->add_control(
			'badge_transform_toggle',
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
			'badge_horizontal_offset',
			array(
				'label'      => __( 'Horizontal Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
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
					'badge_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => '--xpro-badge-translate-x: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_vertical_offset',
			array(
				'label'      => __( 'Vertical Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
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
					'badge_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => '--xpro-badge-translate-y: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_rotate',
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
					'badge_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => '--xpro-badge-rotate: {{SIZE}}deg;',
				),
			)
		);

		$this->add_control(
			'badge_transform_origin',
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
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => 'transform-origin: {{VALUE}};',
				),
				'condition'   => array(
					'badge_transform_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge',
			)
		);

		$this->start_controls_tabs( '_tabs_badge' );

		$this->start_controls_tab(
			'_tab_badge_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'badge_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_badge_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'badge_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-wrapper .xpro-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'badge_hover_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}}:hover .xpro-infobox-wrapper .xpro-badge',
			)
		);

		$this->add_control(
			'badge_border_hcolor',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-wrapper .xpro-badge' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'badge_hover_transition',
			array(
				'label'     => __( 'Transition Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => 'transition-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'badge_border',
				'separator' => 'before',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge',
			)
		);

		$this->add_responsive_control(
			'badge_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-wrapper .xpro-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-btn',
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
			'button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-btn > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-infobox-btn-wrapper a.xpro-infobox-btn svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_wrapper_hover_tab_style',
			array(
				'label' => __( 'Box Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'button_icon_wrapper_hcolor',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-btn > i' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .xpro-infobox-btn-wrapper a.xpro-infobox-btn svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_wrapper_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_wrapper_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}}:hover .xpro-infobox-btn',
			)
		);

		$this->add_control(
			'button_wrapper_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}:hover .xpro-infobox-btn' => 'border-color: {{VALUE}}',
				),
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
			'button_icon_hcolor',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-btn:hover > i,{{WRAPPER}} .xpro-infobox-btn:focus > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-infobox-btn-wrapper a.xpro-infobox-btn:hover svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .xpro-infobox-btn-wrapper a.xpro-infobox-btn:focus svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-btn:hover,{{WRAPPER}} .xpro-infobox-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-infobox-btn:hover,{{WRAPPER}} .xpro-infobox-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-infobox-btn:hover,{{WRAPPER}} .xpro-infobox-btn:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-infobox-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-infobox-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'info-box/layout/frontend.php';

	}

}
