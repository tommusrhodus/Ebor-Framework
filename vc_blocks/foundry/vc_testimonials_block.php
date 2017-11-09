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
	
	if( 'carousel' == $layout ) : 
?>
	
	<div class="testimonials text-slider slider-arrow-controls text-center">
	    <ul class="slides">
	        <?php 
	        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
	        	
	        		get_template_part('loop/content-testimonial', 'carousel');
	        	
	        	endwhile;
	        	else : 
	        		
	        		get_template_part('loop/content', 'none');
	        				
	        	endif;
	        ?>
	    </ul>
	</div>

<?php elseif( 'grid' == $layout ) : ?>

	<div class="row">
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 

				get_template_part('loop/content-testimonial', 'grid');
				
				if( ($block_query->current_post + 1) % 3 == 0 ){
					echo '</div><div class="row">';
				}
			
			endwhile;
			else : 
				
				get_template_part('loop/content', 'none');
						
			endif;
		?>
	</div>
	
<?php elseif( 'carousel-bordered' == $layout ) : ?>

	<div class="row">
	    <div class="text-slider slider-paging-controls controls-outside relative">
	        <ul class="slides">
	        	<?php 
	        		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
	        		
	        			get_template_part('loop/content-testimonial', 'carousel-bordered');
	        		
	        		endwhile;
	        		else : 
	        			
	        			get_template_part('loop/content', 'none');
	        					
	        		endif;
	        	?>
	        </ul>
	    </div>
	</div>
	
<?php elseif( 'carousel-agency' == $layout ) : ?>
	
	<div class="text-slider slider-paging-controls text-center relative">
	    <ul class="slides">
	        <?php 
	        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
	        	
	        		get_template_part('loop/content-testimonial', 'carousel-agency');
	        	
	        	endwhile;
	        	else : 
	        		
	        		get_template_part('loop/content', 'none');
	        				
	        	endif;
	        ?>
	    </ul>
	</div>
	
<?php else : ?>

	<?php 
		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
		
			get_template_part('loop/content-testimonial', 'box');
		
		endwhile;
		else : 
			
			get_template_part('loop/content', 'none');
					
		endif;
	?>
			
<?php	
	endif;
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'foundry_testimonial_carousel', 'ebor_testimonial_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_carousel_shortcode_vc() {
	
	$testimonial_types = array(
		'Carousel' => 'carousel',
		'Bordered Carousel' => 'carousel-bordered',
		'Agency Carousel' => 'carousel-agency',
		'Boxed' => 'boxed',
		'Grid' => 'grid'
	);
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Testimonials", 'foundry'),
			"base" => "foundry_testimonial_carousel",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'foundry'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'foundry'),
					"param_name" => "layout",
					"value" => $testimonial_types
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_testimonial_carousel_shortcode_vc');