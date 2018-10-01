<?php 

/**
 * The Shortcode
 */
function ebor_page_header_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$image_url = wp_get_attachment_image_src($image, 'full');
	if(!( isset($image_url[0]) ))
		$image_url[0] = false;
		
	$output = ebor_page_title( $image_url[0], trim(strip_tags($title)), trim(strip_tags($subtitle)) );
	return $output;
}
add_shortcode( 'uber_page_header', 'ebor_page_header_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_header_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Page Header", 'uber'),
			'description' => __('Adds a parallax page header to the layout', 'uber'),
			"base" => "uber_page_header",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'uber'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'uber'),
					"param_name" => "subtitle",
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'uber'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add an image for the page header background', 'uber')
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_page_header_shortcode_vc' );