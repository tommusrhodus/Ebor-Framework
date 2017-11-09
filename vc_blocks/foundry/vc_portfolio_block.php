<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'full-grid-3col',
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
	
	<?php if( 'full-grid-3col' == $type ) : ?>
	
		<section class="projects p0 bg-dark">
		
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-grid-3col');
		    		
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
		
	<?php elseif( 'full-grid-2col' == $type ) : ?>
	
		<section class="projects p0 bg-dark">
		
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-grid-2col');
		    		
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
		
	<?php elseif( 'full-grid-4col' == $type ) : ?>
	
		<section class="projects p0 bg-dark">
		
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-grid-4col');
		    		
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
		
	<?php elseif( 'grid-2col' == $type ) : ?>
		
		<section class="projects">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'grid-2col');
			        	
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
		</section>
		
	<?php elseif( 'grid-3col' == $type ) : ?>
		
		<section class="projects">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
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
		        
		    </div>
		</section>
		
	<?php elseif( 'grid-4col' == $type ) : ?>
		
		<section class="projects">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
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
		        
		    </div>
		</section>
		
	<?php elseif( 'masonry-2col' == $type ) : ?>
		
		<section class="projects">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'masonry-2col');
			        	
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
		</section>
		
	<?php elseif( 'masonry-3col' == $type ) : ?>
		
		<section class="projects">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'masonry-3col');
			        	
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
		</section>
		
	<?php elseif( 'masonry-4col' == $type ) : ?>
		
		<section class="projects">
		    <div class="container">

		        <?php 
		        	if( 'Yes' == $show_filter )
		        		get_template_part('inc/content', 'portfolio-filter'); 
		        	
		        	get_template_part('inc/content','post-loader'); 
		        ?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'masonry-4col');
			        	
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
		</section>
		
	<?php elseif( 'full-masonry-2col' == $type ) : ?>
	
		<section class="projects p0 bg-dark">
			
			<?php 
				if( 'Yes' == $show_filter )
					get_template_part('inc/content', 'portfolio-filter-full'); 
				
				get_template_part('inc/content','post-loader-full'); 
			?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-masonry-2col');
		    		
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
		
	<?php elseif( 'full-masonry-3col' == $type ) : ?>
	
		<section class="projects p0 bg-dark">
			
			<?php 
				if( 'Yes' == $show_filter )
					get_template_part('inc/content', 'portfolio-filter-full'); 
				
				get_template_part('inc/content','post-loader-full'); 
			?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-masonry-3col');
		    		
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
		
	<?php elseif( 'full-masonry-4col' == $type ) : ?>
	
		<section class="projects p0 bg-dark">
			
			<?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-masonry-4col');
		    		
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
		
	<?php elseif( 'parallax' == $type ) : ?>
	
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content-portfolio', 'parallax');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
		?>
		
	<?php elseif( 'parallax-large' == $type ) : ?>
	
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content-portfolio', 'parallax-large');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
		?>
		
	<?php elseif( 'preview-2col' == $type ) : ?>
	
		<section class="projects bg-secondary p0 pt64 preview-portfolio">
		    
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    	get_template_part('inc/content','post-loader'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		        <?php 
		        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		        		
		        		/**
		        		 * Get blog posts by blog layout.
		        		 */
		        		get_template_part('loop/content-portfolio', 'preview-2col');
		        	
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
	
	<?php elseif( 'preview-3col' == $type ) : ?>
	
		<section class="projects bg-secondary p0 pt64 preview-portfolio">
		    
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    	get_template_part('inc/content','post-loader'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		        <?php 
		        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		        		
		        		/**
		        		 * Get blog posts by blog layout.
		        		 */
		        		get_template_part('loop/content-portfolio', 'preview-3col');
		        	
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
	
	<?php elseif( 'preview-4col' == $type ) : ?>
	
		<section class="projects bg-secondary p0 pt64 preview-portfolio">
		    
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    	get_template_part('inc/content','post-loader'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		        <?php 
		        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		        		
		        		/**
		        		 * Get blog posts by blog layout.
		        		 */
		        		get_template_part('loop/content-portfolio', 'preview-4col');
		        	
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
		
	<?php elseif( 'full-grid-3col-no-hover' == $type ) : ?>
		
		<section class="projects p0 bg-dark no-hover">
		
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-grid-3col');
		    		
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
		
	<?php elseif( 'full-grid-2col-no-hover' == $type ) : ?>
	
		<section class="projects p0 bg-dark no-hover">
		
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-grid-2col');
		    		
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
		
	<?php elseif( 'full-grid-4col-no-hover' == $type ) : ?>
	
		<section class="projects p0 bg-dark no-hover">
		
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-grid-4col');
		    		
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
		
	<?php elseif( 'grid-2col-no-hover' == $type ) : ?>
		
		<section class="projects no-hover">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'grid-2col');
			        	
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
		</section>
		
	<?php elseif( 'grid-3col-no-hover' == $type ) : ?>
		
		<section class="projects no-hover">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
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
		        
		    </div>
		</section>
		
	<?php elseif( 'grid-4col-no-hover' == $type ) : ?>
		
		<section class="projects no-hover">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
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
		        
		    </div>
		</section>
		
	<?php elseif( 'masonry-2col-no-hover' == $type ) : ?>
		
		<section class="projects no-hover">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'masonry-2col');
			        	
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
		</section>
		
	<?php elseif( 'masonry-3col-no-hover' == $type ) : ?>
		
		<section class="projects no-hover">
		    <div class="container">
		    
		    	<?php 
		    		if( 'Yes' == $show_filter )
		    			get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    		get_template_part('inc/content','post-loader'); 
		    	?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'masonry-3col');
			        	
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
		</section>
		
	<?php elseif( 'masonry-4col-no-hover' == $type ) : ?>
		
		<section class="projects no-hover">
		    <div class="container">

		        <?php 
		        	if( 'Yes' == $show_filter )
		        		get_template_part('inc/content', 'portfolio-filter'); 
		        	
		        	get_template_part('inc/content','post-loader'); 
		        ?>
		        
		        <div class="row masonry masonryFlyIn">
			        <?php 
			        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			        		
			        		/**
			        		 * Get blog posts by blog layout.
			        		 */
			        		get_template_part('loop/content-portfolio', 'masonry-4col');
			        	
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
		</section>
		
	<?php elseif( 'full-masonry-2col-no-hover' == $type ) : ?>
	
		<section class="projects p0 bg-dark no-hover">
			
			<?php 
				if( 'Yes' == $show_filter )
					get_template_part('inc/content', 'portfolio-filter-full'); 
				
				get_template_part('inc/content','post-loader-full'); 
			?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-masonry-2col');
		    		
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
		
	<?php elseif( 'full-masonry-3col-no-hover' == $type ) : ?>
	
		<section class="projects p0 bg-dark no-hover">
			
			<?php 
				if( 'Yes' == $show_filter )
					get_template_part('inc/content', 'portfolio-filter-full'); 
				
				get_template_part('inc/content','post-loader-full'); 
			?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-masonry-3col');
		    		
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
		
	<?php elseif( 'full-masonry-4col-no-hover' == $type ) : ?>
	
		<section class="projects p0 bg-dark no-hover">
			
			<?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter-full'); 
		    	
		    	get_template_part('inc/content','post-loader-full'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		    	<?php 
		    		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    			
		    			/**
		    			 * Get blog posts by blog layout.
		    			 */
		    			get_template_part('loop/content-portfolio', 'full-masonry-4col');
		    		
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
		
	<?php elseif( 'preview-2col-no-hover' == $type ) : ?>
	
		<section class="projects bg-secondary p0 pt64 preview-portfolio no-hover">
		    
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    	get_template_part('inc/content','post-loader'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		        <?php 
		        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		        		
		        		/**
		        		 * Get blog posts by blog layout.
		        		 */
		        		get_template_part('loop/content-portfolio', 'preview-2col');
		        	
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
	
	<?php elseif( 'preview-3col-no-hover' == $type ) : ?>
	
		<section class="projects bg-secondary p0 pt64 preview-portfolio no-hover">
		    
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    	get_template_part('inc/content','post-loader'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		        <?php 
		        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		        		
		        		/**
		        		 * Get blog posts by blog layout.
		        		 */
		        		get_template_part('loop/content-portfolio', 'preview-3col');
		        	
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
	
	<?php elseif( 'preview-4col-no-hover' == $type ) : ?>
	
		<section class="projects bg-secondary p0 pt64 preview-portfolio no-hover">
		    
		    <?php 
		    	if( 'Yes' == $show_filter )
		    		get_template_part('inc/content', 'portfolio-filter'); 
		    		
		    	get_template_part('inc/content','post-loader'); 
		    ?>
		    
		    <div class="row masonry masonryFlyIn">
		        <?php 
		        	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		        		
		        		/**
		        		 * Get blog posts by blog layout.
		        		 */
		        		get_template_part('loop/content-portfolio', 'preview-4col');
		        	
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
add_shortcode( 'foundry_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = ebor_get_portfolio_layouts();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Portfolio", 'foundry'),
			"base" => "foundry_portfolio",
			"category" => __('Foundry WP Theme', 'foundry'),
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
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'foundry'),
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