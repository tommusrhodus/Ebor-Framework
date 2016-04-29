<?php 

/**
 * The Shortcode
 */
function ebor_hero_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'height' => 'height-50',
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="bg--primary imagebg '. esc_attr($height) .'" data-overlay="9">
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'full' ) .'
			</div>
			<div class="container pos-vertical-center">
				<div class="row">
					<div class="col-sm-12 wpb_text_column">
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
				</div><!--end of row-->
			</div><!--end of container-->
		</div>
	';
	
	return $output;
}
add_shortcode( 'partner_hero_image', 'ebor_hero_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_image_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Hero Image", 'partner'),
			"base" => "partner_hero_image",
			"category" => esc_html__('partner WP Theme', 'partner'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Background Image", 'partner'),
					"param_name" => "image"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Hero Text Content", 'partner'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Height", 'partner'),
					"param_name" => "height",
					'description' => 'Use to set height, <code>Hint: Can be used for extra classes also</code>',
					'value' => 'height-50'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_hero_image_shortcode_vc' );