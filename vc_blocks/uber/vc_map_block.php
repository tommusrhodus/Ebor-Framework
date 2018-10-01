<?php 

/**
 * The Shortcode
 */
function ebor_map_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'address' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$block_id = wp_rand(0,1000);
	$image = wp_get_attachment_image_src($image, 'full');
	
	if(!( isset($image[0]) ))
		$image[0] = false;
	
	$output = '<section class="process process-bg parallax">
	        <div id="map" class="fullwidth halfheight '. esc_attr($block_id) .'"></div>
	</section>';
	
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
						
						var styles = [{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}];
						
						$.goMap.setMap({styles: styles});
					
					});
			  </script>";	
	
	return $output;
}
add_shortcode( 'uber_map_block', 'ebor_map_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_map_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Google Map", 'uber'),
			"base" => "uber_map_block",
			"category" => __('Uber - WP Theme', 'uber'),
			'description' => 'Add a styled google map to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Map Address", 'uber'),
					"param_name" => "address",
					'description' => 'Use a plain text address, e.g: 123 Evergreen Terrace, Springfield<br /><code>Note: You require a Google Maps API key for this to work, please see the settings in <a href="'. admin_url('/customize.php') .'">Appearance => Customize</a></code>'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Map Marker Image", 'uber'),
					"param_name" => "image"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_map_block_shortcode_vc' );