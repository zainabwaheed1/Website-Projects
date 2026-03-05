<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Elementor_Image_Selector;
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
class Video extends Widget_Base {

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
		return 'xpro-video';
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
		return __( 'Video', 'xpro-elementor-addons-pro' );
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
		return 'xi-video xpro-widget-pro-label';
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
		return array( 'video', 'masking', 'sticky' );
	}

	/**
	 * Retrieve the list of style the widget depended on.
	 *
	 * Used to set style dependencies required to run the widget.
	 *
	 * @return array Widget style dependencies.
	 *
	 *
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */

	public function get_style_depends() {

		return array( 'plyr' );

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

		return array( 'plyr' );

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
			'section_general_video_and_masking',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' )
			)
		);

		$this->add_control(
			'video_type',
			array(
				'label'   => esc_html__( 'Video Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'video',
				'options' => array(
					'video'   => esc_html__( 'URL', 'xpro-elementor-addons-pro' ),
					'youtube' => esc_html__( 'Youtube', 'xpro-elementor-addons-pro' ),
					'vimeo'   => esc_html__( 'Vimeo', 'xpro-elementor-addons-pro' ),
					'hosted'  => esc_html__( 'Self Hosted', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'video_link',
			array(
				'label'       => __( 'Video Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '//clips.vorwaerts-gmbh.de/big_buck_bunny.mp4',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'video_type' => 'video',
				),
			)
		);

		$this->add_control(
			'hosted_url',
			array(
				'label'      => esc_html__( 'Choose File', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => array(
					'active'     => true,
					'categories' => array(
						TagsModule::MEDIA_CATEGORY,
					),
				),
				'media_type' => 'video',
				'condition'  => array(
					'video_type' => 'hosted',
				),
			)
		);

		$this->add_control(
			'vimeo_link',
			array(
				'label'       => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'placeholder' => __( 'Enter your URL (Vimeo)', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'default'     => 'https://player.vimeo.com/video/666201451?h=13ef062ca3',
				'condition'   => array(
					'video_type' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'youtube_link',
			array(
				'label'       => __( 'Youtube Link', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=-TPpwuB6dnI&t=11s',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'video_type' => 'youtube',
				),
			)
		);

		$this->add_control(
			'video_mask_image',
			array(
				'label'        => __( 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_control(
			'video_mask_shape',
			array(
				'label'   => __( 'Mask Type', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'default',
				'options' => array(
					'default' => array(
						'title' => _x( 'Default Shapes', 'Mask Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-image-bold',
					),
					'custom'  => array(
						'title' => _x( 'Custom Shape', 'Mask Image', 'xpro-elementor-addons-pro' ),
						'icon'  => 'eicon-upload',
					),
				),
				'toggle'  => false,
			)
		);

		$this->add_control(
			'video_mask_shape_default',
			array(
				'label'                => _x( 'Default', 'Mask Video', 'xpro-elementor-addons-pro' ),
				'label_block'          => true,
				'show_label'           => false,
				'type'                 => Xpro_Elementor_Image_Selector::TYPE,
				'default'              => 'shape1',
				'options'              => xpro_elementor_masking_shape_list( 'list' ),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
				),
				'selectors_dictionary' => xpro_elementor_masking_shape_list( 'url' ),
				'condition'            => array(
					'video_mask_image' => 'yes',
					'video_mask_shape' => 'default',
				),
			)
		);

		$this->add_control(
			'video_mask_custom_shape',
			array(
				'label'       => _x( 'Custom Shape', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::MEDIA,
				'show_label'  => false,
				'description' => sprintf(
					__( 'Note: Make sure svg support is enable to upload svg file. %1$sRead More%2$s', 'xpro-elementor-addons-pro' ),
					'<a href="https://elementor.com/help/enable-svg-support-in-elementor/" target="_blank">',
					'</a>'
				),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
				),
				'condition'   => array(
					'video_mask_image' => 'yes',
					'video_mask_shape' => 'custom',
				),
			)
		);

		$this->add_control(
			'video_mask_position',
			array(
				'label'                => _x( 'Position', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'center-center',
				'options'              => array(
					'center-center' => _x( 'Center Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'center-left'   => _x( 'Center Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'center-right'  => _x( 'Center Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-center'    => _x( 'Top Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-left'      => _x( 'Top Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'top-right'     => _x( 'Top Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-center' => _x( 'Bottom Center', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-left'   => _x( 'Bottom Left', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'bottom-right'  => _x( 'Bottom Right', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'center-center' => 'center center',
					'center-left'   => 'center left',
					'center-right'  => 'center right',
					'top-center'    => 'top center',
					'top-left'      => 'top left',
					'top-right'     => 'top right',
					'bottom-center' => 'bottom center',
					'bottom-left'   => 'bottom left',
					'bottom-right'  => 'bottom right',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'video_mask_size',
			array(
				'label'     => _x( 'Size', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'contain',
				'options'   => array(
					'auto'    => _x( 'Auto', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'cover'   => _x( 'Cover', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'contain' => _x( 'Contain', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'initial' => _x( 'Custom', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'video_mask_custom_size',
			array(
				'label'      => _x( 'Custom Size', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'em' => array(
						'min' => 0,
						'max' => 100,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 100,
					'unit' => '%',
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'video_mask_size' => 'initial',
				),
			)
		);

		$this->add_control(
			'video_mask_repeat',
			array(
				'label'                => _x( 'Repeat', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'no-repeat',
				'options'              => array(
					'repeat'          => _x( 'Repeat', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'repeat-x'        => _x( 'Repeat-x', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'repeat-y'        => _x( 'Repeat-y', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'space'           => _x( 'Space', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'round'           => _x( 'Round', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'no-repeat'       => _x( 'No-repeat', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'repeat-space'    => _x( 'Repeat Space', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'round-space'     => _x( 'Round Space', 'Mask Image', 'xpro-elementor-addons-pro' ),
					'no-repeat-round' => _x( 'No-repeat Round', 'Mask Image', 'xpro-elementor-addons-pro' ),
				),
				'selectors_dictionary' => array(
					'repeat'          => 'repeat',
					'repeat-x'        => 'repeat-x',
					'repeat-y'        => 'repeat-y',
					'space'           => 'space',
					'round'           => 'round',
					'no-repeat'       => 'no-repeat',
					'repeat-space'    => 'repeat space',
					'round-space'     => 'round space',
					'no-repeat-round' => 'no-repeat round',
				),
				'selectors'            => array(
					'{{WRAPPER}} .xpro-image' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
				),
			)
		);

		$this->end_popover();

		$this->add_control(
			'sticky_video_options',
			array(
				'label'     => esc_html__( 'Video Options', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => esc_html__( 'Autoplay', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'          => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'muted',
			array(
				'label'              => esc_html__( 'Muted', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'          => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'              => esc_html__( 'Loop', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'          => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => array(
					'video_type!' => 'youtube',
				),
			)
		);

		$this->add_control(
			'controls',
			array(
				'label'              => esc_html__( 'Control Bar', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'          => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_sticky_video',
			array(
				'label' => __( 'Sticky', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_sticky',
			array(
				'label'              => esc_html__( 'Sticky', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'          => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'sticky_position',
			array(
				'label'     => esc_html__( 'Sticky Position', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-right',
				'options'   => array(
					'top-left'     => esc_html__( 'Top Left', 'xpro-elementor-addons-pro' ),
					'top-right'    => esc_html__( 'Top Right', 'xpro-elementor-addons-pro' ),
					'bottom-left'  => esc_html__( 'Bottom Left', 'xpro-elementor-addons-pro' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'xpro-elementor-addons-pro' ),
				),
				'condition' => array(
					'show_sticky' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'sticky_video_scroll_height',
			array(
				'label'              => esc_html__( 'Offset', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'frontend_available' => true,
				'condition'          => array(
					'show_sticky' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_image_overlay',
			array(
				'label' => __( 'Overlay', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'show_image_overlay',
			array(
				'label'        => esc_html__( 'Image Overlay', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'custom_image_overlay',
			array(
				'label'     => __( 'Image', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'show_image_overlay!' => '',
				),
				'dynamic'   => array(
					'active' => true
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'custom_media_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'show_image_overlay!' => '',
				),
			)
		);

		$this->add_control(
			'custom_overlay_icon',
			array(
				'label'       => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
				'show_label'  => true,
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-play',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'show_image_overlay!' => '',
				),
			)
		);

		$this->end_controls_section();

		//Styling

		$this->start_controls_section(
			'section_general_video',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'video_player_width',
			array(
				'label'      => esc_html__( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-video-inner' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'video_player_height',
			array(
				'label'      => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-video-inner' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style_sticky_video',
			array(
				'label'     => __( 'Sticky', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_sticky' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'sticky_video_width',
			array(
				'label'      => esc_html__( 'Width', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-video-box.sticky' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'sticky_video_height',
			array(
				'label'      => esc_html__( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-video-box.sticky' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'sticky_cross_btn_options',
			array(
				'label'     => esc_html__( 'Cross Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'sticky_cross_btn_position',
			array(
				'label'   => esc_html__( 'Icon Position', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => esc_html__( 'Top Left', 'xpro-elementor-addons-pro' ),
					'right' => esc_html__( 'Top Right', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_control(
			'cross_btn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sticky-cross-btn > i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'cross_btn_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sticky-cross-btn' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style_sticky_overlay_btn',
			array(
				'label'     => __( 'Overlay Icon', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_image_overlay!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'sticky_overlay_btn_size',
			array(
				'label'      => esc_html__( 'Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
					'{{WRAPPER}} .xpro-sticky-video-overlay-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'sticky_overlay_btn_bg_size',
			array(
				'label'      => esc_html__( 'Background Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 60,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'video_overlay_btn_style' );

		$this->start_controls_tab(
			'video_overlay_btn_normal',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'overlay_btn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-sticky-video-overlay-media > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'overlay_btn_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'video_overlay_btn_hover',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'overlay_btn_hv_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media:hover > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-sticky-video-overlay-media:hover > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'overlay_btn_hv_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'overlay_btn_hv_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'overlay_btn_border',
				'label'    => esc_html__( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-sticky-video-overlay-media',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'overlay_btn_box_shadow',
				'selector' => '{{WRAPPER}} .xpro-sticky-video-overlay-media',
			)
		);

		$this->add_responsive_control(
			'overlay_btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-sticky-video-overlay-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'video/layout/frontend.php';

	}

}
