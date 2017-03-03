<?php

/**
 * The Shortcode
 */
function ebor_image_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => 'Category:',
				'class' => 'All Categories'
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
		    <div class="masonry">
		        <div class="masonry-filter-container text-center">
		            <span>'. $text .'</span>
		            <div class="masonry-filter-holder">
		                <div class="masonry__filters" data-filter-all-text="'. $class .'"></div>
		            </div>
		        </div><!--end masonry filters-->
		        <div class="masonry__container">'. do_shortcode($content) .'</div><!--end masonry container-->
		    </div><!--end masonry-->
		</div>
	';
	
	return $output;
}
add_shortcode( 'stack_image_gallery', 'ebor_image_gallery_shortcode' );

/**
 * The Shortcode
 */
function ebor_image_gallery_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'class' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$src = wp_get_attachment_image_src( $image, 'full' );
	
	$output = '
		<div class="masonry__item col-md-4 col-xs-6" data-masonry-filter="'. $class .'">
		    <a href="'. $src[0] .'" data-lightbox="Gallery 1">
		        '. wp_get_attachment_image( $image, 'large' ) .'
		    </a>
		</div>
	';

	return $output;
}
add_shortcode( 'stack_image_gallery_content', 'ebor_image_gallery_content_shortcode' );

// Parent Element
function ebor_image_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Lightbox Gallery' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_image_gallery',
		    'description'             => esc_html__( 'Create a filter gallery of lightbox images', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_image_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("'Category:' Text", 'stackwordpresstheme'),
		    		"param_name" => "text",
		    		'value' => 'Category:'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("'All Categories' Text", 'stackwordpresstheme'),
		    		"param_name" => "class",
		    		'value' => 'All Categories'
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_gallery_shortcode_vc' );

// Nested Element
function ebor_image_gallery_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Lightbox Gallery Content', 'stackwordpresstheme'),
		    'base'            => 'stack_image_gallery_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_image_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Filter Category (Plain Text Only)", 'stackwordpresstheme'),
		    		"param_name" => "class",
		    		'holder' => 'div',
		    		'description' => 'Multiple categories: Separate with comma only, no spaces. Spaces are fine in the category name. e.g: <code>Category 1,Category 2</code>'
		    	),
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Block Image", 'stackwordpresstheme'),
	            	"param_name" => "image",
		    		'description' => '<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=ZD4_BLhnVPI">Video Tutorial</a></div>'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_image_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_image_gallery_content extends WPBakeryShortCode {}
}