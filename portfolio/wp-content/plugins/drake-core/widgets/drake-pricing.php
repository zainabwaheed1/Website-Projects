<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakepricing Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakepricing_Widget extends \Elementor\Widget_Base {

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
        return 'drakepricing';
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
        return esc_html__( 'Drake Pricing Section', 'drake-core' );
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
                'label' => esc_html__( 'Drake Pricing Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'las la-dollar-sign', 'drake-core' ),
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
            'dbttext',
            [
                'label'         => esc_html__( 'Button Text','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'dbtlink',
            [
                'label'         => esc_html__( 'Button URL', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://www.youtube.com/watch?v=EgDFwNalOVg', 'drake-core' ),
                'show_external' => true,
                'default' => esc_html__( 'https://www.youtube.com/watch?v=EgDFwNalOVg', 'drake-core' ),
                'default'       => [
                    'url'           => '#',
                    'is_external'   => true,
                    'nofollow'      => true,
                ],
            ]
        );

        $this->add_control(
            'pdes',
            [
                'label'         => esc_html__( 'Pricing Descirption','drake-core' ),
                'type'          => \Elementor\Controls_Manager::WYSIWYG,
                'label_block'   => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'aclass',
            [
                'label'         => esc_html__( 'Animation Class','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'ptitle',
            [
                'label'         => esc_html__( 'Pricing Title','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'pheading',
            [
                'label'         => esc_html__( 'Pricing Heading','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'pttitle',
            [
                'label'         => esc_html__( 'Pricing','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'featureslist',
            [
                'label'         => esc_html__( 'Packages Includes List','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'bttext',
            [
                'label'         => esc_html__( 'Button Text','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'btlink',
            [
                'label'         => esc_html__( 'Button URL', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://www.youtube.com/watch?v=EgDFwNalOVg', 'drake-core' ),
                'show_external' => true,
                'default' => esc_html__( 'https://www.youtube.com/watch?v=EgDFwNalOVg', 'drake-core' ),
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
                'title_field' => '{{{ ptitle }}}',
            ]
        );

        $this->end_controls_section();

        // TAB STYLE 

        //START

        $this->start_controls_section(
            'drakepricing_design_option',
            [
                'label'         => esc_html__( 'Pricing Section Style','drake-core' ),
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
            'pricing_title_color',
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
                'name'          => 'pricing_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'pricing_title_margin',
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
            'pricing_title_padding',
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
            'pricing_heading_color',
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
                'name'          => 'pricing_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'pricing_heading_margin',
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
            'pricing_heading_padding',
            [
                'label'         => __( 'Heading Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .section-header h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_title_span_color',
            [
                'label'         => esc_html__( 'Span Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .section-header h2 span'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricing_title_span_typography',
                'label'         => esc_html__( 'Span Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2 span',
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_button',
            [
                'label' => esc_html__( 'Button Text', 'drake-core' ),
            ]
        );

        $this->add_control(
            'pricing_button_color',
            [
                'label'         => esc_html__( 'Button Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .info a'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricing_button_typography',
                'label'         => esc_html__( 'Button Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .info a',
            ]
        );

        $this->add_responsive_control(
            'pricing_button_margin',
            [
                'label'         => __( 'Button Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .info a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_button_padding',
            [
                'label'         => __( 'Button Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .info a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_description',
            [
                'label' => esc_html__( 'Description', 'drake-core' ),
            ]
        );

        $this->add_control(
            'pricing_description_color',
            [
                'label'         => esc_html__( 'Description Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .info'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricing_description_typography',
                'label'         => esc_html__( 'Description Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .info',
            ]
        );

        $this->add_responsive_control(
            'pricing_description_margin',
            [
                'label'         => __( 'Description Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_description_padding',
            [
                'label'         => __( 'Description Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'drakepricinglist_design_option',
            [
                'label'         => esc_html__( 'Pricing List Section Style','drake-core' ),
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
            'pricinglist_title_color',
            [
                'label'         => esc_html__( 'Title Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h4'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricinglist_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h4',
            ]
        );

        $this->add_responsive_control(
            'pricinglist_title_margin',
            [
                'label'         => __( 'Title Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricinglist_title_padding',
            [
                'label'         => __( 'Title Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list',
            [
                'label' => esc_html__( 'Heading', 'drake-core' ),
            ]
        );

        $this->add_control(
            'pricinglist_heading_color',
            [
                'label'         => esc_html__( 'Heading Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header .top p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricinglist_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header .top p',
            ]
        );

        $this->add_responsive_control(
            'pricinglist_heading_margin',
            [
                'label'         => __( 'Heading Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header .top p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricinglist_heading_padding',
            [
                'label'         => __( 'Heading Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header .top p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list2',
            [
                'label' => esc_html__( 'Pricing', 'drake-core' ),
            ]
        );

         $this->add_control(
            'pricing_list_span_color',
            [
                'label'         => esc_html__( 'Pricing Number Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h2'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricing_list_span_typography',
                'label'         => esc_html__( 'Pricing Number Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h2',
            ]
        );

        $this->add_control(
            'pricinglist_pricing_color',
            [
                'label'         => esc_html__( 'Pricing Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h2 span'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricinglist_pricing_typography',
                'label'         => esc_html__( 'pricing Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h2 span',
            ]
        );

        $this->add_responsive_control(
            'pricinglist_pricing_margin',
            [
                'label'         => __( 'Pricing Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h2 span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricinglist_pricing_padding',
            [
                'label'         => __( 'Pricing Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table .pricing-table-header h2 span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list_packages',
            [
                'label' => esc_html__( 'Packages List', 'drake-core' ),
            ]
        );

        $this->add_control(
            'pricinglist_packages_color',
            [
                'label'         => esc_html__( 'Packages Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table ul li'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'pricinglist_packages_typography',
                'label'         => esc_html__( 'Packages Text Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .pricing-table-items .pricing-table ul li',
            ]
        );

        $this->add_responsive_control(
            'pricinglist_packages_margin',
            [
                'label'         => __( 'Packages Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricinglist_packages_padding',
            [
                'label'         => __( 'Packages Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .pricing-table-items .pricing-table ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list_btntxt',
            [
                'label' => esc_html__( 'Button', 'drake-core' ),
            ]
        );

        $this->add_control(
            'pricinglist_btnbgtxt_color',
            [
                'label'         => esc_html__( 'Button Background Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .theme-btn'=> 'background: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_control(
            'pricinglist_btntxt_color',
            [
                'label'         => esc_html__( 'Button Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .theme-btn'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_responsive_control(
            'pricinglist_btntxt_margin',
            [
                'label'         => __( 'Button Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .theme-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricinglist_btntxt_padding',
            [
                'label'         => __( 'Button Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $drakepricing_output = $this->get_settings_for_display(); ?>

        <section class="pricing-area">
                    <div class="custom-container">
                        <div class="pricing-content content-width">
                            <div class="section-header">
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakepricing_output['icon_class']);?>"></i> <?php echo esc_html($drakepricing_output['title']); ?>
                                </h4>
                                <h2 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakepricing_output['heading']); ?></h2>
                            </div>

                            <div class="pricing-table-items">
                                <div class="row">
                                            <?php if(!empty($drakepricing_output['list1'])):
        foreach ($drakepricing_output['list1'] as $drakepricing_loop):?>
                                    <div class="col-md-6 scroll-animation" data-animation="<?php echo esc_attr($drakepricing_loop['aclass']);?>">
                                        <div class="pricing-table">
                                            <div class="pricing-table-header">
                                                <div class="top d-flex justify-content-between align-items-start">
                                                    <h4><?php echo esc_html($drakepricing_loop['ptitle']); ?></h4>
                                                    <p class="text-right"><?php echo ($drakepricing_loop['pheading']); ?></p>
                                                </div>
                                                <h2><?php echo ($drakepricing_loop['pttitle']); ?></span></h2>
                                            </div>
                                            <ul class="feature-lists">
                                                <?php echo ($drakepricing_loop['featureslist']); ?>
                                            </ul>
                                            <a <?php if($drakepricing_loop['btlink']['is_external'] == true ): ?>
											   target="_blank" <?php endif; ?>
											   href="<?php echo esc_url($drakepricing_loop['btlink']['url']); ?>" class="theme-btn"><?php echo esc_html($drakepricing_loop['bttext']); ?></a>
                                        </div>
                                    </div><?php endforeach; endif;?>
                                </div>
                                <p class="info scroll-animation" data-animation="fade_from_bottom">
                                    <?php echo ($drakepricing_output['pdes']); ?><a <?php if($drakepricing_output['dbtlink']													['is_external'] == true ): ?>
											   target="_blank" <?php endif; ?>
										href="<?php echo esc_url($drakepricing_output['dbtlink']['url']); ?>"><?php echo esc_html($drakepricing_output['dbttext']); ?></a>
                                </p>
                            </div>
        
                        </div>
                    </div>
                </section>

    <?php }
}