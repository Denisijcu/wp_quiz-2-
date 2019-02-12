<?php
/**
 * @package User_Greeting
 * @version 0.0.1
 */
/*
Plugin Name: User Greeting
Plugin URI:  None
Description: This widget is to pass the quiz-2 of WP-Avanzed course
Author: Denis Sanchez Leyva
Professor: Randy
Version: 0.0.1
Author URI: http://dleyva@techlaunch.io/
*/



/* Register User_greeting_widget */

add_action('widgets_init', function(){
    register_widget('Greeting_User_Widget');
    });


//add_action( 'admin_head', 'Greeting_User_Widget' );

/**
 * Adds Greeting_User_Widget widget.
 */
class Greeting_User_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'greeting_user_widget', // Base ID
			esc_html__( 'Be Nice with the User', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Welcome', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $current_user = wp_get_current_user();
     //   echo esc_html__( "How's it going " .ucfirst($current_user->user_nicename) . '.  Welcome to my webiste', 'text_domain' );
        echo '<h1 style="color: blue; font-size: 48px;">'.ucfirst($current_user->user_nicename) .'</h1><h2>Glad to you see here. </h2>';
        
     
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Be Nice with the User', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Be Nice with the User:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">$_GET
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget








