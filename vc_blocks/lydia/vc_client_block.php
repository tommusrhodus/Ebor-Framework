<?php 

/**
 * The Shortcode
 */
function ebor_client_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'carousel',
				'pppage' => '8',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'client',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'client_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'client_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	global $wp_query;
	$old_query = $wp_query;
	
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop', 'client');
	
	$output = ob_get_contents();
	ob_end_clean();
	
	$wp_query = $old_query;
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'lydia_client', 'ebor_client_shortcode' );

/**
 * The VC Functions
 */
function ebor_client_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Client Feeds", 'lydia'),
			"base" => "lydia_client",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Show client posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'lydia'),
					"param_name" => "pppage",
					"value" => '8'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_client_shortcode_vc');