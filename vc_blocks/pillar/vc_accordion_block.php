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
add_shortcode( 'pillar_accordion', 'ebor_accordion_shortcode' );

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
			<div class="accordion__title">
				<span class="h5">'. htmlspecialchars_decode($title) .'</span>
			</div>
			<div class="accordion__content">
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</li>
	';

	return $output;
}
add_shortcode( 'pillar_accordion_content', 'ebor_accordion_content_shortcode' );

// Parent Element
function ebor_accordion_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'                    => esc_html__( 'Accordion' , 'pillar' ),
		    'base'                    => 'pillar_accordion',
		    'description'             => esc_html__( 'Create Accordion Content', 'pillar' ),
		    'as_parent'               => array('only' => 'pillar_accordion_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'pillar'),
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
			"icon" => 'pillar-vc-block',
		    'name'            => esc_html__('Accordion Content', 'pillar'),
		    'base'            => 'pillar_accordion_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'pillar' ),
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'pillar_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'pillar'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'pillar'),
	            	"param_name" => "content",
	            	'description' => '<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=5py8m9XL0AQ">Video Tutorial</a></div>'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pillar_accordion extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pillar_accordion_content extends WPBakeryShortCode {}
}