<?php

/**
 * The Shortcode
 */
function ebor_agency_tiles_shortcode( $atts, $content = null ) {
	$output = '<div class="row"><article class="col-md-12"><div class="row">'. do_shortcode($content) .'</div></article></div>';
	return $output;
}
add_shortcode( 'expose_agency_tiles', 'ebor_agency_tiles_shortcode' );

/**
 * The Shortcode
 */
function ebor_agency_tiles_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'image' => '',
				'type' => 'counter',
				'text' => ''
			), $atts 
		) 
	);
	$output = false;
	if( 'counter' == $type ){
		$output = '<article class="col-md-3 agency-tile text-center offwhite-bg">
					<div class="valign">
						<h2 class="font2 black">'. htmlspecialchars_decode($title) .'</h2>
						<h6 class="font3 dark">'. htmlspecialchars_decode($text) .'</h6>
					</div>
				</article>';
	} elseif( 'text' == $type ) {
		$output = '<article class="col-md-6 agency-tile text-left color-bg">
			<div class="valign">
				<h3 class="dark font2">'. htmlspecialchars_decode($title) .'</h3>
				<p class="white font3">'. htmlspecialchars_decode($text) .'</p>
			</div>
		</article>';
	} elseif( 'icon' == $type ) {
		$output = '<article class="col-md-3 agency-tile text-center white-bg">
			<div class="valign">
				'. wp_get_attachment_image($image, 'thumbnail', false, array('class' => 'features-icon')) .'
				<h6 class="font3 dark">'. htmlspecialchars_decode($title) .'</h6>
			</div>
		</article>';
	} elseif( 'image' == $type ) {
		$image = wp_get_attachment_image_src($image, 'full');
		if(!( isset($image[0]) ))
			$image[0] = false;
		$output = '<article class="col-md-6 agency-tile text-left" style="background-image: url('. $image[0] .');">
			<div class="valign">
				<h2 class="font2 white">'. htmlspecialchars_decode($title) .'</h2>
				<h6 class="font3 white">'. htmlspecialchars_decode($text) .'</h6>
			</div>
		</article>';
	}
	return $output;
}
add_shortcode( 'expose_agency_tiles_content', 'ebor_agency_tiles_content_shortcode' );

// Parent Element
function ebor_agency_tiles_shortcode_vc() {
	vc_map( 
		array(
			"icon" 					  => 'expose-vc-block',
		    'name'                    => __( 'Agency Tiles' , 'expose' ),
		    'base'                    => 'expose_agency_tiles',
		    'description'             => __( 'Container for Item', 'expose' ),
		    'as_parent'               => array('only' => 'expose_agency_tiles_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" 				  => 'VcColumnView',
		    "category" 				  => __('Expose WP Theme', 'expose'),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_agency_tiles_shortcode_vc' );

// Nested Element
function ebor_agency_tiles_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
		    'name'            => __('Agency Tiles Content', 'expose'),
		    'base'            => 'expose_agency_tiles_content',
		    'description'     => __( 'Items "Item".', 'expose' ),
		    "category" 		  => __('Expose WP Theme', 'expose'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'expose_agency_tiles'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Title", 'expose'),
	            	"param_name" => "title",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textarea",
	            	"heading" => __("Content", 'expose'),
	            	"param_name" => "text",
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Icon Image or Background Image", 'expose'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "dropdown",
	            	"heading" => __("Display type", 'Expose'),
	            	"param_name" => "type",
	            	"value" => array(
	            		'1/4 Counter' => 'counter',
	            		'1/2 Text' => 'text',
	            		'1/4 Icon' => 'icon',
	            		'1/2 Title & Image' => 'image'
	            	),
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_agency_tiles_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_expose_agency_tiles extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_expose_agency_tiles_content extends WPBakeryShortCode {

    }
}