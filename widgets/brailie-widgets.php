<?php 

if(!( class_exists('ebor_malefic_popular_Widget') )){
	class ebor_malefic_popular_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_malefic_popular-widget', // Base ID
				esc_html__('TommusRhodus: Popular Posts', 'creatink'), // Name
				array( 'description' => esc_html__( 'Add a simple popular posts widget', 'creatink' ), ) // Args
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
	
		    	<ul class="image-list">
			    	<?php 
			    		$widget_query = new WP_Query(
			    			array(
			    				'post_type' => 'post',
			    				'orderby' => 'comment_count',
			    				'order' => 'DESC',
			    				'posts_per_page' => $instance['amount']
			    			)
			    		);
			    		if( $widget_query->have_posts() ) : while ( $widget_query->have_posts() ): $widget_query->the_post(); 
			    	?>
			    	  
			    		<li>
			    		  <figure class="overlay icon-overlay small"> 
			    		  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a> 
			    		  </figure>
			    		  <div class="post-content">
			    		  	<h6 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			    		    <div class="meta"><span class="date"><?php the_time( get_option('date_format') ); ?> </span> </div>			    		    
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
	function ebor_framework_register_ebor_malefic_popular(){
	     register_widget( 'ebor_malefic_popular_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_malefic_popular');
}

if(!( class_exists('ebor_malefic_recent_Widget') )){
	class ebor_malefic_recent_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_malefic_recent-widget', // Base ID
				esc_html__('TommusRhodus: Recent Posts', 'creatink'), // Name
				array( 'description' => esc_html__( 'Add a simple recent posts widget', 'creatink' ), ) // Args
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
	
		    	<ul class="image-list">
			    	<?php 
			    		$widget_query = new WP_Query(
			    			array(
			    				'post_type' => 'post',
			    				'orderby' => 'post_date',
			    				'order' => 'DESC',
			    				'posts_per_page' => $instance['amount']
			    			)
			    		);
			    		if( $widget_query->have_posts() ) : while ( $widget_query->have_posts() ): $widget_query->the_post(); 
			    	?>
			    	  
			    		<li>
			    		  <figure class="overlay icon-overlay small"> 
			    		  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a> 
			    		  </figure>
			    		  <div class="post-content">
			    		  	<h6 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			    		    <div class="meta"><span class="date"><?php the_time( get_option('date_format') ); ?> </span> </div>			    		    
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
			$defaults = array('title' => 'Recent Posts', 'amount' => '3');
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
	function ebor_framework_register_ebor_malefic_recent(){
	     register_widget( 'ebor_malefic_recent_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_malefic_recent');
}

/*-----------------------------------------------------------------------------------*/
/*	CONTACT WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('ebor_contact_Widget') )){
	class ebor_contact_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_contact-widget', // Base ID
				esc_html__('TommusRhodus: Social Icons', 'creatink'), // Name
				array( 'description' => esc_html__( 'Add a simple social icons widget', 'creatink' ), ) // Args
			);
		}
		
		public function widget($args, $instance)
		{
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			$subtitle = $instance['subtitle'];
			
			$icons = array(
				$instance['social_icon_1'],
				$instance['social_icon_2'],
				$instance['social_icon_3'],
				$instance['social_icon_4'],
				$instance['social_icon_5'],
				$instance['social_icon_6'],
				$instance['social_icon_7'],
			);
			
			$links = array(
				$instance['social_icon_link_1'],
				$instance['social_icon_link_2'],
				$instance['social_icon_link_3'],
				$instance['social_icon_link_4'],
				$instance['social_icon_link_5'],
				$instance['social_icon_link_6'],
				$instance['social_icon_link_7'],
			);
			
			$links = array_filter(array_map(NULL, $links)); 
	
			echo $before_widget;
			
			if($title)
				echo  $before_title.$title.$after_title;
			
			if($subtitle)
				echo wpautop(htmlspecialchars_decode($subtitle));
		?>
	    	<ul class="social social-bg social-s">
	    		<?php
	    			foreach( $links as $index => $link ){
	    				echo '<li><a href="'. $link .'" target="_blank"><i class="et-'. $icons[$index] .'"></i></a></li>';
	    			}
	    		?>
	
	    	</ul>
			
		<?php 
			echo $after_widget;
		}
		
		public function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
	
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['subtitle'] = esc_textarea($new_instance['subtitle']);
			$instance['social_icon_1'] = strip_tags($new_instance['social_icon_1']);
			$instance['social_icon_2'] = strip_tags($new_instance['social_icon_2']);
			$instance['social_icon_3'] = strip_tags($new_instance['social_icon_3']);
			$instance['social_icon_4'] = strip_tags($new_instance['social_icon_4']);
			$instance['social_icon_5'] = strip_tags($new_instance['social_icon_5']);
			$instance['social_icon_6'] = strip_tags($new_instance['social_icon_6']);
			$instance['social_icon_7'] = strip_tags($new_instance['social_icon_7']);
			$instance['social_icon_link_1'] = esc_url($new_instance['social_icon_link_1']);
			$instance['social_icon_link_2'] = esc_url($new_instance['social_icon_link_2']);
			$instance['social_icon_link_3'] = esc_url($new_instance['social_icon_link_3']);
			$instance['social_icon_link_4'] = esc_url($new_instance['social_icon_link_4']);
			$instance['social_icon_link_5'] = esc_url($new_instance['social_icon_link_5']);
			$instance['social_icon_link_6'] = esc_url($new_instance['social_icon_link_6']);
			$instance['social_icon_link_7'] = esc_url($new_instance['social_icon_link_7']);
	
			return $instance;
		}
	
		public function form($instance)
		{
			$defaults = array(
				'title' => '', 
				'subtitle' => '',
				'social_icon_1' => 'none',
				'social_icon_2' => 'none',
				'social_icon_3' => 'none',
				'social_icon_4' => 'none',
				'social_icon_5' => 'none',
				'social_icon_6' => 'none',
				'social_icon_7' => 'none',
				'social_icon_link_1' => '',
				'social_icon_link_2' => '',
				'social_icon_link_3' => '',
				'social_icon_link_4' => '',
				'social_icon_link_5' => '',
				'social_icon_link_6' => '',
				'social_icon_link_7' => '',
			);
			
			$social_options = array(
				array('name' => 'None', 'value' => 'none'),
				array('name' => 'Pinterest', 'value' => 'pinterest'),
				array('name' => 'RSS', 'value' => 'rss'),
				array('name' => 'Facebook', 'value' => 'facebook'),
				array('name' => 'Twitter', 'value' => 'twitter'),
				array('name' => 'Flickr', 'value' => 'flickr'),
				array('name' => 'Dribbble', 'value' => 'dribbble'),
				array('name' => 'Behance', 'value' => 'behance'),
				array('name' => 'linkedIn', 'value' => 'linkedin'),
				array('name' => 'Vimeo', 'value' => 'vimeo'),
				array('name' => 'Youtube', 'value' => 'youtube'),
				array('name' => 'Skype', 'value' => 'skype'),
				array('name' => 'Tumblr', 'value' => 'tumblr'),
				array('name' => 'Delicious', 'value' => 'delicious'),
				array('name' => '500px', 'value' => '500px'),
				array('name' => 'Grooveshark', 'value' => 'grooveshark'),
				array('name' => 'Forrst', 'value' => 'forrst'),
				array('name' => 'Digg', 'value' => 'digg'),
				array('name' => 'Blogger', 'value' => 'blogger'),
				array('name' => 'Klout', 'value' => 'klout'),
				array('name' => 'Dropbox', 'value' => 'dropbox'),
				array('name' => 'Github', 'value' => 'github'),
				array('name' => 'Songkick', 'value' => 'singkick'),
				array('name' => 'Posterous', 'value' => 'posterous'),
				array('name' => 'Appnet', 'value' => 'appnet'),
				array('name' => 'Google Plus', 'value' => 'gplus'),
				array('name' => 'Stumbleupon', 'value' => 'stumbleupon'),
				array('name' => 'LastFM', 'value' => 'lastfm'),
				array('name' => 'Spotify', 'value' => 'spotify'),
				array('name' => 'Instagram', 'value' => 'instagram'),
				array('name' => 'Evernote', 'value' => 'evernote'),
				array('name' => 'Paypal', 'value' => 'paypal'),
				array('name' => 'Picasa', 'value' => 'picasa'),
				array('name' => 'Soundcloud', 'value' => 'soundcloud')
			);
			
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
			
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
				<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>">Subtitle:</label>
				<textarea class="widefat" style="width: 100%; height: 100px;" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>"><?php echo $instance['subtitle']; ?></textarea>
			</p>
			
			<?php
				$i = 1;
				while( $i < 8 ) :
			?>
				<p>
					<label for="<?php echo $this->get_field_id('social_icon_' . $i); ?>">Social Icon <?php echo $i; ?>:</label>
					<select name="<?php echo $this->get_field_name('social_icon_' . $i); ?>" id="<?php echo $this->get_field_id('social_icon_' . $i); ?>" class="widefat">
						<?php
							foreach ($social_options as $option) {
								echo '<option value="' . $option['value'] . '" id="' . $option['value'] . '"', $instance['social_icon_' . $i] == $option['value'] ? ' selected="selected"' : '', '>', $option['name'], '</option>';
							}
						?>
					</select>
					
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('social_icon_link_' . $i); ?>">Social Icon <?php echo $i; ?> Link:</label>
					<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('social_icon_link_' . $i); ?>" name="<?php echo $this->get_field_name('social_icon_link_' . $i); ?>" value="<?php echo $instance['social_icon_link_' . $i]; ?>" />
				</p>
			<?php 
				$i++;
				endwhile;
			?>
	
		<?php
		}
	}
	function ebor_framework_register_ebor_contact(){
	     register_widget( 'ebor_contact_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_contact');
}

if(!( class_exists('malefic_Instagram_Widget') )){
	class malefic_Instagram_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'malefic-instagram-widget', // Base ID
				esc_html__('TommusRhodus: Instagram Widget', 'creatink'), // Name
				array( 'description' => esc_html__( 'Add a simple Instagram feed widget', 'creatink' ), ) // Args
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
				'title' => '',
				'id' => '', 
				'username' => ''
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
			echo $args['before_widget'];
			
			if($title)
				echo  $args['before_title'].$title.$args['after_title'];
				
			$output    = '';
			$cache_key = 'tommus-instagram-' . md5( $token . $count );
			$result    = get_transient( $cache_key );

			if( false === $result ){

				$request = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token='. $username .'&count=' . 6 );
				
				if( is_wp_error( $request ) ){
				
					$ttl    = 300; //300 = 5 mins
					$result = $request;
					
				} else {
					
					$body   = $request['body'];
					$result = json_decode( $body );
					$ttl    = 3600; //3600 = 1 hour
					
				}
				
				set_transient( $cache_key, $result, $ttl );
				
			}

			if(!( false === $result )){
				
				$output .= '<div class="tiles tiles-s"><div id="instafeed-widget" class="items row">';
				
				foreach( $result->data as $image ) {
					$output .= '
						<div class="item col-6 col-sm-4">
							<figure class="overlay overlay3">
								<a href="'. $image->link .'" target="_blank">
									
									<span class="bg"></span>
									
									<img src="'. $image->images->low_resolution->url.'" alt="'. $image->caption->text .'" />
									
									<figcaption class="d-flex">
										<div class="align-self-center mx-auto">
											<i class="fa fa-instagram"></i>
										</div>
									</figcaption>
									
								</a>
							</figure>
						</div>
					';
				}
						
				$output .= '</div></div>';
				
			}

			echo wp_kses_post($output);

			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			
			$defaults = array(
				'title' => 'Instagram', 
				'id' => '',
				'username' => ''
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Widget Title', 'creatink' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php esc_html_e( 'Access Token', 'creatink' ); ?></label> 
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
	function ebor_framework_register_malefic_instagram(){
	     register_widget( 'malefic_Instagram_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_malefic_instagram');
}

/*-----------------------------------------------------------------------------------*/
/*	PRODUCTS WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('ebor_creatink_product_Widget') )){
	class ebor_creatink_product_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_creatink_product-widget', // Base ID
				esc_html__('TommusRhodus: Recent Products', 'creatink'), // Name
				array( 'description' => esc_html__( 'Add a simple recent products widget', 'creatink' ), ) // Args
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
	
		    	<ul class="image-list">
			    	<?php 
			    		$widget_query = new WP_Query(
			    			array(
			    				'post_type' => 'product',
			    				'posts_per_page' => $instance['amount']
			    			)
			    		);
			    		if( $widget_query->have_posts() ) : while ( $widget_query->have_posts() ): $widget_query->the_post(); 
			    	?>
			    	  
			    		<li>
			    		  <figure class="overlay icon-overlay small"> 
			    		  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a> 
			    		  </figure>
			    		  <div class="post-content">
			    		  	<h6 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			    		    <div class="meta"><span class="date"><?php the_time( get_option('date_format') ); ?> </span> </div>			    		    
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
			$defaults = array('title' => 'Recent Products', 'amount' => '3');
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
	function ebor_framework_register_ebor_creatink_product(){
	     register_widget( 'ebor_creatink_product_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_creatink_product');
}


/*-----------------------------------------------------------------------------------*/
/*	CUSTOM CATEGORIES LIST
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('Brailie_WP_Widget_Categories') )){
	class Brailie_WP_Widget_Categories extends WP_Widget {

		public function __construct() {
			$widget_ops = array(
				'classname' => 'brailie_widget_categories',
				'description' => __( 'A list of categories.' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'categories', __( 'TommusRhodus: Categories' ), $widget_ops );
		}

		public function widget( $args, $instance ) {
			static $first_dropdown = true;

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

			$c = ! empty( $instance['count'] ) ? '1' : '0';
			$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';

			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			$cat_args = array(
				'orderby'      => 'name',
				'show_count'   => $c,
				'hierarchical' => $h
			);
	?>
			<ul class="list-group simple">
	<?php
			$cat_args['title_li'] = '';

			/**
			 * Filters the arguments for the Categories widget.
			 *
			 * @since 2.8.0
			 *
			 * @param array $cat_args An array of Categories widget options.
			 */
			wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
	?>
			</ul>
	<?php
			echo $args['after_widget'];
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['count'] = !empty($new_instance['count']) ? 1 : 0;

			return $instance;
		}

		public function form( $instance ) {
			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = sanitize_text_field( $instance['title'] );
			$count = isset($instance['count']) ? (bool) $instance['count'] :false;
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />
			<?php
		}

	}
	function ebor_framework_register_ebor_brailie_category(){
	     register_widget( 'Brailie_WP_Widget_Categories' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_brailie_category');

	//Wrap each li in our class
	function add_category_parent_css($css_classes, $category, $depth, $args){
	    $css_classes[] = 'list-group-item d-flex justify-content-between align-items-center';
	    return $css_classes;
	}
	add_filter( 'category_css_class', 'add_category_parent_css', 10, 4);

	//Wrap each count in our span	
	function cat_count_span($links) {
		$links = str_replace('</a> (', '</a> <span class="badge badge-pill bg-default">', $links);
		$links = str_replace(')', '</span>', $links);
		return $links;
	}
	add_filter('wp_list_categories', 'cat_count_span', 10, 4);
}

