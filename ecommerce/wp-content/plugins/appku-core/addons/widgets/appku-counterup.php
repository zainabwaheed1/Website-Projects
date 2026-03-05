<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
/**
 *
 * Counter up Widget .
 *
 */
class Appku_Counterup extends Widget_Base{

	public function get_name() {
		return 'appkucounterup';
	}

	public function get_title() {
		return __( 'Counterup', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counterup_section',
			[
				'label' 	=> __( 'Counterup', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'counterup_style',
			[
				'label' 	=> __( 'Counterup Style', 'appku' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	         => __( 'Style One', 'appku' ),
					'2' 	         => __( 'Style Two', 'appku' ),
				],
			]
		);


        $this->add_control(
            'counterup_title', [
                'label' 		=> __( 'Counterup Title?', 'appku' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default' 		=> __( 'Happy Customer' , 'appku' ),
                'label_block' 	=> true,
                'rows' 			=> 2, 
                'condition'		=> [ 'counterup_style' => '1'],
            ]
        );

		$this->add_control(
			'counterup_number', [
				'label' 		=> __( 'Counterup Number?', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( '167' , 'appku' ),
				'rows' 			=> 2, 
				'label_block' 	=> true,
				'condition'		=> [ 'counterup_style' => '1'],
			]
        );

		$this->add_control(
			'counterup_suffix', [
				'label' 		=> __( 'Counterup Suffix?', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2, 
				'default' 		=> __( '+' , 'appku' ),
				'label_block' 	=> true,
				'condition'		=> [ 'counterup_style' => '1'],
			]
        );
		//----------------------------counter repeter start--------------------------------//

		$repeater = new Repeater();

		$repeater->add_control(
            'counterup_title', [
                'label' 		=> __( 'Counterup Title?', 'appku' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default' 		=> __( 'Happy Customer' , 'appku' ),
                'rows' 			=> 2, 
                'label_block' 	=> true,
            ]
        );

		$repeater->add_control(
			'counterup_number', [
				'label' 		=> __( 'Counterup Number?', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2, 
				'default' 		=> __( '167' , 'appku' ),
				'label_block' 	=> true,
			]
        );
		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Features', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'counterup_title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
					[
						'counterup_title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
					[
						'counterup_title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ counterup_title }}}',
				'condition'		=> [ 'counterup_style' => '2'],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'counterup_style_section',
			[
				'label' 	=> __( 'Counterup Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        
        $this->add_control(
			'counterup_number_color',
			[
				'label' 		=> __( 'Counter Up Number Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .counter' => '--color-heading: {{VALUE}}!important',
				],
			]
        );

        $this->add_control(
			'counterup_text_color',
			[
				'label' 		=> __( 'Counter Up Text Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .medium' => 'color: {{VALUE}}!important',
				],
			]
        );

        $this->add_control(
			'form_bg',
			[
				'label' 		=> __( 'Background Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition'		=> [ 'counterup_style' => '2' ],
			]
        );
        $this->add_control(
			'form_bg2',
			[
				'label' 		=> __( 'Background Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .fun-factor-area .fun-fact-items' => 'background-image: -webkit-linear-gradient(45deg,{{form_bg.VALUE}} 0%,{{VALUE}} 50%);',
                ],
                'condition'		=> [ 'counterup_style' => '2' ],
			]
        );
        $this->end_controls_section();
	}


	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['counterup_style'] == '1' ){
			echo '<div class="fun-fact">';
	            echo '<div class="counter align-class">';
	            	if( ! empty( $settings['counterup_number'] ) ){
		                echo '<div class="timer" data-to="'.esc_attr( $settings['counterup_number'] ).'" data-speed="2000">'.esc_html( $settings['counterup_number'] ).'</div>';
		            }
		            if( ! empty( $settings['counterup_suffix'] ) ){
		                echo '<div class="operator">'.esc_html( $settings['counterup_suffix'] ).'</div>';
		            }
	            echo '</div>';
	            if( ! empty( $settings['counterup_title'] ) ){
		           	echo '<span class="medium">'.esc_html( $settings['counterup_title'] ).'</span>';
		        }
	        echo '</div>';
	    }else{

	    	echo '<div class="fun-factor-area">';
		        echo '<div class="container">';
		            echo '<div class="fun-fact-items text-center">';
		                echo '<div class="row">';

		                    foreach( $settings['slides'] as $single_data ){
		                    	$i = count($settings['slides']);

		                    	if($i == 1){
		                    		$colmn = 12;
		                    	}elseif($i == 2){
		                    		$colmn = 6;
		                    	}elseif($i == 3){
		                    		$colmn = 4;
		                    	}elseif($i == 4){
		                    		$colmn = 3;
		                    	}else{
		                    		$colmn = 2;
		                    	}
			                    echo '<div class="col-lg-'.esc_attr($colmn).' col-md-6 item">';
			                        echo '<div class="fun-fact">';
			                            if( ! empty( $single_data['counterup_number'] ) ){
						                    echo '<div class="timer" data-to="'.esc_attr( $single_data['counterup_number'] ).'" data-speed="5000">'.esc_html( $single_data['counterup_number'] ).'</div>';
						                }
					                    if( ! empty( $single_data['counterup_title'] ) ){
								           	echo '<span class="medium">'.esc_html( $single_data['counterup_title'] ).'</span>';
								        }
			                        echo '</div>';
			                    echo '</div>';
		                    }
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
	    }
	}
}