<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Woo_Product_Filters extends Widget_Base {

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
		return 'xpro-woo-product-filters';
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
		return __( 'Woo Product Filters', 'xpro-elementor-addons-pro' );
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
		return 'xi-filter xpro-widget-pro-label';
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
		return array( 'products', 'filters', 'products', 'filter', 'woo' );
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
		return array( 'asRange' );
	}

	public function get_custom_terms( $option_key, $key ) {

		$attribute_taxonomies = wc_get_attribute_taxonomies();
		$taxonomy_terms       = array();

		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $tax ) {
				if ( $option_key === $tax->attribute_type ) {
					$attribute_name = wc_attribute_taxonomy_name( $tax->attribute_name );
					if ( taxonomy_exists( $attribute_name ) ) {
						$taxonomy_terms[ $tax->attribute_name ] = get_terms( $attribute_name, 'orderby=name&hide_empty=0' );
					}
				}
			}
		}

		$terms = $this->array_flatten( $taxonomy_terms );

		if ( is_array( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_id      = $term->term_id;
				$meta_value   = get_term_meta( $term_id, $option_key, true );
				$term->{$key} = $meta_value;
			}
		}

		return $terms;
	}

	public function array_flatten( $array ) {
		if ( ! is_array( $array ) ) {
			return false;
		}

		$result = array();
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$result = array_merge( $result, $this->array_flatten( $value ) );
			} else {
				$result[ $key ] = $value;
			}
		}

		return $result;
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
			'section_content',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		//notice
		if ( ! class_exists( '\WooCommerce' ) ) {
			$this->add_control(
				'woo_missing_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: %s: Title */
						__( 'Looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'xpro-elementor-addons-pro' ),
						'<a href="' . esc_url( admin_url( 'plugin-install.php?s=woocommerce&tab=search&type=term' ) )
						. '" target="_blank" rel="noopener">Woocommerce Plugin</a>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				)
			);

			$this->add_control(
				'woo_install',
				array(
					'type' => Controls_Manager::RAW_HTML,
					'raw'  => '<a href="' . esc_url( admin_url( 'plugin-install.php?s=woocommerce&tab=search&type=term' ) ) . '" target="_blank" rel="noopener">Click to install or activate Woocommerce Plugin</a>',
				)
			);
			$this->end_controls_section();

			return;
		}

		$repeater = new Repeater();

		$repeater->add_control(
			'filter_view',
			array(
				'label'   => esc_html__( 'Filter View', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'price',
				'options' => array(
					'price'     => esc_html__( 'Price Filter', 'xpro-elementor-addons-pro' ),
					'rating'    => esc_html__( 'Rating Filter', 'xpro-elementor-addons-pro' ),
					'category'  => esc_html__( 'Category Filter', 'xpro-elementor-addons-pro' ),
					'stock'     => esc_html__( 'Stock Filter', 'xpro-elementor-addons-pro' ),
					'on-sale'   => esc_html__( 'On Sale Filter', 'xpro-elementor-addons-pro' ),
					'attribute' => esc_html__( 'Attributes', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'filter_title',
			array(
				'label'       => esc_html__( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Default title', 'xpro-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type your title here', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'filter_price_min',
			array(
				'label'     => esc_html__( 'Min Price', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'condition' => array(
					'filter_view' => 'price',
				),
			)
		);

		$repeater->add_control(
			'filter_price_max',
			array(
				'label'     => esc_html__( 'Max Price', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'condition' => array(
					'filter_view' => 'price',
				),
			)
		);

		$repeater->add_control(
			'range_slider_dot_type',
			array(
				'label'     => esc_html__( 'Dot Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'square',
				'options'   => array(
					'square' => array(
						'title' => esc_html__( 'Square', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-square',
					),
					'circle' => array(
						'title' => esc_html__( 'Circle', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-dot-circle-o',
					),
				),
				'condition' => array(
					'filter_view' => 'price',
				),
			)
		);

		$repeater->add_control(
			'filter_color_dot_status',
			array(
				'label'        => esc_html__( 'Show Color Dot', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filter_view' => 'color',
				),
			)
		);

		$repeater->add_control(
			'orderby',
			array(
				'label'     => esc_html__( 'Order by', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'name',
				'options'   => array(
					'order' => esc_html__( 'Category order', 'xpro-elementor-addons-pro' ),
					'name'  => esc_html__( 'Name', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'filter_view' => 'category',
				),
			)
		);

		$repeater->add_control(
			'hierarchical',
			array(
				'label'        => esc_html__( 'Show hierarchy', 'xpro-elementor-addons-pro ' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'xpro-elementor-addons-pro ' ),
				'label_off'    => esc_html__( 'No', 'xpro-elementor-addons-pro ' ),
				'return_value' => 'yes',
				'condition'    => array(
					'filter_view' => 'category',
				),
			)
		);

		$repeater->add_control(
			'show_parent_only',
			array(
				'label'        => esc_html__( 'Show parent only', 'xpro-elementor-addons-pro ' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'xpro-elementor-addons-pro ' ),
				'label_off'    => esc_html__( 'No', 'xpro-elementor-addons-pro ' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'hierarchical!' => 'yes',
					'filter_view'   => 'category',
				),
			)
		);

		$repeater->add_control(
			'hide_empty',
			array(
				'label'        => esc_html__( 'Hide empty categories', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filter_view' => 'category',
				),
			)
		);

		$repeater->add_control(
			'except_exclude',
			array(
				'label'       => __( 'Exclude', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => $this->taxonomies_exclude(),
				'condition'   => array(
					'filter_view' => 'category',
				),
			)
		);

		$repeater->add_control(
			'attribute',
			array(
				'label'     => esc_html__( 'Attribute', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_attribute_taxonomies(),
				'condition' => array(
					'filter_view' => 'attribute',
				),
			)
		);

		$repeater->add_control(
			'checkbox_icon',
			array(
				'label'     => esc_html__( 'Checkbox Icons', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-check',
					'library' => 'solid',
				),
				'condition' => array(
					'filter_view!' => 'price',
				),
			)
		);

		$repeater->add_control(
			'star_icon',
			array(
				'label'     => esc_html__( 'Star Icons', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
				'condition' => array(
					'filter_view' => 'rating',
				),
			)
		);

		$this->add_control(
			'product_filter_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ filter_title }}}',
				'default'     => array(
					array(
						'filter_view'  => esc_html__( 'price', 'xpro-elementor-addons-pro' ),
						'filter_title' => esc_html__( 'Price Range', 'xpro-elementor-addons-pro' ),
					),
					array(
						'filter_view'  => esc_html__( 'rating', 'xpro-elementor-addons-pro' ),
						'filter_title' => esc_html__( 'Product Rating', 'xpro-elementor-addons-pro' ),
					),
					array(
						'filter_view'  => esc_html__( 'category', 'xpro-elementor-addons-pro' ),
						'filter_title' => esc_html__( 'Product Category', 'xpro-elementor-addons-pro' ),
					),
					array(
						'filter_view'  => esc_html__( 'stock', 'xpro-elementor-addons-pro' ),
						'filter_title' => esc_html__( 'Stock', 'xpro-elementor-addons-pro' ),
					),
					array(
						'filter_view'  => esc_html__( 'on-sale', 'xpro-elementor-addons-pro' ),
						'filter_title' => esc_html__( 'On Sale', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'Style', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-filter .xpro-product-filter-title',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => esc_html__( 'Title Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-filter .xpro-product-filter-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'filter_title_padding',
			array(
				'label'      => esc_html__( 'Title Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-filter-single:not(.xpro-collapse) .xpro-product-filter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'body_options',
			array(
				'label'     => esc_html__( 'Body', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filters_typography_primary',
				'label'    => esc_html__( 'Title Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-filter > ul > li',
			)
		);

		$this->add_control(
			'body_title_color',
			array(
				'label'     => esc_html__( 'Filter Label Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-filter > ul > li' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hcolor',
			array(
				'label'     => esc_html__( 'Filter Label Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-filter > ul > li:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'filter_title_margin',
			array(
				'label'      => esc_html__( 'Item Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-filter > ul > li,
					{{WRAPPER}} .xpro-filter > ul > li:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'checkbox_style_options',
			array(
				'label'     => esc_html__( 'Checkbox', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'checkbox_icon_size',
			array(
				'label'      => esc_html__( 'Checkbox Icon Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-checkbox-icon i'  => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-checkbox-icon svg,
					{{WRAPPER}} .xpro-checkbox-icon span,
					{{WRAPPER}} .xpro-checkbox-icon img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'checkbox_bg_size',
			array(
				'label'      => esc_html__( 'Checkbox Bg Size', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-checkbox-icon' => 'line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'checkbox_margin_right',
			array(
				'label'      => esc_html__( 'Space Between', 'xpro-elementor-addons-pro' ),
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
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-checkbox-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'tab_checkbox_style'
		);

		$this->start_controls_tab(
			'checked_normal_style',
			array(
				'label' => esc_html__( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'checkbox_bg_clr',
			array(
				'label'     => esc_html__( 'Checked Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .xpro-checkbox-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'checkbox_active_style',
			array(
				'label' => esc_html__( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'checkbox_acolor',
			array(
				'label'     => esc_html__( 'Checkbox Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .active .xpro-checkbox-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .active .xpro-checkbox-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'checkbox_abg_color',
			array(
				'label'     => esc_html__( 'Checked Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .active .xpro-checkbox-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'checkbox_aborder_color',
			array(
				'label'     => esc_html__( 'Checkbox Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .active .xpro-checkbox-icon' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'checkbox_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-checkbox-icon',
			)
		);

		$this->add_responsive_control(
			'checkbox_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .xpro-checkbox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style_price_filter',
			array(
				'label' => __( 'Price Range', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'range_slider_color',
			array(
				'label'     => esc_html__( 'Slider Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-filter-price .asRange:before' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'range_slider_active_color',
			array(
				'label'     => esc_html__( 'Active Slider Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-filter-price .asRange > .asRange-selected:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-filter-price .asRange > .asRange-pointer'         => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'range_text_color',
			array(
				'label'     => esc_html__( 'Range Pricing Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-filter-price-result' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'price_filter_btn_heading',
			array(
				'label'     => esc_html__( 'Filter Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'reset_btn_margin_bottom',
			array(
				'label'      => esc_html__( 'Margin bottom', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-filter-price-btn' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'tab_reset_btn'
		);

		$this->start_controls_tab(
			'tab_reset_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'reset_btn_color',
			array(
				'label'     => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-filter-reset' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'reset_btn_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-filter-reset' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_reset_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'reset_btn_hcolor',
			array(
				'label'     => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-filter-reset:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'reset_btn_hbg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-filter-reset:hover' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'reset_btn_hborder_color',
			array(
				'label'     => esc_html__( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-filter-reset:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'reset_btn_border',
				'separator' => 'before',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-woo-filter-reset',
			)
		);

		$this->add_responsive_control(
			'reset_btn_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-filter-reset' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'reset_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-filter-reset' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style_rating_filter',
			array(
				'label' => __( 'Rating Filter', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'filter_rating_active_color',
			array(
				'label'     => esc_html__( 'Star Color Active', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} [data-filter-value="5"] .xpro-filter-rating-stars > i,
					{{WRAPPER}} [data-filter-value="4"] .xpro-filter-rating-stars > i:nth-child(-n+4),
					{{WRAPPER}} [data-filter-value="3"] .xpro-filter-rating-stars > i:nth-child(-n+3),
					{{WRAPPER}} [data-filter-value="2"] .xpro-filter-rating-stars > i:nth-child(-n+2),
					{{WRAPPER}} [data-filter-value="1"] .xpro-filter-rating-stars > i:nth-child(-n+1)' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-filter-rating-stars > svg' => 'fill: {{VALUE}}',

				),
			)
		);

		$this->add_responsive_control(
			'star_size',
			array(
				'label'      => esc_html__( 'Star Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 11,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-filter-rating-stars i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-filter-rating-stars svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'star_margin',
			array(
				'label'      => esc_html__( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-filter-rating-stars i,
					{{WRAPPER}} .xpro-filter-rating-stars svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style_category_filter',
			array(
				'label' => __( 'Category Filter', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'subcategory_padding',
			array(
				'label'      => esc_html__( 'Sub Category Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-filter-category-subcategories' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

	}

	public static function taxonomies_exclude() {

		$list = array();

		$terms = get_terms(
			array(
				'order'      => 'asc',
				'hide_empty' => false,
			)
		);

		foreach ( $terms as $value ) {
			$list[ $value->term_id ] = $value->name;
		}

		return $list;
	}

	public function get_attribute_taxonomies() {

		$attributes = array();
		if ( class_exists( 'WooCommerce' ) ) {
			$attributes = wc_get_attribute_taxonomies();
		}
		$attr = array();
		foreach ( $attributes as $attribute ) {
			$attr[ $attribute->attribute_id ] = $attribute->attribute_label;
		}

		return $attr;
	}

	/**
	 * xpro_elementor_get_product_taxonomies
	 *
	 * @since 0.1.8
	 * @access public
	 *
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-product-filters/layout/frontend.php';
	}
}
