<?php 

/**
 * The Shortcode
 */
function ebor_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'grid',
				'pppage' => '10',
				'filter' => 'all',
				'pagination' => 'no'
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
	
	<?php if( 'grid' == $type ) : ?>
		
		<div class="row mb40">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();

					if( $block_query->current_post % 3 == 0 && !( $block_query->current_post == 0 ) ){
						echo '</div><div class="row mb40">';
					}
					
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
		
		<?php
			if( 'yes' == $pagination ){
				/**
				* Post pagination, use ebor_pagination() first and fall back to default
				*/
				echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
			}
		?>
		
	<?php elseif( 'simple' == $type ) : ?>
		
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content-post', 'feed');
			
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
		
	<?php elseif( 'sidebar-left' == $type ) : ?>
		
		<div class="row">
			
			<?php get_sidebar(); ?>
			
		    <div class="col-md-9 mb-xs-24">
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
		    		
		    		if( 'yes' == $pagination ){
		    			/**
		    			* Post pagination, use ebor_pagination() first and fall back to default
		    			*/
		    			echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
		    		}
		    	?>
		    </div> 
		    
		</div>
		
	<?php elseif( 'sidebar-right' == $type ) : ?>
		
		<div class="row">
			
		    <div class="col-md-9 mb-xs-24">
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
		    		
		    		if( 'yes' == $pagination ){
		    			/**
		    			* Post pagination, use ebor_pagination() first and fall back to default
		    			*/
		    			echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
		    		}
		    	?>
		    </div> 
		    
		    <?php get_sidebar(); ?>
		    
		</div>
		
	<?php elseif( 'listing' == $type ) : ?>
		
		<div class="row">
		    <div class="col-md-10 col-md-offset-1">
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
		    		
		    		if( 'yes' == $pagination ){
		    			/**
		    			* Post pagination, use ebor_pagination() first and fall back to default
		    			*/
		    			echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
		    		}
		    	?>
		    </div>
		</div>
		
	<?php elseif( 'masonry-sidebar-left' == $type ) : ?>
		
		<div class="row">
			
		    	<?php get_sidebar(); ?>
		    
		        <div class="col-md-9">
		        
		            <?php get_template_part('inc/content','post-loader'); ?>
		            
		            <div class="row masonry masonryFlyIn mb40">
		                <?php 
		                	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		                		
		                		/**
		                		 * Get blog posts by blog layout.
		                		 */
		                		get_template_part('loop/content-post', 'masonry-2col');
		                	
		                	endwhile;	
		                	else : 
		                		
		                		/**
		                		 * Display no posts message if none are found.
		                		 */
		                		get_template_part('loop/content','none');
		                		
		                	endif;
		                ?>
		            </div>
		
		            <div class="row">
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
		    
		    </div>
		    
	<?php elseif( 'masonry-sidebar-right' == $type ) : ?>
		
		<div class="row">

	        <div class="col-md-9">
	        
	            <?php get_template_part('inc/content','post-loader'); ?>
	            
	            <div class="row masonry masonryFlyIn mb40">
	                <?php 
	                	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
	                		
	                		/**
	                		 * Get blog posts by blog layout.
	                		 */
	                		get_template_part('loop/content-post', 'masonry-2col');
	                	
	                	endwhile;	
	                	else : 
	                		
	                		/**
	                		 * Display no posts message if none are found.
	                		 */
	                		get_template_part('loop/content','none');
	                		
	                	endif;
	                ?>
	            </div>
	
	            <div class="row">
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
	    
	<?php elseif( 'masonry-3col' == $type ) : ?>
		    
		<?php get_template_part('inc/content','post-loader'); ?>
		
		<div class="row masonry masonryFlyIn mb40">
		    <?php 
		    	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    		
		    		/**
		    		 * Get blog posts by blog layout.
		    		 */
		    		get_template_part('loop/content-post', 'masonry-3col');
		    	
		    	endwhile;	
		    	else : 
		    		
		    		/**
		    		 * Display no posts message if none are found.
		    		 */
		    		get_template_part('loop/content','none');
		    		
		    	endif;
		    ?>
		</div>
		
		<div class="row">
		    <?php
		    	if( 'yes' == $pagination ){
		    		/**
		    		* Post pagination, use ebor_pagination() first and fall back to default
		    		*/
		    		echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
		    	}
		    ?>
		</div>
		
	<?php elseif( 'masonry-2col' == $type ) : ?>
		    
		<?php get_template_part('inc/content','post-loader'); ?>
		
		<div class="row masonry masonryFlyIn mb40">
		    <?php 
		    	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    		
		    		/**
		    		 * Get blog posts by blog layout.
		    		 */
		    		get_template_part('loop/content-post', 'masonry-2col');
		    	
		    	endwhile;	
		    	else : 
		    		
		    		/**
		    		 * Display no posts message if none are found.
		    		 */
		    		get_template_part('loop/content','none');
		    		
		    	endif;
		    ?>
		</div>
		
		<div class="row">
		    <?php
		    	if( 'yes' == $pagination ){
		    		/**
		    		* Post pagination, use ebor_pagination() first and fall back to default
		    		*/
		    		echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
		    	}
		    ?>
		</div>
		
	<?php elseif( 'box' == $type ) : ?>
		
		<div class="row masonry">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content-post', 'box');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
		</div>
		
		<div class="row">
			<?php
				if( 'yes' == $pagination ){
					/**
					* Post pagination, use ebor_pagination() first and fall back to default
					*/
					echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
				}
			?>
		</div>
		
	<?php elseif( 'grid-sidebar-right' == $type ) : ?>
		
		<div class="row">
			
			<div class="col-md-9 col-sm-12">
			
				<div class="row mb40">
				    <?php 
				    	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				    		
				    		if( $block_query->current_post % 2 == 0 && !( $block_query->current_post == 0 ) ){
				    			echo '</div><div class="row mb40">';
				    		}
				    		
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
				
				<div class="row">
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
		
	<?php elseif( 'grid-sidebar-left' == $type ) : ?>
		
		<div class="row">
			
			<?php get_sidebar(); ?>
			
			<div class="col-md-9 col-sm-12">
			
				<div class="row mb40">
				    <?php 
				    	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				    		
				    		if( $block_query->current_post % 2 == 0 && !( $block_query->current_post == 0 ) ){
				    			echo '</div><div class="row mb40">';
				    		}
				    		
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
				
				<div class="row">
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
		
		</div>
		
	<?php elseif( 'carousel' == $type ) : ?>
		
		<section class="p0 bg-dark">
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
		</section>
		
	<?php endif; ?>
			
<?php	
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'foundry_blog', 'ebor_blog_shortcode' );

/**
 * The VC Functions
 */
function ebor_blog_shortcode_vc() {
	
	$blog_types = ebor_get_blog_layouts();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Blog", 'foundry'),
			"base" => "foundry_blog",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'Adds blog feeds to your page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'foundry'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'foundry'),
					"param_name" => "type",
					"value" => $blog_types
				),
				array(
					'type' => 'dropdown',
					'heading' => "Show Pagination?",
					'param_name' => 'pagination',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					)
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_blog_shortcode_vc');