<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget .
 *
 */
class Appku_Banner extends Widget_Base {

	public function get_name() {
		return 'appkubanner';
	}

	public function get_title() {
		return __( 'Banner', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'Banner_section',
			[
				'label' 	=> __( 'Banner', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'banner_style',
			[
				'label' 		=> __( 'Banner Style', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'appku' ),
					'2' 		=> __( 'Style Two', 'appku' ),
					'3' 		=> __( 'Style Three', 'appku' ),
					'4' 		=> __( 'Style Four', 'appku' ),
					'5' 		=> __( 'Style Five', 'appku' ),
					'6' 		=> __( 'Style Six', 'appku' ),
				],
			]
		);

		$this->add_control(
			'banner_image',
			[
				'label' 		=> __( 'Banner Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'banner_image2',
			[
				'label' 		=> __( 'Banner Image 2', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'banner_style' => [ '2','3','5' ] ],
			]
		);
		$this->add_control(
			'banner_image3',
			[
				'label' 		=> __( 'Banner Image 3', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'banner_style' => [ '5' ] ],
			]
		);
		$this->add_control(
			'banner_shape',
			[
				'label' 		=> __( 'Banner Shape Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'banner_style' => [ '1','2','3','4'] ],
			]
		);
		

		$this->add_control(
			'title',
			[
				'label' 	=> __( 'Banner Title', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'We re building software<strong>to manage business</strong>', 'sasoft' )
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Banner Subtitle', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'We re building software<strong>to manage business</strong>', 'sasoft' ),
                'condition'		=> [ 'banner_style' => [ '4' ] ],
			]
        );
        $this->add_control(
			'desc',
			[
				'label' 	=> __( 'Banner Description', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Lasted hunted enough an up seeing in lively letter. Had judgment out opinions property the supplied.', 'sasoft' ),
			]
        );
        $this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Enter Your Email', 'appku' ),
				'condition'		=> [ 'banner_style' => [ '3' ] ],
			]
		);
		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Free Trial', 'appku' ),
				'condition'		=> [ 'banner_style' => [ '3' ] ],
			]
		);
        $this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Button Text', 'sasoft' ),
                'condition'		=> [ 'banner_style' => [ '1','4','5' ] ],
			]
        );

