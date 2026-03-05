<?php
/**
* @version  1.0
* @package  appku
*
* Websites: https://themeforest.net/user/validthemes/portfolio
*
*/

/**************************************
* Creating About Us Widget
***************************************/

class appku_aboutus_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'appku_aboutus_widget',

                // Widget name will appear in UI
                esc_html__( 'Appku :: About Us Widget', 'appku' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add About Us Widget', 'appku' ),
                    'classname'		                => 'no-class',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {

			$about_us 	= apply_filters( 'widget_about_us', $instance['about_us'] );
            if ( isset( $instance[ 'aboutus_img_url' ] ) ) {
                $aboutus_img_url = $instance[ 'aboutus_img_url' ];
            }else {
                $aboutus_img_url = '#';
            }

            //before and after widget arguments are defined by themes
            echo $args['before_widget'];
                echo '<div class="f-item about">';
                    if ( isset( $instance[ 'aboutus_img_url' ] ) ) {
                        $aboutus_img_url = $instance[ 'aboutus_img_url' ];
                        echo appku_img_tag( array(
                            'url'   => esc_url( $aboutus_img_url ),
                        ) );
                    }
                    if( !empty( $about_us ) ){
                        echo '<p>'.wp_kses_post( $about_us ).'</p>';
                    }
                    echo '<form class="newsletter-form">';
                        echo '<input type="email" placeholder="'.esc_attr('Your Email','appku').'" class="form-control" name="email">';
                        echo '<button type="submit"> <i class="arrow_right"></i></button>';
                    echo '</form>';
                echo '</div>';
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

            //Image Url
            if ( isset( $instance[ 'aboutus_img_url' ] ) ) {
                $aboutus_img_url = $instance[ 'aboutus_img_url' ];
            }else {
                $aboutus_img_url = '';
            }
			
			if ( isset( $instance[ 'about_us' ] ) ) {
				$about_us = $instance[ 'about_us' ];
			}else {
				$about_us = '';
			}
			
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'aboutus_img_url' ); ?>"><?php _e( 'Image URL:' ,'appku'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'aboutus_img_url' ); ?>" name="<?php echo $this->get_field_name( 'aboutus_img_url' ); ?>" type="text" value="<?php echo esc_attr( $aboutus_img_url ); ?>" />
            </p>
			<p>
				<label for="<?php echo $this->get_field_id( 'about_us' ); ?>">
					<?php
						_e( 'About Us:' ,'dvpn');
					?>
				</label>
		        <textarea class="widefat" id="<?php echo $this->get_field_id( 'about_us' ); ?>" name="<?php echo $this->get_field_name( 'about_us' ); ?>" rows="8" cols="80"><?php echo esc_html( $about_us ); ?></textarea>
			</p>
            <?php
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['aboutus_img_url'] 	= ( ! empty( $new_instance['aboutus_img_url'] ) ) ? strip_tags( $new_instance['aboutus_img_url'] ) : '';
            $instance['about_us'] 			= ( ! empty( $new_instance['about_us'] ) ) ? strip_tags( $new_instance['about_us'] ) : '';
			return $instance;
        }
    } // Class appku_aboutus_widget ends here


    // Register and load the widget
    function appku_aboutus_load_widget() {
        register_widget( 'appku_aboutus_widget' );
    }
    add_action( 'widgets_init', 'appku_aboutus_load_widget' );