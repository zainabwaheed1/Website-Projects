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
 * App Features Widget .
 *
 */
class Appku_App_Feature extends Widget_Base {

	public function get_name() {
		return 'appkuappfeature';
	}

	public function get_title() {
		return __( 'Appku App Features', 'appku' );
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
				'label'     => __( 'App Features', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'feature_1',
            [
				'label'         => __( 'Features', 'appku' ),
				'type'          => Controls_Manager::WYSIWYG,
				'default'       => __( 'Title' , 'appku' ),
				'label_block'   => true,
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
		$this->add_control(
			'feature_2',
            [
				'label'         => __( 'Features', 'appku' ),
				'type'          => Controls_Manager::WYSIWYG,
				'default'       => __( 'Title' , 'appku' ),
				'label_block'   => true,
			]
		);
        $this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();


        echo '<!-----------------------Start App Features Area----------------------->';


        echo '<div class="app-features-area default-padding">';
	        echo '<div class="container">';
	            echo '<div class="row align-center">';
	                echo '<div class="col-lg-3 text-end app-feature-style-one">';
	                 
		                if(!empty($settings['feature_1'])){  
		                	echo wp_kses_post($settings['feature_1'] );
		                } 

	                echo '</div>';
	                if(!empty($settings['thumb_image']['url'])){
		                echo '<div class="col-lg-6 text-center app-feature-style-one">';
		                    echo '<div class="app-feature-item">';
		                        echo '<div class="app-feature-thumb">';
		                            echo appku_img_tag( array(
										'url'	=> esc_url( $settings['thumb_image']['url'] ),
									) );
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            }
	                echo '<div class="col-lg-3 app-feature-style-one">';
	                    if(!empty($settings['feature_2'])){  
		                	echo wp_kses_post($settings['feature_2'] );
		                } 
	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
	    echo '</div>';
		echo '<!-----------------------Start App Features Area----------------------->';

	}

}