<?php 

/**
 * The Shortcode
 */
function ebor_post_shortcode( $atts ) {
	global $wp_query, $post, $paged;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'standard',
				'show_loadmore' => 'no'
			), $atts 
		) 
	);
	
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $pppage,
		'paged'          => $paged
	);
	
	//Hide current post ID from the loop if we're in a singular view
	if( is_single() && isset($post->ID) ){
		$query_args['post__not_in']	= array($post->ID);
	}
	
	if (!( $filter == 'all' )) {
		
		//Check for WPML
		if( has_filter('wpml_object_id') ){
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
			
			$filterClass = get_term_by('slug', $filter, 'category');
			$ID = (int) apply_filters('wpml_object_id', (int) $filterClass->term_id, 'category', true);
			$translatedSlug = get_term_by('id', $ID, 'category');
			$filter = $translatedSlug->slug;
			
			//Adding filter back
			add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
		}
		
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $filter
			)
		);
		
	}
	
	$old_query = $wp_query;
	$old_post  = $post;
	$wp_query  = new WP_Query( $query_args );
	$wp_query->{"show_loadmore"} = $show_loadmore;
	
	ob_start();
	
	get_template_part('loop/loop-post', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'gaze_post', 'ebor_post_shortcode' );

/**
 * The VC Functions
 */
function ebor_post_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Blog Feeds", 'gaze' ),
			"base"        => "gaze_post",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Show post posts with layout options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Show How Many Posts?", 'gaze' ),
					"param_name" => "pppage",
					"value"      => '4'
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Post Display Type", 'gaze' ),
					"param_name" => "layout",
					"value"      => ebor_get_blog_layouts(),
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Show Load More?", 'gaze'),
					"param_name" => "show_loadmore",
					"value"      => array(
						'No'  => 'no',
						'Yes' => 'yes'
					),
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_post_shortcode_vc');