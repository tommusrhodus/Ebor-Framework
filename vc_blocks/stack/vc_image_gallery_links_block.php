<?php

/**
 * The Shortcode
 */
function ebor_image_gallery_links_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => 'Viewing:',
				'class' => 'All Categories'
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
			<div class="col-sm-12 text-center">
				<div class="masonry masonry-demos">
					<div class="masonry-filter-container text-center">
						<span>'. $text .'</span>
						<div class="masonry-filter-holder">
							<div class="masonry__filters" data-filter-all-text="'. $class .'"></div>
						</div>
					</div>
					<div class="masonry__container">
						<div class="masonry__item col-md-4 col-sm-6"></div>
						'. do_shortcode($content) .'
					</div><!--end of masonry container-->
				</div><!--end masonry-->
			</div>
		</div><!--end of row-->
	';
	
	return $output;
}
add_shortcode( 'stack_image_gallery_links', 'ebor_image_gallery_links_shortcode' );

/**
 * The Shortcode
 */
function ebor_image_gallery_links_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'class' => '',
				'image' => '',
				'link' => '',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="masonry__item col-md-4 col-sm-6" data-masonry-filter="'. $class .'">
			<a href="'. $link .'" class="block text-block">
				<div class="hover-shadow">'. wp_get_attachment_image( $image, 'large' ) .'</div>
		    </a>
		    <div class="text-center">
		    	<h5>'. $title .'</h5>
		    	<span>'. $subtitle .'</span>
		    </div>
		</div><!--end item-->
	';

	return $output;
}
add_shortcode( 'stack_image_gallery_links_content', 'ebor_image_gallery_links_content_shortcode' );

// Parent Element
function ebor_image_gallery_links_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Image Gallery' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_image_gallery_links',
		    'description'             => esc_html__( 'Create a filter gallery of images with links', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_image_gallery_links_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("'Category:' Text", 'stackwordpresstheme'),
		    		"param_name" => "text",
		    		'value' => 'Viewing:'
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
add_action( 'vc_before_init', 'ebor_image_gallery_links_shortcode_vc' );

// Nested Element
function ebor_image_gallery_links_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Image Gallery Content', 'stackwordpresstheme'),
		    'base'            => 'stack_image_gallery_links_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_image_gallery_links'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Link URL", 'stackwordpresstheme'),
	            	"param_name" => "link"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Title Text", 'stackwordpresstheme'),
	            	"param_name" => "title"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Subtitle Text", 'stackwordpresstheme'),
	            	"param_name" => "subtitle"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_gallery_links_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_image_gallery_links extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_image_gallery_links_content extends WPBakeryShortCode {}
}