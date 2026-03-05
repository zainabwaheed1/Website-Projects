<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Widget_Base;
use XproElementorAddons\Libs\Dashboard\Classes\Xpro_Elementor_Dashboard_Utils;

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
class Street_Map extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-street-map';
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
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Street Map', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 *
	 * @return string Widget icon.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-landmark xpro-widget-pro-label';
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
		return array( 'street', 'map', 'maps', 'point', 'pin' );
	}

	public function get_style_depends() {
		return array( 'leaflet' );
	}

	public function get_script_depends() {
		return array( 'leaflet' );
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
			'zoom_control',
			array(
				'label'   => esc_html__( 'Zoom Control', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'zoom',
			array(
				'label'   => esc_html__( 'Zoom', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'size' => 16,
				),
				'range'   => array(
					'px' => array(
						'min' => 1,
						'max' => 50,
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_marker',
			array(
				'label' => __( 'Marker', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'tabs_content_marker' );

		$repeater->start_controls_tab(
			'tab_content_content',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'marker_lat',
			array(
				'label'   => __( 'Latitude', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => '51.50452',
			)
		);

		$repeater->add_control(
			'marker_lng',
			array(
				'label'   => __( 'Longitude', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => '-0.11780',
			)
		);

		$repeater->add_control(
			'marker_title',
			array(
				'label'   => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => 'Another Place',
			)
		);

		$repeater->add_control(
			'marker_content',
			array(
				'label'   => __( 'Content', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array( 'active' => true ),
				'default' => __( 'Your Business Address Here', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_content_marker',
			array(
				'label' => __( 'Marker', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'custom_marker',
			array(
				'label' => __( 'Custom Marker', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'markers',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'marker_lat'     => '51.50332',
						'marker_lng'     => '-0.11980',
						'marker_title'   => __( 'London Eye', 'xpro-elementor-addons-pro' ),
						'marker_content' => __( 'London Eye, London, United Kingdom', 'xpro-elementor-addons-pro' ),
					),
				),
				'title_field' => '{{{ marker_title }}}',
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
			'open_street_map_height',
			array(
				'label'       => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'max' => 1000,
					),
				),
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .xpro-open-street-map' => 'min-height: {{SIZE}}{{UNIT}} !important',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_style_css_filters' );

		$this->start_controls_tab(
			'tab_css_filter_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .xpro-open-street-map',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_css_filter_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .xpro-open-street-map:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//ToolTip
		$this->start_controls_section(
			'section_style_tooltip',
			array(
				'label' => esc_html__( 'Tooltip', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'marker_tooltip_typography',
				'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper',
			)
		);

		$this->add_control(
			'marker_tooltip_color',
			array(
				'label'     => esc_html__( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .leaflet-popup-content-wrapper' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'marker_tooltip_button_color',
			array(
				'label'     => esc_html__( 'Close Button Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .leaflet-popup-close-button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'marker_tooltip_button_hover_color',
			array(
				'label'     => esc_html__( 'Close Button Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .leaflet-popup-close-button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'marker_tooltip_background',
				'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper, {{WRAPPER}} .leaflet-popup-tip',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'marker_tooltip_border',
				'label'       => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .leaflet-popup-content-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'marker_tooltip_shadow',
				'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper',
			)
		);

		$this->add_responsive_control(
			'marker_tooltip_border_radius',
			array(
				'label'      => __( 'Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .leaflet-popup-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'marker_tooltip_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .leaflet-popup-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$marker_settings        = array();
		$map_settings           = array();
		$xpro_elementor_counter = 0;

		$user_settings = Xpro_Elementor_Dashboard_Utils::instance()->get_option( 'xpro_elementor_user_data', array() );

		if ( Plugin::$instance->editor->is_edit_mode() && empty( $user_settings['street_map']['api'] ) ) {
			?>
			<div class="xpro-alert xpro-alert-warning" role="alert">
				<span class="xpro-alert-title">
					<?php esc_html_e( 'Street Map API Not Found.', 'xpro-elementor-addons-pro' ); ?>
				</span>
				<span class="xpro-alert-description">
					<?php esc_html_e( 'Please set your street map api key in "Xpro Elementor Addons Settings" to show your map correctly.', 'xpro-elementor-addons-pro' ); ?>
				</span>
			</div>
			<?php
		}

		$map_settings['mapboxToken'] = isset( $user_settings['street_map']['api'] ) ? $user_settings['street_map']['api'] : '';

		foreach ( $settings['markers'] as $marker_item ) :

			$marker_settings['lat']        = ( $marker_item['marker_lat'] ) ? $marker_item['marker_lat'] : '';
			$marker_settings['lng']        = ( $marker_item['marker_lng'] ) ? $marker_item['marker_lng'] : '';
			$marker_settings['title']      = ( $marker_item['marker_title'] ) ? $marker_item['marker_title'] : '';
			$marker_settings['iconUrl']    = ( $marker_item['custom_marker']['url'] ) ? $marker_item['custom_marker']['url'] : XPRO_ELEMENTOR_ADDONS_PRO_ASSETS . 'images/marker-icon.png';
			$marker_settings['infoWindow'] = ( $marker_item['marker_content'] ) ? $marker_item['marker_content'] : '';

			$all_markers[] = $marker_settings;

			$xpro_elementor_counter ++;

			if ( 1 === $xpro_elementor_counter ) {
				$map_settings['lat'] = ( $marker_item['marker_lat'] ) ? $marker_item['marker_lat'] : '';
				$map_settings['lng'] = ( $marker_item['marker_lng'] ) ? $marker_item['marker_lng'] : '';
			}

			$map_settings['zoomControl'] = ( $settings['zoom_control'] ) ? true : false;
			$map_settings['zoom']        = $settings['zoom']['size'];

		endforeach;

		$this->add_render_attribute( 'open-street-map', 'data-settings', wp_json_encode( $map_settings ) );
		$this->add_render_attribute( 'open-street-map', 'data-map_markers', wp_json_encode( $all_markers ) );

		?>
		<div class="xpro-open-street-map" <?php $this->print_render_attribute_string( 'open-street-map' ); ?>></div>
		<?php
	}

}
