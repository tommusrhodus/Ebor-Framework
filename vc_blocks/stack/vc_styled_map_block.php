<?php 

/**
 * The Shortcode
 */
function ebor_styled_map_shortcode( $atts, $content = null ) {
	
	$map_style = '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]';
	
	extract( 
		shortcode_atts( 
			array(
				'api_key' => '',
				'address' => '',
				'style' => $map_style,
				'custom_css_class' => '',
				'zoom' => '15'
			), $atts 
		) 
	);
	
	$final_style = ( $style == $map_style ) ? $style : htmlspecialchars_decode(rawurldecode(base64_decode($style)));
	if( '' == $final_style ){
		$final_style = $map_style;	
	}
	
	$output = '<div class="map-container '. esc_attr($custom_css_class) .'" data-maps-api-key="'. $api_key .'" data-address="'. $address .'" data-marker-title="'. esc_attr($address) .'" data-map-style="'. esc_attr($final_style) .'" data-map-zoom="'. esc_attr($zoom) .'"></div>';
	

	return $output;
}
add_shortcode( 'stack_styled_map', 'ebor_styled_map_shortcode' );

/**
 * The VC Functions
 */
function ebor_styled_map_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Styled Google Map", 'stackwordpresstheme'),
			"base" => "stack_styled_map",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Maps API Key", 'stackwordpresstheme'),
					"param_name" => "api_key",
					"description" => "Follow Google's instructions <a href='https://developers.google.com/maps/documentation/javascript/tutorial#api_key' target='_blank'>here</a> on how to obtain an API key. When you have your key, proceed to the next section to learn how to set up your pages with the API key and the map.",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Street Address", 'stackwordpresstheme'),
					"param_name" => "address",
					"description" => "Enter your desired map location street address.",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Zoom Level", 'stackwordpresstheme'),
					"param_name" => "zoom",
					"description" => "Zoom level of the map, default is 15, numeric only!",
					'value' => '15'
				),
				array(
					"type" => "textarea_raw_html",
					"heading" => esc_html__("Map Custom Style", 'stackwordpresstheme'),
					"param_name" => "style",
					"description" => 'Apply any style from <a href="http://snazzymaps.com">Snazzy Maps</a> or <a href="https://mapstyle.withgoogle.com/">make your own</a>',
					'value' => '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_styled_map_shortcode_vc' );