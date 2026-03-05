<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor drake drakeclients Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_drake_drakeclients_Widget extends \Elementor\Widget_Base {

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
        return 'drakeclients';
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
        return esc_html__( 'Drake Clients Section', 'drake-core' );
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
                'label' => esc_html__( 'Drake Clients Section', 'drake-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title', [
                'label'         => esc_html__( 'Title', 'drake-core' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
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
            'imglink',
            [
                'label'     => esc_html__( 'Circling Image', 'drake-core' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => \Elementor\Utils::get_placeholder_image_src(),
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
                'title_field' => '{{{ imglink }}}',
            ]
        );

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

        $drakeclients_output = $this->get_settings_for_display(); ?>

        <div class="clients-logos">
                                <h4 class="scroll-animation" data-animation="fade_from_bottom"><?php echo esc_html($drakeclients_output['title']); ?></h4>
                                <div class="row align-items-center">
                                <?php if(!empty($drakeclients_output['list1'])):
        foreach ($drakeclients_output['list1'] as $drakeclients_loop):?>
                                    <div class="col-md-3 scroll-animation" data-animation="<?php echo esc_attr($drakeclients_loop['aclass']);?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url( $drakeclients_loop['imglink']['id'], 'full' ));?>" alt="client">
                                    </div><?php endforeach; endif;?>

                                </div>
                            </div>
        
                        </div>
                    </div>
                </section>

    <?php }
}