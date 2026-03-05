<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
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
class Audio_Player extends Widget_Base {

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
		return 'xpro-audio-player';
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
		return __( 'Audio Player', 'xpro-elementor-addons-pro' );
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
		return 'xi-play xpro-widget-pro-label';
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
		return array( 'music', 'audio', 'player' );
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
		return array( 'jplayer' );
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
	protected function register_controls() {

		$this->start_controls_section(
			'section_icon',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'source_type',
			array(
				'label'   => esc_html__( 'Source Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hosted_url',
				'options' => array(
					'hosted_url' => esc_html__( 'Local', 'xpro-elementor-addons-pro' ),
					'remote_url' => esc_html__( 'Remote', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'hosted_url',
			array(
				'label'      => __( 'Local Audio', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => array(
					'active' => true,
				),
				'media_type' => 'audio',
				'condition'  => array(
					'source_type' => 'hosted_url',
				),
			)
		);

		$this->add_control(
			'remote_url',
			array(
				'label'         => esc_html__( 'Remote URL', 'xpro-elementor-addons-pro' ),
				'description'   => __( 'If you want to add any streaming audio url so please add <b>;stream/1</b> at the end of your url for example: http://cast.com:9942/;stream/1', 'xpro-elementor-addons-pro' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'dynamic'       => array(
					'active' => true,
				),
				'condition'     => array(
					'source_type' => 'remote_url',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_settings',
			array(
				'label' => __( 'Settings', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'time_duration',
			array(
				'label'   => esc_html__( 'Duration', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => array(
					''         => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
					'time'     => esc_html__( 'Time', 'xpro-elementor-addons-pro' ),
					'duration' => esc_html__( 'Duration', 'xpro-elementor-addons-pro' ),
					'both'     => esc_html__( 'Both', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'seek_bar',
			array(
				'label'   => __( 'Seek Bar', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'time_restrict',
			array(
				'label' => __( 'Restrict Time', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'restrict_duration',
			array(
				'label'     => esc_html__( 'Restrict Duration', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'step' => 2,
						'max'  => 200,
					),
				),
				'default'   => array(
					'size' => 10,
				),
				'condition' => array(
					'time_restrict' => 'yes',
				),
			)
		);

		$this->add_control(
			'volume_mute',
			array(
				'label'   => __( 'Volume', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'volume_bar',
			array(
				'label'   => __( 'Volume Bar', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'smooth_show',
			array(
				'label'   => __( 'Smoothly Enter', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'keyboard_enable',
			array(
				'label'   => __( 'Keyboard Enable', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label' => __( 'Auto Play', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label' => __( 'Loop', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'volume_level',
			array(
				'label'   => esc_html__( 'Default Volume', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default' => array(
					'size' => 0.8,
				),
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_style_play_button',
			array(
				'label' => __( 'Play Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'play_button_size',
			array(
				'label'     => esc_html__( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 30,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};line-height: calc({{SIZE}}{{UNIT}} - 4px);',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_play_button' );

		$this->start_controls_tab(
			'tab_play_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'play_button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play svg, {{WRAPPER}} .jp-audio .jp-pause svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'play_button_background',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'play_button_border',
			array(
				'label'     => esc_html__( 'Border Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''       => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
					'solid'  => esc_html__( 'Solid', 'xpro-elementor-addons-pro' ),
					'dotted' => esc_html__( 'Dotted', 'xpro-elementor-addons-pro' ),
					'dashed' => esc_html__( 'Dashed', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'play_button_border_width',
			array(
				'label'      => __( 'Border Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'play_button_border!' => '',
				),
			)
		);

		$this->add_control(
			'play_button_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d5d5d5',
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'play_button_border!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'play_button_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'play_button_shadow',
				'selector' => '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_play_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'play_button_hover_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play:hover svg, {{WRAPPER}} .jp-audio .jp-pause:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'play_button_hover_background',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play:hover, {{WRAPPER}} .jp-audio .jp-pause:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'play_button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'play_button_border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-play:hover, {{WRAPPER}} .jp-audio .jp-pause:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'play_button_hover_shadow',
				'selector' => '{{WRAPPER}} .jp-audio .jp-play:hover, {{WRAPPER}} .jp-audio .jp-pause:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_time',
			array(
				'label'     => __( 'Duration', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'time_duration!' => '',
				),
			)
		);

		$this->add_control(
			'time_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-current-time, {{WRAPPER}} .jp-audio .jp-duration' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'time_typography',
				'selector' => '{{WRAPPER}} .jp-audio .jp-current-time, {{WRAPPER}} .jp-audio .jp-duration',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_seek_bar',
			array(
				'label'     => __( 'Seek Bar', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'seek_bar' => 'yes',
				),
			)
		);

		$this->add_control(
			'seek_bar_height',
			array(
				'label'     => __( 'Bar Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-seek-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'seek_bar_color',
			array(
				'label'     => __( 'Bar Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-seek-bar .jp-play-bar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'seek_bar_bg_color',
			array(
				'label'     => __( 'Bar Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-seek-bar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'seek_bar_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .jp-audio .jp-seek-bar .jp-play-bar, {{WRAPPER}} .jp-audio .jp-seek-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_volume_button',
			array(
				'label'     => __( 'Volume Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'volume_mute' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'volume_button_size',
			array(
				'label'     => esc_html__( 'Size', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 30,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};line-height: calc({{SIZE}}{{UNIT}} - 4px);',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_volume_button' );

		$this->start_controls_tab(
			'tab_volume_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'volume_button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute svg, {{WRAPPER}} .jp-audio .jp-unmute svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'volume_button_background',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'volume_button_border',
			array(
				'label'     => esc_html__( 'Border Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''       => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
					'solid'  => esc_html__( 'Solid', 'xpro-elementor-addons-pro' ),
					'dotted' => esc_html__( 'Dotted', 'xpro-elementor-addons-pro' ),
					'dashed' => esc_html__( 'Dashed', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'volume_button_border_width',
			array(
				'label'      => __( 'Border Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'volume_button_border!' => '',
				),
			)
		);

		$this->add_control(
			'volume_button_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d5d5d5',
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'volume_button_border!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'volume_button_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'volume_button_shadow',
				'selector' => '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_volume_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'volume_button_hover_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute:hover svg, {{WRAPPER}} .jp-audio .jp-unmute:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'volume_button_hover_background',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute:hover, {{WRAPPER}} .jp-audio .jp-unmute:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'volume_button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'volume_button_border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-mute:hover, {{WRAPPER}} .jp-audio .jp-unmute:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'volume_button_hover_shadow',
				'selector' => '{{WRAPPER}} .jp-audio .jp-mute:hover, {{WRAPPER}} .jp-audio .jp-unmute:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_volume_bar',
			array(
				'label'     => __( 'Volume Bar', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'volume_bar' => 'yes',
				),
			)
		);

		$this->add_control(
			'volume_bar_height',
			array(
				'label'     => __( 'Bar Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-volume-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'volume_bar_adjust_color',
			array(
				'label'     => __( 'Bar Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-volume-bar .jp-volume-bar-value' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'volume_bar_bg_color',
			array(
				'label'     => __( 'Bar Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jp-audio .jp-volume-bar' => 'background-color: {{VALUE}};',
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
		$id       = $this->get_id();

		$this->add_render_attribute( 'audio-player', 'class', 'jp-jplayer' );

		$this->add_render_attribute(
			array(
				'audio-player' => array(
					'data-settings' => array(
						wp_json_encode(
							array_filter(
								array(
									'volume_level'      => $settings['volume_level']['size'],
									'keyboard_enable'   => 'yes' === $settings['keyboard_enable'],
									'smooth_show'       => 'yes' === $settings['smooth_show'],
									'time_restrict'     => 'yes' === $settings['time_restrict'],
									'restrict_duration' => ( isset( $settings['restrict_duration']['size'] ) ? $settings['restrict_duration']['size'] : 10 ),
									'autoplay'          => 'yes' === $settings['autoplay'],
									'loop'              => 'yes' === $settings['loop'],
									'audio_source'      => ( 'remote_url' === $settings['source_type'] ) ? esc_url( do_shortcode( $settings['remote_url']['url'] ) ) : esc_url( $settings['hosted_url']['url'] ),
								)
							)
						),
					),
				),
			)
		);

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'audio-player/layout/frontend.php';

	}

}
