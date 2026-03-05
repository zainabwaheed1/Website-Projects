<?php
/**
 * Smoke Effect extension class.
 *
 * @package XproELementorAddons
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Smoke_Effect {

	static $should_script_enqueue = false;

	public static function init() {

		add_action( 'elementor/documents/register_controls', array( __CLASS__, 'register' ), 10 );
		add_action( 'elementor/editor/after_save', array( __CLASS__, 'save_global_values' ), 10, 2 );
		add_action( 'wp', array( __CLASS__, 'should_script_enqueue' ) );

	}

	/**
	 * Set should_script_enqueue based extension settings
	 *
	 * @param Element_Base $section
	 *
	 * @return void
	 */

	public static function should_script_enqueue() {

		if ( is_admin() || self::$should_script_enqueue || Plugin::$instance->editor->is_edit_mode() ) {
			return;
		}

		$global_setting = get_option( 'xpro_elementor_global_settings' );

		if ( ( isset( $global_setting['smoke_effect_global'] ) && array_values( $global_setting['smoke_effect_global'] )[0]['post_id'] ) || ( isset( $global_setting['smoke_effect'] ) && array_key_exists( (int) get_the_ID(), $global_setting['smoke_effect'] ) ) ) {

			if ( isset( $global_setting['smoke_effect_global'] ) ) {
				$global_values = array_values( get_option( 'xpro_elementor_global_settings' )['smoke_effect_global'] )[0];
				$show_on       = $global_values['display_on'];
				if ( ( 'page' !== get_post_type() && 'all-pages' === $show_on ) || ( 'post' !== get_post_type() && 'all-posts' === $show_on ) || ( ( 'page' !== get_post_type() && 'all-pages-posts' === $show_on ) && ( 'post' !== get_post_type() && 'all-pages-posts' === $show_on ) ) ) {
					return;
				}
			}

			self::enqueue_scripts();
			self::$should_script_enqueue = true;
			remove_action( 'wp', array( __CLASS__, 'should_script_enqueue' ) );

		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'xpro-smoke-effect', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/smoke-effect/js/smoke-effect.min.js', null, XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register( $element ) {

		if ( get_post_type() === 'xpro-themer' || get_post_type() === 'xpro_content' ) {
			return;
		}

		$global_settings = get_option( 'xpro_elementor_global_settings' );

		$element->start_controls_section(
			'section_xpro_elementor_smoke_effect_dfx',
			array(
				'label' => __( 'Smoke Effect', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$active_page_settings = isset( $global_settings['smoke_effect_global'] ) ? array_values( $global_settings['smoke_effect_global'] )[0] : false;

		if ( isset( $active_page_settings ) && false !== $active_page_settings && get_the_ID() !== $active_page_settings['post_id'] && 'publish' === get_post_status( $active_page_settings['post_id'] ) ) {
			$element->add_control(
				'xpro_elementor_smoke_effect_dfx_warning_text',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: 1$s: Title */
						__( 'You can modify the Global Smoke Effect by %1$s', 'xpro-elementor-addons-pro' ),
						'<strong><a href="' . get_bloginfo( 'url' ) . '/wp-admin/post.php?post=' . $active_page_settings['post_id'] . '&action=elementor">Clicking Here</a></strong>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'separator'       => 'before',
				)
			);
		} else {

			$element->add_control(
				'xpro_elementor_smoke_effect_dfx',
				array(
					'label'        => __( 'Enable', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'render_type'  => 'template',
				)
			);

			$element->add_control(
				'xpro_elementor_smoke_effect_dfx_global',
				array(
					'label'        => __( 'Progress Bar Globally', 'xpro-elementor-addons-pro' ),
					'description'  => __( 'Enabling this option will effect on entire site.', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'label_on'     => __( 'Yes', 'xpro-elementor-addons-pro' ),
					'label_off'    => __( 'No', 'xpro-elementor-addons-pro' ),
					'return_value' => 'yes',
					'condition'    => array(
						'xpro_elementor_smoke_effect_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_smoke_effect_dfx_display_on',
				array(
					'label'     => __( 'Display On', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'all-pages-posts',
					'options'   => array(
						'all-pages'       => __( 'All Pages', 'xpro-elementor-addons-pro' ),
						'all-posts'       => __( 'All Posts', 'xpro-elementor-addons-pro' ),
						'all-pages-posts' => __( 'All Pages & Posts', 'xpro-elementor-addons-pro' ),
					),
					'condition' => array(
						'xpro_elementor_smoke_effect_dfx'        => 'yes',
						'xpro_elementor_smoke_effect_dfx_global' => 'yes',
					),
				)
			);
		}

		$element->end_controls_section();

	}

	public static function save_global_values( $post_id ) {

		$document = Plugin::$instance->documents->get( $post_id, false );
		$settings = $document->get_settings();

		$global_settings = get_option( 'xpro_elementor_global_settings' );
		$options         = $global_settings ? $global_settings : array();

		$active_page_settings = isset( $global_settings['smoke_effect_global'] ) ? array_values( $global_settings['smoke_effect_global'] )[0] : false;

		if ( isset( $active_page_settings ) && false !== $active_page_settings && get_the_ID() !== $active_page_settings['post_id'] ) {
			return;
		}

		if ( 'yes' === $settings['xpro_elementor_smoke_effect_dfx'] ) {

			// Global Settings
			if ( 'yes' === $settings['xpro_elementor_smoke_effect_dfx_global'] ) {
				$options['smoke_effect_global'][ $post_id ]['post_id']    = get_the_ID();
				$options['smoke_effect_global'][ $post_id ]['display_on'] = $settings['xpro_elementor_smoke_effect_dfx_display_on'];

				// Updating old settings if present
				if ( $options['smoke_effect'] ) {
					unset( $options['smoke_effect'] );
				}
			} else {

				$options['smoke_effect'][ $post_id ] = get_the_ID();

				// Removing global values if disabled
				if ( isset( get_option( 'xpro_elementor_global_settings' )['smoke_effect_global'] ) && array_key_exists( $post_id, get_option( 'xpro_elementor_global_settings' )['smoke_effect_global'] ) ) {
					unset( $options['smoke_effect_global'] );
				}
			}
		} else {
			if ( isset( get_option( 'xpro_elementor_global_settings' )['smoke_effect'] ) && array_key_exists( $post_id, get_option( 'xpro_elementor_global_settings' )['smoke_effect'] ) ) {
				// removing the disabled Mouse Effect
				unset( $options['smoke_effect'][ $post_id ] );
			}
			if ( isset( get_option( 'xpro_elementor_global_settings' )['smoke_effect_global'] ) && array_key_exists( $post_id, get_option( 'xpro_elementor_global_settings' )['smoke_effect_global'] ) ) {
				unset( $options['smoke_effect_global'] );
			}
		}

		update_option( 'xpro_elementor_global_settings', $options );

	}

}

Xpro_Elementor_Smoke_Effect::init();
