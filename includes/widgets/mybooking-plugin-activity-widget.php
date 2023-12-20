<?php
class MyBookingActivitiesEngineActivityWidget extends WP_Widget {
 
    public function __construct() {
        // actual widget processes
				$widget_ops = array( 
							'classname' => 'mybooking_activities_engine_activity_widget',
							'description' => 'Mybooking Activities Engine Activity Widget',
						);
				parent::__construct( 'mybooking_activities_engine_activity_widget',
                                     'Mybooking Activities Engine Contact Widget', $widget_ops );    	
    }
 
    public function widget( $args, $instance ) {
        // outputs the content of the widget

        $data = array(
             'activity_id' => $instance['activity_id'],
        );
          

    	mybooking_engine_get_template('mybooking-plugin-activities-activity-widget.php', $data);
    }
 
    public function form( $instance ) {
        // outputs the options form in the admin
        $activity_id = ! empty( $instance['activity_id'] ) ? $instance['activity_id'] : esc_html__( '', 'text_domain' );
            ?>
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'activity_id' ) ); ?>">
            <?php esc_attr_e( 'activity_id:', 'text_domain' ); ?>
            </label> 
            
            <input 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'activity_id' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'activity_id' ) ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $activity_id ); ?>">
            </p>
            <?php
    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = array();
        $instance['activity_id'] = ( ! empty( $new_instance['activity_id'] ) ) ? wp_strip_all_tags( $new_instance['activity_id'] ) : '';
        return $instance;
    }
}