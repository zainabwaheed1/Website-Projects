<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class Appku_Subscribe_Widgets extends Widget_Base {

	public function get_name() {
		return 'appkunewsletter2';
	}

	public function get_title() {
		return __( 'Appku Newsletter', 'appku' );
	}


	public function get_icon() {
		return 'eicon-code';
    }
    

	public function get_categories() {
		return [ 'appku' ];
	}

	
	protected function register_controls() {

		$this->start_controls_section(
			'newsletter_content',
			[
				'label' 	=> __( 'Newsletter', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'form_style',
			[
				'label' 		=> __( 'Form Style', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'appku' ),
					'2' 		=> __( 'Style Two', 'appku' ),
				],
			]
		);
		$this->add_control(
			'fullwidth',
			[
				'label' 		=> __( 'Full Width ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
				'condition'		=> [ 'form_style!' => '2' ],
			]
		);
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'sasoft' )
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Subtitle', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Subtitle', 'sasoft' )
			]
        );
		$this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Enter Your Email', 'appku' ),
			]
		);
		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Subscribe', 'appku' ),
				'rows' 			=> 2,
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
		$this->add_control(
			'shape_image2',
			[
				'label' 		=> __( 'Shape Image 2', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'form_style!' => '2' ],
			]
		);

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
			'bg_color',
			[
				'label' 		=> __( 'Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  .trial-box' => 'background: {{VALUE}}!important;',
                ],
                'condition'		=> [ 'form_style!' => '2' ],
			]
        );
        $this->add_control(
			'form_bg',
			[
				'label' 		=> __( 'Background Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition'		=> [ 'form_style' => '2' ],
			]
        );
        $this->add_control(
			'form_bg2',
			[
				'label' 		=> __( 'Background Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .subscribe-area .subscribe-items' => 'background-image: -webkit-linear-gradient(45deg,{{form_bg.VALUE}} 0%,{{VALUE}} 50%);',
                ],
                'condition'		=> [ 'form_style' => '2' ],
			]
        );
        $this->end_controls_section();

        //---------------------------------------subTitle Style---------------------------------------//

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
					'{{WRAPPER}}  .free-trial-area h5' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .subscribe-area h2' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}}  .free-trial-area h5,{{WRAPPER}}  .subscribe-area h2',
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .free-trial-area h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .subscribe-area h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}  .free-trial-area h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .subscribe-area h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}  .free-trial-area h2' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .subscribe-area p' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}}  .free-trial-area h2,{{WRAPPER}}  .subscribe-area p',
			]
        );
        $this->add_responsive_control(
			'subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .free-trial-area h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .subscribe-area p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}  .free-trial-area h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .subscribe-area p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'subscribe_section',
			[
				'label' 	=> __( 'Subscribe Form Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_bg_color',
			[
				'label' 	=> __( 'Form Background Color', 'appku' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input' => 'background-color: {{VALUE}}',
                ]
			]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border2',
				'label' 	=> __( 'Border', 'appku' ),
                'selector' 	=> '{{WRAPPER}}  input',
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' 		=> __( 'Button Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
			]
        );
        $this->add_control(
			'btn_color2',
			[
				'label' 		=> __( 'Button Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  button' => 'background-image: -webkit-linear-gradient(45deg,{{btn_color.VALUE}} 0%,{{VALUE}} 50%);',
                ],
			]
        );


		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        if( $settings['form_style'] == '1' ){
	        echo '<div class="free-trial-area text-light text-center">';
	        	if( $settings['fullwidth'] == 'yes' ){
	        	echo '<div class="trial-box" style="background-image: url('.esc_url( $settings['shape_image']['url'] ).');">';
		       		echo '<div class="container">';
		       }else{
		        echo '<div class="container">';
		           echo '<div class="trial-box" style="background-image: url('.esc_url( $settings['shape_image']['url'] ).');">';
		       }
		                echo '<div class="row">';
		                    // echo '<div class="col-lg-8 offset-lg-2">';
		                    echo '<div class="col-lg-12 free-trial-wrap">';
		                    	echo '<div class="free-trial-title">';
									if(!empty($settings['title'])){
										echo '<h5>'.wp_kses_post($settings['title']).'</h5>';
									}
									if(!empty($settings['subtitle'])){
										echo '<h2>'.wp_kses_post($settings['subtitle']).'</h2>';
									}
								echo '</div>';
		                        echo '<form class="newsletter-form">';
		                            echo '<input type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" class="form-control" name="email">';
		                            echo '<button type="submit"> '.esc_html( $settings['newsletter_button'] ).'</button> '; 
		                       echo ' </form>';
		                    echo '</div>';
		                echo '</div>';
		                if( ! empty( $settings['shape_image2']['url'] ) ){
			                echo '<div class="illustration">';
			                    echo appku_img_tag( array(
									'url'	=> esc_url( $settings['shape_image2']['url'] ),
								) );
			                echo '</div>';
			            }
		           echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}else{
			echo '<div class="subscribe-area text-center text-light relative">';
		        echo '<div class="half-bg-top-gray"></div>';
		        echo '<div class="container">';
		            echo '<div class="subscribe-items">';
		                echo '<i class="flaticon-email"></i>';
		                echo '<!-- Shape -->';
		                if( ! empty( $settings['shape_image']['url'] ) ){
			                echo '<div class="fixed-shape-bottom">';
			                    echo appku_img_tag( array(
									'url'	=> esc_url( $settings['shape_image']['url'] ),
								) );
			                echo '</div>';
			            }
		                echo '<!-- End Shape -->';
		                echo '<div class="row align-center">';
		                    echo '<div class="col-lg-8 offset-lg-2">';
		                        if(!empty($settings['title'])){
			                        echo '<h2>'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<p>'.wp_kses_post($settings['subtitle']).'</p>';
			                    }
		                        echo '<form class="newsletter-form">';
		                            echo '<input type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" class="form-control" name="email">';
		                            echo '<button type="submit"> '.esc_html( $settings['newsletter_button'] ).'</button>  ';
		                        echo '</form>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
	}

}

						