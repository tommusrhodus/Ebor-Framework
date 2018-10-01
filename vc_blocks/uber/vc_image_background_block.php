<?php 

/**
 * The Shortcode
 */
function ebor_image_background_shortcode( $atts, $content = null ) {
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
	
	$output = '<div id="intro" class="intro intro-08 fullheight text-center bg-cover" style="background-image: url('. esc_url($img[0]) .');">
		<div class="intro-08-overlay fullheight">
			<div class="valign">
				<div class="container">
					<div class="row">
						<article class="col-md-12 text-center">
							<h3 class="text-rotator black font4light minimal-caps">
								<span class="rotate">'. $title .'</span>
							</h3>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>';
	
	return $output;
}
add_shortcode( 'uber_image_background', 'ebor_image_background_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_background_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Image Background", 'uber'),
			'description' => __('Adds a hero header with a text rotator', 'uber'),
			"base" => "uber_image_background",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => __("Title", 'uber'),
					"param_name" => "title",
					'description' => 'Comma separate lines for fade in / fade out text rotator.',
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'uber'),
					"param_name" => "fallback"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_background_shortcode_vc' );