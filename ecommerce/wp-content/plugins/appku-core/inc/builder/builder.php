<?php
    /**
     * Class For Builder
     */
    class AppkuBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'appku_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'appku-core',APPKU_PLUGDIRURI.'assets/js/appku-core.js',array( 'jquery' ),'1.0',true );
		}


        public function appku_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'appku_header_option',
                [
                    'label'     => __( 'Header Option', 'appku' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'appku_header_style',
                [
                    'label'     => __( 'Header Option', 'appku' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'appku' ),
    					'header_builder'       => __( 'Header Builder', 'appku' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'appku_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'appku' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->appku_header_choose_option(),
                    'condition' => [ 'appku_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'appku_footer_option',
                [
                    'label'     => __( 'Footer Option', 'appku' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'appku_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'appku' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'appku' ),
    				'label_off'     => __( 'No', 'appku' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'appku_footer_style',
                [
                    'label'     => __( 'Footer Style', 'appku' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'appku' ),
    					'footer_builder'       => __( 'Footer Builder', 'appku' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'appku_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'appku_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'appku' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->appku_footer_choose_option(),
                    'condition' => [ 'appku_footer_style' => 'footer_builder','appku_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Appku Builder', 'appku' ),
            	esc_html__( 'Appku Builder', 'appku' ),
				'manage_options',
				'appku',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('appku', esc_html__('Footer Builder', 'appku'), esc_html__('Footer Builder', 'appku'), 'manage_options', 'edit.php?post_type=appku_footer');
			add_submenu_page('appku', esc_html__('Header Builder', 'appku'), esc_html__('Header Builder', 'appku'), 'manage_options', 'edit.php?post_type=appku_header');
            add_submenu_page('appku', esc_html__('Tab Builder', 'appku'), esc_html__('Tab Builder', 'appku'), 'manage_options', 'edit.php?post_type=appku_tab_builder');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','appku' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'appku' ),
				'singular_name'      => __( 'Footer', 'appku' ),
				'menu_name'          => __( 'Appku Footer Builder', 'appku' ),
				'name_admin_bar'     => __( 'Footer', 'appku' ),
				'add_new'            => __( 'Add New', 'appku' ),
				'add_new_item'       => __( 'Add New Footer', 'appku' ),
				'new_item'           => __( 'New Footer', 'appku' ),
				'edit_item'          => __( 'Edit Footer', 'appku' ),
				'view_item'          => __( 'View Footer', 'appku' ),
				'all_items'          => __( 'All Footer', 'appku' ),
				'search_items'       => __( 'Search Footer', 'appku' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'appku' ),
				'not_found'          => __( 'No Footer found.', 'appku' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'appku' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'appku_footer', $args );

			$labels = array(
				'name'               => __( 'Header', 'appku' ),
				'singular_name'      => __( 'Header', 'appku' ),
				'menu_name'          => __( 'Appku Header Builder', 'appku' ),
				'name_admin_bar'     => __( 'Header', 'appku' ),
				'add_new'            => __( 'Add New', 'appku' ),
				'add_new_item'       => __( 'Add New Header', 'appku' ),
				'new_item'           => __( 'New Header', 'appku' ),
				'edit_item'          => __( 'Edit Header', 'appku' ),
				'view_item'          => __( 'View Header', 'appku' ),
				'all_items'          => __( 'All Header', 'appku' ),
				'search_items'       => __( 'Search Header', 'appku' ),
				'parent_item_colon'  => __( 'Parent Header:', 'appku' ),
				'not_found'          => __( 'No Header found.', 'appku' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'appku' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'appku_header', $args );

            $labels = array(
				'name'               => __( 'Tab Builder', 'appku' ),
				'singular_name'      => __( 'Tab Builder', 'appku' ),
				'menu_name'          => __( 'Appku Tab Builder', 'appku' ),
				'name_admin_bar'     => __( 'Tab Builder', 'appku' ),
				'add_new'            => __( 'Add New', 'appku' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'appku' ),
				'new_item'           => __( 'New Tab Builder', 'appku' ),
				'edit_item'          => __( 'Edit Tab Builder', 'appku' ),
				'view_item'          => __( 'View Tab Builder', 'appku' ),
				'all_items'          => __( 'All Tab Builder', 'appku' ),
				'search_items'       => __( 'Search Tab Builder', 'appku' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'appku' ),
				'not_found'          => __( 'No Tab Builder found.', 'appku' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'appku' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'appku_tab_builder', $args );

		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'appku_footer' == $post->post_type || 'appku_header' == $post->post_type || 'appku_tab_builder' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function appku_footer_choose_option(){

			$appku_post_query = new WP_Query( array(
				'post_type'			=> 'appku_footer',
				'posts_per_page'	    => -1,
			) );

			$appku_builder_post_title = array();
			$appku_builder_post_title[''] = __('Select a Footer','Appku');

			while( $appku_post_query->have_posts() ) {
				$appku_post_query->the_post();
				$appku_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $appku_builder_post_title;

		}

		public function appku_header_choose_option(){

			$appku_post_query = new WP_Query( array(
				'post_type'			=> 'appku_header',
				'posts_per_page'	    => -1,
			) );

			$appku_builder_post_title = array();
			$appku_builder_post_title[''] = __('Select a Header','Appku');

			while( $appku_post_query->have_posts() ) {
				$appku_post_query->the_post();
				$appku_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $appku_builder_post_title;

        }

    }

    $builder_execute = new AppkuBuilder();