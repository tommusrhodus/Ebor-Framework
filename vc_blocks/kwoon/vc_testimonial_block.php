<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '999',
				'filter' => 'all',
				'type' => 'grid'
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
	
	<?php if( $type == 'grid' ) : ?>
	
		<div class="row text-center testimonials2">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content-testimonial', 'grid');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
		</div>
	
	<?php elseif( $type == 'carousel' ) : ?>
		
		<div class="carousel-wrapper">
			<div class="carousel testimonials3">
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
		</div>
		
	<?php elseif( $type == 'row' ) : ?>
		
		<div class="testimonials">
			<div class="row">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-testimonial', 'row');
						
						if( ($block_query->current_post + 1) % 2 == 0)
							echo '</div><div class="divide30"></div><div class="row">';
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
				?>
			</div>
		</div>
		
	<?php endif; ?>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'kwoon_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	
	$team_types = array(
		'Testimonial Grid (4)' => 'grid',
		'Testimonial Grid (2)' => 'row',
		'Testimonial Carousel' => 'carousel'
	);
	
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Testimonials", 'kwoon'),
			"base" => "kwoon_testimonial",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'kwoon'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'kwoon'),
					"param_name" => "type",
					"value" => $team_types
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');