<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "appku_opt";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }


    $alowhtml = array(
        'p' => array(
            'class' => array()
        ),
        'span' => array()
    );


    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Appku Options', 'appku' ),
        'page_title'           => esc_html__( 'Appku Options', 'appku' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'appku' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'appku' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'appku' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'appku' )
        )
    );
    Redux::set_help_tab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'appku' );
    Redux::set_help_sidebar( $opt_name, $content );



    // -> START General Fields

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'appku' ),
        'id'               => 'appku_general',
        'customizer_width' => '450px',
        'icon'             => 'el el-cog',
        'fields'           => array(
            array(
                'id'       => 'appku_theme_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Theme Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Theme Color', 'appku' )
            ),
        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Preloader', 'appku' ),
        'id'               => 'appku_preloader',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'appku_display_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'appku' ),
                'subtitle' => esc_html__( 'Switch Enabled to Display Preloader.', 'appku' ),
                'default'  => true,
                'on'       => esc_html__('Enabled','appku'),
                'off'      => esc_html__('Disabled','appku'),
            ),

            array(
                'id'       => 'appku_preloader_img',
                'type'     => 'media',
                'title'    => esc_html__( 'Preloader Image', 'appku' ),
                'subtitle' => esc_html__( 'Set Preloader Image.', 'appku' ),
                'required' => array( "appku_display_preloader","equals",true )
            ),
        )
    ));

    /* End General Fields */

    /* Admin Lebel Fields */
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Admin Label', 'appku' ),
        'id'                => 'appku_admin_label',
        'customizer_width'  => '450px',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Admin Login Logo', 'appku' ),
                'subtitle'  => esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'appku' ),
                'id'        => 'appku_admin_login_logo',
                'type'      => 'media',
            ),
            array(
                'title'     => esc_html__( 'Custom CSS For admin', 'appku' ),
                'subtitle'  => esc_html__( 'Any CSS your write here will run in admin.', 'appku' ),
                'id'        => 'appku_theme_admin_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
        ),
    ) );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'appku' ),
        'id'               => 'appku_header',
        'customizer_width' => '400px',
        'icon'             => 'el el-credit-card',
        'fields'           => array(
            array(
                'id'       => 'appku_header_options',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"         => esc_html__( 'Prebuilt', 'appku' ),
                    "2"         => esc_html__( 'Header Builder', 'appku' ),
                ),
                'title'    => esc_html__( 'Header Options', 'appku' ),
                'subtitle' => esc_html__( 'Select header options.', 'appku' ),
            ),
            array(
                'id'       => 'appku_header_select_options',
                'type'     => 'select',
                'data'     => 'posts',
                'args'     => array(
                    'post_type'     => 'appku_header'
                ),
                'title'    => esc_html__( 'Header', 'appku' ),
                'subtitle' => esc_html__( 'Select header.', 'appku' ),
                'required' => array( 'appku_header_options', 'equals', '2' )
            ),
            array(
                'id'       => 'appku_btn_text',
                'type'     => 'text',
                'validate' => 'html',
                'default'  => esc_html__( 'Get Started', 'appku' ),
                'title'    => esc_html__( 'Button Text', 'appku' ),
                'subtitle' => esc_html__( 'Set Button Text', 'appku' ),
            ),
            array(
                'id'       => 'appku_btn_url',
                'type'     => 'text',
                'default'  => esc_html__( '#', 'appku' ),
                'title'    => esc_html__( 'Button URL?', 'appku' ),
                'subtitle' => esc_html__( 'Set Button URL Here', 'appku' ),
            ),
        ),
    ) );
    // -> START Header Logo
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Logo', 'appku' ),
        'id'               => 'appku_header_logo_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'appku_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'appku' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'appku' ),
            ),
            array(
                'id'       => 'appku_site_logo_dimensions',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Dimensions (Width/Height).', 'appku'),
                'output'   => array('.header-logo .logo img'),
                'subtitle' => esc_html__('Set logo dimensions to choose width, height, and unit.', 'appku'),
            ),
            array(
                'id'       => 'appku_site_logomargin_dimensions',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'output'   => array('.header-logo .logo img'),
                'units_extended' => 'false',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Top and Bottom Margin.', 'appku'),
                'left'     => false,
                'right'    => false,
                'subtitle' => esc_html__('Set logo top and bottom margin.', 'appku'),
                'default'            => array(
                    'units'           => 'px'
                )
            ),
            array(
                'id'       => 'appku_text_title',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Text Logo', 'appku' ),
                'subtitle' => esc_html__( 'Write your logo text use as logo ( You can use span tag for text color ).', 'appku' ),
            )
        )
    ) );
    // -> End Header Logo

    // -> START Header Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Menu', 'appku' ),
        'id'               => 'appku_header_menu_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'appku_header_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Menu Color', 'appku' ),
                'output'   => array( 'color'    =>  'nav.navbar ul.nav > li > a' ),
            ),
            array(
                'id'       => 'appku_header_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Hover Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Menu Hover Color', 'appku' ),
                'output'   => array( 'color'    =>  'nav.navbar ul.nav > li > a:hover' ),
            ),
            array(
                'id'       => 'appku_header_dropdown_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Dropdown Menu Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Menu Color', 'appku' ),
                'output'   => array( 'color'    =>  'nav.navbar.validnavs ul li.dropdown ul.dropdown-menu li a' ),
            ),
            array(
                'id'       => 'appku_header_dropdown_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Dropdown Menu Hover Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Menu Hover Color', 'appku' ),
                'output'   => array( 'color'    =>  'nav.navbar.validnavs ul li.dropdown ul.dropdown-menu li a:hover' ),
            ),
        )
    ) );
    // -> End Header Menu

    // -> START Blog Page
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'appku' ),
        'id'         => 'appku_blog_page',
        'icon'  => 'el el-blogger',
        'fields'     => array(

            array(
                'id'       => 'appku_blog_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'appku' ),
                'subtitle' => esc_html__( 'Choose blog layout from here. If you use this option then you will able to change three type of blog layout ( Default Left Sidebar Layour ). ', 'appku' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('No Sidebar','appku'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('Left Sidebar','appku'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('Right Sidebar','appku'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'appku_blog_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Post Column', 'appku' ),
                'subtitle' => esc_html__( 'Select your blog post column from here. If you use this option then you will able to select three type of blog post layout ( Default Two Column ).', 'appku' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','appku'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/1column.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','appku'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2column.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','appku'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3column.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'appku_blog_page_title_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__('Show','appku'),
                'off'      => esc_html__('Hide','appku'),
                'title'    => esc_html__('Blog Page Title', 'appku'),
                'subtitle' => esc_html__('Control blog page title show / hide. If you use this option then you will able to show / hide your blog page title ( Default Setting Show ).', 'appku'),
            ),
            array(
                'id'       => 'appku_blog_page_title_setting',
                'type'     => 'button_set',
                'title'    => esc_html__('Blog Page Title Setting', 'appku'),
                'subtitle' => esc_html__('Control blog page title setting. If you use this option then you can able to show default or custom blog page title ( Default Blog ).', 'appku'),
                'options'  => array(
                    "predefine"   => esc_html__('Default','appku'),
                    "custom"      => esc_html__('Custom','appku'),
                ),
                'default'  => 'predefine',
                'required' => array("appku_blog_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'appku_blog_page_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Custom Title', 'appku'),
                'subtitle' => esc_html__('Set blog page custom title form here. If you use this option then you will able to set your won title text.', 'appku'),
                'required' => array('appku_blog_page_title_setting','equals','custom')
            ),
            array(
                'id'            => 'appku_blog_postExcerpt',
                'type'          => 'slider',
                'title'         => esc_html__( 'Blog Posts Excerpt', 'appku' ),
                'subtitle'      => esc_html__( 'Control the number of characters you want to show in the blog page for each post.. If you use this option then you can able to control your blog post characters from here ( Default show 10 ).', 'appku'),
                "default"       => 46,
                "min"           => 0,
                "step"          => 1,
                "max"           => 100,
                'resolution'    => 1,
                'display_value' => 'text',
            ),
            array(
                'id'       => 'appku_blog_readmore_setting',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Read More Text Setting', 'appku' ),
                'subtitle' => esc_html__( 'Control read more text from here.', 'appku' ),
                'options'  => array(
                    "default"   => esc_html__('Default','appku'),
                    "custom"    => esc_html__('Custom','appku'),
                ),
                'default'  => 'default',
            ),
            array(
                'id'       => 'appku_blog_custom_readmore',
                'type'     => 'text',
                'title'    => esc_html__('Read More Text', 'appku'),
                'subtitle' => esc_html__('Set read moer text here. If you use this option then you will able to set your won text.', 'appku'),
                'required' => array('appku_blog_readmore_setting','equals','custom')
            ),
            array(
                'id'       => 'appku_blog_title_color',
                'output'   => array( '.blog-area .info h3 a'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Blog Title Color.', 'appku' ),
            ),
            array(
                'id'       => 'appku_blog_title_hover_color',
                'output'   => array( '.blog-area .info h3 a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Hover Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Blog Title Hover Color.', 'appku' ),
            ),
            array(
                'id'       => 'appku_blog_read_more_button_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Read More Button Color.', 'appku' ),
                'output'  => array('background'   => '.blog-area.full-blog .btn.btn-md')
            ),
            array(
                'id'       => 'appku_blog_read_more_button_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Hover Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Read More Button Hover Color.', 'appku' ),
                'output'  => array('background-color'   => '.blog-area.full-blog .btn.btn-theme::after')
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Blog Page', 'appku' ),
        'id'         => 'appku_post_detail_styles',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'appku_blog_single_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'appku' ),
                'subtitle' => esc_html__( 'Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Left Sidebar Layour ). ', 'appku' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','appku'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','appku'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','appku'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'appku_post_details_title_position',
                'type'     => 'button_set',
                'default'  => 'header',
                'options'  => array(
                    'header'        => esc_html__('On Header','appku'),
                    'below'         => esc_html__('Below Thumbnail','appku'),
                ),
                'title'    => esc_html__('Blog Post Title Position', 'appku'),
                'subtitle' => esc_html__('Control blog post title position from here.', 'appku'),
            ),
            array(
                'id'       => 'appku_post_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Details Custom Title', 'appku'),
                'subtitle' => esc_html__('This title will show in Breadcrumb title.', 'appku'),
                'required' => array('appku_post_details_title_position','equals','below')
            ),
            array(
                'id'       => 'appku_display_post_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'appku' ),
                'subtitle' => esc_html__( 'Switch On to Display Tags.', 'appku' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','appku'),
                'off'       => esc_html__('Disabled','appku'),
            ),
            array(
                'id'       => 'appku_post_details_share_options',
                'type'     => 'switch',
                'title'    => esc_html__('Share Options', 'appku'),
                'subtitle' => esc_html__('Control post share options from here. If you use this option then you will able to show or hide post share options.', 'appku'),
                'on'        => esc_html__('Show','appku'),
                'off'       => esc_html__('Hide','appku'),
                'default'   => '0',
            ),
            array(
                'id'       => 'appku_post_details_author_desc_trigger',
                'type'     => 'switch',
                'title'    => esc_html__('Biography Info', 'appku'),
                'subtitle' => esc_html__('Control biography info from here. If you use this option then you will able to show or hide biography info ( Default setting Show ).', 'appku'),
                'on'        => esc_html__('Show','appku'),
                'off'       => esc_html__('Hide','appku'),
                'default'   => '0',
            ),
            array(
                'id'       => 'appku_post_details_post_navigation',
                'type'     => 'switch',
                'title'    => esc_html__('Post Navigation', 'appku'),
                'subtitle' => esc_html__('Control post navigation from here. If you use this option then you will able to show or hide post navigation ( Default setting Show ).', 'appku'),
                'on'        => esc_html__('Show','appku'),
                'off'       => esc_html__('Hide','appku'),
                'default'   => true,
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Meta Data', 'appku' ),
        'id'         => 'appku_common_meta_data',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'appku_blog_meta_icon_color',
                'output'   => array( '.blog-area .item .info .meta ul li i'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Meta Icon Color', 'appku'),
                'subtitle' => esc_html__('Set Blog Meta Icon Color.', 'appku'),
            ),
            array(
                'id'       => 'appku_blog_meta_text_color',
                'output'   => array( '.blog-area .item .info .meta ul li a'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Text Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Blog Meta Text Color.', 'appku' ),
            ),
            array(
                'id'       => 'appku_blog_meta_text_hover_color',
                'output'   => array( '.blog-area .item .info .meta ul li a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Hover Text Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Blog Meta Hover Text Color.', 'appku' ),
            ),
            array(
                'id'       => 'appku_display_post_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Date', 'appku' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Date.', 'appku' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','appku'),
                'off'       => esc_html__('Disabled','appku'),
            ),
            array(
                'id'       => 'appku_display_admin',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Admin', 'appku' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Admin.', 'appku' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','appku'),
                'off'       => esc_html__('Disabled','appku'),
            ),
            array(
                'id'       => 'appku_display_post_views',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post View Count', 'appku' ),
                'subtitle' => esc_html__( 'Switch On to Display Post View Counter.', 'appku' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','appku'),
                'off'       => esc_html__('Disabled','appku'),
            ),
        )
    ));

    /* Sidebar Start */
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebar Options', 'appku' ),
        'id'         => 'appku_sidebar_options',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'      => 'appku_sidebar_bg_color',
                'type'    => 'color',
                'title'   => esc_html__('Widgets Background Color', 'appku'),
                'output'  => array('background'   => '.blog-area .sidebar .sidebar-item')
            ),
            array(
                'id'      => 'appku_sidebar_padding_margin_box_shadow_trigger',
                'type'    => 'switch',
                'title'   => esc_html__('Widgets Custom Box Shadow/Padding/Margin/border', 'appku'),
                'on'      => esc_html__('Show','appku'),
                'off'     => esc_html__('Hide','appku'),
                'default' => false
            ),
            array(
                'id'      => 'box-shadow',
                'type'    => 'box_shadow',
                'title'   => esc_html__('Box Shadow', 'appku'),
                'units'   => array( 'px', 'em', 'rem' ),
                'output'  => ( '.blog-area .sidebar .sidebar-item' ),
                'opacity' => true,
                'rgba'    => true,
                'required'=> array( 'appku_sidebar_padding_margin_box_shadow_trigger', 'equals' , '1' )
            ),
            array(
                'id'      => 'appku_sidebar_widget_margin',
                'type'    => 'spacing',
                'title'   => esc_html__('Widget Margin', 'appku'),
                'units'   => array('em', 'px'),
                'output'  => ( '.blog-area .sidebar .sidebar-item' ),
                'mode'    => 'margin',
                'required'=> array( 'appku_sidebar_padding_margin_box_shadow_trigger', 'equals' , '1' )
            ),
            array(
                'id'      => 'appku_sidebar_widget_padding',
                'type'    => 'spacing',
                'title'   => esc_html__('Widget Padding', 'appku'),
                'units'   => array('em', 'px'),
                'output'  => ( '.blog-area .sidebar .sidebar-item' ),
                'mode'    => 'padding',
                'required'=> array( 'appku_sidebar_padding_margin_box_shadow_trigger', 'equals' , '1' )
            ),
            array(
                'id'      => 'appku_sidebar_widget_border',
                'type'    => 'border',
                'title'   => esc_html__('Widget Border', 'appku'),
                'units'   => array('em', 'px'),
                'output'  => ( '.blog-area .sidebar .sidebar-item' ),
                'all'     => false,
                'required'=> array( 'appku_sidebar_padding_margin_box_shadow_trigger', 'equals' , '1' )
            ),
            array(
                'id'      => 'appku_sidebar_widget_title_heading_tag',
                'type'     => 'select',
                'options'  => array(
                    'h1'        => esc_html__('H1','appku'),
                    'h2'        => esc_html__('H2','appku'),
                    'h3'        => esc_html__('H3','appku'),
                    'h4'        => esc_html__('H4','appku'),
                    'h5'        => esc_html__('H5','appku'),
                    'h6'        => esc_html__('H6','appku'),
                ),
                'default'  => 'h4',
                'title'   => esc_html__('Widget Title Tag', 'appku'),
            ),
            array(
                'id'      => 'appku_sidebar_widget_title_margin',
                'type'    => 'spacing',
                'title'   => esc_html__('Widget Title Margin', 'appku'),
                'mode'    => 'margin',
                'output'  => array('.blog-sidebar .widget .widget_title'),
                'units'   => array('em', 'px'),
            ),
            array(
                'id'      => 'appku_sidebar_widget_title_padding',
                'type'    => 'spacing',
                'title'   => esc_html__('Widget Title Padding', 'appku'),
                'mode'    => 'padding',
                'output'  => array('.blog-sidebar .widget .widget_title'),
                'units'   => array('em', 'px'),
            ),
            array(
                'id'       => 'appku_sidebar_widget_title_color',
                'output'   =>  array('.blog-area .sidebar h1,.blog-area .sidebar h2,.blog-area .sidebar h3,.blog-area .sidebar h4,.blog-area .sidebar h5,.blog-area .sidebar h6'),
                'type'     => 'color',
                'title'    => esc_html__('Widget Title Color', 'appku'),
                'subtitle' => esc_html__('Set Widget Title Color.', 'appku'),
            ),
            array(
                'id'       => 'appku_sidebar_widget_text_color',
                'output'   => array('.blog-area .sidebar'),
                'type'     => 'color',
                'title'    => esc_html__('Widget Text Color', 'appku'),
                'subtitle' => esc_html__('Set Widget Text Color.', 'appku'),
            ),
            array(
                'id'       => 'appku_sidebar_widget_anchor_color',
                'type'     => 'color',
                'output'   => array('.blog-area .sidebar a'),
                'title'    => esc_html__('Widget Anchor Color', 'appku'),
                'subtitle' => esc_html__('Set Widget Anchor Color.', 'appku'),
            ),
            array(
                'id'       => 'appku_sidebar_widget_anchor_hover_color',
                'type'     => 'color',
                'output'   => array('.blog-area .sidebar a:hover'),
                'title'    => esc_html__('Widget Hover Color', 'appku'),
                'subtitle' => esc_html__('Set Widget Anchor Hover Color.', 'appku'),
            )
        )
    ));
    /* Sidebar End */

    /* End blog Page */

    // -> START Page Option
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'appku' ),
        'id'         => 'appku_page_page',
        'icon'  => 'el el-file',
        'fields'     => array(
            array(
                'id'       => 'appku_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select layout', 'appku' ),
                'subtitle' => esc_html__( 'Choose your page layout. If you use this option then you will able to choose three type of page layout ( Default no sidebar ). ', 'appku' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','appku'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','appku'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','appku'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'appku_page_layoutopt',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Settings', 'appku'),
                'subtitle' => esc_html__('Set page sidebar. If you use this option then you will able to set three type of sidebar ( Default no sidebar ).', 'appku'),
                //Must provide key => value pairs for options
                'options' => array(
                    '1' => esc_html__( 'Page Sidebar', 'appku' ),
                    '2' => esc_html__( 'Blog Sidebar', 'appku' )
                 ),
                'default' => '1',
                'required'  => array('appku_page_sidebar','!=','1')
            ),
            array(
                'id'       => 'appku_page_title_switcher',
                'type'     => 'switch',
                'title'    => esc_html__('Title', 'appku'),
                'subtitle' => esc_html__('Switch enabled to display page title. Fot this option you will able to show / hide page title.  Default setting Enabled', 'appku'),
                'default'  => '1',
                'on'        => esc_html__('Enabled','appku'),
                'off'       => esc_html__('Disabled','appku'),
            ),
            array(
                'id'       => 'appku_page_title_tag',
                'type'     => 'select',
                'options'  => array(
                    'h1'        => esc_html__('H1','appku'),
                    'h2'        => esc_html__('H2','appku'),
                    'h3'        => esc_html__('H3','appku'),
                    'h4'        => esc_html__('H4','appku'),
                    'h5'        => esc_html__('H5','appku'),
                    'h6'        => esc_html__('H6','appku'),
                ),
                'default'  => 'h1',
                'title'    => esc_html__( 'Title Tag', 'appku' ),
                'subtitle' => esc_html__( 'Select page title tag. If you use this option then you can able to change title tag H1 - H6 ( Default tag H1 )', 'appku' ),
                'required' => array("appku_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'appku_allHeader_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Title Color', 'appku' ),
                'subtitle' => esc_html__( 'Set Title Color', 'appku' ),
                'output'   => array( 'color' => '.breadcumb-title' ),
            ),
            array(
                'id'       => 'appku_allHeader_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'appku' ),
                'output'   => array('.breadcrumb-area'),
                'subtitle' => esc_html__( 'Setting page header background. If you use this option then you will able to set Background Color, Background Image, Background Repeat, Background Size, Background Attachment, Background Position.', 'appku' ),
            ),
            array(
                'id'       => 'appku_enable_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb Hide/Show', 'appku' ),
                'subtitle' => esc_html__( 'Hide / Show breadcrumb from all pages and posts ( Default settings hide ).', 'appku' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'appku_allHeader_breadcrumbtextcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Color', 'appku' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text color here.If you user this option then you will able to set page breadcrumb color.', 'appku' ),
                'required' => array("appku_page_title_switcher","equals","1"),
                'output'   => array( 'color' => '.breadcrumb-area .breadcrumb a, .breadcrumb-area .breadcrumb li' ),
            ),
            array(
                'id'       => 'appku_allHeader_breadcrumbtextactivecolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Active Color', 'appku' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text active color here.If you user this option then you will able to set page breadcrumb active color.', 'appku' ),
                'required' => array( "appku_page_title_switcher", "equals", "1" ),
                'output'   => array( 'color' => '.breadcrumb-area .breadcrumb li.active' ),
            ),
            array(
                'id'       => 'appku_allHeader_dividercolor',
                'type'     => 'color',
                'output'   => array( 'background'=>'.breadcrumb-area .breadcrumb li::after' ),
                'title'    => esc_html__( 'Breadcrumb Divider Color', 'appku' ),
                'subtitle' => esc_html__( 'Choose breadcrumb divider color.', 'appku' ),
            ),
        ),
    ) );
    /* End Page option */

    // -> START 404 Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'appku' ),
        'id'         => 'appku_404_page',
        'icon'       => 'el el-ban-circle',
        'fields'     => array(
            array(
                'id'       => 'appku_fof_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Title', 'appku' ),
                'subtitle' => esc_html__( 'Set Page Title', 'appku' ),
                'default'  => esc_html__( '404', 'appku' ),
            ),
            array(
                'id'       => 'appku_fof_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Subtitle', 'appku' ),
                'subtitle' => esc_html__( 'Set Page Subtitle ', 'appku' ),
                'default'  => esc_html__( 'Oops! That page can\'t be found.', 'appku' ),
            ),
            array(
                'id'       => 'appku_fof_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Description', 'appku' ),
                'subtitle' => esc_html__( 'Set Page Subtitle ', 'appku' ),
                'default'  => esc_html__( 'Unfortunately, something went wrong and this page does not exist. Try using the search or return to the previous page.', 'appku' ),
            ),
            array(
                'id'       => 'appku_fof_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'appku' ),
                'subtitle' => esc_html__( 'Set Button Text ', 'appku' ),
                'default'  => esc_html__( 'Return To Home', 'appku' ),
            ),
            array(
                'id'       => 'appku_fof_text_color',
                'type'     => 'color',
                'output'   => array( '.error-page-area .error-box h1' ),
                'title'    => esc_html__( 'Title Color', 'appku' ),
                'subtitle' => esc_html__( 'Pick a title color', 'appku' ),
                'validate' => 'color'
            ),
            array(
                'id'       => 'appku_fof_subtitle_color',
                'type'     => 'color',
                'output'   => array( '.error-page-area .error-box h2' ),
                'title'    => esc_html__( 'Subtitle Color', 'appku' ),
                'subtitle' => esc_html__( 'Pick a subtitle color', 'appku' ),
                'validate' => 'color'
            ),
        ),
    ) );

    // -> START Gallery
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Gallery', 'appku' ),
        'id'         => 'appku_gallery_widget',
        'icon'       => 'el el-gift',
        'fields'     => array(
            array(
                'id'          => 'appku_gallery_image_widget',
                'type'        => 'slides',
                'title'       => esc_html__( 'Add Gallery Image', 'appku' ),
                'subtitle'    => esc_html__( 'Add gallery Image and url.', 'appku' ),
                'show'        => array(
                    'title'          => false,
                    'description'    => false,
                    'progress'       => false,
                    'icon'           => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => true,
                ),
            ),
        ),
    ) );
    // -> START Subscribe
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Subscribe', 'appku' ),
        'id'         => 'appku_subscribe_page',
        'icon'       => 'el el-eject',
        'fields'     => array(

            array(
                'id'       => 'appku_subscribe_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp API Key', 'appku' ),
                'subtitle' => esc_html__( 'Set mailchimp api key.', 'appku' ),
            ),
            array(
                'id'       => 'appku_subscribe_listid',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp List ID', 'appku' ),
                'subtitle' => esc_html__( 'Set mailchimp list id.', 'appku' ),
            ),
        ),
    ) );

    /* End Subscribe */

    // -> START Social Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'appku' ),
        'id'         => 'appku_social_media',
        'icon'      => 'el el-globe',
        'desc'      => esc_html__( 'Social', 'appku' ),
        'fields'     => array(
            array(
                'id'          => 'appku_social_links',
                'type'        => 'slides',
                'title'       => esc_html__('Social Profile Links', 'appku'),
                'subtitle'    => esc_html__('Add social icon and url.', 'appku'),
                'show'        => array(
                    'title'          => true,
                    'description'    => true,
                    'progress'       => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => false,
                ),
                'placeholder'   => array(
                    'icon'          => esc_html__( 'Icon (example: fa fa-facebook) ','appku'),
                    'title'         => esc_html__( 'Social Icon Class', 'appku' ),
                    'description'   => esc_html__( 'Social Icon Title', 'appku' ),
                ),
            ),
        ),
    ) );

    /* End social Media */


    // -> START Footer Media
    Redux::setSection( $opt_name , array(
       'title'            => esc_html__( 'Footer', 'appku' ),
       'id'               => 'appku_footer',
       'desc'             => esc_html__( 'appku Footer', 'appku' ),
       'customizer_width' => '400px',
       'icon'              => 'el el-photo',
   ) );

   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'Pre-built Footer / Footer Builder', 'appku' ),
       'id'         => 'appku_footer_section',
       'subsection' => true,
       'fields'     => array(
            array(
               'id'       => 'appku_footer_builder_trigger',
               'type'     => 'button_set',
               'default'  => 'prebuilt',
               'options'  => array(
                   'footer_builder'        => esc_html__('Footer Builder','appku'),
                   'prebuilt'              => esc_html__('Pre-built Footer','appku'),
               ),
               'title'    => esc_html__( 'Footer Builder', 'appku' ),
            ),
            array(
               'id'       => 'appku_footer_builder_select',
               'type'     => 'select',
               'required' => array( 'appku_footer_builder_trigger','equals','footer_builder'),
               'data'     => 'posts',
               'args'     => array(
                   'post_type'     => 'appku_footer'
               ),
               'on'       => esc_html__( 'Enabled', 'appku' ),
               'off'      => esc_html__( 'Disable', 'appku' ),
               'title'    => esc_html__( 'Select Footer', 'appku' ),
               'subtitle' => esc_html__( 'First make your footer from footer custom types then select it from here.', 'appku' )
            ),
            array(
               'id'       => 'appku_footerwidget_enable',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer Widget', 'appku' ),
               'default'  => 0,
               'on'       => esc_html__( 'Enabled', 'appku' ),
               'off'      => esc_html__( 'Disable', 'appku' ),
               'required' => array( 'appku_footer_builder_trigger','equals','prebuilt'),
            ),
            array(
               'id'       => 'appku_footer_background',
               'type'     => 'background',
               'default'  => '#202942',
               'title'    => esc_html__( 'Footer Background', 'appku' ),
               'subtitle' => esc_html__( 'Set footer background.', 'appku' ),
               'output'   => array( '.footer-custom-style' ),
               'required' => array( 'appku_footerwidget_enable','=','1' ),
            ),
            array(
               'id'       => 'appku_footer_background2',
               'type'     => 'color',
               'title'    => esc_html__( 'End Footer Background', 'appku' ),
               'required' => array('appku_footerwidget_enable','=','1'),
               'output'   => array( 'background'   =>   'footer .f-items .f-item.contact-widget::after' ),
            ),
            array(
               'id'       => 'appku_footer_widget_title_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Widget Title Color', 'appku' ),
               'required' => array('appku_footerwidget_enable','=','1'),
               'output'   => array( '.footer-custom-style h4' ),
            ),
            array(
               'id'       => 'appku_footer_widget_anchor_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Widget Anchor Color', 'appku' ),
               'required' => array('appku_footerwidget_enable','=','1'),
               'output'   => array( '.footer-custom-style a' ),
            ),
            array(
               'id'       => 'appku_footer_widget_anchor_hov_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Widget Anchor Hover Color', 'appku' ),
               'required' => array('appku_footerwidget_enable','=','1'),
               'output'   => array( '.footer-layout4 .footer-wid-wrap .widget_contact p a:hover,.footer-layout4 .footer-wid-wrap .widget-links ul li a:hover' ),
            ),
            array(
               'id'       => 'appku_disable_footer_bottom',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer Bottom?', 'appku' ),
               'default'  => 1,
               'on'       => esc_html__('Enabled','appku'),
               'off'      => esc_html__('Disable','appku'),
               'required' => array('appku_footer_builder_trigger','equals','prebuilt'),
            ),
            array(
               'id'       => 'appku_footer_bottom_background',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Bottom Background Color', 'appku' ),
               'required' => array( 'appku_disable_footer_bottom','=','1' ),
               'output'   => array( 'background-color'   =>   '.footer-bottom' ),
            ),
            array(
               'id'       => 'appku_copyright_text',
               'type'     => 'text',
               'title'    => esc_html__( 'Copyright Text', 'appku' ),
               'subtitle' => esc_html__( 'Add Copyright Text', 'appku' ),
               'default'  => sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Appku.','appku' ),esc_url('#'),__( 'Validthemes', 'appku' ) ),
               'required' => array( 'appku_disable_footer_bottom','equals','1' ),
            ),
            array(
               'id'       => 'appku_footer_copyright_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Text Color', 'appku' ),
               'subtitle' => esc_html__( 'Set footer copyright text color', 'appku' ),
               'required' => array( 'appku_disable_footer_bottom','equals','1'),
               'output'   => array( 'footer .footer-bottom p' ),
            ),
            array(
               'id'       => 'appku_footer_copyright_acolor',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Ancor Color', 'appku' ),
               'subtitle' => esc_html__( 'Set footer copyright ancor color', 'appku' ),
               'required' => array( 'appku_disable_footer_bottom','equals','1'),
               'output'   => array( 'footer .footer-bottom p a' ),
            ),
            array(
               'id'       => 'appku_footer_copyright_a_hover_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Ancor Hover Color', 'appku' ),
               'subtitle' => esc_html__( 'Set footer copyright ancor Hover color', 'appku' ),
               'required' => array( 'appku_disable_footer_bottom','equals','1'),
               'output'   => array( 'footer .footer-bottom p a:hover' ),
            ),

       ),
   ) );


    /* End Footer Media */

    // -> START Custom Css
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Css', 'appku' ),
        'id'         => 'appku_custom_css_section',
        'icon'  => 'el el-css',
        'fields'     => array(
            array(
                'id'       => 'appku_css_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__('CSS Code', 'appku'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'appku'),
                'mode'     => 'css',
                'theme'    => 'monokai',
            )
        ),
    ) );

    /* End custom css */



    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'appku' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'appku' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'appku' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }