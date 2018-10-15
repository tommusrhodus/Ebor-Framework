<?php

/**
 * The Shortcode
 */
function ebor_image_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'masonry_lightbox',
				'display_filters' => 'show_filters',	
				'main_title' => '',
				'all_text' => 'All',
			), $atts 
		) 
	);
	
	global $ebor_image_gallery_count;
	global $rand;
	global $ebor_image_gallery_type;
	$ebor_image_gallery_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	$ebor_image_gallery_type = $type;

	if($type == 'masonry' || $type == 'masonry_lightbox' || $type == 'classic_grid_caption' || $type == 'classic_grid_overlay_caption' || $type == 'classic_grid_overlay_caption_bevel') {
		$grid_size = 'cube-grid'; 
		$filter_id = 'cube-grid-filter';
	} 
	elseif($type == 'masonry_2col' || $type == 'masonry_lightbox_2col' || $type == 'classic_grid_overlay_caption_2col') {
		$grid_size = 'cube-grid-large'; 
		$filter_id = 'cube-grid-filter';
	}
	elseif($type == 'mosaic' || $type == 'mosaic_lightbox') {
		$grid_size = 'cube-grid-mosaic'; 
		$filter_id = 'cube-grid-filter';
	}
	elseif($type == 'fullscreen' || $type == 'fullscreen_lightbox' || $type == 'fullscreen_modal') {
		$grid_size = 'cube-grid-full'; 
		$filter_id = 'cube-grid-filter';
	}
	elseif($type == 'fullscreen_justified' || $type == 'fullscreen_justified_lightbox') {
		$grid_size = 'cube-grid-full-large'; 
		$filter_id = 'cube-grid-full-large-filter';
	}

	if($display_filters == 'show_filters') {
		if($main_title) {
			$filter_container = '
			<div class="d-md-flex">
				<div class="mr-auto">
					<h2 class="title-color color-dark mb-0">'.$main_title.'</h2>
				</div>
				<div class="space20 d-md-none"></div>
				<div id="'.$filter_id.'" class="cbp-filter-container text-md-right align-self-center mb-0">
					<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">'.$all_text.'</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="space20"></div>';
		} else {
			$filter_container = '
			<div id="'.$filter_id.'" class="cbp-filter-container text-center">
				<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">'.$all_text.'</div>
			</div>
			<div class="clearfix"></div>
			<div class="space20"></div>';
		}
		
	} else {
		$filter_container = '';
	}

	if($type == 'masonry' || $type == 'masonry_2col' || $type == 'mosaic' || $type == 'classic_grid_caption' || $type == 'fullscreen' || $type == 'classic_grid_overlay_caption' || $type == 'classic_grid_overlay_caption_bevel' || $type == 'classic_grid_overlay_caption_2col' || $type == 'fullscreen_modal') {
		$output .= '
			<div id="image-gallery-'.$rand.'">
				'.$filter_container.'
				<div id="'.$grid_size.'" class="cbp">
					'. do_shortcode($content) .'
				</div>
			</div>';
	} elseif($type == 'masonry_lightbox' || $type == 'masonry_lightbox_2col' || $type == 'mosaic_lightbox' || $type == 'fullscreen_lightbox' || $type == 'fullscreen_justified_lightbox') {
		$output .= '
			<div id="image-gallery-'.$rand.'">
				'.$filter_container.'
				<div id="'.$grid_size.'" class="cbp light-gallery">
					'. do_shortcode($content) .'
				</div>
			</div>';
	}

	
	//$output .= '<div id="image_gallery'. $rand .'" class="image_gallery-wrapper '. $type .'">'. do_shortcode($content) .'</div>';

	return $output;
}
add_shortcode( 'brailie_image_gallery', 'ebor_image_gallery_shortcode' );

/**
 * The Shortcode
 */
