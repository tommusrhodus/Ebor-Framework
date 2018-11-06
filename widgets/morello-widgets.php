<?php 
if(!( class_exists('ebor_keepsake_popular_Widget') )){
	class ebor_keepsake_popular_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_keepsake_popular-widget', // Base ID
				__('TommusRhodus: Popular Posts', 'ebor_framework'), // Name
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
	
		    	<ul class="post-list">
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
			    		  <figure class="overlay"> 
			    		  <a href="<?php the_permalink(); ?>">
			    		    <div class="overlay icon">
			    		      <div class="info"><span class="icon-more"></span></div>
			    		    </div>
			    		    <?php the_post_thumbnail('thumbnail'); ?> </a> </figure>
			    		  <div class="post-content">
			    		    <div class="meta"><span class="date"><?php the_time( get_option('date_format') ); ?> </span> </div>
			    		    <p> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </p>
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
	function ebor_framework_register_ebor_keepsake_popular(){
	     register_widget( 'ebor_keepsake_popular_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_ebor_keepsake_popular');
}

/*-----------------------------------------------------------------------------------*/
/*	CONTACT WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('ebor_contact_Widget') )){
	class ebor_contact_Widget extends WP_Widget {
		
		public function __construct(){
			parent::__construct(
				'ebor_contact-widget', // Base ID
				__('TommusRhodus: Social Icons', 'ebor_framework'), // Name
				array( 'description' => __( 'Add a simple social icons widget', 'ebor_framework' ), ) // Args
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
	    	<ul class="social">
	    		<?php
	    			foreach( $links as $index => $link ){
	    				echo '<li><a href="'. $link .'" target="_blank"><i class="ion-social-'. $icons[$index] .'"></i></a></li>';
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