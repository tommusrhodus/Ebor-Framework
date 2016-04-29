<?php 

/**
 * The Shortcode
 */
function ebor_service_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '5',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'service',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'service_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'service_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}
	
	global $wp_query;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop', 'service');
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'partner_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Service Feeds", 'partner'),
			"base" => "partner_service",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Show service posts.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'partner'),
					"param_name" => "pppage",
					"value" => '4'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc');