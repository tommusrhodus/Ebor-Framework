<?php 

/**
 * The Shortcode
 */
function ebor_text_static_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'left'
			), $atts 
		) 
	);

	if( 'left' == $layout ){
		
		$output = '
			<div class="imageblock imageblock--lg bg--secondary">
				<div class="imageblock__content col-md-5 col-sm-4 pos-right hidden-xs">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'full' ) .'
					</div>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-7">
							'. do_shortcode($content) .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</div>
		';
		
	} elseif( 'right' == $layout ){
		
		$output = '
			<div class="imageblock imageblock--lg">
				<div class="imageblock__content col-md-5 col-sm-4 pos-left hidden-xs">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'full' ) .'
					</div>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-7 col-md-push-7 col-sm-push-5">
							'. do_shortcode($content) .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'partner_text_static_image', 'ebor_text_static_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_static_image_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Text & Image' , 'partner' ),
		    'base'                    => 'partner_text_static_image',
		    'description'             => esc_html__( 'Create fancy images & text', 'partner' ),
		    'as_parent'               => array('except' => 'partner_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params' => array(
		    	array(
		    		"type" => "attach_image",
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
add_action( 'vc_before_init', 'ebor_text_static_image_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_text_static_image extends WPBakeryShortCodesContainer {}
}