        $this->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'sasoft' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'sasoft' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'banner_style' => [ '1','4' ,'5'] ],
			]
		);

		$this->add_control(
			'button_text2',
			[
				'label' 	=> __( '2nd Button Text', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Button Text', 'sasoft' ),
                'condition'		=> [ 'banner_style' => [ '5' ] ],
			]
        );

        $this->add_control(
			'button_link2',
			[
				'label' 		=> __( '2nd Button Link', 'sasoft' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'sasoft' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'banner_style' => [ '5'] ],
			]
		);
		$this->add_control(
			'video_btn_label',
			[
				'label' 	=> __( 'Video Button Label', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Watch Promo', 'sasoft' ),
                'condition'		=> [ 'banner_style' => [ '2', '6' ] ],
			]
        );
		$this->add_control(
			'video_url',
			[
				'label' 		=> __( 'Video Url', 'sasoft' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'sasoft' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'banner_style' => [ '2', '6'] ],
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
					'{{WRAPPER}} h2' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} h2',
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition'		=> [ 'banner_style' => [ '4' ] ],
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> __( 'Subtitle Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h4' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} h4',
			]
        );
        $this->add_responsive_control(
			'subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//---------------------------------------Descriptions Style---------------------------------------//

		$this->start_controls_section(
			'desc_style',
			[
				'label' 	=> __( 'Descriptions Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' 		=> __( 'Descriptions Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'desc_typography',
				'label' 	=> __( 'Descriptions Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} p',
			]
        );
        $this->add_responsive_control(
			'desc_margin',
			[
				'label' 		=> __( 'Descriptions Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .banner_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'desc_padding',
			[
				'label' 		=> __( 'Descriptions Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .banner_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//---------------------------------------Button Style---------------------------------------//

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'banner_style' => [ '1','4' ] ],
			]
        );

        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-light.effect' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-light.effect:hover' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-light.effect' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-light.effect:hover' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-light.effect',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-light.effect:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-light.effect',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-light.effect' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .btn.btn-light.effect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .btn.btn-light.effect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'appku' ),
				'selector' => '{{WRAPPER}} .btn.btn-light.effect',
			]
		);
        $this->end_controls_section();

        //-------------------------------video button styling------------------------------- //

		$this->start_controls_section(
			'video_btn_style_section',
			[
				'label' 	=> __( 'Video Button Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'banner_style' => [ '2' ] ],
			]
		);

		$this->add_control(
			'video_btn_color',
			[
				'label' 	=> __( 'Video Button Color', 'appku' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-btn i' => 'color: {{VALUE}}',
                ]
			]
        );


		$this->add_control(
			'video_btn_background_color',
			[
				'label' 	=> __( 'Video Button Background Color', 'appku' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-btn i' => 'background-color: {{VALUE}}!important;',
                ]
			]
		);

		$this->add_control(
			'video_btn_ripple_effect_color',
			[
				'label' 		=> __( 'Video Button Ripple Effect Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .video-btn i::after' => 'background-color: {{VALUE}}!important;',
                ]
			]
        );

		$this->end_controls_section();

		//-------------------------------subscribe form styling------------------------------- //

		$this->start_controls_section(
			'subscribe_section',
			[
				'label' 	=> __( 'Subscribe Form Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'banner_style' => [ '3' ] ],
			]
		);

		$this->add_control(
			'form_bg_color',
			[
				'label' 	=> __( 'Form Background Color', 'appku' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-area form input' => 'background-color: {{VALUE}}',
                ]
			]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border2',
				'label' 	=> __( 'Border', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .banner-area form input',
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' 	=> __( 'Button Color', 'appku' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-area form button' => 'background: {{VALUE}}',
                ]
			]
        );


		$this->end_controls_section();

		//-------------------------------shape styling------------------------------- //

		$this->start_controls_section(
			'shape_section',
			[
				'label' 	=> __( 'Shape Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'banner_style' => [ '2' ] ],
			]
		);

		$this->add_control(
			'shape_color',
			[
				'label' 	=> __( 'Shape Color', 'appku' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-area.inc-shape::before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .banner-area .thumb-inner .shape-circle' => '--color-primary: {{VALUE}}',
                ]
			]
        );
        $this->add_responsive_control(
			'shape_positionig',
			[
				'label' 		=> __( 'Shape Position', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .banner-area.inc-shape::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();


    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['banner_style'] == '1' ){

			echo '<div class="banner-area banner-style-three text-light text-default">';
				if( ! empty( $settings['banner_shape']['url'] ) ){
					echo '<div class="shape-left" style="background-image: url('.esc_url( $settings['banner_shape']['url'] ).');"></div>';
				}
		        echo '<div class="container">';
		            echo '<div class="double-items">';
		                echo '<div class="row align-center">';

		                    echo '<div class="col-lg-6 info">';
		                    	if(!empty($settings['title'])){
			                        echo '<h2 class="wow fadeInRight" data-wow-defaul="300ms">'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			                    }
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
							        $this->add_render_attribute( 'button', 'class', 'btn btn-md circle btn-light effect wow fadeInUp' );
							        $this->add_render_attribute( 'button', 'data-wow-delay', '700ms' );

			                        echo '<a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).' <i class="fas fa-angle-right"></i></a>';
			                    }

		                    echo '</div>';
		                    if( ! empty( $settings['banner_image']['url'] ) ){
			                    echo '<div class="col-lg-6 thumb wow fadeInRight" data-wow-delay="900ms">';
			                        	echo appku_img_tag( array(
											'url'	=> esc_url( $settings['banner_image']['url'] ),
										) );
			                    echo '</div>';
			                }   
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['banner_style'] == '2' ){

			echo '<div class="banner-area bg-top text-capitalized text-center top-pad-80 auto-height">';
				if( ! empty( $settings['banner_shape']['url'] ) ){
			        echo '<div class="banner-shape" style="background-image: url('.esc_url( $settings['banner_shape']['url'] ).');"></div>';
			    }

		        echo '<div class="container">';
		            echo '<div class="content-box">';
		                echo '<div class="row align-center">';
		                   echo ' <div class="col-lg-8 offset-lg-2 info">';
		                   		if(!empty($settings['title'])){
			                        echo '<h2 class="wow fadeInRight" data-wow-defaul="300ms">'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			                    }
		                        if( ! empty( $settings['video_url']['url'] ) ) {

			                    	$this->add_render_attribute( 'video', 'href', esc_url( $settings['video_url']['url'] ) );

			                    	if( ! empty( $settings['video_url']['nofollow'] ) ) {
							            $this->add_render_attribute( 'video', 'rel', 'nofollow' );
							        }
							        if( ! empty( $settings['video_url']['is_external'] ) ) {
							            $this->add_render_attribute( 'video', 'target', '_blank' );
							        }
							        $this->add_render_attribute( 'video', 'class', 'popup-youtube video-btn' );

			                        echo '<div class="button wow fadeInDown" data-wow-delay="700ms">
			                            <a '.$this->get_render_attribute_string('video').'><i class="fas fa-play"></i>'.esc_html($settings['video_btn_label']).'</a>';
			                        echo '</div>';
			                    }
		                    echo '</div>';
		                    echo '<div class="col-lg-12">';
		                        echo '<div class="thumb-inner">';
		                            if( ! empty( $settings['banner_image']['url'] ) ){
		                        		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['banner_image']['url'] ),
											'class' => 'wow fadeInRight',
											'data-wow-delay' => '900ms'
										) );
		                        	}
		                        	if( ! empty( $settings['banner_image2']['url'] ) ){
		                        		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['banner_image2']['url'] ),
											'class' => 'wow fadeInLeft',
											'data-wow-delay' => '1100ms'
										) );
		                        	}
		                            echo '<div class="shape-circle wow fadeInLeft" data-wow-delay="1500ms"></div>';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['banner_style'] == '3' ){

			echo '<div class="banner-area banner-style-four text-default">';
				if( ! empty( $settings['banner_image']['url'] ) ){
			        echo '<div class="shape-right-top" style="background-image: url('.esc_url( $settings['banner_image']['url'] ).');"></div>';
			    }
			    if( ! empty( $settings['banner_image2']['url'] ) ){
			        echo '<div class="shape-left-top" style="background-image: url('.esc_url( $settings['banner_image2']['url'] ).');"></div>';
			    }
		        echo '<div class="container">';
		            echo '<div class="double-items">';
		                echo '<div class="row align-center">';

		                    echo '<div class="col-lg-6 info">';
		                    	if(!empty($settings['title'])){
			                        echo '<h2 class="wow fadeInRight" data-wow-defaul="300ms">'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			                    }
		                        echo '<form class="newsletter-form wow fadeInUp" data-wow-delay="700ms">';
		                            echo '<input type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" class="form-control" name="email">';
		                            echo '<button type="submit"> '.esc_html( $settings['newsletter_button'] ).'</button>  ';
		                        echo '</form>';
		                    echo '</div>';
		                    if( ! empty( $settings['banner_shape']['url'] ) ){
			                    echo '<div class="col-lg-6 thumb wow fadeInRight" data-wow-delay="900ms">';
			                        echo appku_img_tag( array(
										'url'	=> esc_url( $settings['banner_shape']['url'] ),
									) );
			                   	echo ' </div>';
			                }
		                    
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
















			// echo '<div class="banner-area bg-top gradient-bg text-light">';
		 //        echo '<div class="container">';
		 //            echo '<div class="double-items">';
		 //                echo '<div class="row align-center">';

		 //                    echo '<div class="col-lg-6 info">';
		 //                    	if(!empty($settings['title'])){
			//                         echo '<h2 class="wow fadeInRight" data-wow-defaul="300ms">'.wp_kses_post($settings['title']).'</h2>';
			//                     }
			//                     if(!empty($settings['desc'])){
			//                         echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			//                     }

		 //                        echo '<form class="newsletter-form">';
		 //                            echo '<input type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" class="form-control" name="email">';
		 //                            echo '<button type="submit"> '.esc_html( $settings['newsletter_button'] ).'</button>  ';
		 //                        echo '</form>';
		 //                    echo '</div>';
		 //                    if( ! empty( $settings['banner_image']['url'] ) ){
			//                     echo '<div class="col-lg-5 offset-lg-1 thumb big-thumb wow fadeInRight" data-wow-delay="900ms">';
	  //                       		echo appku_img_tag( array(
			// 							'url'	=> esc_url( $settings['banner_image']['url'] ),
			// 						) );                      	
			//                     echo '</div>';
			//                 }
		                    
		 //                echo '</div>';
		 //            echo '</div>';
		 //            echo '<!-- Fixed Shape -->';
		 //            if( ! empty( $settings['banner_image2']['url'] ) ){
			//             echo '<div class="shape">';
			//                 echo appku_img_tag( array(
			// 					'url'	=> esc_url( $settings['banner_image2']['url'] ),
			// 				) ); 
			//             echo '</div>';
			//         }

		 //            echo '<!-- Fixed Shape -->';
		 //        echo '</div>';
		 //    echo '</div>';
		}elseif( $settings['banner_style'] == '4' ){
			echo '<div class="banner-area auto-height bg-fixed banner-style-four text-default">';
				if( ! empty( $settings['banner_shape']['url'] ) ){
			        echo '<div class="shape-bottom" style="background-image: url('.esc_url( $settings['banner_shape']['url'] ).');"></div>';
			    }
		        echo '<div class="container">';
		            echo '<div class="double-items">';
		                echo '<div class="row align-center">';

		                    echo '<div class="col-lg-6 info">';
		                    	if(!empty($settings['title'])){
			                        echo '<h4 class="wow fadeInRight">'.wp_kses_post($settings['title']).'</h4>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<h2 class="wow fadeInLeft" data-wow-defaul="300ms">'.wp_kses_post($settings['subtitle']).'</h2>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			                    }
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
							        $this->add_render_attribute( 'button', 'class', 'btn btn-md circle btn-gradient effect wow fadeInUp' );
							        $this->add_render_attribute( 'button', 'data-wow-delay', '700ms' );

							        	echo '<a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).' <i class="fas fa-angle-right"></i></a>';
	                            }

		                    echo '</div>';
		                    if( ! empty( $settings['banner_image']['url'] ) ){
			                    echo '<div class="col-lg-6 thumb wow fadeInRight" data-wow-delay="900ms">';
			                        echo appku_img_tag( array(
										'url'	=> esc_url( $settings['banner_image']['url'] ),
									) ); 
			                    echo '</div>';
			                }
		                    
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';


			// echo '<div class="banner-area inc-shape content-less bg-gradient text-default">';
		 //        echo '<div class="container">';
		 //            echo '<div class="double-items">';
		 //                echo '<div class="row align-center">';

		 //                    echo '<div class="col-lg-6 info shape">';
		 //                    	if(!empty($settings['subtitle'])){
			//                         echo '<h4 class="wow fadeInLeft" data-wow-delay="300ms">'.wp_kses_post($settings['subtitle']).'</h4>';
			//                     }
		 //                        if(!empty($settings['title'])){
			//                         echo '<h2 class="wow fadeInRight" data-wow-delay="500ms">'.wp_kses_post($settings['title']).'</h2>';
			//                     }
		 //                        echo '<div class="button wow fadeInUp" data-wow-delay="700ms">';
		 //                        	if( ! empty( $settings['button_text'] ) ) {
			// 	                    	if( ! empty( $settings['button_link']['url'] ) ) {
			// 					            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
			// 					        }
			// 		            		if( ! empty( $settings['button_link']['nofollow'] ) ) {
			// 					            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
			// 					        }
			// 					        if( ! empty( $settings['button_link']['is_external'] ) ) {
			// 					            $this->add_render_attribute( 'button', 'target', '_blank' );
			// 					        }
			// 					        $this->add_render_attribute( 'button', 'class', 'btn btn-md btn-gradient' );

			// 					        	echo '<a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).' </a>';
		 //                            }

		 //                            if( ! empty( $settings['video_url']['url'] ) ) {

			// 	                    	$this->add_render_attribute( 'video', 'href', esc_url( $settings['video_url']['url'] ) );

			// 	                    	if( ! empty( $settings['video_url']['nofollow'] ) ) {
			// 					            $this->add_render_attribute( 'video', 'rel', 'nofollow' );
			// 					        }
			// 					        if( ! empty( $settings['video_url']['is_external'] ) ) {
			// 					            $this->add_render_attribute( 'video', 'target', '_blank' );
			// 					        }
			// 					        $this->add_render_attribute( 'video', 'class', 'popup-youtube video-btn' );

			//                             echo '<a '.$this->get_render_attribute_string('video').'><i class="fas fa-play"></i>'.esc_html($settings['video_btn_label']).'</a>';
			//                         }

		 //                        echo '</div>';
		 //                    echo '</div>';
		 //                    if( ! empty( $settings['banner_image']['url'] ) ){
			//                     echo '<div class="col-lg-5 offset-lg-1 width-160 thumb wow fadeInRight">';
			//                         echo appku_img_tag( array(
			// 							'url'	=> esc_url( $settings['banner_image']['url'] ),
			// 						) ); 
			//                     echo '</div>';
			//                 }
		 //                echo '</div>';
		 //            echo '</div>';
		 //        echo '</div>';
		 //    echo '</div>';
		}elseif( $settings['banner_style'] == '5' ){
			echo '<div class="banner-area bg-top bg-half-dark text-capitalized text-center top-pad-80 auto-height">';
		        echo '<div class="container">';
		            echo '<div class="content-box">';
		                echo '<div class="row align-center">';
		                    echo '<div class="col-lg-8 offset-lg-2 info">';
		                        if(!empty($settings['title'])){
			                        echo '<h2 class="wow fadeInRight" data-wow-defaul="300ms">'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			                    }
		                        echo '<div class="buttons">';
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
								        $this->add_render_attribute( 'button', 'class', 'btn btn-theme-effect btn-sm wow fadeInLeft' );

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
								        $this->add_render_attribute( 'button2', 'class', 'btn btn-md btn-gradient effect wow fadeInRight' );

								        	echo '<a '.$this->get_render_attribute_string('button2').'>'.esc_html( $settings['button_text2'] ).' </a>';
		                            }
		                        echo '</div>';
		                    echo '</div>';
		                    echo '<div class="col-lg-12">';
		                        echo '<div class="thumb-inner">';
		                        	if( ! empty( $settings['banner_image']['url'] ) ){
		                        		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['banner_image']['url'] ),
											'class' => 'wow fadeInRight',
											'data-wow-delay' => '900ms'
										) );
		                        	}
		                        	if( ! empty( $settings['banner_image2']['url'] ) ){
		                        		echo appku_img_tag( array(
											'url'	=> esc_url( $settings['banner_image2']['url'] ),
											'class' => 'wow fadeInLeft',
											'data-wow-delay' => '1100ms'
										) );
		                        	}
		                        	if( ! empty( $settings['banner_image3']['url'] ) ){
		                            echo '<!-- Fixed Shape -->';
		                            echo '<div class="left-shape" style="background-image: url('.esc_url( $settings['banner_image3']['url'] ).');"></div>';
		                            echo '<!-- Fixed Shape -->';
		                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}else{
			echo '<div class="banner-area text-light bg-gradient banner-style-five text-default">';

		        echo '<div class="animated-wave">';
		            echo '<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
		                <defs>
		                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
		                </defs>
		                <g class="parallax">
		                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
		                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
		                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
		                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
		                </g>
		            </svg>';
		            
		        echo '</div>';

		        echo '<div class="container">';
		            echo '<div class="double-items">';
		                echo '<div class="row align-center">';

		                    echo '<div class="col-lg-6 info">';
		                    	if(!empty($settings['title'])){
			                        echo '<h2 class="wow fadeInLeft" data-wow-defaul="300ms">'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="wow fadeInLeft" data-wow-delay="500ms">'.wp_kses_post($settings['desc']).'</p>';
			                    }
			                    if( ! empty( $settings['video_url']['url'] ) ) {

			                    	$this->add_render_attribute( 'video', 'href', esc_url( $settings['video_url']['url'] ) );

			                    	if( ! empty( $settings['video_url']['nofollow'] ) ) {
							            $this->add_render_attribute( 'video', 'rel', 'nofollow' );
							        }
							        if( ! empty( $settings['video_url']['is_external'] ) ) {
							            $this->add_render_attribute( 'video', 'target', '_blank' );
							        }
							        $this->add_render_attribute( 'video', 'class', 'popup-youtube video-btn' );

			                        echo '<div class="button">
			                            <a '.$this->get_render_attribute_string('video').'><i class="fas fa-play"></i>'.esc_html($settings['video_btn_label']).'</a>';
			                        echo '</div>';
			                    }
		                    echo '</div>';
		                    if( ! empty( $settings['banner_image']['url'] ) ){
			                    echo '<div class="col-lg-6 thumb wow fadeInRight" data-wow-delay="900ms">';
			                        echo appku_img_tag( array(
										'url'	=> esc_url( $settings['banner_image']['url'] )
									) );
			                    echo '</div>';
			                }  
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
	}
}