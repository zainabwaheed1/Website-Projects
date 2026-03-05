<?php
/**
* @version  1.0
* @package  appku
*
* Websites: https://themeforest.net/user/validthemes/portfolio
*
*/

/**************************************
* Creating CTA Widget
***************************************/

class appku_cta_widget extends WP_Widget {

        function __construct() {
        
            parent::__construct(
                // Base ID of your widget
                'appku_cta_widget', 
            
                // Widget name will appear in UI
                esc_html__( 'Appku :: CTA', 'appku' ),
            
                // Widget description
                array( 
                    'customize_selective_refresh' 	=> true,  
                    'description' 					=> esc_html__( 'Add Download Button Widget', 'appku' ),   
                    'classname'   					=> 'quick-contact text-light',
                )
            );

        }
    
        // This is where the action happens
        public function widget( $args, $instance ) {
            
            $title  	= ( !empty( $instance['title'] ) ) ? $instance['title'] : "";  
            $subtitle  	= ( !empty( $instance['subtitle'] ) ) ? $instance['subtitle'] : "";  
            $phone  	= ( !empty( $instance['phone'] ) ) ? $instance['phone'] : "";  
            $thumb  	= ( !empty( $instance['thumb'] ) ) ? $instance['thumb'] : "";   
            
            //before and after widget arguments are defined by themes
            echo $args['before_widget']; 
            
                echo '<div class="content" style="background-image: url('.esc_url( $thumb ).');">';
                    echo '<i class="fas fa-phone"></i>';
                    if( !empty( $title ) ){
	                    echo '<h4>'.esc_html( $title ).'</h4>';
	                }
	                if( !empty( $subtitle ) ){
	                    echo '<p>'.esc_html( $subtitle ).'</p>';
	                }
	                if( !empty( $phone ) ){
	                    echo '<h2>'.esc_html( $phone ).'</h2>';
	                }
                echo '</div>';
            echo $args['after_widget'];
            echo '<!-- End of Author Widget -->';
        }
            
        // Widget Backend 
        public function form( $instance ) {
    
            //Title	
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }
            //subtitle	
            if ( isset( $instance[ 'subtitle' ] ) ) {
                $subtitle = $instance[ 'subtitle' ];
            }else {
                $subtitle = '';
            }
            //phone	
            if ( isset( $instance[ 'phone' ] ) ) {
                $phone = $instance[ 'phone' ];
            }else {
                $phone = '';
            }
            if ( isset( $instance[ 'thumb' ] ) ) {
                $thumb = $instance[ 'thumb' ];
            }else {
                $thumb = __( '#','appku' );
            }
			
            
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'appku'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ,'appku'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:' ,'appku'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Thumbnail Url:' ,'appku'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" type="text" value="<?php echo esc_attr( $thumb ); ?>" />
            </p>
			
            <?php 
        }
    
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            
            $instance = array();
            $instance['title'] 	        		= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';      
            $instance['subtitle'] 	        	= ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';      
            $instance['phone'] 	        		= ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';      
            $instance['thumb'] 	        		= ( ! empty( $new_instance['thumb'] ) ) ? strip_tags( $new_instance['thumb'] ) : '';      
            return $instance;
        }
    } // Class appku_cta_widget ends here
    

    // Register and load the widget
    function appku_cta_widget() {
        register_widget( 'appku_cta_widget' );
    }
    add_action( 'widgets_init', 'appku_cta_widget' );