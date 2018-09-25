<?php 

/**
 * The Shortcode
 */
function ebor_canvas_page_header_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'link' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$img = wp_get_attachment_image_src($image, 'full');
	
	$output = '<div id="large-header" class="large-header demo-1" style="background-image: url('. esc_url($img[0]) .');">';
	$output .= '<canvas id="demo-canvas"></canvas>';
	
	if( $link ){
		$output .= '<h1 class="main-title font3"><a href="'. esc_url($link) .'" class="white"><span class="thin">'. htmlspecialchars_decode($title) .'</span></a></h1>';
	} else {
		$output .= '<h1 class="main-title font3"><span class="thin">'. htmlspecialchars_decode($title) .'</span></h1>';
	}
	
	if( $subtitle ){
		$output .= '<h3 class="main-title font2 white"><span>'. htmlspecialchars_decode($subtitle) .'</span></h3>';	
	}
	
	$output .= '</div>';
	return $output;
}
add_shortcode( 'expose_canvas_page_header', 'ebor_canvas_page_header_shortcode' );

/**
 * The VC Functions
 */
function ebor_canvas_page_header_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Interactive Page Header", 'expose'),
			"base" => "expose_canvas_page_header",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'expose'),
					"param_name" => "subtitle",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Link title? Enter URL.", 'expose'),
					"param_name" => "link",
				),
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'expose'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add images for the page header background', 'expose')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_canvas_page_header_shortcode_vc' );