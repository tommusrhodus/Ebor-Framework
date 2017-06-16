<?php 

/**
 * The Shortcode
 */
function ebor_text_map_shortcode( $atts, $content = null ) {
	
	$map_style = '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]';
	
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'left',
				'custom_css_class' => '',
				'background' => 'bg--secondary',
				'api_key' => '',
				'address' => '',
				'iframe' => '',
				'style' => $map_style,
				'zoom' => '15'
			), $atts 
		) 
	);
	
	$final_style = ( $style == $map_style ) ? $style : htmlspecialchars_decode(rawurldecode(base64_decode($style)));
	if( '' == $final_style ){
		$final_style = $map_style;	
	}
	
	if( 'left' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imageblock switchable feature-large space--lg '. $background .'">
			    <div class="imageblock__content col-md-6 col-sm-4 pos-right">
			        <div class="map-container" data-maps-api-key="'. $api_key .'" data-address="'. $address .'" data-marker-title="'. esc_attr(get_bloginfo('title')) .'"   data-map-style="'. esc_attr($final_style) .'" data-map-zoom="'. esc_attr($zoom) .'"></div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-5 col-sm-7">
			                '. do_shortcode($content) .'
			            </div>
			        </div><!--end of row-->
			    </div><!--end of container-->
			</section>
		';
		
	} elseif( 'left-iframe' == $layout ){
	
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imageblock switchable feature-large space--lg '. $background .'">
                <div class="imageblock__content col-md-6 col-sm-4 col-xs-12 pos-right">
                    <div class="map-container">
                        '. trim( vc_value_from_safe( $iframe ) ) .'
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-sm-7">
                            '. do_shortcode($content) .'
                        </div>
                    </div>
                </div>
            </section>
		';
		
	}
	
	return $output;
}
add_shortcode( 'stack_text_map', 'ebor_text_map_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_map_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Text + Map' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_text_map',
		    'description'             => esc_html__( 'Create fancy images & text', 'stackwordpresstheme' ),
		    'as_parent'               => array('except' => 'stack_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params' => array(
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
		    		"type" => "textarea_safe",
		    		"heading" => esc_html__("iFrame embed code", 'stackwordpresstheme'),
		    		"param_name" => "iframe",
		    		"description" => 'Add a google maps iFrame embed code',
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Image & Map Display Type", 'stackwordpresstheme'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Map Left 50/50' => 'left',
		    			'Map Left 50/50 (iFrame)' => 'left-iframe',
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Background Colour", 'stackwordpresstheme'),
		    		"param_name" => "background",
		    		"value" => array(
		    			'Secondary Colour' => 'bg--secondary',
		    			'None' => 'regular-background',
		    			'Primary Colour' => 'bg--primary',
		    			'Primary 1 Colour' => 'bg--primary-1',
		    			'Primary 2 Colour' => 'bg--primary-2',
		    			'Dark Colour' => 'bg--dark',
		    			'Image Background' => 'imagebg'
		    		),
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
add_action( 'vc_before_init', 'ebor_text_map_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_text_map extends WPBakeryShortCodesContainer {}
}