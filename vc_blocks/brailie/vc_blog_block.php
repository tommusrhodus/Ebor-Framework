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
				'layout' => 'classic',
				'pagination_style' => 'numeric',
				'pagination_align' => 'center',
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
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $pppage,
		'paged' => $paged
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
				'field' => 'slug',
				'terms' => $filter
			)
		);
		
	}
	
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	$wp_query->{"pagination_style"} = $pagination_style;
	$wp_query->{"pagination_align"} = $pagination_align;
	
	ob_start();
	
	get_template_part('loop/loop-post', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'brailie_post', 'ebor_post_shortcode' );

/**
 * The VC Functions
 */
function ebor_post_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Blog Feeds", 'brailie'),
			"base" => "brailie_post",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Show post posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'brailie'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Post Display Type", 'brailie'),
					"param_name" => "layout",
					"value" => brailie_get_blog_layouts(),
				),
				array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Pagination Style", 'brailie'),
		    		"param_name" => "pagination_style",
		    		"value" => array(
		    			'Numeric' => 'numeric',
		    			'Numeric Bordered' => 'numeric_bordered',
		    			'Numeric Solid' => 'numeric_solid',
		    			'Traditional' => 'traditional',
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Pagination Alignment", 'brailie'),
		    		"param_name" => "pagination_align",
		    		"value" => array(
		    			'Center' => 'center',
		    			'Left'   => 'left',
		    		)
		    	),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_post_shortcode_vc');