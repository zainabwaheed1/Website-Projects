<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Blog Post Widget .
 *
 */
class Appku_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'appkublogpost';
	}

	public function get_title() {
		return __( 'Appku Blog Post', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'appku' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'blog_style',
			[
				'label' 		=> __( 'Blog Style', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'appku' ),
					'2' 		=> __( 'Style Two', 'appku' ),
				],
			]
		);
        $this->add_control(
			'section_heading',
			[
				'label' 		=> __( 'Allow Section Heading ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'section_heading' => [ 'yes']],
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Subtitle', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 3,
                'default'  	=> __( 'The Description area', 'appku' ),
                'condition'		=> [ 'section_heading' => [ 'yes']],
			]
        );

        $this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'appku' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'appku' )
			]
        );

		$this->add_control(
			'title_count',
			[
				'label' 	=> __( 'Title Length', 'appku' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '4', 'appku' ),
			]
		);
		$this->add_control(
			'excerpt_count',
			[
				'label' 	=> __( 'Excerpt Length', 'appku' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '16', 'appku' ),
			]
		);

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'appku' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','appku'),
                    'DESC'   	=> __('DESC','appku'),
                ],
                'default'  	=> 'DESC'
			]
        );

        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'appku' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'appku' ),
                    'author'    => __( 'Author', 'appku' ),
                    'title'    	=> __( 'Title', 'appku' ),
                    'date'    	=> __( 'Date', 'appku' ),
                    'rand'    	=> __( 'Random', 'appku' ),
                ],
                'default'  	=> 'ID'
			]
        );

        $this->add_control(
			'exclude_cats',
			[
				'label' 		=> __( 'Exclude Categories', 'appku' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->appku_get_categories(),
			]
        );

        $this->add_control(
			'exclude_tags',
			[
				'label' 		=> __( 'Exclude Tags', 'appku' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->appku_get_tags(),
			]
        );

        $this->add_control(
			'exclude_post_id',
			[
				'label'         => __( 'Exclude Post', 'appku' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->appku_post_id(),
			]
        );
        $this->add_control(
			'read_more',
			[
				'label' 	=> __( 'Read More Text', 'appku' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Read More', 'appku' ),
			]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'slider_control_section',
			[
				'label' 		=> __( 'Slider Control', 'appku' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'make_slider',
			[
				'label' 		=> __( 'Use it as slider ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'desktop_items',
			[
				'label' 		=> __( 'Items To Show', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 10,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 5,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'laptop_items',
			[
				'label' 		=> __( 'Laptop Items', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);

        $this->add_control(
			'tablet_items',
			[
				'label' 		=> __( 'Tablet Items', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);

        $this->add_control(
			'mobile_items',
			[
				'label' 		=> __( 'Mobile Items', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 1,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'colmn_items',
			[
				'label' 		=> __( 'Column View', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 4,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 4,
				],
				'condition'		=> [ 'make_slider!' =>  'yes' ],
			]
		);
		$this->end_controls_section();


		/*-----------------------------------------general styling------------------------------------*/

		$this->start_controls_section(
			'general_styling',
			[
				'label' 	=> __( 'Gneral Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_responsive_control(
			'Item_icon_align',
			[
				'label' 		=> __( 'Alignment', 'appku' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'appku' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'appku' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'appku' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'center',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area.grid-style .info' => 'text-align: {{VALUE}};',
                ],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Image Hover Animation', 'appku' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Image Frame', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .thumb img',
			]
		);
		$this->add_responsive_control(
			'img_border_radius',
			[
				'label' 		=> __( 'Image Border Radius', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->end_controls_section();



        /*-----------------------------------------META styling------------------------------------*/

		$this->start_controls_section(
			'meta_con_styling',
			[
				'label' 	=> __( 'Meta Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'meta_tabs3'
		);


		$this->start_controls_tab(
			'meta_normal_tab3',
			[
				'label' => esc_html__( 'Icon', 'appku' ),
			]
		);
        $this->add_control(
			'meta_title_color',
			[
				'label' 		=> __( 'Icon Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area .item .info .meta ul li i'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_control(
			'icon_size',
			[
				'label' 		=> __( 'icon Size', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 100,
					],
				],
				'default' 		=> [
					'unit' 			=> 'px',
					'size' 			=> 4,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-area .item .info .meta ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'meta_hover_tab4',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			'meta_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area .item .info .meta ul li, {{WRAPPER}} .blog-area .item .info .meta ul li a'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'meta_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .blog-area .item .info .meta ul li, {{WRAPPER}} .blog-area .item .info .meta ul li a',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		/*-----------------------------------------section Content styling------------------------------------*/

		$this->start_controls_section(
			'section_con_styling',
			[
				'label' 	=> __( 'Section Heading', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs3'
		);


		$this->start_controls_tab(
			'style_normal_tab3',
			[
				'label' => esc_html__( 'Title', 'appku' ),
			]
		);
        $this->add_control(
			's_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading h2'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .site-heading h2',
			]
		);

        $this->add_responsive_control(
			's_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			's_title_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab4',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			's_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading p'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .site-heading p',
			]
		);

        $this->add_responsive_control(
			's_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			's_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_normal_tab4',
			[
				'label' => esc_html__( 'Devider', 'appku' ),
			]
		);
        $this->add_control(
			'devider_color',
			[
				'label' 		=> __( 'Devider Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading .devider::before,{{WRAPPER}} .site-heading .devider'	=> '--color-primary: {{VALUE}}!important;',
				],
			]
        );
        
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		/*-----------------------------------------Blog Content styling------------------------------------*/

		$this->start_controls_section(
			'blog_con_styling',
			[
				'label' 	=> __( 'Blog Content Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'blog_tabs3'
		);


		$this->start_controls_tab(
			'blog_normal_tab3',
			[
				'label' => esc_html__( 'Title', 'appku' ),
			]
		);
        $this->add_control(
			'blog_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h4 a'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_control(
			'blog_title_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area h4 a:hover'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'blog_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h4 a',
			]
		);

        $this->add_responsive_control(
			'blog_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'blog_title_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'blog_hover_tab4',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			'blog_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .info p'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'blog_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .info p',
			]
		);

        $this->add_responsive_control(
			'blog_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'blog_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

		$this->end_controls_tab();

		//-----------------------------------------------three-----------------------------------------------//

		$this->start_controls_tab(
			'blog_normal_tab4',
			[
				'label' => esc_html__( 'Button', 'appku' ),
			]
		);
        $this->add_control(
			'blog_btn_color',
			[
				'label' 		=> __( 'Button Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-simple'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_control(
			'blog_btn_hvr_color',
			[
				'label' 		=> __( 'Button Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-simple:hover'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

    }

    public function appku_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name,'appku');
        }

        return $catarr;
    }

    public function appku_get_tags() {
        $cats = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name,'appku');
        }

        return $catarr;
    }

    // Get Specific Post
    public function appku_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $appku_post = new WP_Query( $args );

        $postarray = [];

        while( $appku_post->have_posts() ){
            $appku_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();
        $exclude_post = $settings['exclude_post_id'];

        if( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats']
            );
        } elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags']
            );
        }elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
            );
        } elseif( empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'post__not_in'          => $exclude_post
            );
        } else {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true
            );
        }

        if( $settings['make_slider'] == 'yes' ){
			$this->add_render_attribute( 'wrapper', 'class', 'row blog-carousel owl-carousel owl-theme' );
			$this->add_render_attribute( 'wrapper', 'data-slide-show', $settings['desktop_items']['size'] );
	        $this->add_render_attribute( 'wrapper', 'data-lg-slide-show', $settings['laptop_items']['size'] );
	        $this->add_render_attribute( 'wrapper', 'data-md-slide-show', $settings['tablet_items']['size'] );
	        $this->add_render_attribute( 'wrapper', 'data-sm-slide-show', $settings['mobile_items']['size'] );
		}else{
			$this->add_render_attribute( 'wrapper', 'class', 'row' );
			if( $settings['colmn_items']['size'] == 1 ){
				$colmn = 12;
			}elseif( $settings['colmn_items']['size'] == 2 ){
				$colmn = 6;
			}elseif( $settings['colmn_items']['size'] == 3 ){
				$colmn = 4;
			}else{
				$colmn = 3;
			}
		}
		$elementClass = 'thumb';

		if ( $settings['hover_animation'] ) {
			$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
		}

        $blogpost = new WP_Query( $args );

        if( $blogpost->have_posts() ) {
        	if( $settings['blog_style'] == '1' ){
        		$style = 'grid-style';
        	}else{
        		$style = 'blog-style2';
        	}

        	echo '<div class="blog-area '.esc_attr($style).'">';
		        if( $settings['section_heading'] == 'yes' ){
			        echo '<div class="container">';
			            echo '<div class="row">';
			                echo '<div class="col-lg-8 offset-lg-2">';
			                    echo '<div class="site-heading text-light text-center">';
			                    	if(!empty($settings['title'])){
		                              	echo '<h2>'.esc_html($settings['title']).'</h2>';
		                            }
		                            echo '<div class="devider"></div>';
		                            if(!empty($settings['subtitle'])){
		                               	echo '<p>'.esc_html($settings['subtitle']).'</p>';
		                            }  
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			    }
		        echo '<div class="container">';
		            echo '<div '.$this->get_render_attribute_string('wrapper').'>';
		            	while( $blogpost->have_posts() ) {
							$blogpost->the_post();
			                echo '<!-- Single item -->';
			                if( $settings['make_slider'] == 'yes' ){
			                    echo '<div class="single-item">';
			                }else{
			                	echo '<div class="single-item col-lg-'.$colmn.' col-md-6">';
			                }	if( $settings['blog_style'] == '1' ){
				                    echo '<div class="item">';
				                    	if( has_post_thumbnail() ){
					                        echo '<div class="'.$elementClass.'">';
					                            the_post_thumbnail( 'appku_800X600' );
					                        echo '</div>';
					                    }
				                        echo '<div class="info">';
				                            echo '<div class="meta">';
				                                echo '<ul>';
				                                    echo '<li><i class="fas fa-calendar-alt"></i> '.esc_html( get_the_date() ).'</li>';
				                                    echo '<li><a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="fas fa-user-circle"></i><span>'.esc_html( ucwords( get_the_author() ) ).'</span></a></li>';
				                                echo '</ul>';
				                            echo '</div>';
				                            echo '<h4><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h4>';
				                            echo '<p>'.esc_html( wp_trim_words( get_the_content( ), $settings['excerpt_count'], '' ) ).'</p>';
				                            if(!empty($settings['read_more'])){
					                            echo '<a class="btn-simple" href="'.esc_url( get_permalink() ).'">'.esc_html($settings['read_more']).' <i class="fas fa-plus"></i></a>';
					                        }
				                        echo '</div>';
				                    echo '</div>';
				                }else{
				                	echo '<div class="item">';
				                		if( has_post_thumbnail() ){
					                        echo '<div class="'.$elementClass.'">';
					                            the_post_thumbnail( 'appku_800X600' );
					                            echo '<div class="date"><strong>'.esc_html( get_the_date( 'd' ) ).'</strong> <span>'.esc_html( get_the_date( 'M' ) ).'</span></div>';
					                        echo '</div>';
					                    }
				                        echo '<div class="info">';
				                            echo '<div class="meta">';
				                                echo '<ul>';
				                                    echo '<li><a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="fas fa-user-circle"></i>'.esc_html( ucwords( get_the_author() ) ).'</a></li>';

				                                    if(get_comments_number() > 1){
					                                	$text = ' Comments';
					                                }else{
					                                	$text = ' Comment';
					                                }
				                                    echo '<li><a href="'.esc_url( get_comments_link( get_the_ID() ) ).'"><i class="fas fa-comments"></i>'.esc_html( get_comments_number() ).$text.'</a></li>';
				                                echo '</ul>';
				                            echo '</div>';
				                            echo '<h4><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h4>';
				                            echo '<p>'.esc_html( wp_trim_words( get_the_content( ), $settings['excerpt_count'], '' ) ).'</p>';
				                        echo '</div>';
				                    echo '</div>';
				                }
			                echo '</div>';
			                echo '<!-- End Single item -->';
			            }
			            wp_reset_postdata();
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
        }   
	}
}