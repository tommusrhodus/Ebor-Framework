<?php 

/**
 * The Shortcode
 */
function ebor_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'list',
				'pppage' => '6',
				'pagination' => 'yes'
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

	$block_query = new WP_Query( $query_args );
	
	$class = (is_active_sidebar('primary')) ? 'col-md-8 col-sm-12' : 'col-sm-12';
	
	ob_start();
?>

	<?php if( $type == 'list' ) : ?>
		
		<div class="container inner">
			<div class="blog list-view row">
			
				<div class="<?php echo esc_attr($class); ?> content">
				
					<div class="blog-posts">
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content', 'post-list');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
						?>
					</div><!-- /.blog-posts -->
					
					<?php
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						wp_reset_query();
					?>
				
				</div><!-- /.content -->
				
				<?php get_sidebar(); ?>
				
			</div><!-- /.blog --> 
		</div>
		
	<?php elseif( $type == 'grid' ) : ?>
	
		<div class="container inner">
			<div class="blog grid-view row">
			
				<div class="<?php echo esc_attr($class); ?> content">
				
					<div class="blog-posts">
						<div class="isotope row">
							<?php 
								if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
									
									/**
									 * Get blog posts by blog layout.
									 */
									get_template_part('loop/content', 'post-grid');
								
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
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						wp_reset_query();
					?>
				
				</div><!-- /.content -->
				
				<?php get_sidebar(); ?>
				
			</div><!-- /.blog --> 
		</div>
	
	<?php elseif( $type == 'classic' ) : ?>
		
		<div class="container inner">
			<div class="blog classic-view row">
			
				<div class="<?php echo esc_attr($class); ?> content">
				
					<div class="blog-posts">
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content', 'post-classic');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
						?>
					</div><!-- /.blog-posts -->
				
					<?php
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						wp_reset_query();
					?>
				
				</div><!-- /.content -->
				
				<?php get_sidebar(); ?>
			
			</div><!-- /.blog --> 
		</div><!-- /.container --> 
		
	<?php endif; ?>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'lumos_blog', 'ebor_blog_shortcode' );

/**
 * The VC Functions
 */
function ebor_blog_shortcode_vc() {
	
	$blog_types = ebor_get_blog_layouts();
	
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Blog Feeds", 'lumos'),
			"base" => "lumos_blog",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'Show blog posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'lumos'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'lumos'),
					"param_name" => "type",
					"value" => $blog_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'lumos'),
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