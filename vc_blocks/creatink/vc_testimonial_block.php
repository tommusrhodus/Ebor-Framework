<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'basic'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
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
				'field' => 'slug',
				'terms' => $filter
			)
		);
	}

	global $wp_query, $post;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-testimonial', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'creatink_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'creatink-vc-block',
			"name"        => esc_html__("Testimonial Feeds", 'creatink'),
			"base"        => "creatink_testimonial",
			"category"    => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Show testimonial posts with layout options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Show How Many Posts?", 'creatink'),
					"param_name" => "pppage",
					"value"      => '4'
				),
				array(
					'type'       => 'dropdown',
					"heading"    => esc_html__("Layout", 'creatink'),
					'param_name' => 'layout',
					'value'      => array(
						'Basic'          => 'basic',
						'Slider'         => 'slider',
						'Carousel'       => 'carousel',
						'Boxed Carousel' => 'carousel-box',
						'Columns'        => 'columns',
						'Columns Boxed'  => 'columns-box'
					)
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');