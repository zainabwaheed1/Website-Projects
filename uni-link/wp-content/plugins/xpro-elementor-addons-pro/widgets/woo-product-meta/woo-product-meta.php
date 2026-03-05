<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
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
class Woo_Product_Meta extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-woo-product-meta';
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
	 * Retrieve widget title.
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Woo Product Meta', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
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
		return array( 'woo', 'product', 'meta' );
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
			'section_general_fields',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		if ( ! class_exists( '\WooCommerce' ) ) {
			$this->add_control(
				'woo_missing_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: 1$s: Title */
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

		$this->add_control(
			'display_sku',
			array(
				'label'                => __( 'Show SKU', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
					'yes' => __( 'Yes', 'xpro-elementor-addons-pro' ),
					'no'  => __( 'No', 'xpro-elementor-addons-pro' ),
				),
				'default'              => 'yes',
				'selectors_dictionary' => array(
					'yes' => 'display: block;',
					'no'  => 'display: none;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .product_meta .sku_wrapper' => '{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'display_taxonomy',
			array(
				'label'                => __( 'Show Taxonomy', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => array(
					'yes' => __( 'Yes', 'xpro-elementor-addons-pro' ),
					'no'  => __( 'No', 'xpro-elementor-addons-pro' ),
				),
				'default'              => 'yes',
				'selectors_dictionary' => array(
					'yes' => 'display: block;',
					'no'  => 'display: none;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .product_meta .posted_in' => '{{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'space_btw',
			array(
				'label'     => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .posted_in' => 'padding-left: {{SIZE}}{{UNIT}};',
				),
				'default'   => array(
					'size' => 10,
				),
				'condition' => array(
					'select_layout' => 'row',
				),
			)
		);

		$this->add_responsive_control(
			'select_layout',
			array(
				'label'                => __( 'Select Layout', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
					'row'    => array(
						'title' => __( 'Row', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
					'column' => array(
						'title' => __( 'Column', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-menu-bar',
					),
				),
				'default'              => 'row',
				'selectors_dictionary' => array(
					'row'    => 'display: flex; flex-direction: row',
					'column' => 'display: flex; flex-direction: column',
				),

				'selectors'            => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .product_meta' => '{{VALUE}};',
				),

			)
		);

		$this->add_responsive_control(
			'content_align_row',
			array(
				'label'                => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'left',
				'options'              => array(
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

				'selectors_dictionary' => array(
					'left'   => 'justify-content: left; align-items: baseline;',
					'center' => 'justify-content: center; align-items: baseline;',
					'right'  => 'justify-content: right; align-items: baseline;',
				),

				'selectors'            => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .product_meta' => '{{VALUE}};',
				),

				'condition'            => array(
					'select_layout' => 'row',
				),
			)
		);

		$this->add_responsive_control(
			'content_align_column',
			array(
				'label'                => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
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
				'default'              => 'left',
				'selectors_dictionary' => array(
					'left'   => 'justify-content: left; align-items: start;',
					'center' => 'justify-content: center; align-items: center;',
					'right'  => 'justify-content: right; align-items: end;',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .product_meta' => '{{VALUE}};',
				),

				'condition'            => array(
					'select_layout' => 'column',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_sku_styling',
			array(
				'label' => __( 'SKU', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sku_typography',
				'selector' => '{{WRAPPER}} .sku_wrapper',
			)
		);

		$this->add_control(
			'sku_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .sku_wrapper' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'sku_title_color',
			array(
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .sku_wrapper .sku' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_taxonomy_styling',
			array(
				'label' => __( 'Taxonomy', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tax_typography',
				'selector' => '{{WRAPPER}} .xpro-woo-product-meta-cls .posted_in',
			)
		);

		$this->add_control(
			'tax_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .posted_in' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tax_link_color',
			array(
				'label'     => __( 'Link Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .posted_in a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tax_link_hv_color',
			array(
				'label'     => __( 'Link Hover', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-woo-product-meta-cls .posted_in a:hover' => 'color: {{VALUE}};',
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

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-product-meta/layout/frontend.php';
	}
}
