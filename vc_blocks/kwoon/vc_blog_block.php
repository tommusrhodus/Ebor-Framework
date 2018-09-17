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
			
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
		 
		</div>
		
	<?php elseif( $type == 'carousel' ) : ?>
	
		<div class="blog grid-view-img blog-carousel-wrapper">
			<div class="blog-posts">
				<div class="blog-carousel">
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
		</div>
		
	<?php elseif( $type == 'carousel-detail' ) : ?>
	
		<div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
			<div class="carousel carousel-boxed blog">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'carousel-detail');
					
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
		
	<?php elseif( $type == 'classic' ) : ?>
		
		<div class="blog classic-view no-sidebar">
		
			<div class="blog-posts">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post');
					
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
		
	<?php elseif( $type == 'classic-sidebar' ) : ?>
	
		<div class="blog row classic-view">
		
			<div class="col-sm-8 blog-content">
			
				<div class="blog-posts">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post');
						
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
			
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
		
		</div>
		
	<?php elseif( $type == 'classic-posttypes' ) : ?>
	
		<div class="blog row classic-view post-types">
		
			<div class="col-sm-8 blog-content">
			
				<div class="blog-posts">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post-posttypes');
						
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
			
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
		
		</div>
		
	<?php elseif( $type == 'classic-boxed' ) : ?>
		
		<div class="blog classic-view no-sidebar">
		
			<div class="blog-posts text-boxes">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'boxed');
					
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
		
	<?php elseif( $type == 'classic-boxed-sidebar' ) : ?>
		
		<div class="blog row classic-view">
		
			<div class="col-sm-8 blog-content">
			
				<div class="blog-posts text-boxes">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'boxed');
						
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
			
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
		
		</div>
		
	<?php elseif( $type == 'classic-boxed-sidebar-posttypes' ) : ?>
		
		<div class="blog row classic-view post-types">
		
			<div class="col-sm-8 blog-content">
			
				<div class="blog-posts text-boxes">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'boxed-posttypes');
						
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
			
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
		
		</div>
		
	<?php elseif( $type == 'image' ) : ?>
		
		<div class="blog grid-view-img">
		
			<div class="blog-posts">
				<div class="isotope">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'image');
						
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
		
	<?php elseif( $type == 'list' ) : ?>
		
		<div class="blog list-view">
			<div class="blog-posts">
				<div class="isotope row">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'list');
						
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
		</div>
		
	<?php elseif( $type == 'list-row' ) : ?>
	
		<div class="blog row list-view">
		
			<div class="col-sm-8 blog-content">
			
				<div class="blog-posts">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'list-sidebar');
						
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
			
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
		
		</div>
		
	<?php elseif( $type == 'grid-boxed' ) : ?>
		
		<div class="blog grid-view col3">
		
			<div class="blog-posts text-boxes">
				<div class="isotope row">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'grid-boxed');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
					?>
				</div><!-- /.isotope --> 
			</div><!-- /.blog-posts -->
			
			<?php
				if( 'yes' == $pagination ){
					/**
					* Post pagination, use ebor_pagination() first and fall back to default
					*/
					echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
				}
			?>
		
		</div><!--/.blog-->
		
	<?php elseif( $type == 'grid-boxed-sidebar' ) : ?>
	
		<div class="blog grid-view col2 row">
		
			<div class="col-sm-8 blog-content">
			
				<div class="blog-posts text-boxes">
					<div class="isotope row">
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content-post', 'grid-boxed-sidebar');
							
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
			
			</div><!-- /.blog-content -->
		
			<aside class="col-sm-4 sidebar">
				<?php dynamic_sidebar('primary'); ?> 
			</aside>
			
		</div>
		
	<?php elseif( $type == 'list-row-no-sidebar' ) : ?>
		
		<div class="blog row list-view">
		
			<div class="col-sm-8 col-sm-offset-2 blog-content">
			
				<div class="blog-posts">
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'list-sidebar');
						
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
		
	<?php endif; ?>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'kwoon_blog', 'ebor_blog_shortcode' );

/**
 * The VC Functions
 */
function ebor_blog_shortcode_vc() {
	
	$blog_types = ebor_get_blog_layouts();
	
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Blog Feeds", 'kwoon'),
			"base" => "kwoon_blog",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Show blog posts with layout options.',
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
					"value" => $blog_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'kwoon'),
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