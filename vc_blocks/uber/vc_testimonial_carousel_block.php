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

	<section class="process process-bg parallax">
		<div class="owl-carousel features-slider">
			
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
				global $post;
				$url = get_post_meta( $post->ID, '_ebor_testimonial_url', true );
				if ($url) {
					$testimonial_url = $url;
				} else {
					$testimonial_url = '#';
				}
			?>
			
				<article class="item text-center">
					<h1 class="minimal-caps white font4light"><?php echo get_the_content(); ?></h1>
					<div class="features-slider-triggers font4bold">
						<a href="<?php echo esc_url($testimonial_url); ?>"><?php the_title(); ?></a>
					</div>
				</article>
			
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
		
		</div>
	</section>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'uber_testimonial_carousel', 'ebor_testimonial_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_carousel_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Testimonial Carousel", 'uber'),
			'description' => __('Adds a carousel of testimonial posts', 'uber'),
			"base" => "uber_testimonial_carousel",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'uber'),
					"param_name" => "pppage",
					"value" => '8'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_carousel_shortcode_vc');