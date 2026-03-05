<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Overview Widget .
 *
 */
class Appku_Overview extends Widget_Base {

	public function get_name() {
		return 'appkuoverview';
	}

	public function get_title() {
		return __( 'Appku Overview', 'evona' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'evona' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'features_section',
			[
				'label'     => __( 'Overview', 'evona' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'feature_style',
			[
				'label' 		=> __( 'Chose Style', 'appku' ),
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
			'title', [
				'label' 		=> __( 'Plan Title', 'evona' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'evona' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'shape_image',
			[
				'label' 		=> __( 'Thumb Image', 'appku' ),
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
				'label' 		=> __( 'Slides', 'evona' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Rubaida Kanom', 'evona' ),
						'plan_icon' 		=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ title }}}',
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
	}

		
	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Overview Area start ------------------------------->';
        	if( $settings['feature_style'] == '1' ){
        		$style_class 	= 'overview-carousel';
        		$wrapper_class 	= 'overview-area';
        	}else{
        		$style_class 	= 'screenshot-carousel';
        		$wrapper_class 	= 'screenshot-area';
        	}
			echo '<div class="'.esc_attr($wrapper_class).' carousel-shadow">';
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
		        echo '<div class="container-full">';
		            echo '<div class="row">';
		                echo '<div class="col-lg-12">';
		                    echo '<div class="'.esc_attr($style_class).' owl-carousel owl-theme">';
		                    	$i = 0;
		                        foreach( $settings['slides'] as $single_data ){
		                        	$i++;
		                        	$k = str_pad($i, 2, '0', STR_PAD_LEFT);
			                        echo '<!-- Single item -->';
			                        echo '<div class="item">';
			                        	if( ! empty( $single_data['shape_image']['url'] ) ){
				                        	echo '<div class="thumb">';
				                                echo appku_img_tag( array(
													'url'	=> esc_url( $single_data['shape_image']['url'] ),
												) );
				                                echo '<a href="'.esc_url( $single_data['shape_image']['url'] ).'" class="item popup-gallery theme video-play-button">
				                                    <i class="fa fa-plus"></i>
				                                </a>';
				                            echo '</div>';
				                        }
			                        	if(!empty($single_data['title'])){
				                            echo '<div class="content">';
				                                echo '<h4><span>'.esc_html($k).'</span> '.wp_kses_post($single_data['title']).'</h4>';
				                            echo '</div>';
				                        }

			                        echo '</div>';
			                        echo '<!-- End Single item -->';
			                    }
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		echo '<!--------------------------------- Overview Area end --------------------------------->';
	}
}