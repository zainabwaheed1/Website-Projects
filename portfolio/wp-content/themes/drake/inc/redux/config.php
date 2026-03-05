<?php

if (!class_exists('Redux'))
    {
    return;
    }
function newIconFont() 
    { 
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fontawesome-all.css' );
    }

add_action( 'redux/page/drake_options/enqueue', 'newIconFont' );

$opt_name = "drake_options";
$theme    = wp_get_theme();
$args = array(
    'opt_name' => $opt_name,
    'display_name' => $theme->get('Name') ,
    'display_version' => $theme->get('Version') ,
    'menu_type' => 'menu',
    'allow_sub_menu' => true,
    'menu_title'        => esc_html__( 'Drake Options', 'drake' ),
    'google_api_key' => '',
    'google_update_weekly' => false,
    'async_typography' => true,
    'admin_bar' => false,
    'admin_bar_icon' => '',
    'admin_bar_priority' => 50,
    'global_variable' => $opt_name,
    'dev_mode' => false,
    'update_notice' => false,
    'customizer' => false,
    'page_priority' => 3,
    'page_parent' => 'themes.php',
    'page_permissions' => 'manage_options',
    'menu_icon' => '',
    'last_tab' => '',
    'page_icon' => 'icon-themes',
    'page_slug' => 'themeoptions',
    'save_defaults' => true,
    'default_show' => false,
    'default_mark' => '',
    'show_import_export' => true
);
Redux::setArgs( $opt_name, $args );

