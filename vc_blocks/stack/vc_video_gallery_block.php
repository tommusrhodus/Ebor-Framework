<?php

/**
 * The Shortcode
 */
function ebor_video_gallery_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => 'Category:',
				'class' => 'All Categories'
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
            <div class="masonry">
                <div class="masonry-filter-container text-center">
                    <span>'. $text .'</span>
                    <div class="masonry-filter-holder">
                        <div class="masonry__filters" data-filter-all-text="'. $class .'"></div>
                    </div>
                </div><!--end masonry filters-->
                <div class="masonry__container">'. do_shortcode($content) .'</div><!--end masonry container-->
            </div><!--end masonry-->
        </div><!--end of row-->
	';
	
	return $output;
}
add_shortcode( 'stack_video_gallery', 'ebor_video_gallery_shortcode' );

/**
 * The Shortcode
 */
function ebor_video_gallery_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'class' => '',
				'image' => '',
				'title' => '',
				'embed' => '',
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

	$output = '
		<div class="masonry__item col-sm-6 col-xs-12" data-masonry-filter="'. $class .'">
		    <div class="video-cover border--round">
		        <div class="background-image-holder">
		            '. wp_get_attachment_image( $image, 'large' ) .'
		        </div>
		        <div class="video-play-icon"></div>
		        '. $result .'
		    </div><!--end video cover-->
		    <span class="h4 inline-block">'. $title .'</span>
		    <span>'. ucfirst($class) .'</span>
		</div>
	';

	return $output;
}
add_shortcode( 'stack_video_gallery_content', 'ebor_video_gallery_content_shortcode' );

// Parent Element
function ebor_video_gallery_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Video Gallery' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_video_gallery',
		    'description'             => esc_html__( 'Create a filter gallery of lightbox images', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_video_gallery_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("'Category:' Text", 'stackwordpresstheme'),
		    		"param_name" => "text",
		    		'value' => 'Category:'
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
add_action( 'vc_before_init', 'ebor_video_gallery_shortcode_vc' );

// Nested Element
function ebor_video_gallery_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Video Gallery Content', 'stackwordpresstheme'),
		    'base'            => 'stack_video_gallery_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_video_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Filter Category (Plain Text Only)", 'stackwordpresstheme'),
		    		"param_name" => "class",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Block Image", 'stackwordpresstheme'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Content Title", 'stackwordpresstheme'),
	            	"param_name" => "title",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Video Embed", 'stackwordpresstheme'),
	            	"param_name" => "embed",
	            	'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a><br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=ZD4_BLhnVPI">Video Tutorial</a></div>'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_gallery_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_video_gallery extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_video_gallery_content extends WPBakeryShortCode {}
}