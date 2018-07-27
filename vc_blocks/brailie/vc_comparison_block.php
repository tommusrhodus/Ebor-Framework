<?php 

/**
 * The Shortcode
 */
function ebor_image_comparison_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image_comparison_image_a' => '',
				'image_comparison_image_b' => '',
				'custom_css_class'   => '',
			), $atts 
		) 
	);
	
	$image_a = wp_get_attachment_image($image_comparison_image_a, 'full');
	$image_b = wp_get_attachment_image($image_comparison_image_b, 'full');
		
	$output = '
		<div class="cocoen" data-aos="fade"> 
			'.$image_a.'
			'.$image_b.'
		</div>
	';

	return $output;
}
add_shortcode( 'brailie_image_comparison_block', 'ebor_image_comparison_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_comparison_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Image Comparison", 'brailie'),
			"base" => "brailie_image_comparison_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'A slider for comparing images.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Comparison Image A", 'brailie'),
					"param_name" => "image_comparison_image_a"
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Comparison Image B", 'brailie'),
					"param_name" => "image_comparison_image_b"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_comparison_block_shortcode_vc' );