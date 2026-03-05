<?php

namespace XproElementorAddonsPro\Module\Dynamic_Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Site_Field extends Tag {

    public function get_name() {
        return 'xpro-site_field';
    }

    public function get_title() {
        return esc_html__( 'Site Field', 'xpro-elementor-addons-pro' );
    }

    public function get_group() {
        return 'xpro-dynamic-tags';
    }

    public function get_categories() {
        return array(
            Module::BASE_GROUP,
            Module::TEXT_CATEGORY,
            Module::URL_CATEGORY,
        );
    }

    /**
     * Register Controls
     *
     * Registers the Dynamic tag controls
     *
     * @return void
     * @since 2.0.0
     * @access protected
     *
     */
     protected function register_controls() {

        // $this->add_control(
        //  'tag_field',
        //  array(
        //      'label' => esc_html__( 'Field', 'xpro-elementor-addons-pro' ),
        //      'type'  => Controls_Manager::TEXT,
        //  )
        // );

         $this->add_control(
             'tag_field',
             array(
                 'label'   => esc_html__( 'Field', 'xpro-elementor-addons-pro' ),
                 'type'    => Controls_Manager::SELECT,
                 'default' => 'site_title',
                 'options' => array(
                     'site_title'   => esc_html__( 'Site Title', 'xpro-elementor-addons-pro' ),
                     'site_tagline' => esc_html__( 'Site Tagline', 'xpro-elementor-addons-pro' ),
                     'current_time' => esc_html__( 'Current Time', 'xpro-elementor-addons-pro' ),
                 ),
             )
         );
     
         $this->add_control(
             'date_format',
             array(
                 'label'     => esc_html__( 'Date Format', 'xpro-elementor-addons-pro' ),
                 'type'      => Controls_Manager::SELECT,
                 'options'   => array(
                     'default'   => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
                     ''          => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
                     'F j, Y'    => gmdate( 'F j, Y' ),
                     'Y-m-d'     => gmdate( 'Y-m-d' ),
                     'm/d/Y'     => gmdate( 'm/d/Y' ),
                     'd/m/Y'     => gmdate( 'd/m/Y' ),
                     'custom'    => esc_html__( 'Custom', 'xpro-elementor-addons-pro' ),
                 ),
                 'default'   => 'default',
                 'condition' => array(
                     'tag_field' => 'current_time',
                 ),
             )
         );
     
         $this->add_control(
             'time_format',
             array(
                 'label'     => esc_html__( 'Time Format', 'xpro-elementor-addons-pro' ),
                 'type'      => Controls_Manager::SELECT,
                 'options'   => array(
                     'default' => esc_html__( 'Default', 'xpro-elementor-addons-pro' ),
                     ''        => esc_html__( 'None', 'xpro-elementor-addons-pro' ),
                     'g:i a'   => gmdate( 'g:i a' ),
                     'g:i A'   => gmdate( 'g:i A' ),
                     'H:i'     => gmdate( 'H:i' ),
                 ),
                 'default'   => 'default',
                 'condition' => array(
                     'tag_field'   => 'current_time',
                     'date_format!' => 'custom',
                 ),
             )
         );
     
         $this->add_control(
             'custom_format',
             array(
                 'label'     => esc_html__( 'Custom Format', 'xpro-elementor-addons-pro' ),
                 'default'   => get_option( 'date_format' ) . ' ' . get_option( 'time_format' ),
                 'condition' => array(
                     'tag_field'   => 'current_time',
                     'date_format' => 'custom',
                 ),
             )
         );
     }
   
    public function render() {

        $settings = $this->get_settings_for_display();

        if ( empty( $settings ) ) {
            return;
        }

        if ( ! empty( $settings['tag_field'] ) ) {
            $opt = get_option( $settings['tag_field'] );
            xpro_elementor_kses( $this->to_string( $opt ) );
        }
       
        if ( empty( $settings['tag_field'] ) ) {
            return;
        }
   
        $field = $settings['tag_field'];
   
        if ( 'site_title' === $field ) {
            $value = get_bloginfo( 'name' );
        } elseif ( 'site_tagline' === $field ) {
            $value = get_bloginfo( 'description' );
        } elseif ( 'current_time' === $field ) {
            $format = '';
   
            if ( 'custom' === $settings['date_format'] ) {
                $format = $settings['custom_format'];
            } else {
                $date_format = $settings['date_format'];
                $time_format = $settings['time_format'];
   
                if ( 'default' === $date_format ) {
                    $date_format = get_option( 'date_format' );
                }
   
                if ( 'default' === $time_format ) {
                    $time_format = get_option( 'time_format' );
                }
   
                if ( $date_format ) {
                    $format = $date_format;
                }
   
                if ( $time_format ) {
                    $format .= ' ' . $time_format;
                }
            }
   
            $value = date_i18n( $format );
        } else {
            $value = '';
        }
        echo wp_kses_post( $value );
    }

    public function to_string( $data, $listed = false ) {
        if ( is_object( $data ) ) {
            switch ( get_class( $data ) ) {
                case 'WP_Term':
                    return $data->name;
                case 'WP_Post':
                    return $data->post_title;
                case 'WP_User':
                    return $data->display_name;
                case 'WP_Comment':
                    return $data->comment_content;
                default:
                    $data = (array) $data;
            }
        }
        if ( is_array( $data ) ) {
            if ( ! empty( $data['post_title'] ) ) {
                return $data['post_title'];
            }
            if ( ! empty( $data['display_name'] ) ) {
                return $data['display_name'];
            }
            if ( ! empty( $data['name'] ) ) {
                return $data['name'];
            }
            if ( ! empty( $data['comment_content'] ) ) {
                return $data['comment_content'];
            }
            if ( count( $data ) == 1 ) {
                $first = reset( $data );
                return $this->to_string( $first );
            }

            return $this->implode( $data, ', ', $listed );
        }

        return $data;
    }
    public function implode( $pieces = array(), $glue = ', ', $listed = false ) {
        $string = '';
        if ( is_string( $pieces ) ) {
            $string = $pieces;
        }
        if ( ! empty( $pieces ) && is_array( $pieces ) ) {
            if ( $listed ) {
                $string .= ( is_string( $listed ) ) ? '<' . $listed . '>' : '<ul>';
            }
            $i = 0;
            foreach ( $pieces as $av ) {
                if ( $listed ) {
                    $string .= '<li>';
                }
                if ( is_object( $av ) ) {
                    $av = $this->to_string( $av );
                }
                if ( is_array( $av ) ) {
                    $string .= $this->implode( $av, $glue, $listed );
                } else {
                    if ( $i ) {
                        $string .= $glue;
                    }
                    $string .= $av;
                }
                if ( $listed ) {
                    $string .= '</li>';
                }
                $i ++;
            }
            if ( $listed ) {
                $string .= ( is_string( $listed ) ) ? '</' . $listed . '>' : '</ul>';
            }
        }

        return $string;
    }

}


