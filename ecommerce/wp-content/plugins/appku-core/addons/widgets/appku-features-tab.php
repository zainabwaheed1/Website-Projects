<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Features tab Widget .
 *
 */
class Appku_Feature_Tab extends Widget_Base {

	public function get_name() {
		return 'appkufeaturestab';
	}

	public function get_title() {
		return __( 'Appku Features Tab', 'appku' );
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
				'label'     => __( 'Tab', 'appku' ),
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
				'type' 			=> Controls_Manager::WYSIWYG,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
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

        echo '<div class="container">';
            echo '<div class="row">';

                echo '<div class="col-lg-8 text-center offset-lg-2">';
                    echo '<div class="nav nav-tabs text-center work-process-tab-navs" id="nav-tab" role="tablist">';
                    	$x = 1;
		                foreach( $settings['slides'] as $single_data ){
							if( $x == '1' ){
								$ariaexpanded 	= 'true';
								$is_active 		= 'active';
							}else{
								$ariaexpanded 	= 'false';
								$is_active 		= '';
							}
	                        echo '<button class="nav-link '.esc_attr( $is_active ).'" id="nav-id-'.esc_attr( $x ).'" data-bs-toggle="tab" data-bs-target="#tab'.esc_attr( $x ).'" type="button" role="tab" aria-controls="tab'.esc_attr( $x ).'" aria-selected="'.esc_attr( $ariaexpanded ).'">
	                            <h4>'.esc_html($single_data['title']).'</h4>
	                        </button>';
	                    $x++;
	                    }

                    echo '</div>';
                echo '</div>';

                echo '<div class="col-lg-12">';
                    echo '<div class="tab-content work-process-tab-content" id="nav-tabContent">';

                    	$x = 1;
		                foreach( $settings['slides'] as $single_data ){
							if( $x == '1' ){
								$ariaexpanded 	= 'true';
								$is_active 		= 'show active';
							}else{
								$ariaexpanded 	= 'false';
								$is_active 		= '';
							}
	                        echo '<!-- Single Item -->';
	                        echo '<div class="tab-pane fade '.esc_attr( $is_active ).'" id="tab'.esc_attr( $x ).'" role="tabpanel" aria-labelledby="nav-id-'.esc_attr( $x ).'">';
	                            echo '<div class="row align-center">';
	                                
	                                echo '<div class="col-lg-6 pr-80 pr-md-15 pr-xs-15">';
	                                    echo '<div class="thumb">';
	                                        echo appku_img_tag( array(
												'url'	=> esc_url( $single_data['icon_image']['url'] ),
											) );
	                                    echo '</div>';
	                                echo '</div>';

	                                echo '<div class="col-lg-6">';
	                                    echo '<div class="info">';
	                                        if(!empty($single_data['desc'])){
				                               	echo wp_kses_post($single_data['desc']);
				                            }
	                                    echo '</div>';
	                                echo '</div>';
	                            echo '</div>';
	                        echo '</div>';
	                        echo '<!-- End Single Item -->';
	                    $x++;
	                    }
                    echo '</div>';
                echo '</div>';

            echo '</div>';
        echo '</div>';

		echo '<!--------------------------------- Features Area end --------------------------------->';
	}
}