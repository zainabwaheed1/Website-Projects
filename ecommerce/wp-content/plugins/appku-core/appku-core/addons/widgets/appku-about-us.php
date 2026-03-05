<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * About Us  Widget .
 *
 */
class Appku_About_Us extends Widget_Base {

	public function get_name() {
		return 'appkuaboutus';
	}

	public function get_title() {
		return __( 'Appku About', 'appku' );
	}


	public function get_icon() {
		return 'eicon-code';
    }


	public function get_categories() {
		return [ 'appku' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'about_us_section',
			[
				'label' 	=> __( 'About Us', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'about_style',
			[
				'label' 		=> __( 'About Style', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'appku' ),
					'2' 		=> __( 'Style Two', 'appku' ),
					'3' 		=> __( 'Style Three', 'appku' ),
				],
			]
		);
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'We re building software<strong>to manage business</strong>', 'sasoft' )
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Subtitle', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'We re building software<strong>to manage business</strong>', 'sasoft' )
			]
        );
        $this->add_control(
			'description',
			[
				'label' 	=> __( 'Description', 'sasoft' ),
                'type' 		=> Controls_Manager::WYSIWYG,
                'default'  	=> __( 'We re building software<strong>to manage business</strong>', 'sasoft' ),
			]
        );

        $this->add_control(
			'about_image',
			[
				'label' 		=> __( 'Choose Image 1', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'about_style' => [ '1','3' ] ],
			]
		);
		$this->add_control(
			'about_imag2',
			[
				'label' 		=> __( 'Choose Image 2', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'about_style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'about_imag3',
			[
				'label' 		=> __( 'Choose Image 3', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'about_style' => [ '1' ] ],
			]
		);
		$repeater = new Repeater();

        $repeater->add_control(
			'title',
			[
				'label' 	=> __( 'Ttile', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Title', 'appku' )
			]
        );

        $repeater->add_control(
			'contant',
			[
				'label' 	=> __( 'Contant', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Contant', 'appku' )
			]
        );
        $repeater->add_control(
			'icon_class',
			[
				'label' 	=> __( 'Icon Class', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Ut fermentum massa justo', 'appku' )
			]
        );

		$this->add_control(
			'lists',
			[
				'label' 		=> __( 'Lists', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title'    => __( 'Ticket manage', 'appku' ),
						'contant'      => __( 'Downs those still witty an balls so chief so. Moment an little remain.', 'appku' ),
						'icon_class'      => __( '<i class="flaticon-ticket"></i>', 'appku' ),
					],
					[
						'title'    => __( 'Live messaging', 'appku' ),
						'contant'      => __( 'Downs those still witty an balls so chief so. Moment an little remain.', 'appku' ),
						'icon_class'      => __( '<i class="flaticon-speech-bubble"></i>', 'appku' ),
					],
					[
						'title'    => __( 'Email workflow', 'appku' ),
						'contant'      => __( 'Downs those still witty an balls so chief so. Moment an little remain.', 'appku' ),
						'icon_class'      => __( '<i class="flaticon-email"></i>', 'appku' ),
					],
					[
						'title'    => __( 'File upload', 'appku' ),
						'contant'      => __( 'Downs those still witty an balls so chief so. Moment an little remain.', 'appku' ),
						'icon_class'      => __( '<i class="flaticon-file"></i>', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ title }}}',
				'condition'		=> [ 'about_style' => [ '2' ] ],
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
			'label',
			[
				'label' 	=> __( 'Info Label', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Title', 'appku' )
			]
        );

        $repeater->add_control(
			'info',
			[
				'label' 	=> __( 'Information Content', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Contant', 'appku' )
			]
        );
        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'appku' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'informations',
			[
				'label' 		=> __( 'Lists', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'label'    => __( 'Email', 'appku' ),
						'info'      => __( 'youremail@com', 'appku' ),
					],
					
				],
				'title_field' 	=> '{{{ label }}}',
				'condition'		=> [ 'about_style' => [ '3' ] ],
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Button Text', 'appku' ),
                'rows' 		=> 2,
                'condition'		=> [ 'about_style' => [ '1' ] ],
			]
        );

        $this->add_control(
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
				'condition'		=> [ 'about_style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'button_text2',
			[
				'label' 	=> __( '2nd Button Text', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Button Text', 'appku' ),
                'rows' 		=> 2,
                'condition'		=> [ 'about_style' => [ '1' ] ],
			]
        );

        $this->add_control(
			'button_link2',
			[
				'label' 		=> __( '2nd Link', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'about_style' => [ '1' ] ],
			]
		);
		$this->end_controls_section();

		//---------------------------------------Title Style---------------------------------------//

		$this->start_controls_section(
			'title_style',
			[
				'label' 	=> __( 'Title Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Title Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .about-list h4' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .about-list h4',
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .about-list h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'title_padding',
			[
				'label' 		=> __( 'Title Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .about-list h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//---------------------------------------subTitle Style---------------------------------------//

		$this->start_controls_section(
			'subtitle_style',
			[
				'label' 	=> __( 'Subtitle Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> __( 'Subtitle Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .about-list h2' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .about-list h2',
			]
        );
        $this->add_responsive_control(
			'subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .about-list h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'subtitle_padding',
			[
				'label' 		=> __( 'Subtitle Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .about-list h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//---------------------------------------list Style---------------------------------------//

		$this->start_controls_section(
			'list_style',
			[
				'label' 	=> __( 'List Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'about_style!' => '1' ],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Icon Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->add_responsive_control(
			'Item_icon_align',
			[
				'label' 		=> __( 'Icon Alignment', 'appku' ),
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
					'{{WRAPPER}} .featured-image-style' => 'text-align: {{VALUE}};',
                ],
                'condition'		=> [ 'about_style' => [ '2' ] ],
			]
		);
		$this->add_responsive_control(
			'Item_align',
			[
				'label' 		=> __( 'Content Alignment', 'appku' ),
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
					'justify' 	=> [
						'title' 		=> __( 'Justify', 'appku' ),
						'icon' 			=> 'eicon-text-align-justify',
					],
				],
				'default' 	=> 'center',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .item' => 'text-align: {{VALUE}};',
                ],
                'condition'		=> [ 'about_style' => [ '2' ] ],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Icon Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition'		=> [ 'about_style' => [ '2' ] ],
			]
        );
        $this->add_control(
			'icon_color2',
			[
				'label' 		=> __( 'Icon Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .about-area .about-items .features-content i' => 'background-image: -webkit-linear-gradient(45deg,{{icon_color.VALUE}} 0%,{{VALUE}} 100%);',
                ],
                'condition'		=> [ 'about_style' => [ '2' ] ],
			]
        );
        $this->add_control(
			'info_icon_color',
			[
				'label' 		=> __( 'Icon Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .about-area .about-content ul li i' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->end_controls_section();

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

        if( $settings['about_style'] == '1' ){
	        echo '<div class="about-area">';

	        	if( ! empty( $settings['about_image']['url'] ) ){
	                echo '<div class="fixed-shape-left">';
	                	echo appku_img_tag( array(
							'url'	=> esc_url( $settings['about_image']['url'] ),
						) );
	                echo '</div>';
	            }
		        echo '<div class="container">';
		            echo '<div class="about-items">';
		                echo '<div class="row align-center">';
		                    echo '<div class="col-lg-6">';
		                        echo '<div class="thumb">';
		                        	if( ! empty( $settings['about_imag2']['url'] ) ){
		                        		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['about_imag2']['url'] ),
											'class' => 'wow fadeInLeft',
											'data-wow-delay' => '300ms'
										) );
		                        	}
		                        	if( ! empty( $settings['about_imag3']['url'] ) ){
		                        		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['about_imag3']['url'] ),
											'class' => 'wow fadeInUp',
											'data-wow-delay' => '500ms'
										) );
		                        	}
		                        echo '</div>';
		                    echo '</div>';
		                    echo '<div class="col-lg-6 info wow fadeInRight about-list">';
		                    	if(!empty($settings['title'])){
			                        echo '<h4>'.wp_kses_post($settings['title']).'</h4>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<h2>'.wp_kses_post($settings['subtitle']).'</h2>';
			                    }
			                    if(!empty($settings['description'])){
			                        echo wp_kses_post($settings['description']);
			                    }
			                    echo '<div class="button">';
			                    	if( ! empty( $settings['button_text'] ) ) {
				                    	if( ! empty( $settings['button_link']['url'] ) ) {
								            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
								        }
					            		if( ! empty( $settings['button_link']['nofollow'] ) ) {
								            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
								        }
								        if( ! empty( $settings['button_link']['is_external'] ) ) {
								            $this->add_render_attribute( 'button', 'target', '_blank' );
								        }
								        $this->add_render_attribute( 'button', 'class', 'btn circle btn-theme effect btn-md' );

								        	echo '<a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).' </a>';
		                            }
		                            if( ! empty( $settings['button_text2'] ) ) {
				                    	if( ! empty( $settings['button_link2']['url'] ) ) {
								            $this->add_render_attribute( 'button2', 'href', esc_url( $settings['button_link2']['url'] ) );
								        }
					            		if( ! empty( $settings['button_link2']['nofollow'] ) ) {
								            $this->add_render_attribute( 'button2', 'rel', 'nofollow' );
								        }
								        if( ! empty( $settings['button_link2']['is_external'] ) ) {
								            $this->add_render_attribute( 'button2', 'target', '_blank' );
								        }
								        	echo '<a '.$this->get_render_attribute_string('button2').'>'.esc_html( $settings['button_text2'] ).' </a>';
		                            }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['about_style'] == '2' ){
			$elementClass = 'featured-image-style';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}
			$this->add_render_attribute( 'wrapper', 'class', $elementClass );

			echo '<div id="about" class="about-area default-padding">';
		        echo '<div class="container">';
		            echo '<div class="about-items">';
		                echo '<div class="row align-center">';

		                    echo '<div class="col-lg-6 default info right-info about-list">';
		                        if(!empty($settings['title'])){
			                        echo '<h4>'.wp_kses_post($settings['title']).'</h4>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<h2>'.wp_kses_post($settings['subtitle']).'</h2>';
			                    }
			                    if(!empty($settings['description'])){
			                        echo wp_kses_post($settings['description']);
			                    }  
		                    echo '</div>';
		                
		                    echo '<div class="col-lg-6 features-content">';
		                        echo '<div class="row">';
		                        	foreach( $settings['lists'] as $single_data ){
			                            echo '<div class="col-lg-6 col-md-6">';
			                                echo '<div class="item">';
			                                	echo '<div '.$this->get_render_attribute_string( 'wrapper' ).'>';
				                                    if(!empty($single_data['icon_class'])){
								                        echo wp_kses_post($single_data['icon_class']);
								                    }
							                    echo '</div>';
							                    if(!empty($single_data['title'])){
				                                    echo '<h4>'.wp_kses_post($single_data['title']).'</h4>';
				                                }
				                                if(!empty($single_data['contant'])){
				                                    echo '<p>'.wp_kses_post($single_data['contant']).'</p>';
				                                }
			                                    echo '<p></p>';
			                                echo '</div>';
			                            echo '</div>';
			                        }
		                        echo '</div>';
		                    echo '</div>';

		               	echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}else{
			$elementClass = 'featured-image-style';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}
			$this->add_render_attribute( 'wrapper', 'class', $elementClass  );
			$this->add_render_attribute( 'wrapper', 'class', 'icon'  );

			echo '<div id="about" class="about-area inc-left-border default-padding-top overflow-hidden">';
		        echo '<div class="container">';
		            echo '<div class="about-content">';
		                echo '<div class="row align-center">';
		                	if( ! empty( $settings['about_image']['url'] ) ){
			                    echo '<div class="col-lg-6">';
			                       echo ' <div class="thumbs">';
			                       		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['about_image']['url'] ),
											'class' => 'wow fadeInLeft',
											'data-wow-delay' => '300ms'
										) );
			                        echo '</div>';
			                    echo '</div>';
			                }

		                    echo '<div class="col-lg-6 info wow fadeInRight">';

		                        if(!empty($settings['title'])){
			                        echo '<h4>'.wp_kses_post($settings['title']).'</h4>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<h2>'.wp_kses_post($settings['subtitle']).'</h2>';
			                    }
			                    if(!empty($settings['description'])){
			                        echo wp_kses_post($settings['description']);
			                    }
		                        echo '<ul>';
		                        	foreach( $settings['informations'] as $single_data ){
			                            echo '<li><div '.$this->get_render_attribute_string( 'wrapper' ).'>';
			                            \Elementor\Icons_Manager::render_icon( $single_data['icon'], [ 'aria-hidden' => 'true' ] );
			                            echo '</div>';
			                                echo '<div class="content">';
			                                	if(!empty($single_data['label'])){
					                                echo '<span>'.esc_html($single_data['label']).'</span> ';
					                            }
					                            if(!empty($single_data['info'])){
					                                echo esc_html($single_data['info']);
					                            }
			                                echo '</div>';
			                            echo '</li>';
			                        }

		                        echo '</ul>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
	}
}