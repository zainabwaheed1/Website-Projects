<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakeresume Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakeresume_Widget extends \Elementor\Widget_Base {

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
        return 'drakeresume';
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
        return esc_html__( 'Drake Resume Start Section', 'drake-core' );
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
                'label' => esc_html__( 'Drake Resume Start Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'las la-briefcase', 'drake-core' ),
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
            'timeline',
            [
                'label'         => esc_html__( 'Timeline','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        // 1

        $repeater->add_control(
            'd1',
            [
                'label'         => esc_html__( 'Designation Title 1','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'c1',
            [
                'label'         => esc_html__( 'Company Title 1','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        // 2

        $repeater->add_control(
            'd2',
            [
                'label'         => esc_html__( 'Designation Title 2','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'c2',
            [
                'label'         => esc_html__( 'Company Title 2','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        // 3

        $repeater->add_control(
            'd3',
            [
                'label'         => esc_html__( 'Designation Title 3','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'c3',
            [
                'label'         => esc_html__( 'Company Title 3','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        // 4

        $repeater->add_control(
            'd4',
            [
                'label'         => esc_html__( 'Designation Title 4','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'c4',
            [
                'label'         => esc_html__( 'Company Title 4','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        // 5

        $repeater->add_control(
            'd5',
            [
                'label'         => esc_html__( 'Designation Title 5','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'c5',
            [
                'label'         => esc_html__( 'Company Title 5','drake-core' ),
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
                'title_field' => '{{{ timeline }}}',
            ]
        );

        $this->end_controls_section();

        // TAB STYLE 

        //START

        $this->start_controls_section(
            'drakeresume_design_option',
            [
                'label'         => esc_html__( 'Resume Section Style','drake-core' ),
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
            'resume_title_color',
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
                'name'          => 'resume_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'resume_title_margin',
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
            'resume_title_padding',
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
            'resume_heading_color',
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
                'name'          => 'resume_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'resume_heading_margin',
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
            'resume_heading_padding',
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
            'drakeresumelist_design_option',
            [
                'label'         => esc_html__( 'Resume List Section Style','drake-core' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs_list'
        );


        $this->start_controls_tab(
            'style_normal_tab_list',
            [
               'label' => esc_html__( 'TimeLine', 'drake-core' ),
            ]
        );

        $this->add_control(
            'resumelist_timeline_color',
            [
                'label'         => esc_html__( 'Timeline Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item .date'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'resumelist_timeline_typography',
                'label'         => esc_html__( 'Timeline Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item .date',
            ]
        );

        $this->add_responsive_control(
            'resumelist_timeline_margin',
            [
                'label'         => __( 'Timeline Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'resumelist_timeline_padding',
            [
                'label'         => __( 'Timeline Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list',
            [
                'label' => esc_html__( 'Designation', 'drake-core' ),
            ]
        );

        $this->add_control(
            'resumelist_designation_color',
            [
                'label'         => esc_html__( 'Designation Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item h3'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'resumelist_designation_typography',
                'label'         => esc_html__( 'Designation Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item h3',
            ]
        );

        $this->add_responsive_control(
            'resumelist_designation_margin',
            [
                'label'         => __( 'Designation Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'resumelist_designation_padding',
            [
                'label'         => __( 'Designation Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list2',
            [
                'label' => esc_html__( 'Company', 'drake-core' ),
            ]
        );

        $this->add_control(
            'resumelist_company_span_color',
            [
                'label'         => esc_html__( 'Company Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'resume_company_span_typography',
                'label'         => esc_html__( 'Company Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item p',
            ]
        );

        $this->add_responsive_control(
            'resumelist_company_margin',
            [
                'label'         => __( 'Company Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'resumelist_company_padding',
            [
                'label'         => __( 'Company Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .resume-area .resume-content .resume-timeline .item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $drakeresume_output = $this->get_settings_for_display(); ?>
        <section class="resume-area">
                    <div class="custom-container">
                        <div class="resume-content content-width">
                            <div class="section-header">
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakeresume_output['icon_class']); ?>"></i> <?php echo esc_html($drakeresume_output['title']); ?>
                                </h4>
                                <h2 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakeresume_output['heading']); ?></h2>
                            </div>
        
                            <div class="resume-timeline">
                            <?php if(!empty($drakeresume_output['list1'])):
        foreach ($drakeresume_output['list1'] as $drakeresume_loop):?>
                                <div class="item scroll-animation" data-animation="fade_from_right">
                                    <span class="date"><?php echo esc_html($drakeresume_loop['timeline']); ?></span>
                                    <?php if(!empty($drakeresume_loop['d1'] )): ?>
                                    <h3><?php echo esc_html($drakeresume_loop['d1']); ?></h3>
                                    <p><?php echo esc_html($drakeresume_loop['c1']); ?></p>
                                    <?php endif;?>

                                    <?php if(!empty($drakeresume_loop['d2'] )): ?>
                                    <h3><?php echo esc_html($drakeresume_loop['d2']); ?></h3>
                                    <p><?php echo esc_html($drakeresume_loop['c2']); ?></p>
                                    <?php endif;?>

                                    <?php if(!empty($drakeresume_loop['d3'] )): ?>
                                    <h3><?php echo esc_html($drakeresume_loop['d3']); ?></h3>
                                    <p><?php echo esc_html($drakeresume_loop['c3']); ?></p>
                                    <?php endif;?>

                                    <?php if(!empty($drakeresume_loop['d4'] )): ?>
                                    <h3><?php echo esc_html($drakeresume_loop['d4']); ?></h3>
                                    <p><?php echo esc_html($drakeresume_loop['c4']); ?></p>
                                    <?php endif;?>

                                    <?php if(!empty($drakeresume_loop['d5'] )): ?>
                                    <h3><?php echo esc_html($drakeresume_loop['d5']); ?></h3>
                                    <p><?php echo esc_html($drakeresume_loop['c5']); ?></p>
                                    <?php endif;?>
                                </div><?php endforeach; endif;?>

                            </div>
        
                        </div>
                    </div>
                </section>

    <?php }
}