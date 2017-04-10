<?php 

/**
 * The Shortcode
 */
function ebor_hero_gradient_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'colors' => '',
				'height' => '',
				'layout' => 'half',
				'custom_css_class' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	if( 'half' == $layout ) {
		
		$height = ( '' == $height ) ? '50' : $height;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' height-'. $height .' imagebg text-center" data-gradient-bg="'. $colors .'">
				<div class="pos-vertical-center">
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
			</div>
		';
		
	} elseif( 'full' == $layout ) {
		
		$height = ( '' == $height ) ? '100' : $height;
		
		$output = '
			<section class="'. esc_attr($custom_css_class) .' imagebg height-'. $height .' text-center" data-gradient-bg="'. $colors .'">
				<div class="background-image-holder">'. wp_get_attachment_image( $image, 'full' ) .'</div>
				<div class="container pos-vertical-center">
					<div class="row">
						<div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
		';
		
	}

	return $output;
}
add_shortcode( 'stack_hero_gradient', 'ebor_hero_gradient_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_gradient_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Hero Header (Gradient)", 'stackwordpresstheme'),
			"base" => "stack_hero_gradient",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Hero Gradient Header Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Half Window Height, Content Vertical Center' => 'half',
						'Full Window Height' => 'full'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Hero Header Background Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Hero Gradient Header Colors List", 'stackwordpresstheme'),
					"param_name" => "colors",
					'description' => '1 Hex color code per line, e.g: <code>#4876BD #5448BD #8F48BD #BD48B1</code>'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hero Height", 'stackwordpresstheme'),
					"param_name" => "height",
					"description" => 'Leave blank for default height, enter 10, 20, 30, 40, 50, 60, 70, 80, 90 or 100 for custom height (percentage of window height)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=yoWmatY3jNU">Video Tutorial</a></div>',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_gradient_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_hero_gradient extends WPBakeryShortCodesContainer {}
}