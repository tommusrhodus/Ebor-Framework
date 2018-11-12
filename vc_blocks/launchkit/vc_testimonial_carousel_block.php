<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_carousel_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '999',
				'filter' => 'all',
				'layout' => 'carousel'
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
	$block_query = new WP_Query( $query_args );
	
	ob_start();
	
	if(!( 'carousel' == $layout )) :
?>
	
	<div class="testimonials testimonials-3">
		<div class="row">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
				
					get_template_part('loop/content', 'testimonial-feed');
				
				endwhile;
				else : 
					
					get_template_part('loop/content', 'none');
							
				endif;
				wp_reset_query();
			?>
		</div>
	</div>
	
<?php
	else :
?>
	
	<div class="testimonials testimonials-4">
		<div class="slider">
			<ul class="slides">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
					
						get_template_part('loop/content', 'testimonial-carousel');
					
					endwhile;
					else : 
						
						get_template_part('loop/content', 'none');
								
					endif;
					wp_reset_query();
				?>
			</ul>
		</div>
	</div>
			
<?php
	endif;
		
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_testimonial_carousel', 'ebor_testimonial_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_carousel_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Testimonial Carousel", 'launchkit'),
			"base" => "launchkit_testimonial_carousel",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'launchkit'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Testimonials Layout", 'launchkit'),
					"param_name" => "layout",
					"value" => array_flip(array(
						'carousel' => 'Testimonials Carousel',
						'grid' => 'Testimonials Grid'
					))
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_carousel_shortcode_vc');