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
	function ebor_framework_register_pivot_instagram(){
	     register_widget( 'Pivot_Instagram_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_pivot_instagram');
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
			
			$defaults = array(
				'username' => '', 
				'user_name' => '',
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
			
			echo $args['before_widget'];
			
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			
			if ( isset( $instance['username'] ) || isset( $instance['user_name'] ) )
				echo '<div id="tweets" data-widget-id="'. $instance['username'] .'" data-user-name="'. $instance['user_name'] .'"></div>';
			
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
				'username' => '', 
				'user_name' => '',
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'ebor_framework' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'user_name' ); ?>">Twitter Username <code>e.g: tommusrhodus</code>
				<p class="description">Do not use @, plain text username only!</p></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'user_name' ); ?>" name="<?php echo $this->get_field_name( 'user_name' ); ?>" type="text" value="<?php echo esc_attr( $user_name ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>">Twitter Widget ID <code>e.g: 492085717044981760</code>
				<p class="description">
				<strong>Note!</strong> DEPRECATED: Will continue to work for existing users, new users please use the username field above.</p></label> 
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
	function ebor_framework_register_pivot_twitter(){
	     register_widget( 'Pivot_Twitter_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_pivot_twitter');
}
/*-----------------------------------------------------------------------------------*/
/*	social WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('Pivot_social_Widget') )){
	class Pivot_social_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'pivot-social-widget', // Base ID
				__('Pivot: Social Widget', 'ebor_framework'), // Name
				array( 'description' => __( 'Add a simple social feed widget', 'ebor_framework' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype'); 
			
			echo $args['before_widget'];
			
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			
			echo '<ul class="social-icons">';
				for( $i = 1; $i < 7; $i++ ){
					if( get_option("footer_social_url_$i") ) {
						echo '<li>
							      <a href="' . esc_url(get_option("footer_social_url_$i"), $protocols) . '" target="_blank">
								      <i class="icon ' . get_option("footer_social_icon_$i") . '"></i>
							      </a>
							  </li>';
					}
				} 
			echo '</ul>';
			
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			
			$defaults = array(
				'title' => 'Social Icons'
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>This widget uses the footer social icons settings set in "appearance" -> "customise" -> "footer settings"</p>
			
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
	function ebor_framework_register_pivot_social(){
	     register_widget( 'Pivot_social_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_pivot_social');
}