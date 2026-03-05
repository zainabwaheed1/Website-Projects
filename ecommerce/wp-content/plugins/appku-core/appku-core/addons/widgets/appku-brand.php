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
 * Brand Gallery Widget .
 *
 */
class Appku_Brand_Gallery extends Widget_Base{

	public function get_name() {
		return 'appkugallery';
	}

	public function get_title() {
		return __( 'Brand Gallery', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'gallery_section',
			[
				'label' 	=> __( 'Brand Gallery', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'feature_style',
			[
				'label' 		=> __( 'Gallery Style', 'appku' ),
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
			'heading',
			[
				'label' 	=> __( 'Heading', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Trusted client by over <br>10000+ of the world’s', 'appku' ),
                'condition'		=> [ 'feature_style!' => [ '3' ] ],
			]
        );
        $this->add_control(
			'user_counter',
			[
				'label' 	=> __( 'User Counter', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '10000', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
        );
        $this->add_control(
			'rating_counter',
			[
				'label' 	=> __( 'Rating Counter', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( '100', 'appku' ),
                'rows' 		=> 2,
                'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
        );
		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Logo', 'appku' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);
		$this->end_controls_section();
		//---------------------------------------Title Style---------------------------------------//

		$this->start_controls_section(
			'title_style',
			[
				'label' 	=> __( 'Title Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'feature_style!' => [ '3' ] ],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Title Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h3' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} h3',
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		echo '<!-----------------------Start Brand Gallery----------------------->';
		if( $settings['feature_style'] == '1' ){
			echo '<div class="clients-area">';
		        echo '<div class="container">';
		            echo '<div class="row align-center">';
		                echo '<div class="col-lg-6 left-info">';
		                    echo '<ul class="achivement">';
		                    	if(!empty($settings['user_counter'])){
			                        echo '<li>';
			                            echo '<div class="fun-fact">';
			                                echo '<div class="counter">';
			                                    echo '<div class="timer" data-to="'.esc_attr($settings['user_counter']).'" data-speed="5000">'.esc_html($settings['user_counter']).'</div>';
			                                    echo '<div class="operator">+</div>';
			                                echo '</div>';
			                                echo '<span class="medium">'.esc_html__('Trusted Users','appku').'</span>';
			                            echo '</div>';
			                        echo '</li>';
			                    }
			                    if(!empty($settings['rating_counter'])){
			                        echo '<li>';
			                            echo '<div class="fun-fact">';
			                                echo '<div class="counter">';
			                                    echo '<div class="timer" data-to="'.esc_attr($settings['rating_counter']).'" data-speed="5000">'.esc_html($settings['rating_counter']).'</div>';
			                                    echo '<div class="operator">%</div>';
			                                echo '</div>';
			                                echo '<span class="medium">'.esc_html__('Positive Rating','appku').'</span>';
			                            echo '</div>';
			                        echo '</li>';
			                    }
		                   echo ' </ul>';
		                echo '</div>';
		                if(!empty($settings['heading'])){
			                echo '<div class="col-lg-6 right-info">';
			                    echo '<h2>'.wp_kses_post($settings['heading']).'</h2>';
			                echo '</div>';
			            }
		                echo '<div class="col-lg-12">';
		                    echo '<div class="partner-carousel owl-carousel owl-theme">';
		                    	foreach ( $settings['gallery'] as $single_data ) {
			                        echo appku_img_tag( array(
                                        'url'   => esc_url( $single_data['url'] )
                                    ) );
			                    }
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['feature_style'] == '2' ){
			echo '<div class="clients-style-one-area text-center">';
		        echo '<div class="container">';
		            echo '<div class="clients-style-one-box">';
		                echo '<div class="row">';
		                    echo '<div class="col-lg-12">';
		                    	if(!empty($settings['heading'])){
			                        echo '<h3>'.wp_kses_post($settings['heading']).'</h3>';
			                    }
		                        echo '<div class="partner-carousel owl-carousel owl-theme">';
		                            foreach ( $settings['gallery'] as $single_data ) {
				                        echo appku_img_tag( array(
	                                        'url'   => esc_url( $single_data['url'] )
	                                    ) );
				                    }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		           echo ' </div>';
		        echo '</div>';
		    echo '</div>';
		}else{
			echo '<div class="clients-style-one-area inc-border text-center">';
		        echo '<div class="container">';
		            echo '<div class="clients-style-one-box">';
		                echo '<div class="row">';
		                    echo '<div class="col-lg-12">';
		                        echo '<div class="partner-border-carousel owl-carousel owl-theme">';
		                            foreach ( $settings['gallery'] as $single_data ) {
				                        echo appku_img_tag( array(
	                                        'url'   => esc_url( $single_data['url'] )
	                                    ) );
				                    }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
		echo '<!-----------------------End Brand Gallery----------------------->';
	}
}