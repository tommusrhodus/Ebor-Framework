<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'grid-3col',
				'pppage' => '999',
				'filter' => 'all',
				'filters' => 'yes',
				'more' => 'no'
			), $atts 
		)
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage,
		'paged' => $paged
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

	$block_query = new WP_Query( $query_args );
	
	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}
	
	ob_start();
?>
	
	<?php if( 'grid-detail' == $type ) : ?>
		
		<div class="cbp-panel">
		
			<?php if( 'yes' == $filters && !( is_tax() ) ): ?>
				<div id="filters-container" class="cbp-filter-container text-center">
					<div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> <?php _e('All','hygge'); ?> </div>
					<?php
						if( $filter == 'all' ){
							$cats = get_categories('taxonomy=portfolio_category');
						} else {
							$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
						}
						if(is_array($cats)){
							foreach($cats as $cat){
								echo '<div data-filter=".'. esc_attr($cat->slug) .'" class="cbp-filter-item"> '. $cat->name .' </div> ';
							}
						}
					?>
				</div>
			<?php endif; ?>
			
			<div id="grid-container" class="cbp ebor-load-more">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-portfolio', 'grid-detail');
					
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
				if( 'yes' == $more )
					echo ebor_load_more($block_query->max_num_pages); 
			?>
			
		</div>	
	
	<?php elseif( 'grid-4col' == $type ) : ?>	
	
		<div class="cbp-panel">
		
			<?php if( 'yes' == $filters && !( is_tax() ) ): ?>
				<div id="filters-container2" class="cbp-filter-container text-center">
					<div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> <?php _e('All','hygge'); ?> </div>
					<?php
						if( $filter == 'all' ){
							$cats = get_categories('taxonomy=portfolio_category');
						} else {
							$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
						}
						if(is_array($cats)){
							foreach($cats as $cat){
								echo '<div data-filter=".'. esc_attr($cat->slug) .'" class="cbp-filter-item"> '. $cat->name .' </div> ';
							}
						}
					?>
				</div>
			<?php endif; ?>
			
			<div id="grid-container2" class="cbp cbp-below ebor-load-more">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-portfolio', 'grid-4col');
					
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
				if( 'yes' == $more )
					echo ebor_load_more($block_query->max_num_pages); 
			?>
		
		</div>
		
	<?php elseif( 'grid-3col' == $type ) : ?>
	
		<div class="cbp-panel">
			
			<?php if( 'yes' == $filters && !( is_tax() ) ): ?>
				<div id="filters-container" class="cbp-filter-container text-center">
					<div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> <?php _e('All','hygge'); ?> </div>
					<?php
						if( $filter == 'all' ){
							$cats = get_categories('taxonomy=portfolio_category');
						} else {
							$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
						}
						if(is_array($cats)){
							foreach($cats as $cat){
								echo '<div data-filter=".'. esc_attr($cat->slug) .'" class="cbp-filter-item"> '. $cat->name .' </div> ';
							}
						}
					?>
				</div>
			<?php endif; ?>
			
			<div id="grid-container" class="cbp ebor-load-more">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-portfolio', 'grid-3col');
					
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
				if( 'yes' == $more )
					echo ebor_load_more($block_query->max_num_pages); 
			?>
		
		</div>
				
	<?php elseif( 'carousel' == $type ) : ?>
	
		<div class="carousel-wrapper">
			<div class="carousel carousel-boxed portfolio">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-portfolio', 'carousel');
					
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
add_shortcode( 'hygge_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = ebor_get_portfolio_layouts();

	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Portfolio Feeds", 'hygge'),
			"base" => "hygge_portfolio",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Show portfolio posts in the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'hygge'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'hygge'),
					"param_name" => "type",
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'hygge'),
					"param_name" => "filters",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show load more button? (if enough posts load)", 'hygge'),
					"param_name" => "more",
					"value" => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');