<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // Exit if accessed directly

class Post_Comments extends Widget_Base {

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
		return 'xpro-post-comments';
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
		return __( 'Post Comments', 'xpro-elementor-addons-pro' );
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
		return 'xi-printer xpro-widget-pro-label';
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
		return array( 'xpro-themer' );
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
		return array( 'comments', 'post', 'response', 'form' );
	}

	public function render() {

		$settings = $this->get_settings_for_display();

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'post-comments/layout/frontend.php';

	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Comments', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'_skin',
			array(
				'type' => Controls_Manager::HIDDEN,
			)
		);

		$this->add_control(
			'skin_temp',
			array(
				'label'   => __( 'Notice', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'warning',
				'options' => array(
					'info'    => __( 'Info', 'xpro-elementor-addons-pro' ),
					'danger'  => __( 'Danger', 'xpro-elementor-addons-pro' ),
					'success' => __( 'Success', 'xpro-elementor-addons-pro' ),
					'warning' => __( 'Warning', 'xpro-elementor-addons-pro' ),
				),
			)
		);

		$this->end_controls_section();
	}
}
