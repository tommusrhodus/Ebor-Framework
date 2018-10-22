<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '3',
				'filter' => 'all',
				'layout' => 'grid'
			), $atts 
		) 
	);
	
	if( 0 == $pppage || isset($wp_query->doing_testimonial_shortcode) ){
		return false;	
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type'      => 'testimonial',
		'post_status'    => 'publish',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = icl_object_id( $filter, 'testimonial_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field' => 'slug',
				'terms' => $filter
			)
		);
	}
	
	$old_query = $wp_query;
	$old_post  = $post;
	$wp_query  = new WP_Query( $query_args );
	$wp_query->{"doing_testimonial_shortcode"} = 'true';
	
	ob_start();

	get_template_part( 'loop/loop-testimonial', $layout );
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post     = $old_post;
	
	return $output;
}
add_shortcode( 'brailie_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'brailie-vc-block',
			"name"        => esc_html__( "Testimonial Feeds", 'brailie' ),
			"base"        => "brailie_testimonial",
			"category"    => esc_html__( 'brailie WP Theme', 'brailie' ),
			'description' => 'Show testimonial posts with layout options.',
			"params" => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Show How Many Posts?", 'brailie' ),
					"param_name" => "pppage",
					"value"      => '3'
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Testimonial Display Type", 'brailie' ),
					"param_name" => "layout",
					"value"      => brailie_get_testimonial_layouts()
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');
