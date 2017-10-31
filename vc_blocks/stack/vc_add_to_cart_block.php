<?php 

/**
 * The Shortcode
 */
function ebor_add_to_cart_shortcode( $atts ) {
	ob_start();
	
	if( is_singular('product') ){ 
		woocommerce_template_single_add_to_cart();
	}
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'stack_add_to_cart', 'ebor_add_to_cart_shortcode' );

/**
 * The VC Functions
 */
function ebor_add_to_cart_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Add To Cart", 'stackwordpresstheme'),
			"base" => "stack_add_to_cart",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Add to cart, Add in a product post ONLY',
			"params" => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_add_to_cart_shortcode_vc');