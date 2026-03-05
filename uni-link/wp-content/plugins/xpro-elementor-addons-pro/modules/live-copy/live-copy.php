<?php
/**
 * Live Copy extension class.
 *
 * @package XproELementorAddonsPro
 */

namespace XproElementorAddonsPro\Module;

use Elementor\Controls_Stack;
use Elementor\Core\Common\Modules\Ajax\Module;
use Elementor\Utils;
use Exception;

class Xpro_Elementor_Live_Copy {

	private $elementor;

	public function __construct() {
		add_action( 'elementor/ajax/register_actions', array( $this, 'register_ajax_actions' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'live_copy_enqueue' ) );
	}

	public function live_copy_enqueue() {

		wp_enqueue_script(
			'xpro-live-copy',
			XPRO_ELEMENTOR_ADDONS_PRO_DIR_URL . 'modules/live-copy/js/live-copy.js',
			array(
				'jquery',
				'elementor-editor',
			),
			XPRO_ELEMENTOR_ADDONS_PRO_VERSION,
			true
		);

		wp_localize_script(
			'xpro-live-copy',
			'xpro_elementor_live_copy',
			array(
				'ajaxurl'  => admin_url( 'admin-ajax.php' ),
				'adminurl' => admin_url( 'admin.php' ),
				'message'  => array(
					'copy'        => esc_html__( 'Copied successfully!', 'xpro-elementor-addons-pro' ),
					'import_wait' => esc_html__( 'Processing... Please wait!', 'xpro-elementor-addons-pro' ),
					'paste'       => esc_html__( 'Pasted successfully!', 'xpro-elementor-addons-pro' ),
					'error'       => esc_html__( 'Something went wrong!', 'xpro-elementor-addons-pro' ),
					'empty_copy'  => esc_html__( 'No copied data found!', 'xpro-elementor-addons-pro' ),
					'storage_key' => 'xpro-live-copy-key',
				),
			)
		);
	}

	/**
	 * Register action methods from elementor ajax request hooks
	 *
	 * @return void
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function register_ajax_actions( Module $ajax ) {
		$ajax->register_ajax_action(
			'xpro_elementor_copy_paste',
			function ( array $data ) {

				if ( ! current_user_can( 'edit_posts' ) ) {
					throw new Exception( __( 'Access denied [Live Copy]', 'xpro-elementor-addons-pro' ) );
				} elseif ( ! isset( $data['type'] ) || 'single' !== $data['type'] ) {
					throw new Exception( __( 'Invalid type [Live Copy]', 'xpro-elementor-addons-pro' ) );
				} elseif ( ! isset( $data['template'] ) || empty( $data['template'] ) ) {
					throw new Exception( __( 'Data not found [Live Copy]', 'xpro-elementor-addons-pro' ) );
				}

				$this->prepare_copy_paste_data( $data['template'] );
			}
		);
	}

	/**
	 * Process element object data by importing necessary media content in current server
	 *
	 * @return void
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function prepare_copy_paste_data( $data ) {
		if ( is_string( $data ) ) {
			$data = json_decode( $data, true );
		}

		// Enable additional file-mime support
		add_filter( 'upload_mimes', array( $this, 'additional_file_support' ) );

		$content = $this->replace_elements_ids( $data );
		$content = $this->process_import_content( $content, 'on_import' );

		// Disable additional file-mime support
		remove_filter( 'upload_mimes', array( $this, 'additional_file_support' ) );

		return $content;
	}

	/**
	 * Replace elements IDs.
	 *
	 * For any given Elementor content/data, replace the IDs with new randomly
	 * generated IDs.
	 *
	 * @param array $content Any type of Elementor data.
	 *
	 * @return mixed Iterated data.
	 * @since 0.1.8
	 * @access protected
	 *
	 */
	protected function replace_elements_ids( $content ) {
		return $this->elementor->db->iterate_data(
			$content,
			function ( $element ) {
				$element['id'] = Utils::generate_random_string();

				return $element;
			}
		);
	}

	/**
	 * Process content for import.
	 *
	 * Process the content and all the inner elements, and prepare all the
	 * elements data for import.
	 *
	 * @param array $content A set of elements.
	 * @param string $method Accepts `on_import` to import data.
	 *
	 * @return mixed Processed content data.
	 * @since 0.1.8
	 * @access protected
	 *
	 */
	protected function process_import_content( $content, $method ) {
		return $this->elementor->db->iterate_data(
			$content,
			function ( $element_data ) use ( $method ) {
				$element = $this->elementor->elements_manager->create_element_instance( $element_data );

				// If the widget/element isn't exist, like a plugin that creates a widget but deactivated
				if ( ! $element ) {
					return null;
				}

				return $this->process_element_import_content( $element, $method );
			}
		);
	}

	/**
	 * Process single element content for import.
	 *
	 * Process any given element and prepare the element data for import.
	 *
	 * @param Controls_Stack $element
	 * @param string $method
	 *
	 * @return array Processed element data.
	 * @since 0.1.8
	 * @access protected
	 *
	 */
	protected function process_element_import_content( Controls_Stack $element, $method ) {
		$element_data = $element->get_data();

		if ( method_exists( $element, $method ) ) {
			// TODO: Use the internal element data without parameters.
			$element_data = $element->{$method}( $element_data );
		}

		foreach ( $element->get_controls() as $control ) {
			$control_class = $this->elementor->controls_manager->get_control( $control['type'] );

			// If the control isn't exist, like a plugin that creates the control but deactivated.
			if ( ! $control_class ) {
				return $element_data;
			}

			if ( method_exists( $control_class, $method ) ) {
				$element_data['settings'][ $control['name'] ] = $control_class->{$method}( $element->get_settings( $control['name'] ), $control );
			}
		}

		return $element_data;
	}

	/**
	 * Add additional file support with existing mime-support array
	 *
	 * @param [array] $mimes
	 *
	 * @return array
	 * @since 0.1.8
	 * @access public
	 *
	 */
	public function additional_file_support( $mimes = array() ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		$mimes['pdf']  = 'application/pdf';

		return $mimes;
	}

}

new Xpro_Elementor_Live_Copy();
