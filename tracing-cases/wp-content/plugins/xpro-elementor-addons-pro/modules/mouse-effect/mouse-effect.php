<?php
/**
 * Mouse Effect extension class.
 *
 * @package XproELementorAddonsPro
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class Xpro_Elementor_Mouse_Effect {

	static $should_script_enqueue = false;

	public static function init() {
		add_action( 'elementor/documents/register_controls', array( __CLASS__, 'register_document_controls' ), 10 );
		add_action( 'elementor/editor/after_save', array( __CLASS__, 'save_global_values' ), 10, 2 );

		add_action( 'wp', array( __CLASS__, 'should_script_enqueue' ) );

		// Add module-specific parameters to the params for all Elementor's modules
		add_action( 'elementor/element/before_section_start', array( __CLASS__, 'register_element_controls' ), 10, 3 );

		// Add module-specific data-attributes to all Elementor's layouts
		add_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'add_data_to_elements' ), 10, 1 );
		add_action( 'elementor/frontend/column/before_render', array( __CLASS__, 'add_data_to_elements' ), 10, 1 );
		add_action( 'elementor/frontend/container/before_render', array( __CLASS__, 'add_data_to_elements' ), 10, 1 );
		add_action( 'elementor/frontend/widget/before_render', array( __CLASS__, 'add_data_to_elements' ), 10, 1 );
	}

	/**
	 * Set should_script_enqueue based extension settings
	 *
	 * @param Element_Base $section
	 *
	 * @return void
	 */
	public static function should_script_enqueue( $document ) {

		if ( is_admin() || self::$should_script_enqueue || Plugin::$instance->editor->is_edit_mode() ) {
			return;
		}

		$global_setting = get_option( 'xpro_elementor_global_settings' );

		if ( ( isset( $global_setting['mouse_effect_global'] ) && array_values( $global_setting['mouse_effect_global'] )[0]['post_id'] ) || ( isset( $global_setting['mouse_effect'] ) && array_key_exists( (int) get_the_ID(), $global_setting['mouse_effect'] ) ) ) {

			if ( isset( $global_setting['mouse_effect_global'] ) ) {
				$global_values = array_values( get_option( 'xpro_elementor_global_settings' )['mouse_effect_global'] )[0];
				$show_on       = $global_values['display_on'];
				if ( ( 'page' !== get_post_type() && 'all-pages' === $show_on ) || ( 'post' !== get_post_type() && 'all-posts' === $show_on ) || ( ( 'page' !== get_post_type() && 'all-pages-posts' === $show_on ) && ( 'post' !== get_post_type() && 'all-pages-posts' === $show_on ) ) ) {
					return;
				}
			}

			self::enqueue_scripts();
			self::$should_script_enqueue = true;
			remove_action( 'wp', array( __CLASS__, 'should_script_enqueue' ) );
			add_action( 'wp_footer', array( __CLASS__, 'add_html_to_body' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_inline_CSS' ), 99 );

		}
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'gsap' );
		wp_enqueue_script( 'xpro-mouse-effect', XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/mouse-effect/js/mouse-effect.min.js', null, XPRO_ELEMENTOR_ADDONS_PRO_VERSION, true );
	}

	public static function register_document_controls( $element ) {

		if ( get_post_type() === 'xpro-themer' || get_post_type() === 'xpro_content' ) {
			return;
		}

		$global_settings = get_option( 'xpro_elementor_global_settings' );

		$element->start_controls_section(
			'section_xpro_elementor_mouse_dfx',
			array(
				'label' => __( 'Mouse Effect', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$active_page_settings = isset( $global_settings['mouse_effect_global'] ) ? array_values( $global_settings['mouse_effect_global'] )[0] : false;

		if ( isset( $active_page_settings ) && false !== $active_page_settings && get_the_ID() !== $active_page_settings['post_id'] && 'publish' === get_post_status( $active_page_settings['post_id'] ) ) {
			$element->add_control(
				'xpro_elementor_mouse_dfx_warning_text',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: 1$s: Title */
						__( 'You can modify the Global Mouse Effect by %1$s', 'xpro-elementor-addons-pro' ),
						'<strong><a href="' . get_bloginfo( 'url' ) . '/wp-admin/post.php?post=' . $active_page_settings['post_id'] . '&action=elementor">Clicking Here</a></strong>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'separator'       => 'before',
				)
			);
		} else {

			$element->add_control(
				'xpro_elementor_mouse_dfx',
				array(
					'label'        => __( 'Enable', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_global',
				array(
					'label'        => __( 'Mouse Effect Globally', 'xpro-elementor-addons-pro' ),
					'description'  => __( 'Enabling this option will effect on entire site.', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'label_on'     => __( 'Yes', 'xpro-elementor-addons-pro' ),
					'label_off'    => __( 'No', 'xpro-elementor-addons-pro' ),
					'return_value' => 'yes',
					'condition'    => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_display_on',
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
						'xpro_elementor_mouse_dfx'        => 'yes',
						'xpro_elementor_mouse_dfx_global' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_cursor',
				array(
					'label'     => __( 'Cursor', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'default',
					'separator' => 'before',
					'options'   => array(
						'default' => __( 'Default', 'xpro-elementor-addons-pro' ),
						'replace' => __( 'Replace', 'xpro-elementor-addons-pro' ),
					),
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_cursor_image',
				array(
					'label'       => esc_html__( 'Cursor Image', 'xpro-elementor-addons-pro' ),
					'description' => __( 'Select or upload image (up to 32x32) to use it as default cursor.', 'xpro-elementor-addons-pro' ),
					'type'        => Controls_Manager::MEDIA,
					'condition'   => array(
						'xpro_elementor_mouse_dfx'        => 'yes',
						'xpro_elementor_mouse_dfx_cursor' => 'replace',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_delay',
				array(
					'label'     => __( 'Motion Delay', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min'  => 0,
							'max'  => 5,
							'step' => 0.1,
						),
					),
					'default'   => array(
						'size' => 0.5,
					),
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_color',
				array(
					'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'separator' => 'before',
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_bg_color',
				array(
					'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_border_color',
				array(
					'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_blend_mode',
				array(
					'type'        => Controls_Manager::SELECT,
					'label'       => esc_html__( 'Blend mode', 'xpro-elementor-addons-pro' ),
					'label_block' => false,
					'default'     => '',
					'options'     => array(
						''            => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
						'normal'      => esc_html__( 'Normal', 'xpro-elementor-addons-pro' ),
						'multiply'    => esc_html__( 'Multiply', 'xpro-elementor-addons-pro' ),
						'screen'      => esc_html__( 'Screen', 'xpro-elementor-addons-pro' ),
						'overlay'     => esc_html__( 'Overlay', 'xpro-elementor-addons-pro' ),
						'darken'      => esc_html__( 'Darken', 'xpro-elementor-addons-pro' ),
						'lighten'     => esc_html__( 'Lighten', 'xpro-elementor-addons-pro' ),
						'color-dodge' => esc_html__( 'Color Dodge', 'xpro-elementor-addons-pro' ),
						'color-burn'  => esc_html__( 'Color Burn', 'xpro-elementor-addons-pro' ),
						'hard-light'  => esc_html__( 'Hard Light', 'xpro-elementor-addons-pro' ),
						'soft-light'  => esc_html__( 'Soft Light', 'xpro-elementor-addons-pro' ),
						'difference'  => esc_html__( 'Difference', 'xpro-elementor-addons-pro' ),
						'exclusion'   => esc_html__( 'Exclusion', 'xpro-elementor-addons-pro' ),
						'hue'         => esc_html__( 'Hue', 'xpro-elementor-addons-pro' ),
						'saturation'  => esc_html__( 'Saturation', 'xpro-elementor-addons-pro' ),
						'color'       => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
						'luminosity'  => esc_html__( 'Luminosity', 'xpro-elementor-addons-pro' ),
					),
					'condition'   => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_size',
				array(
					'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min' => 5,
							'max' => 100,
						),
					),
					'default'   => array(
						'size' => 20,
					),
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_dfx_opacity',
				array(
					'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min'  => 0.1,
							'max'  => 1,
							'step' => 0.1,
						),
					),
					'default'   => array(
						'size' => 0.5,
					),
					'condition' => array(
						'xpro_elementor_mouse_dfx' => 'yes',
					),
				)
			);

		}

		$element->end_controls_section();

	}

	public static function register_element_controls( $element, $section_id, $args ) {

		if ( ! is_object( $element ) ) {
			return;
		}

		if ( in_array( $element->get_name(), array( 'section', 'column', 'common', 'container' ), true ) && 'section_effects' === $section_id ) {

			$element->start_controls_section(
				'section_xpro_elementor_mouse_effect',
				array(
					'label' => __( 'Mouse Effect', 'xpro-elementor-addons-pro' ),
					'tab'   => Controls_Manager::TAB_ADVANCED,
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx',
				array(
					'label'        => __( 'Enable', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'prefix_class' => 'xpro-mouse-effect-',
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_hide',
				array(
					'label'        => __( 'Hide Cursor', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'selectors'    => array(
						'body:not(.elementor-editor-active) {{WRAPPER}},body:not(.elementor-editor-active) {{WRAPPER}} *' => 'cursor: none',
					),
					'condition'    => array(
						'xpro_elementor_mouse_fx' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_cursor_image',
				array(
					'label'       => esc_html__( 'Cursor Image', 'xpro-elementor-addons-pro' ),
					'description' => __( 'Select or upload image (up to 32x32) to use it as default cursor.', 'xpro-elementor-addons-pro' ),
					'type'        => Controls_Manager::MEDIA,
					'selectors'   => array(
						'body:not(.elementor-editor-active) {{WRAPPER}},body:not(.elementor-editor-active) {{WRAPPER}} *' => 'cursor: url({{xpro_elementor_mouse_fx_cursor_image.URL}}),url({{xpro_elementor_mouse_fx_cursor_image.URL}}),auto;',
					),
					'condition'   => array(
						'xpro_elementor_mouse_fx'       => 'yes',
						'xpro_elementor_mouse_fx_hide!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_hide_effect',
				array(
					'label'        => __( 'Hide Trail', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'condition'    => array(
						'xpro_elementor_mouse_fx'       => 'yes',
						'xpro_elementor_mouse_fx_hide!' => 'yes',
					),
				)
			);

			if ( 'widget' === $element->get_type() ) {
				$element->add_control(
					'xpro_elementor_mouse_fx_magnetic_effect',
					array(
						'label'        => __( 'Magnetic Effect', 'xpro-elementor-addons-pro' ),
						'type'         => Controls_Manager::SWITCHER,
						'return_value' => 'yes',
						'condition'    => array(
							'xpro_elementor_mouse_fx' => 'yes',
						),
					)
				);

				$element->add_control(
					'xpro_elementor_mouse_fx_magnetic_threshold',
					array(
						'label'     => __( 'Magnetic Threshold', 'xpro-elementor-addons-pro' ),
						'type'      => Controls_Manager::SLIDER,
						'range'     => array(
							'px' => array(
								'min'  => 0,
								'max'  => 1,
								'step' => 0.1,
							),
						),
						'default'   => array(
							'size' => 0.3,
						),
						'condition' => array(
							'xpro_elementor_mouse_fx' => 'yes',
							'xpro_elementor_mouse_fx_magnetic_effect' => 'yes',
						),
					)
				);
			}

			$element->add_control(
				'xpro_elementor_mouse_fx_delay',
				array(
					'label'     => esc_html__( 'Motion Delay', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min'  => 0,
							'max'  => 5,
							'step' => 0.1,
						),
					),
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_color',
				array(
					'label'     => __( 'Text Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'separator' => 'before',
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_bg_color',
				array(
					'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_border_color',
				array(
					'label'     => __( 'Border Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_blend_mode',
				array(
					'type'        => Controls_Manager::SELECT,
					'label'       => esc_html__( 'Blend mode', 'xpro-elementor-addons-pro' ),
					'label_block' => false,
					'default'     => '',
					'options'     => array(
						''            => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
						'normal'      => esc_html__( 'Normal', 'xpro-elementor-addons-pro' ),
						'multiply'    => esc_html__( 'Multiply', 'xpro-elementor-addons-pro' ),
						'screen'      => esc_html__( 'Screen', 'xpro-elementor-addons-pro' ),
						'overlay'     => esc_html__( 'Overlay', 'xpro-elementor-addons-pro' ),
						'darken'      => esc_html__( 'Darken', 'xpro-elementor-addons-pro' ),
						'lighten'     => esc_html__( 'Lighten', 'xpro-elementor-addons-pro' ),
						'color-dodge' => esc_html__( 'Color Dodge', 'xpro-elementor-addons-pro' ),
						'color-burn'  => esc_html__( 'Color Burn', 'xpro-elementor-addons-pro' ),
						'hard-light'  => esc_html__( 'Hard Light', 'xpro-elementor-addons-pro' ),
						'soft-light'  => esc_html__( 'Soft Light', 'xpro-elementor-addons-pro' ),
						'difference'  => esc_html__( 'Difference', 'xpro-elementor-addons-pro' ),
						'exclusion'   => esc_html__( 'Exclusion', 'xpro-elementor-addons-pro' ),
						'hue'         => esc_html__( 'Hue', 'xpro-elementor-addons-pro' ),
						'saturation'  => esc_html__( 'Saturation', 'xpro-elementor-addons-pro' ),
						'color'       => esc_html__( 'Color', 'xpro-elementor-addons-pro' ),
						'luminosity'  => esc_html__( 'Luminosity', 'xpro-elementor-addons-pro' ),
					),
					'condition'   => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_size',
				array(
					'label'     => __( 'Size', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min' => 5,
							'max' => 100,
						),
					),
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_border_radius',
				array(
					'label'     => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min' => 0,
							'max' => 50,
						),
					),
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_opacity',
				array(
					'label'     => __( 'Opacity', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min'  => 0.1,
							'max'  => 1,
							'step' => 0.1,
						),
					),
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_text',
				array(
					'type'        => Controls_Manager::TEXT,
					'label'       => esc_html__( 'Text Inside', 'xpro-elementor-addons-pro' ),
					'label_block' => false,
					'separator'   => 'before',
					'condition'   => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_text_size',
				array(
					'label'      => esc_html__( 'Text Size (em)', 'xpro-elementor-addons-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => array(
						'px' => array(
							'min'  => 0.2,
							'max'  => 2,
							'step' => 0.1,
						),
					),
					'size_units' => array( 'px' ),
					'condition'  => array(
						'xpro_elementor_mouse_fx'       => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
						'xpro_elementor_mouse_fx_text!' => '',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_text_spin',
				array(
					'label'        => __( 'Text Spin', 'xpro-elementor-addons-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'condition'    => array(
						'xpro_elementor_mouse_fx'       => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
						'xpro_elementor_mouse_fx_text!' => '',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_icon',
				array(
					'type'                   => Controls_Manager::ICONS,
					'label'                  => esc_html__( 'Icon', 'xpro-elementor-addons-pro' ),
					'label_block'            => false,
					'exclude_inline_options' => array( 'svg' ),
					'skin'                   => 'inline',
					'condition'              => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_icon_size',
				array(
					'label'      => esc_html__( 'Icon Size (em)', 'xpro-elementor-addons-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => array(
						'px' => array(
							'min'  => 1,
							'max'  => 5,
							'step' => 0.1,
						),
					),
					'size_units' => array( 'px' ),
					'condition'  => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
						'xpro_elementor_mouse_fx_icon[value]!' => '',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_icon_color',
				array(
					'label'     => __( 'Icon Color', 'xpro-elementor-addons-pro' ),
					'type'      => Controls_Manager::COLOR,
					'alpha'     => false,
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
						'xpro_elementor_mouse_fx_icon[value]!' => '',
					),
				)
			);

			$element->add_control(
				'xpro_elementor_mouse_fx_bg_image',
				array(
					'type'      => Controls_Manager::MEDIA,
					'label'     => esc_html__( 'Background Image', 'xpro-elementor-addons-pro' ),
					'condition' => array(
						'xpro_elementor_mouse_fx' => 'yes',
						'xpro_elementor_mouse_fx_hide_effect!' => 'yes',
					),
				)
			);

			$element->end_controls_section();

		}

	}

	public static function save_global_values( $post_id ) {

		$document = Plugin::$instance->documents->get( $post_id, false );
		$settings = $document->get_settings();

		$global_settings = get_option( 'xpro_elementor_global_settings' );
		$options         = $global_settings ? $global_settings : array();

		$active_page_settings = isset( $global_settings['mouse_effect_global'] ) ? array_values( $global_settings['mouse_effect_global'] )[0] : false;

		if ( isset( $active_page_settings ) && false !== $active_page_settings && get_the_ID() !== $active_page_settings['post_id'] ) {
			return;
		}

		if ( 'yes' === $settings['xpro_elementor_mouse_dfx'] ) {

			// Global Settings
			if ( 'yes' === $settings['xpro_elementor_mouse_dfx_global'] ) {
				$options['mouse_effect_global'][ $post_id ]               = self::save_options( $settings );
				$options['mouse_effect_global'][ $post_id ]['post_id']    = get_the_ID();
				$options['mouse_effect_global'][ $post_id ]['display_on'] = $settings['xpro_elementor_mouse_dfx_display_on'];

				// Updating old settings if present
				if ( $options['mouse_effect'] ) {
					unset( $options['mouse_effect'] );
				}
			} else {

				$options['mouse_effect'][ $post_id ] = self::save_options( $settings );

				// Removing global values if disabled
				if ( isset( get_option( 'xpro_elementor_global_settings' )['mouse_effect_global'] ) && array_key_exists( $post_id, get_option( 'xpro_elementor_global_settings' )['mouse_effect_global'] ) ) {
					unset( $options['mouse_effect_global'] );
				}
			}
		} else {
			if ( isset( get_option( 'xpro_elementor_global_settings' )['mouse_effect'] ) && array_key_exists( $post_id, get_option( 'xpro_elementor_global_settings' )['mouse_effect'] ) ) {
				// removing the disabled Mouse Effect
				unset( $options['mouse_effect'][ $post_id ] );
			}
			if ( isset( get_option( 'xpro_elementor_global_settings' )['mouse_effect_global'] ) && array_key_exists( $post_id, get_option( 'xpro_elementor_global_settings' )['mouse_effect_global'] ) ) {
				unset( $options['mouse_effect_global'] );
			}
		}

		update_option( 'xpro_elementor_global_settings', $options );

	}

	public static function save_options( $settings ) {
		$fields                     = array();
		$fields['cursor_type']      = $settings['xpro_elementor_mouse_dfx_cursor'];
		$fields['cursor_image']     = $settings['xpro_elementor_mouse_dfx_cursor_image']['url'];
		$fields['delay']            = $settings['xpro_elementor_mouse_dfx_delay']['size'];
		$fields['color']            = $settings['xpro_elementor_mouse_dfx_color'];
		$fields['background_color'] = $settings['xpro_elementor_mouse_dfx_bg_color'];
		$fields['border_color']     = $settings['xpro_elementor_mouse_dfx_border_color'];
		$fields['blend_mode']       = $settings['xpro_elementor_mouse_dfx_blend_mode'];
		$fields['size']             = $settings['xpro_elementor_mouse_dfx_size']['size'];
		$fields['opacity']          = $settings['xpro_elementor_mouse_dfx_opacity']['size'];

		return $fields;
	}

	public static function add_data_to_elements( $element ) {
		if ( is_object( $element ) ) {
			$settings = $element->get_settings();

			if ( isset( $settings['xpro_elementor_mouse_fx'] ) && 'yes' === $settings['xpro_elementor_mouse_fx'] ) {
				$options = array();
			
				// Check if each key exists before accessing it
				$options['hide_effect']        = isset( $settings['xpro_elementor_mouse_fx_hide_effect'] ) ? $settings['xpro_elementor_mouse_fx_hide_effect'] : false;
				$options['magnetic_effect']    = ! empty( $settings['xpro_elementor_mouse_fx_magnetic_effect'] );
				$options['magnetic_threshold'] = isset( $settings['xpro_elementor_mouse_fx_magnetic_threshold']['size'] ) ? $settings['xpro_elementor_mouse_fx_magnetic_threshold']['size'] : 0.3; // Default value
				$options['delay']              = isset( $settings['xpro_elementor_mouse_fx_delay']['size'] ) ? $settings['xpro_elementor_mouse_fx_delay']['size'] : 0.5; // Default value
				$options['color']              = isset( $settings['xpro_elementor_mouse_fx_color'] ) ? self::hex_to_rgba( $settings['xpro_elementor_mouse_fx_color'], $settings['xpro_elementor_mouse_fx_opacity']['size'] ) : '';
				$options['background_color']   = isset( $settings['xpro_elementor_mouse_fx_bg_color'] ) ? self::hex_to_rgba( $settings['xpro_elementor_mouse_fx_bg_color'], $settings['xpro_elementor_mouse_fx_opacity']['size'] ) : '';
				$options['border_color']       = isset( $settings['xpro_elementor_mouse_fx_border_color'] ) ? self::hex_to_rgba( $settings['xpro_elementor_mouse_fx_border_color'], $settings['xpro_elementor_mouse_fx_opacity']['size'] ) : '';
				$options['size']               = isset( $settings['xpro_elementor_mouse_fx_size']['size'] ) ? $settings['xpro_elementor_mouse_fx_size']['size'] : 20; // Default value
				$options['border_radius']      = isset( $settings['xpro_elementor_mouse_fx_border_radius']['size'] ) ? $settings['xpro_elementor_mouse_fx_border_radius']['size'] : 0; // Default value
				$options['opacity']            = isset( $settings['xpro_elementor_mouse_fx_opacity']['size'] ) ? $settings['xpro_elementor_mouse_fx_opacity']['size'] : 0.5; // Default value
				$options['blend_mode']         = isset( $settings['xpro_elementor_mouse_fx_blend_mode'] ) ? $settings['xpro_elementor_mouse_fx_blend_mode'] : '';
				$options['text']               = isset( $settings['xpro_elementor_mouse_fx_text'] ) ? $settings['xpro_elementor_mouse_fx_text'] : '';
				$options['text_size']          = isset( $settings['xpro_elementor_mouse_fx_text_size']['size'] ) ? $settings['xpro_elementor_mouse_fx_text_size']['size'] : 1; // Default value
				$options['text_spin']          = isset( $settings['xpro_elementor_mouse_fx_text_spin'] ) ? $settings['xpro_elementor_mouse_fx_text_spin'] : false;
				$options['icon']               = isset( $settings['xpro_elementor_mouse_fx_icon']['value'] ) ? $settings['xpro_elementor_mouse_fx_icon']['value'] : '';
				$options['icon_size']          = isset( $settings['xpro_elementor_mouse_fx_icon_size']['size'] ) ? $settings['xpro_elementor_mouse_fx_icon_size']['size'] : 1; // Default value
				$options['icon_color']         = isset( $settings['xpro_elementor_mouse_fx_icon_color'] ) ? $settings['xpro_elementor_mouse_fx_icon_color'] : '';
				$options['background_image']   = isset( $settings['xpro_elementor_mouse_fx_bg_image']['url'] ) ? $settings['xpro_elementor_mouse_fx_bg_image']['url'] : '';
			
				$element->add_render_attribute(
					'_wrapper',
					array(
						'data-xpro-mouse-effect-settings' => wp_json_encode( $options ),
					)
				);
			}
		}
	}

	public static function hex_to_rgba( $hex, $opacity = 1 ) {
		if ( empty( $hex ) ) {
			return '';
		}
		if ( empty( $opacity ) ) {
			$opacity = 1;
		}
		list( $r, $g, $b ) = sscanf( $hex, '#%02x%02x%02x' );

		return sprintf( 'rgba(%s, %s, %s, %s)', $r, $g, $b, $opacity );
	}

	public static function add_inline_CSS() {

		$global_setting = get_option( 'xpro_elementor_global_settings' );
		$settings       = isset( $global_setting['mouse_effect_global'] ) ? array_values( $global_setting['mouse_effect_global'] )[0] : $global_setting['mouse_effect'][ get_the_ID() ];

		$custom_css = '';
		if ( 'hide' === $settings['cursor_type'] ) {
			$custom_css .= 'body, body *{ cursor:none; }';
		}
		if ( 'replace' === $settings['cursor_type'] && ! empty( $settings['cursor_image'] ) ) {
			$custom_css .= 'body, body *{ cursor: url(' . $settings['cursor_image'] . '),url(' . $settings['cursor_image'] . '),auto; }';
		}

		$cursor_css = '';

		if ( $settings['color'] ) {
			$cursor_css .= 'color:' . self::hex_to_rgba( $settings['color'], $settings['opacity'] ) . ';';
		}

		if ( $settings['background_color'] ) {
			$cursor_css .= 'background-color:' . self::hex_to_rgba( $settings['background_color'], $settings['opacity'] ) . ';';
		}

		if ( $settings['border_color'] ) {
			$cursor_css .= 'border-color:' . self::hex_to_rgba( $settings['border_color'], $settings['opacity'] ) . ';';
		}

		if ( $settings['blend_mode'] ) {
			$cursor_css .= 'mix-blend-mode:' . $settings['blend_mode'] . ';';
		}

		if ( $settings['size'] ) {
			$cursor_css .= '--mouse-effect-size:' . $settings['size'] . 'px;';
		}

		if ( $cursor_css ) {
			$custom_css .= 'body .xpro-mouse-cursor{' . $cursor_css . '}';
		}

		// 1. Remove comments.
		$custom_css = preg_replace( '#/\*.*?\*/#s', '', $custom_css );
		// 2. Remove whitespace.
		$custom_css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $custom_css );
		// 3. Remove starting whitespace.
		$custom_css = preg_replace( '/\s\s+(.*)/', '$1', $custom_css );

		wp_add_inline_style( 'xpro-elementor-addons-widgets', esc_attr( $custom_css ) );
	}

	public static function add_html_to_body() {

		$global_setting = get_option( 'xpro_elementor_global_settings' );
		$settings       = isset( $global_setting['mouse_effect_global'] ) ? array_values( $global_setting['mouse_effect_global'] )[0] : $global_setting['mouse_effect'][ get_the_ID() ];

		$html  = '<div class="xpro-mouse-cursor" data-delay="' . esc_attr( $settings['delay'] ) . '">';
		$html .= '</div>';

		$allowed_tags = array(
			'div' => array(
				'class'      => array(),
				'data-delay' => array(),
			)
		);

		echo wp_kses( $html, $allowed_tags );

	}

}

Xpro_Elementor_Mouse_Effect::init();
