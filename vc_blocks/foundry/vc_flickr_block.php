<?php 

/**
 * The Shortcode
 */
function ebor_flickr_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'user' => '8826848@N03',
				'album' => '72157633398893288'
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
		    <div class="col-sm-12">
		        <ul class="flickr-feed masonry" data-user-id="'. esc_attr($user) .'" data-album-id="'. esc_attr($album) .'"></ul>
		   </div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'foundry_flickr', 'ebor_flickr_shortcode' );

/**
 * The VC Functions
 */
function ebor_flickr_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Flickr Feed", 'foundry'),
			"base" => "foundry_flickr",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Flickr User ID", 'foundry'),
					"param_name" => "user",
					"description" => 'Get ID from here: http://idgettr.com e.g: 8826848@N03',
				),
				array(
					"type" => "textfield",
					"heading" => __("Flickr Album ID", 'foundry'),
					"param_name" => "album",
					"description" => 'Here\'s how to get the album ID: https://weblizar.com/get-flickr-album-id/ e.g: 72157633398893288',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_flickr_shortcode_vc' );