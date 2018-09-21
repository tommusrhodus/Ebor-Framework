<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '999',
				'filter' => 'all',
				'type' => 'carousel'
			), $atts 
		) 
	);
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'testimonial_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}
	
	/**
	 * Finally, here's the query.
	 */
	global $wp_query;
	$old_query = $wp_query;
	
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-testimonial', $type);

	$output = ob_get_contents();
	ob_end_clean();
	
	$wp_query = $old_query;
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'lydia_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	
	$team_types = array(
		'Testimonial Carousel' => 'carousel',
		'Testimonial Grid' => 'grid'
	);
	
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Testimonials", 'lydia'),
			"base" => "lydia_testimonial",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'lydia'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'lydia'),
					"param_name" => "type",
					"value" => $team_types
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');