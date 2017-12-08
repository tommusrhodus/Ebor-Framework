<?php 

/**
 * The Shortcode
 */
function ebor_team_single_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'offset' => '0'
			), $atts 
		) 
	);
	
	/**
	 * Setup team query
	 */
	$query_args = array(
		'post_type' => 'team',
		'post_status' => 'publish',
		'posts_per_page' => '1',
		'ignore_sticky_posts' => true,
		'offset' => $offset
	);
	
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	the_post();
	get_template_part('loop/content', 'team');
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'griddr_team_single', 'ebor_team_single_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_single_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'griddr-vc-block',
			"name" => esc_html__("Team Single", 'griddr'),
			"base" => "griddr_team_single",
			"category" => esc_html__('griddr WP Theme', 'griddr'),
			'description' => 'Show team teams with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Offset", 'griddr'),
					"param_name" => "offset",
					"value" => '0'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_team_single_shortcode_vc');