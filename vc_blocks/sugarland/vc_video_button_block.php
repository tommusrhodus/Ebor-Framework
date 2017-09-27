<?php 

/**
 * The Shortcode
 */
function ebor_video_button_shortcode( $atts, $content = null ) {
	
	extract( 
		shortcode_atts( 
			array(
				'url'      => 'http://player.vimeo.com/video/188726644?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff',
				'image'    => '',
				'title'    => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	if( $image ){
		
		$output = '
			<div class="imageWrapper"> 
			
				'. wp_get_attachment_image($image, 'full') .'
				
				<div class="info-box-content">
					<div class="parent">
						<div class="child">
						
							<h5 class="header">'. $title .'</h5>
							
							<a href="'. $url .'" class="video-popup round-button">
								<i class="fa fa-play"></i>
								<div class="circle-anim"></div>
							</a>
							
							<p class="small below-button">'. $subtitle .'</p>
						
						</div>
					</div>
				</div>
				
				<div class="overlay2"></div>
				
			</div>
		';
		
	} else {
	        
		$output = '
			<div class="text-center video-button">
				<a href="'. $url .'" data-fancybox-group="group1" class="video-popup round-button">
					<i class="fa fa-play"></i>
					<div class="circle-anim"></div>
				</a>
			</div>
		';
		
	}
	
	return $output;
	
}
add_shortcode( 'sugarland_video_button', 'ebor_video_button_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_button_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'sugarland-vc-block',
			"name" => esc_html__("Video Button", 'sugarland'),
			"base" => "sugarland_video_button",
			"category" => esc_html__('sugarland WP Theme', 'sugarland'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Video URL", 'sugarland'),
					"param_name" => "url",
					'value' => 'http://player.vimeo.com/video/188726644?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_video_button_shortcode_vc' );