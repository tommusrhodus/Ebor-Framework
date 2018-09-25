<?php 

/**
 * The Shortcode
 */
function ebor_video_background_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'youtube' => '',
				'vimeo' => '',
				'fallback' => ''
			), $atts 
		) 
	);
	
	$img = wp_get_attachment_image_src($fallback, 'full');
	
	if(!( isset($img[0]) ))
		$img[0] = false;
	
	$output = '<style type="text/css">
					.poster-img {
						background: url('. esc_url($img[0]) .') center center no-repeat !important;
						background-size: cover !important;
					}
			  </style>';
	
	if( $youtube ){
		$output .= '<script type="text/javascript">
						/*-----------------------------------------------------------------------------------*/
						/*	BG YOUTUBE INIT
						/*-----------------------------------------------------------------------------------*/ 
						jQuery(document).ready(function() {
						"use strict";
							
							if( !device.tablet() && !device.mobile() ) {
								jQuery(function(){
									jQuery(".player").mb_YTPlayer();
								});		
							} else {
								jQuery("body").addClass("poster-img");
							}
								
						});
				   </script>';
		$output .= "<a id=\"bgndVideo\" class=\"player\" data-property=\"{videoURL:'". esc_js(esc_url($youtube)) ."',containment:'body',autoPlay:true, mute:true, startAt:0, opacity:1}\"></a>";
	} elseif( $vimeo ){
		$output .= '<script type="text/javascript">
						/*-----------------------------------------------------------------------------------*/
						/*	BG VIMEO INIT
						/*-----------------------------------------------------------------------------------*/ 
						jQuery(document).ready(function() {
						"use strict";
						
							if( !device.tablet() && !device.mobile() ) {
								jQuery.okvideo({ source: "'. (int) esc_js($vimeo) .'",
						            autoplay:true,
						            loop: true,
						            highdef:true,
						            hd:true, 
						            adproof: true,
						            volume: 0
						         });		
							} else {
								jQuery("body").addClass("poster-img");
							}
						
						});
				   </script>';
	}
	
	
	
	$output .= '<section class="mastwrap fullheight"><div class="video-title-holder fullheight text-center"><div class="valign">';
	
	if($title)
		$output .= '<h1><span class="white font2">'. htmlspecialchars_decode($title) .'</span></h1>';
		
	$output .= '</div></div></section>';
	
	return $output;
}
add_shortcode( 'expose_video_background', 'ebor_video_background_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_background_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("video Background", 'expose'),
			"base" => "expose_video_background",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Youtube URL", 'expose'),
					"param_name" => "youtube"
				),
				array(
					"type" => "textfield",
					"heading" => __("Vimeo ID", 'expose'),
					"param_name" => "vimeo"
				),
				array(
					"type" => "attach_image",
					"heading" => __("Fallback static image for mobile devices", 'expose'),
					"param_name" => "fallback"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_background_shortcode_vc' );