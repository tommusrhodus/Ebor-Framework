<?php

/**
 * The Shortcode
 */
function ebor_swiper_modal_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'swiper_modal_gallery',
				'display_nav' => 'show_navigation',				
				'display_pagination' => 'show_pagination'
			), $atts 
		) 
	);
	
	global $ebor_swiper_modal_gallery_count;
	global $rand;
	global $ebor_swiper_modal_gallery_type;
	$ebor_swiper_modal_gallery_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	$ebor_swiper_modal_gallery_type = $type;
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

	$output .= '
	  	<div class="wrapper light-wrapper inverse-text">
	    	<div class="container-fluid">
	      		<div class="swiper-container-wrapper swiper-full ver1" data-aos="fade">
		        	<div class="swiper-container text-center">
			          	<div class="swiper-wrapper">
			          	'. do_shortcode($content) .'
			          	</div>
		          	</div>
	          	</div>
	          	'. $paging . $nav .'<
          	</div>
      	</div>
	';

	return $output;
}
add_shortcode( 'brailie_swiper_modal_gallery', 'ebor_swiper_modal_gallery_shortcode' );

/**
 * The Shortcode
 */
function ebor_swiper_modal_gallery_content_shortcode( $atts, $content = null ) {
	global $ebor_swiper_modal_gallery_count;
	global $rand;
	
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'overlay_title' => '',
				'modal_button_label' => '',				
				'gallery_images' => '',				
				'lightbox_title' => '',
			), $atts 
		) 
	);
	
	$ebor_swiper_modal_gallery_count++;
	$images = explode(',', $gallery_images);
	$image_url = wp_get_attachment_url($image);
	$image = wp_get_attachment_image($image, 'full');

	$output = '
		<div class="swiper-slide">
			<figure class="overlay-info light-gallery">
				'.$image.'
				<figcaption class="d-flex">
					<div class="align-self-center mx-auto">
						<h2 class="section-title larger mb-30">'. $overlay_title .'</h2>
						<a href="'.esc_html($image_url).'" class="btn btn-s btn-full-rounded btn-white" data-sub-html="#caption'.esc_attr($ebor_swiper_modal_gallery_count).'">'.$modal_button_label.'
						</a>
						<ul class="d-none">';
							foreach ($images as $id) {
								$output .= '<li><a href="'.esc_url(wp_get_attachment_url($id)) .'" data-sub-html="#caption'.esc_attr($ebor_swiper_modal_gallery_count).'"></a></li>';
							}
						$output .= '</ul>
						<div id="caption'.esc_attr($ebor_swiper_modal_gallery_count).'" class="d-none">
							<h5>'. $lightbox_title .'</h5>
              				<p>'. do_shortcode($content) .'</p>
           				</div>
					</div>
				</figcaption>
			</figure>
		</div>
	';	

	return $output;
}
add_shortcode( 'brailie_swiper_modal_gallery_content', 'ebor_swiper_modal_gallery_content_shortcode' );

// Parent Element
function ebor_swiper_modal_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'                    => esc_html__( 'Swiper Image Gallery + Modal Gallery' , 'brailie' ),
		    'base'                    => 'brailie_swiper_modal_gallery',
		    'description'             => esc_html__( 'Create a stylish image gallery', 'brailie' ),
		    'as_parent'               => array('only' => 'brailie_swiper_modal_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'params' => array(
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
add_action( 'vc_before_init', 'ebor_swiper_modal_gallery_shortcode_vc' );

// Nested Element
function ebor_swiper_modal_gallery_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'            => esc_html__('Swiper Modal Gallery Item', 'brailie'),
		    'base'            => 'brailie_swiper_modal_gallery_content',
		    'description'     => esc_html__( 'Add an image to your swiper gallery', 'brailie' ),
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_swiper_modal_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
					"type" => "attach_image",
					"heading" => esc_html__("Swiper Image", 'brailie'),
					"param_name" => "image"
				),
				array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Overlay Title", 'brailie'),
		    		"param_name" => "overlay_title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Modal Button Label", 'brailie'),
		    		"param_name" => "modal_button_label",
		    		'holder' => 'div'
		    	),
				array(
					"type" => "attach_images",
					"heading" => esc_html__("Modal Gallery Images", 'brailie'),
					"param_name" => "gallery_images"
				),		    	
	            array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Image Title (Lightbox Only)", 'brailie'),
		    		"param_name" => "lightbox_title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Image Caption (Lightbox Only)", 'brailie'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_swiper_modal_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_swiper_modal_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_swiper_modal_gallery_content extends WPBakeryShortCode {}
}