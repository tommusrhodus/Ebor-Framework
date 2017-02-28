<?php

/**
 * The Shortcode
 */
function ebor_video_gallery_wide_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => 'Show All'
			), $atts 
		) 
	);
	
	$output = '
		<section class="wide-grid masonry masonry-videos bg--dark">
			<div class=""masonry__filters masonry__filters--outside text-center" data-filter-all-text="'. $text .'"></div>
			<div class="masonry__container masonry--animate">
				'. do_shortcode($content) .'
			</div><!--end masonry container-->
		</section>
	';
	
	return $output;
}
add_shortcode( 'pillar_video_gallery_wide', 'ebor_video_gallery_wide_shortcode' );

/**
 * The Shortcode
 */
function ebor_video_gallery_wide_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'class' => '',
				'image' => '',
				'title' => '',
				'embed' => ''
			), $atts 
		) 
	);
	
	$src = wp_get_attachment_image_src( $image, 'full' );
	
	$output = '
		<div class="col-md-4 col-sm-6 col-xs-12 masonry__item" data-masonry-filter="'. $class .'">
			<div class="portfolio-item portfolio-item-2 video-cover" data-scrim-bottom="9">
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'large' ) .'
				</div>
				<div class="portfolio-item__title">
					<h5>'. $title .'</h5>
					<span><em>'. ucfirst($class) .'</em></span>
				</div>
				<div class="video-play-icon video-play-icon--sm"></div>
				'. wp_oembed_get($embed, array('height' => '400')) .'
			</div>
		</div><!--end item-->
	';

	return $output;
}
add_shortcode( 'pillar_video_gallery_wide_content', 'ebor_video_gallery_wide_content_shortcode' );

// Parent Element
function ebor_video_gallery_wide_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'                    => esc_html__( 'Video Gallery' , 'pillar' ),
		    'base'                    => 'pillar_video_gallery_wide',
		    'description'             => esc_html__( 'Create a filter gallery of lightbox images', 'pillar' ),
		    'as_parent'               => array('only' => 'pillar_video_gallery_wide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("'Show All' Text", 'pillar'),
		    		"param_name" => "class",
		    		'value' => 'Show All'
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_gallery_wide_shortcode_vc' );

// Nested Element
function ebor_video_gallery_wide_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'            => esc_html__('Video Gallery Content', 'pillar'),
		    'base'            => 'pillar_video_gallery_wide_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'pillar' ),
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'pillar_video_gallery_wide'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Filter Category (Plain Text Only)", 'pillar'),
		    		"param_name" => "class",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Block Image", 'pillar'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Content Title", 'pillar'),
	            	"param_name" => "title",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Video Embed", 'pillar'),
	            	"param_name" => "embed",
	            	'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a><br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=k8dyBD1HsAY">Video Tutorial</a></div>'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_gallery_wide_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pillar_video_gallery_wide extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pillar_video_gallery_wide_content extends WPBakeryShortCode {}
}