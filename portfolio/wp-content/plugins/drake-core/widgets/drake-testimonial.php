<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake draketestimonial Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_draketestimonial_Widget extends \Elementor\Widget_Base {

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
        return 'draketestimonial';
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
        return esc_html__( 'Drake Testimonial Section', 'drake-core' );
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
                'label' => esc_html__( 'Drake Testimonial Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'lar la-comment', 'drake-core' ),
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
            'secid',
            [
                'label'         => esc_html__( 'Section ID','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'imglink',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'review',
            [
                'label'         => esc_html__( 'Review','drake-core' ),
                'type'          => \Elementor\Controls_Manager::WYSIWYG,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'ntitle',
            [
                'label'         => esc_html__( 'Name','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'position',
            [
                'label'         => esc_html__( 'Position','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'company',
            [
                'label'         => esc_html__( 'Company','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'ptitle',
            [
                'label'         => esc_html__( 'Project Title','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );
		
		// LINK
        $repeater->add_control(
            'ptitlelink',
            [
                'label'         => esc_html__( 'Project Title Link', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__( '', 'drake-core' ),
                'show_external' => true,
                'default'       => [
                    'url'           => '#',
                    'is_external'   => true,
                    'nofollow'      => true,
                ],
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
                'title_field' => '{{{ ntitle }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section2',
            [
                'label' => esc_html__( 'Drake Clients Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ctitle', [
                'label'         => esc_html__( 'Title', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        // clients 

        $this->add_control(
            'aclass1',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink1',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients 

        $this->add_control(
            'aclass2',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink2',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients 

        $this->add_control(
            'aclass3',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink3',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients 

        $this->add_control(
            'aclass4',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink4',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients 

        $this->add_control(
            'aclass5',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink5',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients

        $this->add_control(
            'imglink6',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients 

        $this->add_control(
            'aclass7',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink7',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // clients 

        $this->add_control(
            'aclass8',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'imglink8',
            [
                'label'     => esc_html__( 'Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // TAB STYLE 

        //START

        $this->start_controls_section(
            'draketestimonial_design_option',
            [
                'label'         => esc_html__( 'Testimonial Section Style','drake-core' ),
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
            'testimonial_title_color',
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
                'name'          => 'testimonial_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'testimonial_title_margin',
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
            'testimonial_title_padding',
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
            'testimonial_heading_color',
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
                'name'          => 'testimonial_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'testimonial_heading_margin',
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
            'testimonial_heading_padding',
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
            'draketestimoniallist_design_option',
            [
                'label'         => esc_html__( 'Testimonial List Section Style','drake-core' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs_list'
        );

        $this->start_controls_tab(
            'style_normal_tab_list',
            [
               'label' => esc_html__( 'Review', 'drake-core' ),
            ]
        );

        $this->add_control(
            'testimonillist_review_color',
            [
                'label'         => esc_html__( 'Review Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner > p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'testimonillist_review_typography',
                'label'         => esc_html__( 'Review Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}}.testimonial-item .testimonial-item-inner > p',
            ]
        );

        $this->add_responsive_control(
            'testimonillist_review_margin',
            [
                'label'         => __( 'Review Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_review_padding',
            [
                'label'         => __( 'Review Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner > p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list',
            [
                'label' => esc_html__( 'Name', 'drake-core' ),
            ]
        );

        $this->add_control(
            'testimoniallist_name_color',
            [
                'label'         => esc_html__( 'Name Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author h3'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'testimoniallist_name_typography',
                'label'         => esc_html__( 'Name Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author h3',
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_name_margin',
            [
                'label'         => __( 'Name Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_name_padding',
            [
                'label'         => __( 'Name Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list2',
            [
                'label' => esc_html__( 'Position', 'drake-core' ),
            ]
        );

        $this->add_control(
            'testimoniallist_position_color',
            [
                'label'         => esc_html__( 'Position Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'testimoniallist_position_typography',
                'label'         => esc_html__( 'Position Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p',
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_position_margin',
            [
                'label'         => __( 'Position Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_position_padding',
            [
                'label'         => __( 'Position Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list_company',
            [
                'label' => esc_html__( 'Company', 'drake-core' ),
            ]
        );

        $this->add_control(
            'testimoniallist_company_color',
            [
                'label'         => esc_html__( 'Company Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p span'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'testimoniallist_company_typography',
                'label'         => esc_html__( 'Company Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p span',
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_company_margin',
            [
                'label'         => __( 'Company Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_company_padding',
            [
                'label'         => __( 'Company Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .author p span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list_projtit',
            [
                'label' => esc_html__( 'Project Title', 'drake-core' ),
            ]
        );

        $this->add_control(
            'testimoniallist_project_color',
            [
                'label'         => esc_html__( 'Project Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .project-btn'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'testimoniallist_project_typography',
                'label'         => esc_html__( 'Project Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .project-btn',
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_project_margin',
            [
                'label'         => __( 'Project Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .project-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimoniallist_project_padding',
            [
                'label'         => __( 'Project Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-item .testimonial-item-inner .project-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $draketestimonial_output = $this->get_settings_for_display(); ?>

        <section class="testimonial-area">
                    <div class="custom-container">
                        <div class="testimonial-content content-width">
                            <div class="section-header">
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($draketestimonial_output['icon_class']);?>"></i> <?php echo esc_html($draketestimonial_output['title']); ?>
                                </h4>
                                <h2 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($draketestimonial_output['heading']); ?></h2>
                            </div>
        
                            <div class="testimonial-slider-wrap scroll-animation" data-animation="fade_from_bottom">
                                <div class="owl-carousel testimonial-slider owl-theme">
                                    <?php if(!empty($draketestimonial_output['list1'])):
        foreach ($draketestimonial_output['list1'] as $draketestimonial_loop):?>
                                    <div class="testimonial-item">
                                        <div class="testimonial-item-inner">
                                            <div class="author d-flex align-items-center">
                                                <img src="<?php echo esc_url($draketestimonial_loop['imglink']['url']); ?>" alt="portfolio">
                                                <div class="right">
                                                    <h3><?php echo esc_html($draketestimonial_loop['ntitle']); ?></h3>
                                                    <p class="designation"><?php echo esc_html($draketestimonial_loop['position']); ?> <span><?php echo esc_html($draketestimonial_loop['company']); ?></span></p>
                                                </div>
                                            </div>
                                            <p><?php echo ($draketestimonial_loop['review']); ?></p>
        
                                            <a href="<?php echo esc_url($draketestimonial_loop['ptitlelink']['url']); ?>" class="project-btn"><?php echo esc_html($draketestimonial_loop['ptitle']); ?></a>
                                        </div>
                                    </div><?php endforeach; endif;?>
</div>
                                <div class="testimonial-footer-nav">
                                    <div class="testimonial-nav d-flex align-items-center">
                                        <button class="prev"><i class="las la-angle-left"></i></button>
                                        <div id="testimonial-slide-count"></div>
                                        <button class="next"><i class="las la-angle-right"></i></button>
                                    </div>
                                </div>
                            </div>

<div class="clients-logos">
<h4 class="scroll-animation" data-animation="fade_from_bottom"><?php echo esc_html($draketestimonial_output['ctitle']); ?></h4>
<div class="row align-items-center">
                                    <?php if(!empty($draketestimonial_output['aclass1'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass1']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink1']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass2'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass2']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink2']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass3'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass3']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink3']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass4'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass4']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink4']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass5'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass5']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink5']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass6'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass6']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink6']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass7'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass7']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink7']['id'], 'full' ));?>" >
                                    </div><?php endif;?>
                                    <?php if(!empty($draketestimonial_output['aclass8'] )): ?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($draketestimonial_output['aclass8']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $draketestimonial_output['imglink8']['id'], 'full' ));?>" >
                                    </div><?php endif;?>

                                </div>
                            </div>
        
                        </div>
                    </div>
                </section>

    <?php }
}