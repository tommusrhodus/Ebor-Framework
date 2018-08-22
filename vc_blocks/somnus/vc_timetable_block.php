<?php 

/**
 * The Shortcode
 */
function somnus_timetable_shortcode( $atts ) {
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'class',
		'posts_per_page' => '-1'
	);
	
	global $wp_query;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop', 'class');
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'somnus_timetable', 'somnus_timetable_shortcode' );

/**
 * The VC Functions
 */
function somnus_timetable_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Classes Timetable", 'somnus'),
			"base" => "somnus_timetable",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			'description' => 'Show your classes timetable',
			"params" => array()
		) 
	);
	
}
add_action( 'vc_before_init', 'somnus_timetable_shortcode_vc');