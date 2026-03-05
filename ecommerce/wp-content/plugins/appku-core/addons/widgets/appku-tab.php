<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 *  Tab Widget .
 *
 */
class Appku_Tab_Box extends Widget_Base {

	public function get_name() {
		return 'appkutab';
	}

	public function get_title() {
		return __( 'Appku Tab', 'appku' );
	}


	public function get_icon() {
		return 'eicon-code';
    }


	public function get_categories() {
		return [ 'appku' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'feature_section',
			[
				'label' 	=> __( 'Tab', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Big data analytic and <br> realtime data Solutions', 'sasoft' )
			]
        );
        $this->add_control(
			'description',
			[
				'label' 	=> __( 'Description', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'As a solution providing company we offer a wide range of consulting, development & quality services with 100% satisfaction.', 'sasoft' )
			]
        );

        $repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Tab Title', 'appku' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'dynamic' 		=> [
					'active' 		=> true,
				],
			]
        );
        $repeater->add_control(
			'tab_content',
			[
				'label'     => __( 'Tab Content', 'appku' ),
                'type'      => Controls_Manager::WYSIWYG,
			]
        );
        $this->add_control(
			'tabs',
			[
				'label' 		=> __( 'Tabs', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'About Us', 'appku' ),
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
				'label' 	=> __( 'Heading', 'appku' ),
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
					'{{WRAPPER}} h2'	=> 'color: {{VALUE}}!important;',

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h2',
			]
		);

        $this->add_responsive_control(
			's_title_margin',
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
			's_title_padding',
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
					'{{WRAPPER}} .head-two p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .head-two p',
			]
		);

        $this->add_responsive_control(
			's_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .head-two p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .head-two p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<div class="about-style-four info wow fadeInRight" data-wow-delay="300ms">';
            if(!empty($settings['title'])){
                echo '<h2>'.wp_kses_post($settings['title']).'</h2>';
            }
            echo '<div class="head-two">';
            if(!empty($settings['description'])){
                echo '<p>'.wp_kses_post($settings['description']).'</p>';
            }
            echo '</div>';
            echo '<nav>';
                echo '<div class="nav nav-tabs" id="nav-tab" role="tablist">';
                	$x = 1;
		        	foreach( $settings['tabs'] as $data ){
		        		if( $x == '1' ){
							$is_active		= 'active';
							$ariaexpanded 	= 'true';
						}else{
							$is_active		= '';
							$ariaexpanded 	= 'false';
						}

						$info_title 	= strtolower( $data['title'] );
						$replace 		= array(' ','-',' - ');
						$with 			= array('','','');
						$final_data 	= str_replace( $replace, $with, $info_title );
	                    echo '<button class="nav-link '.esc_attr($is_active).'" id="'.esc_attr($final_data).'-tab" data-bs-toggle="tab" data-bs-target="#'.esc_attr($final_data).'" type="button" role="tab" aria-controls="'.esc_attr($final_data).'" aria-selected="'.esc_attr($ariaexpanded).'">'.esc_html($data['title']).'</button>';
                    $x++;
					}

                echo '</div>';
            echo '</nav>';
            echo '<div class="tab-content" id="nav-tabContent">';
            	$x = 1;
	        	foreach( $settings['tabs'] as $data ){
	        		if( $x == '1' ){
						$is_active		= 'show active';
						$ariaexpanded 	= 'true';
					}else{
						$is_active		= '';
					}

					$info_title 			= strtolower( $data['title'] );
					$replace 		= array(' ','-',' - ');
					$with 			= array('','','');
					$final_data 	= str_replace( $replace, $with, $info_title );
	                echo '<div class="tab-pane fade '.esc_attr($is_active).'" id="'.esc_attr($final_data).'" role="tabpanel" aria-labelledby="'.esc_attr($final_data).'-tab">';
	                    
	                    echo wp_kses_post( $data['tab_content'] );

	                echo '</div>';
	            $x++;
	            }
                
            echo '</div>';
        echo '</div>'; 
	}

}