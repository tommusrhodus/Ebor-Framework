<?php

global $process_grid_block_count;

/**
 * The Shortcode
 */
function ebor_process_grid_shortcode( $atts, $content = null ) {
	global $process_grid_block_count;
	$process_grid_block_count = 0;
	$output ='<div class="row process"><div class="row-same-height">'. do_shortcode($content) .'</div></div>';
	return $output;
}
add_shortcode( 'kwoon_process_grid', 'ebor_process_grid_shortcode' );

/**
 * The Shortcode
 */
function ebor_process_grid_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'image_retina' => '',
				'alt' => '',
				'duration' => '1',
				'delay' => '0',
				'border' => ''
			), $atts 
		) 
	);
	
	global $process_grid_block_count;
	$process_grid_block_count++;
	
	$image = wp_get_attachment_image_src($image, 'full');
	$image_retina = wp_get_attachment_image_src($image_retina, 'full');
	
	
	if(!( isset($image[0]) ))
		$image[0] = false;
	
	if(!( isset($image_retina[0]) ))
		$image_retina[0] = false;
	
	$output = '
		<div class="col-md-6 col-md-height process-item '. esc_attr($border) .'">
			<div class="content wow fadeIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
				<div class="icon"> 
					<img 
						src="'. esc_url($image[0]) .'" 
						data-src="'. esc_url($image[0]) .'" 
						data-ret="'. esc_url($image_retina[0]) .'" 
						class="retina" 
						alt="'. esc_attr($alt) .'" 
					/>
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</div>
	';
	
	if( $process_grid_block_count % 2 == 0 )
		$output .= '</div><div class="row-same-height">';
		
	return $output;
}
add_shortcode( 'kwoon_process_grid_content', 'ebor_process_grid_content_shortcode' );

// Parent Element
function ebor_process_grid_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'                    => __( 'Process Grid' , 'kwoon' ),
		    'base'                    => 'kwoon_process_grid',
		    'description'             => __( 'Create a grid of your process/services', 'kwoon' ),
		    'as_parent'               => array('only' => 'kwoon_process_grid_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Kwoon WP Theme', 'kwoon')
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_grid_shortcode_vc' );

// Nested Element
function ebor_process_grid_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'            => __('Process Grid Content', 'kwoon'),
		    'base'            => 'kwoon_process_grid_content',
		    'description'     => __( 'Proces Grid Content Element', 'kwoon' ),
		    "category" => __('Kwoon WP Theme', 'kwoon'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'kwoon_process_grid'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'kwoon'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Service Icon Image", 'kwoon'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Service Icon Retina Image (Double Size)", 'kwoon'),
	            	"param_name" => "image_retina"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Image Alt Text", 'kwoon'),
	            	"param_name" => "alt"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Animation Duration (seconds)(numbers only)", 'kwoon'),
	            	"param_name" => "duration",
	            	'value' => '1'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Animation Delay (seconds)(numbers only)", 'kwoon'),
	            	"param_name" => "delay",
	            	'value' => '0.3'
	            ),
	            array(
	            	"type" => "dropdown",
	            	"heading" => __("Element Border", 'kwoon'),
	            	"param_name" => "border",
	            	"value" => array_flip(array(
	            		'' => 'No Border',
	            		'border-right' => 'Border on Right',
	            		'border-bottom' => 'Border on Bottom',
	            		'border-bottom border-right' => 'Border on Bottom & Right'
	            	))
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_grid_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_kwoon_process_grid extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_kwoon_process_grid_content extends WPBakeryShortCode {

    }
}