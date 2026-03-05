<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
/**
 *
 * Single Contact Info Widget .
 *
 */
class Appku_Single_Contact_Info_Widget extends Widget_Base{

	public function get_name() {
		return 'appkusinglecontactinfo';
	}

	public function get_title() {
		return __( 'Appku Contact Info', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'chose_us_content',
			[
				'label'		=> __( 'Contact Info','appku' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'contact_type',
			[
				'label' 		=> __( 'Contact Type', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'email',
				'options'		=> [
					'email'  			=> __( 'Contact Type Email', 'appku' ),
					'phone' 			=> __( 'Contact Type Phone', 'appku' ),
					'address' 			=> __( 'Contact Type Address', 'appku' ),
					'website' 			=> __( 'Contact Type Website', 'appku' ),
				],
			]
		);

		//--------------------------------------Email Control-------------------------------------//

		$this->add_control(
			'contact_email_url',
            [
				'label'         => __( 'Email', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'info@yourdomain.com' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'email',
                ],
			]
		);
		$this->add_control(
			'contact_email_url2',
            [
				'label'         => __( 'Alternate Email', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'info@yourdomain.com' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'email',
                ],
			]
		);


		//--------------------------------------Phone Control-------------------------------------//


		$this->add_control(
			'contact_phone',
            [
				'label'         => __( 'Phone', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '+(00) 7712 653 7514' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'phone',
                ],
			]
		);
		$this->add_control(
			'contact_phone2',
            [
				'label'         => __( 'Alternate Phone', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '+(00) 7712 653 7514' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'phone',
                ],
			]
		);

		//--------------------------------------Address Control-------------------------------------//


		$this->add_control(
			'contact_address',
            [
				'label'         => __( 'Address', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '21/7A, Josua Street, Queens, NY, United States' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'address',
                ],
			]
		);


        $this->add_control(
            'fontawesome',
            [
                'label'     => __( 'Chose Icon', 'appku' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'     => 'fab fa-facebook-f',
                    'library'   => 'solid',
                ],
            ]
        );

        //--------------------------------------website Control-------------------------------------//


		$this->add_control(
			'contact_website_title',
            [
				'label'         => __( 'Website Title', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Angfuz' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'website',
                ],
			]
		);
		$this->add_control(
			'contact_website_url',
            [
				'label'         => __( 'Website URL', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'haarmax' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'  => [
                    'contact_type' => 'website',
                ],
			]
		);

		$this->add_control(
			'contact_website_title2',
            [
				'label'         => __( 'Alternate Website Title', 'appku' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'vecurosoft' , 'appku' ),
				'label_block'   => true,
				'condition'  => [
                    'contact_type' => 'website',
                ],
			]
		);
		$this->add_control(
			'contact_website_url2',
            [
				'label'         => __( 'Alternate Website URL', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'haarmax' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'  => [
                    'contact_type' => 'website',
                ],
			]
		);

		
		$this->end_controls_section();


		/*-----------------------------------------title styling------------------------------------*/

		$this->start_controls_section(
			'general',
			[
				'label' 	=> __( 'General Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'appku' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' 		=> 'background',
				'label' 	=> __( 'Background', 'appku' ),
				'types' 	=> [ 'classic', 'gradient', 'video' ],
				'selector' 	=> '{{WRAPPER}} .contact-area .content li',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'box_shadow',
				'label' 	=> __( 'Box Shadow', 'appku' ),
				'selector' 	=> '{{WRAPPER}} .contact-area .content li',
			]
		);
		$this->add_control(
			'width',
			[
				'label' 	=> __( 'Box Radious', 'appku' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-area .content li' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();


        /*-----------------------------------------Info styling------------------------------------*/

		$this->start_controls_section(
			'info_styling',
			[
				'label' 	=> __( 'Info Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Label', 'appku' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h5'	=> '--color-heading: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} h5',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Information', 'appku' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-area .content li a,{{WRAPPER}} p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_control(
			'overview_content_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-area .content li a:hover'	=> '--color-primary: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .contact-area .content li a,{{WRAPPER}} p',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .contact-area .content li a,{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .contact-area .content li a,{{WRAPPER}} p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();
 

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		echo '<!-----------------------Start Features Area----------------------->';
			$email1 			= $settings['contact_email_url'];
			$email2 			= $settings['contact_email_url2'];

			$phone1 			= $settings['contact_phone'];
			$phone2 			= $settings['contact_phone2'];

			$email1 			= is_email( $email1 );
			$email2 			= is_email( $email2 );

			$replace 		= array(' ','-',' - ');
			$with 			= array('','','');

			$emailurl1 		= str_replace( $replace, $with, $email1 );
			$emailurl2 		= str_replace( $replace, $with, $email2 );

			$mobileurl1 	= str_replace( $replace, $with, $phone1 );
			$mobileurl2 	= str_replace( $replace, $with, $phone2 );
			$elementClass = 'contact-area';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}

			echo '<div class="'.$elementClass.'">';
				echo '<div class="content">';
					echo '<ul><li>';
						if( ! empty( $settings['fontawesome'] ) ){
			                echo '<div class="icon">';
			                	\Elementor\Icons_Manager::render_icon( $settings['fontawesome'], [ 'aria-hidden' => 'true' ] );
			                echo '</div>';
			            }
		                echo '<div class="info">';
		                	if( $settings['contact_type'] == 'phone' ){
		                		echo '<h5>'.esc_html__('Phone','appku').'</h5>';
		                		if(!empty($mobileurl1)){
		                			echo '<a href="'.esc_attr( 'tel:'.$mobileurl1 ).'">'.esc_html( $phone1 ).'</a>';
		                		}
		                		if(!empty($mobileurl2)){
		                			echo '<br><a href="'.esc_attr( 'tel:'.$mobileurl2 ).'">'.esc_html( $phone2 ).'</a>';
		                		}
			                }elseif( $settings['contact_type'] == 'email' ){
			                	echo '<h5>'.esc_html__('Our Email','appku').'</h5>';
			                	if(!empty($emailurl1)){
			                		echo'<a href="'.esc_attr( 'mailto:'.$emailurl1 ).'">'.esc_html( $email1 ).'</a>';
			                	}
			                	if(!empty($emailurl2)){
			                		echo'<br><a href="'.esc_attr( 'mailto:'.$emailurl2 ).'">'.esc_html( $email2 ).'</a>';
			                	}
			                }elseif( $settings['contact_type'] == 'website' ){
			                	echo '<h5>'.esc_html__('Website','appku').'</h5>';
			                	if(!empty($settings['contact_website_title'])){
			                		echo'<a href="'.esc_url($settings['contact_website_url']['url']).'">'.esc_html( $settings['contact_website_title'] ).'</a>';
			                	}
			                	if(!empty($settings['contact_website_title2'])){
			                		echo'<br><a href="'.esc_url($settings['contact_website_url2']['url']).'">'.esc_html( $settings['contact_website_title2'] ).'</a>';
			                	}

			            	}else{
			            		echo '<h5>'.esc_html__('Address','appku').'</h5>';
			                	if(!empty($settings['contact_address'])){
				                	echo '<p>'.wp_kses_post( $settings['contact_address'] ).'</p>';
				                }
			                }
		                echo '</div>';
		            echo '</li></ul>';
	            echo '</div>';
            echo '</div>';
		echo '<!-----------------------End Features Area----------------------->';
	}
}