<?php

namespace XproElementorAddonsPro\Module;

use \Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly.

class Xpro_Elementor_Custom_JS
{

    private static $instance = null;

    public function __construct()
    {
        // Add new controls to Page Settings on Advanced Tab globally
        add_action('elementor/documents/register_controls', [$this, 'register'], 12);
        add_action('wp_print_footer_scripts', [$this, 'print_custom_js'], 999);
    }

    public function register($controls)
    {
        $controls->start_controls_section(
            'section_xpro_elementor_custom_js',
            [
                'label'         => esc_html__(' Custom JS', 'xpro-elementor-addons-pro' ),
                'tab'           => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $controls->add_control(
            'xpro_custom_js',
            [
	            'label'       => __( 'Custom JS', 'xpro-elementor-addons-pro' ),
                'type'          => Controls_Manager::CODE,
                'show_label'    => false,
	            'render_type' => 'ui',
                'language'      => 'javascript',
            ]
        );

        $controls->add_control(
            'xpro_custom_js_usage',
            [
                'type'              => Controls_Manager::RAW_HTML,
                'raw'               => __('You may use jQuery selector e.g. $(‘.selector’)', 'xpro-elementor-addons-pro' ),
                'content_classes'   => 'elementor-descriptor',
            ]
        );

        $controls->end_controls_section();
    }


    public function print_custom_js()
    {

        if (\Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode()) {
            return;
        }

        $document = \Elementor\Plugin::instance()->documents->get(get_the_ID());

        if (!$document) return;

        $custom_js = $document->get_settings('xpro_custom_js');

        if (empty($custom_js)) return;

        echo "<script type='text/javascript'>(function($){
            'use strict';
            {$custom_js}
        })(jQuery);</script>";
    }



    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Xpro_Elementor_Custom_JS::get_instance();