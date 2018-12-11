<?php

/**
 * The Shortcode
 */
function ebor_tabbed_carousel_shortcode( $atts, $content = null ) {
	global $rand;
	global $ebor_tabbed_carousel_content;
	global $ebor_tabbed_carousel_count;
	global $ebor_tab_type;
	$ebor_tabbed_carousel_count = $rand = 0;
	$ebor_tabbed_carousel_content = $ebor_tab_type = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => 'standard',
				'main_title' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);

	$output = false;
	$rand   = wp_rand(0, 10000);
	$ebor_tab_type = $type;
	  
	$output .= '
		<div class="h-100 d-flex flex-column justify-content-center '. esc_attr( $custom_css_class ).'">
			<div class="tabs-wrapper filtered">';

				if($main_title) {
					$output .= '
						<div class="container d-md-flex">
							<div class="mr-auto text-left">
								<h2 class="section-title section-title-upper mb-0">'. esc_attr( $main_title ).'</h2>
							</div>
							<div class="space20 d-md-none"></div>
							<ul class="nav nav-tabs text-md-right align-self-center">
								'. do_shortcode($content) .'
							</ul>
						</div>';
					} else {
						$output .= '
						<div class="container">
							<ul class="nav nav-tabs justify-content-center">
								'. do_shortcode($content) .'
							</ul>
						</div>';
					}

				$output .= '
				<div class="space5"></div>
				<div class="tab-content">
					'. $ebor_tabbed_carousel_content. '
				</div>
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'brailie_tabbed_carousel', 'ebor_tabbed_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabbed_carousel_content_shortcode( $atts, $content = null ) {
	global $ebor_tabbed_carousel_content;
	global $ebor_tabbed_carousel_count;
	global $rand;
	global $ebor_tab_type;
	$ebor_tabbed_carousel_count++;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'images' => '',
			), $atts 
		) 
	);

	$images = explode(',', $images);	

	$active = ( 1 == $ebor_tabbed_carousel_count ) ? 'show active' : '';
	
	$ebor_tabbed_carousel_content .= '<div class="tab-pane fade '. $active .'" id="tab'. $rand .'-'. esc_attr($ebor_tabbed_carousel_count) .'"><div class="swiper-container-wrapper swiper-auto-tab"><div class="swiper-container text-center"><div class="swiper-wrapper light-gallery">';

	foreach ($images as $id) {

		$image_url = wp_get_attachment_url($id);

		if($ebor_tab_type == 'standard') {
			$ebor_tabbed_carousel_content .= '		
				<div class="swiper-slide">
					'. wp_get_attachment_image($id, 'full') .'
				</div>
			';
		} elseif($ebor_tab_type == 'standard_lightbox') {
			$ebor_tabbed_carousel_content .= '		
				<div class="swiper-slide light-gallery">
					'. wp_get_attachment_image($id, 'full') .'
					<div class="link-wrapper">
						<div class="link lightbox">
							<a href="'.esc_html($image_url).'"></a>
						</div>
					</div>
				</div>
			';
		} 
	}

	$ebor_tabbed_carousel_content .= '
		</div></div>
			<div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div></div>';

	$output = '<li class="nav-item"><a class="nav-link '. $active .'" href="#tab'. $rand .'-'. esc_attr($ebor_tabbed_carousel_count) .'" data-toggle="tab" id="link-tab'. $rand .'">'. htmlspecialchars_decode($title) .'</a></li>';
	
	return $output;
}
add_shortcode( 'brailie_tabbed_carousel_content', 'ebor_tabbed_carousel_content_shortcode' );

// Parent Element
function ebor_tabbed_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon"            => 'brailie-vc-block',
		    'name'            => esc_html__( 'Tabbed Image Carousel' , 'brailie' ),
		    'base'            => 'brailie_tabbed_carousel',
		    'description'     => esc_html__( 'Tabbed Carousel', 'brailie' ),
		    'as_parent'       => array('only' => 'brailie_tabbed_carousel_content'),
		    'content_element' => true,
		    "js_view"         => 'VcColumnView',
		    "category"        => esc_html__('brailie WP Theme', 'brailie'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Carousel Type", 'brailie'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Standard' => 'standard',
		    			'Standard + Lightbox' => 'standard_lightbox',
		    		)
		    	),	
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'brailie'),
		    		"param_name" => "main_title",
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabbed_carousel_shortcode_vc' );

// Nested Element
function ebor_tabbed_carousel_content_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('brailie_get_icons') ){
		$icons = array_values(brailie_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"            => 'brailie-vc-block',
		    'name'            => esc_html__('Tabbed Carousel Content', 'brailie'),
		    'base'            => 'brailie_tabbed_carousel_content',
		    "category"        => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_tabbed_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	    		array(
		    		"type"       => "textfield",
		    		"heading"    => esc_html__("Title", 'brailie'),
		    		"param_name" => "title",
		    		'holder'     => 'div'
		    	),
		    	array(
		    		"type"       => "attach_images",
		    		"heading"    => esc_html__("Carousel Images", 'brailie'),
		    		"param_name" => "images",
		    		'holder'     => 'div'
		    	),
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_tabbed_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_tabbed_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_tabbed_carousel_content extends WPBakeryShortCode {}
}