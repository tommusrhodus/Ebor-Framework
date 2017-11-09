<?php 

/**
 * The Shortcode
 */
function ebor_video_background_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'local',
				'image' => '',
				'video' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
				'embed' => ''
			), $atts 
		) 
	);
	
	$output = '<section class="image-bg fullscreen overlay bg-dark vid-bg">';
	
	if( 'embed' == $layout ){		
		$output .= '<div class="player" data-video-id="'. esc_attr($embed) .'" data-start-at="0"></div>';
	}
			
	$output .= '
		<div class="background-image-holder">
	        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
	    </div>
	';
	
	if(!( 'local' == $layout )){
		$output .= '
			<div class="masonry-loader">
				<div class="spinner"></div>
			</div>
		';	
	}
	
	if( 'local' == $layout ){		    
		$output .= '
			<div class="fs-vid-background">
		        <video autoplay muted loop>
		            <source src="'. esc_url($webm) .'" type="video/webm">
		            <source src="'. esc_url($mpfour) .'" type="video/mp4">
		            <source src="'. esc_url($ogv) .'" type="video/ogg">	
		        </video>
		    </div>
		';
	}
		
	$output .= '    
		    <div class="container v-align-transform">
		        <div class="row">
		            <div class="col-sm-10 col-sm-offset-1">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
		        </div>
		    </div>
		    
		</section>
	';
	
	return $output;
}
add_shortcode( 'foundry_video_background', 'ebor_video_background_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_background_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Video Background", 'foundry'),
			"base" => "foundry_video_background",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Video Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Local Video' => 'local',
						'Embedded Video (Youtube only!)' => 'embed'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => __("Video Placeholder Image", 'foundry'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .webm extension", 'foundry'),
					"param_name" => "webm",
					"description" => __('Please fill all extensions', 'foundry')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .mp4 extension", 'foundry'),
					"param_name" => "mpfour",
					"description" => __('Please fill all extensions', 'foundry')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .ogv extension", 'foundry'),
					"param_name" => "ogv",
					"description" => __('Please fill all extensions', 'foundry')
				),
				array(
					"type" => "textfield",
					"heading" => __("Youtube Embed ID", 'foundry'),
					"param_name" => "embed",
					'description' => 'Enter only the ID of your youtube video, e.g: dmgomCutGqc'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'foundry'),
					"param_name" => "content"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_background_shortcode_vc' );