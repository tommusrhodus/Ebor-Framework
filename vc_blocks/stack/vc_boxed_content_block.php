<?php 

/**
 * The Shortcode
 */
function ebor_boxed_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'padding' => '',
				'custom_css_class' => '',
				'background' => '',
				'shadow' => '',
				'overlay' => '7',
				'image' => '',
				'scrim_top' => '',
				'scrim_bottom' => ''
			), $atts 
		) 
	);
	

	$overlay = ( 'imagebg' == $background ) ? 'data-overlay="'. $overlay .'"' : false;
	$overlay = ( $scrim_top ) ? 'data-scrim-top="'. $scrim_top .'"' : $overlay;
	$overlay = ( $scrim_bottom ) ? 'data-scrim-bottom="'. $scrim_bottom .'"' : $overlay;
	
	$image = ( $image ) ? '<div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>' : false;
	
	$output = '<div class="'. esc_attr($custom_css_class) .' '. $padding .' '. $background .' '. $shadow .' boxed boxed--border" '. $overlay .'>'. $image .'<div class="container">'. do_shortcode(htmlspecialchars_decode($content)) .'</div></div>';

	return $output;
}
add_shortcode( 'stack_boxed_content', 'ebor_boxed_content_shortcode' );

/**
 * The VC Functions
 */
function ebor_boxed_content_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Boxed Content", 'stackwordpresstheme'),
			"base" => "stack_boxed_content",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Box Padding Size", 'stackwordpresstheme'),
					"param_name" => "padding",
					"value" => array(
						'Regular Padding' => 'regular-padding',
						'Large Padding' => 'boxed--lg'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Background Colour", 'stackwordpresstheme'),
					"param_name" => "background",
					"value" => array(
						'None' => 'regular-background',
						'Primary Colour' => 'bg--primary',
						'Primary 1 Colour' => 'bg--primary-1',
						'Primary 2 Colour' => 'bg--primary-2',
						'Secondary Colour' => 'bg--secondary',
						'Dark Colour' => 'bg--dark',
						'Image Background' => 'imagebg'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Box Shadow", 'stackwordpresstheme'),
					"param_name" => "shadow",
					"value" => array(
						'No Shadow' => 'no-shadow',
						'Regular Box Shadow' => 'box-shadow'
					),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Background Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Overlay Opacity", 'stackwordpresstheme'),
					"param_name" => "overlay",
					"description" => 'Leave blank for header option default opacity, enter 1 (light overlay) to 9 (dark overlay) to customize.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Top Scrim Opacity", 'stackwordpresstheme'),
					"param_name" => "scrim_top",
					"description" => 'Leave blank regular overlay, enter 1 (light overlay) to 9 (dark overlay) to customize, will give a gradient overlay',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Bottom Scrim Opacity", 'stackwordpresstheme'),
					"param_name" => "scrim_bottom",
					"description" => 'Leave blank regular overlay, enter 1 (light overlay) to 9 (dark overlay) to customize, will give a gradient overlay',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=Q_3qT-PGgpw">Video Tutorial</a></div>',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_boxed_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_boxed_content extends WPBakeryShortCodesContainer {}
}