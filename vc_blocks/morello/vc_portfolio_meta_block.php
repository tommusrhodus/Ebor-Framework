<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_meta_block_shortcode( $atts, $content = null ) {
	
	ob_start();
	
	get_template_part('inc/content-portfolio', 'meta');
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'morello_portfolio_meta_block', 'ebor_portfolio_meta_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_meta_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Portfolio Meta", 'morello'),
			"base" => "morello_portfolio_meta_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			'description' => 'Display portfolio meta data, use in single portfolio post only!',
			'show_settings_on_create' => false,
			"params" => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_portfolio_meta_block_shortcode_vc' );