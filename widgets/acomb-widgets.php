<?php 

/*-----------------------------------------------------------------------------------*/
/*	INSTAGRAM WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('ebor_Instagram_Widget') )){
	class ebor_Instagram_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'ebor-instagram-widget', // Base ID
				__('Acomb: Instagram Widget', 'acomb'), // Name
				array( 'description' => esc_html__( 'Add a simple Instagram feed widget', 'acomb' ), ) // Args
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
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'acomb' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php esc_html_e( 'Username:', 'acomb' ); ?></label> 
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
	function ebor_framework_register_ebor_instagram(){
	     register_widget( 'ebor_Instagram_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_instagram');
}
/*-----------------------------------------------------------------------------------*/
/*	TWITTER WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('ebor_Twitter_Widget') )){
	class ebor_Twitter_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'ebor-twitter-widget', // Base ID
				__('Acomb: Twitter Widget', 'acomb'), // Name
				array( 'description' => esc_html__( 'Add a simple Twitter feed widget', 'acomb' ), ) // Args
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
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'acomb' ); ?></label> 
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
	function ebor_framework_register_ebor_twitter(){
	     register_widget( 'ebor_Twitter_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_twitter');
}

if(!( class_exists('ebor_ebor_popular_Widget') )){
	class ebor_ebor_popular_Widget extends WP_Widget {
		
		function __construct(){
			parent::__construct(
				'ebor_ebor_popular-widget', // Base ID
				__('Acomb: Popular Posts', 'acomb'), // Name
				array( 'description' => esc_html__( 'Add a simple popular posts widget', 'acomb' ), ) // Args
			);
		}
		
		function widget($args, $instance)
		{
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
	
			echo $before_widget;
	
			if($title) {
				echo  $before_title.$title.$after_title;
			} ?>

		    	<ul class="link-list recent-posts">
			    	<?php 
			    		$widget_query = new WP_Query(
			    			array(
			    				'post_type' => 'post',
			    				'posts_per_page' => $instance['amount']
			    			)
			    		);
			    		if( $widget_query->have_posts() ) : while ( $widget_query->have_posts() ): $widget_query->the_post(); 
			    	?>
			    			
			    			<li class="clearfix">
			    				<?php the_post_thumbnail('thumbnail'); ?>
			    				<div class="content">
			    					<?php the_title('<h5><a href="'. get_permalink() .'">', '</a></h5>'); ?>
			    					<span class="date"><?php the_time(get_option('date_format')); ?></span>
			    				</div>
			    			</li>
			    	              
			    	<?php 
			    		endwhile; 
			    		endif; 
			    		wp_reset_postdata(); 
			    	?>
		    	</ul>
			
			<?php echo $after_widget;
		}
		
		function update($new_instance, $old_instance)
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
	
		function form($instance)
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
	function ebor_framework_register_ebor_ebor_popular(){
	     register_widget( 'ebor_ebor_popular_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_ebor_popular');
}