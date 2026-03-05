<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
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
class Google_Map extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		$user_settings = Xpro_Elementor_Dashboard_Utils::instance()->get_option( 'xpro_elementor_user_data', array() );

		if ( $user_settings && ! empty( $user_settings['google_map']['api'] ) ) {
			wp_register_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?key=' . $user_settings['google_map']['api'], array( 'jquery' ), XPRO_ELEMENTOR_ADDONS_VERSION, true );
		}

		wp_register_script( 'gmap', XPRO_ELEMENTOR_ADDONS_ASSETS . 'vendor/js/google-map.min.js', array( 'jquery' ), '0.4.25', true );

	}

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
		return 'xpro-google-map';
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
		return __( 'Google Map', 'xpro-elementor-addons-pro' );
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
		return 'xi-cursor xpro-widget-pro-label';
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
		return array( 'google', 'map', 'maps', 'point', 'pin' );
	}

	public function get_script_depends() {
		return array( 'gmap-api', 'gmap' );
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
			'street_view',
			array(
				'label'   => __( 'Street View', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'type_control',
			array(
				'label'   => __( 'Map Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'zoom_control',
			array(
				'label'   => __( 'Zoom Control', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'zoom',
			array(
				'label'     => __( 'Zoom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'default'   => array(
					'size' => 15,
				),
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 24,
					),
				),
				'condition' => array( 'zoom_control' => 'yes' ),
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
				'default' => '24.8248746',
			)
		);

		$repeater->add_control(
			'marker_lng',
			array(
				'label'   => __( 'Longitude', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => '1.296480',
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
				'label' => __( 'Custom marker', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'marker',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'marker_lat'     => '24.8238746',
						'marker_lng'     => '1.294480',
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

		$this->add_control(
			'xpro_elementor_google_map_style',
			array(
				'label'       => __( 'Style Json Code', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'description' => sprintf(
				/* translators: 1$s: Title */
					__( 'Go to this link: %1$1s snazzymaps.com %2$2s and pick a style, copy the json code and paste here', 'xpro-elementor-addons-pro' ),
					'<a href="https://snazzymaps.com/" target="_blank">',
					'</a>'
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
				'selector' => '{{WRAPPER}} .xpro-google-map',
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
				'selector' => '{{WRAPPER}} .xpro-google-map:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'height',
			array(
				'label'     => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range'     => array(
					'px' => array(
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-google-map' => 'min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

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
				'selector' => '{{WRAPPER}} .gm-style .gm-style-iw',
			)
		);

		$this->add_control(
			'marker_tooltip_color',
			array(
				'label'     => esc_html__( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .gm-style .gm-style-iw' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'marker_tooltip_shadow',
				'selector' => '{{WRAPPER}} .gm-style .gm-style-iw',
			)
		);

		$this->add_responsive_control(
			'marker_tooltip_border_radius',
			array(
				'label'      => __( 'Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .gm-style .gm-style-iw' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .gm-style .gm-style-iw-c' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
		$id       = 'xpro-google-map-' . $this->get_id();

		$user_settings = Xpro_Elementor_Dashboard_Utils::instance()->get_option( 'xpro_elementor_user_data', array() );

		if ( Plugin::$instance->editor->is_edit_mode() && empty( $user_settings['google_map']['api'] ) ) {
			?>
			<div class="xpro-alert xpro-alert-warning" role="alert">
				<span class="xpro-alert-title">
					<?php esc_html_e( 'Google Map API Not Found.', 'xpro-elementor-addons-pro' ); ?>
				</span>
				<span class="xpro-alert-description">
					<?php esc_html_e( 'Please set your google map api key in "Xpro Elementor Addons Settings" to show your map correctly.', 'xpro-elementor-addons-pro' ); ?>
				</span>
			</div>
			<?php
		}

		if ( empty( $user_settings['google_map']['api'] ) ) {
			return;
		}

		$map_settings       = array();
		$map_settings['el'] = '#' . $id;

		$marker_settings        = array();
		$xpro_elementor_counter = 0;
		$all_markers            = array();

		foreach ( $settings['marker'] as $marker_item ) {
			$marker_settings['lat']   = (float) ( ( $marker_item['marker_lat'] ) ? $marker_item['marker_lat'] : '' );
			$marker_settings['lng']   = (float) ( ( $marker_item['marker_lng'] ) ? $marker_item['marker_lng'] : '' );
			$marker_settings['title'] = ( $marker_item['marker_title'] ) ? $marker_item['marker_title'] : '';
			$marker_settings['icon']  = ( $marker_item['custom_marker']['url'] ) ? $marker_item['custom_marker']['url'] : '';

			$marker_settings['infoWindow']['content'] = ( $marker_item['marker_content'] ) ? $marker_item['marker_content'] : '';

			$all_markers[] = $marker_settings;

			$xpro_elementor_counter ++;
			if ( 1 === $xpro_elementor_counter ) {
				$map_settings['lat'] = ( $marker_item['marker_lat'] ) ? $marker_item['marker_lat'] : '';
				$map_settings['lng'] = ( $marker_item['marker_lng'] ) ? $marker_item['marker_lng'] : '';
			}
		}

		$map_settings['zoomControl'] = ( $settings['zoom_control'] ) ? true : false;
		$map_settings['zoom']        = $settings['zoom']['size'];

		$map_settings['streetViewControl'] = ( $settings['street_view'] ) ? true : false;
		$map_settings['mapTypeControl']    = ( $settings['type_control'] ) ? true : false;

		$this->add_render_attribute( 'xpro-google-map', 'id', $id );
		$this->add_render_attribute( 'xpro-google-map', 'class', 'xpro-google-map' );

		$this->add_render_attribute( 'xpro-google-map', 'data-map_markers', wp_json_encode( $all_markers ) );

		if ( '' !== $settings['xpro_elementor_google_map_style'] ) {
			$this->add_render_attribute( 'xpro-google-map', 'data-map_style', trim( preg_replace( '/\s+/', ' ', $settings['xpro_elementor_google_map_style'] ) ) );
		}

		$this->add_render_attribute( 'xpro-google-map', 'data-map_settings', wp_json_encode( $map_settings ) );

		?>

		<div <?php $this->print_render_attribute_string( 'xpro-google-map' ); ?>></div>

		<?php

	}

}
