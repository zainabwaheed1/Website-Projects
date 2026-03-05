<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
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
class Pricing_Matrix extends Widget_Base {

	public static function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'baht'         => '&#3647;',
			'bdt'          => '&#2547;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'rupee'        => '&#8360;',
			'guilder'      => '&fnof;',
			'indian_rupee' => '&#8377;',
			'pound'        => '&#163;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'real'         => 'R$',
			'krona'        => 'kr',
			'won'          => '&#8361;',
			'yen'          => '&#165;'
		);

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

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
		return 'xpro-pricing-matrix';
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
		return __( 'Pricing Matrix', 'xpro-elementor-addons-pro' );
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
		return 'xi-pricing-matrix xpro-widget-pro-label';
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
		return array( 'pricing', 'price', 'matrix' );
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

		return array( 'owl-carousel' );

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
		return array( 'owl-carousel' );
	}

	/**
	 * Register Pricing widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 0.1.8
	 * @access protected
	 */

	protected function register_controls() {

		$this->start_controls_section(
			'section_pricing_matrix',
			array(
				'label' => __( 'Pricing', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_matrix_style',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'4' => __( 'Style 4', 'xpro-elementor-addons-pro' ),
					'5' => __( 'Style 5', 'xpro-elementor-addons-pro' ),
					'6' => __( 'Style 6', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'featured',
			array(
				'label'              => __( 'Featured', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => __( 'Basic', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'price_heading',
			array(
				'label'     => __( 'Price', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'currency',
			array(
				'label'       => __( 'Currency', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => array(
					''             => __( 'None', 'xpro-elementor-addons-pro' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'xpro-elementor-addons-pro' ),
					'custom'       => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'default'     => 'dollar',
			)
		);

		$repeater->add_control(
			'currency_custom',
			array(
				'label'     => __( 'Custom Symbol', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'currency' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'   => __( 'Price', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '9.99',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'price_original',
			array(
				'label'   => __( 'Original Price', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'period',
			array(
				'label'   => __( 'Period', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Per Month', 'xpro-elementor-addons-pro' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'features_heading',
			array(
				'label'     => __( 'List', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		for ( $x = 1; $x <= 20; $x ++ ) {

			$repeater->add_control(
				'list_item_' . $x,
				array(
					'label'        => __( 'List Item ' . $x, 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::POPOVER_TOGGLE,
					'return_value' => 'yes',
				)
			);

			$repeater->start_popover();

			$repeater->add_control(
				'list_item_' . $x . '_icon',
				array(
					'label'       => __( 'Icon', 'xpro-elementor-addons-pro' ),
					'type'        => Controls_Manager::ICONS,
					'default'     => array(
						'value'   => 'fas fa-check',
						'library' => 'fa-solid',
					),
					'recommended' => array(
						'fa-solid' => array(
							'check',
							'check-circle',
							'times',
							'times-circle',
						),
					),
					'condition'   => array(
						'list_item_' . $x => 'yes',
					),
				)
			);

			$repeater->add_control(
				'list_item_' . $x . '_text',
				array(
					'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
					'default'   => __( 'Feature List ' . $x, 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::TEXT,
					'dynamic'   => array(
						'active' => true,
					),
					'condition' => array(
						'list_item_' . $x => 'yes',
					),
				)
			);

			$repeater->add_control(
				'list_item_' . $x . '_status',
				array(
					'label'     => __( 'Status', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'active',
					'options'   => array(
						'active'   => __( 'Active', 'xpro-elementor-addons-pro' ),
						'inactive' => __( 'Inactive', 'xpro-elementor-addons-pro' ),
					),
					'condition' => array(
						'list_item_' . $x => 'yes',
					),
				)
			);

			$repeater->end_popover();

		}

		$repeater->add_control(
			'description_heading',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'item_description',
			array(
				'label'   => '',
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'A great place to start', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'button_heading',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'button_title',
			array(
				'label'       => '',
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Select', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
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
			)
		);

		$repeater->add_control(
			'badge_heading',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'badge_text',
			array(
				'label'       => '',
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{title}}'
				),
				'render_type' => 'template',
				'default'     => array(
					array(
						'icon'        => array(
							'value'   => 'fas fa-train',
							'library' => 'fa-solid',
						),
						'title'       => __( 'Basic', 'xpro-elementor-addons-pro' ),
						'price'       => __( '9.99', 'xpro-elementor-addons-pro' ),
						'list_item_1' => 'yes',
						'list_item_2' => 'yes',
						'list_item_3' => 'yes',
						'list_item_4' => 'yes',
						'list_item_5' => 'yes',
						'list_item_6' => 'yes',
					),
					array(
						'icon'        => array(
							'value'   => 'fas fa-globe',
							'library' => 'fa-solid',
						),
						'title'       => __( 'Standard', 'xpro-elementor-addons-pro' ),
						'price'       => __( '59', 'xpro-elementor-addons-pro' ),
						'badge_text'  => __( 'Featured', 'xpro-elementor-addons-pro' ),
						'featured'    => 'yes',
						'list_item_1' => 'yes',
						'list_item_2' => 'yes',
						'list_item_3' => 'yes',
						'list_item_4' => 'yes',
						'list_item_5' => 'yes',
						'list_item_6' => 'yes',
					),
					array(
						'icon'        => array(
							'value'   => 'fas fa-user',
							'library' => 'fa-solid',
						),
						'title'       => __( 'Enterprise', 'xpro-elementor-addons-pro' ),
						'price'       => __( '99', 'xpro-elementor-addons-pro' ),
						'list_item_1' => 'yes',
						'list_item_2' => 'yes',
						'list_item_3' => 'yes',
						'list_item_4' => 'yes',
						'list_item_5' => 'yes',
						'list_item_6' => 'yes',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_packages',
			array(
				'label' => __( 'Packages', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'packages_title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Comparison Price', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$packages = new Repeater();

		$packages->add_control(
			'packages_item_text',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'Package Name', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$packages->add_control(
			'packages_item_tooltip_text',
			array(
				'label'       => __( 'Tooltip', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'packages_item',
			array(
				'label'       => __( 'Package List', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $packages->get_controls(),
				'title_field' => sprintf(
				/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ),
					'{{packages_item_text}}'
				),
				'render_type' => 'template',
				'default'     => array(
					array(
						'packages_item_text' => __( 'Package Name 1', 'xpro-elementor-addons-pro' ),
					),
					array(
						'packages_item_text'         => __( 'Package Name 2', 'xpro-elementor-addons-pro' ),
						'packages_item_tooltip_text' => __( 'Tooltip Text Here', 'xpro-elementor-addons-pro' ),
					),
					array(
						'packages_item_text' => __( 'Package Name 3', 'xpro-elementor-addons-pro' ),
					),
					array(
						'packages_item_text' => __( 'Package Name 4', 'xpro-elementor-addons-pro' ),
					),
					array(
						'packages_item_text' => __( 'Package Name 5', 'xpro-elementor-addons-pro' ),
					),
					array(
						'packages_item_text' => __( 'Package Name 6', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->end_controls_section();

		//Carousel Settings Tab
		$this->start_controls_section(
			'section_carousel',
			array(
				'label' => __( 'Settings', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'item_per_row',
			array(
				'label'              => __( 'Items To Show', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust items to show in a row.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 2,
				'desktop_default'    => 2,
				'tablet_default'     => 1,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'item_list_height',
			array(
				'label'       => __( 'Height', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Adjust list height in a row.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'render_type' => 'template',
				'default'     => array(
					'size' => '65',
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 150,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-matrix-package-list > li, .xpro-matrix-item-list > li' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'              => __( 'Loop', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Duplicate last and first items to get loop illusion.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'mouse_drag',
			array(
				'label'              => __( 'Mouse Drag', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Mouse drag enabled.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'rtl',
			array(
				'label'              => __( 'RTL', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Change direction from Right to left.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-owl-theme.owl-carousel' => 'direction: rtl;',
				),
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => __( 'Autoplay', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To enable autoplay behaviour.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'autoplay_timeout',
			array(
				'label'              => __( 'Autoplay Timeout', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Autoplay interval timeout in seconds(s).', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 3,
				),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_nav_on',
			array(
				'label'              => __( 'Show Nav', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show Navigation Arrows.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT2,
				'multiple'           => true,
				'label_block'        => true,
				'default'            => array( 'desktop', 'tablet', 'mobile' ),
				'options'            => array(
					'desktop' => __( 'Desktop', 'xpro-elementor-addons-pro' ),
					'tablet'  => __( 'Tablet', 'xpro-elementor-addons-pro' ),
					'mobile'  => __( 'Mobile', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'show_dots_on',
			array(
				'label'              => __( 'Show Tabs', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show tabs navigation.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT2,
				'multiple'           => true,
				'label_block'        => true,
				'default'            => array( 'tablet', 'mobile' ),
				'options'            => array(
					'desktop' => __( 'Desktop', 'xpro-elementor-addons-pro' ),
					'tablet'  => __( 'Tablet', 'xpro-elementor-addons-pro' ),
					'mobile'  => __( 'Mobile', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->end_controls_section();

		//Pricing
		$this->start_controls_section(
			'section_pricing_style',
			array(
				'label' => __( 'Pricing', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-matrix .item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pricing_item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix .item',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pricing_item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix .item',
			)
		);

		$this->add_responsive_control(
			'pricing_item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_header_heading',
			array(
				'label'     => __( 'Header', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_header_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-head',
			)
		);

		$this->add_control(
			'pricing_item_header_separator_width',
			array(
				'label'      => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '1',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-head' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_header_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-head' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_header_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-head' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_header_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_title_heading',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-name',
			)
		);

		$this->add_control(
			'pricing_item_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_desc_heading',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_desc_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-desc',
			)
		);

		$this->add_control(
			'pricing_item_desc_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-desc' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_desc_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_price_heading',
			array(
				'label'     => __( 'Price', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_price_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-price',
			)
		);

		$this->add_control(
			'pricing_item_price_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_price_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_currency_color',
			array(
				'label'     => __( 'Currency Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-currency' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_currency_size',
			array(
				'label'      => __( 'Currency Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-currency' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_currency_offset',
			array(
				'label'      => __( 'Currency Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => - 20,
						'max'  => 20,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => - 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-currency' => 'transform: translateY({{SIZE}}{{UNIT}});',
				),
			)
		);

		$this->add_control(
			'pricing_item_original_price_color',
			array(
				'label'     => __( 'Original Price Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-discount' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_original_price_size',
			array(
				'label'      => __( 'Original Price Size', 'xpro-elementor-addons-pro' ),
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
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-discount' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_period_heading',
			array(
				'label'     => __( 'Period', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_period_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-duration',
			)
		);

		$this->add_control(
			'pricing_item_period_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-duration' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_period_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_list_heading',
			array(
				'label'     => __( 'Feature List', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_list_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-list > li',
			)
		);

		$this->add_responsive_control(
			'pricing_item_list_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li > .xpro-pricing-feature-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-matrix-item-list > li > .xpro-pricing-feature-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_list_icon_space',
			array(
				'label'      => __( 'Icon Space', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-matrix-item-list > li > .xpro-pricing-feature-icon' => 'margin:0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'pricing_item_list_tab' );

		$this->start_controls_tab(
			'pricing_item_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_list_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li.active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_list_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li.active > .xpro-pricing-feature-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_item_list_inactive',
			array(
				'label' => __( 'Inactive', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_list_inactive_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li.inactive' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_list_inactive_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li.inactive > .xpro-pricing-feature-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pricing_item_list_separator_width',
			array(
				'label'      => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '1',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_list_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-list > li' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_button_heading',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-button',
			)
		);

		$this->start_controls_tabs(
			'pricing_item_button_style_tabs'
		);

		$this->start_controls_tab(
			'pricing_item_button_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-button',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pricing_item_button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_item_button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-button:hover,{{WRAPPER}} .xpro-matrix-item-button:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-item-button:hover,{{WRAPPER}} .xpro-matrix-item-button:focus',
			)
		);

		$this->add_control(
			'pricing_item_button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-item-button:hover,{{WRAPPER}} .xpro-matrix-item-button:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'pricing_item_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_button_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-item-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_badge_heading',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_item_badge_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-badge',
			)
		);

		$this->add_control(
			'pricing_item_badge_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_badge_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-badge' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-matrix-style-6 .xpro-matrix-badge:before' => 'border-top-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pricing_item_badge_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-badge',
			)
		);

		$this->add_responsive_control(
			'pricing_item_badge_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_badge_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Pricing
		$this->start_controls_section(
			'section_featured_style',
			array(
				'label' => __( 'Featured Item', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_featured_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-matrix .featured',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pricing_item_featured_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix .featured',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pricing_item_featured_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix .featured',
			)
		);

		$this->add_responsive_control(
			'pricing_item_featured_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix .featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_header_heading',
			array(
				'label'     => __( 'Header', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_featured_header_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .featured .xpro-matrix-item-head',
			)
		);

		$this->add_control(
			'pricing_item_featured_header_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-head' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_featured_header_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_title_heading',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'pricing_item_featured_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_desc_heading',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'pricing_item_featured_desc_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-desc' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_price_heading',
			array(
				'label'     => __( 'Price', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'pricing_item_featured_price_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_currency_color',
			array(
				'label'     => __( 'Currency Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-currency' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_original_price_color',
			array(
				'label'     => __( 'Original Price Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-discount' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_period_heading',
			array(
				'label'     => __( 'Period', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'pricing_item_featured_period_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-duration' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_list_heading',
			array(
				'label'     => __( 'Feature List', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'pricing_item_featured_list_tab' );

		$this->start_controls_tab(
			'pricing_item_featured_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_featured_list_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-list > li.active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_list_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-list > li.active > .xpro-pricing-feature-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_item_featured_list_inactive',
			array(
				'label' => __( 'Inactive', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_featured_list_inactive_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-list > li.inactive' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_list_inactive_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-list > li.inactive > .xpro-pricing-feature-icon > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pricing_item_featured_list_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-list > li' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_button_heading',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'pricing_item_featured_button_style_tabs'
		);

		$this->start_controls_tab(
			'pricing_item_featured_button_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_featured_button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_featured_button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .featured .xpro-matrix-item-button',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pricing_item_featured_button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .featured .xpro-matrix-item-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_item_featured_button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pricing_item_featured_button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-button:hover,{{WRAPPER}} .featured .xpro-matrix-item-button:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pricing_item_featured_button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .featured .xpro-matrix-item-button:hover,{{WRAPPER}} .featured .xpro-matrix-item-button:focus',
			)
		);

		$this->add_control(
			'pricing_item_featured_button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-item-button:hover,{{WRAPPER}} .featured .xpro-matrix-item-button:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pricing_item_featured_badge_heading',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'pricing_item_featured_badge_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pricing_item_featured_badge_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured .xpro-matrix-badge'                             => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-matrix-style-6 .featured .xpro-matrix-badge:before' => 'border-top-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pricing_item_featured_badge_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .featured .xpro-matrix-badge',
			)
		);

		$this->add_responsive_control(
			'pricing_item_featured_badge_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .featured .xpro-matrix-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_item_featured_badge_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .featured .xpro-matrix-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Packages
		$this->start_controls_section(
			'section_packages_style',
			array(
				'label' => __( 'Packages', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'package_width',
			array(
				'label'           => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%' ),
				'default_desktop' => array(
					'size' => '350',
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => '50',
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => '50',
					'unit' => '%',
				),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'render_type'     => 'template',
				'selectors'       => array(
					'{{WRAPPER}} .xpro-matrix-comparison' => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-matrix-slider-wrapper' => 'max-width: calc(100% - {{SIZE}}{{UNIT}});',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'package_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-comparison',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'package_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-comparison',
			)
		);

		$this->add_responsive_control(
			'package_space_bottom',
			array(
				'label'      => __( 'Space Bottom', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-comparison' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'pricing_matrix_style' => array( '4', '5', '6' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'package_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-comparison',
			)
		);

		$this->add_responsive_control(
			'package_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-comparison' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'package_title_heading',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'package_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-head',
			)
		);

		$this->add_control(
			'package_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-head' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'package_title_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-head',
			)
		);

		$this->add_control(
			'package_title_separator_width',
			array(
				'label'      => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '1',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-head' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'package_title_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-head' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'package_title_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'package_list_heading',
			array(
				'label'     => __( 'Package List', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'package_list_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-package-list > li',
			)
		);

		$this->add_control(
			'package_list_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-package-list > li' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'package_list_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-package-list > li',
			)
		);

		$this->add_control(
			'package_list_separator_width',
			array(
				'label'      => __( 'Separator Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '1',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-package-list > li' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'package_list_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-package-list > li' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'package_list_tooltip',
			array(
				'label'     => __( 'Tooltip', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'package_list_tooltip_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-tooltip-toggle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'package_list_tooltip_bg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-tooltip-toggle' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'package_list_tooltip_typography',
				'label'    => __( 'Content Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-tooltip',
			)
		);

		$this->add_responsive_control(
			'package_list_tooltip_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
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
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'package_list_tooltip_content_color',
			array(
				'label'     => __( 'Content Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-tooltip' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'package_list_tooltip_content_bg',
			array(
				'label'     => __( 'Content Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-tooltip' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .xpro-matrix-tooltip::after' => 'border-color: transparent {{VALUE}} transparent transparent;',
				),
			)
		);

		$this->add_responsive_control(
			'package_list_icon_tooltip_padding',
			array(
				'label'      => __( 'Content Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Tabs
		$this->start_controls_section(
			'section_dots_style',
			array(
				'label' => __( 'Tabs', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'dots_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-dots > .owl-dot',
			)
		);

		$this->add_control(
			'dots_space_between',
			array(
				'label'       => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Tabs item margin left/right.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'default'     => array(
					'size' => 10,
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot' => 'margin: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-matrix-dots' => 'margin: 0 -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'dots_style_tabs'
		);

		$this->start_controls_tab(
			'dots_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'dots_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'dots_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-dots > .owl-dot',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dots_active_tab_style',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'dots_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot.active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_abg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot.active'        => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot.active:before' => 'border-top-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-dots > .owl-dot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-owl-theme .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Nav
		$this->start_controls_section(
			'section_nav_style',
			array(
				'label' => __( 'Nav', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'nav_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
					'style-4' => __( 'Style 4', 'xpro-elementor-addons-pro' ),
					'style-5' => __( 'Style 5', 'xpro-elementor-addons-pro' ),
					'style-6' => __( 'Style 6', 'xpro-elementor-addons-pro' ),
					'style-7' => __( 'Style 7', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_responsive_control(
			'nav_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_position',
			array(
				'label'          => __( 'Position', 'xpro-elementor-addons-pro' ),
				'description'    => __( 'Next/Prev buttons horziontal position.', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'desktop'        => array(
					'size' => -25,
				),
				'tablet_default' => array(
					'size' => 0,
				),
				'mobile_default' => array(
					'size' => 0,
				),
				'range'          => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'nav_style_tabs'
		);

		$this->start_controls_tab(
			'nav_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nav_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'nav_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-matrix-slider-wrapper.owl-carousel .owl-nav > button.owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'pricing-matrix/layout/frontend.php';

	}

}
