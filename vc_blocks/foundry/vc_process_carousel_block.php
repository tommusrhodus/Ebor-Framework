<?php

/**
 * The Shortcode
 */
function ebor_process_carousel_shortcode( $atts, $content = null ) {
	$output = '<div class="process-carousel">'. do_shortcode($content) .'</div>';
	
	if( substr_count( $content, '[foundry_process_carousel_content' ) > 1 ){
		$output .= '
			<script type="text/javascript">
				jQuery(document).ready(function() { 
		
					jQuery(\'.process-carousel\').owlCarousel({
						nav: true,
						navText: ["","<i class=\'ti-angle-right\'>"],
						dots: false,
						center: true,
						loop:true,
						responsive:{
					        0:{
					            items:1
					        }
					    }
					});
					
				});
			</script>
		';
	}
	
	return $output;
}
add_shortcode( 'foundry_process_carousel', 'ebor_process_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_process_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'background_style' => 'light-wrapper',
				'fullscreen' => 'fullscreen'
			), $atts 
		) 
	);
	
	$align = ( 'fullscreen' == $fullscreen ) ? 'v-align-transform' : false;
	
	$output = '
		<section class="'. $background_style .' '. $fullscreen .'">
		    <div class="col-md-9 content '. $align .'">
		        '. do_shortcode($content) .'
		    </div>
		</section>
	';

	return $output;
}
add_shortcode( 'foundry_process_carousel_content', 'ebor_process_carousel_content_shortcode' );

// Parent Element
function ebor_process_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Fullscreen Process Carousel' , 'foundry' ),
		    'base'                    => 'foundry_process_carousel',
		    'description'             => __( 'Create a fullwidth carousel of content', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_process_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_carousel_shortcode_vc' );

// Nested Element
function ebor_process_carousel_content_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Fullscreen Process Carousel Content', 'foundry'),
		    'base'            => 'foundry_process_carousel_content',
		    'description'     => __( 'Fullscreen Process Carousel Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_process_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textarea_html",
		    		"heading" => __("Block Content", 'foundry'),
		    		"param_name" => "content",
		    		'holder' => 'div'
		    	),
		    	array(
		    		'type' => 'dropdown',
		    		'heading' => "Section Layout",
		    		'param_name' => 'background_style',
		    		'value' => array_flip(array(
		    			'light-wrapper'    => 'Standard Section (Light Background)',
		    			'bg-secondary'     => 'Standard Section (Dark Background)',
		    			'bg-dark'          => 'Standard Section (Black Background)',
		    			'bg-primary'       => 'Standard Section (Highlight Colour Background)',
		    		))
		    	),
		    	array(
		    		'type' => 'dropdown',
		    		'heading' => "Fullscreen height?",
		    		'param_name' => 'fullscreen',
		    		'value' => array_flip(array(
		    			'fullscreen' => 'fullscreen',
		    			'normal' => 'normal'
		    		))
		    	)
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_process_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_process_carousel_content extends WPBakeryShortCode {}
}