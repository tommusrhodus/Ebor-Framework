<?php 

/**
 * The Shortcode
 */
function ebor_text_video_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'left',
				'custom_css_class' => '',
				'embed' => '',
				'background' => 'bg--secondary',
				'result' => ''
			), $atts 
		) 
	);
	
	if(!( '' == $embed )){
		
		$cache_key = 'tr-oembed-' . md5($embed);
		
		//Bail early on result
		if( $result = get_transient($cache_key) ) {
		    //$result now has the iFrame
		} else {
		
			//Cache is empty, resolve oEmbed
			$result = wp_oembed_get($embed, array('height' => '300', 'autoplay' => 'true'));
			
			//Cache 4 hours for standard and 5 min for failed
			$ttl = $result ? 14400 : 300;
			
			set_transient($cache_key, $result, $ttl);
			
		}
	
	}
	
	if( 'left' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imageblock switchable feature-large '. $background .'">
				<div class="imageblock__content col-md-6 col-sm-4 pos-right">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'full' ) .'
					</div>
					<div class="modal-instance">
						<div class="video-play-icon modal-trigger"></div>
						<div class="modal-container">
							<div class="modal-content bg-dark" data-width="60%" data-height="60%">
								'. $result .'
							</div><!--end of modal-content-->
						</div><!--end of modal-container-->
					</div><!--end of modal instance-->
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-7">
							'. do_shortcode($content) .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
		';
		
	} elseif( 'right' == $layout ){
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imageblock switchable switchable--switch feature-large '. $background .'">
				<div class="imageblock__content col-md-6 col-sm-4 pos-right">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'full' ) .'
					</div>
					<div class="modal-instance">
						<div class="video-play-icon modal-trigger"></div>
						<div class="modal-container">
							<div class="modal-content bg-dark" data-width="60%" data-height="60%">
								'. $result .'
							</div><!--end of modal-content-->
						</div><!--end of modal-container-->
					</div><!--end of modal instance-->
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-7">
							'. do_shortcode($content) .'
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
		';
		
	}
	
	return $output;
}
add_shortcode( 'stack_text_video', 'ebor_text_video_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_video_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Text + Video' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_text_video',
		    'description'             => esc_html__( 'Create fancy images & text', 'stackwordpresstheme' ),
		    'as_parent'               => array('except' => 'stack_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params' => array(
		    	array(
		    		"type" => "attach_image",
		    		"heading" => esc_html__("Block Image", 'stackwordpresstheme'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Image & Text Display Type", 'stackwordpresstheme'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Image Left 50/50' => 'left',
		    			'Image Right 50/50' => 'right'
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Video Embed", 'stackwordpresstheme'),
		    		"param_name" => "embed",
		    		'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Background Colour", 'stackwordpresstheme'),
		    		"param_name" => "background",
		    		"value" => array(
		    			'Secondary Colour' => 'bg--secondary',
		    			'None' => 'regular-background',
		    			'Primary Colour' => 'bg--primary',
		    			'Primary 1 Colour' => 'bg--primary-1',
		    			'Primary 2 Colour' => 'bg--primary-2',
		    			'Dark Colour' => 'bg--dark',
		    			'Image Background' => 'imagebg'
		    		),
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
add_action( 'vc_before_init', 'ebor_text_video_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_text_video extends WPBakeryShortCodesContainer {}
}