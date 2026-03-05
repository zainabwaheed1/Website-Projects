<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Group_Control_Foreground;
use XproElementorAddons\Control\Xpro_Elementor_Widget_Area;
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
class Woo_User_Profile extends Widget_Base {

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
		return 'xpro-woo-user-profile';
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
		return __( 'Woo User Profile', 'xpro-elementor-addons-pro' );
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
		return 'xi-account xpro-widget-pro-label';
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
		return array(
			'off-canvas',
			'user profile',
			'login',
			'sign up',
			'registration',
			'my account',
			'off canvas',
			'menu',
			'woo'
		);
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

		$my_acc_tab_link_1 = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );

		if ( function_exists( 'wc_get_endpoint_url' ) ) {
			$my_acc_tab_link_2 = wc_get_endpoint_url( 'orders', '', get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );

			$my_acc_tab_link_3 = wc_get_endpoint_url( 'edit-account', '', get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );

			$my_acc_tab_link_4 = wc_get_endpoint_url( 'edit-address', '', get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );
		}

		$this->start_controls_section(
			'section_general',
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

		//cart style
		$this->add_control(
			'up_style',
			array(
				'label'              => __( 'Style', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'light',
				'options'            => array(
					'light' => __( 'Light', 'xpro-elementor-addons-pro' ),
					'dark'  => __( 'Dark', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		//cart_type
		$this->add_control(
			'up_layout',
			array(
				'label'              => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'dropdown',
				'options'            => array(
					'dropdown'   => __( 'Dropdown', 'xpro-elementor-addons-pro' ),
					'modal'      => __( 'Modal', 'xpro-elementor-addons-pro' ),
					'off_canvas' => __( 'Off Canvas', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'              => __( 'Off-Canvas Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'slideRight',
				'options'            => array(
					'slideRight'     => __( 'Slide Right', 'xpro-elementor-addons-pro' ),
					'slideLeft'      => __( 'Slide Left', 'xpro-elementor-addons-pro' ),
					'pushRight'      => __( 'Push Right', 'xpro-elementor-addons-pro' ),
					'pushLeft'       => __( 'Push Left', 'xpro-elementor-addons-pro' ),
					'fullFadeIn'     => __( 'Fullscreen FadeIn', 'xpro-elementor-addons-pro' ),
					'fullFromTop'    => __( 'From Top', 'xpro-elementor-addons-pro' ),
					'fullFromBottom' => __( 'From Bottom', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'up_layout' => array( 'off_canvas' ),
				),
				'frontend_available' => true,
			)
		);

		//show cart on
		$this->add_control(
			'show_up_on',
			array(
				'label'              => __( 'Show User Profile On', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'click',
				'options'            => array(
					'click' => __( 'Click', 'xpro-elementor-addons-pro' ),
					'hover' => __( 'Hover', 'xpro-elementor-addons-pro' ),
				),
				'condition'          => array(
					'up_layout' => array( 'dropdown' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'preview_endpoint',
			array(
				'label'              => __( 'Preview Endpoint', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'login',
				'options'            => array(
					'login'  => __( 'Login', 'xpro-elementor-addons-pro' ),
					'signup' => __( 'Sign Up', 'xpro-elementor-addons-pro' ),
					'dash'   => __( 'Dashboard', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		//disable default woo check
		$this->add_control(
			'disable_default_woo_check',
			array(
				'label'              => __( 'Disable Auto Generate Password', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Enable/Disable default Woocommerce check to automatically generate username/password by sending email', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'toggle_heading',
			array(
				'label'     => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		//select text type
		$this->add_control(
			'select_txt_type',
			array(
				'label'              => __( 'Text Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'text',
				'options'            => array(
					'none' => __( 'None', 'xpro-elementor-addons-pro' ),
					'text' => __( 'Custom Text', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
			)
		);

		//text
		$this->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => __( 'My Account', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'My Account Text Here', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'select_txt_type' => array( 'text' ),
				),
			)
		);

		$this->add_responsive_control(
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
				'prefix_class' => 'xpro-mini-cart%s-align-',
				'default'      => '',
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-user',
					'library' => 'solid',
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'     => __( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'xpro-elementor-addons-pro' ),
					'right' => __( 'After', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'   => array(
					'size' => 10,
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-align-icon-right .xpro-elementor-hamburger-toggle-media' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-align-icon-left .xpro-elementor-hamburger-toggle-media'  => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'xpro_elementor_hamburger_content',
			array(
				'label'       => esc_html__( 'Content', 'xpro-elementor-addons-pro' ),
				'type'        => Xpro_Elementor_Widget_Area::TYPE,
				'label_block' => true,
			)
		);

		$this->add_control(
			'close_heading',
			array(
				'label'     => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'close_icon',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-times',
					'library' => 'solid',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_list_style',
			array(
				'label' => __( 'List', 'xpro-elementor-addons-pro' ),
			)
		);

		//list
		$repeater = new Repeater();

		$repeater->add_control(
			'media_type',
			array(
				'label'       => __( 'List Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'   => array(
						'title' => __( 'None', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-ban',
					),
					'icon'   => array(
						'title' => __( 'Icon', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-star-o',
					),
					'image'  => array(
						'title' => __( 'Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					),
					'custom' => array(
						'title' => __( 'Custom', 'xpro-elementor-addons-pro' ),
						'icon'  => ' eicon-font',
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
					'value'   => 'fas fa-fingerprint',
					'library' => 'solid',
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
					'active' => true
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'thumbnail',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'custom',
			array(
				'label'       => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '01', 'xpro-elementor-addons-pro' ),
				'label_block' => false,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'media_icon_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
					'custom'  => __( 'Custom', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'media_type' => array( 'icon', 'custom' ),
				),
			)
		);

		$repeater->start_controls_tabs(
			'media_tabs',
			array(
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->start_controls_tab(
			'media_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'media_color',
			array(
				'label'     => __( 'Content Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-up-list-media-type-icon,{{WRAPPER}} {{CURRENT_ITEM}} .xpro-up-list-media-type-custom' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-up-list-media-type-icon > svg'                                                        => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_bgcolor',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-up-list-media' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_boder_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .xpro-up-list-media' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'media_hover_tab',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'media_hcolor',
			array(
				'label'     => __( 'Content Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}.xpro-up-list-item:hover .xpro-up-list-media-type-icon,{{WRAPPER}} {{CURRENT_ITEM}}.xpro-up-list-item:hover .xpro-up-list-media-type-custom' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}}.xpro-up-list-item:hover .xpro-up-list-media-type-icon > svg'                                                                                => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_hbgcolor',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}.xpro-up-list-item:hover .xpro-up-list-media' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->add_control(
			'media_boder_hcolor',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}.xpro-up-list-item:hover .xpro-up-list-media' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'media_type'       => array( 'icon', 'custom' ),
					'media_icon_color' => array( 'custom' ),
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'List Title Here', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your description here', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'item',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
					/* translators: 1$s: Title */
					__( 'Item: %1$s', 'xpro-elementor-addons-pro' ), '{{title}}' ),
				'default'     => array(
					array(
						'icon'  => array(
							'value'   => 'fas fa-cog',
							'library' => 'fa-solid',
						),
						'title' => __( 'My Dashboard', 'xpro-elementor-addons-pro' ),
						'link'  => array(
							'url'         => $my_acc_tab_link_1,
							'is_external' => true,
							'nofollow'    => true,
						),
					),
					array(
						'icon'  => array(
							'value'   => 'fas fa-shopping-cart',
							'library' => 'fa-solid',
						),
						'title' => __( 'My Orders', 'xpro-elementor-addons-pro' ),
						'link'  => array(
							'url'         => $my_acc_tab_link_2,
							'is_external' => true,
							'nofollow'    => true,
						),
					),
					array(
						'icon'  => array(
							'value'   => 'fas fa-user',
							'library' => 'fa-solid',
						),
						'title' => __( 'Account Details', 'xpro-elementor-addons-pro' ),
						'link'  => array(
							'url'         => $my_acc_tab_link_3,
							'is_external' => true,
							'nofollow'    => true,
						),
					),
					array(
						'icon'  => array(
							'value'   => 'fas fa-location-arrow',
							'library' => 'fa-solid',
						),
						'title' => __( 'Addresses', 'xpro-elementor-addons-pro' ),
						'link'  => array(
							'url'         => $my_acc_tab_link_4,
							'is_external' => true,
							'nofollow'    => true,
						),
					),
				),
			)
		);

		//display logout
		$this->add_control(
			'display_logout',
			array(
				'label'              => __( 'Display Logout Button', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'logout_icon',
			array(
				'label'     => __( 'Logout Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-sign-out-alt',
					'library' => 'solid',
				),
				'condition' => array(
					'display_logout' => array( 'yes' ),
				),
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
			'width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'max_width',
			array(
				'label'      => __( 'Max Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-inner',
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-overlay' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-inner',
			)
		);

		$this->add_responsive_control(
			'wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'up_layout' => array( 'dropdown', 'modal' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_list_acc_style',
			array(
				'label' => __( 'Form', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		//tabs
		//login/signup
		$this->add_control(
			'tabs_heading',
			array(
				'label'     => __( 'Tabs Heading ', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tabs_head_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-up-wrapper ul#xpro-up-tabs-nav li a',
			)
		);

		$this->add_control(
			'tabs_head_ac_color',
			array(
				'label'     => __( 'Active Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-up-wrapper ul#xpro-up-tabs-nav li.active a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'tabs_head_nm_color',
			array(
				'label'     => __( 'Normal Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-up-wrapper #xpro-up-tabs-nav li a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'tabs_head_b_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-border-wrapper .xpro-up-border-inner' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'tabs_head_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-tabs-cls' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tabs_head_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-tabs-cls' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//labels

		$this->add_control(
			'my_acc_label',
			array(
				'label'     => __( 'Labels', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form label',
			)
		);

		$this->add_control(
			'tabs_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form label' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'tabs_label_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//remember me/privacy , link
		$this->add_control(
			'form_txt',
			array(
				'label'     => __( 'Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_txt_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .woocommerce-privacy-policy-text, {{WRAPPER}} .xpro-woo-info',
			)
		);

		$this->add_control(
			'form_txt_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-privacy-policy-text, {{WRAPPER}} .xpro-woo-info' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_link_typography',
				'label'    => __( 'Link Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form a',
			)
		);

		//link color
		$this->add_control(
			'form_link_color',
			array(
				'label'     => __( 'Link Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form a' => 'color: {{VALUE}}',
				),
			)
		);

		//link hover color
		$this->add_control(
			'form_link_hv_color',
			array(
				'label'     => __( 'Link Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields_style',
			array(
				'label' => __( 'Form Fields', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'field_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input',
			)
		);

		$this->start_controls_tabs( 'tabs_field_state' );

		$this->start_controls_tab(
			'tab_field_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'field_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_focus',
			array(
				'label' => __( 'Focus', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'field_focus_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'field_border',
				'selector'  => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'field_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input',
			)
		);

		$this->add_responsive_control(
			'field_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'field_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-form-row input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//btns
		// -------------------------------------------------

		$this->start_controls_section(
			'section_form_button_style',
			array(
				'label' => __( 'Form Buttons', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button',
			)
		);

		$this->add_responsive_control(
			'form_button_width',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
				),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_form_button_style' );

		$this->start_controls_tab(
			'tab_form_button_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'form_button_bg_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button',
			)
		);

		$this->add_control(
			'form_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'form_button_border_normal',
				'label'       => __( 'Border', 'xpro-elementor-addons-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'form_button_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button',
			)
		);

		$this->add_control(
			'form_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'form_button_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//margin
		$this->add_responsive_control(
			'form_button_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_button_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'form_button_bg_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button:hover',
			)
		);

		$this->add_control(
			'form_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'form_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'form_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .xpro-up-content-wrapper .woocommerce-button:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// -------------------------------------------------

		//top menu
		$this->start_controls_section(
			'section_list_menu_style',
			array(
				'label' => __( 'List Menu', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		//img
		$this->add_control(
			'list_menu_img',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		//img width
		$this->add_responsive_control(
			'list_media_image_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-avatar-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'list_image_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-woo-avatar-img',
			)
		);

		$this->add_responsive_control(
			'list_image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-woo-avatar-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// --
		$this->add_control(
			'list_menu_username',
			array(
				'label'     => __( 'Username', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'list_menu_title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-username',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'list_menu_title_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-up-username',
			)
		);

		$this->add_responsive_control(
			'list_menu_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-username' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//---
		//---
		$this->add_control(
			'list_menu_email',
			array(
				'label'     => __( 'Email', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'list_menu_email_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-email',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'list_menu_email_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-up-email',
			)
		);

		$this->add_responsive_control(
			'list_menu_email_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-email' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		//---

		$this->end_controls_section();

		$this->start_controls_section(
			'section_infolist_media_style',
			array(
				'label' => __( 'List Media', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'media_tabs' );

		$this->start_controls_tab(
			'media_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'media_item_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon,{{WRAPPER}} .xpro-up-list-media-type-custom' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-up-list-media-type-icon > svg'                                       => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'media_item_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-media',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'media_hover_tab',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'media_item_hcolor',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-list-item:hover .xpro-up-list-media-type-icon,{{WRAPPER}} .xpro-up-list-item:hover .xpro-up-list-media-type-custom' => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-up-list-item:hover .xpro-up-list-media-type-icon > svg'                                                                => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'media_item_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-item:hover .xpro-up-list-media',
			)
		);

		$this->add_control(
			'media_item_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-list-item:hover .xpro-up-list-media ' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'media_item_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'media_item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-media',
			)
		);

		$this->add_responsive_control(
			'media_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-up-list-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_icon_heading',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_icon_size',
			array(
				'label'      => __( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon'       => 'font-size: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-up-list-media-type-icon > svg' => 'width: {{SIZE}}{{UNIT}}; height:auto;',
				),
				'default'    => array(
					'size' => 12,
				),
			)
		);

		//lol
		$this->add_responsive_control(
			'media_icon_bgsize',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 25,
				),
			)
		);

		$this->add_control(
			'media_icon_separator',
			array(
				'label'        => __( 'Separator', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'block',
				'selectors'    => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon::before' => 'display:{{VALUE}};',
				),
				'condition'    => array(
					'layout' => array( 'vertical' ),
				),
			)
		);

		$this->add_control(
			'media_icon_separator_style',
			array(
				'label'     => __( 'Separator Style', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'  => __( 'Solid', 'xpro-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'xpro-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon::before' => 'border-left-style: {{VALUE}};',
				),
				'condition' => array(
					'layout'               => array( 'vertical' ),
					'media_icon_separator' => array( 'block' ),
				),
			)
		);

		$this->add_responsive_control(
			'media_icon_separator_width',
			array(
				'label'      => __( 'Separator Width', 'xpro-elementor-addons-pro' ),
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
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon::before' => 'border-left-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout'               => array( 'vertical' ),
					'media_icon_separator' => array( 'block' ),
				),
			)
		);

		$this->add_responsive_control(
			'media_icon_separator_height',
			array(
				'label'      => __( 'Separator Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon::before' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout'               => array( 'vertical' ),
					'media_icon_separator' => array( 'block' ),
				),
			)
		);

		$this->add_control(
			'media_icon_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-list-media-type-icon::before' => 'border-left-color: {{VALUE}}',
				),
				'condition' => array(
					'layout'               => array( 'vertical' ),
					'media_icon_separator' => array( 'block' ),
				),
			)
		);

		$this->add_control(
			'media_image_heading',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_image_size',
			array(
				'label'      => __( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-image img' => 'width: {{SIZE}}{{UNIT}};',
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
				'selectors'      => array(
					'{{WRAPPER}} .xpro-up-list-media-type-image img' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-up-list-media-type-image img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'media_custom_heading',
			array(
				'label'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'media_custom_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-media-type-custom',
			)
		);

		$this->add_responsive_control(
			'media_custom_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-custom' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_custom_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-media-type-custom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_infolist_title_style',
			array(
				'label' => __( 'List Title', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-title',
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'     => 'title_gradient',
				'label'    => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_infolist_desc_style',
			array(
				'label' => __( 'List Description', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-up-list-desc',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-up-list-desc' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'desc_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-up-list-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_toggle',
			array(
				'label' => __( 'Toggle Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'toggle_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-toggle',
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle-media > svg' => 'width: {{SIZE}}{{UNIT}}; height:auto',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle-media'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'toggle_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle svg' => 'fill: {{VALUE}};',
				),
			)
		);

		//icon color
		$this->add_control(
			'toggle_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-up-user-icon'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-up-user-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-toggle,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill:before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide::before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'toggle_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle:hover, {{WRAPPER}} .xpro-elementor-hamburger-toggle:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle:hover svg, {{WRAPPER}} .xpro-elementor-hamburger-toggle:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		//toggle hover icon color
		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Icon Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-up-user-icon:hover'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle .xpro-up-user-icon svg:hover' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-button-animation-none:hover,{{WRAPPER}} .xpro-button-2d-animation:hover,
								{{WRAPPER}} .xpro-elementor-button-animation-none:focus,{{WRAPPER}} .xpro-button-2d-animation:focus,
								{{WRAPPER}} .xpro-button-bg-animation::before,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromDown::after,{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::before,
								{{WRAPPER}} .xpro-elementor-button-hover-style-bubbleFromCenter::after,{{WRAPPER}} .xpro-elementor-button-hover-style-flipSlide,
								{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:hover,{{WRAPPER}} .xpro-elementor-button-hover-style-skewFill',
			)
		);

		$this->add_control(
			'toggle_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'toggle_border!'          => '',
					'hover_unique_animation!' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle:hover, {{WRAPPER}} .xpro-elementor-hamburger-toggle:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_hover_underline',
			array(
				'label'     => __( 'Line Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'hover_animation'        => 'unique',
					'hover_unique_animation' => array(
						'underlineFromLeft',
						'underlineFromRight',
						'underlineFromCenter',
						'underlineReveal',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} [class*=xpro-elementor-button-hover-style-underline]:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hover_animation',
			array(
				'label'   => __( 'Hover Animation', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'                  => __( 'None', 'xpro-elementor-addons-pro' ),
					'2d-transition'         => __( '2D', 'xpro-elementor-addons-pro' ),
					'background-transition' => __( 'Background', 'xpro-elementor-addons-pro' ),
					'unique'                => __( 'Unique', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'hover_2d_css_animation',
			array(
				'label'     => __( 'Animation Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-grow',
				'options'   => array(
					'hvr-grow'                   => __( 'Grow', 'xpro-elementor-addons-pro' ),
					'hvr-shrink'                 => __( 'Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-pulse'                  => __( 'Pulse', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-grow'             => __( 'Pulse Grow', 'xpro-elementor-addons-pro' ),
					'hvr-pulse-shrink'           => __( 'Pulse Shrink', 'xpro-elementor-addons-pro' ),
					'hvr-push'                   => __( 'Push', 'xpro-elementor-addons-pro' ),
					'hvr-pop'                    => __( 'Pop', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-in'              => __( 'Bounce In', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-out'             => __( 'Bounce Out', 'xpro-elementor-addons-pro' ),
					'hvr-rotate'                 => __( 'Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-grow-rotate'            => __( 'Grow Rotate', 'xpro-elementor-addons-pro' ),
					'hvr-float'                  => __( 'Float', 'xpro-elementor-addons-pro' ),
					'hvr-sink'                   => __( 'Sink', 'xpro-elementor-addons-pro' ),
					'hvr-bob'                    => __( 'Bob', 'xpro-elementor-addons-pro' ),
					'hvr-hang'                   => __( 'Hang', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-vertical'        => __( 'Wobble Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-horizontal'      => __( 'Wobble Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-bottom-right' => __( 'Wobble To Bottom Right', 'xpro-elementor-addons-pro' ),
					'hvr-wobble-to-top-right'    => __( 'Wobble To Top Right', 'xpro-elementor-addons-pro' ),
					'hvr-buzz'                   => __( 'Buzz', 'xpro-elementor-addons-pro' ),
					'hvr-buzz-out'               => __( 'Buzz Out', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'hover_animation' => '2d-transition',
				),
			)
		);

		$this->add_control(
			'hover_background_css_animation',
			array(
				'label'     => __( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hvr-sweep-to-right',
				'options'   => array(
					'hvr-sweep-to-right'         => __( 'Sweep To Right', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-left'          => __( 'Sweep To Left', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-bottom'        => __( 'Sweep To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-sweep-to-top'           => __( 'Sweep To Top', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-right'        => __( 'Bounce To Right', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-left'         => __( 'Bounce To Left', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-bottom'       => __( 'Bounce To Bottom', 'xpro-elementor-addons-pro' ),
					'hvr-bounce-to-top'          => __( 'Bounce To Top', 'xpro-elementor-addons-pro' ),
					'hvr-radial-out'             => __( 'Radial Out', 'xpro-elementor-addons-pro' ),
					'hvr-radial-in'              => __( 'Radial In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-in'           => __( 'Rectangle In', 'xpro-elementor-addons-pro' ),
					'hvr-rectangle-out'          => __( 'Rectangle Out', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-horizontal'  => __( 'Shutter In Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-horizontal' => __( 'Shutter Out Horizontal', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-in-vertical'    => __( 'Shutter In Vertical', 'xpro-elementor-addons-pro' ),
					'hvr-shutter-out-vertical'   => __( 'Shutter Out Vertical', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'hover_animation' => 'background-transition',
				),
			)
		);

		$this->add_control(
			'hover_unique_animation',
			array(
				'label'     => __( 'Animation', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'skewFill',
				'options'   => array(
					'underlineFromLeft'   => __( 'Underline From Left', 'xpro-elementor-addons-pro' ),
					'underlineFromRight'  => __( 'Underline From Right', 'xpro-elementor-addons-pro' ),
					'underlineFromCenter' => __( 'Underline From Center', 'xpro-elementor-addons-pro' ),
					'skewFill'            => __( 'Skew Fill', 'xpro-elementor-addons-pro' ),
					'flipSlide'           => __( 'Flip Slide', 'xpro-elementor-addons-pro' ),
					'bubbleFromDown'      => __( 'Bubble From Down', 'xpro-elementor-addons-pro' ),
					'bubbleFromCenter'    => __( 'Bubble From Center', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'hover_animation' => 'unique',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'toggle_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-hamburger-toggle',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'toggle_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-toggle',
			)
		);

		$this->add_responsive_control(
			'toggle_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// ----

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_close',
			array(
				'label' => __( 'Close Button', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'close_icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_bg_size',
			array(
				'label'      => __( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_close_style' );

		$this->start_controls_tab(
			'close_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'close_text_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'close_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'close_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'close_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover svg, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'close_background_hover',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus',
			)
		);

		$this->add_control(
			'close_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn:hover, {{WRAPPER}} .xpro-elementor-hamburger-close-btn:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'close_border',
				'selector'  => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'close_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-elementor-hamburger-close-btn',
			)
		);

		$this->add_responsive_control(
			'close_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-hamburger-close-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'woo-user-profile/layout/frontend.php';
	}
}
