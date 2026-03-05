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
 * Gallery Widget .
 *
 */
class Appku_Gallery extends Widget_Base{

	public function get_name() {
		return 'appkuprojectgallery';
	}

	public function get_title() {
		return __( 'Appky Project Gallery', 'appku' );
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
				'label' 	=> __( 'Gallery', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
			'cat', [
				'label' 		=> __( 'Category', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
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

		//------------------------------------feature Control------------------------------------//

		$this->start_controls_section(
			'features_control',
			[
				'label'     => __( 'Gallery Control', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'colmn_items',
			[
				'label' 		=> __( 'Column View', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 2,
						'step' 		=> 1,
						'max' 		=> 4,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 4,
				],
			]
		);


        $this->end_controls_section();
		//---------------------------------------Title Style---------------------------------------//

		$this->start_controls_section(
			'title_style',
			[
				'label' 	=> __( 'Title Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
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
		$container_class = ($settings['colmn_items']['size'] == 4 ) ? 'container-full' : 'container';

			echo '<div class="gallery-area">';
		        echo '<div class="'.esc_attr($container_class).'">';
		            echo '<div class="row">';
		                echo '<div class="col-md-12 gallery-content">';
		                    echo '<div class="magnific-mix-gallery masonary">';
		                        echo '<div id="portfolio-grid" class="gallery-items colums-'.esc_attr($settings['colmn_items']['size']).'">';
		                        	foreach( $settings['slides'] as $single_data ){
		                        		$url = $single_data['details_page'] ;
		                        		if(!empty($url)){
		                        			$url_start_tag 	= '<a href="'.esc_url($url).'">';
		                        			$url_end_tag 	= '</a>';
		                        		}else{
		                        			$url_start_tag 	= '';
		                        			$url_end_tag 	= '';
		                        		}
		                        		if(!empty( $single_data['icon_image']['url'] )){
				                            echo '<!-- Single Item -->';
				                            echo '<div class="pf-item">';
				                                echo '<div class="overlay">';
				                                    echo appku_img_tag( array(
														'url'	=> esc_url( $single_data['icon_image']['url'] ),
													) );
				                                    echo '<div class="content">';
				                                        echo '<div class="title">';
				                                        	if(!empty($single_data['cat'])){
					                                            echo '<span>'.esc_html($single_data['cat']).'</span>';
					                                        }
				                                            if(!empty($single_data['title'])){
								                              	echo '<h5>'.$url_start_tag.esc_html($single_data['title']).$url_end_tag.'</h5>';
								                            }
				                                        echo '</div>';
				                                        if(!empty($url)){
					                                        echo '<a href="'.esc_url($url).'"><i class="fas fa-arrow-right"></i></a>';
					                                    }
				                                    echo '</div>';
				                                echo '</div>';
				                            echo '</div>';
				                            echo '<!-- End Single Item -->';
				                        }
			                        } 
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';	
		echo '<!-----------------------End Brand Gallery----------------------->';
	}
}