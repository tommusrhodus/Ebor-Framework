<?php

/**
 * The Shortcode
 */
function ebor_swiper_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'swiper_gallery',
				'display_nav' => 'show_navigation',				
				'display_pagination' => 'show_pagination'
			), $atts 
		) 
	);
	
	global $ebor_swiper_gallery_count;
	global $rand;
	global $ebor_swiper_gallery_type;
	$ebor_swiper_gallery_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	$ebor_swiper_gallery_type = $type;
	if($display_pagination == 'show_pagination') {
		$paging = '<div class="swiper-pagination gap-large"></div>';
	} else {
		$paging = '';
	}
	if($display_nav == 'show_navigation') {
		$nav = '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
	} else {
		$nav = '';
	}

	if($type == 'swiper_gallery' || $type == 'swiper_gallery_lightbox') {
		$output .= '<div id="swiper-image-gallery-'. $rand .'" class="swiper-container-wrapper swiper-auto-tab" data-aos="fade"><div class="swiper-container text-center"><div class="swiper-wrapper light-gallery">'. do_shortcode($content) .'</div></div>'. $paging . $nav .'</div>';
	}

	if($type == 'swiper_gallery_overlay_caption' || $type == 'swiper_gallery_overlay_caption_bevel') {
		$output .= '<div id="swiper-image-gallery-'. $rand .'" class="swiper-container-wrapper image-grid swiper-col3-20" data-aos="fade"><div class="swiper-container text-center"><div class="swiper-wrapper">'. do_shortcode($content) .'</div></div>'. $paging . $nav .'</div>';
	}

	if($type == 'swiper_gallery_fullheight_lightbox' || $type == 'swiper_gallery_fullheight') {
		$output .= '<div id="swiper-image-gallery-'. $rand .'" class="swiper-container-wrapper swiper-auto-full ver1" data-aos="fade"><div class="swiper-container text-center"><div class="swiper-wrapper light-gallery">'. do_shortcode($content) .'</div></div>'. $paging . $nav .'</div>';
	}

	if($type == 'swiper_gallery_single') {
		$output .= '<div id="swiper-image-gallery-'. $rand .'" class="swiper-container-wrapper swiper-full-single" data-aos="fade"><div class="swiper-container text-center"><div class="swiper-wrapper">'. do_shortcode($content) .'</div></div>'. $paging . $nav .'</div>';
	}
	
	//$output .= '<div id="swiper_gallery'. $rand .'" class="swiper_gallery-wrapper '. $type .'">'. do_shortcode($content) .'</div>';

	return $output;
}
add_shortcode( 'brailie_swiper_gallery', 'ebor_swiper_gallery_shortcode' );

/**
 * The Shortcode
 */
