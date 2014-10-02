<?php 
/*-----------------------------------------------------------------------------------*/
/*	INSTAGRAM WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('Pivot_Instagram_Widget') )){
	class Pivot_Instagram_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'pivot-instagram-widget', // Base ID
				__('Pivot: Instagram Widget', 'ebor_framework'), // Name
				array( 'description' => __( 'Add a simple Instagram feed widget', 'ebor_framework' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			
			if ( isset( $instance['username'] ) )
				echo '<div class="instafeed" data-user-name="'. $instance['username'] .'"><ul></ul></div>';
			
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			
			$defaults = array(
				'title' => 'Instagram Feed', 
				'username' => ''
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
			</p>
			
		<?php 
		}
	
		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			return $new_instance;
		}
	}
	add_action( 'widgets_init', function(){
	     register_widget( 'Pivot_Instagram_Widget' );
	});
}
/*-----------------------------------------------------------------------------------*/
/*	TWITTER WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('Pivot_Twitter_Widget') )){
	class Pivot_Twitter_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'pivot-twitter-widget', // Base ID
				__('Pivot: Twitter Widget', 'ebor_framework'), // Name
				array( 'description' => __( 'Add a simple Twitter feed widget', 'ebor_framework' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			
			if ( isset( $instance['username'] ) )
				echo '<div id="tweets" data-widget-id="'. $instance['username'] .'"></div>';
			
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			
			$defaults = array(
				'title' => 'Twitter Feed', 
				'username' => ''
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Widget ID:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
			</p>
			
		<?php 
		}
	
		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			return $new_instance;
		}
	}
	add_action( 'widgets_init', function(){
	     register_widget( 'Pivot_Twitter_Widget' );
	});
}