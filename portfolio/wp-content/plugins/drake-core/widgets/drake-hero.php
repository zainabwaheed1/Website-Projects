<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakehero Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakehero_Widget extends \Elementor\Widget_Base {

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
        return 'drakehero';
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
        return esc_html__( 'Drake Hero Section', 'drake-core' );
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
                'label' => esc_html__( 'Hero Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_class', [
                'label'         => esc_html__( 'Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'las la-home', 'drake-core' ),
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

        $this->add_control(
            'imglink',
            [
                'label'         => esc_html__( 'Image Link', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__( 'Link Here', 'drake-core' ),
                'show_external' => true,
                'default' => esc_html__( '#portfolio', 'drake-core' ),
                'default'       => [
                    'url'           => '#',
                    'is_external'   => true,
                    'nofollow'      => true,
                ],
            ]
        );

        $this->add_control(
            'heroimg',
            [
                'label'     => esc_html__( 'Circling Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
		$this->add_control(
            'arrow_icon_class', [
                'label'         => esc_html__( 'Arrow Icon Class', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__( 'las la-arrow-down', 'drake-core' ),
            ]
        );

        $this->end_controls_section();

        // TAB 2

        $this->start_controls_section(
            'section2',
            [
                'label' => esc_html__( 'Counter Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'statsyear',
            [
                'label'         => esc_html__( 'Years','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'statstitle',
            [
                'label'         => esc_html__( 'Heading','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'class1',
            [
                'label'         => esc_html__( 'Class 1','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'class2',
            [
                'label'         => esc_html__( 'Class 2','drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'list1',
            [
                'label'     => esc_html__( 'Features List', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'list_title' => esc_html__( 'Add Features List', 'drake-core' ),
                    ],
                ],
                'title_field' => '{{{ statstitle }}}',
            ]
        );

        $this->end_controls_section();

        // TAB STYLE 

        //START

        $this->start_controls_section(
            'drakehero_design_option',
            [
                'label'         => esc_html__( 'Hero Section Style','drake-core' ),
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
            'hero_title_color',
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
                'name'          => 'hero_title_typography',
                'label'         => esc_html__( 'Title Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_responsive_control(
            'hero_title_margin',
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
            'hero_title_padding',
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
            'hero_heading_color',
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
                'name'          => 'hero_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .section-header h2',
            ]
        );

        $this->add_responsive_control(
            'hero_heading_margin',
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
            'hero_heading_padding',
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
            'hero_description_color',
            [
                'label'         => esc_html__( 'Description Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .hero-section .hero-content > p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'hero_description_typography',
                'label'         => esc_html__( 'Description Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .hero-section .hero-content > p',
            ]
        );

        $this->add_responsive_control(
            'hero_description_margin',
            [
                'label'         => __( ' Description Margin', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .hero-section .hero-content > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_description_padding',
            [
                'label'         => __( ' Description Padding', 'drake-core' ),
                'type'          => elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .hero-section .hero-content > p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //END
        $this->end_controls_tab();

        //END
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'drakecounter_design_option',
            [
                'label'         => esc_html__( 'Counter Section Style','drake-core' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs_drakecounter'
        );

        $this->start_controls_tab(
            'style_hover_tab_drakecounter',
            [
                'label' => esc_html__( 'Heading', 'drake-core' ),
            ]
        );

        $this->add_control(
            'counter_heading_color',
            [
                'label'         => esc_html__( 'Heading Text Color', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .hero-section .hero-content .facts p'=> 'color: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'counter_heading_typography',
                'label'         => esc_html__( 'Heading Typography', 'drake-core' ),
                'selector'      => 
                    '{{WRAPPER}} .hero-section .hero-content .facts p',
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

        $drakehero_output = $this->get_settings_for_display(); ?>

        <section class="hero-section">

                    <div class="custom-container">
                        <div class="hero-content content-width">
                            <div class="section-header">
							<?php if(!empty($drakehero_output['title'] )): ?>
                                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                                    <i class="<?php echo esc_attr($drakehero_output['icon_class']);?>"></i> <?php echo esc_html($drakehero_output['title']); ?>
                                </h4><?php endif;?>
                                <h1 class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakehero_output['heading']); ?></h1>
                            </div>
                            <p class="scroll-animation" data-animation="fade_from_bottom"><?php echo ($drakehero_output['des']); ?></p>
                            <a href="<?php echo esc_url($drakehero_output['imglink']['url']); ?>" 
                                class="go-to-project-btn scroll-to scroll-animation" 
                                data-animation="rotate_up">
                                <img src="<?php echo esc_url(wp_get_attachment_image_url($drakehero_output['heroimg']['id'], 'full' ));?>" alt="Rounded Text">
                                <i class="<?php echo esc_attr($drakehero_output['arrow_icon_class']);?>"></i>
                            </a>
        
                            <div class="facts d-flex">
                                <?php if(!empty($drakehero_output['list1'])):
                            foreach ($drakehero_output['list1'] as $drakehero_loop):?>

                                <div class="<?php echo esc_attr($drakehero_loop['class1']);?> scroll-animation" data-animation="<?php echo esc_attr($drakehero_loop['class2']);?>">
                                    <h2><?php echo esc_html($drakehero_loop['statsyear']); ?></h2>
                                    <p><?php echo ($drakehero_loop['statstitle']); ?></p>
                                </div>

                            <?php endforeach; endif;?>
                            </div>
                        </div>
                    </div>
                </section>

    <?php }
}