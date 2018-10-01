<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'curtain',
				'pppage' => '999',
				'show_filter' => 'Yes',
				'filter' => 'all',
				'lightbox' => 'off'
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
	
	<?php if( 'curtain' == $type ) : ?>
		
		<div id="pagepiling" class="pagepiling showcase-01 fullheight" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-curtain');
				
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
		
		<script type="text/javascript">
			jQuery(window).load(function(){
				"use strict";
				
				jQuery('#pagepiling').pagepiling({
					menu: null,
					direction: 'vertical',
					verticalCentered: true,
					sectionsColor: [],
					anchors: [],
					scrollingSpeed: 700,
					easing: 'swing',
					loopBottom: false,
					loopTop: false,
					css3: true,
					navigation: {
					  'textColor': '#000',
					  'bulletsColor': '#000',
					  'position': 'right',
					  'tooltips': ['', '', '', '']
					},
					normalScrollElements: null,
					normalScrollElementTouchThreshold: 5,
					touchSensitivity: 5,
					keyboardScrolling: true,
					sectionSelector: '.section',
					animateAnchor: false,
					
					//events
					onLeave: function(index, nextIndex, direction){},
					afterLoad: function(anchorLink, index){},
					afterRender: function(){},
				});
			});	
		</script>
		
	<?php elseif( 'parallax' == $type ) : ?>
		
		<div id="parallax-showcase" class="parallax-showcase showcase-03" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
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
		</div>
		
	<?php elseif( 'split-scroll' == $type ) : ?>
		
		<div id="content" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div class="container fullwidth-forced">
				<div id="myContainer" class="showcase-02">
				
					<div class="ms-left">
						<?php 
							$i = 0;
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							$i++;
							
							if( $i % 2 == 0 )
								continue;
									
									/**
									 * Get blog posts by blog layout.
									 */
									get_template_part('loop/content', 'portfolio-split-scroll');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
						?> 
					</div>
					
					<div class="ms-right">
						<?php
							$i = 0; 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							$i++;
							
							if(!( $i % 2 == 0 ))
								continue;
									
									/**
									 * Get blog posts by blog layout.
									 */
									get_template_part('loop/content', 'portfolio-split-scroll');
							
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
				
				</div><!-- myContainer ends -->
			</div><!-- end container -->
		</div>
		
		<script type="text/javascript">
			jQuery(window).load(function(){
				"use strict";
					
				jQuery('#myContainer').multiscroll({
		        	menu: '#menu',
		        	navigation: true,
		        	navigationTooltips: ['', '', ''],
		        	loopBottom: true,
		        	loopTop: true
		        });
				
				jQuery('.ms-section').mouseenter(function(){
				    jQuery(this).find('.ms-overlay').fadeIn(1000);
				});
				jQuery('.ms-section').mouseleave(function(){
				    jQuery('.ms-overlay').fadeOut(500);
				});
			
			});
		</script>
		
	<?php elseif( 'bordered' == $type ) : ?>
		
		<div class="sticky-panel sticky-panel-top white-bg"></div>
		<div class="sticky-panel sticky-panel-right white-bg"></div>
		<div class="sticky-panel sticky-panel-left white-bg"></div>
		<div class="sticky-panel sticky-panel-bottom white-bg"></div>
		
		<div id="pagepiling" class="pagepiling pagepiling fullheight showcase-08" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-bordered');
				
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
		
		<script type="text/javascript">
			jQuery(window).load(function(){
				"use strict";
				
				jQuery('#pagepiling').pagepiling({
					menu: null,
					direction: 'vertical',
					verticalCentered: true,
					sectionsColor: [],
					anchors: [],
					scrollingSpeed: 700,
					easing: 'swing',
					loopBottom: false,
					loopTop: false,
					css3: true,
					navigation: {
					  'textColor': '#000',
					  'bulletsColor': '#000',
					  'position': 'right',
					  'tooltips': ['', '', '', '']
					},
					normalScrollElements: null,
					normalScrollElementTouchThreshold: 5,
					touchSensitivity: 5,
					keyboardScrolling: true,
					sectionSelector: '.section',
					animateAnchor: false,
					
					//events
					onLeave: function(index, nextIndex, direction){},
					afterLoad: function(anchorLink, index){},
					afterRender: function(){},
				});
			});	
		</script>
		
	<?php elseif( 'carousel' == $type ) : ?>
		
		<div class="showcase05-carousel owl-carousel" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
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
		
	<?php elseif( 'masonry' == $type ) : ?>
		
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div id="works-container" class="works-container works-masonry-container white-bg container clearfix ebor-masonry" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
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
		
	<?php elseif( 'random' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div id="random-grid" class="random-grid portfolio-02 ebor-masonry" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div id="random-grid-container">
				<div class="gutter-sizer"></div>
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'portfolio-random');
					
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
		</div>
		
	<?php elseif( 'tiles' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div id="works-container" class="works-container tiled-grid-container white-bg clearfix" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'portfolio-tiles');
				
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
		
	<?php elseif( 'grid' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div id="works-container" class="works-container works-grid-container white-bg ebor-masonry no-border container clearfix" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
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
		
	<?php elseif( 'wall' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div class="container" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div id="wall-showcase" class="wall-showcase">
				<?php 
					global $ebor_wall_count;
					$ebor_wall_count = 0;
					
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						$ebor_wall_count++;
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'portfolio-wall');
					
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
		</div>
		
	<?php elseif( 'wall-showcase' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
	
		<div class="container" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div id="wall-showcase" class="wall-showcase">
				<?php 
					global $ebor_wall_count;
					$ebor_wall_count = 0;
					
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						$ebor_wall_count++;
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'portfolio-wall-showcase');
					
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
		</div>
		
	<?php elseif( 'parallax-thumbs' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div id="parallax-random-grid" class="parallax-random-grid portfolio-02" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div id="parallax-random-grid-container" class="container">
			
				<div class="gutter-sizer"></div>
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'portfolio-random-parallax');
					
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
		</div>
		
	<?php elseif( 'reel' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div class="container" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div id="reel-portfolio" class="reel-portfolio">
				<?php 
					global $ebor_wall_count;
					$ebor_wall_count = 0;
					
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						$ebor_wall_count++;
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'portfolio-reel');
					
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
		</div>
		
	<?php elseif( 'stack' == $type ) : ?>
	
		<?php
			if( 'Yes' == $show_filter ){
				echo ebor_portfolio_filters($cats);
			}
		?>
		
		<div id="stack-grid" class="stack-grid portfolio-04 ebor-masonry" data-lightbox-on="<?php echo esc_attr($lightbox); ?>">
			<div id="stack-grid-container" class="container">
			
				<div class="gutter-sizer"></div>
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'portfolio-stack');
					
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
		</div>
		
	<?php endif; ?>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'uber_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = ebor_get_portfolio_layouts();
	
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Portfolio", 'uber'),
			'description' => __('Adds a layout of portfolio posts to the page', 'uber'),
			"base" => "uber_portfolio",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'uber'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'uber'),
					"param_name" => "type",
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'uber'),
					"param_name" => "show_filter",
					"value" => array(
						'Yes',
						'No'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Toggle Lightbox", 'uber'),
					"description" => __("Disable portfolio posts and show featured images in lightbox?", 'uber'),
					"param_name" => "lightbox",
					"value" => array(
						'No, use standard single posts on click' => 'off',
						'Yes, use lightbox for images on click' => 'on'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');