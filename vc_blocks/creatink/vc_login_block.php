<?php 

/**
 * The Shortcode
 */
function ebor_login_shortcode( $atts ) {

	$output = '
		<form name="loginform" id="loginform" action="'. wp_login_url() .'" method="post">
		
			<div class="form-group">
				<input type="text" name="log" id="user_login" class="form-control" placeholder="Username or Email" value="">
			</div><!-- /.form-group -->
			
			<div class="form-group">
				<input type="password" name="pwd" id="user_pass" class="form-control" value="" placeholder="Password">
			</div><!-- /.form-group -->
			
			<div class="row">
			
				<div class="col-sm-6">
					<div class="form-group">
						<div class="checkbox mt-0 mb-0">
							<label>
								<input name="rememberme" type="checkbox" id="rememberme" value="forever">
								<span><!-- fake checkbox --></span> 
								<span class="wrapped-label">Remember Me</span> 
							</label>
						</div><!-- /.checkbox --> 
					</div><!-- /.form-group --> 
				</div><!--/column -->
				
				<div class="col-sm-6 text-right"> 
					<a href="'. wp_lostpassword_url() .'" class="hover">Forgot Password?</a> 
				</div><!--/column --> 
				
			</div><!--/.row -->
			
			<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-rounded" value="Sign In">
			<input type="hidden" name="redirect_to" value="'. get_permalink() .'">
			
		</form><!-- /form --> 
	';
	
	return $output;
	
}
add_shortcode( 'creatink_login', 'ebor_login_shortcode' );

/**
 * The VC Functions
 */
function ebor_login_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Login Form", 'creatink'),
			"base" => "creatink_login",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Show the WP Login form',
			"params" => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_login_shortcode_vc');
