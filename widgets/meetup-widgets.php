<?php 
if(!( class_exists('ebor_meetup_popular_Widget') )){
	class ebor_meetup_popular_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_meetup_popular-widget', // Base ID
				__('Meetup: Recent Posts', 'ebor_framework'), // Name
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
	
		    	<ul>
			    	<?php 
			    		query_posts('post_type=post&posts_per_page=' . $instance['amount']); 
			    		if( have_posts() ) : while ( have_posts() ): the_post(); 
			    	?>
			    	
				    	 <li>
				    	 	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				    	 	<span class="sub"><?php the_time(get_option('date_format')); ?></span>
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
	function ebor_framework_register_ebor_meetup_popular(){
	     register_widget( 'ebor_meetup_popular_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_meetup_popular');
}
/*-----------------------------------------------------------------------------------*/
/*	social WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('meetup_social_Widget') )){
	class meetup_social_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'meetup-social-widget', // Base ID
				__('Meetup: Social Widget', 'ebor_framework'), // Name
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
			
			echo '<ul class="social-profiles">';
				for( $i = 1; $i < 11; $i++ ){
					if( get_option("header_social_url_$i") ) {
						echo '<li>
							      <a href="' . esc_url(get_option("header_social_url_$i"), $protocols) . '" target="_blank">
								      <i class="icon ' . get_option("header_social_icon_$i") . '"></i>
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
			
			<p>This widget uses the settings set in <code>"appearance" -> "customise" -> "social widget settings"</code></p>
			
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
	function ebor_framework_register_meetup_social(){
	     register_widget( 'meetup_social_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_meetup_social');
}