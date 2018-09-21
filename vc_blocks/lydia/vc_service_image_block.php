<?php 

/**
 * The Shortcode
 */
function ebor_service_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'image' => '',
				'link' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="caption-overlay">
		
			<figure>
				<a href="'. esc_url($link) .'">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</a>
			</figure>
			
			<div class="caption bottom-right">
				<div class="title">
					<h3 class="main-title layer">'. htmlspecialchars_decode($title) .'</h3>
				</div>
			</div>
			
		</div>
	';
	
	return $output;
}
add_shortcode( 'lydia_service_image', 'ebor_service_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_image_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Service Image", 'lydia'),
			"base" => "lydia_service_image",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Add a linkable image with title.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Block Image", 'lydia'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'lydia'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("URL for block link", 'lydia'),
					"param_name" => "link"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_image_shortcode_vc' );