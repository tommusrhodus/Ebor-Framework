<?php 

/**
 * The Shortcode
 */
function ebor_tickera_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'part' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="article-body">' . do_shortcode('[event id="'. $part .'"]') . '</div>';
	
	return $output;
}
add_shortcode( 'meetup_tickera', 'ebor_tickera_shortcode' );

/**
 * The VC Functions
 */
function ebor_tickera_shortcode_vc() {
	
	$query_args = array(
		'post_type' => 'tc_events'
	);
	
	$ids = false;

	$block_query = new WP_Query( $query_args );
	
	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		
		global $post;
		$ids[$post->post_title] = $post->ID;
		
	endwhile;
	endif;
	wp_reset_postdata();

	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Tickera Event", 'meetup'),
			"base" => "meetup_tickera",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Show which tickera event?", 'meetup'),
					"param_name" => "part",
					"value" => $ids
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_tickera_shortcode_vc');