<?php

/**
 * The Shortcode
 */
function ebor_accordion_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'accordion accordion-1',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<ul class="'. esc_attr($type) .' '. esc_attr($custom_css_class) .'">'. do_shortcode($content) .'</ul>';

	return $output;
}
add_shortcode( 'stack_accordion', 'ebor_accordion_shortcode' );

/**
 * The Shortcode
 */
function ebor_accordion_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li class="'. esc_attr($custom_css_class) .'">
			<div class="accordion__title" id="'. htmlspecialchars_decode(sanitize_title($title)) .'">
				<span class="h5">'. htmlspecialchars_decode($title) .'</span>
			</div>
			<div class="accordion__content">
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</li>
	';

	return $output;
}
add_shortcode( 'stack_accordion_content', 'ebor_accordion_content_shortcode' );

// Parent Element
function ebor_accordion_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Accordion' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_accordion',
		    'description'             => esc_html__( 'Create Accordion Content', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_accordion_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'stackwordpresstheme'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Button Style: Multiple Open at a Time' => 'accordion accordion-1',
		    			'Minimal Style: Multiple Open at a Time' => 'accordion accordion-2',
		    			'Button Style: One Open at a Time' => 'accordion accordion-1 accordion--oneopen',
		    			'Minimal Style: One Open at a Time' => 'accordion accordion-2 accordion--oneopen',
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_shortcode_vc' );

// Nested Element
function ebor_accordion_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Accordion Content', 'stackwordpresstheme'),
		    'base'            => 'stack_accordion_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'stackwordpresstheme'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'stackwordpresstheme'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
	            	"param_name" => "custom_css_class",
	            	"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=YHRpDbuybXw">Video Tutorial</a></div>',
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_accordion extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_accordion_content extends WPBakeryShortCode {}
}