<?php

/**
 * Display Condition extension class.
 *
 * @package XproELementorAddonsPro
 */

namespace XproElementorAddonsPro\Module;

use DateTime;
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Plugin;
use Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Display_Conditions {

	private static $instance = null;

	public function __construct() {

		add_action( 'elementor/element/common/_section_style/after_section_end', array( __CLASS__, 'register' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( __CLASS__, 'register' ), 10, 2 );
		add_action( 'elementor/element/column/_section_responsive/after_section_end', array( __CLASS__, 'register' ), 10, 2 );
		add_action( 'elementor/element/container/_section_responsive/after_section_end', array( __CLASS__, 'register' ), 10, 2 );

		add_filter( 'elementor/frontend/section/should_render', array( $this, 'content_render' ), 10, 2 );
		add_filter( 'elementor/frontend/column/should_render', array( $this, 'content_render' ), 10, 2 );
		add_filter( 'elementor/frontend/widget/should_render', array( $this, 'content_render' ), 10, 2 );
		add_filter( 'elementor/frontend/container/should_render', array( $this, 'content_render' ), 10, 2 );

	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public static function register( Element_Base $element ) {

		global $wp_roles;

		$default_date_start = gmdate( 'Y-m-d', strtotime( '-3 day' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) );
		$default_date_end   = gmdate( 'Y-m-d', strtotime( '+3 day' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) );
		$default_interval   = $default_date_start . ' to ' . $default_date_end;

		$element_type = $element->get_type();

		$conditions_options = array(
			array(
				'label'   => __( 'Visitor', 'xpro-elementor-addons-pro' ),
				'options' => array(
					'authentication' => __( 'Login Status', 'xpro-elementor-addons-pro' ),
					'role'           => __( 'User Role', 'xpro-elementor-addons-pro' ),
					'os'             => __( 'Operating System', 'xpro-elementor-addons-pro' ),
					'browser'        => __( 'Browser', 'xpro-elementor-addons-pro' ),
				),
			),
			array(
				'label'   => __( 'Date & Time', 'xpro-elementor-addons-pro' ),
				'options' => array(
					'date' => __( 'Current Date', 'xpro-elementor-addons-pro' ),
					'time' => __( 'Time of Day', 'xpro-elementor-addons-pro' ),
					'day'  => __( 'Day of Week', 'xpro-elementor-addons-pro' ),
				),
			),
			array(
				'label'   => __( 'Single', 'xpro-elementor-addons-pro' ),
				'options' => array(
					'page'        => __( 'Page', 'xpro-elementor-addons-pro' ),
					'post'        => __( 'Post', 'xpro-elementor-addons-pro' ),
					'static_page' => __( 'Static Page', 'xpro-elementor-addons-pro' ),
					'post_type'   => __( 'Post Type', 'xpro-elementor-addons-pro' ),
				),
			),
			array(
				'label'   => __( 'Archive', 'xpro-elementor-addons-pro' ),
				'options' => array(
					'taxonomy_archive'  => __( 'Taxonomy', 'xpro-elementor-addons-pro' ),
					'term_archive'      => __( 'Term', 'xpro-elementor-addons-pro' ),
					'post_type_archive' => __( 'Post Type', 'xpro-elementor-addons-pro' ),
					'date_archive'      => __( 'Date', 'xpro-elementor-addons-pro' ),
					'author_archive'    => __( 'Author', 'xpro-elementor-addons-pro' ),
					'search_results'    => __( 'Search', 'xpro-elementor-addons-pro' ),
				),
			),
		);

		$element->start_controls_section(
			'section_xpro_elementor_display_condition',
			array(
				'label' => __( 'Display Condition', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);

		$element->add_control(
			'xpro_elementor_display_conditions_enable',
			array(
				'label'              => __( 'Enable', 'xpro-elementor-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => '',
				'label_on'           => __( 'Yes', 'xpro-elementor-addons-pro' ),
				'label_off'          => __( 'No', 'xpro-elementor-addons-pro' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
				'style_transfer'     => false,
			)
		);

		$element->add_control(
			'xpro_elementor_display_conditions_output',
			array(
				'label'          => __( 'Hide By CSS', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Yes', 'xpro-elementor-addons-pro' ),
				'label_off'      => __( 'No', 'xpro-elementor-addons-pro' ),
				'return_value'   => 'yes',
				'style_transfer' => false,
				'condition'      => array(
					'xpro_elementor_display_conditions_enable' => 'yes',
				),
			)
		);

		$element->add_control(
			'xpro_elementor_display_conditions_relation',
			array(
				'label'          => __( 'Display on', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'all',
				'options'        => array(
					'all' => __( 'All', 'xpro-elementor-addons-pro' ),
					'any' => __( 'At least one', 'xpro-elementor-addons-pro' ),
				),
				'style_transfer' => false,
				'condition'      => array(
					'xpro_elementor_display_conditions_enable' => 'yes',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'xpro_elementor_condition_key',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => 'authentication',
				'label_block' => true,
				'groups'      => $conditions_options,
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_operator',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => 'is',
				'label_block' => true,
				'options'     => array(
					'is'  => __( 'Is', 'xpro-elementor-addons-pro' ),
					'not' => __( 'Is not', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_authentication_value',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => 'authenticated',
				'label_block' => true,
				'options'     => array(
					'authenticated' => __( 'Logged in', 'xpro-elementor-addons-pro' ),
				),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'authentication',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_role_value',
			array(
				'type'        => Controls_Manager::SELECT,
				'description' => __( 'Warning: This condition applies only to logged in visitors.', 'xpro-elementor-addons-pro' ),
				'default'     => 'subscriber',
				'label_block' => true,
				'options'     => $wp_roles->get_names(),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'role',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_date_value',
			array(
				'label'          => __( 'In Interval', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => array(
					'enableTime' => false,
					'mode'       => 'range',
				),
				'label_block'    => true,
				'default'        => $default_interval,
				'condition'      => array(
					'xpro_elementor_condition_key' => 'date',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_time_value',
			array(
				'label'          => __( 'Before', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => array(
					'dateFormat' => 'H:i',
					'enableTime' => true,
					'noCalendar' => true,
				),
				'label_block'    => true,
				'default'        => '',
				'condition'      => array(
					'xpro_elementor_condition_key' => 'time',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_day_value',
			array(
				'label'       => __( 'Before', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'multiple'    => true,
				'options'     => array(
					'1' => __( 'Monday', 'xpro-elementor-addons-pro' ),
					'2' => __( 'Tuesday', 'xpro-elementor-addons-pro' ),
					'3' => __( 'Wednesday', 'xpro-elementor-addons-pro' ),
					'4' => __( 'Thursday', 'xpro-elementor-addons-pro' ),
					'5' => __( 'Friday', 'xpro-elementor-addons-pro' ),
					'6' => __( 'Saturday', 'xpro-elementor-addons-pro' ),
					'7' => __( 'Sunday', 'xpro-elementor-addons-pro' ),
				),
				'label_block' => true,
				'default'     => 'Monday',
				'condition'   => array(
					'xpro_elementor_condition_key' => 'day',
				),
			)
		);

		$os_options = array(
			'mac_os'     => __( 'Mac OS', 'xpro-elementor-addons-pro' ),
			'linux'      => __( 'Linux', 'xpro-elementor-addons-pro' ),
			'ubuntu'     => __( 'Ubuntu', 'xpro-elementor-addons-pro' ),
			'iphone'     => __( 'iPhone', 'xpro-elementor-addons-pro' ),
			'android'    => __( 'iPad', 'xpro-elementor-addons-pro' ),
			'windows'    => __( 'Windows', 'xpro-elementor-addons-pro' ),
			'ipod'       => __( 'iPod', 'xpro-elementor-addons-pro' ),
			'ipad'       => __( 'Android', 'xpro-elementor-addons-pro' ),
			'blackberry' => __( 'BlackBerry', 'xpro-elementor-addons-pro' ),
			'open_bsd'   => __( 'OpenBSD', 'xpro-elementor-addons-pro' ),
			'sun_os'     => __( 'SunOS', 'xpro-elementor-addons-pro' ),
			'safari'     => __( 'Safari', 'xpro-elementor-addons-pro' ),
			'qnx'        => __( 'QNX', 'xpro-elementor-addons-pro' ),
			'beos'       => __( 'BeOS', 'xpro-elementor-addons-pro' ),
			'os2'        => __( 'OS/2', 'xpro-elementor-addons-pro' ),
			'search_bot' => __( 'Search Bot', 'xpro-elementor-addons-pro' ),
		);

		$repeater->add_control(
			'xpro_elementor_condition_os_value',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => array_keys( $os_options )[0],
				'label_block' => true,
				'options'     => $os_options,
				'condition'   => array(
					'xpro_elementor_condition_key' => 'os',
				),
			)
		);

		$browser_options = array(
			'opera'   => __( 'Opera', 'xpro-elementor-addons-pro' ),
			'edge'    => __( 'Edge', 'xpro-elementor-addons-pro' ),
			'chrome'  => __( 'Google Chrome', 'xpro-elementor-addons-pro' ),
			'safari'  => __( 'Safari', 'xpro-elementor-addons-pro' ),
			'firefox' => __( 'Mozilla Firefox', 'xpro-elementor-addons-pro' ),
			'ie'      => __( 'Internet Explorer', 'xpro-elementor-addons-pro' ),
			'others'  => __( 'Others', 'xpro-elementor-addons-pro' ),
		);

		$repeater->add_control(
			'xpro_elementor_condition_browser_value',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => array_keys( $browser_options )[0],
				'label_block' => true,
				'options'     => $browser_options,
				'condition'   => array(
					'xpro_elementor_condition_key' => 'browser',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_page_value',
			array(
				'type'        => 'xpro-select',
				'options'     => xpro_elementor_get_query_post_list(),
				'default'     => '',
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'post_type',
				'source_type' => 'page',
				'condition'   => array(
					'xpro_elementor_condition_key' => 'page',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_post_value',
			array(
				'type'        => 'xpro-select',
				'options'     => xpro_elementor_get_query_post_list(),
				'default'     => '',
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'post_type',
				'source_type' => 'post',
				'condition'   => array(
					'xpro_elementor_condition_key' => 'post',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_static_page_value',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => 'home',
				'label_block' => true,
				'options'     => array(
					'home'   => __( 'Default Homepage', 'xpro-elementor-addons-pro' ),
					'static' => __( 'Static Homepage', 'xpro-elementor-addons-pro' ),
					'blog'   => __( 'Blog Page', 'xpro-elementor-addons-pro' ),
					'404'    => __( '404 Page', 'xpro-elementor-addons-pro' ),
				),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'static_page',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_post_type_value',
			array(
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'multiple'    => true,
				'options'     => xpro_elementor_get_post_types(),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'post_type',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_taxonomy_archive_value',
			array(
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'multiple'    => true,
				'label_block' => true,
				'options'     => xpro_elementor_get_taxonomies(),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'taxonomy_archive',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_term_archive_value',
			array(
				'label'       => __( 'Term', 'xpro-elementor-addons-pro' ),
				'type'        => 'xpro-select',
				'options'     => array(),
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'taxonomy',
				'source_type' => 'any',
				'condition'   => array(
					'xpro_elementor_condition_key' => 'term_archive',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_post_type_archive_value',
			array(
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'multiple'    => true,
				'label_block' => true,
				'options'     => xpro_elementor_get_post_types(),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'post_type_archive',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_date_archive_value',
			array(
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'multiple'    => true,
				'label_block' => true,
				'options'     => array(
					'day'   => __( 'Day', 'xpro-elementor-addons-pro' ),
					'month' => __( 'Month', 'xpro-elementor-addons-pro' ),
					'year'  => __( 'Year', 'xpro-elementor-addons-pro' ),
				),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'date_archive',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_author_archive_value',
			array(
				'placeholder' => __( 'Any', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'default'     => array(),
				'options'     => xpro_elementor_get_authors_list(),
				'condition'   => array(
					'xpro_elementor_condition_key' => 'author_archive',
				),
			)
		);

		$repeater->add_control(
			'xpro_elementor_condition_search_results_value',
			array(
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Keywords', 'xpro-elementor-addons-pro' ),
				'description' => __( 'Enter keywords & separated by commas "," to condition the display on specific keywords.', 'xpro-elementor-addons-pro' ),
				'label_block' => true,
				'condition'   => array(
					'xpro_elementor_condition_key' => 'search_results',
				),
			)
		);

		$element->add_control(
			'xpro_elementor_display_conditions',
			array(
				'label'          => __( 'Conditions', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::REPEATER,
				'fields'         => $repeater->get_controls(),
				'default'        => array(
					array(
						'xpro_elementor_condition_key' => 'authentication',
						'xpro_elementor_condition_operator' => 'is',
						'xpro_elementor_condition_authentication_value' => 'authenticated',
					),
				),
				'condition'      => array(
					'xpro_elementor_display_conditions_enable' => 'yes',
				),
				'title_field'    => 'Condition',
				'style_transfer' => false,
			)
		);

		$element->end_controls_section();
	}

	public static function check_authentication( $value, $operator ) {
		return self::compare( is_user_logged_in(), true, $operator );
	}

	public static function compare( $left_value, $right_value, $operator ) {
		switch ( $operator ) {
			case 'is':
				return $left_value == $right_value;
			case 'not':
				return $left_value != $right_value;
			default:
				return $left_value === $right_value;
		}
	}

	public static function check_role( $value, $operator ) {

		$user = wp_get_current_user();

		return self::compare( is_user_logged_in() && in_array( $value, $user->roles ), true, $operator );
	}

	public static function check_date( $value, $operator ) {

		// Split control value into two dates
		$intervals = explode( 'to', preg_replace( '/\s+/', '', $value ) );

		// Make sure the explode return an array with exactly 2 indexes
		if ( ! is_array( $intervals ) || 2 !== count( $intervals ) ) {
			return false;
		}

		// Set start and end dates
		$start = $intervals[0];
		$end   = $intervals[1];
		$today = gmdate( 'Y-m-d' );

		// Default returned bool to false
		$show = false;

		// Check vars
		if (
			DateTime::createFromFormat( 'Y-m-d', $start ) === false || // Make sure it's a date
			DateTime::createFromFormat( 'Y-m-d', $end ) === false
		) { // Make sure it's a date
			return false;
		}

		// Convert to timestamp
		$start_ts = strtotime( $start ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
		$end_ts   = strtotime( $end ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
		$today_ts = strtotime( $today ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );

		// Check that user date is between start & end
		$show = ( ( $today_ts >= $start_ts ) && ( $today_ts <= $end_ts ) );

		return self::compare( $show, true, $operator );
	}

	public static function check_time( $value, $operator ) {

		// Split control value into two dates
		$time = gmdate( 'H:i', strtotime( preg_replace( '/\s+/', '', $value ) ) );
		$now  = gmdate( 'H:i', strtotime( 'now' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) );

		// Default returned bool to false
		$show = false;

		// Check vars
		if ( DateTime::createFromFormat( 'H:i', $time ) === false ) { // Make sure it's a valid DateTime format
			return false;
		}

		// Convert to timestamp
		$time_ts = strtotime( $time );
		$now_ts  = strtotime( $now );

		// Check that user date is between start & end
		$show = ( $now_ts < $time_ts );

		return self::compare( $show, true, $operator );
	}

	public static function check_day( $value, $operator ) {

		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( $_value === gmdate( 'w' ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = $value === gmdate( 'w' );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_os( $value, $operator ) {

		$oses = array(
			'mac_os'     => __( 'Mac OS', 'xpro-elementor-addons-pro' ),
			'linux'      => __( 'Linux', 'xpro-elementor-addons-pro' ),
			'ubuntu'     => __( 'Ubuntu', 'xpro-elementor-addons-pro' ),
			'iphone'     => __( 'iPhone', 'xpro-elementor-addons-pro' ),
			'android'    => __( 'iPad', 'xpro-elementor-addons-pro' ),
			'windows'    => __( 'Windows', 'xpro-elementor-addons-pro' ),
			'ipod'       => __( 'iPod', 'xpro-elementor-addons-pro' ),
			'ipad'       => __( 'Android', 'xpro-elementor-addons-pro' ),
			'blackberry' => __( 'BlackBerry', 'xpro-elementor-addons-pro' ),
			'open_bsd'   => __( 'OpenBSD', 'xpro-elementor-addons-pro' ),
			'sun_os'     => __( 'SunOS', 'xpro-elementor-addons-pro' ),
			'safari'     => __( 'Safari', 'xpro-elementor-addons-pro' ),
			'qnx'        => __( 'QNX', 'xpro-elementor-addons-pro' ),
			'beos'       => __( 'BeOS', 'xpro-elementor-addons-pro' ),
			'os2'        => __( 'OS/2', 'xpro-elementor-addons-pro' ),
			'search_bot' => __( 'Search Bot', 'xpro-elementor-addons-pro' ),
		);

		return self::compare( preg_match( '@' . $oses[ $value ] . '@', $_SERVER['HTTP_USER_AGENT'] ), true, $operator );
	}

	public static function check_browser( $value, $operator ) {

		$browsers = array(
			'opera'   => __( 'Opera', 'xpro-elementor-addons-pro' ),
			'edge'    => __( 'Edge', 'xpro-elementor-addons-pro' ),
			'chrome'  => __( 'Google Chrome', 'xpro-elementor-addons-pro' ),
			'safari'  => __( 'Safari', 'xpro-elementor-addons-pro' ),
			'firefox' => __( 'Mozilla Firefox', 'xpro-elementor-addons-pro' ),
			'ie'      => __( 'Internet Explorer', 'xpro-elementor-addons-pro' ),
			'others'  => __( 'Others', 'xpro-elementor-addons-pro' ),
		);

		$show = false;

		if ( 'ie' === $value ) {
			if ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], $browsers[ $value ][0] ) || false !== strpos( $_SERVER['HTTP_USER_AGENT'], $browsers[ $value ][1] ) ) {
				$show = true;
			}
		} else {
			if ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], $browsers[ $value ] ) ) {
				$show = true;

				// Additional check for Chrome that returns Safari
				if ( 'safari' === $value || 'firefox' === $value ) {
					if ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) ) {
						$show = false;
					}
				}
			}
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_page( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( is_page( $_value ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = is_page( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_post( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( is_single( $_value ) || is_singular( $_value ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = is_single( $value ) || is_singular( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_static_page( $value, $operator ) {

		if ( 'home' === $value ) {
			return self::compare( ( is_front_page() && is_home() ), true, $operator );
		} elseif ( 'static' === $value ) {
			return self::compare( ( is_front_page() && ! is_home() ), true, $operator );
		} elseif ( 'blog' === $value ) {
			return self::compare( ( ! is_front_page() && is_home() ), true, $operator );
		} elseif ( '404' === $value ) {
			return self::compare( is_404(), true, $operator );
		}
	}

	public static function check_post_type( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( is_singular( $_value ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = is_singular( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_taxonomy_archive( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {

				$show = self::check_taxonomy_archive_type( $_value );

				if ( $show ) {
					break;
				}
			}
		} else {
			$show = self::check_taxonomy_archive_type( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_taxonomy_archive_type( $taxonomy ) {
		if ( 'category' === $taxonomy ) {
			return is_category();
		} elseif ( 'post_tag' === $taxonomy ) {
			return is_tag();
		} elseif ( '' === $taxonomy || empty( $taxonomy ) ) {
			return is_tax() || is_category() || is_tag();
		} else {
			return is_tax( $taxonomy );
		}
	}

	public static function check_term_archive( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {

				$show = self::check_term_archive_type( $_value );

				if ( $show ) {
					break;
				}
			}
		} else {
			$show = self::check_term_archive_type( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_term_archive_type( $term ) {

		if ( is_category( $term ) ) {
			return true;
		} elseif ( is_tag( $term ) ) {
			return true;
		} elseif ( is_tax() ) {
			if ( is_tax( get_queried_object()->taxonomy, $term ) ) {
				return true;
			}
		}

		return false;
	}

	public static function check_post_type_archive( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( is_post_type_archive( $_value ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = is_post_type_archive( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_date_archive( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( self::check_date_archive_type( $_value ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = is_date( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_date_archive_type( $type ) {
		if ( 'day' === $type ) { // Day
			return is_day();
		} elseif ( 'month' === $type ) { // Month
			return is_month();
		} elseif ( 'year' === $type ) { // Year
			return is_year();
		}

		return false;
	}

	public static function check_author_archive( $value, $operator ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				if ( is_author( $_value ) ) {
					$show = true;
					break;
				}
			}
		} else {
			$show = is_author( $value );
		}

		return self::compare( $show, true, $operator );
	}

	public static function check_search_results( $value, $operator ) {
		$show = false;

		if ( is_search() ) {

			if ( empty( $value ) ) { // We're showing on all search pages

				$show = true;
			} else { // We're showing on specific keywords

				$phrase = get_search_query(); // The user search query

				if ( '' !== $phrase && ! empty( $phrase ) ) { // Only proceed if there is a query

					$keywords = explode( ',', $value ); // Separate keywords

					foreach ( $keywords as $index => $keyword ) {
						if ( self::keyword_exists( trim( $keyword ), $phrase ) ) {
							$show = true;
							break;
						}
					}
				}
			}
		}

		return self::compare( $show, true, $operator );
	}

	public static function keyword_exists( $keyword, $phrase ) {
		return strpos( $phrase, trim( $keyword ) ) !== false;
	}

	public function content_render( $should_render, Element_Base $element ) {

		$settings = $element->get_settings();

		if ( isset( $settings['xpro_elementor_display_conditions_enable'] ) && 'yes' === $settings['xpro_elementor_display_conditions_enable'] ) {

			// Set the conditions
			$this->set_conditions( $element->get_id(), $settings['xpro_elementor_display_conditions'] );

			if ( ! $this->is_visible( $element->get_id(), $settings['xpro_elementor_display_conditions_relation'] ) ) { // Check the conditions
				if ( isset( $settings['xpro_elementor_display_conditions_output'] ) && 'yes' === $settings['xpro_elementor_display_conditions_output'] ) {
					$element->add_render_attribute( '_wrapper', 'class', 'xpro-content-hidden' );
				} else {
					$should_render = false;
				}
			}
		}

		return $should_render;
	}

	public function set_conditions( $id, $conditions = array() ) {

		if ( ! $conditions ) {
			return;
		}

		foreach ( $conditions as $index => $condition ) {
			$key      = $condition['xpro_elementor_condition_key'];
			$operator = $condition['xpro_elementor_condition_operator'];
			$value    = $condition[ 'xpro_elementor_condition_' . $key . '_value' ];

			if ( method_exists( $this, 'check_' . $key ) ) {
				$check = call_user_func(
					array(
						$this,
						'check_' . $key,
					),
					$value,
					$operator
				);
				$this->conditions[ $id ][ $key . '_' . $condition['_id'] ] = $check;
			}
		}
	}

	public function is_visible( $id, $relation ) {

		if ( ! array_key_exists( $id, $this->conditions ) ) {
			return false;
		}

		if ( ! Plugin::$instance->editor->is_edit_mode() ) {
			if ( 'any' === $relation ) {
				if ( ! in_array( true, $this->conditions[ $id ], true ) ) {
					return false;
				}
			} else {
				if ( in_array( false, $this->conditions[ $id ], true ) ) {
					return false;
				}
			}
		}

		return true;
	}

}

Xpro_Elementor_Display_Conditions::get_instance();
