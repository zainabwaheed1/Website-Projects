<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
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
 * Elementor widget for Simple Gallery.
 *
 * @since 0.1.8
 */
class Advance_Gallery extends Widget_Base {

	/**
	 * Default filter is the global filter
	 * and can be overriden from settings
	 *
	 * @var string
	 */
	protected $_default_filter = '*'; //phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_name() {
		return 'xpro-advance-gallery';
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
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Advanced Gallery', 'xpro-elementor-addons-pro' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'xi-advance-gallery xpro-widget-pro-label';
	}

	/**
	 * Retrieve the widget keywords.
	 *
	 * @return string[] Widget keywords.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_keywords() {
		return array( 'gallery', 'image', 'lightbox' );
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 0.1.8
	 *
	 * @access public
	 *
	 */
	public function get_categories() {
		return array( 'xpro-widgets-pro' );
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

		return array( 'cubeportfolio', 'lightgallery' );

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
		return array( 'cubeportfolio', 'lightgallery' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 0.1.8
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_advance_gallery',
			array(
				'label' => __( 'Gallery', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'gallery_type',
			array(
				'label'              => __( 'Gallery Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'album',
				'options'            => array(
					'simple' => __( 'Simple', 'xpro-elementor-addons-pro' ),
					'album'  => __( 'Album', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'gallery_style',
			array(
				'label'              => __( 'Gallery Layout', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'grid',
				'options'            => array(
					'grid'    => __( 'Grid', 'xpro-elementor-addons-pro' ),
					'masonry' => __( 'Masonry', 'xpro-elementor-addons-pro' ),
					'mosaic'  => __( 'Mosaic', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'sort_by_dimension',
			array(
				'label'              => __( 'Sort By Dimension', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'gallery_style' => 'mosaic',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'filter',
			array(
				'label'       => __( 'Filter Name', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Type gallery filter name', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Filter name must be uinque, Otherwise items show in same filter.', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'Name', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'is_default_filter',
			array(
				'label'        => __( 'Is Default Filter?', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => __( 'Set this as default active filter.', 'xpro-elementor-addons-pro' ),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Featured Image', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'images',
			array(
				'label'   => __( 'Gallery Images', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::GALLERY,
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'gallery',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf( __( 'Filter Group: %1$s', 'xpro-elementor-addons-pro' ), '{{filter}}' ),
				'render_type' => 'template',
				'default'     => array(
					array(
						'filter' => __( 'Filter 1', 'xpro-elementor-addons-pro' ),
					),
					array(
						'filter' => __( 'Filter 1', 'xpro-elementor-addons-pro' ),
					),
					array(
						'filter' => __( 'Filter 2', 'xpro-elementor-addons-pro' ),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'before',
			)
		);

		$this->end_controls_section();

		//Advance Tab
		$this->start_controls_section(
			'section_advance',
			array(
				'label' => __( 'Advanced', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'item_per_row',
			array(
				'label'              => __( 'Items Per Row', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust items to show in a row.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 3,
				'desktop_default'    => 3,
				'tablet_default'     => 2,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label'              => __( 'Height', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Adjust the height of gallery items.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 300,
				),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'          => array(
					'gallery_style' => 'grid',
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-elementor-gallery-layout-grid .xpro-elementor-gallery-item' => 'height: {{SIZE}}{{UNIT}}',
				),
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
						'max' => 500,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'        => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show item icon.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'caption',
			array(
				'label'        => __( 'Caption', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show image caption.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'        => __( 'Description', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To show image description.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		//Filter Tab
		$this->start_controls_section(
			'section_filter',
			array(
				'label' => __( 'Filter', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filter',
			array(
				'label'        => __( 'Show Filter Menu', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'Enable to display filter menu.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'filter_all',
			array(
				'label'        => __( 'Show "All" Filter', 'xpro-elementor-addons-pro' ),
				'description'  => __( 'To Enable to display "All" filter in filter menu.', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'show_filter' => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_all_text',
			array(
				'label'       => __( 'All Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'To Change "All" text in filter menu.', 'xpro-elementor-addons-pro' ),
				'default'     => __( 'All', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_filter' => 'yes',
					'filter_all'  => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_animation',
			array(
				'label'              => __( 'Filter Animation', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Define animation that show during filter.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '3dflip',
				'options'            => array(
					'3dflip'       => __( '3D Flip', 'xpro-elementor-addons-pro' ),
					'quicksand'    => __( 'Quick Sand', 'xpro-elementor-addons-pro' ),
					'fadeOut'      => __( 'Fade Out', 'xpro-elementor-addons-pro' ),
					'flipOut'      => __( 'Flip Out', 'xpro-elementor-addons-pro' ),
					'flipOutDelay' => __( 'Flip Out Delay', 'xpro-elementor-addons-pro' ),
					'flipBottom'   => __( 'Flip Bottom', 'xpro-elementor-addons-pro' ),
					'fadeOutTop'   => __( 'Fade Out Top', 'xpro-elementor-addons-pro' ),
					'bounceLeft'   => __( 'Bounce Left', 'xpro-elementor-addons-pro' ),
					'bounceTop'    => __( 'Bounce Top', 'xpro-elementor-addons-pro' ),
					'bounceBottom' => __( 'Bounce Bottom', 'xpro-elementor-addons-pro' ),
					'moveLeft'     => __( 'Move Left', 'xpro-elementor-addons-pro' ),
					'slideLeft'    => __( 'Slide Left', 'xpro-elementor-addons-pro' ),
					'slideDelay'   => __( 'Slide Delay', 'xpro-elementor-addons-pro' ),
					'rotateSides'  => __( 'Rotate Slide', 'xpro-elementor-addons-pro' ),
					'sequentially' => __( 'Sequentially', 'xpro-elementor-addons-pro' ),
					'skew'         => __( 'Skew', 'xpro-elementor-addons-pro' ),
					'foldLeft'     => __( 'Fold Left', 'xpro-elementor-addons-pro' ),
					'unfold'       => __( 'Unfold', 'xpro-elementor-addons-pro' ),
					'scaleDown'    => __( 'Scale Down', 'xpro-elementor-addons-pro' ),
					'scaleSides'   => __( 'Scale Sides', 'xpro-elementor-addons-pro' ),
					'frontRow'     => __( 'Front Row', 'xpro-elementor-addons-pro' ),
					'rotateRoom'   => __( 'Rotate Room', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'show_filter' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_dropdown',
			array(
				'label'       => __( 'Show Dropdown On', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Select when you want to show dropdown.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'mobile',
				'options'     => array(
					'tablet' => __( 'Tablet & Mobile', 'xpro-elementor-addons-pro' ),
					'mobile' => __( 'Mobile', 'xpro-elementor-addons-pro' ),
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'condition'   => array(
					'show_filter' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Load More
		$this->start_controls_section(
			'section_loadmore',
			array(
				'label' => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'load_more',
			array(
				'label'              => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'click'  => __( 'Click', 'xpro-elementor-addons-pro' ),
					'auto'   => __( 'Scroll', 'xpro-elementor-addons-pro' ),
					'custom' => __( 'Custom', 'xpro-elementor-addons-pro' ),
					'none'   => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'item_per_page',
			array(
				'label'       => __( 'Items Per Page', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Set items that show initially.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 6,
				'min'         => 1,
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'item_on_load',
			array(
				'label'       => __( 'Items On Load', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Set items that show on load.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 3,
				'min'         => 1,
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'load_more_text',
			array(
				'label'       => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'load_more!' => 'none',
				),
			)
		);

		$this->add_control(
			'load_more_count',
			array(
				'label'        => __( 'Button Count', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'load_more_loading_text',
			array(
				'label'       => __( 'On Loading', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Loading...', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Loading...', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'load_more_no_left',
			array(
				'label'       => __( 'No More', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'No More Works', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'No More Works.', 'xpro-elementor-addons-pro' ),
				'condition'   => array(
					'load_more!' => array( 'none', 'custom' ),
				),
			)
		);

		$this->add_control(
			'custom_link',
			array(
				'label'         => __( 'Link', 'xpro-elementor-addons-pro' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'xpro-elementor-addons-pro' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'load_more' => 'custom',
				),
			)
		);

		$this->end_controls_section();

		//Popup Tab
		$this->start_controls_section(
			'section_popup',
			array(
				'label' => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'popup',
			array(
				'label'              => __( 'Popup', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1'    => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'2'    => __( 'Minimal', 'xpro-elementor-addons-pro' ),
					'3'    => __( 'Creative', 'xpro-elementor-addons-pro' ),
					'4'    => __( 'Innovative', 'xpro-elementor-addons-pro' ),
					'none' => __( 'None', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'thumbnail',
			array(
				'label'              => __( 'Thumbnail', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Enable thumbnails for the gallery.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!' => 'none',
				),
			)
		);

		$this->add_control(
			'thumbnail_by_default',
			array(
				'label'              => __( 'Thumb By Default', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'Show/Hide thumbnails by default.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!'    => array( 'none', '2', '4' ),
					'thumbnail' => 'yes',
				),
			)
		);

		$this->add_control(
			'share',
			array(
				'label'              => __( 'Social Share', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To show share buttons on popup.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!' => 'none',
				),
			)
		);

		$this->add_control(
			'download',
			array(
				'label'              => __( 'Download', 'xpro-elementor-addons-pro' ),
				'description'        => __( 'To show download button on popup.', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'popup!' => 'none',
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_overlay_style',
			array(
				'label' => __( 'Overlay', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'hover_effect',
			array(
				'label'              => __( 'Hover Effect', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'zoom-box',
				'options'            => array(
					'zoom'               => __( 'Zoom', 'xpro-elementor-addons-pro' ),
					'fadeIn'             => __( 'Fade In', 'xpro-elementor-addons-pro' ),
					'classic'            => __( 'Classic', 'xpro-elementor-addons-pro' ),
					'zoom-top-bottom'    => __( 'Zoom Top Bottom', 'xpro-elementor-addons-pro' ),
					'zoom-center-bottom' => __( 'Zoom Center Bottom', 'xpro-elementor-addons-pro' ),
					'zoom-box'           => __( 'Zoom Box', 'xpro-elementor-addons-pro' ),
					'zoom-box-out'       => __( 'Zoom Box Out', 'xpro-elementor-addons-pro' ),
					'moveRight'          => __( 'Move Right', 'xpro-elementor-addons-pro' ),
					'revealLeft'         => __( 'Move Left', 'xpro-elementor-addons-pro' ),
					'rotate'             => __( 'Rotate', 'xpro-elementor-addons-pro' ),
					'pushTop'            => __( 'Push Top', 'xpro-elementor-addons-pro' ),
					'pushDown'           => __( 'Push Down', 'xpro-elementor-addons-pro' ),
					'revealTop'          => __( 'Reveal Top', 'xpro-elementor-addons-pro' ),
					'revealBottom'       => __( 'Reveal Bottom', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hover_color',
				'label'    => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .cbp-caption-active .cbp-caption-activeWrap',
			)
		);

		$this->add_control(
			'outline_color',
			array(
				'label'     => __( 'Outline Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cbp-caption-zoom-box .cbp-caption-activeWrap:before,{{WRAPPER}} .cbp-caption-zoom-box .cbp-caption-activeWrap:after,{{WRAPPER}} .cbp-caption-zoom-box-out .cbp-caption-activeWrap:before,{{WRAPPER}} .cbp-caption-zoom-box-out .cbp-caption-activeWrap:after' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'hover_effect' => array( 'zoom-box', 'zoom-box-out' ),
				),
			)
		);

		$this->add_responsive_control(
			'overlay_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .cbp-caption-active .cbp-caption-activeWrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_name',
			array(
				'label'   => __( 'Icon', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-expand-arrows-alt',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon'       => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_bg_size',
			array(
				'label'      => __( 'Backgound Size', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'icon_hcolor',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hbg',
			array(
				'label'     => __( 'Icon Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hborder',
			array(
				'label'     => __( 'Icon Border', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-overlay-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption_style',
			array(
				'label'     => __( 'Caption', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'caption' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_color',
			array(
				'label'     => __( 'Caption Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'caption_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-title',
			)
		);

		// start caption_alignment
		$this->add_responsive_control(
			'caption_alignment',
			array(
				'label' => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'xpro-elementor-addons-pro' ),
						'icon' => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'xpro-elementor-addons-pro' ),
						'icon' => 'fa fa-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'xpro-elementor-addons-pro' ),
						'icon' => 'fa fa-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-title' => 'text-align: {{VALUE}};',
				),
			)
		);		

		$this->add_responsive_control(
			'caption_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label'     => __( 'Description', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'description' => 'yes',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-desc' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-desc',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_style',
			array(
				'label'     => __( 'Filter', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_filter' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filter_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item, {{WRAPPER}} .xpro-elementor-gallery-filter .xpro-select-option',
			)
		);

		$this->add_responsive_control(
			'filter_align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs(
			'filter_style_tabs'
		);

		$this->start_controls_tab(
			'filter_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'filter_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_bg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'filter_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'filter_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'filter_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_hbg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'filter_active_tab_style',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'filter_acolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item.cbp-filter-item-active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_abg',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item.cbp-filter-item-active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_aborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item.cbp-filter-item-active' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'filter_item_space',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'filter_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'filter_item_padding',
			array(
				'label'      => __( 'Item Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter > ul > li.cbp-filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .xpro-elementor-gallery-filter .xpro-select-option' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'filter_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_dropdown',
			array(
				'label'     => __( 'Dropdown', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_dropdown!' => 'none',
					'show_filter'    => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_dropdown_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet){{WRAPPER}} .xpro-filter-dropdown-tablet .xpro-select-option, {{WRAPPER}} .xpro-filter-dropdown-tablet .cbp-l-filters-button .cbp-filter-item' => 'color: {{VALUE}} !important;',
					'(mobile){{WRAPPER}} .xpro-filter-dropdown-mobile .xpro-select-option, {{WRAPPER}} .xpro-filter-dropdown-mobile .cbp-l-filters-button .cbp-filter-item' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'filter_dropdown_bgcolor',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet){{WRAPPER}} .xpro-filter-dropdown-tablet .xpro-select-option, {{WRAPPER}} .xpro-filter-dropdown-tablet .cbp-l-filters-button .cbp-filter-item' => 'background-color: {{VALUE}} !important;',
					'(mobile){{WRAPPER}} .xpro-filter-dropdown-mobile .xpro-select-option, {{WRAPPER}} .xpro-filter-dropdown-mobile .cbp-l-filters-button .cbp-filter-item' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'filter_dropdown_separator_color',
			array(
				'label'     => __( 'Separator Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'(tablet){{WRAPPER}} .xpro-filter-dropdown-tablet .cbp-l-filters-button, {{WRAPPER}} .xpro-filter-dropdown-tablet .cbp-l-filters-button .cbp-filter-item' => 'border-color: {{VALUE}} !important;',
					'(mobile){{WRAPPER}} .xpro-filter-dropdown-mobile .cbp-l-filters-button, {{WRAPPER}} .xpro-filter-dropdown-mobile .cbp-l-filters-button .cbp-filter-item' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_loadmore_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'load_more!' => 'none',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'loadmore_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a',
			)
		);

		$this->add_responsive_control(
			'loadmore_align',
			array(
				'label'     => __( 'Alignment', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore, {{WRAPPER}} .xpro-gallery-elementor-custom-link' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs(
			'loadmore_style_tabs'
		);

		$this->start_controls_tab(
			'loadmore_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'loadmore_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loadmore_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'loadmore_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'loadmore_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'loadmore_hcolor',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a:hover, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loadmore_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-gallery-elementor-loadmore > a:hover, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a:hover',
			)
		);

		$this->add_control(
			'loadmore_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a:hover, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'loadmore_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'loadmore_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore > a, {{WRAPPER}} .xpro-gallery-elementor-custom-link > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'loadmore_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-gallery-elementor-loadmore, {{WRAPPER}} .xpro-gallery-elementor-custom-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_misc',
			array(
				'label' => __( 'Misc', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'misc_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-gallery .xpro-elementor-gallery-item .cbp-caption',
			)
		);

		$this->add_control(
			'mask_image',
			array(
				'label'        => __( 'Mask', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'xpro-elementor-addons-pro' ),
				'label_on'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_control(
			'mask_shape',
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
			'mask_shape_default',
			array(
				'label'                => _x( 'Default', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'label_block'          => true,
				'show_label'           => false,
				'type'                 => Xpro_Elementor_Image_Selector::TYPE,
				'default'              => 'shape1',
				'options'              => xpro_elementor_masking_shape_list( 'list' ),
				'selectors'            => array(
					'{{WRAPPER}} .cbp-caption' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
				),
				'selectors_dictionary' => xpro_elementor_masking_shape_list( 'url' ),
				'condition'            => array(
					'mask_image' => 'yes',
					'mask_shape' => 'default',
				),
			)
		);

		$this->add_control(
			'mask_custom_shape',
			array(
				'label'       => _x( 'Custom Shape', 'Mask Image', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::MEDIA,
				'show_label'  => false,
				'description' => sprintf(
				/* translators: %s: Title */
					__( 'Note: Make sure svg support is enable to upload svg file. %1$sRead More%2$s', 'xpro-elementor-addons-pro' ),
					'<a href="https://elementor.com/help/enable-svg-support-in-elementor/" target="_blank">',
					'</a>'
				),
				'selectors'   => array(
					'{{WRAPPER}} .cbp-caption' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
				),
				'condition'   => array(
					'mask_image' => 'yes',
					'mask_shape' => 'custom',
				),
			)
		);

		$this->add_control(
			'mask_position',
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
					'{{WRAPPER}} .cbp-caption' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'mask_size',
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
					'{{WRAPPER}} .cbp-caption' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'mask_custom_size',
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
					'{{WRAPPER}} .cbp-caption' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mask_size' => 'initial',
				),
			)
		);

		$this->add_control(
			'mask_repeat',
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
					'{{WRAPPER}} .cbp-caption' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
				),
			)
		);

		$this->end_popover();

		$this->add_control(
			'misc_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-gallery .xpro-elementor-gallery-item .cbp-caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.1.8
	 *
	 * @access protected
	 */
	protected function render() {

		$settings       = $this->get_settings_for_display();
		$album_gallery  = $this->get_settings_for_display( 'gallery' );
		$simple_gallery = $this->get_gallery_data();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advance-gallery/layout/frontend.php';

	}

	protected function get_gallery_data() {

		$gallery = $this->get_settings_for_display( 'gallery' );

		if ( ! is_array( $gallery ) || empty( $gallery ) ) {
			return array();
		}

		$menu  = array();
		$items = array();

		foreach ( $gallery as $key => $item ) {

			$feature = $item['image'];
			$images  = $item['images'];

			$filter = xpro_elementor_friendly_str_replace( $item['filter'] );

			if ( ! empty( $item['is_default_filter'] ) ) {
				$this->_default_filter = '.' . $filter;
			}

			if ( $filter && ! isset( $data[ $filter ] ) ) {
				$menu[ $filter ] = $item['filter'];
			}

			if ( ! empty( $item['image']['url'] ) ) {
				if ( ! isset( $items[ attachment_url_to_postid( $item['image']['url'] ) ] ) ) {
					$items[ attachment_url_to_postid( $item['image']['url'] ) ] = $filter;
				} else {
					$items[ attachment_url_to_postid( $item['image']['url'] ) ] .= ' ' . $filter;
				}
			}

			if ( isset( $images ) ) {
				foreach ( $images as $image ) {
					if ( ! empty( $image['url'] ) && ! empty( attachment_url_to_postid( $image['url'] ) ) && ! isset( $items[ attachment_url_to_postid( $image['url'] ) ] ) ) {
						$items[ attachment_url_to_postid( $image['url'] ) ] = $filter;
					} elseif ( ! empty( $image['id'] ) && ! empty( attachment_url_to_postid( wp_get_attachment_url( $image['id'] ) ) ) && ! isset( $items[ attachment_url_to_postid( wp_get_attachment_url( $image['id'] ) ) ] ) ) {
						$items[ attachment_url_to_postid( wp_get_attachment_url( $image['id'] ) ) ] = $filter;
					} elseif ( ! empty( $image['id'] ) && ! isset( $items[ $image['id'] ] ) ) {
						$items[ $image['id'] ] = $filter;
					} else {
						if ( ! empty( $image['url'] ) ) {
							$items[ attachment_url_to_postid( $image['url'] ) ] .= ' ' . $filter;
						} else {
							$items[ $image['id'] ] .= ' ' . $filter;
						}
					}
				}
			}

		}

		return compact( 'menu', 'items' );
	}

}
