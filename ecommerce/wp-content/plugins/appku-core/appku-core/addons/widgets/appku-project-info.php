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
 * Project Inforamtion Widget .
 *
 */
class Appku_Project_Info extends Widget_Base {

	public function get_name() {
		return 'appkuprojectinfo';
	}

	public function get_title() {
		return __( 'Appku Project Info', 'appku' );
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
				'label'     => __( 'Project Info', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'project_title',
            [
				'label'         => __( 'Title', 'appku' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'       => __( 'Title' , 'appku' ),
				'label_block'   => true,
			]
		);
		

		$project_info = new \Elementor\Repeater();

		$project_info->add_control(
			'info_label',
            [
				'label'         => __( 'Info Label', 'appku' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'       => __( 'Date' , 'appku' ),
				'label_block'   => true,
			]
		);
		$project_info->add_control(
			'info_content',
            [
				'label'         => __( 'Information', 'appku' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'       => __( '25 February, 2022' , 'appku' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'informations',
			[
				'label' 	=> __( 'Icon List', 'appku' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $project_info->get_controls(),
				'default' 	=> [
					[
						'info_label' 	=> __( 'Client', 'appku' ),
					],
					[
						'info_label' 	=> __( 'Date', 'appku' ),
					],
					[
						'info_label' 	=> __( 'Address', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ info_label }}}',
			]
		);

		$social_repeater = new \Elementor\Repeater();

		$social_repeater->add_control(
			'social_icon',
			[
				'label' 		=> __( 'Social Icon', 'appku' ),
				'type' 			=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'fas fa-star',
					'library' 		=> 'solid',
				],
			]
		);

		$social_repeater->add_control(
			'icon_link',
			[
				'label' 		=> __( 'Link', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);

		$this->add_control(
			'social_icon_repeat',
			[
				'label' 	=> __( 'Icon List', 'appku' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $social_repeater->get_controls(),
				'default' 	=> [
					[
						'social_icon' 	=> __( 'Icon #1', 'appku' ),
					],
					[
						'social_icon' 	=> __( 'Icon #2', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ social_icon.value }}}',
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
					'{{WRAPPER}} .btn-theme-effect' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-theme-effect:hover' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-theme-effect::after' => 'background:{{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-theme-effect:hover' => 'background-color:{{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .our-features-area .feature-items .single-item .item.service-banner .btn:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn-theme-effect',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-theme-effect' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .btn-theme-effect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .btn-theme-effect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'appku' ),
				'selector' => '{{WRAPPER}} .btn-theme-effect',
			]
		);
        $this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();


        echo '<!-----------------------Start Project Inforamtion Area----------------------->';



        echo'<div class="project-info">';
        	if(!empty($settings['project_title'])){
	            echo'<h3 class="title">'.esc_html($settings['project_title']).'</h3>';
	        }
            echo'<ul>';
            	foreach( $settings['informations'] as $info ){
            		if(!empty( $info['info_label'] && $info['info_content'] )){
		                echo'<li>'.esc_html($info['info_label']).' <span>'.esc_html($info['info_content']).'</span></li>';
		            }
	            }
            echo'</ul>';
            if( ! empty( $settings['social_icon_repeat'] ) ){
	            echo '<ul class="social">';
	            	foreach( $settings['social_icon_repeat'] as $single_icon ){
						$target 	= 	$single_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow 	= $single_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
                    	echo '<li><a '.wp_kses_post( $target.$nofollow ).' href="'.esc_url( $single_icon['icon_link']['url'] ).'">';
						\Elementor\Icons_Manager::render_icon( $single_icon['social_icon'], [ 'aria-hidden' => 'true' ] );
						echo '</a></li>';
					}
	            echo'</ul>';
	        }
        echo'</div>';
		echo '<!-----------------------Start Project Inforamtion Area----------------------->';

	}

}