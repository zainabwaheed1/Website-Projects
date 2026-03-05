<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Testimonials Widget .
 *
 */
class Appku_Testimonials extends Widget_Base {

	public function get_name() {
		return 'appkutestimonials';
	}

	public function get_title() {
		return __( 'Appku Testimonials', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'features_section',
			[
				'label'     => __( 'Testimonials', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
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


        //----------------------------feddback repeter start--------------------------------//

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
			'designation', [
				'label' 		=> __( 'Designation', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'feedback_title', [
				'label' 		=> __( 'Feedback For', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Design Quality' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'feedback', [
				'label' 		=> __( 'Feedback', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'client_rating',
			[
				'label' 	=> __( 'Client Rating', 'appku' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '5',
				'options' 	=> [
					'one'  		=> __( 'One Star', 'appku' ),
					'two' 		=> __( 'Two Star', 'appku' ),
					'three' 	=> __( 'Three Star', 'appku' ),
					'four' 		=> __( 'Four Star', 'appku' ),
					'five' 	 	=> __( 'Five Star', 'appku' ),
				],
			]
		);
        $repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Client Image', 'appku' ),
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
						'name' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ name }}}',
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

        /*-----------------------------------------Feedback styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Testimonials Styling', 'appku' ),
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
					'{{WRAPPER}} h4'	=> 'color: {{VALUE}}!important;',
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


		//--------------------three--------------------//

		$this->start_controls_tab(
			'style_hover_tab3',
			[
				'label' => esc_html__( 'Feedback', 'appku' ),
			]
		);
		$this->add_control(
			'counter_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'counter_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} p',
			]
		);

        $this->add_responsive_control(
			'counter_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'counter_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );



		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();


		/*-----------------------------------------General styling------------------------------------*/

		$this->start_controls_section(
			'avatar_styling',
			[
				'label' 	=> __( 'General Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'f_icon_color',
			[
				'label' 		=> __( 'Box Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
			]
        );
        $this->add_control(
			'f_icon_color2',
			[
				'label' 		=> __( 'Box Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonials-area .item' => 'background-image: -webkit-linear-gradient(45deg,{{f_icon_color.VALUE}} 0%,{{VALUE}} 50%);',
                ],
			]
        );
        $this->add_responsive_control(
			'avatar_border_radius',
			[
				'label' 		=> __( 'Avatar Border Radius', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .testimonials-area .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_control(
			'rating_color',
			[
				'label' 		=> __( 'Rating Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonials-area .item .reason i'	=> 'color: {{VALUE}}!important;',
				],
			]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Testimonials Area start ------------------------------->';


        	echo '<div class="testimonials-area carousel-shadow">';
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
		            echo '<div class="testimonial-items">';
		                echo '<div class="row">';
		                    echo '<div class="col-lg-12">';
		                        echo '<div class="testimonial-carousel owl-carousel owl-theme">';
		                        	foreach( $settings['slides'] as $single_data ){
			                            echo '<!-- Single Item -->';
			                            echo '<div class="item">';
			                                echo '<div class="provider">';
			                                	if( ! empty( $single_data['image']['url'] ) ){
				                                    echo appku_img_tag( array(
														'url'	=> esc_url( $single_data['image']['url'] ),
													) );
				                                }
			                                    echo '<div class="content">';
			                                        if(!empty($single_data['name'])){
					                                    echo '<h4>'.wp_kses_post($single_data['name']).'</h4>';
					                                }
					                                if(!empty($single_data['designation'])){
					                                    echo '<span>'.wp_kses_post($single_data['designation']).'</span>';
					                                }
			                                    echo '</div>';
			                                echo '</div>';
			                                
			                                if(!empty($single_data['feedback'])){
			                                	echo '<div class="info">';
			                                    echo '<p>'.wp_kses_post($single_data['feedback']).'</p>';
			                                    echo '</div>';
			                                }
			                                
			                                echo '<div class="reason">';
			                                	if(!empty($single_data['feedback_title'])){
				                                    echo '<h5>'.wp_kses_post($single_data['feedback_title']).'</h5>';
				                                }
			                                    echo '<div class="rating">';
					                                if( $single_data['client_rating'] == 'one' ){
									                	echo '<i class="fas fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
									                }elseif( $single_data['client_rating'] == 'two' ){
									                	echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
									                }elseif( $single_data['client_rating'] == 'three' ){
									                	echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
									                }elseif( $single_data['client_rating'] == 'four' ){
									                	echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="far fa-star"></i>';
									                }else{
									                	echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
										                echo '<i class="fas fa-star"></i>';
									                }
			                                    echo '</div>';
			                                echo '</div>';
			                            echo '</div>';
			                            echo '<!-- End Single Item -->';
			                        }

		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		           echo '</div>';
		        echo '</div>';
		    echo '</div>';
		echo '<!--------------------------------- Testimonials Area end --------------------------------->';
	}
}