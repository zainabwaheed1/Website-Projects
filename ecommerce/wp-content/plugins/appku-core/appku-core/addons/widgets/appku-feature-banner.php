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
 * Feature Banner Widget .
 *
 */
class Appku_Feature_Banner extends Widget_Base {

	public function get_name() {
		return 'appkufeaturebanner';
	}

	public function get_title() {
		return __( 'Appku Feature Banner', 'appku' );
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
				'label'     => __( 'Feature Banner', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'feature_title',
            [
				'label'         => __( 'Title', 'appku' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'       => __( 'Title' , 'appku' ),
				'label_block'   => true,
			]
		);
		$this->add_control(
			'feature_subtitle',
            [
				'label'         => __( 'Subtitle', 'appku' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'       => __( 'Subtitle' , 'appku' ),
				'label_block'   => true,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Button Text', 'appku' ),
                'rows' 		=> 2,
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
			]
		);
		 $this->add_control(
			'thumb_image',
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
        $this->end_controls_section();

        /*-----------------------------------------general styling------------------------------------*/

		$this->start_controls_section(
			'general',
			[
				'label' 	=> __( 'General Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );


        $this->end_controls_section();


        //-----------------------------------------Title styling-----------------------------------------//


        $this->start_controls_section(
			'title_styling',
			[
				'label' 	=> __( 'Title Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Title Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h4'	=> 'color: {{VALUE}}!important;',
				],
			]
        );

        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'title_typography',
		 		'label' 		=> __( 'Title Typography', 'appku' ),
		 		'selector' 		=> '{{WRAPPER}} h4',
			]
		);

        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->end_controls_section();

        //-----------------------------------------Subtitle styling-----------------------------------------//


        $this->start_controls_section(
			'subtitle_styling',
			[
				'label' 	=> __( 'Subtitle Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'subtitle_color',
			[
				'label' 		=> __( 'Subtitle Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h2'	=> 'color: {{VALUE}}!important;',
				],
			]
        );

        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'subtitle_typography',
		 		'label' 		=> __( 'Subtitle Typography', 'appku' ),
		 		'selector' 		=> '{{WRAPPER}} h2',
			]
		);

        $this->add_responsive_control(
			'subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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


        echo '<!-----------------------Start Feature Banner Area----------------------->';


        echo '<div class="our-features-area">';
	        echo '<div class="feature-items">';
		        echo '<div class="single-item">';
			        echo '<div class="item service-banner" style="background-image: url('.esc_url( $settings['thumb_image']['url'] ).');">';
		        		if(!empty($settings['feature_title'])){
			                echo '<h4>'.esc_html($settings['feature_title']).'</h4>';
			            }
			            if(!empty($settings['feature_subtitle'])){
			                echo '<h2>'.esc_html($settings['feature_subtitle']).'</h2>';
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
					        $this->add_render_attribute( 'button', 'class', 'btn circle btn-theme effect btn-md' );

					        	echo '<a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).' </a>';
	                    }
			        echo '</div>';
		        echo '</div>';
	        echo '</div>';
        echo '</div>';
		echo '<!-----------------------Start Feature Banner Area----------------------->';

	}

}