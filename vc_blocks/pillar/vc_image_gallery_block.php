<?php

/**
 * The Shortcode
 */
function ebor_image_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'class' => 'Show All'
			), $atts 
		) 
	);
	
	$output = '
		<div class="masonry-contained">
			<div class="row">
				<div class="masonry">
					<div class="masonry__filters" data-filter-all-text="'. $class .'"></div>
					<div class="masonry__container masonry--animate">
						'. do_shortcode($content) .'
					</div><!--end masonry container-->
				</div>
			</div><!--end of row-->
		</div><!--end of container-->
	';
	
	return $output;
}
add_shortcode( 'pillar_image_gallery', 'ebor_image_gallery_shortcode' );

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
	$caption = get_post($image)->post_excerpt;
	
	$output = '
		<div class="col-sm-6 col-xs-12 masonry__item" data-masonry-filter="'. $class .'">
			<a data-lightbox="gallery" href="'. $src[0] .'" data-title="'. $caption .'">
				'. wp_get_attachment_image( $image, 'large' ) .'
			</a>
		</div><!--end item-->
	';

	return $output;
}
add_shortcode( 'pillar_image_gallery_content', 'ebor_image_gallery_content_shortcode' );

// Parent Element
function ebor_image_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'                    => esc_html__( 'Lightbox Gallery' , 'pillar' ),
		    'base'                    => 'pillar_image_gallery',
		    'description'             => esc_html__( 'Create a filter gallery of lightbox images', 'pillar' ),
		    'as_parent'               => array('only' => 'pillar_image_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("'Show All' Text", 'pillar'),
		    		"param_name" => "class",
		    		'value' => 'Show All'
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
			"icon" => 'pillar-vc-block',
		    'name'            => esc_html__('Lightbox Gallery Content', 'pillar'),
		    'base'            => 'pillar_image_gallery_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'pillar' ),
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'pillar_image_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Filter Category (Plain Text Only)", 'pillar'),
		    		"param_name" => "class",
		    		'holder' => 'div',
		    		'description' => 'Multiple categories: Separate with comma only, no spaces. Spaces are fine in the category name. e.g: <code>Category 1,Category 2</code>'
		    	),
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Block Image", 'pillar'),
	            	"param_name" => "image",
	            	"description" => '<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=f6qWRVkEfE4">Video Tutorial</a></div>',
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pillar_image_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pillar_image_gallery_content extends WPBakeryShortCode {}
}