<?php 

/**
 * The Shortcode
 */
function ebor_feature_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'link' => '',
				'image' => '',
				'button_text' => '',
				'sub' => '',
				'target' => '_self'
			), $atts 
		) 
	);
	
	$output = false;
	$slides = explode(',', $image);
	
	if( is_array($slides) ){
	
		$image = wp_get_attachment_image_src( $slides[0], 'full' );
		
		$output .= '<div class="feature-box"><div class="background-image-holder overlay"><img src="'. $image[0] .'" alt="'. $title .'" class="background-image" /></div><div class="inner">';
			 
		if( $sub )
			$output .= '<span class="alt-font text-white">'. wp_specialchars_decode($sub, ENT_QUOTES) .'</span>';
			
		if( $title )
			$output .= '<h1 class="text-white">'. wp_specialchars_decode($title, ENT_QUOTES) .'</h1>';
	
		if( $content )
			$output .= '<div class="text-white">'. wpautop(do_shortcode(wp_specialchars_decode($content, ENT_QUOTES))) .'</div>';
		
		if( $link || $button_text )
			$output .= '<a href="'. esc_url($link) .'" class="btn btn-primary btn-white" target="'. esc_attr($target) .'">'. wp_specialchars_decode($button_text, ENT_QUOTES) .'</a>';
	
		$output .= '</div></div>';
	
	}
	
	return $output;
}
add_shortcode( 'pivot_feature_box', 'ebor_feature_box_shortcode' );

/**
 * The VC Functions
 */
function ebor_feature_box_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Feature Box", 'pivot'),
			"base" => "pivot_feature_box",
			"category" => __('Pivot - Text', 'pivot'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Background Image", 'pivot'),
					"param_name" => "image",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'pivot'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'pivot'),
					"param_name" => "sub",
					"value" => '',
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'pivot'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'pivot'),
					"param_name" => "button_text",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link", 'pivot'),
					"param_name" => "link",
					"value" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => __("Open link in new window?", 'pivot'),
					"param_name" => "target",
					"value" => array_flip(array(
						'_self' => 'No',
						'_blank' => 'Yes',
					)),
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_feature_box_shortcode_vc' );