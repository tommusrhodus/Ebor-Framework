<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'fullwidth',
				'pppage' => '999',
				'filter' => 'all',
				'show_filter' => 1
			), $atts 
		) 
	);
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
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

	<section class="no-pad-bottom projects-gallery">
		<div class="projects-wrapper clearfix">
		
			<?php 
				if( 'contained' == $type )
					echo '<div class="divide60"></div>';
					
				if( 'Yes' == $show_filter ){	
					$cats = get_categories('taxonomy=portfolio_category');
					echo ebor_portfolio_filters($cats); 
				}
			?>
	
			<?php if( 'Fullwidth Portfolio' == $type ) : ?>

				<div class="projects-container">
				
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'portfolio-fullwidth');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
						wp_reset_query();
					?>
				
				</div><!--end of projects-container-->
				
			<?php elseif( '2 Column Fullwidth' == $type ) : ?>
			
				<div class="projects-container">
				
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'portfolio-half');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
						wp_reset_query();
					?>
				
				</div><!--end of projects-container-->
				
			<?php elseif( '4 Column Fullwidth' == $type ) : ?>
			
				<div class="projects-container">
				
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'portfolio-quarter');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
						wp_reset_query();
					?>
				
				</div><!--end of projects-container-->
		
			<?php elseif( 'Contained Portfolio' == $type ) : ?>
				
				<div class="row">
					<div class="projects-container column-projects">
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content', 'portfolio-contained');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
							wp_reset_query();
						?>
					</div><!--end of projects-container-->
				</div>
		
			<?php endif; ?>

		</div><!--end of projects wrapper-->
	</section>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'pivot_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = array(
		'Fullwidth Portfolio',
		'Contained Portfolio',
		'4 Column Fullwidth',
		'2 Column Fullwidth'
	);
	
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Portfolio", 'pivot'),
			"base" => "pivot_portfolio",
			"category" => __('Pivot - Feeds', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'pivot'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'pivot'),
					"param_name" => "type",
					"value" => $portfolio_types,
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'pivot'),
					"param_name" => "show_filter",
					"value" => array(
						'Yes',
						'No'
					),
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');