function ebor_swiper_gallery_content_shortcode( $atts, $content = null ) {
	global $ebor_swiper_gallery_count;
	global $rand;
	global $ebor_swiper_gallery_type;
	
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'link_to' => '',
			), $atts 
		) 
	);
	
	$ebor_swiper_gallery_count++;

	$image_url = wp_get_attachment_url($image);
	$image = wp_get_attachment_image($image, 'full');

	if($ebor_swiper_gallery_type == 'swiper_gallery' || $ebor_swiper_gallery_type == 'swiper_gallery_fullheight' || $ebor_swiper_gallery_type == 'swiper_gallery_single') {

		$output = '<div class="swiper-slide">'.$image.'</div>';	

	} elseif($ebor_swiper_gallery_type == 'swiper_gallery_lightbox' || $ebor_swiper_gallery_type == 'swiper_gallery_fullheight_lightbox' || $ebor_swiper_gallery_type == 'swiper_gallery_single') {

		$output = '<div class="swiper-slide">
						'.$image.'
						<div class="link-wrapper">
	                      	<div class="link lightbox light-gallery">
		                      	<a href="'.esc_html($image_url).'" class="lightbox-this" data-sub-html=".caption'.esc_attr($ebor_swiper_gallery_count).'">
		                        	<div class="caption'.esc_attr($ebor_swiper_gallery_count).' hidden">
		                          		<h5>'. $title .'</h5>
		                          		<p>'. do_shortcode($content) .'</p>
		                       		</div>
		                        </a>
	                        </div>
	                    </div>
                    </div>';	

	} elseif($ebor_swiper_gallery_type == 'swiper_gallery_overlay_caption') {

		$output = '<div class="swiper-slide">
						<figure class="overlay overlay4">
							<a href="'.esc_url($link_to).'">
								'.$image.'
							</a>
							<figcaption class="d-flex">
								<div class="align-self-end mx-auto">
									<h3 class="mb-0">'. $title .'</h3>
									<p>'. do_shortcode($content) .'</p>
								</div>
							</figcaption>
						</figure>
					</div>';	

	} elseif($ebor_swiper_gallery_type == 'swiper_gallery_overlay_caption_bevel') {

		$output = '<div class="swiper-slide">
						<figure class="overlay-info bevel">
							<a href="'.esc_url($link_to).'">
								'.$image.'
							</a>
							<figcaption class="d-flex">
								<div class="align-self-center mx-auto">
									<h3 class="mb-0">'. $title .'</h3>
									<p>'. do_shortcode($content) .'</p>
								</div>
							</figcaption>
						</figure>
					</div>';	

	}

	return $output;
}
add_shortcode( 'brailie_swiper_gallery_content', 'ebor_swiper_gallery_content_shortcode' );

// Parent Element
function ebor_swiper_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'                    => esc_html__( 'Swiper Image Gallery' , 'brailie' ),
		    'base'                    => 'brailie_swiper_gallery',
		    'description'             => esc_html__( 'Create a stylish image gallery', 'brailie' ),
		    'as_parent'               => array('only' => 'brailie_swiper_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'params' => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Gallery Type", 'brailie'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Swiper Gallery' => 'swiper_gallery',
		    			'Swiper Gallery Lightbox' => 'swiper_gallery_lightbox',
		    			'Swiper Gallery Fullheight' => 'swiper_gallery_fullheight',		    			
		    			'Swiper Gallery + Overlay Caption' => 'swiper_gallery_overlay_caption',		
		    			'Swiper Gallery + Overlay Caption + Bevel' => 'swiper_gallery_overlay_caption_bevel',
		    			'Swiper Gallery Lightbox Fullheight' => 'swiper_gallery_fullheight_lightbox',		    			
		    			'Swiper Gallery Fullheight Single Item' => 'swiper_gallery_single',
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Show/Hide Navigation", 'brailie'),
		    		"param_name" => "display_nav",
		    		"value" => array(
		    			'Show Navigation' => 'show_navigation',		    			
		    			'Hide Navigation' => 'hide_navigation',
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Show/Hide Pagination", 'brailie'),
		    		"param_name" => "display_pagination",
		    		"value" => array(
		    			'Show Pagination' => 'show_pagination',		    			
		    			'Hide Pagination' => 'hide_pagination',
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_swiper_gallery_shortcode_vc' );

// Nested Element
function ebor_swiper_gallery_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'            => esc_html__('Swiper Gallery Item', 'brailie'),
		    'base'            => 'brailie_swiper_gallery_content',
		    'description'     => esc_html__( 'Add an image to your swiper gallery', 'brailie' ),
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_swiper_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
					"type" => "attach_image",
					"heading" => esc_html__("Image", 'brailie'),
					"param_name" => "image"
				),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Image Title", 'brailie'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Image Caption", 'brailie'),
	            	"param_name" => "content"
	            ),
	            array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Item Link", 'brailie'),
		    		"param_name" => "link_to",
		    		'holder' => 'div',
		    		"description" => __( "Enter a URL for your slide to link to, used in Swiper Gallery + Overlay Caption", "brailie" )
		    	),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_swiper_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_swiper_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_swiper_gallery_content extends WPBakeryShortCode {}
}