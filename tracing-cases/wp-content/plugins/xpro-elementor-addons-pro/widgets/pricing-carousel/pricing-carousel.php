<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
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
class Pricing_Carousel extends Widget_Base {

	public static function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'baht'         => '&#3647;',
			'bdt'          => '&#2547;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'guilder'      => '&fnof;',
			'indian_rupee' => '&#8377;',
			'pound'        => '&#163;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'rupee'        => '&#8360;',
			'real'         => 'R$',
			'krona'        => 'kr',
			'won'          => '&#8361;',
			'yen'          => '&#165;',
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
		return 'xpro-pricing-carousel';
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
		return __( 'Pricing Carousel', 'xpro-elementor-addons-pro' );
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
		return 'xi-pricing-carouel xpro-widget-pro-label';
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
		return array( 'pricing', 'price', 'carousel' );
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
			'section_pricing',
			array(
				'label' => __( 'Pricing', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater = new Repeater();

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
			'media_type',
			array(
				'label'       => __( 'Media Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
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

		$repeater->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-clone',
					'library' => 'regular',
				),
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
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

		$repeater->add_group_control(
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

		$repeater->add_control(
			'list_title',
			array(
				'label'       => '',
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Features', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
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
				'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'xpro-elementor-addons-pro' ),
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
				'default'     => __( 'Get Started', 'xpro-elementor-addons-pro' ),
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
							'value'   => 'far fa-clone',
							'library' => 'regular',
						),
						'title'       => __( 'Basic', 'xpro-elementor-addons-pro' ),
						'price'       => __( '9.99', 'xpro-elementor-addons-pro' ),
						'list_item_1' => 'yes',
						'list_item_2' => 'yes',
						'list_item_3' => 'yes',
						'list_item_4' => 'yes',
					),
					array(
						'icon'        => array(
							'value'   => 'far fa-paper-plane',
							'library' => 'regular',
						),
						'title'       => __( 'Standard', 'xpro-elementor-addons-pro' ),
						'price'       => __( '59', 'xpro-elementor-addons-pro' ),
						'badge_text'  => __( 'Premium', 'xpro-elementor-addons-pro' ),
						'featured'    => 'yes',
						'list_item_1' => 'yes',
						'list_item_2' => 'yes',
						'list_item_3' => 'yes',
						'list_item_4' => 'yes',
					),
					array(
						'icon'        => array(
							'value'   => 'far fa-sticky-note',
							'library' => 'regular',
						),
						'title'       => __( 'Enterprise', 'xpro-elementor-addons-pro' ),
						'price'       => __( '99', 'xpro-elementor-addons-pro' ),
						'list_item_1' => 'yes',
						'list_item_2' => 'yes',
						'list_item_3' => 'yes',
						'list_item_4' => 'yes',
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
			'margin',
			array(
				'label'              => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the space between items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 15,
				),
				'tablet_default'     => array(
					'size' => 15,
				),
				'mobile_default'     => array(
					'size' => 15,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
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
			'lazyload',
			array(
				'label'              => __( 'Lazy Load', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Lazy load images for fast load.', 'xpro-elementor-addons-pro' ),
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
			'nav',
			array(
				'label'              => __( 'Show Nav', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show next/prev buttons.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'              => __( 'Show Dots', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show dots navigation.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-title,{{WRAPPER}} .xpro-pricing-icon,{{WRAPPER}} .xpro-pricing-price-tag,{{WRAPPER}} .xpro-pricing-price-period,{{WRAPPER}} .xpro-pricing-description,{{WRAPPER}} .xpro-pricing-features-title,{{WRAPPER}} .xpro-pricing-features-list li' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
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
				'prefix_class' => 'xpro-pricing-align-',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-pricing-item' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item',
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_header',
			array(
				'label' => __( 'Header', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'header_title',
			array(
				'label' => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'header_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-title',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'header_title_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-title',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'header_title_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-title',
			)
		);

		$this->add_control(
			'header_title_display',
			array(
				'label'     => __( 'Display', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'block',
				'options'   => array(
					'block'        => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-menu-bar',
					),
					'inline-block' => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-title' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_title_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_media',
			array(
				'label'     => __( 'Media', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'media_position',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_header',
				'options' => array(
					'after_header'  => __( 'After Title', 'xpro-elementor-addons-pro' ),
					'before_header' => __( 'Before Title', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'header_media_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-icon > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-pricing-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'header_media_size',
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
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-icon > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-pricing-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-pricing-media img'  => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'          => __( 'Image Height', 'xpro-elementor-addons-pro' ),
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
				'selectors'      => array(
					'{{WRAPPER}} .xpro-pricing-media img' => 'height: {{SIZE}}{{UNIT}};',
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
					'image_height[size]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-media img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_media_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-icon, {{WRAPPER}} .xpro-pricing-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			array(
				'label' => __( 'Price', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'price_position',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_features',
				'options' => array(
					'before_features' => __( 'Before Features', 'xpro-elementor-addons-pro' ),
					'after_features'  => __( 'After Features', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'price_style',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => '2',
				'options' => array(
					'1' => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-menu-bar',
					),
					'2' => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-price-tag' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-price-tag',
			)
		);

		$this->add_responsive_control(
			'price_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-price-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_currency_title',
			array(
				'label'     => __( 'Currency', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_currency_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-currency' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_currency_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-currency',
			)
		);

		$this->add_responsive_control(
			'price_currency_vertical_offset',
			array(
				'label'      => __( 'Vertical Offset', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => - 50,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-currency' => 'transform: translateY({{SIZE}}{{UNIT}});',
				),
			)
		);

		$this->add_responsive_control(
			'price_currency_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_period_title',
			array(
				'label'     => __( 'Period', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_period_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-price-period' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_period_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-price-period',
			)
		);

		$this->add_responsive_control(
			'price_period_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-price-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_features',
			array(
				'label' => __( 'Feature List', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'features_margin',
			array(
				'label'      => __( 'Wrapper Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_title_heading',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'features_title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-features-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-features-title',
			)
		);

		$this->add_responsive_control(
			'features_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-features-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_heading',
			array(
				'label'     => __( 'List', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'features_icon_size',
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
					'{{WRAPPER}} .xpro-pricing-feature-icon' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'features_icon_space',
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
					'{{WRAPPER}} .xpro-pricing-feature-icon'                          => 'margin:0 {{SIZE}}{{UNIT}} 0 0;',
					'{{WRAPPER}}.xpro-pricing-align-right .xpro-pricing-feature-icon' => 'margin:0 0 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_align',
			array(
				'label'     => __( 'Content Align', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-features-list li' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_list_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-features-list li',
			)
		);

		$this->add_responsive_control(
			'features_list_space_between',
			array(
				'label'      => __( 'Space between', 'xpro-elementor-addons-pro' ),
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
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-features-list li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'features_list_tab' );

		$this->start_controls_tab(
			'features_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'features_list_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-features-list li.active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-features-list li.active .xpro-pricing-feature-icon' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'features_list_inactive',
			array(
				'label' => __( 'Inactive', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'features_list_inactive_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-features-list li.inactive' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_inactive_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-features-list li.inactive .xpro-pricing-feature-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'features_list_tooltip',
			array(
				'label'     => __( 'Tooltip', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'features_list_tooltip_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip-toggle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_bg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip-toggle' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_tooltip_typography',
				'label'    => __( 'Content Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip',
			)
		);

		$this->add_responsive_control(
			'features_list_tooltip_width',
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
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_content_color',
			array(
				'label'     => __( 'Content Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_content_bg',
			array(
				'label'     => __( 'Content Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip'        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip::after' => 'border-color: transparent {{VALUE}} transparent transparent;',
				),
			)
		);

		$this->add_responsive_control(
			'features_list_icon_tooltip_padding',
			array(
				'label'      => __( 'Content Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-pricing-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => __( 'Description', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'description_position',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_features',
				'options' => array(
					'before_features' => __( 'Before Features', 'xpro-elementor-addons-pro' ),
					'after_features'  => __( 'After Features', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'features_description_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-description',
			)
		);

		$this->add_responsive_control(
			'description_width',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
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
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-description' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-description-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_separator_style',
			array(
				'label' => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'show_separator',
			array(
				'label'        => __( 'Show', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-separator:before' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_style',
			array(
				'label'     => __( 'Style', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'double' => __( 'Double', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
					'groove' => __( 'Groove', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-separator:before' => 'border-top-style: {{VALUE}};',
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_width',
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
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-separator:before' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
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
					'{{WRAPPER}} .xpro-pricing-separator:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_separator' => 'yes',
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
					'{{WRAPPER}} .xpro-pricing-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_separator' => 'yes',
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

		$this->add_control(
			'button_position',
			array(
				'label'   => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after_features',
				'options' => array(
					'before_features' => __( 'Before Features', 'xpro-elementor-addons-pro' ),
					'after_features'  => __( 'After Features', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'button_display',
			array(
				'label'     => __( 'Display', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'inline-block',
				'options'   => array(
					'block'        => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-menu-bar',
					),
					'inline-block' => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-btn' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-btn',
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
			'button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-btn',
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
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-btn:hover,{{WRAPPER}} .xpro-pricing-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-btn:hover,{{WRAPPER}} .xpro-pricing-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-btn:hover,{{WRAPPER}} .xpro-pricing-btn:focus' => 'border-color: {{VALUE}}',
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
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge_style',
			array(
				'label' => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'badge_display',
			array(
				'label'     => __( 'Display', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'auto',
				'options'   => array(
					'100%' => array(
						'title' => __( 'Block', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-menu-bar',
					),
					'auto' => array(
						'title' => __( 'Inline', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge'            => 'width: {{VALUE}}; top:0; left: 0',
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge-top-left'   => 'left:0; right:auto;',
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge-top-center' => 'left:50%; right:auto;',
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge-top-right'  => 'right:0; left:auto;',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'badge_position',
			array(
				'label'     => __( 'Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'top-left'   => __( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-center' => __( 'Top Center', 'xpro-elementor-addons-pro' ),
					'top-right'  => __( 'Top Right', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'top-right',
				'condition' => array(
					'badge_display' => 'auto',
				),
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
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => '--xpro-badge-translate-x: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => '--xpro-badge-translate-y: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => '--xpro-badge-rotate: {{SIZE}}deg;',
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
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => 'transform-origin: {{VALUE}};',
				),
				'condition'   => array(
					'badge_transform_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_control(
			'badge_overflow',
			array(
				'label'     => __( 'Overflow', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => _x( 'Auto', 'Background Control', 'xpro-elementor-addons-pro' ),
					'hidden' => _x( 'Hidden', 'Background Control', 'xpro-elementor-addons-pro' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel .xpro-pricing-item' => 'overflow: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item .xpro-badge',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'badge_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item .xpro-badge',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'badge_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-item .xpro-badge',
			)
		);

		$this->add_responsive_control(
			'badge_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-item .xpro-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_featured_item_style',
			array(
				'label' => __( 'Featured Item', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'featured_item_title_color',
			array(
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'featured_item_box_shadow',
				'label'    => __( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel-featured',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'featured_item_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel-featured',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'featured_item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel-featured',
			)
		);

		$this->add_responsive_control(
			'featured_item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'featured_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'featured_price_heading',
			array(
				'label'     => __( 'Price', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'featured_price_color',
			array(
				'label'     => __( 'Price Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-price-tag' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'featured_currency_color',
			array(
				'label'     => __( 'Currency Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-currency' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'featured_period_color',
			array(
				'label'     => __( 'Period Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-price-period' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'featured_list_heading',
			array(
				'label'     => __( 'List', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'featured_list_title_color',
			array(
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-features-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->start_controls_tabs( 'featured_list_tab' );

		$this->start_controls_tab(
			'featured_list_active',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'featured_list_active_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-features-list li.active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'featured_list_active_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-features-list li.active .xpro-pricing-feature-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'featured_list_inactive',
			array(
				'label' => __( 'Inactive', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'featured_list_inactive_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-features-list li.inactive' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'featured_list_inactive_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-features-list li.inactive .xpro-pricing-feature-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'featured_description_heading',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'featured_description_color',
			array(
				'label'     => __( 'Description Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'featured_separator_heading',
			array(
				'label'     => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'featured_separator_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-separator:before' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'featured_button',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'featured_button_style_tabs'
		);

		$this->start_controls_tab(
			'featured_button_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'featured_button_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'featured_button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn',
			)
		);

		$this->add_control(
			'featured_button_border',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'featured_button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'featured_button_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn:hover,{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'featured_button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn:hover,{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn:focus',
			)
		);

		$this->add_control(
			'featured_button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn:hover,{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-pricing-btn:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'featured_badge',
			array(
				'label'     => __( 'Badge', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'featured_badge_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'featured_badge_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-badge',
			)
		);

		$this->add_control(
			'featured_badge_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel-featured .xpro-badge' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		//Nav
		$this->start_controls_section(
			'section_nav_style',
			array(
				'label'     => __( 'Nav', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'nav' => 'yes',
				),
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
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_horizontal_position',
			array(
				'label'       => __( 'Position', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Next/Prev buttons horziontal position.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'default'     => array(
					'size' => - 25,
				),
				'range'       => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nav_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next',
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
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hbg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev:hover,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'nav_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-prev,{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-nav > button.owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Dots
		$this->start_controls_section(
			'section_dots_style',
			array(
				'label'     => __( 'Dots', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dots' => 'yes',
				),
			)
		);

		$this->add_control(
			'dots_layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => __( 'Style 1', 'xpro-elementor-addons-pro' ),
					'style-2' => __( 'Style 2', 'xpro-elementor-addons-pro' ),
					'style-3' => __( 'Style 3', 'xpro-elementor-addons-pro' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_control(
			'dots_bg_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_bg_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-owl-dots-horizontal-style-2.owl-carousel .owl-dots > .owl-dot.active' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_control(
			'dots_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 3,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_spacing',
			array(
				'label'      => __( 'Spacing', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-carousel-gallery.owl-carousel .owl-dots' => 'bottom: -{{SIZE}}{{UNIT}};',
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
			'dots_bg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'dots_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot',
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
			'dots_abg',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_hborder',
			array(
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot.active' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'dots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-pricing-carousel.owl-carousel .owl-dots > button.owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'pricing-carousel/layout/frontend.php';

	}

}
