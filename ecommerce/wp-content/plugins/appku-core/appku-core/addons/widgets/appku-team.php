<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Team Process Widget .
 *
 */
class Appku_Team extends Widget_Base {

	public function get_name() {
		return 'appkuteam';
	}

	public function get_title() {
		return __( 'Appku Team', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_section',
			[
				'label'     => __( 'Team', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
         $this->add_control(
			'team_style',
			[
				'label' 		=> __( 'Team Style', 'appku' ),
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
		$repeater = new Repeater();

        $repeater->add_control(
			'name', [
				'label' 		=> __( 'Name', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'details_page', [
				'label' 		=> __( 'Single Page URL', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'desig', [
				'label' 		=> __( 'Designation', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Operations officer' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'facebook', [
				'label' 		=> __( 'Facebook', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
        );
        $repeater->add_control(
			'twitter', [
				'label' 		=> __( 'Twitter', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
        );
        $repeater->add_control(
			'instagram', [
				'label' 		=> __( 'Instagram', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
        );
        $repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Shape Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
						'plan_icon' 		=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ name }}}',
				'condition'		=> [ 'team_style' => [ '1' ] ],
			]
		);

		// repeter for style two--//

		$repeater = new Repeater();

        $repeater->add_control(
			'name', [
				'label' 		=> __( 'Name', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'details_page', [
				'label' 		=> __( 'Single Page URL', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'desig', [
				'label' 		=> __( 'Designation', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Operations officer' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        
        $repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'shape_image',
			[
				'label' 		=> __( 'Shape Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_control(
			'slides2',
			[
				'label' 		=> __( 'Slides', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
						'plan_icon' 		=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ name }}}',
				'condition'		=> [ 'team_style' => [ '2' ] ],
			]
		);

		$this->add_control(
			'shape_image',
			[
				'label' 		=> __( 'Shape Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		//------------------------------------feature Control------------------------------------//

		$this->start_controls_section(
			'team_control',
			[
				'label'     => __( 'Team Control', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
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
			'general_con_styling',
			[
				'label' 	=> __( 'General', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_responsive_control(
			'section_title_align',
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
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .info' => 'text-align: {{VALUE}};',
                ]
			]
		);
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



        /*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Team Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Name', 'appku' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-area .team-items .info h4,{{WRAPPER}} .info h4'	=> '--color-heading: {{VALUE}}!important;'
				],
			]
        );
        $this->add_control(
			'overview_title_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-area .info h4 a:hover'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h4',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_title_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Designation', 'appku' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} span'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} span',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Team Process Area start ------------------------------->';
        if( $settings['make_slider'] == 'yes' ){
			$this->add_render_attribute( 'wrapper', 'class', 'row team-carousel owl-carousel owl-theme' );
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
        echo '<div id="team" class="team-area">';
        	if( ! empty( $settings['shape_image']['url'] ) ){
		        echo '<!-- Shape -->';
		        echo '<div class="fixed-shape" style="background-image: url('.esc_url( $settings['shape_image']['url'] ).');"></div>';
		        echo '<!-- End Shape -->';
		    }
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
	        	if( $settings['team_style'] == '1' ){
		            echo '<div class="team-items">';
		                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
		                    foreach( $settings['slides'] as $single_data ){
		                    	$id = uniqid();
		                    	$url = $single_data['details_page'] ;
	                    		if(!empty($url)){
	                    			$url_start_tag 	= '<a href="'.esc_url($url).'">';
	                    			$url_end_tag 	= '</a>';
	                    		}else{
	                    			$url_start_tag 	= '';
	                    			$url_end_tag 	= '';
	                    		}
			                    echo '<!-- Single Item -->';
			                    if( $settings['make_slider'] == 'yes' ){
				                    echo '<div class="single-item">';
				                }else{
				                	echo '<div class="single-item col-lg-'.$colmn.' col-md-6">';
				                }
			                        echo '<div class="item">';
			                            echo '<div class="thumb">';
			                            	if(!empty($single_data['image']['url'])){
				                                echo appku_img_tag( array(
													'url'	=> esc_url( $single_data['image']['url'] ),
												) );
				                            }
			                                echo '<div class="social">';
			                                    echo '<input type="checkbox" id="toggle'.esc_attr($id).'" class="share-toggle" hidden>';
			                                    echo '<label for="toggle'.esc_attr($id).'" class="share-button"><i class="fas fa-plus"></i></label>';

			                                    echo '<a href="'.esc_url($single_data['facebook']['url']).'" class="share-icon facebook"><i class="fab fa-facebook-f"></i></a>';
			                                    echo '<a href="'.esc_url($single_data['twitter']['url']).'" class="share-icon twitter"><i class="fab fa-twitter"></i></a>';
			                                    echo '<a href="'.esc_url($single_data['instagram']['url']).'" class="share-icon instagram"><i class="fab fa-instagram"></i></a>';
			                                echo '</div>';
			                            echo '</div>';
			                            echo '<div class="info">';
			                            	if(!empty($single_data['name'])){
				                                echo '<h4>'.$url_start_tag.esc_html($single_data['name']).$url_end_tag.'</h4>';
				                            }
				                            if(!empty($single_data['desig'])){
				                                echo '<span>'.wp_kses_post($single_data['desig']).'</span>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                    echo '<!-- End Single Item -->';
			                }

		                echo '</div>';
		           	echo '</div>';
		        }else{
		        	echo '<div class="team-style-two-box">';
		                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
		                	foreach( $settings['slides2'] as $single_data ){
		                    	$id = uniqid();
		                    	$url = $single_data['details_page'] ;
	                    		if(!empty($url)){
	                    			$url_start_tag 	= '<a href="'.esc_url($url).'">';
	                    			$url_end_tag 	= '</a>';
	                    		}else{
	                    			$url_start_tag 	= '';
	                    			$url_end_tag 	= '';
	                    		}
			                    echo '<!-- Single Item -->';
			                    if( $settings['make_slider'] == 'yes' ){
				                    echo '<div class="single-item">';
				                }else{
				                	echo '<div class="single-item col-lg-'.$colmn.' col-md-6">';
				                }
			                        echo '<div class="team-style-two">';
			                            echo '<div class="thumb">';
			                            	if(!empty($single_data['image']['url'])){
				                                echo appku_img_tag( array(
													'url'	=> esc_url( $single_data['image']['url'] ),
												) );
				                            }
				                            if(!empty($single_data['shape_image']['url'])){
				                                echo '<div class="shape" style="background-image: url('.esc_url( $single_data['shape_image']['url'] ).');"></div>';
				                            }
			                            echo '</div>';
			                            echo '<div class="info">';
			                                if(!empty($single_data['name'])){
				                                echo '<h4>'.$url_start_tag.esc_html($single_data['name']).$url_end_tag.'</h4>';
				                            }
				                            if(!empty($single_data['desig'])){
				                                echo '<span>'.wp_kses_post($single_data['desig']).'</span>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                }   
		                echo '</div>';
		            echo '</div>';
		        }
	        echo '</div>';
	    echo '</div>';

		echo '<!--------------------------------- Team Process Area end --------------------------------->';
	}
}