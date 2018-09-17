<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'carousel',
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
	
	<?php if( 'carousel' == $type ) : ?>
	
		<div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
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
		
	<?php elseif( 'grid3' == $type ) : ?>
		
		<div class="portfolio-grid col3">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'grid');
						
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'grid4' == $type ) : ?>
		
		<div class="portfolio-grid col4">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'grid');
						
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'full' == $type ) : ?>
		
		<div class="portfolio-grid fullscreen-portfolio">
		
			<div class="container bp20">
				<?php 
					if( 'yes' == $filters ){
						if( !( empty($cats) ) ){
							echo ebor_portfolio_filters($cats); 
						} 
					}
				?>
			</div>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'full');
						
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
						ebor_load_more($block_query->max_num_pages); 
				?>
				
			</div>
			
		</div>
		
	<?php elseif( 'grid3-detail' == $type ) : ?>
	
		<div class="portfolio-grid detailed col3">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'grid4-detail' == $type ) : ?>
	
		<div class="portfolio-grid detailed col4">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'grid3-detail-no-lightbox' == $type ) : ?>
	
		<div class="portfolio-grid detailed col3">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'grid-detail-no-lightbox');
						
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'grid4-detail-no-lightbox' == $type ) : ?>
	
		<div class="portfolio-grid detailed col4">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'grid-detail-no-lightbox');
						
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'masonry' == $type ) : ?>
		
		<div class="portfolio-grid col3">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'masonry');
						
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
						ebor_load_more($block_query->max_num_pages); 
				?>
			
			</div>
		
		</div>
		
	<?php elseif( 'isotope' == $type ) : ?>
	
		<div class="portfolio-grid masonry-portfolio">
		
			<?php 
				if( 'yes' == $filters ){
					if( !( empty($cats) ) ){
						echo ebor_portfolio_filters($cats); 
					} 
				}
			?>
			
			<div class="items-wrapper">
			
				<div class="isotope items">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-portfolio', 'isotope');
						
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
						ebor_load_more($block_query->max_num_pages); 
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
add_shortcode( 'kwoon_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = ebor_get_portfolio_layouts();

	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Portfolio Feeds", 'kwoon'),
			"base" => "kwoon_portfolio",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Show portfolio posts in the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'kwoon'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'kwoon'),
					"param_name" => "type",
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'kwoon'),
					"param_name" => "filters",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show load more button? (if enough posts load)", 'kwoon'),
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