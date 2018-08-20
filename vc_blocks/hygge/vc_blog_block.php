<?php 

/**
 * The Shortcode
 */
function ebor_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'grid',
				'pppage' => '6',
				'pagination' => 'yes',
				'filter' => 'all'
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
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'post',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>
		
	<?php if( $type == 'grid' ) : ?>
		
		<div class="blog grid-view col3">
		
			<div class="blog-posts text-boxes">
				<div class="isotope row">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'grid');
						
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
			
			<?php
				if( 'yes' == $pagination ){
					/**
					* Post pagination, use ebor_pagination() first and fall back to default
					*/
					echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
				}
			?>
		
		</div>
		
	<?php elseif( $type == 'grid-sidebar' ) : ?>
	
		<div class="blog grid-view col2 row">
		
			<div class="col-sm-8 blog-content">
				<div class="blog-posts text-boxes">
				
					<div class="isotope row">
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content-post', 'grid-sidebar');
							
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
						if( 'yes' == $pagination ){
							/**
							* Post pagination, use ebor_pagination() first and fall back to default
							*/
							echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						}
					?>
				
				</div>
			</div>
			
			<?php get_sidebar(); ?> 
		
		</div>
		
	<?php elseif( $type == 'timeline' ) : ?>
	
		<div class="timeline">
			
			<?php if ( $block_query->have_posts() ) : ?>
			
			<?php
				/**
				 * Get the date of the first post to drive our date tags
				 * Then rewind posts so that we don't skip this one
				 */
				$block_query->the_post();
				$current_month = get_the_time('F Y');
				$block_query->rewind_posts();
				
				echo '<div class="date-title"><span>'. $current_month .'</span></div>';
			?>
		
			<div class="row">
				<?php 
					while ( $block_query->have_posts() ) : $block_query->the_post();
					
						/**
						 * check each subsequent post to see if the month is the same
						 * or has changed and needs to be printed:
						 */
						$this_month = get_the_time('F Y');
						if( $this_month !== $current_month ){
						    $current_month = $this_month;
						    echo '</div><div class="row"><div class="date-title"><span>' . $current_month . '</span></div>';
						}
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'timeline');
					
					endwhile;
				?>
			</div>
			
			<?php 
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif; 
			?>
			
		</div>
		
		<div class="divide30"></div>
		
		<?php
			if( 'yes' == $pagination ){
				/**
				* Post pagination, use ebor_pagination() first and fall back to default
				*/
				echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
			}
		?>
		
	<?php elseif( $type == 'classic' ) : ?>
	
		<div class="blog classic-view row">
			<div class="col-sm-8 col-sm-offset-2 blog-content">
				<div class="blog-posts text-boxes">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'classic');
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
				
					if( 'yes' == $pagination ){
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
					}
				?>
				</div>
			</div>
		</div>
		
	<?php elseif( $type == 'classic-sidebar' ) : ?>
	
		<div class="blog classic-view row">
		
			<div class="col-sm-8 blog-content">
				<div class="blog-posts text-boxes">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'classic');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
						
						if( 'yes' == $pagination ){
							/**
							* Post pagination, use ebor_pagination() first and fall back to default
							*/
							echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						}
					?>
				</div>
			</div>
			
			<?php get_sidebar(); ?>
		
		</div>
	
	<?php elseif( $type == 'classic-boxed' ) : ?>
	
		<div class="blog classic-view row">
			<div class="col-sm-8 col-sm-offset-2 blog-content">
				<div class="blog-posts text-boxes">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'classic-boxed');
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
				
					if( 'yes' == $pagination ){
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
					}
				?>
				</div>
			</div>
		</div>
	
	<?php elseif( $type == 'classic-boxed-sidebar' ) : ?>
	
		<div class="blog classic-view row">
		
			<div class="col-sm-8 blog-content">
				<div class="blog-posts text-boxes">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'classic-boxed');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
						
						if( 'yes' == $pagination ){
							/**
							* Post pagination, use ebor_pagination() first and fall back to default
							*/
							echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						}
					?>
				</div>
			</div>
			
			<?php get_sidebar(); ?>
		
		</div>
		
	<?php elseif( $type == 'carousel' ) : ?>
	
		<div class="carousel-wrapper">
			<div class="carousel carousel-boxed blog">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'carousel');
					
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
add_shortcode( 'hygge_blog', 'ebor_blog_shortcode' );

/**
 * The VC Functions
 */
function ebor_blog_shortcode_vc() {
	
	$blog_types = ebor_get_blog_layouts();
	
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Blog Feeds", 'hygge'),
			"base" => "hygge_blog",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Show blog posts with layout options.',
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
					"value" => $blog_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'hygge'),
					"param_name" => "pagination",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_blog_shortcode_vc');