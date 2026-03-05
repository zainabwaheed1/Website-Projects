<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


class Post_Meta extends Widget_Base {

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
		return 'xpro-post-meta';
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
		return __( 'Post Meta', 'xpro-elementor-addons-pro' );
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
		return 'xi-list-group xpro-widget-pro-label';
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
		return array( 'xpro-themer' );
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
		return array( 'post', 'meta', 'info', 'date', 'time', 'author', 'taxonomy', 'comments', 'terms', 'avatar' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'view',
			array(
				'label'       => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'inline',
				'options'     => array(
					'traditional' => array(
						'title' => __( 'Default', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'inline'      => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'render_type' => 'template',
				'classes'     => 'xpro-control-start-end',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type',
			array(
				'label'   => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'author'   => __( 'Author', 'xpro-elementor-addons-pro' ),
					'date'     => __( 'Date', 'xpro-elementor-addons-pro' ),
					'time'     => __( 'Time', 'xpro-elementor-addons-pro' ),
					'comments' => __( 'Comments', 'xpro-elementor-addons-pro' ),
					'terms'    => __( 'Terms', 'xpro-elementor-addons-pro' ),
					'custom'   => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'date_format',
			array(
				'label'     => __( 'Date Format', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => 'Default',
					'0'       => _x( 'March 6, 2018 (F j, Y)', 'Date Format', 'xpro-elementor-addons-pro' ),
					'1'       => '2018-03-06 (Y-m-d)',
					'2'       => '03/06/2018 (m/d/Y)',
					'3'       => '06/03/2018 (d/m/Y)',
					'custom'  => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'type' => 'date',
				),
			)
		);

		$repeater->add_control(
			'custom_date_format',
			array(
				'label'       => __( 'Custom Date Format', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'F j, Y',
				'condition'   => array(
					'type'        => 'date',
					'date_format' => 'custom',
				),
				'description' => sprintf(
				/* translators: %s: Allowed data letters (see: http://php.net/manual/en/function.date.php). */
					__( 'Use the letters: %s', 'xpro-elementor-addons-pro' ),
					'l D d j S F m M n Y y'
				),
			)
		);

		$repeater->add_control(
			'time_format',
			array(
				'label'     => __( 'Time Format', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => 'Default',
					'0'       => '3:31 pm (g:i a)',
					'1'       => '3:31 PM (g:i A)',
					'2'       => '15:31 (H:i)',
					'custom'  => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'type' => 'time',
				),
			)
		);
		$repeater->add_control(
			'custom_time_format',
			array(
				'label'       => __( 'Custom Time Format', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'g:i a',
				'placeholder' => 'g:i a',
				'condition'   => array(
					'type'        => 'time',
					'time_format' => 'custom',
				),
				'description' => sprintf(
				/* translators: %s: Allowed time letters (see: http://php.net/manual/en/function.time.php). */
					__( 'Use the letters: %s', 'xpro-elementor-addons-pro' ),
					'g G H i a A'
				),
			)
		);

		$repeater->add_control(
			'taxonomy',
			array(
				'label'       => __( 'Taxonomy', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => $this->get_taxonomies(),
				'condition'   => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_control(
			'text_prefix',
			array(
				'label'     => __( 'Before', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'type!' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'show_avatar',
			array(
				'label'     => __( 'Avatar', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'type' => 'author',
				),
			)
		);

		$repeater->add_responsive_control(
			'avatar_size',
			array(
				'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-post-meta-list-icon' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition' => array(
					'show_avatar' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'comments_custom_strings',
			array(
				'label'     => __( 'Custom Format', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => false,
				'condition' => array(
					'type' => 'comments',
				),
			)
		);

		$repeater->add_control(
			'string_no_comments',
			array(
				'label'       => __( 'No Comments', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'No Comments', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'comments_custom_strings' => 'yes',
					'type'                    => 'comments',
				),
			)
		);

		$repeater->add_control(
			'string_one_comment',
			array(
				'label'       => __( 'One Comment', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'One Comment', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'comments_custom_strings' => 'yes',
					'type'                    => 'comments',
				),
			)
		);

		$repeater->add_control(
			'string_comments',
			array(
				'label'       => __( 'Comments', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '%s Comments', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'comments_custom_strings' => 'yes',
					'type'                    => 'comments',
				),
			)
		);

		$repeater->add_control(
			'custom_text',
			array(
				'label'       => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'     => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'type!' => 'time',
				),
			)
		);

		$repeater->add_control(
			'custom_url',
			array(
				'label'     => __( 'Custom URL', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => array(
					'active' => true
				),
				'condition' => array(
					'type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'show_icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'    => __( 'None', 'xpro-elementor-addons-pro' ),
					'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
					'custom'  => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'default',
				'condition' => array(
					'show_avatar!' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'selected_icon',
			array(
				'label'     => __( 'Choose Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'show_icon'    => 'custom',
					'show_avatar!' => 'yes',
				),
			)
		);

		$this->add_control(
			'xpro-post-meta-list',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'type'          => 'author',
						'selected_icon' => array(
							'value'   => 'far fa-user-circle',
							'library' => 'fa-regular',
						),
					),
					array(
						'type'          => 'date',
						'selected_icon' => array(
							'value'   => 'far fa-calendar',
							'library' => 'fa-regular',
						),
					),
					array(
						'type'          => 'time',
						'selected_icon' => array(
							'value'   => 'far fa-clock',
							'library' => 'fa-regular',
						),
					),
					array(
						'type'          => 'comments',
						'selected_icon' => array(
							'value'   => 'far fa-comment-dots',
							'library' => 'fa-regular',
						),
					),
				),
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} <span style="text-transform: capitalize;">{{{ type }}}</span>',
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

		$this->add_responsive_control(
			'space_between',
			array(
				'label'     => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta:not(.xpro-post-meta-inline) .xpro-post-meta-list-item:not(:last-child)'  => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .xpro-post-meta:not(.xpro-post-meta-inline) .xpro-post-meta-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .xpro-post-meta.xpro-post-meta-inline .xpro-post-meta-list-item'                         => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .xpro-post-meta.xpro-post-meta-inline'                                                   => 'grid-row-gap: calc({{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .xpro-post-meta.xpro-post-meta-inline .xpro-post-meta-list-item:after'          => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .xpro-post-meta.xpro-post-meta-inline .xpro-post-meta-list-item:after'    => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				),
			)
		);

		$this->add_responsive_control(
			'icon_align',
			array(
				'label'        => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => __( 'Start', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'End', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'elementor%s-align-',
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'xpro-elementor-addons-pro' ),
				'label_on'  => __( 'On', 'xpro-elementor-addons-pro' ),
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta-list-item:not(:last-child):after' => 'content: ""',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'separator_style',
			array(
				'label'     => __( 'Style', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'double' => __( 'Double', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'solid',
				'condition' => array(
					'separator' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta:not(.xpro-post-meta-inline) .xpro-post-meta-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}};',
					'{{WRAPPER}} .xpro-post-meta.xpro-post-meta-inline .xpro-post-meta-list-item:not(:last-child):after'       => 'border-left-style: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'separator_weight',
			array(
				'label'     => __( 'Weight', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 1,
				),
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 20,
					),
				),
				'condition' => array(
					'separator' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta:not(.xpro-post-meta-inline) .xpro-post-meta-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .xpro-post-meta-inline .xpro-post-meta-list-item:not(:last-child):after'                      => 'border-left-width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'separator_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'condition'  => array(
					'separator' => 'yes',
					'view!'     => 'inline',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-meta-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'separator_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'condition'  => array(
					'separator' => 'yes',
					'view'      => 'inline',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-meta-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ddd',
				'condition' => array(
					'separator' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta-list-item:not(:last-child):after' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label' => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta-list-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-post-meta-list-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 14,
				),
				'range'     => array(
					'px' => array(
						'min' => 5,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta-list-icon'     => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-post-meta-list-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-post-meta-list-icon svg' => 'height:auto; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			array(
				'label' => __( 'Text', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_indent',
			array(
				'label'     => __( 'Indent', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .xpro-post-meta-list-text' => 'padding-left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .xpro-post-meta-list-text'       => 'padding-right: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .xpro-post-meta-list-text, {{WRAPPER}} .xpro-post-meta-list-text a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'link_hover',
			array(
				'label'     => __( 'Link hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-meta li a:hover .xpro-post-meta-list-text, {{WRAPPER}} .xpro-post-meta li a:hover .xpro-post-meta-list-text a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'icon_typography',
				'selector' => '{{WRAPPER}} .xpro-post-meta-list-item',
			)
		);

		$this->end_controls_section();
	}

	protected function get_taxonomies() {
		$taxonomies = get_taxonomies(
			array(
				'show_in_nav_menus' => true,
			),
			'objects'
		);

		$options = array(
			'' => __( 'Choose', 'xpro-elementor-addons-pro' )
		);

		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}

	protected function render_item( $repeater_item ) {
		$item_data      = $this->get_meta_data( $repeater_item );
		$repeater_index = $repeater_item['_id'];

		if ( empty( $item_data['text'] ) && empty( $item_data['terms_list'] ) ) {
			return;
		}

		$has_link = false;
		$link_key = 'link_' . $repeater_index;
		$item_key = 'item_' . $repeater_index;

		$this->add_render_attribute(
			$item_key,
			'class',
			array(
				'xpro-post-meta-list-item',
				'xpro-repeater-item-' . $repeater_item['_id'],
			)
		);

		$active_settings = $this->get_active_settings();

		if ( 'inline' === $active_settings['view'] ) {
			$this->add_render_attribute( $item_key, 'class', 'xpro-inline-item' );
		}

		if ( ! empty( $item_data['url']['url'] ) ) {
			$has_link = true;

			$this->add_link_attributes( $link_key, $item_data['url'] );
		}

		if ( ! empty( $item_data['itemprop'] ) ) {
			$this->add_render_attribute( $item_key, 'itemprop', $item_data['itemprop'] );
		}

		?>
		<li <?php $this->print_render_attribute_string( $item_key ); ?>>
			<?php if ( $has_link ) : ?>
			<a <?php $this->print_render_attribute_string( $link_key ); ?>>
				<?php endif; ?>
				<?php $this->render_item_icon_or_image( $item_data, $repeater_item, $repeater_index ); ?>
				<?php $this->render_item_text( $item_data, $repeater_index ); ?>
				<?php if ( $has_link ) : ?>
			</a>
		<?php endif; ?>
		</li>
		<?php
	}

	protected function get_meta_data( $repeater_item ) {
		global $post;
		$item_data = array();

		switch ( $repeater_item['type'] ) {
			case 'author':
				$author_id                  = $post->post_author;
				$item_data['text']          = get_the_author_meta( 'display_name', $author_id );
				$item_data['icon']          = 'far fa-user-circle-o'; // Default icon.
				$item_data['selected_icon'] = array(
					'value'   => 'far fa-user-circle',
					'library' => 'fa-regular',
				); // Default icons.
				$item_data['itemprop']      = 'author';

				if ( 'yes' === $repeater_item['link'] ) {
					$item_data['url'] = array(
						'url' => get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ),
					);
				}

				if ( 'yes' === $repeater_item['show_avatar'] ) {
					$item_data['image'] = get_avatar_url( get_the_author_meta( 'ID', $author_id ), 96 );
				}

				break;

			case 'date':
				$custom_date_format = empty( $repeater_item['custom_date_format'] ) ? 'F j, Y' : $repeater_item['custom_date_format'];

				$format_options = array(
					'default' => 'F j, Y',
					'0'       => 'F j, Y',
					'1'       => 'Y-m-d',
					'2'       => 'm/d/Y',
					'3'       => 'd/m/Y',
					'custom'  => $custom_date_format,
				);

				$item_data['text']          = get_the_time( $format_options[ $repeater_item['date_format'] ] );
				$item_data['icon']          = 'far fa-calendar'; // Default icon
				$item_data['selected_icon'] = array(
					'value'   => 'far fa-calendar',
					'library' => 'fa-regular',
				); // Default icons.
				$item_data['itemprop']      = 'datePublished';

				if ( 'yes' === $repeater_item['link'] ) {
					$item_data['url'] = array(
						'url' => get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ),
					);
				}
				break;

			case 'time':
				$custom_time_format = empty( $repeater_item['custom_time_format'] ) ? 'g:i a' : $repeater_item['custom_time_format'];

				$format_options             = array(
					'default' => 'g:i a',
					'0'       => 'g:i a',
					'1'       => 'g:i A',
					'2'       => 'H:i',
					'custom'  => $custom_time_format,
				);
				$item_data['text']          = get_the_time( $format_options[ $repeater_item['time_format'] ] );
				$item_data['icon']          = 'fa fa-clock-o'; // Default icon
				$item_data['selected_icon'] = array(
					'value'   => 'far fa-clock',
					'library' => 'fa-regular',
				); // Default icons.
				break;

			case 'comments':
				if ( comments_open() ) {
					$default_strings = array(
						'string_no_comments' => __( 'No Comments', 'xpro-elementor-addons-pro' ),
						'string_one_comment' => __( 'One Comment', 'xpro-elementor-addons-pro' ),
						'string_comments'    => __( '%s Comments', 'xpro-elementor-addons-pro' ),
					);

					if ( 'yes' === $repeater_item['comments_custom_strings'] ) {
						if ( ! empty( $repeater_item['string_no_comments'] ) ) {
							$default_strings['string_no_comments'] = $repeater_item['string_no_comments'];
						}

						if ( ! empty( $repeater_item['string_one_comment'] ) ) {
							$default_strings['string_one_comment'] = $repeater_item['string_one_comment'];
						}

						if ( ! empty( $repeater_item['string_comments'] ) ) {
							$default_strings['string_comments'] = $repeater_item['string_comments'];
						}
					}

					$num_comments = (int) get_comments_number(); // get_comments_number returns only a numeric value

					if ( 0 === $num_comments ) {
						$item_data['text'] = $default_strings['string_no_comments'];
					} else {
						$item_data['text'] = sprintf( _n( $default_strings['string_one_comment'], $default_strings['string_comments'], $num_comments, 'xpro-elementor-addons-pro' ), $num_comments );
					}

					if ( 'yes' === $repeater_item['link'] ) {
						$item_data['url'] = array(
							'url' => get_comments_link(),
						);
					}
					$item_data['icon']          = 'fa fa-commenting-o'; // Default icon
					$item_data['selected_icon'] = array(
						'value'   => 'far fa-comment-dots',
						'library' => 'fa-regular',
					); // Default icons.
					$item_data['itemprop']      = 'commentCount';
				}
				break;

			case 'terms':
				$item_data['icon']          = 'fa fa-tags'; // Default icon
				$item_data['selected_icon'] = array(
					'value'   => 'fas fa-tags',
					'library' => 'fa-solid',
				); // Default icons.
				$item_data['itemprop']      = 'about';

				$taxonomy = $repeater_item['taxonomy'];
				$terms    = wp_get_post_terms( get_the_ID(), $taxonomy );
				foreach ( $terms as $term ) {
					$item_data['terms_list'][ $term->term_id ]['text'] = $term->name;
					if ( 'yes' === $repeater_item['link'] ) {
						$item_data['terms_list'][ $term->term_id ]['url'] = get_term_link( $term );
					}
				}
				break;

			case 'custom':
				$item_data['text']          = $repeater_item['custom_text'];
				$item_data['icon']          = 'fa fa-info-circle'; // Default icon.
				$item_data['selected_icon'] = array(
					'value'   => 'far fa-tags',
					'library' => 'fa-regular',
				); // Default icons.

				if ( 'yes' === $repeater_item['link'] && ! empty( $repeater_item['custom_url'] ) ) {
					$item_data['url'] = $repeater_item['custom_url'];
				}

				break;
		}

		$item_data['type'] = $repeater_item['type'];

		if ( ! empty( $repeater_item['text_prefix'] ) ) {
			$item_data['text_prefix'] = esc_html( $repeater_item['text_prefix'] );
		}

		return $item_data;
	}

	protected function render_item_icon_or_image( $item_data, $repeater_item, $repeater_index ) {
		// Set icon according to user settings.
		$migration_allowed = Icons_Manager::is_migration_allowed();
		if ( ! $migration_allowed ) {
			if ( 'custom' === $repeater_item['show_icon'] && ! empty( $repeater_item['icon'] ) ) {
				$item_data['icon'] = $repeater_item['icon'];
			} elseif ( 'none' === $repeater_item['show_icon'] ) {
				$item_data['icon'] = '';
			}
		} else {
			if ( 'custom' === $repeater_item['show_icon'] && ! empty( $repeater_item['selected_icon'] ) ) {
				$item_data['selected_icon'] = $repeater_item['selected_icon'];
			} elseif ( 'none' === $repeater_item['show_icon'] ) {
				$item_data['selected_icon'] = array();
			}
		}

		if ( empty( $item_data['icon'] ) && empty( $item_data['selected_icon'] ) && empty( $item_data['image'] ) ) {
			return;
		}

		$migrated  = isset( $repeater_item['__fa4_migrated']['selected_icon'] );
		$is_new    = empty( $repeater_item['icon'] ) && $migration_allowed;
		$show_icon = 'none' !== $repeater_item['show_icon'];

		if ( ! empty( $item_data['image'] ) || $show_icon ) {
			?>
			<span class="xpro-post-meta-list-icon">
			<?php
			if ( ! empty( $item_data['image'] ) ) :
				$image_data = 'image_' . $repeater_index;
				$this->add_render_attribute( $image_data, 'src', $item_data['image'] );
				$this->add_render_attribute( $image_data, 'alt', $item_data['text'] );
				?>
				<img class="xpro-avatar" <?php $this->print_render_attribute_string( $image_data ); ?>>
			<?php elseif ( $show_icon ) : ?>
				<?php
				if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $item_data['selected_icon'], array( 'aria-hidden' => 'true' ) );
				else :
					?>
					<i class="<?php echo esc_attr( $item_data['icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			<?php endif; ?>
			</span>
			<?php
		}
	}

	protected function render_item_text( $item_data, $repeater_index ) {
		$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'xpro-post-meta-list', $repeater_index );

		$this->add_render_attribute(
			$repeater_setting_key,
			'class',
			array(
				'xpro-post-meta-list-text',
				'xpro-post-meta-item',
				'xpro-post-meta-item-type-' . $item_data['type'],
			)
		);
		if ( ! empty( $item['terms_list'] ) ) {
			$this->add_render_attribute( $repeater_setting_key, 'class', 'xpro-terms-list' );
		}

		?>
		<span <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>>
			<?php if ( ! empty( $item_data['text_prefix'] ) ) : ?>
				<span class="xpro-post-meta-item-prefix"><?php echo esc_html( $item_data['text_prefix'] ); ?></span>
			<?php endif; ?>
			<?php
			if ( ! empty( $item_data['terms_list'] ) ) :
				$terms_list = array();
				$item_class = 'xpro-post-meta-terms-list-item';
				?>
				<span class="xpro-post-meta-terms-list">
				<?php
				foreach ( $item_data['terms_list'] as $term ) :
					if ( ! empty( $term['url'] ) ) :
						$terms_list[] = '<a href="' . esc_attr( $term['url'] ) . '" class="' . $item_class . '">' . esc_html( $term['text'] ) . '</a>';
					else :
						$terms_list[] = '<span class="' . $item_class . '">' . esc_html( $term['text'] ) . '</span>';
					endif;
				endforeach;

				echo implode( ', ', $terms_list );
				?>
				</span>
			<?php else : ?>
				<?php
				echo wp_kses(
					$item_data['text'],
					array(
						'a' => array(
							'href'  => array(),
							'title' => array(),
							'rel'   => array(),
						),
					)
				);
				?>
			<?php endif; ?>
		</span>
		<?php
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'post-meta/layout/frontend.php';

	}
}
