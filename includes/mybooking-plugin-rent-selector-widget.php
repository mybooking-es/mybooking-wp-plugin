<?php
class MyBookingRentEngineSelectorWidget extends WP_Widget {
 
    public function __construct() {
        // actual widget processes
				$widget_ops = array( 
							'classname' => 'mybooking_rent_engine_selector_widget',
							'description' => 'Mybooking Rent Engine Selector Widget',
						);
				parent::__construct( 'mybooking_rent_engine_selector_widget', 'Mybooking Rent Engine Selector Widget', $widget_ops );    	
    }
 
    public function widget( $args, $instance ) {
        // outputs the content of the widget
    	mybooking_engine_get_template('mybooking-plugin-selector-form.php');
    }
 
    public function form( $instance ) {
        // outputs the options form in the admin
    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }
}