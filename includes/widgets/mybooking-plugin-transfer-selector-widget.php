<?php
class MyBookingTransferEngineSelectorWidget extends WP_Widget {
 
    public function __construct() {
        // actual widget processes
				$widget_ops = array( 
							'classname' => 'mybooking_transfer_engine_selector_widget',
							'description' => 'Mybooking Transfer Engine Selector Widget',
						);
				parent::__construct( 'mybooking_transfer_engine_selector_widget',
                             'Mybooking Transfer Engine Selector Widget', $widget_ops );    	
    }
 
    /**
     * Widget parameters::
     *
     * - sales_channel_code:: In order to select the sales_channel_code
     * - family_id:: In order to filter a family
     *
     */
    public function widget( $args, $instance ) {

        $data = array();

        if ( array_key_exists('layout', $instance) ) {
            $data['layout'] = $instance['layout'];
        }
        else {
            $data['layout'] = '';
        }

        mybooking_engine_get_template('mybooking-plugin-transfer-selector-widget.php', $data); 

    }

    public function form( $instance ) {
        // outputs the options form in the admin
        $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( '', 'text_domain' );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>">
                <?php esc_attr_e( 'layout:', 'text_domain' ); ?>
                </label> 
                
                <select class="widefat"
                        id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"
                        name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                    <option value="horizontal" <?php if ( $layout != 'vertical' ) :?>selected<?php endif; ?>><?php esc_attr_e( 'horizontal', 'text_domain' ); ?></option>   
                    <option value="vertical" <?php if ( $layout == 'vertical' ) :?>selected<?php endif; ?>><?php esc_attr_e( 'vertical', 'text_domain' ); ?></option>
                </select>        
            </p>            
            <?php        
    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = array();
        $instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? wp_strip_all_tags( $new_instance['layout'] ) : '';
        return $instance;        
    }

 
}