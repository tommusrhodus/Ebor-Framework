<?php 

/**
 * The Shortcode
 */
function ebor_product_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'column-2',
				'custom_css_class' => '',
				'paging' => 'true',
				'arrows' => 'false',
				'timing' => 'false'
			), $atts 
		) 
	);
	
	if( 0 == $pppage || isset($wp_query->doing_product_shortcode) ){
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
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if(!( $filter == 'all' )) {
		
		//Check for WPML
		if( has_filter('wpml_object_id') ){
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
			
			$filterClass    = get_term_by('slug', $filter, 'product_cat');
			$ID             = (int) apply_filters('wpml_object_id', (int) $filterClass->term_id, 'product_cat', true);
			$translatedSlug = get_term_by('id', $ID, 'product_cat');
			$filter         = $translatedSlug->slug;
			
			//Adding filter back
			add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
		}
			
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $filter
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
	$wp_query->{"doing_product_shortcode"} = 'true';
	
	ob_start();
	
	echo '<div class="'. $custom_css_class .'">';
	get_template_part('loop/loop-product', $layout);
	echo '</div>';
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'stack_product', 'ebor_product_shortcode' );

/**
 * The VC Functions
 */
function ebor_product_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Product Feeds", 'stackwordpresstheme'),
			"base" => "stack_product",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Show product posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'stackwordpresstheme'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Product Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => ebor_get_shop_layouts()
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
add_action( 'vc_before_init', 'ebor_product_shortcode_vc');
