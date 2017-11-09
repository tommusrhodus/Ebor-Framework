<?php 

/**
 * The Shortcode
 */
function ebor_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'large',
				'pppage' => '999',
				'filter' => 'all',
				'layout' => 'grid'
			), $atts 
		) 
	);
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'team',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$filter = get_term_by('id', $filter, 'team_category');
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field' => 'slug',
				'terms' => $filter->slug
			)
		);
	}
 
	
	/**
	 * Finally, here's the query.
	 */
	$block_query = new WP_Query( $query_args );
	
	ob_start();
	
	if( 'grid' == $layout ) :
?>
	
		<div class="row"><?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'team-grid');
					
					if( ($block_query->current_post + 1) % 3 == 0 ){
						echo '</div><div class="row">';
					}
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?></div><!--end of row-->
	
	<?php elseif( 'grid-small' == $layout ) : ?>
	
		<div class="row"><?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'team-grid-small');
					
					if( ($block_query->current_post + 1) % 4 == 0 ){
						echo '</div><div class="row">';
					}
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?></div><!--end of row-->
		
	<?php elseif( 'box' == $layout ) : ?>
	
		<div class="row"><?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'team-box');
					
					if( ($block_query->current_post + 1) % 3 == 0 ){
						echo '</div><div class="row">';
					}
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?></div><!--end of row-->
		
	<?php elseif( 'full' == $layout ) : ?>
	
		<div class="row"><?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'team-full');

				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?></div><!--end of row-->
		
	<?php elseif( 'feed' == $layout ) : ?>

		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content', 'team-feed');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
		?>
		
	<?php elseif( 'grid-extra-small' == $layout ) : ?>
	
		<div class="row mb80 mb-xs-24"><?php 
	        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
	        		
	        		/**
	        		 * Get blog posts by blog layout.
	        		 */
	        		get_template_part('loop/content', 'team-grid-extra-small');
	        		
	        		if( ($block_query->current_post + 1) % 3 == 0 ){
	        			echo '</div><div class="row mb80 mb-xs-24">';
	        		}
	        	
	        	endwhile;	
	        	else : 
	        		
	        		/**
	        		 * Display no posts message if none are found.
	        		 */
	        		get_template_part('loop/content','none');
	        		
	        	endif;
	        ?></div>
	
<?php	
	endif;
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'foundry_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	
	$layouts = ebor_get_team_layouts();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Team Feed", 'foundry'),
			"base" => "foundry_team",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'Add your team posts to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'foundry'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Team Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => $layouts
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');