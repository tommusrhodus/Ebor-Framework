<?php 

/**
 * The Shortcode
 */
function ebor_register_shortcode( $atts ) {

	$output = '
		<form name="registerform" id="registerform" action="'. wp_login_url() .'?action=register" method="post">
		
			<div class="form-group">
				<input type="text" name="user_login" id="user_login" class="form-control" placeholder="Username" value="">
			</div><!-- /.form-group -->
			
			<div class="form-group">
				<input type="email" name="user_email" id="user_email" class="form-control" value="" placeholder="E-mail">
			</div><!-- /.form-group -->
			
			<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-rounded" value="Register">
			<input type="hidden" name="redirect_to" value="'. get_permalink() .'">
			
		</form><!-- /form --> 
	';
	
	return $output;
	
}
add_shortcode( 'creatink_register', 'ebor_register_shortcode' );

/**
 * The VC Functions
 */
function ebor_register_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Register Form", 'creatink'),
			"base" => "creatink_register",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Show the WP Login form',
			"params" => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_register_shortcode_vc');
