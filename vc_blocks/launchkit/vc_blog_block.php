<?php 

/**
 * The Shortcode
 */
function ebor_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '10',
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
	
	/**
	 * Finally, here's the query.
	 */
	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>
		
	<?php $class = ( is_active_sidebar('primary') ) ? 'col-md-9' : 'col-md-10 col-md-offset-1'; ?>
	
	<section class="blog">
		<div class="container">
			<div class="row">
				
				<div class="<?php echo esc_attr($class); ?> news-1">
				
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'post');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
						
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
						wp_reset_postdata();
					?>
				</div>
				
				<?php 
					if( is_active_sidebar('primary') ){
						echo '<aside class="col-md-3 hidden-sm">';
						dynamic_sidebar('primary');
						echo '</aside>';
					}
				?>
				
			</div><!--end of row-->
		</div><!--end of container-->
	</section>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_blog', 'ebor_blog_shortcode' );

/**
 * The VC Functions
 */
function ebor_blog_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Blog", 'launchkit'),
			"base" => "launchkit_blog",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'launchkit'),
					"param_name" => "pppage",
					"value" => '8'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_blog_shortcode_vc');