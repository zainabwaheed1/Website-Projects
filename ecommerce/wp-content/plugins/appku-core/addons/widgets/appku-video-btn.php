<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Appku_Vdo_Btn extends Widget_Base {

	public function get_name() {
		return 'appkuvdobtn';
	}

	public function get_title() {
		return __( 'Appku Video Button', 'vendora' );
	}


	public function get_icon() {
		return 'eicon-code';
    }


	public function get_categories() {
		return [ 'appku' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Image', 'vendora' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );


        $this->add_control(
			'video_link',
			[
				'label' 		=> __( 'Video Url', 'vendora' ),
				'type' 			=> Controls_Manager::URL,
                'placeholder' 	=> __( 'https://your-link.com', 'vendora' ),
                'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
        );

        $this->add_control(
			'title',
			[
				'label'     => __( 'Title', 'vendora' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );

		$this->add_control(
			'image_wrapper_class',
			[
				'label'     => __( 'Button Wrapper Class', 'vendora' ),
                'type'      => Controls_Manager::TEXT,
			]
        );
        $this->end_controls_section();


		//-------------------------------video button styling------------------------------- //

		$this->start_controls_section(
			'video_btn_style_section',
			[
				'label' 	=> __( 'Video Button Style', 'vendora' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'video_btn_label',
			[
				'label' 	=> __( 'Label Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}}'
                ]
			]
        );
        $this->add_control(
			'video_btn_color',
			[
				'label' 	=> __( 'Video Button Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn.style2 i' => 'color: {{VALUE}}'
                ]
			]
        );

		$this->add_control(
			'video_btn_hover_color',
			[
				'label' 	=> __( 'Video Button Hover Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn.style2:hover i' => 'color: {{VALUE}}!important;'
                ]
			]
        );

		$this->add_control(
			'video_btn_background_color',
			[
				'label' 	=> __( 'Video Button Background Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn.style2 i' => 'background-color: {{VALUE}}!important;'
                ]
			]
		);

		$this->add_control(
			'video_btn_background_hover_color',
			[
				'label' 	=> __( 'Video Button Background Hover Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn.style2:hover i' => 'background-color: {{VALUE}}!important;'
                ]
			]
		);

		$this->add_control(
			'video_btn_ripple_effect_color',
			[
				'label' 		=> __( 'Video Button Ripple Effect Color', 'vendora' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .play-btn.style2:after,{{WRAPPER}} .play-btn:before' => 'background-color: {{VALUE}}!important;'
                ]
			]
        );

		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();


        $this->add_render_attribute('wrapper','class',esc_attr( $settings['image_wrapper_class'] ));

            echo '<!-- Image -->';
                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
					if(!empty($settings['title'])){
						$text = $settings['title'];
					}else{
						$text = '';
					}
					if( !empty( $settings['video_link']['url'] ) ) {
						echo '<a href="'.esc_url($settings['video_link']['url']).'" class="popup-youtube video-btn"><i class="fas fa-play"></i>'.esc_html($text).'</a>';
					}
                echo '</div>';
            echo '<!-- End Image -->';
	}

}