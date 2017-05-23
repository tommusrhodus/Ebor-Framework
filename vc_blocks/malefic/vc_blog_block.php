<?php 

/**
 * The Shortcode
 */
function ebor_post_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'grid-sidebar',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	//PAgination fix
	global $paged;
	
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
		'post_status' => 'publish',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	//Hide current post ID from the loop if we're in a singular view
	global $post;
	if( is_single() && isset($post->ID) ){
		$query_args['post__not_in']	= array($post->ID);
	}
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $filter
			)
		);
	}
	
	global $wp_query, $post;
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-post', $layout);

	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'malefic_post', 'ebor_post_shortcode' );

/**
 * The VC Functions
 */
function ebor_post_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Blog Feeds", 'malefic'),
			"base" => "malefic_post",
			"category" => esc_html__('malefic WP Theme', 'malefic'),
			'description' => 'Show post posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'malefic'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Post Display Type", 'malefic'),
					"param_name" => "layout",
					"value" => ebor_get_blog_layouts(),
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_post_shortcode_vc');
