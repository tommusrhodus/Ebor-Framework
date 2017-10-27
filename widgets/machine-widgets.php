<?php 
/*-----------------------------------------------------------------------------------*/
/*	INSTAGRAM WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('machine_Instagram_Widget') )){
	class machine_Instagram_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'machine-instagram-widget', // Base ID
				__('Machine : Instagram Widget', 'ebor_framework'), // Name
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
	function ebor_framework_register_machine_instagram(){
	     register_widget( 'machine_Instagram_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_machine_instagram');
}
/*-----------------------------------------------------------------------------------*/
/*	TWITTER WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('machine_Twitter_Widget') )){
	class machine_Twitter_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'machine-twitter-widget', // Base ID
				__('Machine : Twitter Widget', 'ebor_framework'), // Name
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
				echo '<div class="twitter-feed"><div class="tweets-feed" data-widget-id="'. $instance['username'] .'" data-user-name="'. $instance['user_name'] .'"></div></div>';
			
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
	function ebor_framework_register_machine_twitter(){
	     register_widget( 'machine_Twitter_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_machine_twitter');
}

if(!( class_exists('ebor_machine_popular_Widget') )){
	class ebor_machine_popular_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_machine_popular-widget', // Base ID
				__('Machine: Recent Posts', 'ebor_framework'), // Name
				array( 'description' => __( 'Add a simple popular posts widget', 'ebor_framework' ), ) // Args
			);
		}
		
		public function widget($args, $instance)
		{
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
	
			echo $before_widget;
	
			if($title) {
				echo  $before_title.$title.$after_title;
			} ?>
	
		    	<ul class="link-list">
			    	<?php 
			    		query_posts('post_type=post&posts_per_page=' . $instance['amount']); 
			    		if( have_posts() ) : while ( have_posts() ): the_post(); 
			    	?>
			    			
			    			<li>
			    				<?php the_title('<a href="'. get_permalink() .'">', '</a>'); ?>
			    				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
			    			</li>
			    	              
			    	<?php 
			    		endwhile; 
			    		endif; 
			    		wp_reset_query(); 
			    	?>
		    	</ul>
			
			<?php echo $after_widget;
		}
		
		public function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
	
			$instance['title'] = strip_tags($new_instance['title']);
			if( is_numeric($new_instance['amount']) ){
				$instance['amount'] = $new_instance['amount'];
			} else {
				$new_instance['amount'] = '3';
			}
	
			return $instance;
		}
	
		public function form($instance)
		{
			$defaults = array('title' => 'Popular Posts', 'amount' => '3');
			$instance = wp_parse_args((array) $instance, $defaults); ?>
			
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
				<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('amount'); ?>">Amount of Posts:</label>
				<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" value="<?php echo $instance['amount']; ?>" />
			</p>
		<?php
		}
	}
	function ebor_framework_register_ebor_machine_popular(){
	     register_widget( 'ebor_machine_popular_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_machine_popular');
}