function ebor_image_gallery_content_shortcode( $atts, $content = null ) {
	global $ebor_image_gallery_count;
	global $rand;
	global $ebor_image_gallery_type;
	
	extract( 
		shortcode_atts( 
			array(
				'filter' => '',
				'image' => '',
				'title' => '',
				'overlay_text' => 'See Photos',
				'link' => '#',
			), $atts 
		) 
	);
	
	$ebor_image_gallery_count++;

	$image_url = wp_get_attachment_url($image);
	$image = wp_get_attachment_image($image, 'full');

	if($ebor_image_gallery_type == 'masonry_lightbox' || $ebor_image_gallery_type == 'masonry_lightbox_2col' || $ebor_image_gallery_type == 'mosaic_lightbox' || $ebor_image_gallery_type == 'fullscreen_justified_lightbox') {

		$output = '
			<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
				<figure class="overlay overlay2">
					<a href="'.esc_html($image_url).'" data-sub-html="#caption'.esc_attr($ebor_image_gallery_count).'">
						'.$image.'
						<div id="caption'.esc_attr($ebor_image_gallery_count).'" class="d-none">
							<h5>'. $title .'</h5>
                      		<p>'. do_shortcode($content) .'</p>
						</div>
					</a>
				</figure>
			</div>';	

	}

	if($ebor_image_gallery_type == 'masonry' || $ebor_image_gallery_type == 'masonry_2col' || $ebor_image_gallery_type == 'mosaic' || $ebor_image_gallery_type == 'fullscreen_justified') {

		$output = '
			<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
				<figure class="overlay overlay2">
					'.$image.'
				</figure>
			</div>';	

	}

	if($ebor_image_gallery_type == 'classic_grid_caption') {

		$output = '
			<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
				<figure class="overlay rounded overlay1 mb-20">
					<a href="'.esc_url($link).'">
						<span class="bg"></span> 
						'.$image.'
					</a>
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
						<h5 class="mb-0">'.esc_attr($overlay_text).'</h5>
						</div>
					</figcaption>
				</figure>
				'. do_shortcode($content) .'
			</div>';	

	}

	if($ebor_image_gallery_type == 'fullscreen' || $ebor_image_gallery_type == 'classic_grid_overlay_caption' || $ebor_image_gallery_type == 'classic_grid_overlay_caption_2col') {

		$output = '
			<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
				<figure class="overlay-info hovered">
					<a href="'.esc_url($link).'">
						'.$image.'
					</a>
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
							<h4 class="mb-0 text-uppercase letterspace-4">'.esc_attr($overlay_text).'</h4>
						</div> 
					</figcaption>
				</figure>
			</div>';	

	}

if($ebor_image_gallery_type == 'classic_grid_overlay_caption_bevel') {

		$output = '
			<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
				<figure class="overlay-info hovered bevel">
					<a href="'.esc_url($link).'">
						'.$image.'
					</a>
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
							<h3 class="mb-0">'.esc_attr($overlay_text).'</h3>
						</div> 
					</figcaption>
				</figure>
			</div>';	

	}

	if($ebor_image_gallery_type == 'fullscreen_lightbox') {

		$output = '
			<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
				<figure class="overlay-info hovered">
					<a href="'.esc_html($image_url).'" data-sub-html="#caption'.esc_attr($ebor_image_gallery_count).'">
						'.$image.'
						<div id="caption'.esc_attr($ebor_image_gallery_count).'" class="d-none">
							<h5>'. $title .'</h5>
                      		<p>'. do_shortcode($content) .'</p>
						</div>
					</a>
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
							<h3 class="mb-0">'.esc_attr($overlay_text).'</h3>
						</div> 
					</figcaption>
				</figure>
			</div>';	

	}

	if($ebor_image_gallery_type == 'fullscreen_modal') {

		$output = '
		<div class="cbp-item" data-item-filter="'.esc_attr($filter).'">
			<figure class="overlay-info hovered">
				<a href="#" data-toggle="modal" data-target="#galleryModal'.esc_attr($ebor_image_gallery_count).'">
					'.$image.'
				</a>
				<figcaption class="d-flex">
					<div class="align-self-center mx-auto">
				  		<h3 class="mb-0">'.esc_attr($overlay_text).'</h3>
					</div> 
				</figcaption>
			</figure>
		</div>
		<div class="modal inverse-text modal-transparent faded" id="galleryModal'.esc_attr($ebor_image_gallery_count).'" tabindex="-1" role="dialog"> <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"></a>
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content text-center">
					<p>'. do_shortcode($content) .'</p>
				</div>
			</div>
		</div>
		';	

	}

	return $output;
}
add_shortcode( 'brailie_image_gallery_content', 'ebor_image_gallery_content_shortcode' );

