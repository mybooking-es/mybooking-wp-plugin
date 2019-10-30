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
    	mybooking_engine_get_template('mybooking-plugin-contact-widget.php');
    }
 
    public function form( $instance ) {
        // outputs the options form in the admin
    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }
}