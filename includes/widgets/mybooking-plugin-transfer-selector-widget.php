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

        mybooking_engine_get_template('mybooking-plugin-transfer-selector-widget.php'); 

    }
 
}