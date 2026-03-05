<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakeservices Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakeservices_Widget extends \Elementor\Widget_Base {

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
        return 'drakeservices';
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
        return esc_html__( 'Drake Services Section', 'drake-core' );
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
                'label' => esc_html__( 'Drake Services Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'las la-stream', 'drake-core' ),
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'iclass',
            [
                'label'         => esc_html__( 'Icon Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
				'description'   => sprintf(
                    esc_html__( 'Paste  Line-Awesome Icon Class. For more icons, visit %s.', 'drake' ),
                    '<a href="https://icons8.com/line-awesome" target="_blank">line awesome</a>'),
            ]
        );

        $repeater->add_control(
            'stitle',
            [
                'label'         => esc_html__( 'Service Title','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'sdes',
            [
                'label'         => esc_html__( 'Service Description','drake-core' ),
                'type'          => \Elementor\Controls_Manager::WYSIWYG,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'scounttitle',
            [
                'label'         => esc_html__( 'Service Count','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'list1',
            [
                'label'     => esc_html__( 'List', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'list_title' => esc_html__( 'Add List', 'drake-core' ),
                    ],
                ],
                'title_field' => '{{{ stitle }}}',
            ]
        );

        $this->end_controls_section();

        // TAB STYLE--1

        //START

        $this->start_controls_section(
            'drakeservices_design_option',
            [
                'label'         => esc_html__( 'Services Section Style','drake-core' ),
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
            'services_title_color',
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
                'name'          => 'services_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'services_title_margin',
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
            'services_title_padding',
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
            'services_heading_color',
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
                'name'          => 'services_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'services_heading_margin',
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
            'services_heading_padding',
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

        //END
        $this->end_controls_tabs();
        $this->end_controls_section();

        // TAB STYLE --2

        //START

        $this->start_controls_section(
            'drakeserviceslist_design_option',
            [
                'label'         => esc_html__( 'Services List Section Style','drake-core' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs_list'
        );


        $this->start_controls_tab(
            'style_normal_tab_list',
            [
               'label' => esc_html__( 'Title', 'drake-core' ),
            ]
        );

        $this->add_control(
            'serviceslist_title_color',
            [
                'label'         => esc_html__( 'Title Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item h3'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'serviceslist_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .services-items .service-item h3',
            ]
        );

        $this->add_responsive_control(
            'serviceslist_title_margin',
            [
                'label'         => __( 'Title Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'serviceslist_title_padding',
            [
                'label'         => __( 'Title Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list',
            [
                'label' => esc_html__( 'Description', 'drake-core' ),
            ]
        );

        $this->add_control(
            'serviceslist_description_color',
            [
                'label'         => esc_html__( 'Description Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'serviceslist_description_typography',
                'label'         => esc_html__( 'Description Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .services-items .service-item p',
            ]
        );

        $this->add_responsive_control(
            'serviceslist_description_margin',
            [
                'label'         => __( 'Description Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'serviceslist_description_padding',
            [
                'label'         => __( 'Description Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list2',
            [
                'label' => esc_html__( 'Count', 'drake-core' ),
            ]
        );

        $this->add_control(
            'serviceslist_count_color',
            [
                'label'         => esc_html__( 'Count Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item .projects'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'serviceslist_count_typography',
                'label'         => esc_html__( 'Count Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .services-items .service-item .projects',
            ]
        );

        $this->add_responsive_control(
            'serviceslist_count_margin',
            [
                'label'         => __( 'Count Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item .projects' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'serviceslist_count_padding',
            [
                'label'         => __( 'Count Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .services-items .service-item .projects' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $drakeservices_output = $this->get_settings_for_display(); ?>

        <section class="services-area">
                    <div class="custom-container">
                        <div class="services-content content-width">
                            <div class="section-header">
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakeservices_output['icon_class']);?>"></i> <?php echo esc_html($drakeservices_output['title']); ?>
                                </h4>
                                <h2 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakeservices_output['heading']); ?></span></h2>
                            </div>
        
                            <div class="services-items">
                                <?php if(!empty($drakeservices_output['list1'])):
        foreach ($drakeservices_output['list1'] as $drakeservices_loop):?>
                                <div class="service-item scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakeservices_loop['iclass']);?>"></i>
                                    <h3><?php echo esc_html($drakeservices_loop['stitle']); ?></h3>
                                    <p><?php echo ($drakeservices_loop['sdes']); ?></p>
                                    <span class="projects"><?php echo esc_html($drakeservices_loop['scounttitle']); ?></span>
                                </div><?php endforeach; endif;?>
                            </div>
        
                        </div>
                    </div>
                </section>

    <?php }
}