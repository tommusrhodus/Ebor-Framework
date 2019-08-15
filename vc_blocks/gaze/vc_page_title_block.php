<?php 

/**
 * The Shortcode
 */
function ebor_page_title_shortcode( $atts, $content = null ) {
	
	global $post;
	
	ob_start();

	ebor_page_title( 
		get_the_title(), 
		get_the_post_thumbnail_url( $post->ID, 'full' ) 
	);

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
	
}
add_shortcode( 'gaze_page_title', 'ebor_page_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_title_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Page Title", 'gaze' ),
			'description' => 'This block uses the page title and post thumbnail.',
			"base"        => "gaze_page_title",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			"params"      => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_page_title_shortcode_vc' );