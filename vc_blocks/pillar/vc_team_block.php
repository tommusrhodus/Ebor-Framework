<?php 

/**
 * The Shortcode
 */
function ebor_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'grid'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'team',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}
	
	global $wp_query, $post;
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();

	get_template_part('loop/loop-team', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'pillar_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
			"name" => esc_html__("Team Feeds", 'pillar'),
			"base" => "pillar_team",
			"category" => esc_html__('pillar WP Theme', 'pillar'),
			'description' => 'Show team posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'pillar'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Team Display Type", 'pillar'),
					"param_name" => "layout",
					"value" => array(
						'Grid' => 'grid',
						'Fullwidth' => 'masonry'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');
