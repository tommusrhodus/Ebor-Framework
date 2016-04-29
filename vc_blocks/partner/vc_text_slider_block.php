<?php 

/**
 * The Shortcode
 */
function ebor_text_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'left'
			), $atts 
		) 
	);
	
	$slidesHTML = false;
	$slides = explode(',', $image);
	if( is_array($slides) ){
		foreach( $slides as $ID ){
			$slidesHTML .= '
				<li>
					<div class="background-image-holder">
						'. wp_get_attachment_image( $ID, 'full' ) .'
					</div>
				</li>
			';
		}
	}
	
	if( 'left' == $layout ){
		
		$output = '
			<div class="imageblock imageblock--lg bg--secondary">
				<div class="imageblock__content col-md-6 col-sm-5 pos-right">
					<div class="slider text-center" data-arrows="true">
						<ul class="slides">
							'. $slidesHTML .'
						</ul>
					</div>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							'. do_shortcode($content) .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</div>
		';
		
	} elseif( 'right' == $layout ){
		
		$output = '
			<div class="imageblock imageblock--lg bg--secondary">
				<div class="imageblock__content col-md-6 col-sm-5 pos-left">
					<div class="slider text-center" data-arrows="true">
						<ul class="slides">
							'. $slidesHTML .'
						</ul>
					</div>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-md-push-8 col-sm-push-6">
							'. do_shortcode($content) .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'partner_text_image', 'ebor_text_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_image_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Text & Image Slider' , 'partner' ),
		    'base'                    => 'partner_text_image',
		    'description'             => esc_html__( 'Create fancy images & text', 'partner' ),
		    'as_parent'               => array('except' => 'partner_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params' => array(
		    	array(
		    		"type" => "attach_images",
		    		"heading" => esc_html__("Block Image", 'partner'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Image & Text Display Type", 'partner'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Text Left, Images Right' => 'left',
		    			'Text Right, Images Left' => 'right'
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_text_image_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_text_image extends WPBakeryShortCodesContainer {}
}