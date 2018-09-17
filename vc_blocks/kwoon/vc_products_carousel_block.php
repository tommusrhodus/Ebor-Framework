<?php 

/**
 * The Shortcode
 */
function ebor_products_carousel_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'carousel',
				'pppage' => '999',
				'filter' => 'all',
				'filters' => 'yes',
				'more' => 'no',
				'layout' => 'basic'
			), $atts 
		)
	);

	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'product',
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

	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>
	
	<?php if( 'basic' == $layout ) : ?>
	
		<div class="basic-carousel">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content-product', 'carousel');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
		</div>
	
	<?php else : ?>
	
		<div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
			<div class="carousel carousel-boxed3 shop">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-product', 'carousel-alt');
					
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
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'kwoon_products_carousel', 'ebor_products_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_products_carousel_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("WooCommerce Products Carousel", 'kwoon'),
			"base" => "kwoon_products_carousel",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Show product posts in a carousel.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'kwoon'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'kwoon'),
					"param_name" => "layout",
					"value" => array(
						'Basic Carousel' => 'basic',
						'Fading Carousel' => 'fader'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_products_carousel_shortcode_vc');