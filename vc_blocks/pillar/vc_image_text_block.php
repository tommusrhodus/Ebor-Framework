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
	
	if( 'left' == $layout ){
		
		$output = '
			<section class="imageblock">
				<div class="imageblock__content col-md-6 col-sm-4 pos-left">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'full' ) .'
					</div>
				</div>
				<div class="col-md-6 col-md-push-6 col-sm-8 col-sm-push-4">
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						'. do_shortcode($content) .'
					</div>
				</div>
			</section>
		';
		
	} elseif( 'left-big' == $layout ){
		
		$output = '
			<section class="imageblock about-1">
			    <div class="imageblock__content col-md-5 col-sm-4 pos-right">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full' ) .'
			        </div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-6 col-sm-8">
			                '. do_shortcode($content) .'
			            </div>
			        </div>
			        <!--end of row-->
			    </div>
			    <!--end of container-->
			</section>
		';
		
	} elseif( 'right-big' == $layout ){
		
		$output = '
			<section class="imageblock about-1">
			    <div class="imageblock__content col-md-5 col-sm-4 pos-left">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full' ) .'
			        </div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <div class="col-md-6 col-md-push-6 col-sm-8 col-sm-push-4">
			                '. do_shortcode($content) .'
			            </div>
			        </div>
			        <!--end of row-->
			    </div>
			    <!--end of container-->
			</section>
		';
		
	} elseif( 'right' == $layout ) {
	
		$output = '
			<section class="imageblock">
				<div class="imageblock__content col-md-6 col-sm-4 pos-right">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'full' ) .'
					</div>
				</div>
				<div class="col-md-6 col-sm-8">
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						'. do_shortcode($content) .'
					</div>
				</div>
			</section>
		';
	
	} elseif( 'boxed' == $layout ) {
	
		$output = '
			<div class="boxed imagebg height-40 box-shadow-wide" data-overlay="5">
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="pos-vertical-center text-center">
					'. do_shortcode($content) .'
				</div>
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'pillar_text_image', 'ebor_text_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_image_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'                    => esc_html__( 'Text & Image' , 'pillar' ),
		    'base'                    => 'pillar_text_image',
		    'description'             => esc_html__( 'Create fancy images & text', 'pillar' ),
		    'as_parent'               => array('except' => 'pillar_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'params' => array(
		    	array(
		    		"type" => "attach_image",
		    		"heading" => esc_html__("Block Image", 'pillar'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Image & Text Display Type", 'pillar'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Offscreen Image Left' => 'left',
		    			'Offscreen Image Right' => 'right',
		    			'Offscreen Image Right (Bigger Content)' => 'left-big',
		    			'Offscreen Image Left (Bigger Content)' => 'right-big',
		    			'Boxed Image (Content on top)' => 'boxed'
		    		)
		    	),
		    )
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_text_image_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pillar_text_image extends WPBakeryShortCodesContainer {}
}