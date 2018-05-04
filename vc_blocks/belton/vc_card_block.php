<?php 

/**
 * The Shortcode
 */
function ebor_card_shortcode( $atts, $content = null ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'image'        		=> '',
				'image_caption'		=> '',
				'show_overlay'		=> '',
			), $atts 
		) 
	);	

	$output = '
		<div class="element clearfix">
			<div class="image-with-overlay lighter-overlay white-text centered"> 
				'. wp_get_attachment_image( $image, 'large' ) .'
				<div class="info-box covering-image">
					<div class="info-box-content">
						<div class="parent">
							<div class="child">
							  	<h3>'. esc_attr($image_caption) .'</h3>
							</div>
						</div>
					</div>
				</div>';
				if($show_overlay == 'yes') {
					$output .= '<div class="overlay"></div>';
				}
				$output .='
			</div>';

			if(!empty($content)) :
				$output .= '
				<div class="greyed">
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>';
			endif;

		$output .= '
		</div>
	';
	
	return $output;
}
add_shortcode( 'belton_card', 'ebor_card_shortcode' );

/**
 * The VC Functions
 */
function ebor_card_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'belton-vc-block',
			"name"        => esc_html__( "Card", 'belton' ),
			"base"        => "belton_card",
			"category"    => esc_html__( 'belton WP Theme', 'belton' ),
			'description' => 'A neat image and text based block.',
			"params"      => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Image", 'belton'),
					"param_name" => "image"
				),				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Overlay Caption", 'belton'),
					"param_name" => "image_caption"
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Show Image Overlay?", 'belton'),
					"param_name" => "show_overlay",
					"value"      => array(
						'No'  => 'no',
						'Yes' => 'yes'
					)
				),	
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Intro Content", 'belton'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_card_shortcode_vc');