Redux::setSection($opt_name, array(
    'title' => esc_html__('Main Sidebar', 'drake') ,
    'id' => esc_html__('main-sidebar', 'drake') ,
    'icon' => 'fa-solid fa-bars-progress',
    'fields' => array(
			
		array(
            'title'     => esc_html__( 'Favicon', 'drake' ),
            'id'        => 'favicon-logo',
            'type'      => 'media',
            'default'  => array(
                'url'=> get_template_directory_uri() . '/assets/images/favicon.png'
                ), 
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Main Logo', 'drake' ),
            'id'        => 'main-logo',
            'type'      => 'media',
            'default'  => array(
                'url'=> get_template_directory_uri() . '/assets/images/logo.png'
                ), 
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Designation', 'drake' ),
            'id'        => 'designation',
            'type'      => 'text',
            'default'   => esc_html__( 'Framer Designer & Developer', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Profile Picture', 'drake' ),
            'id'        => 'profile-picture',
            'type'      => 'media',
            'default'  => array(
                'url'=> get_template_directory_uri() . '/assets/images/me.jpg'
                ), 
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Background Video', 'drake' ),
            'id'        => 'bg-video',
            'type'      => 'text',
            'default'   => esc_html__( 'Paste Your Video URL Here!', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Email', 'drake' ),
            'id'        => 'email',
            'type'      => 'text',
            'default'   => esc_html__( 'hello@drake.design', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Based In', 'drake' ),
            'id'        => 'basedin',
            'type'      => 'text',
            'default'   => esc_html__( 'Based in Los Angeles, CA', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Copyright Text', 'drake' ),
            'id'        => 'copyright',
            'type'      => 'text',
            'default'   => esc_html__( '2022 Drake. All Rights Reserved', 'drake' ),
            'indent'    => true
        ),
		
		array(
            'title'     => esc_html__( 'Hire Me Icon Class', 'drake' ),
            'id'        => 'hire_icon',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-envelope', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Text', 'drake' ),
            'id'        => 'hireme',
            'type'      => 'text',
            'default'   => esc_html__( 'Hire Me!', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Call To Action', 'drake' ),
            'id'        => 'hiremelink',
            'type'      => 'text',
            'default'   => esc_html__( '#contact', 'drake' ),
            'indent'    => true
        ),

    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Menu Items', 'drake') ,
    'id' => esc_html__('menuitems', 'drake') ,
    'icon' => 'fa-solid fa-bars',
    'fields' => array(

        array(
            'title'     => esc_html__( 'Menu 1', 'drake' ),
            'id'        => 'tp_c_1',
            'type'      => 'section',
            'indent'    => true
        ),
		
		array(
            'title'     => esc_html__( 'Menu Section Title', 'drake' ),
            'id'        => 'menu_section_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Menu', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon1',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-home', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text1',
            'type'      => 'text',
            'default'   => esc_html__( 'Home', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link1',
            'type'      => 'text',
            'default'   => esc_html__( '#home', 'drake' ),
            'indent'    => true
        ),

        // start

        array(
            'title'     => esc_html__( 'Menu 2', 'drake' ),
            'id'        => 'tp_c_2',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon2',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'lar la-user', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text2',
            'type'      => 'text',
            'default'   => esc_html__( 'About', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link2',
            'type'      => 'text',
            'default'   => esc_html__( '#about', 'drake' ),
            'indent'    => true
        ),

        // Start

        array(
            'title'     => esc_html__( 'Menu 3', 'drake' ),
            'id'        => 'tp_c_3',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon3',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-briefcase', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text3',
            'type'      => 'text',
            'default'   => esc_html__( 'Resume', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link3',
            'type'      => 'text',
            'default'   => esc_html__( '#resume', 'drake' ),
            'indent'    => true
        ),

        // Start

        array(
            'title'     => esc_html__( 'Menu 4', 'drake' ),
            'id'        => 'tp_c_4',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon4',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-stream', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text4',
            'type'      => 'text',
            'default'   => esc_html__( 'Services', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link4',
            'type'      => 'text',
            'default'   => esc_html__( '#services', 'drake' ),
            'indent'    => true
        ),

        // Start

        array(
            'title'     => esc_html__( 'Menu 5', 'drake' ),
            'id'        => 'tp_c_5',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon5',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-shapes', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text5',
            'type'      => 'text',
            'default'   => esc_html__( 'Skills', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link5',
            'type'      => 'text',
            'default'   => esc_html__( '#skills', 'drake' ),
            'indent'    => true
        ),

        // Start

        array(
            'title'     => esc_html__( 'Menu 6', 'drake' ),
            'id'        => 'tp_c_6',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon6',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-grip-vertical', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text6',
            'type'      => 'text',
            'default'   => esc_html__( 'Portfolio', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link6',
            'type'      => 'text',
            'default'   => esc_html__( '#portfolio', 'drake' ),
            'indent'    => true
        ),

        // Start

        array(
            'title'     => esc_html__( 'Menu 7', 'drake' ),
            'id'        => 'tp_c_7',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon7',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'lar la-comment', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text7',
            'type'      => 'text',
            'default'   => esc_html__( 'Testimonial', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link7',
            'type'      => 'text',
            'default'   => esc_html__( '#testimonial', 'drake' ),
            'indent'    => true
        ),

        // Start

        array(
            'title'     => esc_html__( 'Menu 8', 'drake' ),
            'id'        => 'tp_c_8',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'mi_icon8',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'las la-envelope', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Name', 'drake' ),
            'id'        => 'mi_text8',
            'type'      => 'text',
            'default'   => esc_html__( 'Contact', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Menu Item Link', 'drake' ),
            'id'        => 'mi_link8',
            'type'      => 'text',
            'default'   => esc_html__( '#contact', 'drake' ),
            'indent'    => true
        ),



    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Social Links', 'drake') ,
    'id' => esc_html__('socialicons', 'drake') ,
    'icon' => 'fa-solid fa-hashtag',
    'fields' => array(


        array(
            'title'     => esc_html__( 'Section One', 'drake' ),
            'id'        => 'se1',
            'type'      => 'section',
            'indent'    => true
        ),
		
		array(
            'title'     => esc_html__( 'Social Section Title', 'drake' ),
            'id'        => 'social_section_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Social', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'sicon1',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'lab la-instagram', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Link', 'drake' ),
            'id'        => 'sl1',
            'type'      => 'text',
            'default'   => esc_html__( '#', 'drake' ),
            'indent'    => true,
        ),

        array(
                'id'       => 'link_Switch_on_off1',
                'type'     => 'button_set',
                'default'  => '2',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Link to open in a new tab', 'drake' ),
            ),

        array(
            'title'     => esc_html__( 'Section Two', 'drake' ),
            'id'        => 'se2',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'sicon2',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'lab la-twitter', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Link', 'drake' ),
            'id'        => 'sl2',
            'type'      => 'text',
            'default'   => esc_html__( '#', 'drake' ),
            'indent'    => true
        ),

        array(
                'id'       => 'link_Switch_on_off2',
                'type'     => 'button_set',
                'default'  => '2',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Link to open in a new tab', 'drake' ),
            ),


         array(
            'title'     => esc_html__( 'Section Three', 'drake' ),
            'id'        => 'se3',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'sicon3',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'lab la-dribbble', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Link', 'drake' ),
            'id'        => 'sl3',
            'type'      => 'text',
            'default'   => esc_html__( '#', 'drake' ),
            'indent'    => true
        ),

        array(
                'id'       => 'link_Switch_on_off3',
                'type'     => 'button_set',
                'default'  => '2',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Link to open in a new tab', 'drake' ),
            ),

        array(
            'title'     => esc_html__( 'Section Four', 'drake' ),
            'id'        => 'se4',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Icon Class', 'drake' ),
            'id'        => 'sicon4',
            'description'   => sprintf(
            esc_html__( 'Paste Line-Awesome- Icon Class. For more information, visit %s.', 'Drake' ),
            '<a href="https://icons8.com/line-awesome" target="_blank">icons pack</a>'
        ),
            'type'      => 'text',
            'default'   => esc_html__( 'lab la-github', 'drake' ),
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Link', 'drake' ),
            'id'        => 'sl4',
            'type'      => 'text',
            'default'   => esc_html__( '#', 'drake' ),
            'indent'    => true
        ),

        array(
                'id'       => 'link_Switch_on_off4',
                'type'     => 'button_set',
                'default'  => '2',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Link to open in a new tab', 'drake' ),
            ),

    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Styling', 'drake') ,
    'id' => esc_html__('drake_color', 'drake') ,
    'icon' => 'fas fa-edit',
    'fields' => array(
    array(
            'id'        => 'main_color_drake',
            'title'     => esc_html__( 'Main Theme Color', 'drake' ),
            'subtitle'  => esc_html__( 'The main color of the site.', 'drake' ),
            'type'      => 'select',
            'options'   => array(
                '1'     => esc_html__( 'Minty Green', 'drake' ),
                '2'     => esc_html__( 'Bee Yellow', 'drake' ),
                '3'     => esc_html__( 'Blaze Orange', 'drake' ),
                '4'     => esc_html__( 'Neon Blue', 'drake' ),
                '5'     => esc_html__( 'French Grey', 'drake' ),
                '6'     => esc_html__( 'Blue Orchid', 'drake' ),
                '7'     => esc_html__( 'Bright Red', 'drake' ),
                '8'     => esc_html__( 'Carnation Pink', 'drake' ),
                '9'     => esc_html__( 'Custom Colors', 'drake' ),
            ),
            'default'   => '1',
            'indent'    => true,
        ),

    array(
            'title'     => esc_html__( 'Custom Color Option', 'drake' ),
            'id'        => 'customcolors',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array( 'main_color_drake', 'equals', '9' ),
        ),

    array(
            'title'     => esc_html__( 'Choose Main Theme Color', 'drake' ),
            'id'        => 'colorcode',
            'type'      => 'color',
            'default'  => '#104cba',
            'validate' => 'color',
            'transparent' => false,
            'required'  => array( 'main_color_drake', 'equals', '9' ),
        ),
)
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Switch Setting', 'drake') ,
    'id' => esc_html__('switch', 'drake') ,
    'icon' => 'fa-solid fa-toggle-on',
    'fields' => array(
		
		array(
                'id'       => 'preloader_on_off',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Preloader ON/OFF', 'drake' ),
            ),
		
		array(
                'id'       => 'color_Switch_on_off',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Color Switch ON/OFF', 'drake' ),
            ),

        array(
                'id'       => 'attribution_on_off',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"         => esc_html__( 'ON', 'drake' ),
                    "2"         => esc_html__( 'OFF', 'drake' ),
                ),
                'title'    => esc_html__( 'Attribution ON/OFF', 'drake' ),
            ),
)
));