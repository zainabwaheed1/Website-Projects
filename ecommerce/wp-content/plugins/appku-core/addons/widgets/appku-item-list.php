<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Features Widget .
 *
 */
class Appku_Feature_List extends Widget_Base {

	public function get_name() {
		return 'appkufeatureslist';
	}

	public function get_title() {
		return __( 'Appku List', 'appku' );
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
				'label'     => __( 'List', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );


        //----------------------------feddback repeter start--------------------------------//

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
			'desc', [
				'label' 		=> __( 'Content', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'chose_icon_style',
			[
				'label' 		=> __( 'Icon Type', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'class',
				'options' 		=> [
					'class'  	=> __( 'Class', 'appku' ),
					'img' 		=> __( 'Image', 'appku' ),
				],
			]
		);
        $repeater->add_control(
			'icon_class', [
				'label' 		=> __( 'Icon Class', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
				'condition'		=> [ 'chose_icon_style' => [ 'class' ] ],
			]
        );
        $repeater->add_control(
			'icon_image',
			[
				'label' 		=> __( 'Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'chose_icon_style' => [ 'img' ] ],
			]
		);
        $repeater->add_control(
			'details_page', [
				'label' 		=> __( 'Details Page URL', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( '#' , 'appku' ),
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
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ title }}}',
			]
		);
		$this->end_controls_section();


        
		/*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'feturs_con_styling',
			[
				'label' 	=> __( 'Features', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs'
		);


		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Title', 'appku' ),
			]
		);
        $this->add_control(
			'f_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  h5'	=> 'color: {{VALUE}}!important;',

				],
			]
        );
        $this->add_control(
			'f_title_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h5 a:hover'	=> 'color: {{VALUE}}!important;',

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'f_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .item h5',
			]
		);

        $this->add_responsive_control(
			'f_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'f_title_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			'f_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} p'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'f_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} p',
			]
		);

        $this->add_responsive_control(
			'f_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'f_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );



		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();


    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Features Area start ------------------------------->';

        	echo '<div class="collaboration-style-one">';
	        	echo '<ul>';
	        		foreach( $settings['slides'] as $single_data ){
                		$url = $single_data['details_page'] ;
                		if(!empty($url)){
                			$url_start_tag 	= '<a href="'.esc_url($url).'">';
                			$url_end_tag 	= '</a>';
                		}else{
                			$url_start_tag 	= '';
                			$url_end_tag 	= '';
                		}
		                echo '<li>';
		                    if($single_data['chose_icon_style'] == 'class' ){
                            	echo '<div class="icon">';
                            		echo wp_kses_post($single_data['icon_class']);
                            	echo '</div>';
                            }else{
                            	echo appku_img_tag( array(
									'url'	=> esc_url( $single_data['icon_image']['url'] ),
								) );
                            }
		                    echo '<div class="info">';
		                        if(!empty($single_data['title'])){
	                              	echo '<h5>'.$url_start_tag.esc_html($single_data['title']).$url_end_tag.'</h5>';
	                            }
	                            if(!empty($single_data['desc'])){
	                               	echo '<p>'.esc_html($single_data['desc']).'</p>';
	                            }
		                    echo '</div>';
		                echo '</li>';
		            }   
	            echo '</ul>';
            echo '</div>';

		echo '<!--------------------------------- Features Area end --------------------------------->';
	}
}