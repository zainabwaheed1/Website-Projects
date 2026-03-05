<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
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
class Calendly extends Widget_Base {

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
		return 'xpro-calendly';
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
		return __( 'Calendly', 'xpro-elementor-addons-pro' );
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
		return 'xi-calander-3 xpro-widget-pro-label';
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
		return array( 'calendly', 'calender', 'meeting', 'schedule' );
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

		//Button Primary
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'calendly_username',
			array(
				'label'       => __( 'Username', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'xproaddons',
				'placeholder' => __( 'Type calendly username here', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'calendly_time',
			array(
				'label'   => __( 'Time Slot', 'xpro-elementor-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'15min' => __( '15 Minutes', 'xpro-elementor-addons-pro' ),
					'30min' => __( '30 Minutes', 'xpro-elementor-addons-pro' ),
					'60min' => __( '60 Minutes', 'xpro-elementor-addons-pro' ),
					''      => __( 'All', 'xpro-elementor-addons-pro' ),
				),
				'default' => '30min',
			)
		);

		$this->add_control(
			'event_type_details',
			array(
				'label'        => __( 'Hide Event Type Details', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'xpro-elementor-addons-pro' ),
				'label_off'    => __( 'no', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '650',
				),
				'selectors'  => array(
					'{{WRAPPER}} .calendly-inline-widget' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .calendly-wrapper'       => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => __( 'Calendly', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'calendly_pro_notice',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					__( 'The following color customization controls only work with %1$s.', 'xpro-elementor-addons-pro' ),
					'<a href="https://calendly.com/pages/pricing" target="_blank">Calendly Pro plan</a>'
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label' => __( 'Text Color', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::COLOR,
				'alpha' => false,
			)
		);

		$this->add_control(
			'button_link_color',
			array(
				'label' => __( 'Button & Link Color', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label' => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'  => Controls_Manager::COLOR,
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

		$settings      = $this->get_settings_for_display();
		$calendly_time = '' !== $settings['calendly_time'] ? "/{$settings['calendly_time']}" : '';
		$class         = '';
		$class        .= ( 'yes' === $settings['event_type_details'] ) ? 'hide_event_type_details=1' : '';
		$class        .= ( $settings['text_color'] ) ? '&text_color=' . str_replace( '#', '', $settings['text_color'] ) : '';
		$class        .= ( $settings['button_link_color'] ) ? '&primary_color=' . str_replace( '#', '', $settings['button_link_color'] ) : '';
		$class        .= ( $settings['background_color'] ) ? '&background_color=' . str_replace( '#', '', $settings['background_color'] ) : '';

		?>
		<?php if ( $settings['calendly_username'] ) : ?>
			<div class="calendly-inline-widget" data-url="https://calendly.com/<?php echo esc_attr( $settings['calendly_username'] ); ?><?php echo esc_attr( $calendly_time ); ?>/?<?php echo esc_attr( $class ); ?>" style="min-width:320px;"></div>
			<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
			<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
				<div class="calendly-wrapper" style="width:100%; position:absolute; top:0; left:0; z-index:100;"></div>
			<?php endif; ?>
		<?php endif; ?>
		<?php

	}

}
