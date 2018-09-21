<?php 

/**
 * The Shortcode
 */
function ebor_map_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'height' => '480',
				'address' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$block_id = wp_rand(0,1000);
	$image = wp_get_attachment_image_src($image, 'full');
	
	if(!( isset($image[0]) ))
		$image[0] = false;
		
	$output = '<div class="map-wrapper"><div id="map" class="'. esc_attr($block_id) .'" style="height: '. (int)esc_attr($height) .'px;"> </div></div>';
	
	$output .= "<script type='text/javascript'>
					jQuery(document).ready(function($){
					'use strict';
					
						jQuery('#map.". esc_attr($block_id) ."').goMap({ address: '" . esc_js($address) ."',
						  zoom: 15,
						  mapTypeControl: true,
					      draggable: false,
					      scrollwheel: false,
					      streetViewControl: true,
					      maptype: 'ROADMAP',
				    	  markers: [
				    		{ 'address' : '" . esc_js($address) ."' }
				    	  ],
						  icon: '". esc_url($image[0]) ."', 
						  addMarker: false,
						});
						
						var styles = [{stylers:[{saturation:-100},{gamma:1}]},{elementType:'labels.text.stroke',stylers:[{visibility:'off'}]},{featureType:'poi.business',elementType:'labels.text',stylers:[{visibility:'off'}]},{featureType:'poi.business',elementType:'labels.icon',stylers:[{visibility:'off'}]},{featureType:'poi.place_of_worship',elementType:'labels.text',stylers:[{visibility:'off'}]},{featureType:'poi.place_of_worship',elementType:'labels.icon',stylers:[{visibility:'off'}]},{featureType:'road',elementType:'geometry',stylers:[{visibility:'simplified'}]},{featureType:'water',stylers:[{visibility:'on'},{saturation:50},{gamma:0},{hue:'#50a5d1'}]},{featureType:'administrative.neighborhood',elementType:'labels.text.fill',stylers:[{color:'#333333'}]},{featureType:'road.local',elementType:'labels.text',stylers:[{weight:0.5},{color:'#333333'}]},{featureType:'transit.station',elementType:'labels.icon',stylers:[{gamma:1},{saturation:50}]}];
						
						jQuery.goMap.setMap({styles: styles});
					
					});
			  </script>";	
	
	return $output;
}
add_shortcode( 'lydia_map_block', 'ebor_map_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_map_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Google Map", 'lydia'),
			"base" => "lydia_map_block",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Add a styled google map to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Map Address", 'lydia'),
					"param_name" => "address",
					'description' => 'Use a plain text address, e.g: 123 Evergreen Terrace, Springfield<br /><code>Note: You require a Google Maps API key for this to work, please see the settings in <a href="'. admin_url('/customize.php') .'">Appearance => Customize</a></code>'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Map height", 'lydia'),
					"param_name" => "height",
					'description' => 'Height in px, numerical only',
					'value' => '480'
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Map Marker Image", 'lydia'),
					"param_name" => "image"
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_map_block_shortcode_vc' );