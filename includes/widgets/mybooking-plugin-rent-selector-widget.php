<?php
class MyBookingRentEngineSelectorWidget extends WP_Widget {
 
    public function __construct() {
        // actual widget processes
				$widget_ops = array( 
							'classname' => 'mybooking_rent_engine_selector_widget',
							'description' => 'Mybooking Rent Engine Selector Widget',
						);
				parent::__construct( 'mybooking_rent_engine_selector_widget',
                                     'Mybooking Rent Engine Selector Widget', $widget_ops );    	
    }
 
    /**
     * Widget parameters::
     *
     * - sales_channel_code:: In order to select the sales_channel_code
     * - family_id:: In order to filter a family
     *
     */
    public function widget( $args, $instance ) {

        // outputs the content of the widget
        $data = array(
             'sales_channel_code' => $instance['sales_channel_code'],
             'family_id' => $instance['family_id']
        );

        if ( $instance['selector_type'] == 'horizontal' ) {
          mybooking_engine_get_template('mybooking-plugin-selector-widget-horizontal.php', $data);
        }
        else {
    	  mybooking_engine_get_template('mybooking-plugin-selector-widget.php', $data);
        }
    }
 
    public function form( $instance ) {
        // outputs the options form in the admin
        $sales_channel_code = ! empty( $instance['sales_channel_code'] ) ? $instance['sales_channel_code'] : esc_html__( '', 'text_domain' );
        $family_id = ! empty( $instance['family_id'] ) ? $instance['family_id'] : esc_html__( '', 'text_domain' );
        $selector_type = ! empty( $instance['selector_type'] ) ? $instance['selector_type'] : esc_html__( '', 'text_domain' );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'selector_type' ) ); ?>">
                <?php esc_attr_e( 'selector_type:', 'text_domain' ); ?>
                </label> 
                <select class='widefat' id="<?php echo $this->get_field_id('selector_type'); ?>"
                        name="<?php echo $this->get_field_name('selector_type'); ?>" type="text">
                  <option value='vertical'<?php echo ($selector_type=='vertical')?'selected':''; ?>>
                    Vertical
                  </option>
                  <option value='horizontal'<?php echo ($selector_type=='horizontal')?'selected':''; ?>>
                    Horizontal
                  </option> 
                </select>  
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
                    value="<?php echo esc_attr( $sales_channel_code ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'family_id' ) ); ?>">
                <?php esc_attr_e( 'family_id:', 'text_domain' ); ?>
                </label> 
                
                <input 
                    class="widefat" 
                    id="<?php echo esc_attr( $this->get_field_id( 'family_id' ) ); ?>" 
                    name="<?php echo esc_attr( $this->get_field_name( 'family_id' ) ); ?>" 
                    type="text" 
                    value="<?php echo esc_attr( $family_id ); ?>">
            </p>    

            <?php        
    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = array();
        $instance['sales_channel_code'] = ( ! empty( $new_instance['sales_channel_code'] ) ) ? strip_tags( $new_instance['sales_channel_code'] ) : '';
        $instance['family_id'] = ( ! empty( $new_instance['family_id'] ) ) ? strip_tags( $new_instance['family_id'] ) : '';
        $instance['selector_type'] = ( ! empty( $new_instance['selector_type'] ) ) ? strip_tags( $new_instance['selector_type'] ) : '';
        return $instance;        
    }
}