// Parent Element
function ebor_image_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'                    => esc_html__( 'Image Gallery' , 'brailie' ),
		    'base'                    => 'brailie_image_gallery',
		    'description'             => esc_html__( 'Create a stylish image gallery', 'brailie' ),
		    'as_parent'               => array('only' => 'brailie_image_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
		    			'Masonry Lightbox' => 'masonry_lightbox',
		    			'Masonry' => 'masonry',
		    			'Classic Grid + Caption' => 'classic_grid_caption',
		    			'Classic Grid + Overlay Caption' => 'classic_grid_overlay_caption',	
		    			'Classic Grid + Overlay Caption 2 Columns' => 'classic_grid_overlay_caption_2col',		    			
		    			'Classic Grid + Overlay Caption + Bevel' => 'classic_grid_overlay_caption_bevel',
		    			'Masonry Lightbox 2 Columns' => 'masonry_lightbox_2col',
		    			'Masonry 2 Columns' => 'masonry_2col',
		    			'Mosaic Lightbox' => 'mosaic_lightbox',
		    			'Mosaic' => 'mosaic',
		    			'Fullscreen Grid Lightbox' => 'fullscreen_lightbox',
		    			'Fullscreen Grid' => 'fullscreen',
		    			'Fullscreen Grid Modal' => 'fullscreen_modal',
		    			'Fullscreen Justified Lightbox' => 'fullscreen_justified_lightbox',
		    			'Fullscreen Justified Grid' => 'fullscreen_justified',
		    		)
		    	),		    	
				array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Main Title (Will show filters to the right)", 'brailie'),
		    		"param_name" => "main_title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Show/Hide Filters", 'brailie'),
		    		"param_name" => "display_filters",
		    		"value" => array(
		    			'Show Filters' => 'show_filters',		    			
		    			'Hide Filters' => 'hide_filters',
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("All Text", 'brailie'),
		    		"param_name" => "all_text",
		    		'holder' => 'div',
		    		"value" => __( 'All', 'brailie' ),
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
			"icon" => 'brailie-vc-block',
		    'name'            => esc_html__('Image Gallery Item', 'brailie'),
		    'base'            => 'brailie_image_gallery_content',
		    'description'     => esc_html__( 'Add an image to your image gallery', 'brailie' ),
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_image_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
					"type" => "attach_image",
					"heading" => esc_html__("Image", 'brailie'),
					"param_name" => "image"
				),
				array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Filter", 'brailie'),
		    		"param_name" => "filter",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Image Title (Appears in Lightbox Only)", 'brailie'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Image Caption (Appears in Lightbox and Under Main Image in Classic Grid Caption Layout only)", 'brailie'),
	            	"param_name" => "content"
	            ),
	            array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Classic Grid Caption/Fullscreen Grid - Overlay Text", 'brailie'),
		    		"param_name" => "overlay_text",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Classic Grid Caption/Fullscreen Grid - Item Links To", 'brailie'),
		    		"param_name" => "link",
		    		'holder' => 'div'
		    	),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_image_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_image_gallery_content extends WPBakeryShortCode {}
}