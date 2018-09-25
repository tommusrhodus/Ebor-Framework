<?php 

/**
 * The Shortcode
 */
function ebor_featured_parallax_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'slides' => '',
				'title' => '',
				'link' => '',
				'button_text' => ''
			), $atts 
		) 
	);
	
	$output = false;
	$slides = explode(',', $slides);
	
	if( is_array($slides) ){
		foreach( $slides as $id ){
			$url = wp_get_attachment_image_src($id, 'full');
			$output .= '<section class="parallax parallax-slide fullheight text-left" style="background-image: url('. $url[0] .');"><div class="valign">';
			
			if($title)
				$output .= '<h2 class="black font2">'. htmlspecialchars_decode($title) .'</h2>';
				
			$output .= wpautop(do_shortcode(htmlspecialchars_decode($content)));
				
			if($link && $button_text)
				$output .= '<div class="featured-action"><a class="btn btn-expose-small btn-expose-dark" href="'. esc_url($link) .'">'. htmlspecialchars_decode($button_text) .'</a></div>';
				
			$output .= '</div></section>';
		}	
	}
	
	return $output;
}
add_shortcode( 'expose_featured_parallax', 'ebor_featured_parallax_shortcode' );

/**
 * The VC Functions
 */
function ebor_featured_parallax_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Fullscreen Parallax Image", 'expose'),
			"base" => "expose_featured_parallax",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Slider Images", 'expose'),
					"param_name" => "slides",
					"value" => '',
					"description" => __('Add images to show in the fullscreen parallax.', 'expose')
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'expose'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'expose'),
					"param_name" => "link"
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'expose'),
					"param_name" => "button_text"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_featured_parallax_shortcode_vc' );