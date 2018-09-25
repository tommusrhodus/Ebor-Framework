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
				'subtitle' => '',
				'colour' => false
			), $atts 
		) 
	);
	
	$img = wp_get_attachment_image_src($image, 'full');
	
	$output = '<article class="text-center page-bg parallax" style="background-image: url('. esc_url($img[0]) .');">';
	
	if($title && !($subtitle))
		$output .= '<h1 class="main-heading font2 dark"><span style="border-color: '. $colour.' !important; color: '. $colour .' !important;">'. trim(strip_tags(htmlspecialchars_decode($title))) .'</span></h1>';
		
	if($title && $subtitle)
		$output .= '<h6 class="dark font3 ebor-font-header" style="border-color: '. $colour.' !important; color: '. $colour .' !important;">'. trim(strip_tags(htmlspecialchars_decode($title))) .'</h6>';
	
	if($subtitle)
		$output .= ebor_expose_seperator(2) . '<h2 class="dark font2" style="border-color: '. $colour.' !important; color: '. $colour .' !important;">'. trim(strip_tags(htmlspecialchars_decode($subtitle))) .'</h2>';
		
	$output .= '</article>';
	return $output;
}
add_shortcode( 'expose_page_header', 'ebor_page_header_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_header_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Page Header", 'expose'),
			"base" => "expose_page_header",
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
					"type" => "attach_image",
					"heading" => __("Background Image", 'expose'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add images for the page header background', 'expose')
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Heading Colour", 'expose'),
					"param_name" => "colour",
					"value" => ''
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_page_header_shortcode_vc' );