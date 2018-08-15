<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_carousel_shortcode( $atts ) {
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
	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>

	<div class="col-sm-8 col-sm-offset-2">
		<div class="testimonials-slider text-center">
			<ul class="slides">
				
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
				?>
				
					<li>
						<?php 
							echo '<p class="text-white lead">'. wp_specialchars_decode( get_the_content(), ENT_QUOTES ) .'</p>';
							the_title('<span class="author text-white">', '</span>');
						?>
					</li>
				
				<?php
					endwhile;
					else : 
				?>
					
					<li>
						<?php get_template_part('loop/content','none'); ?>
					</li>
					
				<?php		
					endif;
					wp_reset_query();
				?>

			</ul>
		</div>
	</div>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'pivot_testimonial_carousel', 'ebor_testimonial_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_carousel_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Testimonial Carousel", 'pivot'),
			"base" => "pivot_testimonial_carousel",
			"category" => __('Pivot - Feeds', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'pivot'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_carousel_shortcode_vc');