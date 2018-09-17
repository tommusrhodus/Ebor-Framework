<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="testimonials clearfix"><blockquote>'. wpautop(htmlspecialchars_decode($content)) .'<small>'. htmlspecialchars_decode($title) .'</small></blockquote></div>';
	return $output;
}
add_shortcode( 'lumos_testimonial_block', 'ebor_testimonial_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Testimonial", 'lumos'),
			"base" => "lumos_testimonial_block",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'Add a styled testimonial to your content.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Testimonial Attributation", 'lumos'),
					"param_name" => "title",
				),
				array(
					"type" => "textarea",
					"heading" => __("Block Content", 'lumos'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonial_block_shortcode_vc' );