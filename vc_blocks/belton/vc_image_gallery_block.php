<?php

/**
 * The Shortcode
 */
function ebor_image_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array( 
				'show_all_text' => 'Show All',
				'enable_filters' => 'show',
				'caption_size' => 'regular-captions',
			), $atts 
		) 
	);
	
	global $ebor_image_gallery_count;
	global $rand;
	global $ebor_image_gallery_open;
	$ebor_image_gallery_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	
	$output .= '
		<div id="image-gallery-'.esc_attr($rand).'">';

		if($enable_filters == 'show') { 
			$output .= '
			<div class="extra-padding-bottom">
				<ul id="options" class="clearfix">
				    <li> <a href="#home" class="selected">'.wp_kses_post($show_all_text).'</a> </li>
			  	</ul>
		  	</div>';
	  	}
			$output .= '<div class="clearfix"><div id="container-'.esc_attr($rand).'" class="'.esc_attr($caption_size).'">'. do_shortcode($content) .'</div></div>
		</div>
	';

	return $output;
}
add_shortcode( 'belton_image_gallery', 'ebor_image_gallery_shortcode' );

/**
 * The Shortcode
 */
function ebor_image_gallery_content_shortcode( $atts, $content = null ) {
	global $ebor_image_gallery_count;
	global $rand;
	global $ebor_image_gallery_open;
	
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'category' => '',
				'link_to' => 'popup',
				'video_url' => ''
			), $atts 
		) 
	);
	
	$ebor_image_gallery_count++;
	$id = $image;
	$image_url = wp_get_attachment_image_src($image, 'full');

	if($link_to == 'popup') {
		$url = $image_url[0];
	} elseif($link_to == 'video-popup') {
		$url = $video_url;
	} else {
		$url = $video_url;
	}

	$clean_category = str_replace(" ", "-", $category);

	$output = '
		<div class="element clearfix col-md-4 col-sm-6 home '.strtolower($clean_category).'" data-masonry-filter="'.wp_kses_post($category).'"> 
			<a href="'.esc_url($url).'" data-title="'. wp_kses_post($title) .'" class="'. esc_attr($link_to) .' transition-link"> 
				'. wp_get_attachment_image($id, 'full') .'
            	<div class="title-holder">
              		<h3>'. wp_kses_post($title) .'</h3>
              		<p class="large">'. wp_kses_post($category) .'</p>
            	</div>
            	<div class="overlay"></div>
            </a>
      	</div>
	';

	return $output;
}
add_shortcode( 'belton_image_gallery_content', 'ebor_image_gallery_content_shortcode' );

// Parent Element
function ebor_image_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'belton-vc-block',
		    'name'                    => esc_html__( 'Image Gallery' , 'belton' ),
		    'base'                    => 'belton_image_gallery',
		    'description'             => esc_html__( 'Create Gallery Content', 'belton' ),
		    'as_parent'               => array('only' => 'belton_image_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('belton WP Theme', 'belton'),
		    'params' => array(
				array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Show All Text", 'belton'),
		    		"param_name" => "show_all_text",
		    		"value" => __( "Show All", "belton" ),
		    		'holder' => 'div'
		    	),
		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Show Filters?", 'belton'),
					"param_name" => "enable_filters",
					"value" => array(
						'Show Filters' => 'show',
						'Hide Filters' => 'hide',
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Title/Caption Size?", 'belton'),
					"param_name" => "caption_size",
					"value" => array(
						'Regular' => 'regular-captions',
						'Small' => 'small-captions',
					)
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
			"icon" => 'belton-vc-block',
		    'name'            => esc_html__('Gallery Item', 'belton'),
		    'base'            => 'belton_image_gallery_content',
		    'description'     => esc_html__( 'Accordion Content Element', 'belton' ),
		    "category" => esc_html__('belton WP Theme', 'belton'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'belton_image_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
					"type" => "attach_image",
					"heading" => esc_html__("Image", 'belton'),
					"param_name" => "image"
				),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'belton'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Category", 'belton'),
		    		"param_name" => "category",
		    		'holder' => 'div'
		    	),
		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Link To", 'belton'),
					"param_name" => "link_to",
					"value" => array(
						'Lightbox' => 'popup',
						'Video' => 'video-popup',
						'URL' => 'url',
					)
				),
				array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Video URL/URL", 'belton'),
		    		"param_name" => "video_url",
		    		'holder' => 'div'
		    	),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_belton_image_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_belton_image_gallery_content extends WPBakeryShortCode {}
}