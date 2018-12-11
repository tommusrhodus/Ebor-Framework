<?php 

/**
 * The Shortcode
 */
function ebor_image_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'link' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="features features-18">
			<div class="text-center feature image-holder">
				<a href="'. esc_url($link) .'">
				
					<div class="background-image-holder overlay">
						'. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
					</div>
					
					<div class="container">
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
					
				</a>
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'launchkit_image_title', 'ebor_image_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_title_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Image & Hover Title", 'launchkit'),
			"base" => "launchkit_image_title",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'launchkit'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'launchkit'),
					"param_name" => "image",
				),
				array(
					"type" => "textfield",
					"heading" => __("URL block should link to.", 'launchkit'),
					"param_name" => "link"
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_image_title_shortcode_vc' );