<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Plugin;
use ParseError;
use Throwable;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Custom_PHP extends Tag {

	public function get_name() {
		return 'xpro-custom-php';
	}

	public function get_title() {
		return __( 'Custom PHP', 'xpro-elementor-addons-pro' );
	}

	public function get_group() {
		return 'xpro-dynamic-tags';
	}

	public function get_categories() {
		return array(
			Module::BASE_GROUP,
			Module::TEXT_CATEGORY,
			Module::URL_CATEGORY,
			Module::NUMBER_CATEGORY,
			Module::POST_META_CATEGORY,
			Module::GALLERY_CATEGORY,
			Module::MEDIA_CATEGORY,
			Module::IMAGE_CATEGORY,
			Module::COLOR_CATEGORY,
		);
	}

	public static function can_register_unsafe_controls() {
		if ( current_user_can( 'administrator' ) ) {
			return true;
		}
		if ( Plugin::$instance->editor->is_edit_mode() ) {
			return false;
		}
		if ( 'elementor_ajax' === ( $_REQUEST['action'] ?? '' ) ) {
			return false;
		}

		return true;
	}

	protected function register_controls() {

		if ( ! $this->can_register_unsafe_controls() ) {
			$this->add_control(
				'html_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => __( 'You will need administrator capabilities to edit this widget.', 'xpro-elementor-addons-pro' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				)
			);
		} else {
			$this->add_control(
				'custom_php',
				array(
					'label'      => __( 'Custom PHP', 'xpro-elementor-addons-pro' ),
					'type'       => Controls_Manager::CODE,
					'show_label' => false,
					'language'   => 'php',
					'default'    => 'echo "Hello World!";',
				)
			);
		}
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		$this->eval_php( $settings['custom_php'] ?? '', true );
	}

	/**
	 * @param string $code
	 * @param bool $echo_error
	 *
	 * @return string
	 */
	public function eval_php( $code, $echo_error = false ) {
		if ( ! $this->can_register_unsafe_controls() ) {
			return '';
		}
		$error  = false;
		$result = null;
		try {
			$result = @eval( $code ); // phpcs:ignore
		} catch ( ParseError | Throwable $e ) {
			$error = $e->getMessage();
		}
		if ( $error && current_user_can( 'administrator' ) ) {
			$msg  = '<div class="xpro-alert xpro-alert-danger">';
			$msg .= '<strong>';
			$msg .= __( 'Please check your PHP code', 'xpro-elementor-addons-pro' );
			$msg .= '</strong><br />';
			$msg .= __( 'ERROR', 'xpro-elementor-addons-pro' ) . ': ' . $error . "\n";
			$msg .= '</div>';
			if ( $echo_error ) {
				echo wp_kses_post( $msg );
				return '';
			} else {
				return $msg;
			}
		} else {
			return $result;
		}
	}

}
