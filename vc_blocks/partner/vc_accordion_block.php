<?php

/**
 * The Shortcode
 */
function ebor_accordion_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'accordion'
			), $atts 
		) 
	);
	
	$output = '<ul class="'. esc_attr($type) .'">'. do_shortcode($content) .'</ul>';

	return $output;
}
add_shortcode( 'partner_accordion', 'ebor_accordion_shortcode' );

/**
 * The Shortcode
 */
function ebor_accordion_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li>
			<div class="accordion__title text-center">
				<span class="h6">'. htmlspecialchars_decode($title) .'</span>
			</div>
			<div class="accordion__content">
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</li>
	';

	return $output;
}
add_shortcode( 'partner_accordion_content', 'ebor_accordion_content_shortcode' );

// Parent Element
function ebor_accordion_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Accordion' , 'partner' ),
		    'base'                    => 'partner_accordion',
		    'description'             => esc_html__( 'Create Accordion Content', 'partner' ),
		    'as_parent'               => array('only' => 'partner_accordion_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'partner'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Multiple Open' => 'accordion',
		    			'One Open at a Time' => 'accordion accordion--oneopen',
		    		)
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
			"icon" => 'partner-vc-block',
		    'name'            => esc_html__('Accordion Content', 'partner'),
		    'base'            => 'partner_accordion_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'partner' ),
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'partner_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'partner'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'partner'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_accordion extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_partner_accordion_content extends WPBakeryShortCode {}
}