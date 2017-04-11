<?php 

/**
 * The Shortcode
 */
function ebor_login_shortcode( $atts ) {
	$find = array(
		'button button-primary'
	);
	
	$replace = array(
		'btn btn--primary type--uppercase'
	);
	
	return str_replace($find, $replace, wp_login_form( array( 'echo' => false ) ));
}
add_shortcode( 'stack_login', 'ebor_login_shortcode' );

/**
 * The VC Functions
 */
function ebor_login_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Login Form", 'stackwordpresstheme'),
			"base" => "stack_login",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Show the WP Login form',
			"params" => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_login_shortcode_vc');
