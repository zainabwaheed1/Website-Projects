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
class Appku_Image extends Widget_Base {

	public function get_name() {
		return 'appkuimage';
	}

	public function get_title() {
		return __( 'Image', 'appku' );
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
				'label' 	=> __( 'Image', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' 		=> 'large',
				'separator' 	=> 'none',
			]
		);

        $this->add_responsive_control(
			'image_align',
			[
				'label' 		=> __( 'Alignment', 'appku' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'appku' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'appku' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'appku' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' => [
					'{{WRAPPER}} .appku_img' => 'text-align: {{VALUE}};',
				],
			]
        );

        $this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'appku' ),
				'type' 			=> Controls_Manager::URL,
                'placeholder' 	=> __( 'https://your-link.com', 'appku' ),
                'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
        );

		$this->add_control(
			'image_wrapper_class',
			[
				'label'     => __( 'Image Wrapper Class', 'appku' ),
                'type'      => Controls_Manager::TEXT,
			]
        );
		$this->add_control(
			'image_class',
			[
				'label'     => __( 'Image Class', 'appku' ),
                'type'      => Controls_Manager::TEXT,
			]
        );
        $this->end_controls_section();


        $this->start_controls_section(
			'image_style_section',
			[
				'label' 	=> __( 'Image Style', 'appku' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_responsive_control(
			'width',
			[
				'label' 	=> __( 'Width', 'appku' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'unit' 		=> '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .appku_img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' 	=> __( 'Max Width', 'appku' ) . ' (%)',
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'unit' 		=> '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .appku_img img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' 	=> Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'image_border',
				'selector' 	=> '{{WRAPPER}} .appku_img img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .appku_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'image_box_shadow',
				'exclude' 	=> [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .appku_img img',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper','class','appku_img');

        $this->add_render_attribute('wrapper','class',esc_attr( $settings['image_wrapper_class'] ));

        if( !empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute('link','href',esc_url( $settings['link']['url'] ));
        }

        if( !empty( $settings['link']['nofollow'] ) ) {
            $this->add_render_attribute('link','rel', 'nofollow' );
        }

        if( !empty( $settings['link']['is_external'] ) ) {
            $this->add_render_attribute('link','target','_blank');
        }

        if( !empty( $settings['image']['id'] ) ) {
            echo '<!-- Advertisement Image -->';
                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
					if( ! empty( $settings['link']['url'] ) ){
	                    echo '<a '.$this->get_render_attribute_string('link').'>';
					}

						echo '<img class="'.esc_attr( $settings['image_class'] ).'" src="'.esc_url( Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'],'image',$settings) ).'" alt="'.esc_attr( appku_image_alt( Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'],'image',$settings) ) ).'" >';

					if( ! empty( $settings['link']['url'] ) ){
	                   echo '</a>';
					}

                echo '</div>';
            echo '<!-- End Advertisement Image -->';
        }
	}

}