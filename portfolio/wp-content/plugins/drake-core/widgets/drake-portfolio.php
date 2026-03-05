<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakeportfolio Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakeportfolio_Widget extends \Elementor\Widget_Base {

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
        return 'drakeportfolio';
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
        return esc_html__( 'Drake Portfolio Section', 'drake-core' );
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
                'label' => esc_html__( 'Drake Portfolio Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'las la-grip-vertical', 'drake-core' ),
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
            'cclass',
            [
                'label'         => esc_html__( 'Container Size','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

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
                'label'         => esc_html__( 'Project Title','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

		// LINK
        $repeater->add_control(
            'ptitlelink',
            [
                'label'         => esc_html__( 'URL', 'drake-core' ),
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

        $repeater->add_control(
            'imglink',
            [
                'label'     => esc_html__( 'Project Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'ttitle1',
            [
                'label'         => esc_html__( 'TAG Title 1','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'ttitle2',
            [
                'label'         => esc_html__( 'TAG Title 2','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'ttitle3',
            [
                'label'         => esc_html__( 'TAG Title 3','drake-core' ),
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
                'title_field' => '{{{ ptitle }}}',
            ]
        );

        $this->end_controls_section();

        // TAB STYLE--1

        //START

        $this->start_controls_section(
            'drakeportfolio_design_option',
            [
                'label'         => esc_html__( 'Portfolio Section Style','drake-core' ),
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
            'portfolio_title_color',
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
                'name'          => 'portfolio_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'portfolio_title_margin',
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
            'portfolio_title_padding',
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
            'portfolio_heading_color',
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
                'name'          => 'portfolio_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'portfolio_heading_margin',
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
            'portfolio_heading_padding',
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

        // TAB STYLE--2

        //START

        $this->start_controls_section(
            'drakeportfolio_list_design_option',
            [
                'label'         => esc_html__( 'Portfolio List Section Style','drake-core' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs_list'
        );


        $this->start_controls_tab(
            'style_normal_tab_list',
            [
               'label' => esc_html__( 'Portfolio Title', 'drake-core' ),
            ]
        );

        $this->add_control(
            'portfoliolist_title_color',
            [
                'label'         => esc_html__( 'Title Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-items .portfolio-item h3 a'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'portfoliolist_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .portfolio-items .portfolio-item h3 a',
            ]
        );

        $this->add_responsive_control(
            'portfoliolist_title_margin',
            [
                'label'         => __( 'Title Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-items .portfolio-item h3 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'portfoliolist_title_padding',
            [
                'label'         => __( 'Title Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-items .portfolio-item h3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_list',
            [
                'label' => esc_html__( 'Tag Title', 'drake-core' ),
            ]
        );

        $this->add_control(
            'portfoliolist_tagtitle_color',
            [
                'label'         => esc_html__( 'Tag Title Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-items .portfolio-item .portfolio-item-inner .portfolio-categories li a'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'portfoliolist_tagtitle_typography',
                'label'         => esc_html__( 'Tag Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .portfolio-items .portfolio-item .portfolio-item-inner .portfolio-categories li a',
            ]
        );

        $this->add_responsive_control(
            'portfoliolist_tagtitle_margin',
            [
                'label'         => __( 'Tag Title Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-items .portfolio-item .portfolio-item-inner .portfolio-categories li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'portfoliolist_tagtitle_padding',
            [
                'label'         => __( 'Tag Title Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-items .portfolio-item .portfolio-item-inner .portfolio-categories li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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

        $drakeportfolio_output = $this->get_settings_for_display(); ?>

        <section class="portfolio-area">
                    <div class="custom-container">
                        <div class="portfolio-content content-width">
                            <div class="section-header">
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakeportfolio_output['icon_class']);?>"></i> <?php echo esc_html($drakeportfolio_output['title']); ?>
                                </h4>
                                <h2 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakeportfolio_output['heading']); ?></h2>
                            </div>
        
                            <div class="row portfolio-items">
                                <?php if(!empty($drakeportfolio_output['list1'])):
        foreach ($drakeportfolio_output['list1'] as $drakeportfolio_loop):?>

                                <div class="<?php echo esc_attr($drakeportfolio_loop['cclass']);?> scroll-animation" data-animation="<?php echo esc_attr($drakeportfolio_loop['aclass']);?>">
                                    <div class="portfolio-item portfolio-full">
                                        <div class="portfolio-item-inner">
                                            <a href="<?php echo esc_url($drakeportfolio_loop['imglink']['url']); ?>" data-lightbox="example-1">
                                                <img src="<?php echo esc_url(wp_get_attachment_image_url( $drakeportfolio_loop['imglink']['id'], 'full' ));?>" alt="Portfolio">
                                            </a>
        
                                            <ul class="portfolio-categories">
                                                <?php if(!empty($drakeportfolio_loop['ttitle1'] )): ?>
                                                <li>
                                                     <a ><?php echo esc_html($drakeportfolio_loop['ttitle1']); ?></a>
                                                </li><?php endif;?><?php if(!empty($drakeportfolio_loop['ttitle2'] )): ?>
                                                <li>
                                                    <a ><?php echo esc_html($drakeportfolio_loop['ttitle2']); ?></a>
                                                </li><?php endif;?><?php if(!empty($drakeportfolio_loop['ttitle3'] )): ?>
                                                <li>
                                                    <a ><?php echo esc_html($drakeportfolio_loop['ttitle3']); ?></a>
                                                </li><?php endif;?>
                                            </ul>
                                        </div>
										<h3><a <?php if($drakeportfolio_loop['ptitlelink']['is_external'] == true ): ?>
											   target="_blank" <?php endif; ?>
											   href="<?php echo esc_url($drakeportfolio_loop['ptitlelink']['url']); ?>"><?php echo esc_html($drakeportfolio_loop['ptitle']); ?></a></h3>
                                    </div>
                                </div><?php endforeach; endif;?>

                            </div>
        
                        </div>
                    </div>
                </section>

    <?php }
}