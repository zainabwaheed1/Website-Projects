<?php

namespace XproElementorAddonsPro\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use XproElementorAddons\Control\Xpro_Group_Control_Foreground;
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
class Source_Code extends Widget_Base {

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
		return 'xpro-source-code';
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
		return __( 'Source Code', 'xpro-elementor-addons-pro' );
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
		return 'eicon-code xpro-widget-pro-label';
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
		return array( 'source', 'code', 'source-code' );
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

		return array( 'prism' );

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

		return array( 'prism' );

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
			'section_source_code',
			array(
				'label' => __( 'Source Code', 'xpro-elementor-addons-pro' ),
			)
		);

		$this->add_control(
			'language_type',
			array(
				'label'       => __( 'Language Type', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'     => 'markup',
				'options'     => array(
					'markup'            => 'HTML markup',
					'clike'             => 'C-like',
					'css'               => 'CSS',
					'sass'              => 'Sass',
					'scss'              => 'Scss',
					'less'              => 'Less',
					'javascript'        => 'Javascript',
					'php'               => 'PHP',
					'phpdoc'            => 'PHP DOC',
					'py'                => 'Python',
					'c'                 => 'C ',
					'cpp'               => 'C++ ',
					'csharp'            => 'C# ',
					'aspnet'            => 'Asp.net (C#) ',
					'django'            => 'Django ',
					'git'               => 'Git ',
					'gml'               => 'GameMaker language ',
					'go'                => 'Go ',
					'java'              => 'Java ',
					'javadoc'           => 'Java Doc',
					'json'              => 'JSON',
					'jsonp'             => 'JSONP',
					'kotlin'            => 'Kotlin',
					'markup-templating' => 'Markup templating',
					'nginx'             => 'nginx',
					'perl'              => 'Perl',
					'jsx'               => 'React JSX',
					'rb'                => 'Ruby',
					'sql'               => 'SQL',
					'swift'             => 'Swift',
					'vbnet'             => 'VB.Net',
					'vb'                => 'Visual Basic',
				),
			)
		);

		$this->add_control(
			'source_code_theme',
			array(
				'label'          => esc_html__( 'Theme', 'xpro-elementor-addons-pro' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'prism',
				'options'        => array(
					'prism'                => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
					'prism-coy'            => esc_html__( 'Coy', 'xpro-elementor-addons-pro' ),
					'prism-dark'           => esc_html__( 'Dark', 'xpro-elementor-addons-pro' ),
					'prism-funky'          => esc_html__( 'Funky', 'xpro-elementor-addons-pro' ),
					'prism-okaidia'        => esc_html__( 'Okaidia', 'xpro-elementor-addons-pro' ),
					'prism-solarizedlight' => esc_html__( 'Solarized light', 'xpro-elementor-addons-pro' ),
					'prism-tomorrow'       => esc_html__( 'Tomorrow', 'xpro-elementor-addons-pro' ),
					'prism-twilight'       => esc_html__( 'Twilight', 'xpro-elementor-addons-pro' ),
				),
				'style_transfer' => true,
			)
		);

		$this->add_control(
			'source_code',
			array(
				'label'       => esc_html__( 'Source Code', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::CODE,
				'rows'        => 10,
				'default'     => '<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8">
<title>Document</title>
</head>
	<body>
		<h1>Hello World!</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
	</body>
</html>',
				'placeholder' => __( 'Type your code here', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'language_type!' => '',
				),
			)
		);

		$this->add_control(
			'copy_btn_text_show',
			array(
				'label'        => esc_html__( 'Copy Button Text Show?', 'xpro-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'xpro-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'Hide', 'xpro-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'copy_btn_text',
			array(
				'label'       => __( 'Copy Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'rows'        => 10,
				'default'     => __( 'Copy to clipboard', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Copy Button Text', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'copy_btn_text_show' => 'yes',
				),
			)
		);

		$this->add_control(
			'after_copy_btn_text',
			array(
				'label'       => __( 'After Copy Button Text', 'xpro-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'rows'        => 10,
				'default'     => __( 'Copied', 'xpro-elementor-addons-pro' ),
				'placeholder' => __( 'Copied', 'xpro-elementor-addons-pro' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'copy_btn_text_show' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//General Style
		$this->start_controls_section(
			'section_source_code_style',
			array(
				'label' => __( 'General', 'xpro-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'source_code_height',
			array(
				'label'      => __( 'Height', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-source-code-wrapper .xpro-source-code > pre' => 'max-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'source_background',
				'label' => esc_html__( 'Background', 'xpro-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .xpro-source-code.prism > pre',
				'condition' => [
					'source_code_theme' => 'prism'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'source_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-source-code.prism > pre,{{WRAPPER}} .xpro-source-code.prism-coy pre > code,{{WRAPPER}} .xpro-source-code.prism-dark > pre,{{WRAPPER}} .xpro-source-code.prism-funky > pre,{{WRAPPER}} .xpro-source-code.prism-solarizedlight > pre,{{WRAPPER}} .xpro-source-code.prism-tomorrow > pre,{{WRAPPER}} .xpro-source-code.prism-twilight > pre',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'source_border',
				'label'    => __( 'Border', 'xpro-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .xpro-source-code.prism > pre,{{WRAPPER}} .xpro-source-code.prism-coy pre > code,{{WRAPPER}} .xpro-source-code.prism-dark > pre,{{WRAPPER}} .xpro-source-code.prism-funky > pre,{{WRAPPER}} .xpro-source-code.prism-solarizedlight > pre,{{WRAPPER}} .xpro-source-code.prism-tomorrow > pre,{{WRAPPER}} .xpro-source-code.prism-twilight > pre',
			)
		);

		$this->add_responsive_control(
			'source_border_radius',
			array(
				'label'      => __( 'Border Radius', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-source-code-wrapper .xpro-source-code > pre[class*="language-"],
					{{WRAPPER}} .xpro-source-code.prism > pre,
					{{WRAPPER}} .xpro-source-code.prism-coy pre > code,
					{{WRAPPER}} .xpro-source-code.prism-dark > pre,
					{{WRAPPER}} .xpro-source-code.prism-funky > pre,
					{{WRAPPER}} .xpro-source-code.prism-solarizedlight > pre,
					{{WRAPPER}} .xpro-source-code.prism-tomorrow > pre,
					{{WRAPPER}} .xpro-source-code.prism-twilight > pre' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'source_code_box_padding',
			array(
				'label'      => __( 'Padding', 'xpro-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .xpro-source-code.prism > pre,
					{{WRAPPER}} .xpro-source-code.prism-coy pre > code,
					{{WRAPPER}} .xpro-source-code.prism-dark > pre,
					{{WRAPPER}} .xpro-source-code.prism-funky > pre,
					{{WRAPPER}} .xpro-source-code.prism-solarizedlight > pre,
					{{WRAPPER}} .xpro-source-code.prism-tomorrow > pre,
					{{WRAPPER}} .xpro-source-code.prism-twilight > pre' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'source_code_box_margin',
			array(
				'label'      => __( 'Margin', 'xpro-elementor-addons-pro' ),
				'size_units' => array( 'px', '%', 'em' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'selectors'  => array(
					'{{WRAPPER}} .xpro-source-code-wrapper .xpro-source-code > pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'copy_btn_options',
			array(
				'label'     => esc_html__( 'Button', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'copy_btn_text_show' => 'yes',
				),
			)
		);

		$this->add_control(
			'copy_btn_color',
			array(
				'label'     => __( 'Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-source-code-btn' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'copy_btn_text_show' => 'yes',
				),
			)
		);

		$this->add_control(
			'copy_btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'xpro-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .xpro-source-code-btn' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'copy_btn_text_show' => 'yes',
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

		require XPRO_ELEMENTOR_ADDONS_PRO_WIDGET . 'source-code/layout/frontend.php';

	}

}
