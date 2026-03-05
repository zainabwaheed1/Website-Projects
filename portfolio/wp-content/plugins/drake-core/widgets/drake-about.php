<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakeabout Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakeabout_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'drakeabout';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Drake About Section', 'drake-core' );
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'drake' ];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        

        $this->start_controls_section(
            'section1',
            [
                'label' => esc_html__( 'Drake About Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'lar la-user', 'drake-core' ),
				'description'   => sprintf(
                    esc_html__( 'Paste  Line-Awesome Icon Class. For more icons, visit %s.', 'drake' ),
                    '<a href="https://icons8.com/line-awesome" target="_blank">line awesome</a>'),
            ]
        );

        $this->add_control(
            'title', [
                'label'         => esc_html__( 'Title', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'heading', [
                'label'         => esc_html__( 'Heading', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'des', [
                'label'         => esc_html__( 'Description', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::WYSIWYG,
                'label_block'   => true,
            ]
        );

        $this->end_controls_section();

        // TAB STYLE 

        //START

        $this->start_controls_section(
            'drakeabout_design_option',
            [
                'label'         => esc_html__( 'About Section Style','drake-core' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs'
        );


        $this->start_controls_tab(
            'style_normal_tab',
            [
               'label' => esc_html__( 'Title', 'drake-core' ),
            ]
        );

        $this->add_control(
            'about_title_color',
            [
                'label'         => esc_html__( 'Title Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .subtitle'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'about_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'about_title_margin',
            [
                'label'         => __( 'Title Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'about_title_padding',
            [
                'label'         => __( 'Title Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Heading', 'drake-core' ),
            ]
        );

        $this->add_control(
            'about_heading_color',
            [
                'label'         => esc_html__( 'Heading Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .section-header h2'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'about_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'about_heading_margin',
            [
                'label'         => __( 'Heading Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .section-header h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'about_heading_padding',
            [
                'label'         => __( 'Heading Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .section-header h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab1',
            [
                'label' => esc_html__( 'Description', 'drake-core' ),
            ]
        );

        $this->add_control(
            'about_description_color',
            [
                'label'         => esc_html__( 'Description Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .about-area .about-content p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'about_description_typography',
                'label'         => esc_html__( 'Description Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .about-area .about-content p',
            ]
        );

        $this->add_responsive_control(
            'about_description_margin',
            [
                'label'         => __( ' Description Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .about-area .about-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'about_description_padding',
            [
                'label'         => __( ' Description Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .about-area .about-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        //END
        $this->end_controls_tabs();
        $this->end_controls_section();

}

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $drakeabout_output = $this->get_settings_for_display(); ?>

        <section class="about-area">
                    <div class="custom-container">
                        <div class="about-content content-width">
                            <div class="section-header">
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakeabout_output['icon_class']);?>"></i> <?php echo esc_html($drakeabout_output['title']); ?>
                                </h4>
                                <h2 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakeabout_output['heading']); ?></span></h2>
                            </div>
                            <p class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakeabout_output['des']); ?></p>
                        </div>
                    </div>
                </section>

    <?php }
}