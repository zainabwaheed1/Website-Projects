<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
/**
 *
 * Progressbar Widget .
 *
 */
class Appku_Progressbar extends Widget_Base{

	public function get_name() {
		return 'appkuprogressbar';
	}

	public function get_title() {
		return __( 'Appku Progressbar', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }
    
	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'progressbar_section',
			[
				'label' 	=> __( 'Progressbar', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'skill_bar_text',
			[
				'label' 	=> __( 'Skill Bar Text', 'appku' ),
				'type' 		=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
			]
		);

		$repeater->add_control(
			'progress_bar_width',
			[
				'label' 		=> __( 'Skill Bar Width', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 70,
				],
			]
		);

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Skill Bar', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'skill_bar_text' => __( 'Repairs','appku' ),
					],
					[
						'skill_bar_text' => __( 'Repairs','appku' ),
					],
				],
				'title_field' => '{{{ skill_bar_text }}}',
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
			'form_bg',
			[
				'label' 		=> __( 'Progressbar Color 1 ', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
			]
        );
        $this->add_control(
			'form_bg2',
			[
				'label' 		=> __( 'Progressbar Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .skill-items .progress-box .progress .progress-bar' => 'background-image: -webkit-linear-gradient(45deg,{{form_bg.VALUE}} 0%,{{VALUE}} 15%);',
                ],
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
					'{{WRAPPER}} h5' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} h5',
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();
		//---------------------------------------Numver Style---------------------------------------//

		$this->start_controls_section(
			'number_style',
			[
				'label' 	=> __( 'Number Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' 		=> __( 'Number Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .skill-items .progress-box .progress .progress-bar span' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'number_typography',
				'label' 	=> __( 'Number Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .skill-items .progress-box .progress .progress-bar span',
			]
        );
        $this->add_responsive_control(
			'number_margin',
			[
				'label' 		=> __( 'Number Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .skill-items .progress-box .progress .progress-bar span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'number_padding',
			[
				'label' 		=> __( 'Number Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .skill-items .progress-box .progress .progress-bar span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		echo '<!-----------------------Start Progressbar----------------------->';
		echo '<div class="skill-items">';
		    foreach( $settings['slides'] as $single_data ){
			    echo '<div class="progress-box">';
			    	if( ! empty( $single_data['skill_bar_text'] ) ){
				        echo '<h5>'.esc_html( $single_data['skill_bar_text'] ).'</h5>';
				    }

			        echo '<div class="progress">';
			        	if( ! empty( $single_data['progress_bar_width'] ) ){
				            echo '<div class="progress-bar" role="progressbar" data-width="'.esc_attr( $single_data['progress_bar_width']['size'] ).'">';
				                 echo '<span>'.esc_html( $single_data['progress_bar_width']['size'] ).'%</span>';
				            echo '</div>';
				        }
			        echo '</div>';
			    echo '</div>';
		    }
		echo '</div>';
		echo '<!-----------------------End Progressbar----------------------->';
	}
}