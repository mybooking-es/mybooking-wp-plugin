<?php
class MyBookingEngineContactWidget extends WP_Widget {
 
    public function __construct() {
      // actual widget processes
			$widget_ops = array( 
						'classname' => 'mybooking_engine_contact_widget',
						'description' => 'Mybooking Engine Contact Widget',
					);
			parent::__construct( 'mybooking_engine_contact_widget',
                                   'Mybooking Engine Contact Widget', $widget_ops );    	
    }
 
    public function widget( $args, $instance ) {
        // outputs the content of the widget

        $data = array();

        // == Get widget attributes

        // Subject
        if ( array_key_exists('subject', $instance) ) {
            $data['subject'] = $instance['subject'];
        }
        else {
            $data['subject'] = '';
        }
        // Source
        if ( array_key_exists('source', $instance) ) {
            $data['source'] = $instance['source'];
        }
        else {
            $data['source'] = '';
        }
        // Sales Channel Code
        if ( array_key_exists('sales_channel_code', $instance) ) {
            $data['sales_channel_code'] = $instance['sales_channel_code'];
        }
        else {
            $data['sales_channel_code'] = '';
        }
        // Rental location Code
        if ( array_key_exists('rental_location_code', $instance) ) {
            $data['rental_location_code'] = $instance['rental_location_code'];
        }
        else {
            $data['rental_location_code'] = '';
        }

        // == Get Google API Captcha 
        $registry = Mybooking_Registry::getInstance();
        if ( $registry->mybooking_rent_plugin_contact_form_use_google_captcha && 
             !empty( $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key ) ) {
          $data['google_captcha_api_key'] = $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key;
        }

    	mybooking_engine_get_template('mybooking-plugin-contact-widget.php', $data);
    }
 
    public function form( $instance ) {
        // outputs the options form in the admin
        $subject = ! empty( $instance['subject'] ) ? $instance['subject'] : esc_html__( '', 'text_domain' );
        $source = ! empty( $instance['source'] ) ? $instance['source'] : esc_html__( '', 'text_domain' );
        $rental_location_code = ! empty( $instance['rental_location_code'] ) ? $instance['rental_location_code'] : esc_html__( '', 'text_domain' );
        $sales_channel_code = ! empty( $instance['sales_channel_code'] ) ? $instance['sales_channel_code'] : esc_html__( '', 'text_domain' );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'subject' ) ); ?>">
                <?php esc_attr_e( 'subject:', 'text_domain' ); ?>
                </label> 
                
                <input 
                    class="widefat" 
                    id="<?php echo esc_attr( $this->get_field_id( 'subject' ) ); ?>" 
                    name="<?php echo esc_attr( $this->get_field_name( 'subject' ) ); ?>" 
                    type="text" 
                    value="<?php echo esc_attr( $subject ); ?>"
                    maxlength="255">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'source' ) ); ?>">
                <?php esc_attr_e( 'source:', 'text_domain' ); ?>
                </label> 
                
                <input 
                    class="widefat" 
                    id="<?php echo esc_attr( $this->get_field_id( 'source' ) ); ?>" 
                    name="<?php echo esc_attr( $this->get_field_name( 'source' ) ); ?>" 
                    type="text" 
                    value="<?php echo esc_attr( $source ); ?>"
                    maxlength="50">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'rental_location_code' ) ); ?>">
                <?php esc_attr_e( 'rental_location_code:', 'text_domain' ); ?>
                </label> 
                
                <input 
                    class="widefat" 
                    id="<?php echo esc_attr( $this->get_field_id( 'rental_location_code' ) ); ?>" 
                    name="<?php echo esc_attr( $this->get_field_name( 'rental_location_code' ) ); ?>" 
                    type="text" 
                    value="<?php echo esc_attr( $rental_location_code ); ?>"
                    maxlength="50">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'sales_channel_code' ) ); ?>">
                <?php esc_attr_e( 'sales_channel_code:', 'text_domain' ); ?>
                </label> 
                
                <input 
                    class="widefat" 
                    id="<?php echo esc_attr( $this->get_field_id( 'sales_channel_code' ) ); ?>" 
                    name="<?php echo esc_attr( $this->get_field_name( 'sales_channel_code' ) ); ?>" 
                    type="text" 
                    value="<?php echo esc_attr( $sales_channel_code ); ?>"
                    maxlength="50">
            </p>

            <?php  

    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = array();
        $instance['subject'] = ( ! empty( $new_instance['subject'] ) ) ? wp_strip_all_tags( $new_instance['subject'] ) : '';
        $instance['source'] = ( ! empty( $new_instance['source'] ) ) ? wp_strip_all_tags( $new_instance['source'] ) : '';
        $instance['sales_channel_code'] = ( ! empty( $new_instance['sales_channel_code'] ) ) ? wp_strip_all_tags( $new_instance['sales_channel_code'] ) : '';
        $instance['rental_location_code'] = ( ! empty( $new_instance['rental_location_code'] ) ) ? wp_strip_all_tags( $new_instance['rental_location_code'] ) : '';
        return $instance;          
    }
}