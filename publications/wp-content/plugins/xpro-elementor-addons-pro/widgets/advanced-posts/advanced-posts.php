<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;
use WP_Query;
use XproElementorAddons\Control\Xpro_Elementor_Group_Control_Foreground;

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
class Advanced_Posts extends Widget_Base {

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
		return 'xpro-advanced-posts';
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
		return __( 'Advanced Posts', 'xpro-elementor-addons-pro' );
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
		return 'xi-post-grid xpro-widget-pro-label';
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
		return array( 'portfolio', 'image', 'preview', 'popup' );
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

		return array( 'cubeportfolio' );

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
		return array( 'cubeportfolio' );
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

		$post_types                   = xpro_elementor_get_post_types();
		$post_types['by_id']          = __( 'Manual Selection', 'xpro-elementor-addons-pro' );
		$post_types['source_dynamic'] = __( 'Dynamic', 'xpro-elementor-addons-pro' );

		$taxonomies = get_taxonomies( array(), 'objects' );

		$this->start_controls_section(
			'section_advance_portfolio',
			array(
				'label' => __( 'Posts', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => __( 'Layout', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'  => __( 'Layout 1', 'xpro-elementor-addons-pro' ),
					'2'  => __( 'Layout 2', 'xpro-elementor-addons-pro' ),
					'3'  => __( 'Layout 3', 'xpro-elementor-addons-pro' ),
					'4'  => __( 'Layout 4', 'xpro-elementor-addons-pro' ),
					'5'  => __( 'Layout 5', 'xpro-elementor-addons-pro' ),
					'6'  => __( 'Layout 6', 'xpro-elementor-addons-pro' ),
					'7'  => __( 'Layout 7', 'xpro-elementor-addons-pro' ),
					'8'  => __( 'Layout 8', 'xpro-elementor-addons-pro' ),
					'9'  => __( 'Layout 9', 'xpro-elementor-addons-pro' ),
					'10' => __( 'Layout 10', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->add_responsive_control(
			'column_grid',
			array(
				'label'              => __( 'Columns', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'desktop_default'    => '3',
				'tablet_default'     => '2',
				'mobile_default'     => '1',
				'options'            => array(
					'1' => __( '1', 'xpro-elementor-addons-pro' ),
					'2' => __( '2', 'xpro-elementor-addons-pro' ),
					'3' => __( '3', 'xpro-elementor-addons-pro' ),
					'4' => __( '4', 'xpro-elementor-addons-pro' ),
					'5' => __( '5', 'xpro-elementor-addons-pro' ),
					'6' => __( '6', 'xpro-elementor-addons-pro' ),
				),
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'show_image',
			array(
				'label'        => __( 'Show Image', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'exclude'   => array( 'custom' ),
				'default'   => 'medium',
				'condition' => array(
					'show_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_content',
			array(
				'label'        => __( 'Show Excerpt', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'content_length',
			array(
				'label'     => __( 'Content Length', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 500,
				'step'      => 5,
				'default'   => 10,
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_readmore',
			array(
				'label'        => __( 'Show Button', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'readmore_text',
			array(
				'label'     => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Read More', 'xpro-elementor-addons-pro' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_readmore' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_author',
			array(
				'label'        => __( 'Show Author', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'author_title',
			array(
				'label'     => __( 'Author Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Posted By', 'xpro-elementor-addons-pro' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_author_avatar',
			array(
				'label'        => __( 'Show Avatar', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_meta',
			array(
				'label'     => __( 'Show Meta', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'separator' => 'before',
				'options'   => array(
					'date'     => __( 'Date', 'xpro-elementor-addons-pro' ),
					'category' => __( 'Category', 'xpro-elementor-addons-pro' ),
					'comments' => __( 'Comments', 'xpro-elementor-addons-pro' ),
				),
				'default'   => array( 'date' ),
			)
		);

		$this->add_control(
			'date_icon',
			array(
				'label'     => __( 'Date Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-calendar',
					'library' => 'regular',
				),
				'condition' => array(
					'show_meta' => 'date',
				),
			)
		);

		$this->add_control(
			'category_icon',
			array(
				'label'     => __( 'Category Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-folder',
					'library' => 'regular',
				),
				'condition' => array(
					'show_meta' => 'category',
				),
			)
		);

		$this->add_control(
			'comments_icon',
			array(
				'label'     => __( 'Comment Icon', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-comment-alt',
					'library' => 'regular',
				),
				'condition' => array(
					'show_meta' => 'comments',
				),
			)
		);

		$this->end_controls_section();

		//Query
		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'post_type',
			array(
				'label'   => __( 'Source', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $post_types,
				'default' => key( $post_types ),
			)
		);

		$this->add_control(
			'posts_ids',
			array(
				'label'       => __( 'Search & Select', 'xpro-elementor-addons-pro' ),
				'type'        => 'xpro-select',
				'options'     => xpro_elementor_get_query_post_list(),
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'post_type',
				'source_type' => 'any',
				'condition'   => array(
					'post_type' => 'by_id',
				),
			)
		);

		$this->add_control(
			'authors',
			array(
				'label'       => __( 'Author', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => array(),
				'options'     => xpro_elementor_get_authors_list(),
				'condition'   => array(
					'post_type!' => array( 'by_id', 'source_dynamic' ),
				),
			)
		);

		$this->add_control(
			'terms',
			array(
				'label'     => __( 'Term', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_taxonomies(),
				'default'   => '',
				'condition' => array(
					'post_type' => array( 'source_dynamic' ),
				),
			)
		);

		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) || ! in_array( $object->object_type[0], array_keys( $post_types ), true ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids',
				array(
					'label'       => $object->label,
					'type'        => 'xpro-select',
					'label_block' => true,
					'multiple'    => true,
					'source_name' => 'taxonomy',
					'source_type' => $taxonomy,
					'condition'   => array(
						'post_type' => $object->object_type,
					),
				)
			);
		}

		$this->add_control(
			'post__not_in',
			array(
				'label'       => __( 'Exclude', 'xpro-elementor-addons-pro' ),
				'type'        => 'xpro-select',
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'post_type',
				'source_type' => 'any',
				'condition'   => array(
					'post_type!' => array( 'by_id', 'source_dynamic' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => __( 'Per Page', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
				'condition' => array(
					'post_type!' => array( 'source_dynamic' ),
				),
			)
		);

		$this->add_control(
			'offset',
			array(
				'label'     => __( 'Offset', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => array(
					'orderby!'         => 'rand',
					'show_pagination!' => 'yes',
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => xpro_elementor_get_post_orderby_options(),
				'default' => 'date',

			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				),
				'default' => 'desc',

			)
		);

		$this->add_control(
			'post_only_image',
			array(
				'label'        => __( 'Post With Image', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$this->add_control(
				'_source_dynamic_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: %s: Title */
						__( 'This option will show %1$s dynamically according to loop.', 'xpro-elementor-addons-pro' ),
						'<strong>Posts</strong>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'condition'       => array(
						'post_type' => array( 'source_dynamic' ),
					),
				)
			);
		}

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
			'filter_source',
			array(
				'label'     => __( 'Source', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_filter_taxonomies(),
				'default'   => key( $this->get_filter_taxonomies() ),
				'condition' => array(
					'show_filter' => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_exclude',
			array(
				'label'       => __( 'Exclude', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => $this->filter_exclude(),
				'condition'   => array(
					'show_filter' => 'yes',
				),
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
				'label'              => __( 'Type', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'none'       => __( 'None', 'xpro-elementor-addons-pro' ),
					'click'      => __( 'Click', 'xpro-elementor-addons-pro' ),
					'auto'       => __( 'Scroll', 'xpro-elementor-addons-pro' ),
					'custom'     => __( 'Custom', 'xpro-elementor-addons-pro' ),
					'pagination' => __( 'Pagination', 'xpro-elementor-addons-pro' ),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'item_per_row',
			array(
				'label'       => __( 'Show Initially', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Set items that show initially.', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 6,
				'min'         => 1,
				'condition'   => array(
					'load_more' => array( 'click', 'auto' ),
				),
			)
		);

		$this->add_control(
			'load_more_text',
			array(
				'label'       => __( 'Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'load_more!' => array( 'none', 'pagination' ),
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
					'load_more!' => array( 'none', 'custom', 'pagination' ),
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
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'load_more!' => array( 'none', 'custom', 'pagination' ),
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
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'load_more!' => array( 'none', 'custom', 'pagination' ),
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

		$this->add_control(
			'prev_label',
			array(
				'label'     => __( 'Prev Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Prev', 'xpro-elementor-addons-pro' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'load_more' => 'pagination',
				),
			)
		);

		$this->add_control(
			'next_label',
			array(
				'label'     => __( 'Next Label', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Next', 'xpro-elementor-addons-pro' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'load_more' => 'pagination',
				),
			)
		);

		$this->add_control(
			'arrow',
			array(
				'label'     => __( 'Arrows Type', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'fas fa-arrow-left'          => __( 'Arrow', 'xpro-elementor-addons-pro' ),
					'fas fa-angle-left'          => __( 'Angle', 'xpro-elementor-addons-pro' ),
					'fas fa-angle-double-left'   => __( 'Double Angle', 'xpro-elementor-addons-pro' ),
					'fas fa-chevron-left'        => __( 'Chevron', 'xpro-elementor-addons-pro' ),
					'fas fa-chevron-circle-left' => __( 'Chevron Circle', 'xpro-elementor-addons-pro' ),
					'fas fa-caret-left'          => __( 'Caret', 'xpro-elementor-addons-pro' ),
					'xi xi-long-arrow-left'      => __( 'Long Arrow', 'xpro-elementor-addons-pro' ),
					'fas fa-arrow-circle-left'   => __( 'Arrow Circle', 'xpro-elementor-addons-pro' ),
				),
				'default'   => 'fas fa-arrow-left',
				'condition' => array(
					'load_more' => 'pagination',
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'alignment',
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
				'prefix_class' => 'xpro-post-grid-align%s-',
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label'              => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 400,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-item' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'layout' => array( '2', '6', '8', '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'              => __( 'Image Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
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
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-image' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'layout!'    => array( '2', '6' ),
					'show_image' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'              => __( 'Space Between', 'xpro-elementor-addons-pro' ),
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-wrapper .cbp-item-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-wrapper .cbp-item-wrapper',
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .cbp-item-wrapper' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-post-grid-wrapper .cbp-item-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'overlay_style_tabs',
			array(
				'condition' => array(
					'layout!' => array( '8', '10' ),
				),
			)
		);

		$this->start_controls_tab(
			'overlay_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-item .xpro-post-grid-image::after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'overlay_hover_tab_style',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'overlay_hover_color',
			array(
				'label'     => __( 'Overlay Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-item:hover .xpro-post-grid-image::after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_height',
			array(
				'label'              => __( 'Min Height', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
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
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .xpro-post-grid-content' => 'min-height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'layout!' => array( '6', '2', '8', '10' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .xpro-post-grid-content',
				'condition' => array(
					'layout!' => array( '6', '2' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'selector'  => '{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-content',
				'condition' => array(
					'layout!' => array( '6', '2' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '6', '2' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Hover Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-title:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_excerpt',
			array(
				'label'     => __( 'Content', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-excerpt' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-excerpt',
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'excerpt_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Meta
		$this->start_controls_section(
			'section_meta_style',
			array(
				'label' => __( 'Meta', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li',
			)
		);

		$this->add_responsive_control(
			'meta_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list' => 'grid-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'meta_icon_color',
			array(
				'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li,{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'meta_bg_color',
			array(
				'label'     => __( 'Background', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'meta_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li',
			)
		);

		$this->add_responsive_control(
			'meta_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-meta-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_meta_wrapper',
			array(
				'label'     => __( 'Wrapper', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => '7',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'meta_wrapper_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-post-grid-layout-7 .xpro-post-grid-meta-list',
				'condition' => array(
					'layout' => '7',
				),
			)
		);

		$this->add_responsive_control(
			'meta_wrapper_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-layout-7 .xpro-post-grid-meta-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '7',
				),
			)
		);

		$this->add_responsive_control(
			'meta_wrapper_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-layout-7 .xpro-post-grid-meta-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '7',
				),
			)
		);

		$this->add_responsive_control(
			'meta_wrapper_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-layout-7 .xpro-post-grid-meta-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '7',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => __( 'Button', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_readmore' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-btn',
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
					'{{WRAPPER}} .xpro-post-grid-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-btn',
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
					'{{WRAPPER}} .xpro-post-grid-btn:hover,{{WRAPPER}} .xpro-post-grid-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => __( 'Background', 'xpro-elementor-addons-pro' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-btn:hover,{{WRAPPER}} .xpro-post-grid-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-btn:hover,{{WRAPPER}} .xpro-post-grid-btn:focus' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .xpro-post-grid-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .xpro-post-grid-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Author
		$this->start_controls_section(
			'section_author_style',
			array(
				'label'     => __( 'Author', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'avatar_size',
			array(
				'label'       => __( 'Avatar Size', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'selectors'   => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-author img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xpro-post-grid-layout-4 .xpro-post-grid-content'   => 'margin-top: calc({{SIZE}}{{UNIT}} / 2);',
				),
				'condition'   => array(
					'show_author_avatar' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		$this->add_responsive_control(
			'author_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-author' => 'grid-gap: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'show_author_avatar' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'author_border',
				'label'     => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-author img',
				'condition' => array(
					'show_author_avatar' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'author_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_author_avatar' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'author_wrapper_margin',
			array(
				'label'      => __( 'Wrapper Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-wrapper .xpro-post-grid-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'author_heading_title',
			array(
				'label'     => __( 'Title', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_group_control(
			Xpro_Elementor_Group_Control_Foreground::get_type(),
			array(
				'name'      => 'author_title_color',
				'label'     => __( 'Title Color', 'xpro-elementor-addons-pro' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .xpro-post-grid-author-title',
				'condition' => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'author_title_typography',
				'label'     => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} .xpro-post-grid-author-title',
				'condition' => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'author_title_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-author-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_control(
			'author_heading_name',
			array(
				'label'     => __( 'Name', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'author_name_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-post-grid-author-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_name_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-post-grid-author-name',
			)
		);

		$this->add_responsive_control(
			'author_name_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-post-grid-author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'size_units' => array( 'px', '%' ),
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
				'label'     => __( 'Load More', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'load_more!' => ['none','pagination'],
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

		//Pagination
		$this->start_controls_section(
			'section_pagination_style',
			array(
				'label'     => __( 'Pagination', 'xpro-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'load_more' => 'pagination',
					'terms'     => '',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_alignment',
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
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination' => 'justify-content: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pagination_typography',
				'label'    => __( 'Typography', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers',
			)
		);

		$this->add_responsive_control(
			'pagination_space_between',
			array(
				'label'      => __( 'Space Between', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination' => 'grid-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pagination_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers',
			)
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'pagination_style_tabs'
		);

		$this->start_controls_tab(
			'pagination_normal_tab',
			array(
				'label' => __( 'Normal', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pagination_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pagination_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_hover_tab',
			array(
				'label' => __( 'Hover', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pagination_hover_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pagination_bg_hover_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_active_tab',
			array(
				'label' => __( 'Active', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'pagination_active_color',
			array(
				'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers.current' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pagination_bg_arctive_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-elementor-post-pagination .page-numbers.current' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Get a list of Taxonomy
	 *
	 * @return array
	 */
	public static function get_taxonomies() {

		$list     = xpro_elementor_get_taxonomies( array( 'public' => true ), 'object', true );
		$list[''] = __( 'None', 'xpro-elementor-addons-pro' );
		return $list;
	}

	/**
	 * Get a list of Taxonomy
	 *
	 * @return array
	 */
	public static function get_filter_taxonomies() {

		return xpro_elementor_get_taxonomies( array( 'public' => true ), 'object', true );
	}

	public static function filter_exclude() {

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

		$settings = $this->get_settings_for_display();
		$current_id = get_queried_object_id();

		?>

		<div class="xpro-post-grid-wrapper xpro-post-grid-layout-<?php echo esc_attr( $settings['layout'] ); ?>">

			<?php

			$args = xpro_elementor_get_query_args( $settings );
			$args = xpro_elementor_get_dynamic_args( $settings, $args );

			if ( 'source_dynamic' === $settings['post_type'] && ( 'xpro-themer' === get_post_type() || 'xpro_content' === get_post_type() ) ) {
				$document     = Plugin::instance()->documents->get_doc_or_auto_save( get_the_ID() );
				$dynamic_args = $document->get_document_query_args();
				if ( empty( $dynamic_args ) ) {
					$dynamic_args['post_type']      = 'post';
					$dynamic_args['posts_per_page'] = get_option( 'posts_per_page' );
				}
				$args = array_merge( $args, $dynamic_args );
			}

			$found_posts = 0;
			$paged       = 1;

			if ( '' === $settings['terms'] || 'pagination' === $settings['load_more'] ) {
				$args['offset'] = '';
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				} elseif ( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				}
			}

			$args['paged'] = $paged;

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				$found_posts      = $query->found_posts;
				$max_page         = ceil( $found_posts / absint( $args['posts_per_page'] ) );
				$args['max_page'] = $max_page;
				$item_count       = 0;
				$term_data        = array();

				while ( $query->have_posts() ) {
					$query->the_post();
					$term = get_the_terms( get_the_ID(), $settings['filter_source'] );
					if ( isset($term) && $term && $term[0]->slug && !in_array( esc_attr( $term[0]->term_id ), !empty($settings['filter_exclude']) ? $settings['filter_exclude'] : [], true ) ) {
						$term_data[ $term[0]->slug ] = $term[0]->name;
					}
				}

				?>

                <?php if($settings['show_filter'] === 'yes'): ?>
    				<div class="xpro-elementor-gallery-filter xpro-filter-dropdown-mobile">

					<!-- select content dropdown -->
					<div class="xpro-select-option">
						<span class="xpro-select-content"><?php echo esc_html( $settings['filter_all_text'] ? $settings['filter_all_text'] : '' ); ?></span>
						<i class="xpro-select-icon fas fa-chevron-down"></i>
					</div>

					<!-- Filters List -->
					<ul class="cbp-l-filters-button" data-default-filter="<?php echo esc_attr( $this->_default_filter ); ?>">

						<?php if ( 'yes' === $settings['filter_all'] ) : ?>
							<li class="cbp-filter-item-active cbp-filter-item" data-filter="*"><?php echo esc_html( $settings['filter_all_text'] ? $settings['filter_all_text'] : '' ); ?></li>
							<?php
						endif;

						foreach ( array_unique( $term_data ) as $t => $term ) {

							echo '<li class="cbp-filter-item" data-filter=".' . esc_attr( $t ) . '">' . esc_html( $term ) . '</li>';

						}
						?>
					</ul>
				</div>
                <?php endif ?>

					<div class="xpro-post-grid-main cbp">

					<?php

					while ( $query->have_posts() ) {
						$query->the_post();
						if('click' === $settings['load_more'] || 'auto' === $settings['load_more']){
							if ( isset( $settings['item_per_row'] ) && $item_count < $settings['item_per_row']  ) {
								require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advanced-posts/layout/frontend.php';
							}
							$item_count++;
						}
						else{
							require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advanced-posts/layout/frontend.php';
						}
					}

					?>

				</div>

				<?php

				if ( 'click' === $settings['load_more'] || 'auto' === $settings['load_more'] ) :
					?>

					<div class="cbp-loadMore-block1 cbp-loadMore-<?php echo esc_attr( $this->get_id() ); ?>">

						<?php
						$load_more_item = 0;
						while ( $query->have_posts() ) {
							$query->the_post();
							if ( isset( $settings['item_per_row'] ) && $load_more_item >= $settings['item_per_row']  ) {
								require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'advanced-posts/layout/frontend.php';
							}
							$load_more_item++;
						}
						?>

					</div>

					<?php

					$count = $load_more_item - $settings['item_per_row'];

					?>

					<div class="cbp-l-loadMore-button xpro-gallery-elementor-loadmore">
						<a href="<?php echo esc_url( get_permalink($current_id) . '#' . $this->get_id() ); ?>" class="cbp-l-loadMore-link" rel="nofollow">
			        <span class="cbp-l-loadMore-defaultText"><?php echo esc_html( $settings['load_more_text'] ); ?> <?php
                    if ( $count > 0 && 'yes' === $settings['load_more_count'] ) {
                        ?>(<span class="cbp-l-loadMore-loadItems"><?php echo esc_attr( $count ); ?></span>)<?php } ?></span>
							<span class="cbp-l-loadMore-loadingText"><?php echo esc_html( $settings['load_more_loading_text'] ); ?></span>
							<span class="cbp-l-loadMore-noMoreLoading"><?php echo esc_html( $settings['load_more_no_left'] ); ?></span>
						</a>
					</div>

				<?php endif; ?>

				<?php
				if ( 'custom' === $settings['load_more'] ) :

					$target   = $settings['custom_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $settings['custom_link']['nofollow'] ? ' rel="nofollow"' : '';

					?>

					<div class="xpro-gallery-elementor-custom-link">
						<a href="<?php echo esc_url( $settings['custom_link']['url'] ); ?>" <?php echo esc_attr( $target ) . esc_attr( $nofollow ); ?>class="xpro-gallery-elementor-link">
							<span><?php echo esc_html( $settings['load_more_text'] ); ?></span>
						</a>
					</div>

					<?php
				endif;

				if ( $found_posts > $args['posts_per_page'] && 'pagination' === $settings['load_more'] ) {
					$prev_icon_class = $settings['arrow'];
					$next_icon_class = str_replace( 'left', 'right', $settings['arrow'] );

					$prev_text = '<i class="' . $prev_icon_class . '"></i><span class="xpro-elementor-post-pagination-prev-text">' . $settings['prev_label'] . '</span>';
					$next_text = '<span class="xpro-elementor-post-pagination-next-text">' . $settings['next_label'] . '</span><i class="' . $next_icon_class . '"></i>';

					$paginate_args = array(
						'type'      => 'array',
						'current'   => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
						'total'     => $query->max_num_pages,
						'prev_next' => true,
						'prev_text' => $prev_text,
						'next_text' => $next_text,
					);

					if ( is_singular() && ! is_front_page() ) {
						global $wp_rewrite;
						if ( $wp_rewrite->using_permalinks() ) {
							$paginate_args['format'] = user_trailingslashit( 'page%#%', 'single_paged' ); // Change Occurs For Fixing Pagination Issue.
						} else {
							$paginate_args['format'] = '?page=%#%';
						}
					}

					$links = paginate_links( $paginate_args );

					?>

					<nav class="xpro-elementor-post-pagination" role="navigation" aria-label="<?php esc_attr_e( 'Pagination', 'xpro-elementor-addons-pro' ); ?>">
						<?php echo implode( PHP_EOL, $links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</nav>

					<?php

				}

				wp_reset_postdata();
			} else {
				?>
				<p class="xpro-alert xpro-alert-warning">
					<span class="xpro-alert-title"><?php esc_html_e( 'No Posts Found!', 'xpro-elementor-addons-pro' ); ?></span>
					<span class="xpro-alert-description"><?php esc_html_e( 'Sorry, but nothing matched your selection. Please try again with some different keywords.', 'xpro-elementor-addons-pro' ); ?></span>
				</p>
				<?php
			}

			?>

		</div>

		<?php

	}

}
