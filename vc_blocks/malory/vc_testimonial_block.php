<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '999',
				'filter' => 'all'
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
	global $wp_query, $post;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-testimonial', 'grid');
	
	$output = ob_get_contents();
	ob_end_clean();

	wp_reset_postdata();
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'malory_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'malory-vc-block',
			"name" => esc_html__("Testimonials", 'malory'),
			"base" => "malory_testimonial",
			"category" => esc_html__('malory WP Theme', 'malory'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'malory'),
					"param_name" => "pppage",
					"value" => '8'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');