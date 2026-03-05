<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Working Process Widget .
 *
 */
class Appku_Working_Process extends Widget_Base {

	public function get_name() {
		return 'appkuworkingprocess';
	}

	public function get_title() {
		return __( 'Appku Working Process', 'appku' );
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
				'label'     => __( 'Working Process', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'process_style',
			[
				'label' 		=> __( 'Process Style', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'appku' ),
					'2' 		=> __( 'Style Two', 'appku' ),
				],
			]
		);
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Subtitle', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'process_style' => [ '2' ] ],
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

		$repeater = new Repeater();

        $repeater->add_control(
			'title', [
				'label' 		=> __( 'Title', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'details_page', [
				'label' 		=> __( 'Page Url', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( '#' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'content', [
				'label' 		=> __( 'Content', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'icon_class', [
				'label' 		=> __( 'Icon Class', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
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
				'title_field' 	=> '{{{ title }}}',
			]
		);

		$this->end_controls_section();


        /*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'general_styling',
			[
				'label' 	=> __( 'General Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'allow_step',
			[
				'label' 		=> __( 'Allow Step Count ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 'process_style' => [ '1' ] ],
			]
		);
        $this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Image Hover Animation', 'appku' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition'		=> [ 'process_style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'hover_animation2',
			[
				'label' => esc_html__( 'Steps Hover Animation', 'appku' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition'		=> [ 'process_style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Icon Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .process-area .info li i'	=> 'color: {{VALUE}}!important;'
				],
				'condition'		=> [ 'process_style' => [ '1' ] ],
			]
        );
        $this->add_control(
			'icon_bg_color',
			[
				'label' 		=> __( 'Icon Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .process-area .info li i'	=> 'background-color: {{VALUE}}!important;'
				],
				'condition'		=> [ 'process_style' => [ '1' ] ],
			]
        );
        $this->add_control(
			'shape_color',
			[
				'label' 		=> __( 'Shape Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .process-style-four .thumb::after'	=> 'border: 100px solid {{VALUE}}!important;'
				],
				'condition'		=> [ 'process_style' => [ '2' ] ],
			]
        );
        $this->add_control(
			'item_bg_color',
			[
				'label' 		=> __( 'Item Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .single-process'	=> 'background: {{VALUE}}!important;'
				],
				'condition'		=> [ 'process_style' => [ '2' ] ],
			]
        );
        $this->add_control(
			'item_bg_active_color1',
			[
				'label' 		=> __( 'Item Active Background Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition'		=> [ 'process_style' => [ '2' ] ],
			]
        );
        $this->add_control(
			'item_bg_active_color2',
			[
				'label' 		=> __( 'Item Active Background Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  .single-process:nth-child(2n),{{WRAPPER}}  .single-process:nth-child(4n),{{WRAPPER}}  .single-process:nth-child(6n)' => '--bg-gradient: -webkit-linear-gradient(45deg,{{item_bg_active_color1.VALUE}} 0%,{{VALUE}} 50%);',
                ],
                'condition'		=> [ 'process_style' => [ '2' ] ],
			]
        );
		$this->end_controls_section();

        /*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Working Process', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Title', 'appku' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .content h4, {{WRAPPER}} .content h4 a'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .content h4, {{WRAPPER}} .content h4 a,{{WRAPPER}} .features-box h4',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .content h4, {{WRAPPER}} .content h4 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .content h4, {{WRAPPER}} .content h4 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .content p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .content p',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		//--------------------three--------------------//

		$this->start_controls_tab(
			'style_hover_tab3',
			[
				'label' => esc_html__( 'Heading Title', 'appku' ),
			]
		);
		$this->add_control(
			'counter_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h2'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'counter_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h2',
			]
		);

        $this->add_responsive_control(
			'counter_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );



		$this->end_controls_tab();


		//--------------------four--------------------//

		$this->start_controls_tab(
			'style_hover_tab5',
			[
				'label' => esc_html__( 'Heading Subtitle', 'appku' ),
				'condition'		=> [ 'process_style' => [ '2' ] ],
			]
		);
		$this->add_control(
			'counter_color5',
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
				'name' 			=> 'counter_typography5',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h4',
			]
		);

        $this->add_responsive_control(
			'counter_margin5',
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
			'counter_padding5',
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

		$this->end_controls_tabs();
		$this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Working Process Area start ------------------------------->';
        if( $settings['process_style'] == '1' ){
	        echo '<div class="process-area">';
	        	$elementClass1 = 'featured-image-style';
	        	$elementClass2 = 'featured-image-style2';
				if ( $settings['hover_animation'] ) {
					$elementClass1 .= ' elementor-animation-' . $settings['hover_animation'];
				}
				$this->add_render_attribute( 'wrapper', 'class', $elementClass1 );
				$this->add_render_attribute( 'wrapper', 'class', 'col-lg-6 thumb' );

				if ( $settings['hover_animation2'] ) {
					$elementClass2 .= ' elementor-animation-' . $settings['hover_animation2'];
				}
				$this->add_render_attribute( 'wrapper2', 'class', $elementClass2 );

		        echo '<div class="container">';
		            echo '<div class="row align-center">';
		            	if( ! empty( $settings['shape_image']['url'] ) ){
			                echo '<div '.$this->get_render_attribute_string( 'wrapper' ).'>';
			                    echo appku_img_tag( array(
									'url'	=> esc_url( $settings['shape_image']['url'] ),
								) );
			                echo '</div>';
			            }

		                echo '<div class="col-lg-6 info ml-auto">';
		                	if(!empty($settings['title'])){
			                    echo '<h2>'.esc_html($settings['title']).'</h2>';
			                }
		                    echo '<ul>';
		                    	$i = 0;
		                    	$n = 100;
		                        foreach( $settings['slides'] as $single_data ){
		                        	$i++;
		                        	$n+=200;
			                        $k = str_pad($i, 2, '0', STR_PAD_LEFT);
			                        echo '<li '.$this->get_render_attribute_string( 'wrapper2' ).'>';
			                            if(!empty($single_data['icon_class'])){
				                            echo '<div class="icon">';
				                            	echo wp_kses_post($single_data['icon_class']);
				                           	echo '</div>';
				                        }
			                            echo '<div class="content wow fadeInUp" data-wow-delay="'.esc_attr($n).'ms">';
			                            	if(!empty($single_data['title'])){
			                            		if( $settings['allow_step'] == 'yes' ){
			                            			$counter = '<span>Step - '.esc_html($k).'</span>';
			                            		}else{
			                            			$counter = '';
			                            		}
				                                echo '<h4>'.wp_kses_post($single_data['title']).' '.$counter.'</h4>';
				                            }
			                                if(!empty($single_data['content'])){
				                               	echo '<p>'.esc_html($single_data['content']).'</p>';
				                            }
			                            echo '</div>';
			                        echo '</li>';
			                    }  
		                    echo '</ul>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}else{
			echo '<div class="process-style-four-area default-padding">';
		        echo '<div class="container">';
		            echo '<div class="row">';
		            	if( ! empty( $settings['shape_image']['url'] ) ){
			                echo '<div class="col-lg-6">';
			                    echo '<div class="process-style-four">';
			                        echo '<div class="thumb">';
			                        	echo appku_img_tag( array(
										'url'	=> esc_url( $settings['shape_image']['url'] ),
										'class' => 'wow fadeInUp'
									) );
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            }

		                echo '<div class="col-lg-6">';
		                    echo '<div class="process-style-four info">';
		                        if(!empty($settings['title'])){
				                    echo '<h4>'.esc_html($settings['title']).'</h4>';
				                }
				                if(!empty($settings['subtitle'])){
				                    echo '<h2>'.esc_html($settings['subtitle']).'</h2>';
				                }
				                $x = 0;
		                    	$n = 100;
		                        foreach( $settings['slides'] as $single_data ){
		                        	$x++;
	                    			$n+=200;
		                        	$url = $single_data['details_page'] ;
	                        		if(!empty($url)){
	                        			$url_start_tag 	= '<a href="'.esc_url($url).'">';
	                        			$url_end_tag 	= '</a>';
	                        		}else{
	                        			$url_start_tag 	= '';
	                        			$url_end_tag 	= '';
	                        		}  
			                        echo '<!-- Single Process-->';
			                        echo '<div class="single-process wow fadeInRight" data-wow-delay="'.esc_attr($n).'ms">';
			                            echo '<div class="number"><i class="fas fa-arrow-right"></i></div>';
			                            echo '<div class="content">';
			                                if(!empty($single_data['title'])){
				                              	echo '<h4>'.$url_start_tag.esc_html($single_data['title']).$url_end_tag.'</h4>';
				                            }
				                            if(!empty($single_data['content'])){
				                               	echo '<p>'.esc_html($single_data['content']).'</p>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                        echo '<!-- End Single Process-->';
			                    }

		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}

		echo '<!--------------------------------- Working Process Area end --------------------------------->';
	}
}