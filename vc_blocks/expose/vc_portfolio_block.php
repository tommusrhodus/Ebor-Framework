<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'masonry',
				'pppage' => '999',
				'show_filter' => 'Yes',
				'filter' => 'all'
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
	
	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}
	
	ob_start();
?>

	<?php if( 'masonry' == $type ) : ?>
		
		<?php if( 'Yes' == $show_filter ) : ?>
			<div class="row">
				<article class="col-md-10 col-md-offset-1 text-center">
					<?php 
						echo ebor_portfolio_filters($cats); 
						echo ebor_expose_seperator(1); 
					?>
				</article>
			</div>
		<?php endif; ?>
			
		<div id="works-container" class="works-container white-bg container clearfix">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-masonry');
				
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
		
	<?php elseif( 'masonry-alt' == $type ) : ?>
	
		<div id="works-container" class="works-container intro-03-wrap white-bg clearfix">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-masonry');
				
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
		
	<?php elseif( 'parallax' == $type ) : ?>
	
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-parallax');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
				wp_reset_query();
			?>
			
	<?php elseif( 'parallax-alt' == $type ) : ?>
	
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-parallax-alt');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
				wp_reset_query();
			?>
			
	<?php elseif( 'carousel' == $type ) : ?>
	
		<div class="showcase-carousel standard-showcase owl-carousel">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-carousel');
				
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
		
	<?php elseif( 'carousel-alt' == $type ) : ?>
	
		<div class="showcase-carousel alt-showcase owl-carousel">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-carousel');
				
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
		
	<?php elseif( 'carousel-full' == $type ) : ?>
	
		<div class="intro09-carousel alt-showcase owl-carousel">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-carousel-full');
				
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
		
		<?php if( 'Yes' == $show_filter ) : ?>
			<div class="row">
				<article class="col-md-10 col-md-offset-1 text-center">
					<?php 
						echo ebor_portfolio_filters($cats); 
						echo ebor_expose_seperator(1); 
					?>
				</article>
			</div>
		<?php endif; ?>
		
		<div id="works-container" class="works-container white-bg container clearfix">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-grid');
				
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
		
	<?php endif; ?>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'expose_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = array(
		'Masonry Portfolio' => 'masonry',
		'Alt Masonry Portfolio' => 'masonry-alt',
		'Grid Portfolio' => 'grid',
		'Parallax Portfolio' => 'parallax',
		'Alt Parallax Portfolio' => 'parallax-alt',
		'Carousel Portfolio' => 'carousel',
		'Alt Carousel Portfolio' => 'carousel-alt',
		'Fullscreen Carousel Portfolio' => 'carousel-full'
	);
	
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Portfolio", 'expose'),
			"base" => "expose_portfolio",
			"category" => __('Expose WP Theme', 'Expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'Expose'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'Expose'),
					"param_name" => "type",
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'Expose'),
					"param_name" => "show_filter",
					"value" => array(
						'Yes',
						'No'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');