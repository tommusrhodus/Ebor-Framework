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
				'type' => 'carousel-3col'
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
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-testimonial', $type);
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'ryla_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	
	$team_types = array(
		'Testimonial Carousel (3 Columns)' => 'carousel-3col',
		'Testimonial Carousel (1 Columns)' => 'carousel-1col'
	);
	
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => esc_html__("Testimonials", 'ryla'),
			"base" => "ryla_testimonial",
			"category" => esc_html__('ryla WP Theme', 'ryla'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'ryla'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'ryla'),
					"param_name" => "type",
					"value" => $team_types
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');