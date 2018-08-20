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
	global $block_query;
	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>
		
	<div class="testimonials owl-carousel thin">
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content-testimonial', 'carousel');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
		?>
	</div>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'hygge_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {	
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Testimonials", 'hygge'),
			"base" => "hygge_testimonial",
			"category" => __('Hygge WP Theme', 'hygge'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'hygge'),
					"param_name" => "pppage",
					"value" => '8'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');