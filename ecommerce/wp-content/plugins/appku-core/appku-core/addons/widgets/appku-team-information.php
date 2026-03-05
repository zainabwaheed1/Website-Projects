<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
/**
 *
 * Team Memeber Info Widget .
 *
 */
class Appku_Team_Info extends Widget_Base{

	public function get_name() {
		return 'appkumemberinfo';
	}

	public function get_title() {
		return __( 'Appku Team Info', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_info_section',
			[
				'label' 	=> __( 'Team Information', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'name',
			[
				'label' 	=> __( 'Name', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Juniatur Rahman', 'appku' )
			]
        );
        $this->add_control(
			'desig',
			[
				'label' 	=> __( 'Designation', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Graphics Designer', 'appku' )
			]
        );
        $this->add_control(
			'info',
			[
				'label' 	=> __( 'About Information', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring house in never fruit up. Pasture imagine my garrets.', 'appku' )
			]
        );
        $this->add_control(
			'email',
			[
				'label' 	=> __( 'Email', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'support@avedi.com', 'appku' )
			]
        );
        $this->add_control(
			'mobile',
			[
				'label' 	=> __( 'Contact Number', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '+44-20-7328-4499', 'appku' )
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

		$this->end_controls_section();

		 /*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Team Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Name', 'appku' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h2'	=> '--color-heading: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h2',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
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
			'overview_title_padding',
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
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Designation', 'appku' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} span'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} span',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();

		//--------------------three--------------------//

		$this->start_controls_tab(
			'style_hover_tab3',
			[
				'label' => esc_html__( 'Info', 'appku' ),
			]
		);
		$this->add_control(
			'info_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'info_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} p',
			]
		);

        $this->add_responsive_control(
			'info_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'info_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		$this->end_controls_tabs();
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
		echo '<!-----------------------Start Teammember Information----------------------->';
			$email  	= $settings['email'];
			$mobile  	= $settings['mobile'];


            $email      = is_email( $email );

            $replace    = array(' ','-',' - ');
            $with       = array('','','');

            $emailurl   = str_replace( $replace, $with, $email );
            $mobileurl  = str_replace( $replace, $with, $mobile );

			echo '<div class="team-single-area">';
				echo '<div class="team-content-top">';
					echo '<div class="right-info">';
						if( ! empty( $settings['name'] ) ){
			                echo '<h2>'.esc_html($settings['name']).'</h2>';
			            }
			            if( ! empty( $settings['desig'] ) ){
			                echo '<span>'.esc_html($settings['desig']).'</span>';
			            }
			            if( ! empty( $settings['info'] ) ){
			                echo '<p>'.esc_html($settings['info']).'</p>';
			            }
		                echo '<ul>';
		                	if( ! empty( $emailurl ) ){
			                    echo '<li>';
			                        echo '<strong>'.esc_html__('Email: ','appku').'</strong>';
			                        echo '<a href="'.esc_attr( 'mailto:'.$emailurl ).'">'.esc_html($settings['email']).'</a>';
			                    echo '</li>';
			                }
			                if( ! empty( $mobileurl ) ){
			                    echo '<li>';
			                        echo '<strong>'.esc_html__('Phone: ','appku').'</strong>';
			                        echo '<a href="'.esc_attr( 'tel:'.$mobileurl ).'">'.esc_html($settings['mobile']).'</a>';
			                    echo '</li>';
			                }
		                echo '</ul>';
		                echo '<div class="social">';
		                	if( ! empty( $settings['button_text'] ) ){
			                    echo '<a class="btn circle btn-theme effect btn-md" href="'.esc_url( $settings['button_link']['url'] ).'">'.esc_html($settings['button_text']).'</a>';
			                }

		                    if( ! empty( $settings['social_icon_repeat'] ) ){
			                    echo '<div class="share-link">';
			                        echo '<i class="fas fa-share-alt"></i>';
			                        echo '<ul>';
			                        	foreach( $settings['social_icon_repeat'] as $single_icon ){
											$target 	= 	$single_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
											$nofollow 	= $single_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
			                            	echo '<li><a '.wp_kses_post( $target.$nofollow ).' href="'.esc_url( $single_icon['icon_link']['url'] ).'">';
											\Elementor\Icons_Manager::render_icon( $single_icon['social_icon'], [ 'aria-hidden' => 'true' ] );
											echo '</li></a>';
										}
									echo '</ul>'; 
			                    echo '</div>';
			                }
		                echo '</div>';
		            echo '</div>';
	            echo '</div>';
            echo '</div>';
		echo '<!-----------------------End Teammember Information----------------------->';
	}
}