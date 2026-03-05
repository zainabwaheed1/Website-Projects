<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Pricing Widget .
 *
 */
class Appku_Pricing extends Widget_Base {

	public function get_name() {
		return 'appkupricing';
	}

	public function get_title() {
		return __( 'Appku Pricing', 'appku' );
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
				'label'     => __( 'Pricing', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'price_style',
			[
				'label' 		=> __( 'Pricing Style', 'appku' ),
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


        //----------------------------feddback repeter start--------------------------------//

		$repeater = new Repeater();

		$repeater->add_control(
			'package', [
				'label' 		=> __( 'Package', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Trial Version' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'offer_text', [
				'label' 		=> __( 'Savings Text', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Save 25%' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'plan', [
				'label' 		=> __( 'Pricing Plan', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( '<sup>$</sup>0 <sub>/ Monthly</sub>' , 'appku' ),
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
        $repeater->add_control(
			'features', [
				'label' 		=> __( 'Feedback', 'appku' ),
				'type' 			=> Controls_Manager::WYSIWYG,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Button Text', 'appku' )
			]
        );
        $repeater->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$repeater->add_control(
			'make_it_active',
			[
				'label' 		=> __( 'Make it Active ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
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
						'package' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ package }}}',
			]
		);
		
		$this->end_controls_section();

		//------------------------------------feature Control------------------------------------//

		$this->start_controls_section(
			'pricing_control',
			[
				'label'     => __( 'Pricing Control', 'appku' ),
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

		//---------------------------------------general Style---------------------------------------//

		$this->start_controls_section(
			'general_style',
			[
				'label' 	=> __( 'General Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'pricing_cart_bg',
			[
				'label' 		=> __( 'Pricing BG', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .pricing-area .pricing-item'	=> 'background: {{VALUE}}!important;',
				],
			]
        );
        $this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Content Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .pricing-item h4,{{WRAPPER}} .pricing-item span,{{WRAPPER}} .pricing-item h2'	=> 'color: {{VALUE}}!important;',
				],
			]
        );

		$this->end_controls_section();

		//---------------------------------------Button Style---------------------------------------//

		//---------------------------------------Button Style---------------------------------------//

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'background:{{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme::after' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-theme',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-theme:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-theme',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Button Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'appku' ),
				'selector' => '{{WRAPPER}} .btn.btn-theme',
			]
		);
        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Pricing Area start ------------------------------->';
        	if( $settings['make_slider'] == 'yes' ){
				$this->add_render_attribute( 'wrapper', 'class', 'row pricing-carousel owl-carousel owl-theme' );
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

        	echo '<div class="pricing-area">';
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
		       		$style_class = ($settings['price_style'] == '1') ? 'pricing-items' : 'pricing-style-two-box';
		            echo '<div class="'.esc_attr($style_class).'">';
		                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
		                	if( $settings['price_style'] == '1' ){
			                	foreach( $settings['slides'] as $single_data ){
				                    echo '<!-- Single Item -->';
				                    if( $settings['make_slider'] == 'yes' ){
					                    echo '<div class="single-item">';
					                }else{
					                	echo '<div class="single-item col-lg-'.$colmn.' col-md-6">';
					                }
				                        echo '<div class="pricing-item">';
				                        	if(!empty($single_data['icon_class'])){
					                        	echo wp_kses_post($single_data['icon_class']);
					                        }
				                            echo '<div class="pricing-header">';
				                            	if(!empty($single_data['package'])){
					                                echo '<h4>'.wp_kses_post($single_data['package']).'</h4>';
					                            }
					                            if(!empty($single_data['offer_text'])){
					                                echo '<span>'.wp_kses_post($single_data['offer_text']).'</span>';
					                            }
					                        echo '</div>';
					                        echo '<div class="price">';
					                            if(!empty($single_data['plan'])){
					                                echo '<h2>'.wp_kses_post($single_data['plan']).'</h2>';
					                            }
					                        echo '</div>';
					                        if(!empty($single_data['button_text'])){
					                            $target_team 	= $single_data['button_link']['is_external'] ? ' target="_blank"' : '';
												$nofollow_team 	= $single_data['button_link']['nofollow'] ? ' rel="nofollow"' : '';
					                                echo '<a '.wp_kses_post( $target_team.$nofollow_team ).' href="'.esc_url( $single_data['button_link']['url'] ).'" class="btn circle btn-theme effect btn-md">'.esc_html( $single_data['button_text'] ).'</a>';
					                        }
				                            if(!empty($single_data['features'])){
			                                    echo wp_kses_post($single_data['features']);
			                                }
				                        echo '</div>';
				                    echo '</div>';
				                    echo '<!-- End Single Itme -->';
				                }
				            }else{
				            	foreach( $settings['slides'] as $single_data ){
				            		echo '<!-- Single Item -->';
				                    if( $settings['make_slider'] == 'yes' ){
					                    echo '<div class="single-item pricing-style-two">';
					                }else{
					                	if( $single_data['make_it_active'] == 'yes' ){
						                	echo '<div class="single-item pricing-style-two col-lg-'.$colmn.' col-md-6 active">';
						                	$btn_class = 'btn circle btn-theme effect btn-md';
						                }else{
						                	echo '<div class="single-item pricing-style-two col-lg-'.$colmn.' col-md-6">';
						                	$btn_class = 'btn circle btn-gray btn-sm';
						                }
					                }
				                        echo '<div class="pricing-item">';
				                            if(!empty($single_data['icon_class'])){
					                        	echo wp_kses_post($single_data['icon_class']);
					                        }
					                        if(!empty($single_data['package'])){
				                                echo '<div class="pricing-header"><h4>'.wp_kses_post($single_data['package']).'</h4></div>';
				                            }
				                            if(!empty($single_data['plan'])){
					                            echo '<div class="price">';
					                               echo ' <h2>'.wp_kses_post($single_data['plan']).'</h2>';
					                            echo '</div>';
					                        }
					                        if(!empty($single_data['features'])){
			                                    echo wp_kses_post($single_data['features']);
			                                }
				                            if(!empty($single_data['button_text'])){
					                            $target_team 	= $single_data['button_link']['is_external'] ? ' target="_blank"' : '';
												$nofollow_team 	= $single_data['button_link']['nofollow'] ? ' rel="nofollow"' : '';
					                                echo '<a '.wp_kses_post( $target_team.$nofollow_team ).' href="'.esc_url( $single_data['button_link']['url'] ).'" class="'.esc_attr($btn_class).'">'.esc_html( $single_data['button_text'] ).'</a>';
					                        }
				                        echo '</div>';
				                    echo '</div>';
				                }
				            }
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		echo '<!--------------------------------- Pricing Area end --------------------------------->';
	}
}