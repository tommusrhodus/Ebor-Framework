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
				'tag'    => 'all',
				'layout' => 'list',
				'custom_css_class' => '',
				'paging' => 'false',
				'arrows' => 'true',
				'timing' => 'false',
				'offset' => '0'
			), $atts 
		) 
	);
	
	if( 0 == $pppage || isset($wp_query->doing_blog_shortcode) ){
		return false;	
	}
	
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
	
	// Check for and handle offset
	if( $offset ) {
	    $offset_start         = $offset;
	    $offset               = ( $paged - 1 ) * $pppage + $offset_start;
	    $query_args['offset'] = $offset;    
	}
	
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
			
			$filterClass    = get_term_by('slug', $filter, 'category');
			$ID             = (int) apply_filters('wpml_object_id', (int) $filterClass->term_id, 'category', true);
			$translatedSlug = get_term_by('id', $ID, 'category');
			$filter         = $translatedSlug->slug;
			
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
	
	if(!( $tag == 'all' )){
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => $tag
			)
		);
	}
	
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	$wp_query->{"slider_options"} = array(
		'paging' => $paging,
		'arrows' => $arrows,
		'timing' => $timing
	);
	$wp_query->{"doing_blog_shortcode"} = 'true';
	
	ob_start();
	
	echo '<div class="'. $custom_css_class .'">';
	get_template_part('loop/loop-post', $layout);
	echo '</div>';
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'stack_post', 'ebor_post_shortcode' );

/**
 * The VC Functions
 */
function ebor_post_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Blog Feeds", 'stackwordpresstheme'),
			"base" => "stack_post",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Show post posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'stackwordpresstheme'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Post Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => ebor_get_blog_layouts(),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Offset Posts?", 'stackwordpresstheme'),
					"param_name" => "offset",
					"value" => '0',
					"description" => '<code>DEVELOPERS ONLY</code> - Offset posts shown, 0 for newest posts, 5 starts at fifth most recent etc.'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_post_shortcode_vc');