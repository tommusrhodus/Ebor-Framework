<?php 

/**
 * The Shortcode
 */
function ebor_faq_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '8',
				'filter' => 'all',
				'part' => 'excerpt'
			), $atts 
		) 
	);
	
	$query_args = array(
		'post_type' => 'faq',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'faq_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'faq_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>
	
	<div class="row">
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content-faq', $part);
			
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
	
	<?php 
		/**
		* Post pagination, use ebor_pagination() first and fall back to default
		*/
		echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
	?>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'meetup_faq', 'ebor_faq_shortcode' );

/**
 * The VC Functions
 */
function ebor_faq_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("faqs", 'meetup'),
			"base" => "meetup_faq",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'meetup'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show the FAQ Excerpt or full Content?", 'meetup'),
					"param_name" => "part",
					"value" => array(
						'Excerpt' => 'excerpt',
						'Full Content' => 'content'
					)
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_faq_shortcode_vc');