<?php 

/**
 * The Shortcode
 */
function ebor_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'classic',
				'pppage' => '8',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'post',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}
	
	global $wp_query, $post;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-post', $type);
	
	$output = ob_get_contents();
	ob_end_clean();

	wp_reset_postdata();
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'malory_blog', 'ebor_blog_shortcode' );

/**
 * The VC Functions
 */
function ebor_blog_shortcode_vc() {
	
	$blog_types = ebor_get_blog_layouts();
	
	vc_map( 
		array(
			"icon" => 'malory-vc-block',
			"name" => esc_html__("Blog Feeds", 'malory'),
			"base" => "malory_blog",
			"category" => esc_html__('malory WP Theme', 'malory'),
			'description' => 'Show blog posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'malory'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'malory'),
					"param_name" => "type",
					"value" => $blog_types
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_blog_shortcode_vc');