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
	                        echo '<strong>'.esc_html__('Email:','appku').'</strong>';
	                        echo '<a href="'.esc_attr( 'mailto:'.$emailurl ).'">'.esc_html($settings['email']).'</a>';
	                    echo '</li>';
	                }
	                if( ! empty( $mobileurl ) ){
	                    echo '<li>';
	                        echo '<strong>'.esc_html__('Phone:','appku').'</strong>';
	                        echo '<a href="'.esc_attr( 'tel:'.$mobileurl ).'">'.esc_html($settings['mobile']).'</a>';
	                    echo '</li>';
	                }
                echo '</ul>';
                echo '<div class="social">';
                	if( ! empty( $settings['button_text'] ) ){
	                    echo '<a class="btn circle btn-theme-effect btn-sm" href="'.esc_url( $settings['button_link']['url'] ).'">'.esc_html($settings['button_text']).'</a>';
	                }

                    if( ! empty( $settings['social_icon_repeat'] ) ){
	                    echo '<div class="share-link">';
	                        echo '<i class="fas fa-share-alt"></i>';
                        	foreach( $settings['social_icon_repeat'] as $single_icon ){
								$target 	= 	$single_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
								$nofollow 	= $single_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
                            	echo '<a '.wp_kses_post( $target.$nofollow ).' href="'.esc_url( $single_icon['icon_link']['url'] ).'">';
								\Elementor\Icons_Manager::render_icon( $single_icon['social_icon'], [ 'aria-hidden' => 'true' ] );
								echo '</a>';
							}   
	                    echo '</div>';
	                }
                echo '</div>';
            echo '</div>';
		echo '<!-----------------------End Teammember Information----------------------->';
	}
}