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
				'filter' => 'all'
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
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
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

	<?php
		if( 'large' == $type ) :
			?>
					
			<div class="col-md-8 col-md-offset-2 col-sm-12">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
	
						get_template_part('loop/content','team-large');
						
						if( ($block_query->current_post + 1) % 2 == 0 )
							echo '<div class="clearfix"></div>';
							
					endwhile;
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
					wp_reset_query();
				?>
			</div>
			
		<?php elseif( 'tiny' == $type ) : ?>
				
			<div class="team-1">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
	
						get_template_part('loop/content','team-tiny');
						
						if( ($block_query->current_post + 1) % 4 == 0 )
							echo '<div class="clearfix"></div>';
							
					endwhile;
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
					wp_reset_query();
				?>
			</div>
					
		<?php else : ?>
			
			<div class="space-bottom-large team-1"> 
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
	
						get_template_part('loop/content','team-small');
						
						if( ($block_query->current_post + 1) % 3 == 0 )
							echo '<div class="clearfix"></div>';
							
					endwhile;
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
					wp_reset_query();
				?>
			</div>
					
		<?php
			endif;
	?>	
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'pivot_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	
	$portfolio_types = array(
		'large' => 'Large (2 Columns)',
		'small' => 'Small (3 Columns)',
		'tiny' => 'Tiny (4 Columns)'
	);
	
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Team", 'pivot'),
			"base" => "pivot_team",
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
					"value" => array_flip($portfolio_types),
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');