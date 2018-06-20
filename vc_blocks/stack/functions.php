<?php 

if( !( function_exists('ebor_icons_settings_field') ) && function_exists('vc_set_as_theme') ){
	function ebor_icons_settings_field( $settings, $value ) {
		
		$icons = $settings['value'];
		
		$output = '<a href="#" id="ebor-icon-toggle" class="button button-primary button-large">Show/Hide Icons</a><div class="ebor-icons"><div class="ebor-icons-wrapper">';
		foreach( $icons as $icon ){
			$active = ( $value == $icon) ? ' active' : '';
			$output .= '<i class="icon '. $icon . $active .'" data-icon-class="'. $icon .'"></i>';
		}
		$output .= '</div><input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ebor-icon-value ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' . '</div>';
		
	   return $output;
	}
	vc_add_shortcode_param( 'ebor_icons', 'ebor_icons_settings_field' );
}

if(!( function_exists('ebor_search_bar_shortcode') )){
	function ebor_search_bar_shortcode( $atts, $content = null ) {
		return get_search_form(false);
	}
	add_shortcode( 'stack_search_bar', 'ebor_search_bar_shortcode' );
}

if( function_exists('ebor_breadcrumbs') ){
	add_shortcode('stack_breadcrumbs_variant', 'ebor_breadcrumbs');	
}

/*-----------------------------------------------------------------------------------*/
/*	INSTAGRAM WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('stack_Instagram_Widget') )){
	class stack_Instagram_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'stack-instagram-widget', // Base ID
				esc_html__('Stack: Instagram Widget', 'stackwordpresstheme'), // Name
				array( 'description' => esc_html__( 'Add a simple Instagram feed widget', 'stackwordpresstheme' ), ) // Args
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
				'title'    => 'Instagram Feed', 
				'username' => '',
				'amount'   => '6',
				'grid'     => '3'
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			
			echo $args['before_widget'];
			
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			
			if ( isset( $instance['username'] ) )
				echo '<div class="instafeed instafeed--gapless" data-user-name="'. $instance['username'] .'" data-amount="'. $instance['amount'] .'" data-grid="'. $instance['grid'] .'"></div>';
			
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			
			$defaults = array(
				'title'    => 'Instagram Feed', 
				'username' => '',
				'amount'   => '6',
				'grid'     => '3'
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'stackwordpresstheme' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php esc_html_e( 'Username:', 'stackwordpresstheme' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php esc_html_e( 'Amount:', 'stackwordpresstheme' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>">
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'grid' ); ?>"><?php esc_html_e( 'Grid:', 'stackwordpresstheme' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" type="text" value="<?php echo esc_attr( $grid ); ?>">
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
	function ebor_framework_register_stack_instagram(){
	     register_widget( 'stack_Instagram_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_stack_instagram');
}
/*-----------------------------------------------------------------------------------*/
/*	TWITTER WIDGET
/*-----------------------------------------------------------------------------------*/
if(!( class_exists('stack_Twitter_Widget') )){
	class stack_Twitter_Widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct(){
			parent::__construct(
				'stack-twitter-widget', // Base ID
				esc_html__('Stack: Twitter Widget', 'stackwordpresstheme'), // Name
				array( 'description' => esc_html__( 'Add a simple Twitter feed widget', 'stackwordpresstheme' ), ) // Args
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
				echo '<div class="tweets-feed tweets-feed-2" data-feed-name="'. $instance['user_name'] .'" data-amount="2"></div>';
			
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
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'stackwordpresstheme' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'user_name' ); ?>">Twitter Username <code>e.g: tommusrhodus</code>
				<p class="description">Do not use @, plain text username only!</p></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'user_name' ); ?>" name="<?php echo $this->get_field_name( 'user_name' ); ?>" type="text" value="<?php echo esc_attr( $user_name ); ?>">
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
	function ebor_framework_register_stack_twitter(){
	     register_widget( 'stack_Twitter_Widget' );
	}
	add_action( 'widgets_init', 'ebor_framework_register_stack_twitter');
}